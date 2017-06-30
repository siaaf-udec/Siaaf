<?php
/**
 * Gesap
 */

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'gesap.index',
    'uses' => function(){
        return view('gesap.example');
    }
]);

$controller = "\\App\\Container\\Gesap\\Src\\Controllers\\";

Route::resource('min', $controller.'CoordinadorController');
