<?php

namespace App\Http\Controllers;

use App\Classes\OpenWeather;
use App\Classes\OpenWeatherApi;
use App\Classes\WeatherService;
use App\Jobs\UpdateWeather;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function update()
    {
        // init job for update weather
        UpdateWeather::dispatch(env('WEATHER_API_KEY'));
    }
}
