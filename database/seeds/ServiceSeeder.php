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
                'name' => 'Posto Macchina',
            ],
            [
                'name' => 'Piscina',
            ],
            [
                'name' => 'Portineria',
            ],
            [
                'name' => 'Sauna',
            ],
            [
                'name' => 'Vista Mare',
            ],
            [
                'name' => 'Bidet',
            ],
            [
                'name' => 'Cuscini, coperte extra',
            ],
            [
                'name' => 'Ferro da stiro',
            ],
            [
                'name' => 'Aria condizionata',
            ],
            [
                'name' => 'Cucina',
            ],
            [
                'name' => 'Balcone',
            ],
            [
                'name' => 'TV',
            ],
            [
                'name' => 'Cassaforte',
            ],
            [
                'name' => 'Colazione',
            ],
            [
                'name' => 'Macchina del caffé',
            ],
            [
                'name' => 'Tavolo da pranzo',
            ],
        ];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->name = $service['name'];
            $newService->save();
        }
    }
}
