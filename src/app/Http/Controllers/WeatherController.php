<?php

namespace App\Http\Controllers;

use App\Classes\OpenWeather;
use app\OpenWeatherApi;
use Illuminate\Http\Request;


class WeatherController extends Controller
{
    public function update()
    {
        $httpRequestFactory = new RequestFactory();
        $httpClient = GuzzleAdapter::createWithConfig([]);
        $api = new OpenWeatherApi(env('WEATHER_API_KEY'), '');

        $weather = new OpenWeather();
        $weather->getDescription();
    }
}
