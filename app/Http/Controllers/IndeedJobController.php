<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndeedJobController extends Controller
{
    public function fetchJobs(Request $request) {
        $apiKey = env('INDEED_API_KEY');
        $query = $request->query('query'); // Job title or keywords
        $location = $request->query('location'); // Location
    
        // Build Indeed API URL with query parameters
        $url = "https://api.indeed.com/ads/apisearch?publisher=$apiKey&q=$query&l=$location&format=json";
    
        // Make an HTTP GET request
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);
        $data = json_decode($response->getBody()->getContents());
    
        return response()->json($data);
    }
    
}
