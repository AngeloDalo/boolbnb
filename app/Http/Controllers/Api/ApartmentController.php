<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Builder;

class ApartmentController extends Controller
{
    public function index()
    {
        $apartments = Apartment::orderBy('created_at', 'desc')->get();

        return response()->json([
            'response' => true,
            'results' => $apartments,
        ]);
    }
    public function search(Request $request)
    {
        $data = $request->all();

        $KmRaggio = $data['km'];
        $rooms = $data['rooms'];
        $beds = $data['beds'];
        $position = $data['position'];
        $searchedLat = $position['lat'];
        $searchedLng = $position['lng'];
        $apartmentDistance = [];
        $checkedSer = $data['checkedServices'];
        


        //aperta chiamata ma non chiusa per avere continui aggiornamenti
        $apartments = Apartment::where('id', '>=', 1);

        
        $apartments = $apartments->with('services')->where('visible', '=', 1)->where('rooms', '>=', $rooms)->where('beds', '>=', $beds);
        foreach ($data['checkedServices'] as $service) {
            $apartments = $apartments->whereHas('services', function (Builder $query) use ($service) {
                $query->where('name', '=', $service);
            });
        }
        $apartments = $apartments->get();
        
        foreach ($apartments as $key => $apartment) {
            $apartmentLat = floatval($apartment->latitude);
            $apartmentLng = floatval($apartment->longitude);
            $distance = distance($searchedLat, $searchedLng, $apartmentLat, $apartmentLng);
            if ($distance > $KmRaggio) {
                $apartments = $apartments->except($apartment->id);
            } else {
                array_push($apartmentDistance, $distance);
            }
        }

        return response()->json([
            'response' => true,
            'results' =>  [
                'apartments' => $apartments,
                'data' => $data,
                'checkedser' => $checkedSer
            ],
        ]);
    }
}
function distance($lat1, $lon1, $lat2, $lon2)
{
    $r = 6372.797; // mean radius of Earth in km
    $latFrom = deg2rad($lat1);
    $lonFrom = deg2rad($lon1);
    $latTo = deg2rad($lat2);
    $lonTo = deg2rad($lon2);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $r;
}