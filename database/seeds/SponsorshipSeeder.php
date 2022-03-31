<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                'name' => 'bronze',
                'price' => 2.99,
                'time' => 24,
            ],
            [
                'name' => 'silver',
                'price' => 5.99,
                'time' => 72,
            ],
            [
                'name' => 'gold',
                'price' => 9.99,
                'time' => 144,
            ],
        ];
        
        foreach ($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->name = $sponsorship['name'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->time = $sponsorship['time'];
            $newSponsorship->save();
        }
    }
}
