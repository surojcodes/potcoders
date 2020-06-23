<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName(){
        return 'name';
    }
    public function isAdmin(){
        if(Auth::user()->isAdmin)
            return true;
        return false;
    }
    public function blogs(){
        return $this->hasMany(Blog::class);
    }
    public function Tags(){
        return $this->hasMany(Tag::class);
    }
    public function points(){
        return $this->hasOne(Point::class);
    }
}
