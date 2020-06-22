<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded=[];
    
    public function getRouteKeyName(){
        return 'name';
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }
}
