<?php

namespace Mirror;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $fillable = [
        'body','user_id'
    ];


    public function user()
    {
        return $this->belongsTo('Mirror\User','user_id');
    }
    public function getStatusImage()
    {
        return asset('storage/uploads/images/status/' . $this->status_image);
    }
    public function replies()
    {
        return $this->hasMany('Mirror\Status','parent_id');
    }
    
    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('Mirror\Status','parent_id');
    }

    public function likes()
    {
        return $this->morphMany('Mirror\Like','likeable');
    }

    
}
