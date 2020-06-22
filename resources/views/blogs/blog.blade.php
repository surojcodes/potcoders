@extends('layout')
@section('content')
<div class="container">
    <div class="mb-5 text-center">
        <h1 class="display-5">{{$blog->title}}</h1>
        <small class="text-muted">A Blog post by <span class="text-success"> <strong>{{$blog->user->name}}</strong></span></small>
        <hr style="width:7%">
    </div>
        <p class="text-right">{{$blog->created_at->format('y/m/d')}}</p>
    <div class="mb-5">
        <p class="mt-4 text-justify">{{$blog->body}}</p>
        Tags :
        @php $length=count($blog->tags); $i=0; @endphp
        @forelse ($blog->tags as $tag)
        <em>
            <a href="{{route('blog.index',['tag'=>$tag->slug])}}" style="display:inline">
                {{$tag->name}}
                @if(++$i!==$length) , @endif
            </a>
            @empty
            <p>No tags!</p>
            @endforelse
        </em>
    </div>
</div>
@endsection
