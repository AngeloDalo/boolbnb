<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $newUser = new User();
        $newUser->username = 'Mario-Rossi';
        $newUser->name = 'Mario Rossi';
        $newUser->date_of_birth = '1999-12-25';
        $newUser->email = 'mariorossi@gmail.com';
        $string = '12345678';
        $newUser->password = Hash::make($string);
        $newUser->save();

        for ($i = 0; $i < 20; $i++) {
            $newUser = new User();
            $newUser->username = $faker->userName();
            $newUser->name = $faker->name();
            $newUser->date_of_birth = $faker->date('Y-m-d');
            $newUser->email = $faker->email();
            $string = '123_FC76';
            $newUser->password = Hash::make($string);
            $newUser->save();
        }
    }
}
