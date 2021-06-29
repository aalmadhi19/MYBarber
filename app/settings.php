<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{

    protected $fillable = [
        'id', 'name', 'description','data', 'status'
    ];

    public static function statusText()
    {
        $data = [
            0 => __('lang.disabled'),
            1 => __('lang.enabled'),
            // 2 => __('messages.femaldisablede'),
        ];
        return $data;
    }
}
