<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'price',
        'rooms',
        'beds',
        'bathrooms',
        'square',
        'address',
        'latitude',
        'longitude',
        'image',
        'visible',
        'slug',
        'created_at',
        'updated_at',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function createSlug($title)
    {
        $slug = Str::slug($title, '-');
        $oldApartment = Apartment::where('slug', $slug)->first();

        $counter = 0;
        while ($oldApartment) {
            $newSlug = $slug . '-' . $counter;
            $oldApartment = Apartment::where('slug', $newSlug)->first();
            $counter++;
        }

        return (empty($newSlug)) ? $slug : $newSlug;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function statistics()
    {
        return $this->hasMany('App\Statistic');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

    public function sponsorships()
    {
        return $this->belongsToMany('App\Sponsorship');
    }
}
