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


Route::get('/catfacts', function (Request $request) {
    return response()->json([
        'data' => 'A Random Fact'
    ]);
});


Route::get('/cats/{limit}', function ($factLimt) {

    $catFactData = new CatController();
    $randomCats = $catFactData->json($factLimt);

    return response()->json([
        'data' => $randomCats,
        'limit' => $factLimt
    ]);
});