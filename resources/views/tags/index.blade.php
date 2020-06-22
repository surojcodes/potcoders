@extends('layout')
@section('content')
<div class="mt-5">
    <div class="title">
        <h1 class="green">Pot Blog Tags</h1>
        <span class="byline">To Tagify your posts</span>
    </div>
    @forelse($tags as $tag)
    <h3> <a class="green" href="#"> {{$tag->name}}</a></h3>
    @empty
    <h3>Sad....No Pot Tags Yet!</h3>
    @endforelse
    </ul>
</div>
@endsection