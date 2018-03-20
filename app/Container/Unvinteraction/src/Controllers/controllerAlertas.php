<?php
namespace App\Container\Unvinteraction\src\Controllers;
use App\Container\Unvinteraction\src\Usuarios;
use App\Container\Unvinteraction\src\Tipo_Usuario;
use App\Container\Unvinteraction\src\Estado_Usuario;
use App\Container\Unvinteraction\src\Carrera;
use App\Container\Unvinteraction\src\Facultad;
use App\Container\Unvinteraction\src\Documentacion;
use App\Container\Unvinteraction\src\Convenios;
use App\Container\Unvinteraction\src\Evaluacion;
use App\Container\Unvinteraction\src\Evaluacion_Preguntas;
use App\Container\Unvinteraction\src\Preguntas;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use App\Container\Unvinteraction\src\Empresas_Participantes;
use App\Container\Unvinteraction\src\Empresa;
use App\Container\Unvinteraction\src\Participantes;
use App\Container\Unvinteraction\src\Documentacion_Extra;
use App\Container\Unvinteraction\src\Notificaciones;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;


class controllerAlertas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path='unvinteraction';
    /*funcion para crear  una alerta de los convenios que van a finalizar para el usuario
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
    public function alerta(Request $request)
    {
        $estado=1;
        $Convenio = Participantes::where('FK_TBL_Usuarios_Id', '=', $request->user()->identity_no)->select('PK_PTPT_Participantes','FK_TBL_Convenio_Id')
            ->with([
                    'conveniosParticipantes'=>function ($query) {
                        $query->select('PK_CVNO_Convenio','CVNO_Nombre','CVNO_Fecha_Fin');
                    }
            ])
            ->get();
        //calculo de la diferencia de fecha  para saber si hay que crear la  alerta
        $carbon = new \Carbon\Carbon();
        foreach ($Convenio as $row) {
            $dtVancouver = $carbon->now();
            $fecha = $carbon->createFromFormat('Y-m-d H',  $row->conveniosParticipantes->CVNO_Fecha_Fin.' 00');
            $diferencia = $fecha->diffInDays($dtVancouver,false);
            $diferencia;
            if($estado == 1 && $diferencia >= 0  ){
                //si el convenio ya finalizo no se envia ninguna  alerta
             } else {
                if($estado == 1 && $diferencia >= -60 ){
                    $notificacion = new TBL_Notificaciones();
                    $notificacion->Titulo='Finalizacion convenio '.$row->conveniosParticipantes->CVNO_Nombre;
                    $notificacion->Mensaje='El siguiente mensaje es para avisar que el convenio '.$row->conveniosParticipantes->CVNO_Nombre.' en el cual se encuentra como participante esta a punto de finalizar, porfavor realizar las respectivas evaluaciones';
                    $notificacion->Bandera = 'NO VISTO';
                    $notificacion->FK_TBL_Usuarios_Id  = $request->user()->identity_no;
                    $notificacion->save();
                }
            } 
        }
        return view($this->path.'.Listar_Notificaciones');
    }
    /*funcion para la vista de la alertas en ajax
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
    public function alertaAjax(Request $request)
    {
        return view($this->path.'.Listar_Notificaciones_Ajax');
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param \Illuminate\Http\Request
    *@return Yajra\DataTables\DataTable
    */
    public function listarAlerta(Request $request)
    {
          $Notificaciones = Notificaciones::select('PK_NTFC_Notificacion','NTFC_Titulo', 'NTFC_Bandera')
              ->where('NTFC_bandera','NO VISTO')
              ->where('FK_TBL_Usuarios_Id',$request->user()->identity_no)
              ->get();
        return Datatables::of($Notificaciones)->addIndexColumn()->make(true);
    }
    /*funcion para la vista completa del mensaje de la alertas en ajax
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function verAlerta($id)
    {
        $Bandera = Notificaciones::findOrFail($id);
        $Bandera->Bandera = 'VISTO';
        $Bandera->save();
        $Notificacion = TBL_Notificaciones::findOrFail($id);
        return view($this->path.'.Ver_Notificacion', compact('Notificacion'));
    }
   
}
