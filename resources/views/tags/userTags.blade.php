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
    <div class="card-header bg-success text-white">Your Tags</div>
    <div class="card-body">
    <table class="table table-striped" id="myTags">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="tag-table-body">
            @php $i=0;@endphp
            @forelse($user->tags as $tag)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$tag->name}}</td>
                    <td>
                    @can('update',$tag)
                        <button class="btn btn-sm btn-outline-info edit-tag" id="edit_{{$tag->name}}">
                        Edit
                        </button>
                    @endcan
                    @can('delete',$tag)
                        <button class="btn btn-sm btn-outline-danger delete-tag" id="del_{{$tag->name}}">
                        Delete
                        </button>
                    @else
                      Not your tags!
                    @endcan
                    </td>
                </tr>
            @empty
                <tr><td>No tags yet !</td></tr>
            @endforelse
        </tbody>
</table>
       
    </div>
</div>
<!--Tag Delete Modal -->
<div class="modal fade" id="deleteTagModal" tabindex="-1" role="dialog" aria-labelledby="deleteTagModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel">Delete a Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete this tag?</p>
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

<!-- Tag Update Modal -->
<div class="modal fade" id="editTagModal" tabindex="-1" role="dialog" aria-labelledby="editTagModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Update a Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-modal-form" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Tag Name</label>
                <input type="text" name="name" class="form-control tag-name" placeholder="Enter tag name">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-sm btn-dark" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-sm btn-info text-white" value="UPDATE">
            </div>
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
        $('#myTags').DataTable();
        $('#tag-table-body').click((e)=>{
           if(e.target.classList.contains('delete-tag')){
               const name = e.target.id.split('_')[1];
               const value = `/tags/${name}`;
               $('#modal-form').attr('action',value)
                $('#deleteTagModal').modal('show');
           }else if(e.target.classList.contains('edit-tag')){
                const name = e.target.id.split('_')[1];
                const value = `/tags/${name}`;
                $('#edit-modal-form').attr('action',value);
                $('.tag-name').attr('value',name);
                $('#editTagModal').modal('show');
           }
        });
    });
</script>
@endsection