<?php

/**
 * Admisiones y Registro
 */

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users'], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'uses' => $controller . 'MenuController@index',
            'as' => 'adminRegist.users.index',
        ]);

        Route::get('data', [
            'uses' => $controller . 'UserRegistController@data',
            'as' => 'adminRegist.users.data'
        ]);

        Route::post('check/document', [
            'uses' => $controller . 'UserRegistController@checkDocument',
            'as' => 'adminRegist.users.check.document'
        ]);

        Route::post('check/code', [
            'uses' => $controller . 'UserRegistController@checkCode',
            'as' => 'adminRegist.users.check.code'
        ]);

        Route::get('create', [
            'uses' => $controller . 'UserRegistController@create',
            'as' => 'adminRegist.users.create'
        ]);

        Route::post('store',[
            'uses' => $controller . 'UserRegistController@store',
            'as' => 'adminRegist.users.store'
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'UserRegistController@index_ajax',
            'as' => 'adminRegist.users.index.ajax'
        ]);
    });

    Route::group(['prefix' => 'registros'], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'uses' => $controller . 'RegistrosController@index',
            'as' => 'adminRegist.registros.index',
        ]);

        Route::post('registro',[
            'uses' => $controller . 'RegistrosController@registrar',
            'as' => 'adminRegist.registros.registro'
        ]);

        Route::get('history', [
            'uses' => $controller . 'RegistrosController@history',
            'as' => 'adminRegist.registros.history',
        ]);

        Route::get('history/data', [
            'uses' => $controller . 'RegistrosController@data',
            'as' => 'adminRegist.registros.data',
        ]);

    });

    Route::group(['prefix' => 'help'], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'uses' => $controller . 'HelpController@index',
            'as' => 'adminRegist.help.index',
        ]);

        Route::get('data', [
            'uses' => $controller . 'HelpController@data',
            'as' => 'adminRegist.help.data',
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'HelpController@index_ajax',
            'as' => 'adminRegist.help.index.ajax'
        ]);

        Route::get('create', [
            'uses' => $controller . 'HelpController@create',
            'as' => 'adminRegist.help.create'
        ]);

        Route::post('store',[
            'uses' => $controller . 'HelpController@store',
            'as' => 'adminRegist.help.store'
        ]);

        Route::delete('destroy/{id?}', [
            'uses' => $controller . 'HelpController@destroy',
            'as' => 'adminRegist.help.destroy'
        ]);

    });

});
