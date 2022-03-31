<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'apartment_id',
        'date',
        'user_ip',
    ];

    public function appartment()
    {
        return $this->belongsTo('App\Apartment');
    }
}
