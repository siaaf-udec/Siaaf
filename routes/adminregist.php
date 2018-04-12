<?php

/**
 * Admisiones y Registro
 */

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users', 'middleware' => ['permission:ADMINREGIST_MODULE']], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'uses' => $controller . 'UsuariosController@index',
            'as' => 'adminRegist.users.index',
        ]);

        Route::get('data', [
            'uses' => $controller . 'UsuariosController@data',
            'as' => 'adminRegist.users.data'
        ]);

        Route::post('check/document', [
            'uses' => $controller . 'UsuariosController@checkDocument',
            'as' => 'adminRegist.users.check.document'
        ]);

        Route::post('check/code', [
            'uses' => $controller . 'UsuariosController@checkCode',
            'as' => 'adminRegist.users.check.code'
        ]);

        Route::get('create', [
            'uses' => $controller . 'UsuariosController@create',
            'as' => 'adminRegist.users.create'
        ]);

        Route::post('store',[
            'uses' => $controller . 'UsuariosController@store',
            'as' => 'adminRegist.users.store'
        ]);

        Route::get('index/ajax', [
            'uses' => $controller . 'UsuariosController@indexAjax',
            'as' => 'adminRegist.users.index.ajax'
        ]);
    });

    Route::group(['prefix' => 'registros', 'middleware' => ['permission:ADMINREGIST_MODULE']], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'uses' => $controller . 'RegistrosController@index',
            'as' => 'adminRegist.registros.index',
        ]);

        Route::get('registro/index', [
            'uses' => $controller . 'RegistrosController@indexRegistro',
            'as' => 'adminRegist.registros.registro.index',
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

    Route::group(['prefix' => 'help', 'middleware' => ['permission:ADMINREGIST_MODULE']], function (){
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
            'uses' => $controller . 'HelpController@indexAjax',
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

        Route::get('index/preguntas', [
            'uses' => $controller . 'HelpController@indexPreguntas',
            'as' => 'adminRegist.help.index.preguntas'
        ]);

    });

    Route::group(['prefix' => 'report', 'middleware' => ['permission:ADMINREGIST_MODULE']],function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";
        Route::get('report',[
            'uses' => $controller.'ReporteController@indexFecha',
            'as' => 'adminRegist.report.index.fecha'
        ]);

        Route::post('report/date',[
            'uses' => $controller.'ReporteController@reporteFecha',
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
            'uses' => $controller.'ReporteController@reporteNovedad',
            'as' => 'adminRegist.report.novedad'
        ]);

        Route::get('descargarRepNovedad/{novedad}', [
            'uses' => $controller.'ReporteController@descargarReporteNovedad',
            'as' => 'adminRegist.report.descargarRepNovedad'
        ]);

        Route::get('reportGeneral', [
            'uses' => $controller.'ReporteController@reporteGeneral',
            'as' => 'adminRegist.report.reportGeneral'
        ]);

        Route::get('descargarRepGeneral', [
            'uses' => $controller.'ReporteController@descargarReporteGeneral',
            'as' => 'adminRegist.report.descargarRepGeneral'
        ]);

    });

    Route::group(['prefix' => 'chart', 'middleware' => ['permission:ADMINREGIST_MODULE']],function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";
        Route::get('index', [
            'uses' => $controller.'ReporteController@charIndex',
            'as' => 'adminRegist.chart.index'
        ]);
    });

});
