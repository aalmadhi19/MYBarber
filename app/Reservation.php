<?php

namespace App;

use App\Settings;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $appends = ['status_text'];

    protected $fillable = [
        'user_id', 'name', 'start_date', 'end_date', 'time', 'type'
    ];

    const NEW = 0;
    const CONFIRMED = 1;
    const CANCELED = 2;
    const FINISHED = 3;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function unavailableDates()
    {
        $start_date = Reservation::whereIn('status', [self::NEW, self::CONFIRMED])->pluck('start_date')->toArray();
        $end_date = Reservation::whereIn('status', [self::NEW, self::CONFIRMED])->pluck('end_date')->toArray();
        return array_merge($start_date, $end_date);
    }


    public static function formatToBlade()
    {
        $unavailableDates = self::unavailableDates();
        foreach ($unavailableDates as $date) {
            $unavailableDatess[] = Carbon::parse($date)->format('m/d/Y:H:i');
        }
        return $unavailableDatess ?? '01/01/2020:12:12';
    }

    public static function formatToValidation()
    {
        $unavailableDates = self::unavailableDates();
        foreach ($unavailableDates as $date) {
            $unavailableDatess[] = Carbon::parse($date)->format('y-m-d H:i');
        }
        return $unavailableDatess  ?? '2020-01-01 12:12';
    }


    public static function canBook()
    {
        return auth()->user()->reservations()->whereIn('status', [self::NEW, self::CONFIRMED])->exists();
    }

    public static function setStatus()
    {
        Reservation::active()->where('start_date', '<', now())->update(['status' => 3]);
    }

    public static function autoConfirm()
    {
        return Settings::where('name', 'Auto Confirmation')->first()->status;
    }


    public function getStatusTextAttribute()
    {
        $statuses = [
            0 =>  __('lang.new'),
            1 =>  __('lang.confirmed'),
            2 =>  __('lang.canceled'),
            3 => __('lang.finished')
        ];
        return $statuses[$this->status];
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', [self::NEW, self::CONFIRMED]);
    }
}
