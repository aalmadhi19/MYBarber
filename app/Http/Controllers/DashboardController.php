<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\User;
use App\Events\ReservationCanceled;



class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $reservations = Reservation::orderBy('start_date', 'asc')->where('status',NULL)->orWhere('status',1)->get();

        $status = Reservation::statuss();
        Reservation::setStatus();

        return view('admin.dashboard', compact('reservations', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function clients()
    {
        $clients = User::where('id','!=', 1)->get();
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
