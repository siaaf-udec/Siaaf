<?php
/**
 *  Interacción Universitaria
 */
//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'interaccion.universitaria.index',
    'uses' => function(){
        return view('unvinteraction.example');
    }
]);