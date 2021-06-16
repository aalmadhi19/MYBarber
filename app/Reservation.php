<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use auth;
use Illuminate\Support\Carbon;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'name', 'start_date','end_date', 'time', 'type'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function statuss()
    {
        return [
            null =>  __('lang.confirmed'),
            1 => '',
            2 =>  __('lang.canceled'),
            3 => __('lang.finished')
        ];
    }
    public static function canBook()
    {
        if (Reservation::whereUser_id(Auth::id())->where('status', null)->exists()) {
            return false;
        } else {
            return true;
        }
    }

    public static function unavailableDates()
    {
        $start_date = Reservation::whereStatus(null)->pluck('start_date')->toarray();
        $end_date = Reservation::whereStatus(null)->pluck('end_date')->toarray();
        $unavailableDates = array_merge($start_date, $end_date);

        return $unavailableDates;
    }

    public static function FormatToBlade()
    {
        $unavailableDates = self::unavailableDates();
        foreach ($unavailableDates as $date) {
            $unavailableDatess[] = Carbon::parse($date)->format('m/d/Y:H:i');
        }
        $unavailableDatess ;
        return $unavailableDatess ?? '01/01/2020:12:12'  ;


    }

    public static function FormatToValidation()
    {
        $unavailableDates = self::unavailableDates();
        foreach ($unavailableDates as $date) {
            $unavailableDatess[] = Carbon::parse($date)->format('y-m-d H:i');
        }
        return $unavailableDatess  ?? '2020-01-01 12:12';
    }

    public static function setStatus()
    {
        Reservation::where('status', null)->where('start_date', '<', now())->update(['status' => 3]);
    }
}
