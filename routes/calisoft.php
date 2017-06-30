<?php
/**
 * Calisoft
 */
//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'calisoft.index',
    'uses' => function(){
        return view('calisoft.example');
    }
]);