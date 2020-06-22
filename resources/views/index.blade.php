@extends('layout')
@section('content')
@if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

<div class="mt-5 text-center">
	<img src="{{asset('images/cover.jpg')}}" alt="" class="img-fluid" />
</div>
<div class="text-center mt-4">
	<div>
		<h1 class="display-3">Pot Coders</h1>
		<small>A family of tech Bloggers</small>
	</div>
	<p class="lead mt-4">This is <strong>PotCoder</strong>, a website dedicated to the programmers who want to share their knowledge, tips and tricks with the world. Join us today, pour some coffee and write your first blog.</p>
</div>
<div class="m-5 text-center">
<a class="btn btn-outline-success" href="/register">Join Now</a>
</div>
<!-- donate modal -->
<div class="modal fade" id="donationModal" tabindex="-1" role="dialog" aria-labelledby="donationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title text-white" id="exampleModalLabel">Make a Donation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-4">
        <form id="modal-form" method="POST" action="{{route('donation.store')}}">
            @csrf
			<div class="form-group">
				<label for="name">Name</label>
				@auth
				<input type="text" name="name" class="form-control" id="name" value="{{Auth::user()->name}}" disabled>
				@else
				<input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name">
				@endauth
				<div class="invalid-feedback">
					<strong>The name field is required</strong>
				</div>
			</div>
			<div class="form-group">
				<label for="email">Email address</label>
				@auth
				<input type="text" name="email" id="email" class="form-control" value="{{Auth::user()->email}}" disabled>
				@else
				<input type="text" name="email" id="email" class="form-control" placeholder="Enter your email address">
				@endauth
				<div class="invalid-feedback">
					<strong>Invalid Email!</strong>
				</div>
			</div>
			<div class="form-group">
				<label for="amount">Amount</label>
				<input type="range" class="custom-range amount" id="amount" name="amount" min="5" max="100" value="5">
				<p class="selected-amount text-success"><strong>Nrs. 5</strong></p>
			</div>
			<div class="modal-footer">
        	<button type="button" class="btn  btn-sm btn-outline-dark" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-sm btn-success text-white" value="DONATE">
		</div>
        </form>

      </div>
    </div>
  </div>
</div>
<a class="btn btn-success position-fixed text-white" style="left:0;top:10em;" id="opendonationModal"><i class="fas fa-hand-holding-usd fa-2x"></i></a>

@endsection
@section('scripts')
	<script src="{{asset('js/donation.js')}}"></script>
@endsection