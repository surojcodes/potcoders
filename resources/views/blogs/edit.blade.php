@extends('layout')
@section('header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="text-center container">
    <div>
        <h1 class="display-5">Update Blog Post</h1>
        <small class="text-success">Create something that helps the world</small>
        <hr style="width:7%">
    </div>
</div>
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
    <form method="POST" action="{{route('blog.update',$blog->slug)}}" class="mt-4">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control @error('title') red-border @enderror"
                placeholder="Enter blog title" value="{{$blog->title}}">
            @error('title')
            <p class="red">{{$errors->first('title')}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="excerpt">Excerpt</label>
            <input type="text" name="excerpt" class="form-control @error('excerpt') red-border @enderror"
                placeholder="Enter blog excerpt" value="{{$blog->excerpt}}">
            @error('excerpt')
            <p class=" red">{{$errors->first('excerpt')}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="excerpt">Tags</label>
            <select name="tags[]" class="tags-dropdown form-control" multiple>
                @foreach($blog_tags as $tag)
                <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                @endforeach
                @foreach($rem_tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
            <small>* You can select multiple tags</small>

        </div>
        <div class="form-group">
            <label for="body">Blog Content</label>
            <textarea name="body" cols="30" rows="10"
                class="form-control @error('body') red-border @enderror">{{$blog->body}}</textarea>
            @error('body')
            <p class=" red">{{$errors->first('body')}}</p>
            @enderror
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-info" value="Update">
        </div>
    </form>
</div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
   $(document).ready(function() {
    $('.tags-dropdown').select2();
});
</script>
@endsection