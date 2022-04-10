<?php

namespace App\Services;

class CatFactsService
{

    public function getRandomCatFact($limit)
    {
        $httpClient = new \GuzzleHttp\Client();
        $request =
            $httpClient
            ->get("https://catfact.ninja/facts?max_length=1000&limit=${limit}");

        $response = json_decode($request->getBody()->getContents());

        return $response->{'data'};
    }
}
