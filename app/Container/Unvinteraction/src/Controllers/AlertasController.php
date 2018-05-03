<?php
namespace App\Container\Unvinteraction\src\Controllers;
use App\Container\Unvinteraction\src\Usuarios;
use App\Container\Unvinteraction\src\Participantes;
use App\Container\Unvinteraction\src\Notificaciones;
use App\Container\Users\src\User;
use Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Container\Overall\Src\Facades\AjaxResponse;

class AlertasController extends Controller
{
   
    private $path='unvinteraction.alertas';
    /*funcion para crear  una alerta de los convenios que van a finalizar para el usuario
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function alerta(Request $request)
    {
        if ($request->isMethod('GET')) {
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
                if( $diferencia >= 0  ){
                    //si el convenio ya finalizo no se envia ninguna  alerta
                 } else {
                    if($diferencia >= -60 ){
                        $notificacion = new Notificaciones();
                        $notificacion->NTFC_Titulo='Finalizacion convenio '.$row->conveniosParticipante->CVNO_Nombre;
                        $notificacion->NTFC_Mensaje='El siguiente mensaje es para avisar que el convenio '.$row->conveniosParticipante->CVNO_Nombre.' en el cual se encuentra como participante esta a punto de finalizar, porfavor realizar las respectivas evaluaciones';
                        $notificacion->NTFC_Bandera = 'NO VISTO';
                        $notificacion->NTFC_Fecha_Vista = $carbon->createFromDate(2000, 1, 1, 0);
                        $notificacion->FK_TBL_Usuarios_Id  = $request->user()->identity_no;
                        $notificacion->save();
                    }
                }
                $participante = Participantes::where('FK_TBL_Convenio_Id',$row->FK_TBL_Convenio_Id)->select('PK_PTPT_Participantes','FK_TBL_Usuarios_Id','PTPT_Fecha_Fin')->with(['usuariosParticipantes'=>function ($query) {
                    $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                        'datoUsuario'=>function ($query) {
                            $query->select('id','name','lastname','identity_no');
                        }
                    ]);
                }
                ])->get();
                 $user= User::where('id',$request->user()->id)->select('id')->with([
                        'roles'=>function ($query) {
                            $query->select('id','name');
                        }
                ])->get();
                if($user[0]->roles[0]->name != 'Pasante_uni'){
                    foreach($participante as $row2){
                        $fecha = $carbon->createFromFormat('Y-m-d H',$row2->PTPT_Fecha_Fin.'00');
                        $diferencia2 = $fecha->diffInDays($dtVancouver,false);
                        //notificacion a punto de terminar
                        if( $diferencia2 >= -15  && $diferencia2 <= 0  ){
                            $notificacion = new Notificaciones();
                            $notificacion->NTFC_Titulo='usuario por finalizar al pasantia';
                            $notificacion->NTFC_Mensaje=' el usuario '.$row2->usuariosParticipantes->datoUsuario->name.' '.$row2->usuariosParticipantes->datoUsuario->lastname.' esta por finalizar su pasantia, Recuerda  realizar la evaluacion pertinente.';
                            $notificacion->NTFC_Bandera = 'NO VISTO';
                            $notificacion->NTFC_Fecha_Vista = $carbon->createFromDate(2000, 1, 1, 0);
                            $notificacion->FK_TBL_Usuarios_Id  = $request->user()->identity_no;
                            $notificacion->save();
                        }
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
            $carbon = new \Carbon\Carbon();
            $bandera = Notificaciones::findOrFail($id);
            $bandera->NTFC_Bandera = 'VISTO';
            $bandera->NTFC_Fecha_Vista = $carbon->now();
            $bandera->save();
            $notificacion = Notificaciones::findOrFail($id);
            return view($this->path.'.verNotificacion', compact('notificacion'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
   
    /*funcion para la vista completa de las noticiaciones administrador
    *@param int id
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function notificacionesAdmin (Request $request)
    {
        if ($request->isMethod('GET')) {
            return view($this->path.'.verNotificacionAdmin');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*funcion para listar todas las noticiaciones administrador
    *@param int id
    *@return Yajra\DataTables\DataTable  | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function listarNotificacionesAdmin (Request $request)
    {
        if ( $request->isMethod('GET')) {
            $notificacion=Notificaciones::select('PK_NTFC_Notificacion','NTFC_Titulo','NTFC_Bandera','FK_TBL_Usuarios_Id','NTFC_Fecha_Vista','created_at')->with(['usuario'=>function ($query) {
                    $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                        'datoUsuario'=>function ($query) {
                            $query->select('id','name','lastname','identity_no');
                        }
                    ]);
                }
                ])->get();
           return Datatables::of($notificacion)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
