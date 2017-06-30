<?php
/**
 * Escuelas Deportivas.
 */

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'sportcit.index',
    'uses' => function(){
        return view('sportcit.example');
    }
]);