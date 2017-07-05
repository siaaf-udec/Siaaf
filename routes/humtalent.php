<?php
/**
 * Talento Humano.
 */

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'talento.humano.index',
    'uses' => function(){
        return view('humtalent.example');
    }
]);

$controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";

Route::resource('rrhh', $controller.'EmpleadoController', [   //ruta para el CRUD de empleados
    'names' => [ // 'método' => 'alias'
        'create' => 'talento.humano.rrhh.create',
        'store' => 'talento.humano.rrhh.store',
        'index' => 'talento.humano.rrhh.index',
        'edit' => 'talento.humano.rrhh.edit',
        'update' => 'talento.humano.rrhh.update',
        'destroy' => 'talento.humano.rrhh.destroy',
    ]
]);

Route::resource('document', $controller.'DocumentController',[  //ruta para el CRUD de la Documentación
    'names'=>[
        'index'=> 'talento.humano.document.index',
        'create'=> 'talento.humano.document.create',
        'store'=> 'talento.humano.document.store',
        'edit'=> 'talento.humano.document.edit',
        'update'=> 'talento.humano.document.update',
        'destroy'=> 'talento.humano.document.destroy',

    ]
]);

Route::get('docentesList', [    //ruta para listar los docentes registrados.
    'as' => 'talento.humano.docentesList', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@listarDocentes'
]);
Route::get('funcList', [    //ruta para listar los funcionarios administrativos registrados.
    'as' => 'talento.humano.funcList', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@listarFuncionarios'
]);
Route::get('searchById', [    //ruta para buscar los empleados  registrados por cedula.
    'as' => 'talento.humano.searchById', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@consultarByCedula'
]);
Route::post('buscarCedula', [    //ruta para buscar los empleados  registrados por cedula.
    'as' => 'talento.humano.buscarCedula', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@buscarByCedula'
]);
