<?php

namespace App\Http\Controllers;

use App\Repositories\FactRepository;

class CatController extends Controller
{
    protected $facts;

    public function __construct()
    {
        $this->facts = new FactRepository();
    }

    // method will return json formatted data for ajax / api use
    public function json($limit = 1)
    {
        // quick basic data safe check,
        $limit = is_numeric($limit) ? $limit : -1;

        if ($limit) {
            return response()->json([
                'data' => $this->facts->get($limit),
                'limit' => $limit,
            ]);
        } else {
            // debug / response
            return response()->json([
                'data' => 'Invalid input',
                'check' => is_numeric($limit),
                'limit' => $limit
            ]);
        }
    }
}
