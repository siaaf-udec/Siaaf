<?php
/**
 * Talento Humano.
 */
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

use App\Container\Users\Src\User;

$controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";
/*Route::get('rrhh', [    //Ruta para mostrar formulario de registro de funcionarios.
    'uses' => $controller.'FuncionarioController@create',
    'as' => 'create'
]);*/

Route::resource('rrhh', $controller.'EmpleadoController'); //Ruta para CRUD de funcionarios.

Route::post('empleadolist', $controller.'accionEmpController@listar');



