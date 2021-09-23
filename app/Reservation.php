<?php

namespace App;

use auth;
use App\Settings;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 'name', 'start_date', 'end_date', 'time', 'type'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function statuss()
    {
        return [
            null =>  __('lang.new'),
            1 =>  __('lang.confirmed'),
            2 =>  __('lang.canceled'),
            3 => __('lang.finished')
        ];
    }
    public static function canBook()
    {
        if (Reservation::whereUser_id(Auth::id())->where('status', NULL)->orWhere('status', 1)->exists()) {
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
        $unavailableDatess;
        return $unavailableDatess ?? '01/01/2020:12:12';
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
        Reservation::whereStatus(null)->Orwhere('status',1)->where('start_date', '<', now())->update(['status' => 3]);
    }

    public static function autoConfirm()
    {
        $autoConfirm = Settings::where('id', 1)->first();

        if ($autoConfirm->status == 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function canCancel()
    {

        if (Reservation::where('status', null)->Orwhere('status', 1)->whereUser_id(Auth::id())->where('start_date', '<', Carbon::now()->addHour(1))->exists()) {
            return false;
        } else {
            return true;
        }
    }
}
