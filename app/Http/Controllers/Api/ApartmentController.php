<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Database\Eloquent\Builder;

class ApartmentController extends Controller
{
    public function index($lng, $lat)
    {
        $apartmentsFiltered = [];
        $lat1 = $lat;
        $lon1 = $lng;
        $apartments = Apartment::orderBy('created_at', 'desc')->get();

        foreach ($apartments as $apartment) {
            $lat2 = $apartment['latitude'];
            $lon2 = $apartment['longitude'];
            $distance = rad2deg(acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($lon1 - $lon2)))) * 60 * 1.1515;
            var_dump($distance * 1.609344);
        }

        // return response()->json([
        //     'response' => true,
        //     'results' => $position,
        // ]);
    }
}
