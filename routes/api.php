<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return ['message' => "API works !"];
});

/**
 * Auth
 */

// Route::post('/register', 'AuthController@register');
// Route::post('/login', 'AuthController@login');
// Route::middleware('auth:sanctum')->post('/logout', 'AuthController@logout');

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/artists', 'ArtistController@index');
Route::get('/artists/{slug}', 'ArtistController@show');

Route::get('/movies', 'MovieController@index');
Route::get('/movies/{slug}', 'MovieController@show');

Route::get('/proojects', 'ProojectController@index');
Route::get('/proojects/{slug}', 'ProojectController@show');

Route::get('/products', 'ProductController@index');

Route::get('/releases', 'ReleaseController@index');
Route::get('/releases/{ref}', 'ReleaseController@show');
