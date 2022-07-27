<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    const DISABLED = 0;
    const ENABLED = 1;

    protected $fillable = [
        'id', 'name', 'description', 'data', 'status'
    ];

    public function getStatusTextAttribute()
    {
        $statuses = [
            0 =>  __('lang.disabled'),
            1 =>  __('lang.enabled'),
        ];
        return $statuses[$this->status];
    }
}
