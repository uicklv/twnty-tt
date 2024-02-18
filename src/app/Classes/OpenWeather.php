<?php

namespace App\Classes;

use App\Interfaces\WeatherInterface;

class OpenWeather implements WeatherInterface
{
    private OpenWeatherApi $api;
    public function __construct(OpenWeatherApi $api)
    {
        $this->api = $api;
    }
    public function getDescription(string $city, ?string $country = null): array
    {
        // prepare query. If isset country - add it to query
        $query = $city . (isset($country) ? ", $country" : "");

        // get coords for location
        [$lat, $lon] = $this->api->getCoords($query);

        // return weather description
        return $this->api->getWeatherDescription($lat, $lon);
    }
}
