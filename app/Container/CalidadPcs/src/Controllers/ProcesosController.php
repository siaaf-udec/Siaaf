<?php

namespace App\Container\CalidadPcs\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Container\CalidadPcs\src\Procesos;
use App\Container\CalidadPcs\src\Proceso_Proyecto;
use App\Container\CalidadPcs\src\Etapas;
use App\Container\CalidadPcs\src\Usuarios;
use App\Container\CalidadPcs\src\EquipoScrum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ProcesosController extends Controller
{
   
    /**
     * Muestra todos los procesos registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calidadpcs.procesos.tablaProcesos');

    }

    /**
     * Muestra todos los procesos registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id_Proyecto
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request, $id)
    {
        $procesos = Proceso_Proyecto::where('FK_CPP_Id_Proyecto',$id);
        $numProcesos = $procesos->count() + 1;
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('calidadpcs.procesos.ajaxTablaProcesos',
            [
                'idProyecto' => $id,
                'numProcesos' =>$numProcesos,
            ]); 
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

     /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaProcesos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $user2=Procesos::query();

            return Datatables::of($user2)
                ->removeColumn('CP_Tipo_Parseo')
                ->addColumn('Etapa', function ($user2){
                    $perfil=Etapas::where('PK_CE_Id_Etapa', $user2->FK_CP_Id_Etapa)->first();
                    return $perfil['CE_Etapa'];
                })
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el formulario de registro de un nuevo proceso.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $idProyecto
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function formulario(Request $request, $id, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
           
            $equipoScrum= EquipoScrum::where('FK_CE_Id_Proyecto',$idProyecto)->get();
            if($id == 1){
                $existeProceso = Proceso_Proyecto::where('FK_CPP_Id_Proyecto',$idProyecto)->where('FK_CPP_Id_Proceso',$id)->get();
                if($existeProceso == '[]'){
                    return view('calidadpcs.procesos.formularios.actaInicio',
                        [
                            'idProceso' => $id,
                            'equipoScrum' => $equipoScrum,
                        ]);
                }else{
                    $IdError = 422;
                    return AjaxResponse::fail(
                        'Lo sentimos',
                        'No se pudo completar la solicitud, ya se encuentra registrado un proyecto con el mismo nombre.',
                        $IdError
                    );
                }                
            }elseif($id == 2){
                return view('calidadpcs.procesos.formularios.documento',
                    [
                        'idProceso' => $id,
                        'equipoScrum' => $equipoScrum,
                    ]);
            }
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $data = $request->only('CE_Nombre_1','CE_Nombre_2','CE_Nombre_3','CE_Nombre_4');
            
                Proceso_Proyecto::create([
                    'CPP_Info_Proceso' => json_encode($data),
                    'FK_CPP_Id_Proyecto' => 1,
                    'FK_CPP_Id_Proceso' => $request['FK_CPP_Id_Proceso'],
                ]);
                                   
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos almacenados correctamente. '
                );
                }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
}
