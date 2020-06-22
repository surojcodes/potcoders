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
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

<div class="row card mt-5 mb-5">
        <div class="card-header bg-success text-white">
            Dashboard
            <span class="float-right">Points:<strong> {{Auth::user()->points['point']??0}}</strong> </span>
        </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <h4>Blog</h4>
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{route('user.blogs',Auth::user()->name)}}" class="btn"> <i class="fas fa-eye"></i> View My Posts (includes update and delete)</a></li>
                            <li class="list-group-item"><a href="{{route('blog.create')}}" class="btn"> <i class="fas fa-plus"></i> Create Blog Post</a></li>
                        </ul>

                        <h4 class="mt-4">Tags</h4>
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{route('user.tags',Auth::user()->name)}}" class="btn"> <i class="fas fa-eye"></i> View My Tags (includes update and delete)</a></li>
                            <li class="list-group-item"><a href="{{route('tag.create')}}" class="btn"> <i class="fas fa-plus"></i> Create a New Tag</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h4 class="text-center"><i class="fas fa-bell"></i>Notifications</h4>
                        <div class="text-right mb-2">
                            <a href="{{route('markall.read')}}"><i class="far fa-check-square mr-1"></i>Mark all read</a>
                        </div>
                        <ul class="list-group">
                        @forelse(Auth::user()->unreadNotifications as $notification)
                        <li class="list-group-item">
                            @if($notification->type === 'App\Notifications\DonationReceived')
                                We have received a payment of Nrs. {{$notification->data['amount']}} from you.
                                <a href="{{route('markone.read',$notification->id)}}" class="float-right"><i class="far fa-check-square"></i></a>
                            @endif
                        </li>
                        @empty
                            <li class="list-group-item">No unread Notifications!</li>
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
