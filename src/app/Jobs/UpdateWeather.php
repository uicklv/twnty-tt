<?php

namespace App\Jobs;

use App\Classes\OpenWeather;
use App\Classes\OpenWeatherApi;
use App\Classes\WeatherService;
use App\Interfaces\WeatherInterface;
use App\Models\City;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateWeather implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $apiKey,
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // init open weather api object
        $httpClient = new Client();
        $api = new OpenWeatherApi($this->apiKey, $httpClient);

        // init open weather object
        $weather = new OpenWeather($api);

        // call service and update weather
        WeatherService::updateWeather($weather);
    }
}
