<?php
/**
 * Parqueadero
 */
//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'parqueaderos.index',
    'uses' => function(){
        return view('carpark.example');
    }
]);


//Rutas Usuarios Parqueadero
Route::group(['prefix' => 'usuariosCK'], function () {
    $controller = "\\App\\Container\\Carpark\\Src\\Controllers\\";
    Route::get('create', [
        'uses' => $controller . 'ContUsuariosCK@create',
        'as'   => 'usuariosCK.create',
    ]);
    Route::post('store', [
        'uses' => $controller . 'ContUsuariosCK@store',
        'as'   => 'usuariosCK.store',
    ]);
});
