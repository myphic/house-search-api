<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/store/{name?}{bedrooms?}{bathrooms?}{storeys?}{garages?}{priceFrom?}{priceTo?}', [\App\Http\Controllers\HousesController::class, 'store']);
Route::get('/', [\App\Http\Controllers\HousesController::class, 'index']);
Route::get("/create_houses", [\App\Http\Controllers\HousesController::class, 'import']);
