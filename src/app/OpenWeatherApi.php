<?php

namespace app;

use Cmfcmf\OpenWeatherMap;

class OpenWeatherApi
{
    private $httpRequestFactory;
    private $httpClient;
    private string $apiKey;

    public function __construct(string $apiKey, $httpRequestFactory, $httpClient)
    {
       $this->apiKey = $apiKey;
       $this->httpRequestFactory = $httpRequestFactory;
       $this->httpClient = $httpClient;
    }

    public function getWeatherDescription(string $city, ?string $country = null)
    {
        $owm = new OpenWeatherMap($this->apiKey, $this->httpClient, $this->httpRequestFactory);
        $weather = $owm->getWeather('Berlin', 'metric', 'de');

        return $weather;
    }
}
