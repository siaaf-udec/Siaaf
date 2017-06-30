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