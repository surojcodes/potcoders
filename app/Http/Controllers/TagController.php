<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

use App\Tag;
use App\User;


class TagController extends Controller
{
    // public function index(){
    //     return view('tags.index',[
    //         'tags'=>Tag::latest()->get()
    //     ]);
    // }

    public function create(){
        return view('tags.create');
    }
    public function store(){
        $data = request()->validate([
            'name'=>'required'
        ]);
        //merge two words into one
        $data['name'] =strtolower(str_replace(' ', '', $data['name']));

        //check if tag is alrady there
        $tag = Tag::where('name',request('name'))->first();
        if(!$tag){
            $data['slug']=Str::slug(request('name'));
            $data['user_id']=Auth::user()->id;
            Tag::create($data);
            return redirect(route('home'))->with('success','Tag Created Successfully!');
        }else{
            return redirect(route('home'))->with('error','Tag Already exists!');
        }
    }
    public function userTags(User $user){
            return view('tags.userTags',compact('user'));
    }
    public function update(Tag $tag){
        //check if loggd in user is the tag owner
        $this->authorize('update',$tag);

        $data = request()->validate([
            'name'=>'required'
        ]);
        //merge two words into one
        $data['name'] =strtolower(str_replace(' ', '', $data['name']));
        $check_tag = Tag::where('name',request('name'))->first();
        if(!$check_tag){
            $data['slug']=Str::slug(request('name'));
            $tag->update($data);
            return redirect(route('user.tags',Auth::user()))->with('success','Tag Updated Successfully!');
        }else{
            return redirect(route('user.tags',Auth::user()))->with('error','Tag Already exists!');
        }
    }

    public function destroy(Tag $tag){
        //check if loggd in user is the tag owner
        $this->authorize('delete',$tag);

        $tag->delete();
        return redirect(route('user.tags',Auth::user()))->with('success','Tag deleted!');
    }
}

