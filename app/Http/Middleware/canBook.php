<?php

namespace App\Http\Middleware;

use Closure;
use App\Reservation;
use auth;
Use Alert;
class canBook
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
        if (Reservation::whereUser_id(Auth::id())->where('status', null)->exists()) {
            Alert::error('عفواً ', 'يوجد لديك طلب سابق')->autoClose(1500);

            return redirect()->back();
        }
        return $next($request);
    }
}
