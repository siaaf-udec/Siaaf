<?php
/**
 * Auto Evaluación
 */

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'SuperAdministrador', 'middleware' => ['permission:SUPERADMIN_MODULE']], function () {
        $controllerSuperAdmin = "\\App\\Container\\Autoevaluation\\Src\\Controllers\\SuperAdministrador\\";
    });

    Route::group(['prefix' => 'FuentesPrimarias', 'middleware' => ['permission:Primary_SOURCES_MODULE',
        'permission:SUPERADMIN_MODULE']], function () {
            $controllerEncuestas = "\\App\\Container\\Autoevaluation\\Src\\Controllers\\FuentesPrimarias\\";
        });

    Route::group(['prefix' => 'Documental', 'middleware' => ['permission:SECONDARY_SOURCES_MODULE']], function () {
        $controllerDocumental = "\\App\\Container\\Autoevaluation\\Src\\Controllers\\FuentesSecundarias\\";

        Route::group(['prefix' => 'Dependencia', 'middleware' => ['permission:SECONDARY_SOURCES_MODULE']], function () {
            $controllerDocumental = "\\App\\Container\\Autoevaluation\\Src\\Controllers\\FuentesSecundarias\\";
            Route::get('index', [
                'uses' => $controllerDocumental . 'DependenceController@index',
                'as' => 'autoevaluation.documental.dependencia.index'
            ]);

            Route::get('data', [
                'uses' => $controllerDocumental . 'DependenceController@data',
                'as' => 'autoevaluation.documental.dependencia.data'
            ]);
            Route::delete('delete/{id?}', [
                'uses' => $controllerDocumental . 'DependenceController@destroy',
                'as' => 'autoevaluation.documental.dependencia.destroy'
            ])->where(['id' => '[0-9]+']);
            Route::post('create', [
                'uses' => $controllerDocumental . 'DependenceController@create',
                'as' => 'autoevaluation.documental.dependencia.create',
            ]);

            Route::post('update', [
                'uses' => $controllerDocumental . 'DependenceController@update',
                'as' => 'autoevaluation.documental.dependencia.update',
            ]);
        });
    });

        
    /*FIN FUNCIONALIDAD MARCA*/
});
