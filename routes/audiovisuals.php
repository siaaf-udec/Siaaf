<?php
/**
 * Audiovisuales
 */

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'audiovisuales.index',
    'uses' => function(){
        return view('audiovisuals.example');
    }
]);