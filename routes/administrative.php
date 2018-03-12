<?php

/**
 * Administrativo
 */

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix'=>'user', 'middleware' => ['permission:ADMIN_ADMINIS']],function (){
        $controller = "\\App\\Container\\Administrative\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('registroIngreso', [
            'uses' => $controller . 'MenuAdministrativeController@register',
            'as' => 'administrative.user.registroIngreso',
        ]);

        Route::get('create', [
            'uses' => $controller . 'MenuAdministrativeController@create',
            'as' => 'administrative.user.create'
        ]);

        Route::post('store',[
            'uses' => $controller . 'RegistroController@store',
            'as' => 'administrative.user.store'
        ]);

        Route::post('check/document', [
            'uses' => $controller . 'RegistroController@checkDocument',
            'as' => 'administrative.user.check.document'
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'MenuAdministrativeController@index_ajax',
            'as' => 'administrative.user.index.ajax'
        ]);

        Route::get('viewRegister', [
            'uses' => $controller . 'MenuAdministrativeController@viewRegister',
            'as' => 'administrative.user.register'
        ]);

        Route::get('data', [
            'uses' => $controller . 'RegistroController@data',
            'as' => 'administrative.user.data'
        ]);

        Route::post('registerEntry',[
            'uses' => $controller . 'RegistroController@entry',
            'as' => 'administrative.user.registerEntry'
        ]);

        Route::get('history', [
            'uses' => $controller . 'MenuAdministrativeController@history',
            'as' => 'administrative.user.history',
        ]);

        Route::get('history/data', [
            'uses' => $controller . 'RegistroController@history_data',
            'as' => 'administrative.user.history.data',
        ]);
    });

});