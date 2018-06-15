<?php
/**
 * Auto Evaluación
 */

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'soft', 'middleware' => ['permission:AUTOEVALUACION']], function () {
        $controller = "\\App\\Container\\Autoevaluation\\src\\Controllers\\";
        Route::get('index', [ //MOSTRAR FORMULARIO
            'uses' => $controller . 'CnaController@index',
            'as' => 'autoevaluacion.cna.index'
        ]);
    /*FIN FUNCIONALIDAD MARCA*/
});
});







