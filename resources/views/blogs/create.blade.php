@extends('layout')
@section('header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="text-center container">
    <div>
        <h1 class="display-4">Create New Blog Post</h1>
        <small class="text-success">Create something that helps the world</small>
        <hr style="width:7%">
    </div>
</div>
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
    <form method="POST" action="{{route('blog.store')}}" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="Enter blog title" value="{{old('title')}}">
            @error('title')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="excerpt">Excerpt</label>
            <input type="text" name="excerpt" class="form-control @error('excerpt') is-invalid @enderror"
                placeholder="Enter blog excerpt" value="{{old('excerpt')}}">
            @error('excerpt')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="excerpt">Tags</label>
            <select name="tags[]" class="tags-dropdown form-control" multiple>
                @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
            <small>* You can select multiple tags</small>
        </div>
        <div class="form-group">
            <label for="body">Blog Content</label>
            <textarea name="body" cols="30" rows="10"
                class="form-control @error('body') is-invalid @enderror" placeholder="Write your blog post here">{{old('body')}}</textarea>
            @error('body')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-success" value="Create">
        </div>
    </form>
</div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
$(document).ready(function(){
    $('.tags-dropdown').select2();
});

</script>
@endsection