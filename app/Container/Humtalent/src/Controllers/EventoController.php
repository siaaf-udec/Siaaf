<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 11/07/2017
 * Time: 10:49 PM
 */

namespace App\Container\Humtalent\src\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Event;
use Yajra\DataTables\DataTables;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Asistent;
use App\Container\Overall\Src\Facades\AjaxResponse;


class EventoController extends Controller
{
    private $id;


    /**
     * Función que consulta los eventos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tablaEventos(Request $request){
        if ($request->ajax()) {
            return DataTables::of(Event::all())
                ->addIndexColumn()
                ->make(true);
        } else {
            return response()->json([
                'message' => 'Incorrect request',
                'code' => 412
            ], 412);
        }
    }

    /**
     * Función que muestra la tabla de los asistentes a un evento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tablaAsistentes(Request $request, $id){
        $asistentes=Asistent::with('personas')->where('FK_TBL_Eventos_IdEvento',$id)->get();
        $empleados=[];
        foreach ($asistentes as $asistente){
            $empleados=array_merge($empleados,[$asistente->personas]);
        }
        if ($request->ajax()) {
            return DataTables::of($empleados)
                ->addIndexColumn()
                ->make(true);
        }

        return response()->json([
            'message' => 'Incorrect request',
            'code' => 412
        ], 412);
    }

    /**
     * Función que muestra un listado de los posibles asistentes a un evento .
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_Evento
     * @return \Illuminate\Http\Response
     */
    public function posiblesAsistentes(Request $request, $id_Evento){
        $this->id=$id_Evento;
        $asistentes=Persona::whereDoesntHave('asistents',function ($query) {
            $query->where('FK_TBL_Eventos_IdEvento',$this->id);
        })->get();
        if ($request->ajax()) {
            return DataTables::of($asistentes)
                ->addIndexColumn()
                ->make(true);
        }

        return response()->json([
            'message' => 'Incorrect request',
            'code' => 412
        ], 412);
    }

    /**
     * Función que permite registrar un asistente a un evento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $ced
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function registrarAsistentes(Request $request,$id, $ced){
        if($request->ajax() && $request->isMethod('GET')) {
            Asistent::create([
                'ASIST_Informe' => 'No',
                'FK_TBL_Eventos_IdEvento' => $id,
                'FK_TBL_Persona_Cedula' => $ced,
            ]);
            return AjaxResponse::success(
                '¡Registro exitoso!',
                'El asistente fue registrado correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que muestra los asistentes a un determinado evento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function consultarAsistentes(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('humtalent.eventos.consultarAsistentes',compact('id'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el listado de todos los empleados registrados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listaEmpleados(Request $request, $id){
        if($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.eventos.registrarAsistentes',compact('id'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que permite seleccionar a muchos asistentes al tiempo a un determinado evento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $datos
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function registrarTodosAsistentes(Request $request, $id, $datos){
        $datos=explode(';',$datos);
        if($request->ajax() && $request->isMethod('POST')){
            for ($i=0; $i< count($datos)-1; $i++){
                Asistent::create([
                    'ASIST_Informe' => 'No',
                    'FK_TBL_Eventos_IdEvento' => $id,
                    'FK_TBL_Persona_Cedula'   => $datos[$i],
                ]);
            }
            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Todos los asistentes fueron registrados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que permite eliminar asistentes que ya hayan sido registrados en un evento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $ced
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function deleteAsistentes(Request $request, $id, $ced){
        if($request->ajax() && $request->isMethod('GET')){
        Asistent::where('FK_TBL_Persona_Cedula', $ced)
                ->where('FK_TBL_Eventos_IdEvento', $id)->delete();
        return AjaxResponse::success(
            '¡Proceso exitoso!',
            'El asistente fue eliminado correctamente.'
        );}

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Muestra todos los eventos que esten registrados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('humtalent.eventos.listaEventos');
    }

    /**
     * Muestra todos los eventos que esten registrados por medio de petición ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.eventos.ajaxListaEventos');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Presenta el formulario para registrar un documento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.eventos.registrarEvento');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Almacena un documento enviado desde el formulario del la funcion create.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')){
            $hora=$request['EVNT_Hora'];
            $hora=strtotime($hora);
            $hora=date("H:i",$hora);
            Event::create([
                'EVNT_Descripcion'  => $request['EVNT_Descripcion'],
                'EVNT_Fecha_Inicio' => $request['EVNT_Fecha_Inicio'],
                'EVNT_Fecha_Fin' => $request['EVNT_Fecha_Fin'],
                'EVNT_Fecha_Notificacion' => $request['EVNT_Fecha_Notificacion'],
                'EVNT_Hora'         => $hora,
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Presenta el formulario para editar un evento deseado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)//
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            $evento = Event::find($id);
            return view('humtalent.eventos.editarEvento', [
                'evento' => $evento]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Se realiza la actulización de datos de los eventos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $request['EVNT_Hora'] = strtotime($request['EVNT_Hora']);
            $request['EVNT_Hora'] = date("H:i",$request['EVNT_Hora']);

            $documento= Event::find($request['PK_EVNT_IdEvento']);
            $documento->fill($request->all());
            $documento->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Se elimina el registro de un documento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request,$id)//
    {
        if($request->ajax() && $request->isMethod('DELETE')){
        Asistent::where('FK_TBL_Eventos_IdEvento',$id)->delete();
        Event::destroy($id);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}