<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CatFactsService
{

    protected $endpoint = "https://catfact.ninja";

    /*
    public function getRandomCatFact($limit)
    {
        $httpClient = new \GuzzleHttp\Client();
        $request =
            $httpClient
            ->get("https://catfact.ninja/facts?max_length=1000&limit=${limit}");

        $response = json_decode($request->getBody()->getContents());

        return $response->{'data'};
    }
    */

    // this needs to convert to a model, laravel resource instead of returning array dump.
    // model for facts, when getting the json from api, build each to a model to make sure data is valid with proper keys
    // error handling as well.

    public function getCatBreeds($limit)
    {
        // this is another set from the api we could build into the app.
        $response = Http::acceptJson()->get($this->endpoint . '/breeds', [
            'limit' => $limit
        ]);

        return $response['data'];
    }

    public function getCatFacts($limit)
    {
        //?max_length=140&limit=${limit}
        $response = Http::acceptJson()->get($this->endpoint . '/facts', [
            'max_length' => '140',
            'limit' => $limit,
        ]);

        // process api to model
        if ($response->successful()) {
            // continue to process and return it.
        } else {
            return false;   // error response.
        }

        return $response['data'];
    }
}
