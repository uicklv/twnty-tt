<?php

namespace App\Http\Controllers;

use App\Classes\OpenWeather;
use App\Classes\OpenWeatherApi;
use App\Classes\WeatherService;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function update()
    {
        // init open weather api object
        $httpClient = new Client();
        $api = new OpenWeatherApi(env('WEATHER_API_KEY'), $httpClient);

        // init open weather object
        $weather = new OpenWeather($api);

        // call service and update weather
        WeatherService::updateWeather($weather);
    }
}
