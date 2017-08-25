<?php
/**
 * Talento Humano.
 */

use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Event;
use App\Container\Humtalent\src\DocumentacionPersona;
use App\Container\Humtalent\src\StatusOfDocument;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

//RUTA DE EJEMPLO
/*/Route::get('/', [
    'as' => 'talento.humano.index',
    'uses' => function(){
        return view('humtalent.empleado.empleadosDocumentosCompletos');
    }
]);/*/
Route::get('/', [
    'as' => 'talento.humano.index',
    'uses' => function(){
        return view('humtalent.example');
    }
]);


$controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";

//Route::resource('rrhh', $controller.'FuncionarioController'); //Ruta para CRUD de funcionarios.

//Rutas para el manejo de los empleados
Route::group(['prefix' => 'empleado'], function () {
    $controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";
    Route::get('index',[
        'uses' => $controller.'EmpleadoController@index',
        'as' => 'talento.humano.empleado.index'             //ruta que conduce al controlador para mostrar  la tabla donde se cargan los empleados reegistrados
    ]);
    Route::get('create',[
        'uses' => $controller.'EmpleadoController@create',  //ruta que conduce al controlador para mostrar el formulario para registrar un empleado
        'as' => 'talento.humano.empleado.create'
    ]);
    Route::post('store',[
        'uses' => $controller.'EmpleadoController@store',   //ruta que conduce al controlador para alamacenar los datos del empleado en la base de datos
        'as' => 'talento.humano.empleado.store'
    ]);
    Route::delete('empleado/destroy/{id?}',[
        'uses' => $controller.'EmpleadoController@destroy', //ruta que conduce al controlador para eliminar un registro de empleado
        'as' => 'talento.humano.empleado.destroy'
    ]);
    Route::get('empleado/edit/{id?}',[
        'uses' => $controller.'EmpleadoController@edit',     //ruta que conduce al controlador para mostar el formulario para editar datos registrados
        'as' => 'talento.humano.empleado.edit'
    ]);
    Route::post('empleado/update/{id?}',[
        'uses' => $controller.'EmpleadoController@update',      //ruta que conduce al controlador para actulizar datos del empleado
        'as' => 'talento.humano.empleado.update'
    ]);
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
    Route::get('tablaEmpleadosRetirados',[      //ruta que retorna la vista con el datatable para listar los empleados con estado retirado
        'as'=>'talento.humano.empleado.tablaEmpleadosRetirados',
        'uses' => function(){
            return view('humtalent.empleado.empleadosRetirados');
        }
    ]);
    Route::get('empleadosRetirados',[ //ruta que realiza el datatable para consultar los empleados con estado de retirado
        'as'=>'talento.humano.empleado.empleadosRetirados',
        'uses'=> function(Request $request){
                    if ($request->ajax()) {
                        return Datatables::of(Persona::where('PRSN_Estado_Persona', 'Retirado')->get())
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
});

//Rutas para el manejo de la documentación
Route::group(['prefix' => 'document'], function () {
    $controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";
    Route::get('index',[
        'uses' => $controller.'DocumentController@index',   //ruta que conduce al controlador para mostrar  la tabla donde se cargan los documentos reegistrados
        'as' => 'talento.humano.document.index'
    ]);
    Route::get('create',[
        'uses' => $controller.'DocumentController@create', //ruta que conduce al controlador para mostrar el formulario para registrar un documento
        'as' => 'talento.humano.document.create'
    ]);
    Route::post('store',[
        'uses' => $controller.'DocumentController@store',  //ruta que conduce al controlador para alamacenar los datos del documento en la base de datos
        'as' => 'talento.humano.document.store'
    ]);
    Route::delete('document/destroy/{id?}',[
        'uses' => $controller.'DocumentController@destroy',  //ruta que conduce al controlador para eliminar un registro
        'as' => 'talento.humano.document.destroy'
    ]);
    Route::get('document/edit/{id?}',[
        'uses' => $controller.'DocumentController@edit', //ruta que conduce al controlador para mostar el formulario para editar datos registrados
        'as' => 'talento.humano.document.edit'
    ]);
    Route::post('document/update/{id?}',[
        'uses' => $controller.'DocumentController@update',   //ruta que conduce al controlador para actulizar datos del empleado
        'as' => 'talento.humano.document.update'
    ]);
    Route::get('tablaDocumentos',[   //ruta que realiza la consulta de los documentos registrados
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
    Route::get('buscarRadicar', [    //ruta para buscar los empleados  para hacer la radicación de documentos
        'as' => 'talento.humano.buscarRadicar', //Este es el alias de la ruta
        'uses' => function(){
            return view('humtalent.empleado.buscarEmpleado');
        }
    ]);
    Route::post('listarDocsRad', [    //ruta listar los documentos requeridos y asociarlos a un empleado
        'as' => 'talento.humano.listarDocsRad', //Este es el alias de la ruta
        'uses' => $controller.'DocumentController@listarDocsRad'
    ]);
    Route::post('radicarDocumentos', [    //ruta para  asociarlos los documentos requeridos a un empleado
        'as' => 'talento.humano.radicarDocumentos', //Este es el alias de la ruta
        'uses' => $controller.'DocumentController@radicarDocumentos',

    ]);
    Route::post('afiliarEmpleado', [    //ruta para  asociarlos los documentos requeridos a un empleado
        'as' => 'talento.humano.afiliarEmpleado', //Este es el alias de la ruta
        'uses' => $controller.'DocumentController@afiliarEmpleado'
    ]);
    Route::get('reiniciarRadicacion/{id}', [    //ruta para  asociarlos los documentos requeridos a un empleado
        'as' => 'talento.humano.reiniciarRadicacion', //Este es el alias de la ruta
        'uses' => $controller.'DocumentController@reiniciarRadicacion'
    ]);
    Route::get('historialDocumentos/empleados', [    //ruta para listar  los empleados y realizar la consulta de documentación entregada
        'as' => 'talento.humano.historialDocumentos.empleados',
        'uses' => function(){
            return view('humtalent.empleado.listaEmpleados');
        }
    ]);
    Route::get('historialDocumentos/documentos/{id?}',[
        'uses' => $controller.'DocumentController@tablaRadicados', //ruta que conduce al controlador para mostar el formulario para editar datos registrados
        'as' => 'talento.humano.historialDocumentos.documentos'
    ]);
    Route::get('historialDocumentos/documentosRadicados/{id?}',[
        'uses' => $controller.'DocumentController@consultaRadicados', //ruta que conduce al controlador para mostar el formulario para editar datos registrados
        'as' => 'talento.humano.historialDocumentos.documentosRadicados'
    ]);
});

//Rutas para el manejo de los eventos
Route::group(['prefix' => 'evento'], function () {
    $controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";
    Route::get('index',[
        'uses' => $controller.'EventoController@index',   //ruta que conduce al controlador para mostrar  la tabla donde se cargan los eventos reegistrados
        'as' => 'talento.humano.evento.index'
    ]);
    Route::get('create',[
        'uses' => $controller.'EventoController@create', //ruta que conduce al controlador para mostrar  el formulario de registro para los eventos
        'as' => 'talento.humano.evento.create'
    ]);
    Route::post('store',[
        'uses' => $controller.'EventoController@store', //ruta que conduce al controlador para almacenar los  eventos
        'as' => 'talento.humano.evento.store'
    ]);
    Route::delete('evento/destroy/{id?}',[
        'uses' => $controller.'EventoController@destroy', //ruta que conduce al controlador para eliminar los  eventos
        'as' => 'talento.humano.evento.destroy'
    ]);
    Route::get('evento/edit/{id?}',[
        'uses' => $controller.'EventoController@edit', //ruta que conduce al controlador para mostrar el formulario de edición de  los  eventos
        'as' => 'talento.humano.evento.edit'
    ]);
    Route::post('document/update/{id?}',[
        'uses' => $controller.'EventoController@update', //ruta que conduce al controlador para actualizar los datos de los  eventos
        'as' => 'talento.humano.evento.update'
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

    Route::get('evento/asistentes/{id?}', [    //ruta para listar los empleados  asistentes a un evento seleccionado, recibe el id del evento seleccionado
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
    Route::get('evento/regAsist/saveAsist/{id?}/{ced?}',[   //ruta que registrar los empleados asistentes a un evento, recibe el id del evento seleccionado y la cedula del empleado a registrar como asistente
        'as' => 'talento.humano.evento.regAsist.saveAsists',
        'uses' => $controller.'EventoController@registrarAsistentes'
    ]);
    Route::post('evento/regAsist/regTotAsist/{id?}/{datos?}',[   //ruta que registrar los empleados asistentes a un evento, recibe el id del evento seleccionado y la cedula del empleado a registrar como asistente
        'as' => 'talento.humano.evento.regAsist.regTotAsist',
        'uses' => $controller.'EventoController@registrarTodosAsistentes'
    ]);
    Route::get('evento/asistentes/deleteAsist/{id?}/{ced?}',[   //ruta que eliminar un asistente a un evento, recibe la cedula  del empleado seleccionado y el id del evento
        'as' => 'talento.humano.evento.asistentes.deleteAsist',
        'uses' => $controller.'EventoController@deleteAsistentes'
    ]);

});

//rutas para el manejo de las inducciones
Route::group(['prefix' => 'induccion'], function () {
    $controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";

    Route::get('tablaInduccion', [    //ruta para mostrar una lista de los empleados nuevos
        'as' => 'talento.humano.Tinduccion', //Este es el alias de la ruta
        'uses' => function(){
            return view('humtalent.inducciones.tablaEmpleadosNuevos');
        }
    ]);

    Route::get('tablaEmpleadosNuevos',[   //ruta para realizar la cosnulta de los empleados nuevos
        'as' => 'talento.humano.tablaEmpleadosNuevos',
        'uses' => $controller.'InduccionController@listarEmpleadosNuevos'
    ]);

    Route::get('procesoInduccion/{id?}', [    //ruta que muestra el proceso de inducción o re-inducción para un empleado nuevo.
        'as' => 'talento.humano.procesoInduccion', //Este es el alias de la ruta
        'uses' => $controller . 'InduccionController@index'
    ]);

    Route::post('induccion/store', [   //ruta para registrar el proceso de inducción para un empleado
        'as' => 'talento.humano.induccion.store',
        'uses' => $controller . 'InduccionController@store'
    ]);
});

//rutas para el Calendario.
Route::group(['prefix' => 'calendario'], function () {
    $controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";
    Route::get('index',[
        'uses' => $controller.'CalendarioController@index',   //ruta que conduce al controlador para mostrar  el calendario
        'as' => 'talento.humano.calendario.index'
    ]);
    Route::get('getEvent',[
        'as'=>'talento.humano.calendario.getEvent',     //ruta que llama al controlador para mostrar los enventos y recordatorios guardados
        'uses'=>$controller.'CalendarioController@getEvent'
    ]);
    Route::post('storeNotification', [   //ruta para registrar un recordatorio nuevo
        'as' => 'talento.humano.calendario.storeNotification',
        'uses' => $controller . 'CalendarioController@store'
    ]);
    Route::post('storeDateNotification', [   //ruta para registrar la fecha de notificación de los eventos o recordatoriso
        'as' => 'talento.humano.calendario.storeDateNotification',
        'uses' => $controller . 'CalendarioController@storeDate'
    ]);
    Route::post('updateDateNotification', [   //ruta para actualizar las fechas de los recordatorios o eventos.
        'as' => 'talento.humano.calendario.updateDateNotification',
        'uses' => $controller . 'CalendarioController@updateDateNotification'
    ]);
    Route::post('updateNotification', [   //ruta para actualizar los recordatorios o notificaciones
        'as' => 'talento.humano.calendario.updateNotification',
        'uses' => $controller . 'CalendarioController@updateNotification'
    ]);
    Route::post('updateEvent', [   //ruta para actualizar los eventos desde el calendario
        'as' => 'talento.humano.calendario.updateEvent',
        'uses' => $controller . 'CalendarioController@updateEvent'
    ]);
    Route::post('storeDateEvent', [   //ruta para registrar la fecha de los eventos desde el calendario
        'as' => 'talento.humano.calendario.storeDateEvent',
        'uses' => $controller . 'CalendarioController@storeDateEvent'
    ]);
    Route::post('deleteNotification', [   //ruta para eliminar ya sea un evento o una notificación
        'as' => 'talento.humano.calendario.deleteNotification',
        'uses' => $controller . 'CalendarioController@deleteNotification'
    ]);

});
//rutas para el manejo del modulo de permisos e incapacidades para los empleados.
Route::group(['prefix' => 'permisos'], function () {
    $controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";
    Route::get('listaEmpleados', [    //ruta para mostrar una lista de los empleados
        'as' => 'talento.humano.permisos.listaEmpleados',
        'uses' => function(){
            return view('humtalent.permisos.listaEmpleados');
        }
    ]);
    Route::get('tablaPermisos/{id?}', [    //ruta para mostrar la tabla de los permisos.
        'as' => 'talento.humano.permisos.tablaPermisos',
        'uses' => $controller.'PermisosController@listaPermisos'
    ]);
    Route::post('store', [   //ruta para registrar permisos nuevos a un empleado
        'as' => 'talento.humano.permisos.store',
        'uses' => $controller . 'PermisosController@store'
    ]);
    Route::get('consultaPermisos/{id?}',[
        'uses' => $controller.'PermisosController@consultaPermisos', //ruta para consultar los permisos registrados
        'as' => 'talento.humano.permisos.consultaPermisos'
    ]);
    Route::post('update', [   //ruta para actualizar los permisos
        'as' => 'talento.humano.permisos.update',
        'uses' => $controller . 'PermisosController@update'
    ]);
    Route::delete('destroy/{id?}',[
        'uses' => $controller.'PermisosController@destroy', //ruta para eliminar un permiso registrado
        'as' => 'talento.humano.permisos.destroy'
    ]);

});

Route::group(['prefix' => 'notificaciones'], function () {
    $controller = "\\App\\Container\\Humtalent\\Src\\Controllers\\";

    Route::get('listaEmpleadosDocumentosCompletos',[
        'uses' => $controller.'EmpleadoController@listaEmpleadosDocumentosCompletos', //ruta para consultar los permisos registrados
        'as' => 'talento.humano.notificaciones.listaEmpleadosDocumentosCompletos',
        /*'uses' => function(Request $request){
            $empleados=StatusOfDocument::with('Personas')->where('EDCMT_Proceso_Documentacion','Documentación completa')
                ->get();
            if ($request->ajax()) {
                return Datatables::of($empleados)
                    ->addIndexColumn()
                    ->make(true);
            } else {
                return response()->json([
                    'message' => 'Incorrect request',
                    'code' => 412
                ], 412);
            }
        }*/
    ]);

});

