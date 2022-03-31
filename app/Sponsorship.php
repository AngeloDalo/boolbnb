<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'name',
        'price',
        'time',
        'created_at',
        'updated_at',
    ];

    public function apartaments() {
        return $this->belongsToMany('App\Apartment');
    }
}
