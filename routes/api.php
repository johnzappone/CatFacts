<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CatController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/cats/{limit}', function ($factLimt) {

    $catService = new CatController();
    $catFactData = $catService->json($factLimt);


    // need error handling here, make sure its in limit, if error / unable to reach return error message.

    return response()->json([
        'data' => $catFactData,
        'limit' => $factLimt
    ]);
});
