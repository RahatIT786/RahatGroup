<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getApiData()
    {
        $apiKey = '6125653979b8eb-b91b-4970-8e1f-6fb81c9e4b7e'; // Replace with your actual API key
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey
        ])->get('https://apitest.tripjack.com/hms/v1/nationality-info?');
        dd($response->body());
        if ($response->successful()) {
            return $response->json();
        } elseif ($response->status() === 403) {
            return response()->json([
                'error' => 'Invalid Access. Check your API key or token expiration.'
            ], 403);
        } else {
            return response()->json([
                'error' => 'Failed to fetch data. Status code: ' . $response->status()
            ], $response->status());
        }
    }
}
