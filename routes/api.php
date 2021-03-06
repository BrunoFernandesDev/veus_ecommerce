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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('auth')->group(function () {
    Route::post('register', 'API\UserController@register');
    Route::post('login', 'API\UserController@login');
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'API\UserController@logout');
    });
});

Route::prefix('v1')->group(function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'API\UserController@detalhesLogin');
        Route::apiResources([
            'products' => 'API\ProdutoController'
        ], ['except' => ['index']]);
    });
    Route::get('products', 'API\ProdutoController@index')->name('products.index');
});
