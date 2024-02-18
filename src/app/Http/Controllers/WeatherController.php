<?php

namespace App\Http\Controllers;

use App\Classes\OpenWeather;
use App\Classes\OpenWeatherApi;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function update()
    {
        $httpClient = new Client();
        $api = new OpenWeatherApi(env('WEATHER_API_KEY'), $httpClient);

        $api->getCoords('Lviv');

        $weather = new OpenWeather($api);
        $weather->getDescription();
    }
}
