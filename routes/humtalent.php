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
/*Route::get('rrhh', [    //Ruta para mostrar formulario de registro de funcionarios.
    'uses' => $controller.'FuncionarioController@create',
    'as' => 'create'
]);*/

//Route::resource('rrhh', $controller.'EmpleadoController'); //Ruta para CRUD de funcionarios.

Route::resource('rrhh', $controller.'EmpleadoController', [
    'names' => [ // 'método' => 'alias'
        'create' => 'talento.humano.rrhh.create',
        'store' => 'talento.humano.rrhh.store',
        'index' => 'talento.humano.rrhh.index',
        'edit' => 'talento.humano.rrhh.edit',
        'update' => 'talento.humano.rrhh.update',
        'destroy' => 'talento.humano.rrhh.destroy',
    ]
]);

//Route::get('empleadolist', $controller.'accionEmpController@listar'); //Ruta para listar los empleados

Route::get('empleadoList', [
    'as' => 'talento.humano.empleadoList', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@listar'
]);


Route::resource('document', $controller.'DocumentController',[
    'names'=>[
        'index'=> 'talento.humano.document.index',
        'create'=> 'talento.humano.document.create',
        'store'=> 'talento.humano.document.store',
        'edit'=> 'talento.humano.document.edit',
        'update'=> 'talento.humano.document.update',
        'destroy'=> 'talento.humano.document.destroy',

    ]
]); //Ruta para el CRUD de Documentos
