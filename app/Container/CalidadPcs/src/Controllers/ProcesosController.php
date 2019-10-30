<?php

namespace App\Container\CalidadPcs\src\Controllers;

use App\Container\CalidadPcs\src\Costos;
use App\Container\CalidadPcs\src\Costos_Informacion;
use Illuminate\Http\Request;
use Illuminate\Http\File;

use App\Container\CalidadPcs\src\Procesos;
use App\Container\CalidadPcs\src\Proyectos;
use App\Container\CalidadPcs\src\Proceso_Proyecto;
use App\Container\CalidadPcs\src\Etapas;
use App\Container\CalidadPcs\src\EquipoScrum;
use App\Container\CalidadPcs\src\Proceso_Adquisiciones;
use App\Container\CalidadPcs\src\Proceso_Aseguramiento;
use App\Container\CalidadPcs\src\Proceso_Comunicacion;
use App\Container\CalidadPcs\src\Proceso_Direccion;
use App\Container\CalidadPcs\src\Proceso_Gestionar_Comunicaciones;
use App\Container\CalidadPcs\src\Proceso_Objetivos;
use App\Container\CalidadPcs\src\Proceso_Participacion;
use App\Container\CalidadPcs\src\Proceso_Recursos;
use App\Container\CalidadPcs\src\ProcesoCronograma;
use App\Container\CalidadPcs\src\Proceso_Requerimientos;
use App\Container\CalidadPcs\src\Proceso_Riesgos;
use App\Container\CalidadPcs\src\Rol_Scrum;
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
    public function indexTablaAjaxEtapa(Request $request, $id)
    {
        $etapa1 = 0;
        $etapa2 = 0;
        $etapa3 = 0;
        $etapa4 = 0;
        $etapa5 = 0;
        $conteoEtapa = 0;
        $procesos = Proceso_Proyecto::where('FK_CPP_Id_Proyecto', $id);
        $aux = $procesos->count();
        if ($aux == 0) {
            $conteoEtapa = 1;
        } else {
            if ($aux >= 1) {
                $conteoEtapa = 2;
                if ($aux >= 9) {
                    $conteoEtapa = 3;
                    if ($aux >= 15) {
                        $conteoEtapa = 4;
                        if ($aux >= 24) {
                            $conteoEtapa = 5;
                        }
                    }
                }
            }
        }
        if ($aux <= 1) {
            $etapa1 = ($aux * 100) / 1;
        } else {
            $etapa1 = 100;
            $aux = $aux - 1;
            if ($aux < 8) {
                $etapa2 = ($aux * 100) / 8;
                $etapa2 = bcdiv($etapa2, '1', 1);
            } else {
                $etapa2 = 100;
                $aux = $aux - 8;
                if ($aux < 6) {
                    $etapa3 = ($aux * 100) / 6;
                    $etapa3 = bcdiv($etapa3, '1', 1);
                } else {
                    $etapa3 = 100;
                    $aux = $aux - 6;
                    if ($aux < 9) {
                        $etapa4 = ($aux * 100) / 9;
                        $etapa4 = bcdiv($etapa4, '1', 1);
                    } else {
                        $etapa4 = 100;
                        $aux = $aux - 9;
                        if ($aux <= 2) {
                            if ($aux == 2) {
                                $aux = 1;
                            }
                            $etapa5 = ($aux * 100) / 1;
                        }
                    }
                }
            }
        }
        $numProcesos = $procesos->count() + 1;
        $porcentajesEtapas = [$etapa1, $etapa2, $etapa3, $etapa4, $etapa5];
        if ($request->ajax() && $request->isMethod('GET')) {
            return view(
                'calidadpcs.etapas.tablaEtapasAjax',
                [
                    'idProyecto' => $id,
                    'numProcesos' => $numProcesos,
                    'porcentajes' => $porcentajesEtapas,
                    'conteoEtapa' => $conteoEtapa,
                ]
            );
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
    public function indexAjaxProcesos(Request $request, $idEtapa, $idProyecto)
    {
        $procesos = Proceso_Proyecto::where('FK_CPP_Id_Proyecto', $idProyecto);
        $numProcesos = $procesos->count();
        if ($numProcesos == null) {
            $numProcesos = 0;
        }
        $numProcesos = $procesos->count() + 1;
        $etapa = Etapas::where('PK_CE_Id_Etapa', $idEtapa)->first();
        $nomEtapa = $etapa->CE_Etapa;
        if ($request->ajax() && $request->isMethod('GET')) {
            return view(
                'calidadpcs.procesos.ajaxTablaProcesos',
                [
                    'idProyecto' => $idProyecto,
                    'idEtapa' => $idEtapa,
                    'numProcesos' => $numProcesos,
                    'nomEtapa' => $nomEtapa,
                ]
            );
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

            $user2 = Procesos::where('FK_CP_Id_Etapa', $idEtapa);

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
     * Función que muestra el formulario de registro de un nuevo proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function registrarActividad(Request $request, $id, $idProyecto) //
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view(
                'calidadpcs.procesos.formularios.cronograma.agregarActividad',
                [
                    'idProceso' => $id,
                    'idProyecto' => $idProyecto,
                ]
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
    public function formulario(Request $request, $id, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $equipoScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->get();
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $idProyecto)->get();
            if ($id == 1) {
                $existeProceso = Proceso_Proyecto::where('FK_CPP_Id_Proyecto', $idProyecto)->where('FK_CPP_Id_Proceso', $id)->get();
                if ($existeProceso == '[]') {
                    return view(
                        'calidadpcs.procesos.formularios.proceso1.actaInicio',
                        [
                            'idProceso' => $id,
                            'equipoScrum' => $equipoScrum,
                            'infoProyecto' => $infoProyecto,
                        ]
                    );
                } else {

                    $IdError = 422;
                    return AjaxResponse::success(
                        '¡Lo sentimos!',
                        'No se pudo completar la solicitud, ya se encuentra registrado ese proceso.',
                        $IdError
                    );
                }
            } elseif ($id == 2) {
                return view(
                    'calidadpcs.procesos.formularios.proceso2.documento',
                    [
                        'idProyecto' => $idProyecto,
                        'idProceso' => $id,
                        'equipoScrum' => $equipoScrum,
                    ]
                );
            } elseif ($id == 3) {
                $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $idProyecto)->get()->pluck('CPR_Nombre_Requerimiento', 'PK_CPR_Id_Requerimientos')->toArray();
                $integrantesScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->where('FK_CE_Id_Rol', 5)->get()->pluck('CE_Nombre_Persona', 'PK_CE_Id_Equipo_Scrum')->toArray();
                return view(
                    'calidadpcs.procesos.formularios.proceso3.cronograma.cronogramaTabla',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                        'requerimientos' => $requerimientos,
                        'integrantes' => $integrantesScrum,
                    ]
                );
            } elseif ($id == 4) {
                return view(
                    'calidadpcs.procesos.formularios.proceso4.costosTabla',
                    [
                        'idProyecto' => $idProyecto,
                        'idProceso' => $id
                    ]
                );
            } elseif ($id == 5) {
                $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $idProyecto)->get()->pluck('CPR_Nombre_Requerimiento', 'PK_CPR_Id_Requerimientos')->toArray();
                $integrantesScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->where('FK_CE_Id_Rol', 5)->get()->pluck('CE_Nombre_Persona', 'PK_CE_Id_Equipo_Scrum')->toArray();
                return view(
                    'calidadpcs.procesos.formularios.proceso5.gestionCalidadTabla',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                        'requerimientos' => $requerimientos,
                        'integrantes' => $integrantesScrum,
                    ]
                );
            } elseif ($id == 6) {
                $integrantesScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->with('relacionDependenciaUsuario')->get()->pluck('CE_Nombre_Persona', 'PK_CE_Id_Equipo_Scrum')->toArray();
                // $integrantesScrum = EquipoScrum::select('PK_CE_Id_Equipo_Scrum','CE_Nombre_Persona','relacionDependenciaUsuario.CR_Nombre_Rol_Scrum as rol')->with('relacionDependenciaUsuario')->get();
                // dd($integrantesScrum);
                return view(
                    'calidadpcs.procesos.formularios.proceso6.gestionRecursosHumanos',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                        'integrantes' => $integrantesScrum,
                    ]
                );
            } elseif ($id == 7) {
                return view(
                    'calidadpcs.procesos.formularios.proceso7.gestionComunicaciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 8) {
                return view(
                    'calidadpcs.procesos.formularios.proceso8.gestionRiesgos',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 9) {
                return view(
                    'calidadpcs.procesos.formularios.proceso9.gestionAdquisiciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 10) {
                $alcance = Proceso_Direccion::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso10.planDeDireccion',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                        'alcance' => $alcance,
                    ]
                );
            } elseif ($id == 11) {
                return view(
                    'calidadpcs.procesos.formularios.proceso11.aseguramientoCalidad',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 12) {
                return view(
                    'calidadpcs.procesos.formularios.proceso12.dirigirEquipo',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 13) {
                return view(
                    'calidadpcs.procesos.formularios.proceso13.gestionarComunicaciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 14) {
                return view(
                    'calidadpcs.procesos.formularios.proceso14.EfectuarAdquisiciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 15) {
                return view(
                    'calidadpcs.procesos.formularios.proceso15.gestionarParticipacion',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 16) {
                return view(
                    'calidadpcs.procesos.formularios.proceso16.controlarTrabajo',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 17) {
                return view(
                    'calidadpcs.procesos.formularios.proceso17.controlarAlcance',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 18) {
                return view(
                    'calidadpcs.procesos.formularios.proceso18.controlarCronograma',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 19) {
                return view(
                    'calidadpcs.procesos.formularios.proceso19.controlarCostos',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 20) {
                $calidad = Proceso_Aseguramiento::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso20.controlarCalidad',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                        'calidad' => $calidad
                    ]
                );
            } elseif ($id == 21) {
                return view(
                    'calidadpcs.procesos.formularios.proceso21.controlarComunicaciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 22) {
                return view(
                    'calidadpcs.procesos.formularios.proceso22.controlarRiesgos',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 23) {
                return view(
                    'calidadpcs.procesos.formularios.proceso23.controlarAdquisiciones',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            } elseif ($id == 24) {
                $interesados = Proceso_Participacion::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso24.controlarInteresados',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                        'interesados' => $interesados
                    ]
                );
            } elseif ($id == 25) {
                return view(
                    'calidadpcs.procesos.formularios.proceso25.cerrarProyecto',
                    [
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'idProceso' => $id,
                    ]
                );
            }
        } else {
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

            $equipoScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->get();
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $idProyecto)->get();

            if ($id == 1) {
                return view(
                    'calidadpcs.procesos.formularios.proceso1.actaInicioEditar',
                    [
                        'idProceso' => $id,
                        'equipoScrum' => $equipoScrum,
                        'infoProyecto' => $infoProyecto,
                        'idProyecto' => $idProyecto
                    ]
                );
            } elseif ($id == 2) {
                $infoProceso = Proceso_Direccion::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso2.EditarDocumento',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProceso' => $infoProceso,
                        'equipoScrum' => $equipoScrum,
                    ]
                );
            } elseif ($id == 3) {
                $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $idProyecto)->get()->pluck('CPR_Nombre_Requerimiento', 'PK_CPR_Id_Requerimientos')->toArray();
                $integrantesScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->where('FK_CE_Id_Rol', 5)->get()->pluck('CE_Nombre_Persona', 'PK_CE_Id_Equipo_Scrum')->toArray();
                return view(
                    'calidadpcs.procesos.formularios.proceso3.cronograma.editarCronograma',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'requerimientos' => $requerimientos,
                        'integrantes' => $integrantesScrum,
                    ]
                );
            } elseif ($id == 4) {
                return view(
                    'calidadpcs.procesos.formularios.proceso4.EditarCostos',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 5) {
                return view(
                    'calidadpcs.procesos.formularios.proceso5.editarGestionCalidad',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                    ]
                );
            } elseif ($id == 6) {
                $integrantesScrum = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->with('relacionDependenciaUsuario')->get()->pluck('CE_Nombre_Persona', 'PK_CE_Id_Equipo_Scrum')->toArray();
                return view(
                    'calidadpcs.procesos.formularios.proceso6.editarGestionRecursosHumanos',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'integrantes' => $integrantesScrum,
                    ]
                );
            } elseif ($id == 7) {
                return view(
                    'calidadpcs.procesos.formularios.proceso7.editarGestionComunicaciones',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                    ]
                );
            } elseif ($id == 8) {
                return view(
                    'calidadpcs.procesos.formularios.proceso8.editarGestionRiesgos',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                    ]
                );
            } elseif ($id == 9) {
                return view(
                    'calidadpcs.procesos.formularios.proceso9.editarGestionAdquisiciones',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                    ]
                );
            } elseif ($id == 10) {
                $alcance = Proceso_Direccion::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso10.editarPlanDeDireccion',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                        'alcance' => $alcance,

                    ]
                );
            } elseif ($id == 11) {
                $practicas = Proceso_Aseguramiento::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso11.editarAseguramientoCalidad',
                    [
                        'practicas' => $practicas,
                    ]
                );
            } elseif ($id == 12) {
                return view(
                    'calidadpcs.procesos.formularios.proceso12.editarDirigirEquipo',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'infoProyecto' => $infoProyecto,
                    ]
                );
            } elseif ($id == 13) {
                $comunicacion = Proceso_Gestionar_Comunicaciones::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso13.editarGestionComunicaciones',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'comunicacion' => $comunicacion,
                    ]
                );
            } elseif ($id == 14) {
                return view(
                    'calidadpcs.procesos.formularios.proceso14.editarEfectuarAdquisiciones',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 15) {
                $participacion = Proceso_Participacion::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso15.editarGestionarParticipacion',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'participacion' => $participacion
                    ]
                );
            } elseif ($id == 16) {
                return view(
                    'calidadpcs.procesos.formularios.proceso16.editarControlarTrabajo',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 17) {
                return view(
                    'calidadpcs.procesos.formularios.proceso17.editarControlarAlcance',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 18) {
                return view(
                    'calidadpcs.procesos.formularios.proceso18.editarControlarCronograma',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 19) {
                return view(
                    'calidadpcs.procesos.formularios.proceso19.editarControlarCostos',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 20) {
                $calidad = Proceso_Aseguramiento::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso20.editarControlarCalidad',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'calidad' => $calidad,
                    ]
                );
            } elseif ($id == 21) {
                return view(
                    'calidadpcs.procesos.formularios.proceso21.editarControlarComunicaciones',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 22) {
                return view(
                    'calidadpcs.procesos.formularios.proceso22.editarControlarRiesgos',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 23) {
                return view(
                    'calidadpcs.procesos.formularios.proceso23.editarControlarAdquisiciones',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            } elseif ($id == 24) {
                $interesados = Proceso_Participacion::where('FK_CPC_Id_Proyecto', $idProyecto)->first();
                return view(
                    'calidadpcs.procesos.formularios.proceso24.editarControlarInteresados',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                        'interesados' => $interesados

                    ]
                );
            } elseif ($id == 25) {
                return view(
                    'calidadpcs.procesos.formularios.proceso25.editarCerrarProyecto',
                    [
                        'idProceso' => $id,
                        'idProyecto' => $idProyecto,
                    ]
                );
            }
        } else {
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
    public function storeProceso(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            // dd($request);
            //Tabla Proyectos
            $Fecha = Carbon::parse($request['Fecha_Inicio']);
            $Fecha_Final = $Fecha->addMonth($request['Duracion']);
            $proyecto = Proyectos::find($request['FK_CPP_Id_Proyecto']);
            $proyecto->fill([
                'CP_Fecha_Final' => $Fecha_Final,
                'CP_Duracion' => $request['Duracion'],
                'CP_Entidades' => $request['Entidades']
            ]);
            $proyecto->save();

            //Tabla Proyecto Proceso
            if ($request['Objetivo_General']) {
                Proceso_Objetivos::create([
                    'CO_Objetivo' => $request['Objetivo_General'],
                    'CO_Tipo_Objetivo' => 1,
                    'FK_CPC_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                ]);
            }

            for ($i = 1; $i < 6; $i++) {
                if ($request['Objetivo_Especifico_' . $i . ''] == '' || $request['Objetivo_Especifico_' . $i . ''] == 'undefined') { } else {
                    Proceso_Objetivos::create([
                        'CO_Objetivo' => $request['Objetivo_Especifico_' . $i . ''],
                        'CO_Tipo_Objetivo' => 2,
                        'FK_CPC_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                    ]);
                }
            }

            // Tabla requerimientos
            for ($i = 1; $i < 16; $i++) {
                if ($request['CPR_Nombre_Requerimiento_' . $i . ''] == '' || $request['CPR_Nombre_Requerimiento_' . $i . ''] == 'undefined') { } else {
                    Proceso_Requerimientos::create([
                        'CPR_Nombre_Requerimiento' => $request['CPR_Nombre_Requerimiento_' . $i . ''],
                        'FK_CPR_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                    ]);
                }
            }

            //Tabla proyecto proceso
            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => 'El proceso Desarrollar acta de constitución del proyecto, se creo correctamente',
                'FK_CPP_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['FK_CPP_Id_Proceso']
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
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $objetivo = Proyectos::find($request['FK_CPP_Id_Proyecto']);
            $objetivo->fill([
                'CP_Entidades' => $request['Entidades'],
            ]);
            $objetivo->save();

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
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeObjetivo(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Objetivos::create([
                'CO_Objetivo' => $request['Objetivo'],
                'CO_Tipo_Objetivo' => 2,
                'FK_CPC_Id_Proyecto' => $request['idProyecto'],
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

    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateObjetivo(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $objetivo = Proceso_Objetivos::find($request['idObjetivo']);
            $objetivo->fill([
                'CO_Objetivo' => $request['Objetivo'],
            ]);
            $objetivo->save();

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
     * Se realiza la eliminación de los registros de un vehículo.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function deleteObjetivo(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            Proceso_Objetivos::destroy($id);
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

    // 
    // PROCESO #2 
    // 

    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso2(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //Tabla Proyecto Proceso
            //$data = $request->only('Numero_acta', 'Fecha_Inicio', 'Tipo_Proyecto', 'Nombre_Proyecto', 'Duracion', 'Entidades', 'Objetivo_General', 'Objetivo_Especifico_1', 'Objetivo_Especifico_2', 'Objetivo_Especifico_3', 'Objetivo_Especifico_4', 'Objetivo_Especifico_5');
            Proceso_Direccion::create([
                'CPPD_Alcance' => $request['Alcance'],
                'FK_CPC_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
            ]);
            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => 'El proceso desarrollar plan para la dirección del proyecto, se creo correctamente',
                'FK_CPP_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['FK_CPP_Id_Proyecto']
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
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso2(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $alcance = Proceso_Direccion::find($request['idAlcance']);
            $alcance->fill([
                'CPPD_Alcance' => $request['Alcance'],
            ]);
            $alcance->save();

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
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeRequerimiento(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Requerimientos::create([
                'CPR_Nombre_Requerimiento' => $request['Requerimiento'],
                'FK_CPR_Id_Proyecto' => $request['idProyecto'],
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

    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateRequerimiento(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $requerimiento = Proceso_Requerimientos::find($request['idRequerimiento']);
            $requerimiento->fill([
                'CPR_Nombre_Requerimiento' => $request['Requerimiento'],
            ]);
            $requerimiento->save();

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
     * Se realiza la eliminación de los registros de un vehículo.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function deleteRequerimiento(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            Proceso_Requerimientos::destroy($id);
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

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaRequerimientos(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $idProyecto);

            return Datatables::of($requerimientos)
                ->addIndexColumn()
                ->removeColumn('FK_CPR_Id_Proceso')
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    // 
    //Proceso #3
    //

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaCronograma(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $cronograma = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $idProyecto);
            return Datatables::of($cronograma)
                ->addIndexColumn()
                ->addColumn('RecursoNombre', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Recurso;
                    $nombres = explode(',', $item);
                    $perfil = EquipoScrum::whereIn('PK_CE_Id_Equipo_Scrum', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CE_Nombre_Persona']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->addColumn('RequerimientoNombre', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Requerimiento;
                    $nombres = explode(',', $item);
                    $perfil = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CPR_Nombre_Requerimiento']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->make(true);
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
    public function storeProceso3(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $sprint = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $request['FK_CPP_Id_Proyecto'])->get();
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $request['FK_CPP_Id_Proyecto'])->first();
            if ($sprint == '[]') {
                $fechaFin = Carbon::parse($infoProyecto['CP_Fecha_Inicio'])->addWeeks($request['CPC_Duracion']);
            } else {
                $sem = 0;
                foreach ($sprint as $value) {
                    $sem += $value['CPC_Duracion'];
                }
                $fechaFin = Carbon::parse($infoProyecto['CP_Fecha_Inicio'])->addWeeks($request['CPC_Duracion'] + $sem);
            }

            ProcesoCronograma::create([
                'CPC_Nombre_Sprint' => $request['CPC_Nombre_Sprint'],
                'CPC_Requerimiento' => $request['CPC_Requerimiento'],
                'CPC_Duracion' => $request['CPC_Duracion'],
                'CPC_Recurso' => $request['CPC_Recurso'],
                'CPC_Fecha_Fin_Sprint' => $fechaFin,
                'FK_CPP_Id_Proyecto' => $request['FK_CPP_Id_Proyecto'],
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
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso3(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $sprint = ProcesoCronograma::find($request['idSprint']);
            $sprint->fill([
                'CPC_Nombre_Sprint' => $request['CPC_Nombre_Sprint'],
                'CPC_Requerimiento' => $request['CPC_Requerimiento'],
                'CPC_Recurso' => $request['CPC_Recurso'],
            ]);
            $sprint->save();

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
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso3_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestion del tiempo, se creo correctamente",
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

    // 
    // PROCESO #4
    // 

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaCostosInformacion(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return Datatables::of(Costos_Informacion::all())
                ->make(true);
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
    public function storeProceso4(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Costos::create([
                'CPC_Valor' => $request['valor'],
                'FK_CPC_Id_Formula' => $request['id_formula'],
                'FK_CPC_Id_Proyecto' => $request['FK_CPC_Id_Proyecto'],
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

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaCostos(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $costos = Costos::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($costos)
                ->addIndexColumn()
                ->addColumn('Formula', function ($costos) {
                    $perfil = Costos_Informacion::where('PK_CPCI_Id_Costos', $costos->FK_CPC_Id_Formula)->first();
                    return $perfil['CPCI_Nombre'];
                })
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Se realiza la eliminación de los registros de un vehículo.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroyCosto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            //$infoIngresos = Ingresos::where('CI_CodigoMoto','=',$id)->delete();
            Costos::destroy($id);
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
    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso4_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestion de los costos, se creo correctamente",
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


    // 
    // PROCESO #5
    // 

    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaGestionCalidad(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $cronograma = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $idProyecto);
            return Datatables::of($cronograma)
                ->addIndexColumn()
                ->addColumn('RecursoNombre', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Recurso;
                    $nombres = explode(',', $item);
                    $perfil = EquipoScrum::whereIn('PK_CE_Id_Equipo_Scrum', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CE_Nombre_Persona']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->addColumn('RequerimientoNombre', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Requerimiento;
                    $nombres = explode(',', $item);
                    $perfil = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CPR_Nombre_Requerimiento']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agregarEntrega(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $info = ProcesoCronograma::find($id);
            $Nnombres = [];
            $item = $info->CPC_Recurso;
            $nombres = explode(',', $item);
            $perfil = EquipoScrum::whereIn('PK_CE_Id_Equipo_Scrum', $nombres)->get();
            foreach ($perfil as $value) {
                array_push($Nnombres, $value['CE_Nombre_Persona']);
            }
            $valores = implode(", ", $Nnombres);
            $info->responsables = $valores;

            $Nnombres2 = [];
            $item2 = $info->CPC_Requerimiento;
            $nombres2 = explode(',', $item2);
            $perfil2 = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres2)->get();
            foreach ($perfil2 as $value2) {
                array_push($Nnombres2, $value2['CPR_Nombre_Requerimiento']);
            }
            $valores2 = implode(", ", $Nnombres2);
            $info->requerimientos = $valores2;

            // dd($info);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.',
                $info
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso5(Request $request, $id_sprint)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $sprint = ProcesoCronograma::find($id_sprint);
            $sprint->fill([
                'CPC_Entregable' => $request['CPC_Entregable'],
            ]);
            $sprint->save();

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
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso5(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestion de la calidad, se creo correctamente",
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

    // 
    // PROCESO #6
    // 

    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso6(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Recursos::create([
                'CPGR_Funcion' => $request['CPGR_Funcion'],
                'FK_CPGR_Id_Equipo' => $request['FK_CPGR_Id_Equipo'],
                'FK_CPC_Id_Proyecto' => $request['FK_CPC_Id_Proyecto'],
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
    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso6_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestion de los recursos, se creo correctamente",
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
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso6(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $funcion = Proceso_Recursos::find($request['idFuncion']);
            $funcion->fill([
                'CPGR_Funcion' => $request['Funcion'],
                'FK_CPGR_Id_Equipo' => $request['idEquipo'],
            ]);
            $funcion->save();

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
     * Se realiza la eliminación de los registros de un vehículo.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function deleteProceso6(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            Proceso_Recursos::destroy($id);
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
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaGestionRecursos(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $recursos = Proceso_Recursos::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($recursos)
                ->addIndexColumn()
                ->addColumn('RecursoNombre', function ($recursos) {
                    $Nnombres = [];
                    $item = $recursos->FK_CPGR_Id_Equipo;
                    $nombres = explode(',', $item);
                    $perfil = EquipoScrum::whereIn('PK_CE_Id_Equipo_Scrum', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CE_Nombre_Persona']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    // 
    // PROCESO #7
    // 
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaGestionComunicacion(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $recursos = Proceso_Comunicacion::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($recursos)
                ->addIndexColumn()
                ->make(true);
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
    public function storeProceso7(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $fecha = Carbon::parse($request['date_time']);
            Proceso_Comunicacion::create([
                'CPGC_Interesado' => $request['Interesado'],
                'CPGC_Lugar' => $request['Lugar'],
                'CPGC_Fecha' => $fecha,
                'FK_CPC_Id_Proyecto' => $request['FK_CPC_Id_Proyecto'],
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
    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso7_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestion de las comunicaciones, se creo correctamente",
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
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso7(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $fecha = Carbon::parse($request['fecha']);
            $funcion = Proceso_Comunicacion::find($request['idReunion']);
            $funcion->fill([
                'CPGC_Interesado' => $request['interesado'],
                'CPGC_Lugar' => $request['lugar'],
                'CPGC_Fecha' => $fecha,
            ]);
            $funcion->save();

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
     * Se realiza la eliminación de los registros de un vehículo.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function deleteProceso7(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            Proceso_Comunicacion::destroy($id);
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

    /**
     * 
     * 
     * PROCESO #8
     * 
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaGestionRiesgos(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $recursos = Proceso_Riesgos::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($recursos)
                ->addIndexColumn()
                ->make(true);
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
    public function storeProceso8(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            Proceso_Riesgos::create([
                'CPGR_Riesgo' => $request['Riesgo'],
                'CPGR_Caracteristicas' => $request['Caracteristicas'],
                'CPGR_Importancia' => $request['Importancia'],
                'CPGR_Accion' => $request['Accion'],
                'FK_CPC_Id_Proyecto' => $request['FK_CPC_Id_Proyecto'],
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
    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso8_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestion de los riesgos, se creo correctamente",
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
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso8(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $riesgo = Proceso_Riesgos::find($request['idRiesgo']);
            $riesgo->fill([
                'CPGR_Riesgo' => $request['Riesgo'],
                'CPGR_Caracteristicas' => $request['Caracteristica'],
                'CPGR_Importancia' => $request['Importancia'],
                'CPGR_Accion' => $request['Accion'],
            ]);
            $riesgo->save();

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
     * Se realiza la eliminación de los registros de un vehículo.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function deleteProceso8(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            Proceso_Riesgos::destroy($id);
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


    /**
     * 
     * 
     * PROCESO #9
     * 
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaGestionAdquisiciones(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $recursos = Proceso_Adquisiciones::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($recursos)
                ->addIndexColumn()
                ->make(true);
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
    public function storeProceso9(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            Proceso_Adquisiciones::create([
                'CPGA_Adquisicion' => $request['Adquisicion'],
                'CPGA_Costo' => $request['Costo'],
                'CPGA_Duracion' => $request['Duracion'],
                'FK_CPC_Id_Proyecto' => $request['FK_CPC_Id_Proyecto'],
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
    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso9_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestion de las adquisiciones, se creo correctamente",
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
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso9(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $riesgo = Proceso_Adquisiciones::find($request['idAdquisicion']);
            $riesgo->fill([
                'CPGA_Adquisicion' => $request['Adquisicion'],
                'CPGA_Costo' => $request['Costo'],
                'CPGA_Duracion' => $request['Duracion'],
            ]);
            $riesgo->save();

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
     * Se realiza la eliminación de los registros de un vehículo.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function deleteProceso9(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            Proceso_Adquisiciones::destroy($id);
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


    /**
     * 
     * 
     * PROCESO #10
     * 
     * 
     */
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso10(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $metodologia = Proceso_Direccion::find($request['id_metodologia']);
            $metodologia->fill([
                'CPPD_Metodologia' => $request['Metodologia'],
            ]);
            $metodologia->save();

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Plan para la Dirección del proyecto, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['Proyecto_id'],
                'FK_CPP_Id_Proceso' => $request['Proceso_id'],
            ]);


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
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso10(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $metodologia = Proceso_Direccion::find($request['id_metodologia']);
            $metodologia->fill([
                'CPPD_Metodologia' => $request['Metodologia'],
            ]);
            $metodologia->save();

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
     * 
     * 
     * PROCESO #11
     * 
     * 
     */
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso11(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            // $metodologia = Proceso_Aseguramiento::find($request['id_metodologia']);
            Proceso_Aseguramiento::create([
                'CPA_Aseguramiento' => $request['Practicas'],
                'FK_CPC_Id_Proyecto' => $request['Proyecto_id'],
            ]);
            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Aseguramiento de calidad, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['Proyecto_id'],
                'FK_CPP_Id_Proceso' => $request['Proceso_id'],
            ]);


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
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso11(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $aseguramiento = Proceso_Aseguramiento::find($request['idAseguramiento']);
            $aseguramiento->fill([
                'CPA_Aseguramiento' => $request['Aseguramiento'],
            ]);
            $aseguramiento->save();

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
     * 
     * 
     * 
     * PROCESO #12
     * 
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaEquipo(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $integrantes = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto);
            return Datatables::of($integrantes)
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso12(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $integrante = EquipoScrum::find($request['idEquipoScrum']);
            $integrante->fill([
                'CE_Horas_Trabajadas' => $request['tiempoTrabajo'],
            ]);
            $integrante->save();

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
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso12_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Adquirir, desarrollar y dirigir equipo del proyecto, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['Id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['Id_Proceso'],
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

    /**
     * 
     * PROCESO #13
     * 
     */
    /**
     * Se realiza la actualización de los datos de un proyecto. 
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso13(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            // $metodologia = Proceso_Aseguramiento::find($request['id_metodologia']);
            Proceso_Gestionar_Comunicaciones::create([
                'CPC_Medio' => $request['Medio'],
                'CPC_Redaccion' => $request['Redaccion'],
                'FK_CPC_Id_Proyecto' => $request['Proyecto_id'],
            ]);
            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestionar las Comunicaciones, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['Proyecto_id'],
                'FK_CPP_Id_Proceso' => $request['Proceso_id'],
            ]);


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
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function info13(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $data = Proceso_Gestionar_Comunicaciones::where('FK_CPC_Id_Proyecto', $idProyecto)->get();
            return $data;
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso13(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $gestion = Proceso_Gestionar_Comunicaciones::find($request['idGestion']);
            $gestion->fill([
                'CPC_Medio' => $request['Medio'],
                'CPC_Redaccion' => $request['Redaccion'],
            ]);
            $gestion->save();

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
     * 
     * PROCESO #14
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaAdquisiciones(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $adquisiciones = Proceso_Adquisiciones::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($adquisiciones)
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso14(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $adquisicion = Proceso_Adquisiciones::find($request['idAdquisicion']);
            $adquisicion->fill([
                'CPGA_Proveedor' => $request['Proveedor'],
                'CPGA_Tipo_Contrato' => $request['TipoContrato'],
            ]);
            $adquisicion->save();

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
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso14_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Efectuar las adquisiciones   , se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['Id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['Id_Proceso'],
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

    /**
     * 
     * PROCESO #15
     * 
     */
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso15(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Participacion::create([
                'CPI_Necesidades' => $request['Necesidades'],
                'CPI_Expectativas' => $request['Expectativas'],
                'FK_CPC_Id_Proyecto' => $request['Proyecto_id'],
            ]);
            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Gestionar la participación de los interesados, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['Proyecto_id'],
                'FK_CPP_Id_Proceso' => $request['Proceso_id'],
            ]);


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
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso15(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $interesado = Proceso_Participacion::find($request['idInteresados']);
            $interesado->fill([
                'CPI_Necesidades' => $request['Necesidades'],
                'CPI_Expectativas' => $request['Expectativas'],
            ]);
            $interesado->save();

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
     * 
     * PROCESO #16
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaproceso16(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $recursos = Proceso_Objetivos::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($recursos)
                ->addIndexColumn()
                ->addColumn('Tipo_Objetivo', function ($recursos) {
                    if ($recursos->CO_Tipo_Objetivo === '1') {
                        return "<span class='label label-sm label-primary'>General</span>";
                    } else {
                        return '<span class="label label-sm label-info">Especifico</span>';
                    }
                })
                // ->rawColumns(['Tipo_Objetivo'])
                ->addColumn('Estado', function ($recursos) {
                    if ($recursos->CO_Estado == 0) {
                        return "<span class='label label-sm label-warning'>Pendiente</span>";
                    } else {
                        return "<span class='label label-sm label-success'>Realizado</span>";
                    }
                })
                ->rawColumns(['Tipo_Objetivo', 'Estado'])
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso16(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            if ($request['Estado'] == 0) {
                $nuevoEstado = 1;
            } elseif ($request['Estado'] == 1) {
                $nuevoEstado = 0;
            }

            $objetivo = Proceso_Objetivos::find($request['id_Objetivo']);
            $objetivo->fill([
                'CO_Estado' => $nuevoEstado,
            ]);
            $objetivo->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'El cambio de estado se modifico correctamente.'
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
    public function storeProceso16_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Monitorear y controlar el trabajo del proyecto, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
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

    /**
     * 
     * PROCESO #17
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaproceso17(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $requerimiento = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $idProyecto);
            return Datatables::of($requerimiento)
                ->addIndexColumn()
                ->addColumn('Estado', function ($requerimiento) {
                    if ($requerimiento->CPR_Estado == 0) {
                        return "<span class='label label-sm label-warning'>No se cumplio</span>";
                    } else {
                        return "<span class='label label-sm label-success'>Se cumplio</span>";
                    }
                })
                ->rawColumns(['Estado'])
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso17(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            if ($request['Estado'] == 0) {
                $nuevoEstado = 1;
            } elseif ($request['Estado'] == 1) {
                $nuevoEstado = 0;
            }

            $requerimiento = Proceso_Requerimientos::find($request['id_Requerimiento']);
            $requerimiento->fill([
                'CPR_Estado' => $nuevoEstado,
            ]);
            $requerimiento->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'El cambio de estado se modifico correctamente.'
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
    public function storeProceso17_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Validar y controlar el alcance, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
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

    /**
     * 
     * PROCESO #18
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaproceso18(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $actividad = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $idProyecto);
            return Datatables::of($actividad)
                ->addIndexColumn()
                ->addColumn('Estado', function ($actividad) {
                    if ($actividad->CPC_Estado == 0) {
                        return "<span class='label label-sm label-warning'>No se cumplio</span>";
                    } else {
                        return "<span class='label label-sm label-success'>Se cumplio</span>";
                    }
                })
                ->addColumn('Requerimientos', function ($cronograma) {
                    $Nnombres = [];
                    $item = $cronograma->CPC_Requerimiento;
                    $nombres = explode(',', $item);
                    $perfil = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres)->get();
                    foreach ($perfil as $value) {
                        array_push($Nnombres, $value['CPR_Nombre_Requerimiento']);
                    }
                    $valores = implode(", ", $Nnombres);
                    return $valores;
                })
                ->rawColumns(['Estado'])
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso18(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            if ($request['Estado'] == 0) {
                $nuevoEstado = 1;
            } elseif ($request['Estado'] == 1) {
                $nuevoEstado = 0;
            }

            $actividad = ProcesoCronograma::find($request['id_Actividad']);
            $actividad->fill([
                'CPC_Estado' => $nuevoEstado,
            ]);
            $actividad->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'El cambio de estado se modifico correctamente.'
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
    public function storeProceso18_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Controlar el cronograma, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
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

    /**
     * 
     * PROCESO #19
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaproceso19(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $costo = Costos::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($costo)
                ->addIndexColumn()
                ->addColumn('Costo', function ($costo) {
                    $perfil = Costos_Informacion::where('PK_CPCI_Id_Costos', $costo->FK_CPC_Id_Formula)->first();
                    return $perfil['CPCI_Nombre'];
                })
                ->addColumn('Estado', function ($costo) {
                    if ($costo->CPC_Estado == 0) {
                        return "<span class='label label-sm label-warning'>No se uso</span>";
                    } else {
                        return "<span class='label label-sm label-success'>Se uso</span>";
                    }
                })
                ->rawColumns(['Estado'])
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso19(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            if ($request['Estado'] == 0) {
                $nuevoEstado = 1;
            } elseif ($request['Estado'] == 1) {
                $nuevoEstado = 0;
            }

            $actividad = Costos::find($request['id_Costo']);
            $actividad->fill([
                'CPC_Estado' => $nuevoEstado,
            ]);
            $actividad->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'El cambio de estado se modifico correctamente.'
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
    public function storeProceso19_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Controlar los costos, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
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

    /**
     * 
     * PROCESO #20
     * 
     */
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso20(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {


            $actividad = Proceso_Aseguramiento::find($request['idAseguramiento']);
            $actividad->fill([
                'CPA_Desempeño' => $request['Desempeño'],
                'CPA_Recomendaciones' => $request['Recomendaciones'],
            ]);
            $actividad->save();

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Controlar la calidad, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['Proyecto_id'],
                'FK_CPP_Id_Proceso' => $request['Proceso_id'],
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
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function info20(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $data = Proceso_Aseguramiento::where('FK_CPC_Id_Proyecto', $idProyecto)->get();
            return $data;
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso20(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $gestion = Proceso_Aseguramiento::find($request['idAseguramiento']);
            $gestion->fill([
                'CPA_Desempeño' => $request['Desempeño'],
                'CPA_Recomendaciones' => $request['Recomendaciones'],
            ]);
            $gestion->save();

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
     * 
     * PROCESO #21
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaproceso21(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $reunion = Proceso_Comunicacion::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($reunion)
                ->addIndexColumn()
                ->addColumn('Estado', function ($reunion) {
                    if ($reunion->CPGC_Estado == 0) {
                        return "<span class='label label-sm label-warning'>No se realizo</span>";
                    } else {
                        return "<span class='label label-sm label-success'>Se realizo</span>";
                    }
                })
                ->rawColumns(['Estado'])
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso21(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            if ($request['Estado'] == 0) {
                $nuevoEstado = 1;
            } elseif ($request['Estado'] == 1) {
                $nuevoEstado = 0;
            }

            $reunion = Proceso_Comunicacion::find($request['id_Reunion']);
            $reunion->fill([
                'CPGC_Estado' => $nuevoEstado,
            ]);
            $reunion->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'El cambio de estado se modifico correctamente.'
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
    public function storeProceso21_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Controlar las comunicaciones, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
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

    /**
     * 
     * PROCESO #22
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaproceso22(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $riesgo = Proceso_Riesgos::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($riesgo)
                ->addIndexColumn()
                ->addColumn('Estado', function ($riesgo) {
                    if ($riesgo->CPGR_Estado == 0) {
                        return "<span class='label label-sm label-warning'>No ocurrio</span>";
                    } else {
                        return "<span class='label label-sm label-success'>Ocurrio</span>";
                    }
                })
                ->rawColumns(['Estado'])
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso22(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            if ($request['Estado'] == 0) {
                $nuevoEstado = 1;
            } elseif ($request['Estado'] == 1) {
                $nuevoEstado = 0;
            }

            $reunion = Proceso_Riesgos::find($request['id_Riesgo']);
            $reunion->fill([
                'CPGR_Estado' => $nuevoEstado,
            ]);
            $reunion->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'El cambio de estado se modifico correctamente.'
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
    public function storeProceso22_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Controlar los riesgos, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
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
    /**
     * 
     * PROCESO #23
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaproceso23(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $adquisicion = Proceso_Adquisiciones::where('FK_CPC_Id_Proyecto', $idProyecto);
            return Datatables::of($adquisicion)
                ->addIndexColumn()
                ->addColumn('Estado', function ($adquisicion) {
                    if ($adquisicion->CPGA_Estado == 0) {
                        return "<span class='label label-sm label-warning'>No se uso</span>";
                    } else {
                        return "<span class='label label-sm label-success'>Se uso</span>";
                    }
                })
                ->rawColumns(['Estado'])
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso23(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            if ($request['Estado'] == 0) {
                $nuevoEstado = 1;
            } elseif ($request['Estado'] == 1) {
                $nuevoEstado = 0;
            }

            $reunion = Proceso_Adquisiciones::find($request['id_Adquisicion']);
            $reunion->fill([
                'CPGA_Estado' => $nuevoEstado,
            ]);
            $reunion->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'El cambio de estado se modifico correctamente.'
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
    public function storeProceso23_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Controlar las adquisiciones, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
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

    /**
     * 
     * PROCESO #24
     * 
     */
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso24(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {


            $actividad = Proceso_Participacion::find($request['idInteresado']);
            $actividad->fill([
                'CPI_Participacion' => $request['Participacion'],
                'CPI_Observaciones' => $request['Observaciones'],
            ]);
            $actividad->save();

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Controlar la participación de los interesados, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['Proyecto_id'],
                'FK_CPP_Id_Proceso' => $request['Proceso_id'],
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
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function info24(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $data = Proceso_Participacion::where('FK_CPC_Id_Proyecto', $idProyecto)->get();
            return $data;
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateProceso24(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $gestion = Proceso_Participacion::find($request['idInteresado']);
            $gestion->fill([
                'CPI_Participacion' => $request['Participacion'],
                'CPI_Observaciones' => $request['Observaciones'],
            ]);
            $gestion->save();

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
     * 
     * PROCESO #25
     * 
     */
    /**
     * Función que consulta los procesos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaproceso25(Request $request, $idProyecto)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $integrantes = EquipoScrum::where('FK_CE_Id_Proyecto', $idProyecto)->whereIn('FK_CE_Id_Rol', ['1','2','4']);
            return Datatables::of($integrantes)
                ->addIndexColumn()
                ->addColumn('Estado', function ($integrantes) {
                    if ($integrantes->CE_Estado == 0) {
                        return "<span class='label label-sm label-warning'>No aprobo</span>";
                    } else {
                        return "<span class='label label-sm label-success'>Aprobo</span>";
                    }
                })
                ->addColumn('Rol', function ($integrantes) {
                    $rol = Rol_Scrum::where('PK_CR_Id_Rol_Scrum', $integrantes->FK_CE_Id_Rol)->first();
                    return $rol['CR_Nombre_Rol_Scrum'];
                })
                ->rawColumns(['Estado'])
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeProceso25(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            if ($request['Estado'] == 0) {
                $nuevoEstado = 1;
            } elseif ($request['Estado'] == 1) {
                $nuevoEstado = 0;
            }

            $integrante = EquipoScrum::find($request['idIntegrante']);
            $integrante->fill([
                'CE_Estado' => $nuevoEstado,
            ]);
            $integrante->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'El cambio de estado se modifico correctamente.'
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
    public function storeProceso25_1(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Proceso Cerrar el proyecto y las adquisiciones, se creo correctamente",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
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

    /**
     * Función que almacena en la base de datos un nuevo procesp.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function finalizarProyecto(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Proceso_Proyecto::create([
                'CPP_Info_Proceso' => "Se finalizo este proyecto",
                'FK_CPP_Id_Proyecto' => $request['id_Proyecto'],
                'FK_CPP_Id_Proceso' => $request['id_Proceso'],
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'El proyecto finalizo correctamente. '
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
