<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Blog;
use App\Tag;
use App\User;
use App\Point;
use Auth;

class BlogController extends Controller
{
    public function index(){
        if(request('tag')){
            $tag= Tag::where('slug',request('tag'))->firstOrFail();
            $blogs=$tag->blogs;
        }else{
            $blogs = Blog::latest()->paginate(3);
        }
        return view('blogs.blogs',compact('blogs'));
    }
    public function show(Blog $blog){
        return view('blogs.blog',compact('blog'));
    }
    public function create(){
        $tags = Tag::all();
        return view('blogs.create',compact('tags'));
    }
    public function store(){
        $data= $this->validateBlog();
        $data['user_id']=Auth::user()->id;
        $blog= Blog::create($data);
        $blog->tags()->attach(request('tags'));

        // add 5 point to the user
        $user_points = Point::where('user_id',Auth::user()->id)->first();
        if(!$user_points){
            Point::create([
                'user_id'=>Auth::user()->id,
                'point'=>5
            ]);
        }else{
            $user_points->point+=5;
            $user_points->save();
        }
        return redirect(route('home'))->with('success','Blog post created!');
    }
    public function edit(Blog $blog){
        // chek if logged in user is blog owner
        $this->authorize('update-blog',$blog);

        $tags = Tag::all();
        $blog_tags = $blog->tags;
        $rem_tags = $tags->diff($blog_tags);
        return view('blogs.edit',compact('blog','blog_tags','rem_tags'));
    }
    public function update(Blog $blog){
        // chek if logged in user is blog owner
        $this->authorize('update-blog',$blog);

        $blog->tags()->detach();
        $blog->update($this->validateBlog());
        $blog->tags()->attach(request('tags'));
        return redirect(route('home'))->with('success','Blog updated!');
    }
    public function validateBlog(){
        $data = request()->validate([
            'title'=>['required','min:5'],
            'excerpt'=>['required','max:100'],
            'body'=>'required'
        ]);
        $data['slug']=Str::slug(request('title'));
        return $data;
    }
    public function destroy(Blog $blog){
        // chek if logged in user is blog owner
        $this->authorize('update-blog',$blog);

        $blog->delete();
        return redirect(route('user.blogs',['user'=>Auth::user()]))->with('success','Blog deleted successfully');
    }
    public function userBlogs(User $user){
        return view('blogs.userBlogs',compact('user'));
    }
}
