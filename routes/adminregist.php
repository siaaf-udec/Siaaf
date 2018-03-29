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

        Route::get('editar/{id?}', [
            'uses' => $controller . 'HelpController@edit',
            'as' => 'adminRegist.help.edit'
        ]);

        Route::post('update', [
            'uses' => $controller . 'HelpController@update',
            'as' => 'adminRegist.help.update'
        ]);

        Route::delete('destroy/{id?}', [
            'uses' => $controller . 'HelpController@destroy',
            'as' => 'adminRegist.help.destroy'
        ]);

    });

    Route::group(['prefix' => 'report'],function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";
        Route::get('report',[
            'uses' => $controller.'ReporteController@indexFecha',
            'as' => 'adminRegist.report.index.fecha'
        ]);

        Route::post('report/date',[
            'uses' => $controller.'ReporteController@reportFecha',
            'as' => 'adminRegist.report.date'
        ]);

        Route::get('descargarRepFecha/{fech1}/{fech2}', [
            'uses' => $controller.'ReporteController@descargarReporteFecha',
            'as' => 'adminRegist.report.descargarRepFecha'
        ]);

        Route::get('novedad',[
            'uses' => $controller.'ReporteController@indexNovedad',
            'as' => 'adminRegist.report.novedad.index'
        ]);

        Route::post('report/novedad',[
            'uses' => $controller.'ReporteController@reportNovedad',
            'as' => 'adminRegist.report.novedad'
        ]);

        Route::get('descargarRepNovedad/{novedad}', [
            'uses' => $controller.'ReporteController@descargarReporteNovedad',
            'as' => 'adminRegist.report.descargarRepNovedad'
        ]);

    });

});
