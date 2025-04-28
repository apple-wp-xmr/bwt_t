<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\WeatherParser;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    /**
     * Return today's weather for Zaporizhzhia.
     */
    public function today(): JsonResponse
    {
        // $parser = new WeatherParser();
        // $weather = $parser->parseToday();

        $weather = [
            'temperature' => 22, // градуси Цельсія
            'description' => 'Сонячно',
            'humidity' => 55,    // відсоток вологості
        ];

        return response()->json($weather);
    }
}
