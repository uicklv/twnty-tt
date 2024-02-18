<?php

namespace App\Classes;

class OpenWeatherApi
{
    private string $geoUrl = 'http://api.openweathermap.org/geo/1.0/direct';
    private string $weatherUrl = 'http://api.openweathermap.org/geo/1.0/direct';
    private object $httpClient;
    private string $apiKey;

    public function __construct(string $apiKey, object $httpClient)
    {
       $this->apiKey = $apiKey;
       $this->httpClient = $httpClient;
    }

    public function getCoords(string $query)
    {
        $response = $this->httpClient->get($this->geoUrl,[
            'query' => ['q' => $query, 'limit' => 1, 'appid' => $this->apiKey]
        ]);

        echo $response->getBody()->getContents();
        exit;
    }

    public function getWeatherDescription(string $city, ?string $country = null)
    {
        $owm = new OpenWeatherMap($this->apiKey, $this->httpClient, $this->httpRequestFactory);
        $weather = $owm->getWeather($city);

        return $weather;
    }
}
