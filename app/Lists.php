<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $fillable = ['title', 'user_id'];

    // Relationships with User Model
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    // Relationships with Tasks Model
    public function tasks(){
        return $this->hasMany('App\Tasks', 'list_id');
    }
}