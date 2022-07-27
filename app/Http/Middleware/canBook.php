<?php

namespace App\Http\Middleware;

use Closure;
use App\Reservation;
use Alert;

class CanBook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->reservations()->whereIn('status', [Reservation::NEW, Reservation::CONFIRMED])->exists()) {

            Alert::error('عفواً ', 'يوجد لديك طلب سابق')->autoClose(1500);

            return redirect()->back();
        }
        return $next($request);
    }
}
