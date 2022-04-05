<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Message;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;
use App\User;
use App\Mail\SendMailGuest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Prophecy\Call\Call;

class ContactController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        //$user = User::all();
        return response()->json([
            'response' => true,
            'count' => $user ? 1 : 0,
            'results' =>  [
                'data' => $user
            ],
        ]);
    }

    public function store (Request $request){
            $data = $request->all();
    
            $validator = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email',
                'text' => 'required',
            ]);
     
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            }
            else{
                //salvare la mail nel DB
                $new_lead = new Message();
                $new_lead->fill($data);
                $new_lead->save();
    
                return response()->json([
                    'success' => true
                ]);
            }
        }
    }
