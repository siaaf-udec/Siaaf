<?php
namespace App\Container\Unvinteraction\src\Controllers;
use App\Container\Unvinteraction\src\Usuarios;
use App\Container\Unvinteraction\src\Documentacion;
use App\Container\Unvinteraction\src\Convenios;
use App\Container\Unvinteraction\src\Evaluacion;
use App\Container\Unvinteraction\src\EvaluacionPreguntas;
use App\Container\Unvinteraction\src\Preguntas;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use App\Container\Unvinteraction\src\EmpresasParticipantes;
use App\Container\Unvinteraction\src\Empresa;
use App\Container\Unvinteraction\src\Participantes;
use App\Container\Unvinteraction\src\Documentacion_Extra;
use App\Container\Unvinteraction\src\Notificaciones;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;


class ControllerAlertas extends Controller
{
   
    private $path='unvinteraction.alertas';
    /*funcion para crear  una alerta de los convenios que van a finalizar para el usuario
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function alerta(Request $request)
    {
        if ($request->isMethod('GET')) {
            $estado=1;
            $convenio = Participantes::where('FK_TBL_Usuarios_Id', '=', $request->user()->identity_no)->select('PK_PTPT_Participantes','FK_TBL_Convenio_Id')
                ->with([
                        'conveniosParticipante'=>function ($query) {
                            $query->select('PK_CVNO_Convenio','CVNO_Nombre','CVNO_Fecha_Fin');
                        }
                ])
                ->get();
            //calculo de la diferencia de fecha  para saber si hay que crear la  alerta
            $carbon = new \Carbon\Carbon();
            foreach ($convenio as $row) {
                $dtVancouver = $carbon->now();
                $fecha = $carbon->createFromFormat('Y-m-d H',$row->conveniosParticipante->CVNO_Fecha_Fin.'00');
                $diferencia = $fecha->diffInDays($dtVancouver,false);
                $diferencia;
                if($estado == 1 && $diferencia >= 0  ){
                    //si el convenio ya finalizo no se envia ninguna  alerta
                 } else {
                    if($estado == 1 && $diferencia >= -60 ){
                        $notificacion = new Notificaciones();
                        $notificacion->NTFC_Titulo='Finalizacion convenio '.$row->conveniosParticipante->CVNO_Nombre;
                        $notificacion->NTFC_Mensaje='El siguiente mensaje es para avisar que el convenio '.$row->conveniosParticipante->CVNO_Nombre.' en el cual se encuentra como participante esta a punto de finalizar, porfavor realizar las respectivas evaluaciones';
                        $notificacion->NTFC_Bandera = 'NO VISTO';
                        $notificacion->FK_TBL_Usuarios_Id  = $request->user()->identity_no;
                        $notificacion->save();
                    }
                } 
            }
            return view($this->path.'.listarNotificaciones');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para la vista de la alertas en ajax
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function alertaAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listarNotificacionesAjax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param \Illuminate\Http\Request
    *@return Yajra\DataTables\DataTable  | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function listarAlerta(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $notificaciones = Notificaciones::select('PK_NTFC_Notificacion','NTFC_Titulo', 'NTFC_Bandera')
                  ->where('NTFC_bandera','NO VISTO')
                  ->where('FK_TBL_Usuarios_Id',$request->user()->identity_no)
                  ->get();
            return Datatables::of($notificaciones)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para la vista completa del mensaje de la alertas en ajax
    *@param int id
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function verAlerta(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $bandera = Notificaciones::findOrFail($id);
            $bandera->NTFC_Bandera = 'VISTO';
            $bandera->save();
            $notificacion = Notificaciones::findOrFail($id);
            return view($this->path.'.verNotificacion', compact('notificacion'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
   
}
