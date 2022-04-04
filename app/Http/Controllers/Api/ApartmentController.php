<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

use Illuminate\Database\Eloquent\Builder;

class ApartmentController extends Controller
{
    public function index()
    {
    }
    public function search(Request $request)
    {
        $data = $request->all();

        $KmRaggio = $data['km'];
        // $distances = $data['apartmentDistances'];
        $rooms = $data['rooms'];
        $beds = $data['beds'];
        $position = $data['position'];



        //aperta chiamata ma non chiusa per avere continui aggiornamenti
        $apartments = Apartment::where('id', '>=', 1);

        //Se esistono i services all'interno di data passati tramite request
        if (array_key_exists('services', $data)) {
            foreach ($data['services'] as $service) {
                $apartments->whereHas('services', function (Builder $query) use ($service) {
                    $query->where('name', '=', $service);
                });
            }
        }


        $apartments = $apartments->with(['services'])->get();

        // $testArray = [];
        // foreach ($apartments as $key => $apartment) {
        //     echo "{$key} => {$apartment}";
        // }
        return response()->json([
            'response' => true,
            // 'count' =>  $apartments->count(),
            'results' =>  [
                'apartments' => $apartments,
                // 'distances' => $distances,
                'rooms' => $rooms,
                'beds' => $beds,
                'raggioKm' => $KmRaggio,
                'position' => $position,             
            ],
        ]);
    }
}
