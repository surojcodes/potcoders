@extends('layout')
@section('content')
<div class="text-center container">
    <div>
        <h1 class="display-5">Contact Us</h1>
        <small class="text-success">Send us a mail for any enquiry</small>
        <hr style="width:7%">
    </div>
</div>
<div class="row justify-content-center mb-5">
    <div class="col-md-8">
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success ! </strong>{{session('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <form method="POST" action="{{route('contact.sendmail')}}" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Enter full name" value="{{old('name')}}">
                @error('name')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter your email address" value="{{old('email')}}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">Your message</label>
                <textarea name="message" cols="30" rows="10"
                    class="form-control @error('message') is-invalid @enderror">{{old('message')}}</textarea>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-success" value="Send">
            </div>
        </form>
    </div>
</div>
@endsection