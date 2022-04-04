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
        $apartments = Apartment::orderBy('created_at', 'desc')->get();

        return response()->json([
            'response' => true,
            'results' => $apartments,
        ]);
    }
    public function search(Request $request)
    {
        $data = $request->all();

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

        return response()->json([
            'response' => true,
            'count' =>  $apartments->count(),
            'results' =>  [
                'data' => $apartments
            ],
        ]);
    }
    public function show($id)
    {
        $apartment = Apartment::find($id);
        return response()->json([
            'response' => true,
            'count' => $apartment ? 1 : 0,
            'results' =>  [
                'data' => $apartment
            ],
        ]);
    }
}
