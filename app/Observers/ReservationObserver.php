<?php

namespace App\Observers;

use App\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationObserver
{

    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Reservation  $product
     * @return void
     */

    public function creating(Reservation $reservation)
    {
        $reservation->user_id = Auth::id();
        $reservation->name = Auth::user()->name;
    }


    /**
     * Handle the reservation "created" event.
     *
     * @param  \App\Reservation  $reservation
     * @return void
     */
    public function created(Reservation $reservation)
    {
        //
    }

    /**
     * Handle the reservation "updated" event.
     *
     * @param  \App\Reservation  $reservation
     * @return void
     */
    public function updated(Reservation $reservation)
    {
        //
    }

    /**
     * Handle the reservation "deleted" event.
     *
     * @param  \App\Reservation  $reservation
     * @return void
     */
    public function deleted(Reservation $reservation)
    {
        //
    }

    /**
     * Handle the reservation "restored" event.
     *
     * @param  \App\Reservation  $reservation
     * @return void
     */
    public function restored(Reservation $reservation)
    {
        //
    }

    /**
     * Handle the reservation "force deleted" event.
     *
     * @param  \App\Reservation  $reservation
     * @return void
     */
    public function forceDeleted(Reservation $reservation)
    {
        //
    }
}
