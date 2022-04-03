<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            [
                'name' => 'WiFi',
            ],
            [
                'name' => 'Parking',
            ],
            [
                'name' => 'Pool',
            ],
            [
                'name' => 'Reception',
            ],
            [
                'name' => 'Sauna',
            ],
            [
                'name' => 'See view',
            ],
            [
                'name' => 'Bidet',
            ],
            [
                'name' => 'Pillows, blankets extra',
            ],
            [
                'name' => 'Electric iron',
            ],
            [
                'name' => 'Air conditioning',
            ],
            [
                'name' => 'Kitchen',
            ],
            [
                'name' => 'Balcony',
            ],
            [
                'name' => 'TV',
            ],
            [
                'name' => 'Safe',
            ],
            [
                'name' => 'Breakfast',
            ],
            [
                'name' => 'Coffee machine',
            ],
        ];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service['name'];
            $newService->save();
        }
    }
}
