<?php
/**
 * Talento Humano.
 */

use App\Container\Humtalent\src\Persona;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'talento.humano.index',
    'uses' => function(){
        return view('humtalent.example');
    }
]);

$controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";

Route::resource('rrhh', $controller.'EmpleadoController', [   //ruta para el controlador encargado del CRUD de empleados
    'names' => [ // 'método' => 'alias'
        'create' => 'talento.humano.rrhh.create',
        'store' => 'talento.humano.rrhh.store',
        'index' => 'talento.humano.rrhh.index',
        'edit' => 'talento.humano.rrhh.edit',
        'update' => 'talento.humano.rrhh.update',
        'destroy' => 'talento.humano.rrhh.destroy',
    ]
]);
Route::resource('document', $controller.'DocumentController',[  //ruta para el controlador encargado del CRUD de la Documentación
    'names'=>[
        'index'=> 'talento.humano.document.index',
        'create'=> 'talento.humano.document.create',
        'store'=> 'talento.humano.document.store',
        'edit'=> 'talento.humano.document.edit',
        'update'=> 'talento.humano.document.update',
        'destroy'=> 'talento.humano.document.destroy',

    ]
]);
/*Route::get('docentesList/{rol}', [    //ruta para listar los docentes registrados.
    'as' => 'talento.humano.docentesList', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@listarDocentes'
]);
*/
Route::get('empleadoList', function ()    { //ruta que prsenta la lista de los empleados registrados
    return view('humtalent.empleado.tablasEmpleados');
})->name('talento.humano.rrhh.empleadoList');

Route::get('tablaEmpleados',[   //ruta que realiza la consulta de los empleados registrados
    'as' => 'talento.humano.tablaEmpleados',
    'uses' => function (Request $request) {
        if ($request->ajax()) {
            return Datatables::of(Persona::all())
                ->addIndexColumn()
                ->make(true);
        } else {
            return response()->json([
                'message' => 'Incorrect request',
                'code' => 412
            ], 412);
        }
    }
]);


Route::get('searchById', [    //ruta para buscar los empleados  registrados por cedula.
    'as' => 'talento.humano.searchById', //Este es el alias de la ruta
    'uses' => function(){
                 return view('humtalent.empleado.consultaEmpleado');
    }
]);
Route::post('buscarCedula', [    //ruta para buscar los empleados  registrados por cedula.
    'as' => 'talento.humano.buscarCedula', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@buscarByCedula'
]);
Route::get('buscarRadicar', [    //ruta para buscar los empleados  para hacer la radicación de documentos
    'as' => 'talento.humano.buscarRadicar', //Este es el alias de la ruta
    'uses' => function(){
        return view('humtalent.empleado.buscarEmpleado');
    }
]);
Route::post('listarDocsRad', [    //ruta listar los documentos requeridos y asociarlos a un empleado
    'as' => 'talento.humano.listarDocsRad', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@listarDocsRad'
]);
Route::post('radicarDocumentos', [    //ruta para  asociarlos los documentos requeridos a un empleado
    'as' => 'talento.humano.radicarDocumentos', //Este es el alias de la ruta
    'uses' => $controller.'AccionEmpController@radicarDocumentos'
]);








































Route::get('tablaDocumentos',[   //ruta que realiza la consulta de los empleados registrados
    'as' => 'talento.humano.tablaDocumentos',
    'uses' => function (Request $request) {
        if ($request->ajax()) {
            return Datatables::of(DocumentacionPersona::all())
                ->addIndexColumn()
                ->make(true);
        } else {
            return response()->json([
                'message' => 'Incorrect request',
                'code' => 412
            ], 412);
        }
    }
]);
Route::get('tablaInduccion', [    //ruta para buscar los empleados  para hacer la radicación de documentos
    'as' => 'talento.humano.Tinduccion', //Este es el alias de la ruta
    'uses' => function(){
        return view('humtalent.inducciones.tablaEmpleadosNuevos');
    }
]);

Route::get('procesoInduccion', [    //ruta para buscar los empleados  para hacer la radicación de documentos
    'as' => 'talento.humano.procesoInduccion', //Este es el alias de la ruta
    'uses' => function(){
        return view('humtalent.inducciones.procesoInduccion');
    }
]);