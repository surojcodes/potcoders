@extends('layout')
@section('content')
<div class="text-center container">
    <div>
        <h1 class="display-4">Create New Tag</h1>
        <small class="text-success">Create a tag for everyone to use</small>
        <hr style="width:7%">
    </div>
</div>
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        <form method="POST" action="{{route('tag.store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Tag Name</label>
                <input type="text" name="name" class="form-control @error('name') red-border @enderror"
                    placeholder="Enter Tag Name" value="{{old('name')}}">
                @error('name')
                <p class="red">{{$message}}</p>
                @enderror
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-success" value="Add">
            </div>
        </form>
    </div>
</div>
@endsection