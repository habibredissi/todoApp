<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['title', 'done', 'list_id'];

    // Relationships with Lists Model
    public function lists(){
        return $this->belongsTo('App\Lists', 'list_id');
    }
}