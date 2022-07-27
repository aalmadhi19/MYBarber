<?php

namespace App\Http\Controllers;

use App\User;
use App\Reservation;
use App\Events\ReservationCanceled;


class DashboardController extends Controller
{
    public function index()
    {
        Reservation::setStatus();
        $reservations = Reservation::orderBy('start_date', 'asc')->active()->get();
        return view('admin.dashboard', compact('reservations'));
    }

    public function clients()
    {
        $clients = User::NotAdmin()->get();
        return view('admin.clients', compact('clients'));
    }

    public function cancel($id)
    {
        Reservation::where('id', $id)->update(['status' => 2]);
        $user = Reservation::find($id)->user()->first();
        event(new ReservationCanceled($user->email));
        return redirect('dashboard')->with('cancel', 'success');
    }

    public function confirm($id)
    {
        Reservation::where('id', $id)->update(['status' => 1]);
        return redirect('dashboard')->with('confirm', 'success');
    }

    public function block($id)
    {
        User::where('id', $id)->update(['blocked' => 1]);
        Reservation::where('user_id', $id)->delete();
        return redirect()->back()->with('blocked', 'success');
    }

    public function unblock($id)
    {
        User::where('id', $id)->update(['blocked' => null]);
        return redirect()->back()->with('unblocked', 'success');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
