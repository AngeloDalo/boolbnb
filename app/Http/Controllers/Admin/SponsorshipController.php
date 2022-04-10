<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use Illuminate\Support\Facades\Auth;
use App\Sponsorship;
use Braintree;
use Carbon\Carbon;
use App\User;

class sponsorshipController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $apartment = Apartment::with('sponsorship')->find($id);
        $user_log = Auth::user();
        $sponsorships = Sponsorship::all();
        $user_id = $user_log['id'];

        if ($apartment == null || count($apartment->sponsorship) > 0) {
            return abort(403, 'Apartment does not exist or has already an active sponsorship.');
        } elseif ($apartment != null && $apartment['user_id'] == $user_id) {
            return view('admin.sponsorships.edit', compact('apartment', 'sponsorships'));
        }
        abort(404);
    }

    public function update(Request $request, $id)
    {
        $user = User::find(Auth::id());
        $data = $request->all();
        $apartment = Apartment::find($id);
        $sponsorship = Sponsorship::find($data['Sponsorship']);
        $pay_type = 'card';
        // $pay_transaction =  $data['_token'];
        $pay_transaction = 1;
        $apartment->sponsorship()->attach($data['Sponsorship'], ['start_date' => Carbon::now(), 'end_date' => Carbon::now()->addHours($sponsorship['time']), 'pay_type'=>$pay_type, 'pay_transaction' => $pay_transaction ]);
        return redirect()->route('admin.apartments.index');
    }
}