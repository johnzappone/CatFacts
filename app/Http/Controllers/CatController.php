<?php

namespace App\Http\Controllers;

use App\Services\CatFactsService;

class CatController extends Controller
{
    public function index($limit = 1)
    {

        // error handling , check to make sure its an int and no bad data.
        if ($limit > 0) {
        } else {
            $limit = 1;
        }

        $catFactData = new CatFactsService();
        $randomCats = $catFactData->getRandomCatFact($limit);

        return view('index', [

            'randomCats' => $randomCats
        ]);
    }


    public function json($limit)
    {
        if ($limit > 0) {
        } else {
            $limit = 1;
        }

        $catFactData = new CatFactsService();
        $randomCats = $catFactData->getRandomCatFact($limit);

        return $randomCats;
    }
}
