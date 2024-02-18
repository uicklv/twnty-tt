<?php

namespace App\Classes;

use App\Interfaces\WeatherInterface;

class WeatherService
{
    public function updateWeather(WeatherInterface $weather)
    {
        $weather->getDescription();
    }
}
