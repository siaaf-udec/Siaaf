<?php
/**
 * Espacios Académicos
 */

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'espacios.academicos.index',
    'uses' => function(){
        return view('acadspace.example');
    }
]);