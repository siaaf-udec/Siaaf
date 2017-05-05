<?php

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

/*
 * Rutas de Ejemplo
 *
 * Las siguientes rutas son sólo de muestras
 * y documentación de los componentes que se van a usar
 * para el desarrollo del proyecto.
 *
 * Deben ser elminadas al iniciar con el desarrollo
 * del proyecto
 */
Route::get('/', function () {
    return view('material.sample');
});

Route::group(['prefix' => 'components'], function () {
    Route::get('buttons', function ()    {
        return view('examples.buttons');
    });
    Route::get('portlet', function ()    {
        return view('examples.portlet');
    });
    Route::get('icons', function ()    {
        return view('examples.icons');
    });
    Route::get('sidebar', function ()    {
        return view('examples.sidebar');
    });
    Route::get('tabs', function ()    {
        return view('examples.tabs');
    });
});

Route::get('forms', function ()    {
    return view('examples.forms');
});

Route::post('forms', 'SampleController@store');

/*
 * Fin de las rutas de ejemplo.
 */