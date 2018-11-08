<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

Route::get('app/Container/Acadspace/src/Controllers/api-rest-app/listado.php'); 

});
Route::group(['middleware' => ['api', 'cors']], function ($router) {
     //Add you routes here, for example:
    Route::post('/pokemons/{datos?}', 'ApiApp@index');
    Route::post('/pokemons/validarqr/{datos?}', 'ApiApp@validarqr');
    Route::post('/pokemons/setqr/{datos?}', 'ApiApp@qrinsert');
    Route::post('/pokemons/modificardatos/{datos?}', 'ApiApp@modificardatos');
});
//Route::resource('/pokemons', 'PokemonController');
