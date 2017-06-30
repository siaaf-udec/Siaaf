<?php
/**
 * Financiero.
 */
//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'financial.index',
    'uses' => function(){
        return view('financial.example');
    }
]);