<?php

namespace App\Listeners;

use App\Events\ChangeItemQuantityEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class ChangeItemQuantityListener
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
     * @param  ChangeItemQuantityEvent  $event
     * @return void
     */
    public function handle(ChangeItemQuantityEvent $event)
    {
        //
        Log::info($event->item.' changed to quantity of '.$event->newQuantity);
    }
}
