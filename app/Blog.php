<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded =[];

    public function getRouteKeyName(){
        return 'slug';
    }
    
    public function getFormattedDate(){
        $m =$this->created_at->format('M');
        $d =$this->created_at->format('d');
        return $m.'<strong style="font-size:1.7em" class="text-muted pl-2">'.$d.'</strong>';
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();;
    }
    public function user(){
        return $this->belongsTo(User::Class);
    }
}
