<?php

namespace App\Listeners;

use App\Events\DonationReceivedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Point;
use Auth;

class PointIncrement
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DontaionReceivedEvent  $event
     * @return void
     */
    public function handle(DonationReceivedEvent $event)
    {
        //increase the point by donation amount
        $user = Auth::user();
        $points = Point::where('user_id',$user->id)->first();
        $points->point+=$event->amount;
        $points->save();
    }
}
