<?php

namespace Mirror;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $table = "likeable";
    protected $fillable = [
      'user_id','likeable_id','likeable_type'  
    ];

    public function likeable()
    {
        return $this->morphTo('Mirror\Status','user_id');
    }

    public function user()
    {
        return $this->belongsTo('Mirror\User','user_id');
    }

}
