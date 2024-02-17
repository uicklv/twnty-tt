<?php

namespace App\Interfaces;

interface WeatherInterface
{
    public function getDescription(string $city, ?string $country = null): string;
}
