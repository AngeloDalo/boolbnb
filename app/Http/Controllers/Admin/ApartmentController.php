<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Apartment;
use App\Sponsorship;
use App\Service;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prophecy\Call\Call;
use App\Message;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::user()->id)->get();
        $apartments_sponsor = Apartment::where('user_id', Auth::user()->id)->with('sponsorship')->get();
            foreach ($apartments_sponsor as $apartment_sponsor) {
                if(count($apartment_sponsor->sponsorship) > 0) {
                    $end_sponsor = $apartment_sponsor->sponsorship[0]->pivot->end_date;
                    if (strlen($end_sponsor) > 0) {
                        foreach ($apartments as $apartment) {
                            if ($apartment->id == $apartment_sponsor->id) {
                                $apartment['end_date'] = $end_sponsor;
                            }
                        }   
                    }
                }
            }  
        // $apartment_sponsor = Apartment::with('sponsorship')->get();
        return view('admin.apartments.index', ['apartments' => $apartments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', ['services' => $services]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'price' => 'required',
            'rooms' => 'required',
            'beds' => 'required',
            'bathrooms' => 'required',
            'address' => 'required|max:255',
            'square' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'visible' => 'required|numeric|min:0|max:1',
            'image' => 'nullable|image',
            'services.*' => 'nullable|exists:App\Service,id',
        ]);
        if (!empty($data['image'])) {
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        } else {
            $data['image'] = 'uploads/default.jpg';
        }
        $apartment = new Apartment();
        $apartment->fill($data);
        $apartment->slug = $apartment->createSlug($data['title']);
        $apartment->save();
        if (!empty($data['services'])) {
            $apartment->services()->attach($data['services']);
        }
        return redirect()->route('admin.apartments.show', $apartment->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $messages = Message::where('apartment_id', '=', $apartment->id)->get();
        //var_dump($messages);
        // $services = Service::where();
        if (Auth::user()->id != $apartment->user_id) {
            return redirect()->route('admin.apartments.index');
        }
        return view('admin.apartments.show', ['apartment' => $apartment, 'messages' => $messages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        if (Auth::user()->id != $apartment->user_id) {
            return redirect()->route('admin.apartments.index');
        }
        $services = Service::all();
        return view('admin.apartments.edit', ['apartment' => $apartment, 'services' => $services]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data = $request->all();
        if (Auth::user()->id != $apartment->user_id) {
            return redirect()->route('admin.apartments.index');
        }
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'price' => 'required',
            'rooms' => 'required',
            'beds' => 'required',
            'bathrooms' => 'required',
            'square' => 'required',
            'address' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
            'visible' => 'required|numeric|min:0|max:1',
            'image' => 'nullable|image',
            'services.*' => 'nullable|exists:App\Service,id',
        ]);
        if ($data['title'] != $apartment->title) {
            $apartment->title = $data['title'];
            $apartment->slug = $apartment->createSlug($data['title']);
        }

        if ($data['price'] != $apartment->price) {
            $apartment->price = $data['price'];
        }
        if ($data['rooms'] != $apartment->rooms) {
            $apartment->rooms = $data['rooms'];
        }
        if ($data['beds'] != $apartment->beds) {
            $apartment->beds = $data['beds'];
        }
        if ($data['bathrooms'] != $apartment->bathrooms) {
            $apartment->bathrooms = $data['bathrooms'];
        }
        if ($data['square'] != $apartment->square) {
            $apartment->square = $data['square'];
        }
        if ($data['address'] != $apartment->address) {
            $apartment->address = $data['address'];
        }
        if ($data['latitude'] != $apartment->latitude) {
            $apartment->latitude = $data['latitude'];
        }
        if ($data['longitude'] != $apartment->longitude) {
            $apartment->longitude = $data['longitude'];
        }
        if ($data['visible'] != $apartment->visible) {
            $apartment->visible = $data['visible'];
        }
        if (!empty($data['image'])) {
            Storage::delete($apartment->image);

            $img_path = Storage::put('uploads', $data['image']);
            $apartment->image = $img_path;
        }
        $apartment->update();
        if (!empty($data['services'])) {
            $apartment->services()->sync($data['services']);
        } else {
            $apartment->services()->detach();
        }
        return redirect()->route('admin.apartments.show', $apartment->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
