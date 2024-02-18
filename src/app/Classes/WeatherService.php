<?php

namespace App\Classes;

use App\Interfaces\WeatherInterface;
use App\Models\City;
use App\Models\Country;
use App\Models\Weather;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    /**
     * @param WeatherInterface $weather
     * @return void
     */
    public static function updateWeather(WeatherInterface $weather): void
    {
        $cities = City::all();
        if ($cities->count() === 0) {
            return;
        }

        //get weather for each city (capital for each country)
        foreach ($cities as $city) {
            try {
                [$main, $description] = $weather->getDescription($city->name);
                //update or create record by country id
                Weather::updateOrCreate(['country_id' => $city->country->id], ['main' => $main, 'description' => $description]);
            } catch (\Exception $exception) {
                Log::error("Open Weather API Error", ['message' => $exception->getMessage()]);
                break;
            }
        }
    }
}
