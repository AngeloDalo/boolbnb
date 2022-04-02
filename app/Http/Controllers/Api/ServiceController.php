<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use Illuminate\Database\Eloquent\Builder;

class ServiceController extends Controller
{
    public function index() {
        $services = Service::all();
        
        return response()->json([
            'response' => true,
            'results' => $services,
        ]);
    }
    
}
