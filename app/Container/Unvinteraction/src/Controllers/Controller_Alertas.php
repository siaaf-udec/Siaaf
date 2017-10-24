<?php
namespace App\Container\Unvinteraction\src\Controllers;
use App\Container\Unvinteraction\src\TBL_Usuarios;
use App\Container\Unvinteraction\src\TBL_Tipo_Usuario;
use App\Container\Unvinteraction\src\TBL_Estado_Usuario;
use App\Container\Unvinteraction\src\TBL_Carrera;
use App\Container\Unvinteraction\src\TBL_Facultad;
use App\Container\Unvinteraction\src\TBL_Documentacion;
use App\Container\Unvinteraction\src\TBL_Convenios;
use App\Container\Unvinteraction\src\TBL_Evaluacion;
use App\Container\Unvinteraction\src\TBL_Evaluacion_Preguntas;
use App\Container\Unvinteraction\src\TBL_Preguntas;
use App\Container\Unvinteraction\src\TBL_Sede;
use App\Container\Unvinteraction\src\TBL_Estado;
use App\Container\Unvinteraction\src\TBL_Empresas_Participantes;
use App\Container\Unvinteraction\src\TBL_Empresa;
use App\Container\Unvinteraction\src\TBL_Participantes;
use App\Container\Unvinteraction\src\TBL_Documentacion_Extra;
use App\Container\Unvinteraction\src\TBL_Notificaciones;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;


class Controller_Alertas extends Controller
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
    public function Alerta(Request $request)
    {
        $estado=1;
        $Convenio = TBL_Convenios::join('TBL_Participantes', 'TBL_Convenios.PK_Convenios', '=', 'TBL_Participantes.FK_TBL_Convenios')
            ->join('TBL_Estado', 'TBL_Convenios.FK_TBL_Estado', '=', 'TBL_Estado.PK_Estado')
            ->join('TBL_Sede', 'TBL_Convenios.FK_TBL_Sede', '=', 'TBL_Sede.PK_Sede')
            ->select('TBL_Convenios.PK_Convenios', 'TBL_Convenios.Nombre', 'TBL_Convenios.Fecha_Inicio', 'TBL_Convenios.Fecha_Fin', 'TBL_Estado.Estado', 'TBL_Sede.Sede')
            ->where('TBL_Participantes.FK_TBL_Usuarios', '=', $request->user()->identity_no)
            ->get();
        //calculo de la diferencia de fecha  para saber si hay que crear la  alerta
        $carbon = new \Carbon\Carbon();
        foreach ($Convenio as $row) {
            $dtVancouver = $carbon->now();
            $fecha = $carbon->createFromFormat('Y-m-d H',  $row->Fecha_Fin.' 00');
            $diferencia = $fecha->diffInDays($dtVancouver,false);
            $diferencia;
            if($estado == 1 && $diferencia >= 0  ){
                //si el convenio ya finalizo no se envia ninguna  alerta
             } else {
                if($estado == 1 && $diferencia >= -60 ){
                    $notificacion = new TBL_Notificaciones();
                    $notificacion->Titulo='Finalizacion convenio '.$row->Nombre;
                    $notificacion->Mensaje='El siguiente mensaje es para avisar que el convenio '.$row->Nombre.' en el cual se encuentra como participante esta a punto de finalizar, porfavor realizar las respectivas evaluaciones';
                    $notificacion->Bandera = 'NO VISTO';
                    $notificacion->FK_TBL_Usuarios = $request->user()->identity_no;
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
    public function Alerta_Ajax(Request $request)
    {
        return view($this->path.'.Listar_Notificaciones_Ajax');
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param \Illuminate\Http\Request
    *@return Yajra\DataTables\DataTable
    */
    public function Listar_Alerta(Request $request)
    {
          $Notificaciones = TBL_Notificaciones::select('PK_Notificacion','Titulo', 'Bandera')
              ->where('bandera','NO VISTO')
              ->where('FK_TBL_Usuarios',$request->user()->identity_no)
              ->get();
        return Datatables::of($Notificaciones)->addIndexColumn()->make(true);
    }
    /*funcion para la vista completa del mensaje de la alertas en ajax
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function Ver_Alerta($id)
    {
        $Bandera = TBL_Notificaciones::findOrFail($id);
        $Bandera->Bandera = 'VISTO';
        $Bandera->save();
        $Notificacion = TBL_Notificaciones::findOrFail($id);
        return view($this->path.'.Ver_Notificacion', compact('Notificacion'));
    }
    /*funcion prueba 
    *
    *@return \Illuminate\Http\Response
    */
    public function Reporte()
    {
        return view($this->path.'.Ver_Reporte');
    }
}
