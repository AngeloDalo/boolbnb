<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Apartment;
use App\Service;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = Apartment::all();
        foreach($apartments as $apartment) {
            $services = Service::inRandomOrder()->limit(5)->get();
            $apartment->services()->attach($services);
        }
    }
}
