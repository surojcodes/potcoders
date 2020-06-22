<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DonationReceivedEvent
{
    use Dispatchable, SerializesModels;

    public $amount;

    public function __construct($amount)
    {
        $this->amount =$amount;
    }
}
