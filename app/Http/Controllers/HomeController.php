<?php

namespace App\Http\Controllers;

use auth;
use App\Reservation;
use App\Http\Requests\StoreReservation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('can-book', ['only' => ['create', 'store']]);
    }

    public function index()
    {
        $reservations = Reservation::active()->latest()->where('user_id', Auth::id())->paginate(10);
        $setStatus = Reservation::setStatus();
        return view('client.home', compact('reservations'));
    }

    public function create()
    {
        $unavailableDates = Reservation::formatToBlade();
        return view('client.reservation', compact('unavailableDates'));
    }

    public function store(StoreReservation $request)
    {
        if ($request->type == 'all') {
            $start_date = strtotime($request->start_date);
            $end_date = date("y-m-d H:i", strtotime('+15 minutes', $start_date));
            $request->merge(['end_date' => $end_date]);
        }

        $reservation = Reservation::create($request->all());

        if (Reservation::autoConfirm() == true) {
            $reservation = Reservation::find($reservation->id);
            $reservation->status = 1;
            $reservation->update();
        }

        return redirect(route('home'))->with('success', 'تم الحجز');
    }


    public function destroy($id)
    {
        Reservation::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect(route('home'))->with('success', 'تم الالغاء');
    }
}
