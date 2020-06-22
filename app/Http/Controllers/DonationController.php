<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Notifications\DonationReceived;
use App\Events\DonationReceivedEvent;


class DonationController extends Controller
{
    public function store(){
        if($user = Auth::user()){
            $user->notify(new DonationReceived($user,request('amount')));
        }

        // dispatch an event to add points to user
        event(new DonationReceivedEvent(request('amount')));

        return back()->with('success','Donation Received!');
    }
    public function markAllRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success','All notification marked as read!');
    }
    public function markOneRead($id){
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        return back()->with('success','Notification marked as read!');
    }
}
