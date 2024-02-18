<?php

namespace App\Interfaces;

interface WeatherInterface
{
    /**
     * should return array like ['main title', 'main description']
     * @param string $city
     * @param string|null $country
     * @return array
     */
    public function getDescription(string $city, ?string $country = null): array;
}
