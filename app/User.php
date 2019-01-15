<?php

namespace Mirror;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Illuminate\Support\Facades\Auth;
use Mirror\Status;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email', 
        'password',
        'first_name',
        'last_name',
        'location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function isUserOnline()
    {
        return Cache::has('is-user-online-' . $this->id);
    }

    public function getName()
    {
        if($this->first_name && $this->last_name)
        {
            return "{$this->first_name} {$this->last_name}";
        }
        return NULL;
    }
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }
    public function getProfile()
    {
        return asset('storage/uploads/images/users/profile/' . $this->profile);
    }
    public function getBackground()
    {
        return asset('storage/uploads/images/users/background/' . $this->background);
    }

    public function followersOfMine()
    {
        return $this->belongsToMany('Mirror\User','followers','user_id','follower_id');
    }
    
    public function followers()
    {
        return $this->followersOfMine()->get();
    }
    public function followeds()
    {
        return $this->followersOf()->get();
    }

    public function followersOf()
    {
        return $this->belongsToMany('Mirror\User','followers','follower_id','user_id');
    }

    public function isFollowerTo(User $user)
    {
        return (bool) $this->followersOf()->where('user_id',$user->id)->count();
    }
    
    public function isFollowMe(User $user)
    {
        return (bool) $this->followersOfMine()->where('follower_id',$user->id)->count();
    }

    public function Follow(User $user)
    {

        DB::table('followers')->insert(['follower_id' => Auth::user()->id,'user_id' => $user->id,'created_at' => date_create(),'updated_at' => date_create()]);
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('Mirror\User','friends','user_id','friend_id');
    }

    public function friendsOf()
    {
        return $this->belongsToMany('Mirror\User','friends','friend_id','user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()
                    ->wherePivot('accepted',true)
                    ->get()
                    ->merge($this->friendsOf()
                        ->wherePivot('accepted',true)
                        ->get()
                           );
    }

    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted',false)->get();
    }

    public function friendRequestsPending()
    {
        return $this->friendsOf()->wherePivot('accepted',false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id',$user->id)->count();
    }

    public function hasFriendReqestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id',$user->id)->count();
    }

    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id',$user->id)->count();
    }
    
    public function sendRequest(User $user)
    {
        
        //$this->friendsOf()->attach($user->id);
        DB::table('friends')->insert(['user_id' => $user->id,'friend_id' => Auth::user()->id,'created_at' => date_create(),'updated_at' => date_create()]);
    }
    public function acceptFriendRequest(User $user)
    {
        # code...
        DB::table('friends')->where('user_id',Auth::user()->id)->where('friend_id',$user->id)->update(['accepted' => '1']);
    }
    public function refuseFriendRequset(User $user)
    {
        # code...
        DB::table('friends')->where('user_id',Auth::user()->id)->where('friend_id',$user->id)->delete();        
    }
    public function statuses()
    {
        return $this->hasMany('Mirror\Status','user_id');
    }

    public function suggestedFriends()
    {
        $myFriends = Auth::user()->friends();
        $suggestedFriends = [];
        foreach($myFriends as $friend)
        {
            foreach($friend->friends() as $hisFriend)
            {
                if(Auth::user()->id != $hisFriend->id && !in_array($hisFriend,$myFriends->toArray()))
                {
                    $suggestedFriends[] = $hisFriend;
                }
            }
        }
        return $suggestedFriends;

    }
   
    public function getNotifications()
    {
        $ids = Auth::user()->friends()->toArray('id');
        $friendsId = [];
        
        foreach($ids as $id)
        {
            $friendsId[] = $id['id'];
        }
        $statuses = Status::WhereIn('user_id',$friendsId)
                ->orderBy('created_at','DESC')
                ->get();
        return $statuses;
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes
                ->where('likeable_id',$status->id)
                ->where('likeable_type',get_class($status))
                ->where('user_id',$this->id)
                ->count();
    }
    public function likes()
    {
        return $this->hasMany('Mirror\Like','user_id');
    }
    
}
