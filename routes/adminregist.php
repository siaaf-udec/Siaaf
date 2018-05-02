<?php

/**
 * Admisiones y Registro
 */

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'users', 'middleware' => ['permission:ADMINREGIST_MODULE']], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'middleware' => ['permission:ADMINREGIST_USER'],
            'uses' => $controller . 'UsuariosController@index',
            'as' => 'adminRegist.users.index',
        ]);

        Route::get('data', [
            'middleware' => ['permission:ADMINREGIST_USER'],
            'uses' => $controller . 'UsuariosController@data',
            'as' => 'adminRegist.users.data'
        ]);

        Route::post('check/document', [
            'middleware' => ['permission:ADMINREGIST_USER'],
            'uses' => $controller . 'UsuariosController@checkDocument',
            'as' => 'adminRegist.users.check.document'
        ]);

        Route::post('check/code', [
            'middleware' => ['permission:ADMINREGIST_USER'],
            'uses' => $controller . 'UsuariosController@checkCode',
            'as' => 'adminRegist.users.check.code'
        ]);

        Route::get('create', [
            'middleware' => ['permission:ADMINREGIST_USER_CREATE'],
            'uses' => $controller . 'UsuariosController@create',
            'as' => 'adminRegist.users.create'
        ]);

        Route::post('store',[
            'middleware' => ['permission:ADMINREGIST_USER_CREATE'],
            'uses' => $controller . 'UsuariosController@store',
            'as' => 'adminRegist.users.store'
        ]);

        Route::get('index/ajax', [
            'middleware' => ['permission:ADMINREGIST_USER'],
            'uses' => $controller . 'UsuariosController@indexAjax',
            'as' => 'adminRegist.users.index.ajax'
        ]);
    });

    Route::group(['prefix' => 'registros', 'middleware' => ['permission:ADMINREGIST_MODULE']], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'middleware' => ['permission:ADMINREGIST_REINGRE'],
            'uses' => $controller . 'RegistrosController@index',
            'as' => 'adminRegist.registros.index',
        ]);

        Route::get('registro/index', [
            'middleware' => ['permission:ADMINREGIST_REINGRE'],
            'uses' => $controller . 'RegistrosController@indexRegistro',
            'as' => 'adminRegist.registros.registro.index',
        ]);

        Route::post('registro',[
            'middleware' => ['permission:ADMINREGIST_REINGRE'],
            'uses' => $controller . 'RegistrosController@registrar',
            'as' => 'adminRegist.registros.registro'
        ]);

        Route::get('history', [
            'middleware' => ['permission:ADMINREGIST_HISNOV'],
            'uses' => $controller . 'RegistrosController@history',
            'as' => 'adminRegist.registros.history',
        ]);

        Route::get('history/data', [
            'middleware' => ['permission:ADMINREGIST_HISNOV'],
            'uses' => $controller . 'RegistrosController@data',
            'as' => 'adminRegist.registros.data',
        ]);

        Route::get('listNovedad', [
            'middleware' => ['permission:ADMINREGIST_REINGRE'],
            'uses' => $controller . 'NovedadesController@listarNovedades',
            'as' => 'adminRegist.registros.listNovedades'
        ]);

    });

    Route::group(['prefix' => 'help', 'middleware' => ['permission:ADMINREGIST_MODULE']], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'middleware' => ['permission:ADMINREGIST_ADPREG'],
            'uses' => $controller . 'HelpController@index',
            'as' => 'adminRegist.help.index',
        ]);

        Route::get('data', [
            'middleware' => ['permission:ADMINREGIST_ADPREG'],
            'uses' => $controller . 'HelpController@data',
            'as' => 'adminRegist.help.data',
        ]);

        Route::get('index/ajax', [
            'middleware' => ['permission:ADMINREGIST_ADPREG'],
            'uses' => $controller . 'HelpController@indexAjax',
            'as' => 'adminRegist.help.index.ajax'
        ]);

        Route::get('create', [
            'middleware' => ['permission:ADMINREGIST_PRE_CREATE'],
            'uses' => $controller . 'HelpController@create',
            'as' => 'adminRegist.help.create'
        ]);

        Route::post('store',[
            'middleware' => ['permission:ADMINREGIST_PRE_CREATE'],
            'uses' => $controller . 'HelpController@store',
            'as' => 'adminRegist.help.store'
        ]);

        Route::get('editar/{id?}', [
            'middleware' => ['permission:ADMINREGIST_PRE_UPDATE'],
            'uses' => $controller . 'HelpController@edit',
            'as' => 'adminRegist.help.edit'
        ]);

        Route::post('update', [
            'middleware' => ['permission:ADMINREGIST_PRE_UPDATE'],
            'uses' => $controller . 'HelpController@update',
            'as' => 'adminRegist.help.update'
        ]);

        Route::delete('destroy/{id?}', [
            'middleware' => ['permission:ADMINREGIST_PRE_DELETE'],
            'uses' => $controller . 'HelpController@destroy',
            'as' => 'adminRegist.help.destroy'
        ]);

        Route::get('index/preguntas', [
            'middleware' => ['permission:ADMINREGIST_PREFRE'],
            'uses' => $controller . 'HelpController@indexPreguntas',
            'as' => 'adminRegist.help.index.preguntas'
        ]);

    });

    Route::group(['prefix' => 'report', 'middleware' => ['permission:ADMINREGIST_MODULE']],function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";
        Route::get('report',[
            'middleware' => ['permission:ADMINREGIST_REPORT_DATE'],
            'uses' => $controller.'ReporteController@indexFecha',
            'as' => 'adminRegist.report.index.fecha'
        ]);

        Route::post('report/date',[
            'middleware' => ['permission:ADMINREGIST_REPORT_DATE'],
            'uses' => $controller.'ReporteController@reporteFecha',
            'as' => 'adminRegist.report.date'
        ]);

        Route::get('descargarRepFecha/{fech1}/{fech2}', [
            'middleware' => ['permission:ADMINREGIST_REPORT_DATE'],
            'uses' => $controller.'ReporteController@descargarReporteFecha',
            'as' => 'adminRegist.report.descargarRepFecha'
        ]);

        Route::get('novedad',[
            'middleware' => ['permission:ADMINREGIST_REPORT_NOVE'],
            'uses' => $controller.'ReporteController@indexNovedad',
            'as' => 'adminRegist.report.novedad.index'
        ]);

        Route::post('report/novedad',[
            'middleware' => ['permission:ADMINREGIST_REPORT_NOVE'],
            'uses' => $controller.'ReporteController@reporteNovedad',
            'as' => 'adminRegist.report.novedad'
        ]);

        Route::get('descargarRepNovedad/{novedad}', [
            'middleware' => ['permission:ADMINREGIST_REPORT_NOVE'],
            'uses' => $controller.'ReporteController@descargarReporteNovedad',
            'as' => 'adminRegist.report.descargarRepNovedad'
        ]);

        Route::get('reportGeneral', [
            'middleware' => ['permission:ADMINREGIST_REPORT_REGIST'],
            'uses' => $controller.'ReporteController@reporteGeneral',
            'as' => 'adminRegist.report.reportGeneral'
        ]);

        Route::get('descargarRepGeneral', [
            'middleware' => ['permission:ADMINREGIST_REPORT_REGIST'],
            'uses' => $controller.'ReporteController@descargarReporteGeneral',
            'as' => 'adminRegist.report.descargarRepGeneral'
        ]);

    });

    Route::group(['prefix' => 'chart', 'middleware' => ['permission:ADMINREGIST_MODULE']],function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";
        Route::get('index', [
            'middleware' => ['permission:ADMINREGIST_CHART'],
            'uses' => $controller.'ReporteController@charIndex',
            'as' => 'adminRegist.chart.index'
        ]);
    });

    Route::group(['prefix' => 'novedad', 'middleware' => ['permission:ADMINREGIST_MODULE']], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'middleware' => ['permission:ADMINREGIST_ADNOV'],
            'uses' => $controller . 'NovedadesController@index',
            'as' => 'adminRegist.novedad.index',
        ]);

        Route::get('data', [
            'middleware' => ['permission:ADMINREGIST_ADNOV'],
            'uses' => $controller . 'NovedadesController@data',
            'as' => 'adminRegist.novedad.data',
        ]);

        Route::get('index/ajax', [
            'middleware' => ['permission:ADMINREGIST_ADNOV'],
            'uses' => $controller . 'NovedadesController@indexAjax',
            'as' => 'adminRegist.novedad.index.ajax'
        ]);

        Route::get('create', [
            'middleware' => ['permission:ADMINREGIST_NOV_CREATE'],
            'uses' => $controller . 'NovedadesController@create',
            'as' => 'adminRegist.novedad.create'
        ]);

        Route::post('store',[
            'middleware' => ['permission:ADMINREGIST_NOV_CREATE'],
            'uses' => $controller . 'NovedadesController@store',
            'as' => 'adminRegist.novedad.store'
        ]);

        Route::get('editar/{id?}', [
            'middleware' => ['permission:ADMINREGIST_NOV_UPDATE'],
            'uses' => $controller . 'NovedadesController@edit',
            'as' => 'adminRegist.novedad.edit'
        ]);

        Route::post('update', [
            'middleware' => ['permission:ADMINREGIST_NOV_UPDATE'],
            'uses' => $controller . 'NovedadesController@update',
            'as' => 'adminRegist.novedad.update'
        ]);

        Route::delete('destroy/{id?}', [
            'middleware' => ['permission:ADMINREGIST_NOV_DELETE'],
            'uses' => $controller . 'NovedadesController@destroy',
            'as' => 'adminRegist.novedad.destroy'
        ]);

    });

    Route::group(['prefix' => 'sugerencia', 'middleware' => ['permission:ADMINREGIST_MODULE']], function (){
        $controller = "\\App\\Container\\AdminRegist\\Src\\Controllers\\";

        //ruta que conduce al controlador para mostrar el registro de usuarios
        Route::get('index', [
            'middleware' => ['permission:ADMINREGIST_ADSU'],
            'uses' => $controller . 'SugerenciaController@index',
            'as' => 'adminRegist.sugerencia.index',
        ]);

        Route::get('index/ajax', [
            'middleware' => ['permission:ADMINREGIST_ADSU'],
            'uses' => $controller . 'SugerenciaController@indexAjax',
            'as' => 'adminRegist.sugerencia.index.ajax',
        ]);

        Route::get('data', [
            'middleware' => ['permission:ADMINREGIST_ADSU'],
            'uses' => $controller . 'SugerenciaController@data',
            'as' => 'adminRegist.sugerencia.data',
        ]);

        Route::post('store',[
            'middleware' => ['permission:ADMINREGIST_SU_CREATE'],
            'uses' => $controller . 'SugerenciaController@store',
            'as' => 'adminRegist.sugerencia.store'
        ]);

        Route::delete('destroy/{id?}', [
            'middleware' => ['permission:ADMINREGIST_SU_DELETE'],
            'uses' => $controller . 'SugerenciaController@destroy',
            'as' => 'adminRegist.sugerencia.destroy'
        ]);

        Route::get('index/correo/{id?}', [
            'middleware' => ['permission:ADMINREGIST_ADSU'],
            'uses' => $controller . 'CorreosController@index',
            'as' => 'adminRegist.sugerencia.index.correo',
        ]);

        Route::post('enviar/email',[
            'middleware' => ['permission:ADMINREGIST_SU_CREATE'],
            'uses' => $controller . 'CorreosController@enviarMail',
            'as' => 'adminRegist.sugerencia.enviar.email'
        ]);
    });
});
