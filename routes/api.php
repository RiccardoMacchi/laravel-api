<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',[PageController::class, 'index']);
Route::get('/technologies',[PageController::class, 'allTechnologies']);
Route::get('/types',[PageController::class, 'allTypes']);
Route::get('/item-by-slug/{slug}',[PageController::class, 'itemBySlug']);
Route::get('/list-by-type/{slug}',[PageController::class, 'listByType']);
Route::get('/list-by-technology/{slug}',[PageController::class, 'listByTechnology']);




