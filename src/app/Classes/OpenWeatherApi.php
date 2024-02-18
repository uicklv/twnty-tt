<?php

namespace App\Classes;

class OpenWeatherApi
{
    private string $geoUrl = 'http://api.openweathermap.org/geo/1.0/direct';
    private string $weatherUrl = 'https://api.openweathermap.org/data/2.5/weather';
    private object $httpClient;
    private string $apiKey;

    public function __construct(string $apiKey, object $httpClient)
    {
       $this->apiKey = $apiKey;
       $this->httpClient = $httpClient;
    }

    /**
     * get coords for location
     * @param string $query
     * @return array
     * @throws \Exception
     */
    public function getCoords(string $query): array
    {
        $response = $this->httpClient->get($this->geoUrl, [
            'query' => ['q' => $query, 'limit' => 1, 'appid' => $this->apiKey]
        ]);

        $response = json_decode($response->getBody()->getContents())[0];

        //check if response contains lat and lon for query
        if (!isset($response->lat) || !isset($response->lon)) {
            throw new \Exception('Invalid result when get coords');
        }

        return [$response->lat, $response->lon];
    }

    /**
     * get weather description
     * @param float $lat
     * @param float $lon
     * @return array
     * @throws \Exception
     */
    public function getWeatherDescription(float $lat, float $lon): array
    {
        // get weather by coords
        $response = $this->httpClient->get($this->weatherUrl, [
            'query' => ['lat' => $lat, 'lon' => $lon, 'appid' => $this->apiKey]
        ]);

        $response = json_decode($response->getBody()->getContents());

        //check if response contains lat and lon for query
        if (!isset($response->weather[0])) {
            throw new \Exception('Invalid result when get weather');
        }

        $weather = $response->weather[0];

        return [$weather->main, $weather->description];
    }
}
