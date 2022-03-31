<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'apartment_id',
        'name',
        'email',
        'created_at',
        'updated_at',
    ];

    public function appartment()
    {
        return $this->belongsTo('App\Apartment');
    }
}
