<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    public function apartaments() {
        return $this->belongsToMany('App\Apartment');
    }
}
