<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Database\Eloquent\Builder;

class ApartmentController extends Controller
{
    public function index(Request $request) {
        // $apartments = Apartment::orderBy('created_at', 'desc')->get();
        // return response()->json([
        //     'response' => true,
        //     'results' => $apartments
        // ]);
        $result = $request->all();
        return response()->json([
            'response' => true,
            'results' => $result,
        ]);
    }
    public function filteredApartment() {

    }
}
