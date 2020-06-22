@extends('layout')
@section('content')
<div class="text-center container">
    <div class="mb-4">
        <h1 class="display-5">Potter Blogs</h1>
        <small class="text-muted">Blog posts by our developers</small>
        <hr style="width:7%">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($blogs as $blog)
            <div class="scard row justify-content-around mb-4">
                <div class="col-md-2 align-self-center">
                    <p> <i class="far fa-calendar-alt fa-2x"></i> <br>{!!$blog->getFormattedDate()!!}</p>
                </div>
                <div class="col-md-6">
                    <h3 class="mb-0"><a href="{{route('blog.show',$blog->slug)}}"  class="text-success"> {{$blog->title}}</a></h3>
                    <small class="text-muted">By <span class="text-success"> <strong>{{$blog->user->name}}</strong></span></small>
                    <p>{{$blog->excerpt}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
        @if (count($blogs)==0)
        <h1 class="text-center text-muted"> Sorry! No posts</h1>
        @else
            @if(method_exists($blogs,'links') )
            <div class="py-3">
                {{$blogs ->links()}}
            </div>
            @endif
        @endif
</div>
@endsection