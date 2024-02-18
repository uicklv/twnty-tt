<?php

namespace App\Classes;

use App\Enums\WeatherDescription;
use App\Interfaces\WeatherInterface;
use App\Jobs\UpdateWeather;
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

                //send log about the weather
                //todo if use not logger - create notification / Mb move this to another job?
                $enums = array_column(WeatherDescription::cases(), 'name');
                if (in_array($main, $enums)) {
                    $employees = $city->country->employees;
                    foreach ($employees as $employee) {
                        Log::info(WeatherDescription::getValueByName($main), ['email' => $employee->email, 'name' => $employee->name]);
                    }
                }

            } catch (\Exception $exception) {
                Log::error("Open Weather API Error", ['message' => $exception->getMessage()]);
                break;
            }
        }
    }
}
