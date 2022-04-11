<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

class FactRepository implements FactRepositoryInterface
{
    private $endpoint = "https://catfact.ninja";

    public function get($limit)
    {
        $facts = [];

        $response = Http::acceptJson()->get($this->endpoint . '/facts', [
            'max_length' => '140',
            'limit' => $limit,
        ]);

        // process api to model
        if ($response->successful()) {
            // continue to process and return it.
            if (count($response['data']) > 0) {
                // iterate the data set, format data to pass
                foreach ($response['data'] as $item) {
                    //(could use a model/class for the structure)
                    $facts[] = array('fact' => $item['fact']);
                }
                return $facts;
            } else {
                return $facts['error'] = "no results";
            }
        } else {
            return $facts['error'] = "no results";;   // error response.
        }

        // fail safe
        return $response['error'] = "unknown";
    }
}
