<?php

namespace App\Container\CalidadPcs\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;

use App\Container\CalidadPcs\src\Procesos;
use App\Container\CalidadPcs\src\Proyectos;
use App\Container\CalidadPcs\src\Proceso_Proyecto;
use App\Container\CalidadPcs\src\Etapas;
use App\Container\CalidadPcs\src\Usuarios;
use App\Container\CalidadPcs\src\EquipoScrum;
use App\Container\CalidadPcs\src\ProcesoCronograma;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ProcesosController extends Controller
{   
    //Etapas

    /**
     * Muestra todos los procesos registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id_Proyecto
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjaxEtapa(Request $request, $id)
    {   
        $etapa1=0;
        $etapa2=0;
        $etapa3=0;
        $etapa4=0;
        $etapa5=0;
        $conteoEtapa=0;
        $procesos = Proceso_Proyecto::where('FK_CPP_Id_Proyecto',$id);
        $aux = $procesos->count();
        if($aux == 0){
            $conteoEtapa = 1;
        }else{
            if($aux >=1){
                $conteoEtapa = 2;
            }else{
                if($aux >=9){
                    $conteoEtapa = 3;
                }else{
                    if($aux >=15){
                        $conteoEtapa = 4;
                    }else{
                        if($aux >=24){
                            $conteoEtapa = 5;
                        }
                    }
                }
            }
        }
        if($aux <= 1){
            $etapa1 = ($aux*100)/1;
        }else{
            $etapa1 = 100;
            $aux= $aux - 1;
            if($aux < 8){
                $etapa2 = ($aux*100)/8;
            }else{
                $etapa2 = 100;
                $aux = $aux - 8;
                if($aux < 6){
                    $etapa3 = ($aux*100)/6;
                }else{
                    $etapa3 = 100;
                    $aux = $aux - 6;
                    if($aux < 9){
                        $etapa4 = ($aux*100)/9;
                    }else{
                        $etapa4=100;
                        $aux = $aux - 9;
                        if($aux <= 1){
                            $etapa5 = ($aux * 100)/1;
                        }
                    }
                }
            }
        }
        $numProcesos = $procesos->count() + 1;
        $porcentajesEtapas =[$etapa1,$etapa2,$etapa3,$etapa4,$etapa5];
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('calidadpcs.etapas.tablaEtapasAjax',
            [
                'idProyecto' => $id,
                'numProcesos' =>$numProcesos,
                'porcentajes' =>$porcentajesEtapas,
                'conteoEtapa' => $conteoEtapa,
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
    public function tablaEtapas(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return Datatables::of(Etapas::all())
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    //Procesos

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
    public function indexAjax(Request $request, $idEtapa, $idProyecto)
    {
        $procesos = Proceso_Proyecto::where('FK_CPP_Id_Proyecto',$idProyecto);
        $numProcesos = $procesos->count() + 1;
        $etapa = Etapas::where('PK_CE_Id_Etapa',$idEtapa)->first();
        $nomEtapa = $etapa->CE_Etapa;
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('calidadpcs.procesos.ajaxTablaProcesos',
            [
                'idProyecto' => $idProyecto,
                'idEtapa' => $idEtapa,
                'numProcesos' =>$numProcesos,
                'nomEtapa' => $nomEtapa,
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
    public function tablaProcesos(Request $request, $idEtapa)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $user2=Procesos::where('FK_CP_Id_Etapa',$idEtapa);

            return Datatables::of($user2)
                ->addIndexColumn()
                ->removeColumn('CP_Tipo_Parseo')
                /*->addColumn('Etapa', function ($user2){
                    $perfil=Etapas::where('PK_CE_Id_Etapa', $user2->FK_CP_Id_Etapa)->first();
                    return $perfil['CE_Etapa'];
                })*/
                ->make(true);
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
    public function tablaCronograma(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return Datatables::of(ProcesoCronograma::where('FK_CPP_Id_Proyecto',$idProyecto))
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el formulario de registro de un nuevo proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function registrarActividad(Request $request, $id, $idProyecto)//
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('calidadpcs.procesos.formularios.cronograma.agregarActividad',
                [
                    'idProceso' => $id,
                    'idProyecto' => $idProyecto,
                ]);
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
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto',$idProyecto)->get();
            if($id == 1){
                $existeProceso = Proceso_Proyecto::where('FK_CPP_Id_Proyecto',$idProyecto)->where('FK_CPP_Id_Proceso',$id)->get();
                if($existeProceso == '[]'){
                    return view('calidadpcs.procesos.formularios.proceso1.actaInicio',
                        [
                            'idProceso' => $id,
                            'equipoScrum' => $equipoScrum,
                            'infoProyecto' => $infoProyecto,
                        ]);
                }else{

                    $IdError = 422;
                    return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'No se pudo completar la solicitud, ya se encuentra registrado ese proceso.',
                    $IdError
                    );
                }                
            }elseif($id == 2){
                return view('calidadpcs.procesos.formularios.proceso2.documento',
                    [
                        'idProceso' => $id,
                        'equipoScrum' => $equipoScrum,
                    ]);
            }elseif($id == 3){
                return view('calidadpcs.procesos.formularios.proceso3.cronograma.cronogramaTabla',
                [
                    'idProyecto' => $idProyecto,
                    'idProceso' => $id,
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
     * Función que muestra el formulario de registro de un nuevo proceso.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $idProyecto
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function editarFormulario(Request $request, $id, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
           
            $equipoScrum= EquipoScrum::where('FK_CE_Id_Proyecto',$idProyecto)->get();
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto',$idProyecto)->get();
            
            if($id == 1){
                $existeProceso = Proceso_Proyecto::where('FK_CPP_Id_Proyecto',$idProyecto)->where('FK_CPP_Id_Proceso',$id)->get();
                $dataProceso = $existeProceso[0]['CPP_Info_Proceso'];
                $data = json_decode($dataProceso);
                if($existeProceso == '[]'){
                    return AjaxResponse::success(
                        'Lo sentimos',
                        'No se pudo completar la solicitud, ya se encuentra registrado un proyecto con el mismo nombre.'
                    );
                }else{
                    return view('calidadpcs.procesos.formularios.proceso1.actaInicioEditar',
                        [
                            'idProceso' => $id,
                            'equipoScrum' => $equipoScrum,
                            'infoProyecto' => $infoProyecto,
                            'infoProceso' => $data,
                        ]);
                    
                }                
            }elseif($id == 2){
                return view('calidadpcs.procesos.formularios.documento',
                    [
                        'idProceso' => $id,
                        'equipoScrum' => $equipoScrum,
                    ]);
            }elseif($id == 3){
                return view('calidadpcs.procesos.formularios.cronogramaTabla');
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
            //Tabla Proyectos
            $Fecha = Carbon::parse($request['Fecha_Inicio']);
            $Fecha_Final = $Fecha->addMonth($request['Duracion']);

            $proyecto = Proyectos::find($request['FK_CPP_Id_Proyecto']);
            $proyecto->fill([
                'CP_Fecha_Final' => $Fecha_Final,
            ]);
            $proyecto->save();

            //Tabla Proyecto Proceso
            $data = $request->only('Numero_acta','Fecha_Inicio','Tipo_Proyecto','Objetivos','Compromiso','Nombre_Proyecto','Duracion','Entidades','Interesados','Financiacion');
            
                Proceso_Proyecto::create([
                    'CPP_Info_Proceso' => json_encode($data),
                    'FK_CPP_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
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
