@extends('layout')
@section('header')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection
@section('content')
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
<div class="card mt-5">
    <div class="card-header bg-success text-white">Your Blog Posts</div>
    <div class="card-body">
    <table class="table table-striped" id="myPosts">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="post-table-body">
            @php $i=0;@endphp
            @forelse($user->blogs as $blog)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$blog->title}}</td>
                    <td>
                    @can('update-blog',$blog)
                        <a href="{{route('blog.edit',$blog->slug)}}" class="btn btn-sm btn-outline-info">Edit</a>
                        <button class="btn btn-sm btn-outline-danger delete-post" id="del_{{$blog->slug}}">
                        Delete
                        </button>
                    @else
                        Not your blog!
                    @endcan

                    </td>
                </tr>
            @empty
                <tr><td>No posts yet !</td></tr>
            @endforelse
        </tbody>
</table>
       
    </div>
</div>

<div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel">Delete a Blog Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete this post?</p>
        <small class="text-danger">This process is ireeversible!</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn  btn-sm btn-dark" data-dismiss="modal">Close</button>

        <form id="modal-form" method="POST">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-sm btn-danger text-white" value="DELETE">
        </form>

      </div>
    </div>
  </div>
</div>


@endsection
@section('scripts')
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myPosts').DataTable();
        $('#post-table-body').click((e)=>{
           if(e.target.classList.contains('delete-post')){
               const slug = e.target.id.split('_')[1];
               const value = `/blogs/${slug}`;
               $('#modal-form').attr('action',value)
                $('#deletePostModal').modal('show');
           }
        });
    });
</script>
@endsection