<?php

namespace App\Classes;

use App\Interfaces\WeatherInterface;
use app\OpenWeatherApi;
use Cmfcmf\OpenWeatherMap;

class OpenWeather implements WeatherInterface
{
    private OpenWeatherApi $api;
    public function __construct(OpenWeatherApi $api)
    {
        $this->api = $api;
    }
    public function getDescription(string $city, ?string $country = null): string
    {
        $wheather = $this->api->getWeatherDescription($city, $country);

        dd($wheather);

        return '';
    }
}
