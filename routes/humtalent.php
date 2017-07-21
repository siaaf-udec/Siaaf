<?php
/**
 * Talento Humano.
 */

use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Event;
use App\Container\Humtalent\src\DocumentacionPersona;
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

Route::resource('evento', $controller.'EventoController',[  //ruta para el controlador encargado del CRUD de Eventos
    'names'=>[
        'index'=> 'talento.humano.evento.index',
        'create'=> 'talento.humano.evento.create',
        'store'=> 'talento.humano.evento.store',
        'edit'=> 'talento.humano.evento.edit',
        'update'=> 'talento.humano.evento.update',
        'destroy'=> 'talento.humano.evento.destroy',

    ]
]);

Route::get('listaEventos',[   //ruta que realiza listar los eventos registrados
    'as' => 'talento.humano.listaEventos',
    'uses' =>function() {
        return view('humtalent.eventos.listaEventos');
    }
]);

Route::get('tablaEventos',[   //ruta que realiza la consulta de los eventos registrados
    'as' => 'talento.humano.tablaEventos',
    'uses' => $controller.'EventoController@tablaEventos'
]);

Route::get('evento/asistentes/{id}', [    //ruta para listar los empleados  asistentes a un evento seleccionado, recibe el id del evento seleccionado
    'as' => 'talento.humano.evento.asistentes', //Este es el alias de la ruta
    'uses' => function($id){
        return view('humtalent.eventos.consultarAsistentes',compact('id'));
    }
]);
Route::get('tablaAsistentes/{id}',[   //ruta que realiza la consulta de los empleados asistentes a un evento, recibe el id del evento seleccionado
    'as' => 'talento.humano.tablaAsistentes',
    'uses' => $controller.'EventoController@tablaAsistentes'
]);
Route::get('posAsitentes/{id}',[   //ruta que realiza la consulta de los empleados que no esten registrados en el evento, recibe el id del evento seleccionado
    'as' => 'talento.humano.posAsitentes',
    'uses' => $controller.'EventoController@posiblesAsistentes'
]);
Route::get('evento/regAsist/{id}', [    //ruta para listar los empleados  para agregar asistentes a un evento seleccionado, recibe el id del evento seleccionado
    'as' => 'talento.humano.evento.regAsist', //Este es el alias de la ruta
    'uses' => function($id){
        return view('humtalent.eventos.registrarAsistentes',compact('id'));
    }
]);
Route::get('evento/regAsist/saveAsist/{id}/{ced}',[   //ruta que registrar los empleados asistentes a un evento, recibe el id del evento seleccionado y la cedula del empleado a registrar como asistente
    'as' => 'talento.humano.evento.regAsist.saveAsists',
    'uses' => $controller.'EventoController@registrarAsistentes'
]);
Route::post('evento/regAsist/regTotAsist',[   //ruta que registrar los empleados asistentes a un evento, recibe el id del evento seleccionado y la cedula del empleado a registrar como asistente
    'as' => 'talento.humano.evento.regAsist.regTotAsist',
    'uses' => $controller.'EventoController@registrarTodosAsistentes'
]);
Route::get('evento/asistentes/deleteAsist/{id}/{ced}',[   //ruta que eliminar un asistente a un evento, recibe la cedula  del empleado seleccionado y el id del evento
    'as' => 'talento.humano.evento.asistentes.deleteAsist',
    'uses' => $controller.'EventoController@deleteAsistentes'
]);

/*Route::get('docentesList/{rol}', function ($rol)    {
    return view('humtalent.empleado.tablasEmpleados', compact('rol'));
})->name('talento.humano.docentesList');
*/


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