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

Route::resource('rrhh', $controller.'EmpleadoController'); //Ruta para CRUD de funcionarios.

Route::post('empleadolist', $controller.'accionEmpController@listar'); //Ruta para listar los empleados

Route::resource('Document', $controller.'DocumentController'); //Ruta para el CRUD de Documentos
