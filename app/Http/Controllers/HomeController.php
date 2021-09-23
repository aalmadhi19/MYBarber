<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use auth;
use App\Http\Requests\StoreReservation;
use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can-book', ['only' => ['create', 'store']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reservations = Reservation::latest()->where('user_id', Auth::id())->paginate(10);
        $canBook = Reservation::canBook();
        $canCancel = Reservation::canCancel();
        $status = Reservation::statuss();
        $setStatus = Reservation::setStatus();

        return view('client.home', compact('reservations', 'canBook', 'status','canCancel'));
    }

    public function create()
    {
        $unavailableDates = Reservation::FormatToBlade();
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
        $autoConfirm = Reservation::autoConfirm();
        if ($autoConfirm == true) {
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
