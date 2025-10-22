<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Cache weather data for 1 hour
        $weather = Cache::remember('weather', now()->addHour(), function () {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => 'Kuressaare', // Change city if needed
                'appid' => config('services.weather.key'),
                'units' => 'metric',
            ]);

            // Optional: check if the API returned an error
            if ($response->failed()) {
                return [
                    'name' => 'Unknown',
                    'main' => ['temp' => 0, 'humidity' => 0],
                    'weather' => [['description' => 'Unable to fetch']],
                    'wind' => ['speed' => 0],
                ];
            }

            return $response->json();
        });

        // Optional debug: uncomment to see the cached API response
        // dd($weather);

        return Inertia::render('Dashboard', [
            'weather' => $weather,
        ]);
    }
}
