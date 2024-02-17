<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $cities = [
          'Ukraine' => 'Kyiv',
          'United Kingdom' => 'London',
          'Germany' => 'Berlin',
          'Netherlands' => 'Amsterdam',
        ];

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => Hash::make('password')
         ]);

         // create country and city
         foreach($cities as $countryName => $city) {
             $country = Country::create(['name' => $countryName]);
             City::create(['country_id' => $country->id, 'name' => $city]);
         }

//        \App\Models\Country::factory(5)->create();
//        \App\Models\City::factory(5)->create();

        \App\Models\Position::factory(5)->create();
        \App\Models\Employee::factory(50)->create();
    }
}
