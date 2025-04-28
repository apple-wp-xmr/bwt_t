<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WeatherParserService;
use Illuminate\Http\Request;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    /**
     * Return today's weather for Zaporizhzhia.
     */
    public function today(): JsonResponse
    {
        $weather = Cache::remember('weather_zaporizhia_now', 3600, function () {
            $parser = new WeatherParserService();
            return $parser->parseNow();
        });

        return response()->json($weather);
    }
}
