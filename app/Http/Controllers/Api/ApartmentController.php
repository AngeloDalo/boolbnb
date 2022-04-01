<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Database\Eloquent\Builder;

class ApartmentController extends Controller
{
    public function index($lng, $lat) {
        $apartmentsFiltered = [];
        $searchingLat = floatval(str_replace(".", ",", $lat));
        $searchingLng = floatval(str_replace(".", ",", $lng));
        $apartments = Apartment::orderBy('created_at', 'desc')->get();
        
        foreach ($apartments as $apartment) {
            // var_dump($apartment['latitude']);
            // var_dump($apartment['longitude']);
            $apartmentLat = floatval(str_replace(".", ",", $apartment['latitude']));
            $apartmentLng = floatval(str_replace(".", ",", $apartment['longitude']));

            
            $distance = sqrt(pow(($apartmentLat - $searchingLat), 2) + pow(($apartmentLng - $searchingLng), 2));
            // var_dump(pow(($apartmentLat - $searchingLat),2));
            // var_dump(pow(($apartmentLng - $searchingLng), 2));
            var_dump($distance / 1000);


        }
        
        // return response()->json([
        //     'response' => true,
        //     'results' => $position,
        // ]);
    }
}
