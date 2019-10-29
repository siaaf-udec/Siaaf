<?php

namespace App\Container\CalidadPcs\src\Controllers;

use App\Container\CalidadPcs\src\Costos;
use App\Container\CalidadPcs\src\Costos_Informacion;
use App\Container\CalidadPcs\src\EquipoScrum;
use App\Container\CalidadPcs\src\Proceso_Adquisiciones;
use App\Container\CalidadPcs\src\Proceso_Aseguramiento;
use App\Container\CalidadPcs\src\Proceso_Comunicacion;
use App\Container\CalidadPcs\src\Proceso_Direccion;
use App\Container\CalidadPcs\src\Proceso_Gestionar_Comunicaciones;
use App\Container\CalidadPcs\src\Proceso_Objetivos;
use App\Container\CalidadPcs\src\Proceso_Participacion;
use App\Container\CalidadPcs\src\Proceso_Recursos;
use App\Container\CalidadPcs\src\Proceso_Requerimientos;
use App\Container\CalidadPcs\src\Proceso_Riesgos;
use App\Container\CalidadPcs\src\ProcesoCronograma;
use App\Container\CalidadPcs\src\Proyectos;
use App\Container\Users\src\UsersUdec;
use Illuminate\Http\Request;
use Exception;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Barryvdh\DomPDF\Facade as PDF;


class ReportesController extends Controller
{

    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteEtapaUno(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $id)->first();
            $infoEquipo = EquipoScrum::where('FK_CE_Id_Proyecto', $id)->get();
            $integrantes = EquipoScrum::where('FK_CE_Id_Proyecto', $id)->where('FK_CE_Id_Rol', 5)->get();
            $objetivos = Proceso_Objetivos::where('FK_CPC_Id_Proyecto', $id)->get();
            foreach ($objetivos as $objetivo) {
                if ($objetivo->CO_Tipo_Objetivo == 1) {
                    $objetivo->Tipo = "General";
                } else {
                    $objetivo->Tipo = "Especifico";
                }
            }
            // dd($infoEquipo);
            return view(
                'calidadpcs.reportes.reportePrimerEtapa',
                compact('infoProyecto', 'infoEquipo', 'integrantes', 'objetivos', 'date', 'time', 'cont')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function descargaReporteEtapaUno(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $id)->first();
            $infoEquipo = EquipoScrum::where('FK_CE_Id_Proyecto', $id)->get();
            $integrantes = EquipoScrum::where('FK_CE_Id_Proyecto', $id)->where('FK_CE_Id_Rol', 5)->get();
            $objetivos = Proceso_Objetivos::where('FK_CPC_Id_Proyecto', $id)->get();
            foreach ($objetivos as $objetivo) {
                if ($objetivo->CO_Tipo_Objetivo == 1) {
                    $objetivo->Tipo = "General";
                } else {
                    $objetivo->Tipo = "Especifico";
                }
            }
            // dd($infoEquipo);
            return PDF::loadView(
                'calidadpcs.reportes.descargas.reportePrimerEtapa',
                compact('infoProyecto', 'infoEquipo', 'integrantes', 'objetivos', 'date', 'time', 'cont')
            )->download('ReporteEtapaInicio.pdf');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteEtapaPlanificacion(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $cont_2 = 1;
            $cont_3 = 1;
            $cont_4 = 1;
            $cont_5 = 1;
            $cont_6 = 1;
            $cont_7 = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $alcance = Proceso_Direccion::where('FK_CPC_Id_Proyecto', $id)->first();
            $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $id)->get();
            $cronograma = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $id)->get();
            foreach ($cronograma as $crono) {
                $Nnombres = [];
                $item = $crono->CPC_Requerimiento;
                $nombres = explode(',', $item);
                $perfil = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres)->get();
                foreach ($perfil as $value) {
                    array_push($Nnombres, $value['CPR_Nombre_Requerimiento']);
                }
                $valores = implode(", ", $Nnombres);
                $crono->Requerimientos = $valores;

                $Nombres = [];
                $item2 = $crono->CPC_Recurso;
                $nombres2 = explode(',', $item2);
                $integrantes = EquipoScrum::whereIn('PK_CE_Id_Equipo_Scrum', $nombres2)->get();
                foreach ($integrantes as $value) {
                    array_push($Nombres, $value['CE_Nombre_Persona']);
                }
                $valores2 = implode(", ", $Nombres);
                $crono->Integrantes = $valores2;
            };
            $costos = Costos::where('FK_CPC_Id_Proyecto', $id)->get();
            foreach ($costos as $costo) {
                $name = Costos_Informacion::where('PK_CPCI_Id_Costos', $costo->FK_CPC_Id_Formula)->first();
                $costo->Formula = $name['CPCI_Nombre'];
            }
            $recursos = Proceso_Recursos::where('FK_CPC_Id_Proyecto', $id)->get();
            foreach ($recursos as $recurso) {
                $name = EquipoScrum::where('PK_CE_Id_Equipo_Scrum', $recurso->FK_CPGR_Id_Equipo)->first();
                $recurso->Nombre = $name['CE_Nombre_Persona'];
            }
            $reuniones = Proceso_Comunicacion::where('FK_CPC_Id_Proyecto', $id)->get();
            $riesgos = Proceso_Riesgos::where('FK_CPC_Id_Proyecto', $id)->get();
            $adquisiciones = Proceso_Adquisiciones::where('FK_CPC_Id_Proyecto', $id)->get();
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $id)->first();
            
            return view(
                'calidadpcs.reportes.reporteEtapaPlanificacion',
                compact('alcance', 'requerimientos', 'cronograma', 'costos', 'recursos', 'reuniones', 'riesgos', 'adquisiciones', 'infoProyecto', 'date', 'time', 'cont', 'cont_2', 'cont_3', 'cont_4', 'cont_5', 'cont_6', 'cont_7')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function descargaReporteEtapaPlanificacion(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $cont_2 = 1;
            $cont_3 = 1;
            $cont_4 = 1;
            $cont_5 = 1;
            $cont_6 = 1;
            $cont_7 = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $alcance = Proceso_Direccion::where('FK_CPC_Id_Proyecto', $id)->first();
            $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $id)->get();
            $cronograma = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $id)->get();
            foreach ($cronograma as $crono) {
                $Nnombres = [];
                $item = $crono->CPC_Requerimiento;
                $nombres = explode(',', $item);
                $perfil = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres)->get();
                foreach ($perfil as $value) {
                    array_push($Nnombres, $value['CPR_Nombre_Requerimiento']);
                }
                $valores = implode(", ", $Nnombres);
                $crono->Requerimientos = $valores;

                $Nombres = [];
                $item2 = $crono->CPC_Recurso;
                $nombres2 = explode(',', $item2);
                $integrantes = EquipoScrum::whereIn('PK_CE_Id_Equipo_Scrum', $nombres2)->get();
                foreach ($integrantes as $value) {
                    array_push($Nombres, $value['CE_Nombre_Persona']);
                }
                $valores2 = implode(", ", $Nombres);
                $crono->Integrantes = $valores2;
            };
            $costos = Costos::where('FK_CPC_Id_Proyecto', $id)->get();
            foreach ($costos as $costo) {
                $name = Costos_Informacion::where('PK_CPCI_Id_Costos', $costo->FK_CPC_Id_Formula)->first();
                $costo->Formula = $name['CPCI_Nombre'];
            }
            $recursos = Proceso_Recursos::where('FK_CPC_Id_Proyecto', $id)->get();
            foreach ($recursos as $recurso) {
                $name = EquipoScrum::where('PK_CE_Id_Equipo_Scrum', $recurso->FK_CPGR_Id_Equipo)->first();
                $recurso->Nombre = $name['CE_Nombre_Persona'];
            }

            $reuniones = Proceso_Comunicacion::where('FK_CPC_Id_Proyecto', $id)->get();
            $riesgos = Proceso_Riesgos::where('FK_CPC_Id_Proyecto', $id)->get();
            $adquisiciones = Proceso_Adquisiciones::where('FK_CPC_Id_Proyecto', $id)->get();
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $id)->first();

            return PDF::loadView(
                'calidadpcs.reportes.descargas.reporteEtapaPlanificacion',
                compact('alcance', 'requerimientos', 'cronograma', 'costos', 'recursos', 'reuniones', 'riesgos', 'adquisiciones', 'infoProyecto', 'date', 'time', 'cont', 'cont_2', 'cont_3', 'cont_4', 'cont_5', 'cont_6', 'cont_7')
            )->download('ReporteEtapaPlanificacion.pdf');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteEtapaEjecucion(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $cont_2 = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $Metodologia = Proceso_Direccion::where('FK_CPC_Id_Proyecto', $id)->first();
            $Aseguramiento = Proceso_Aseguramiento::where('FK_CPC_Id_Proyecto', $id)->first();
            $horas = EquipoScrum::where('FK_CE_Id_Proyecto', $id)->get();
            $comunicacion = Proceso_Gestionar_Comunicaciones::where('FK_CPC_Id_Proyecto', $id)->first();
            $adquisiciones = Proceso_Adquisiciones::where('FK_CPC_Id_Proyecto', $id)->get();
            $participacion = Proceso_Participacion::where('FK_CPC_Id_Proyecto', $id)->first();

            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $id)->first();
            return view(
                'calidadpcs.reportes.reporteEtapaEjecucion',
                compact('infoProyecto', 'Metodologia', 'Aseguramiento', 'horas', 'comunicacion', 'adquisiciones', 'participacion','date', 'time', 'cont', 'cont_2')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function descargaReporteEtapaEjecucion(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $cont_2 = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $Metodologia = Proceso_Direccion::where('FK_CPC_Id_Proyecto', $id)->first();
            $Aseguramiento = Proceso_Aseguramiento::where('FK_CPC_Id_Proyecto', $id)->first();
            $horas = EquipoScrum::where('FK_CE_Id_Proyecto', $id)->get();
            $comunicacion = Proceso_Gestionar_Comunicaciones::where('FK_CPC_Id_Proyecto', $id)->first();
            $adquisiciones = Proceso_Adquisiciones::where('FK_CPC_Id_Proyecto', $id)->get();
            $participacion = Proceso_Participacion::where('FK_CPC_Id_Proyecto', $id)->first();

            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $id)->first();
            return PDF::loadView(
                'calidadpcs.reportes.descargas.reporteEtapaEjecucion',
                compact('infoProyecto', 'Metodologia', 'Aseguramiento', 'horas', 'comunicacion', 'adquisiciones', 'participacion','date', 'time', 'cont', 'cont_2')
            )->download('ReporteEtapaEjecucion.pdf');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteEtapaMonitoreo(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $id)->first();
            $objetivos = Proceso_Objetivos::where('FK_CPC_Id_Proyecto', $id)->get();
            foreach ($objetivos as $objetivo) {
                if ($objetivo->CO_Tipo_Objetivo == 1) {
                    $objetivo->Tipo = "General";
                } else  if ($objetivo->CO_Tipo_Objetivo == 2){
                    $objetivo->Tipo = "Especifico";
                }
                if($objetivo->CO_Estado == 0){
                    $objetivo->estado = "Pendiente";
                }else if($objetivo->CO_Estado == 1){
                    $objetivo->estado = "Realizado";
                }
            }
            $requerimientos = Proceso_Requerimientos::where('FK_CPR_Id_Proyecto', $id)->get();
            foreach($requerimientos as $requerimiento){
                if($requerimiento->CPR_Estado == 0){
                    $requerimiento->estado = "No se cumplio";
                }else if($requerimiento->CPR_Estado == 1){
                    $requerimiento->estado = "Se cumplio";
                }
            }
            $cronograma = ProcesoCronograma::where('FK_CPP_Id_Proyecto', $id)->get();
            foreach ($cronograma as $crono) {
                $Nnombres = [];
                $item = $crono->CPC_Requerimiento;
                $nombres = explode(',', $item);
                $perfil = Proceso_Requerimientos::whereIn('PK_CPR_Id_Requerimientos', $nombres)->get();
                foreach ($perfil as $value) {
                    array_push($Nnombres, $value['CPR_Nombre_Requerimiento']);
                }
                $valores = implode(", ", $Nnombres);
                $crono->Requerimientos = $valores;

                if($crono->CPC_Estado == 0){
                    $crono->estado = "No se cumplio";
                }else if($crono->CPC_Estado == 1){
                    $crono->estado = "Se cumplio";
                }
            };
            dd($cronograma);
            return view(
                'calidadpcs.reportes.reporteEtapaMonitoreo',
                compact('infoProyecto', 'objetivos', 'integrantes', 'objetivos', 'date', 'time', 'cont')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function descargaReporteEtapaMonitoreo(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoProyecto = Proyectos::where('PK_CP_Id_Proyecto', $id)->first();
            $infoEquipo = EquipoScrum::where('FK_CE_Id_Proyecto', $id)->get();
            $integrantes = EquipoScrum::where('FK_CE_Id_Proyecto', $id)->where('FK_CE_Id_Rol', 5)->get();
            $objetivos = Proceso_Objetivos::where('FK_CPC_Id_Proyecto', $id)->get();
            foreach ($objetivos as $objetivo) {
                if ($objetivo->CO_Tipo_Objetivo == 1) {
                    $objetivo->Tipo = "General";
                } else {
                    $objetivo->Tipo = "Especifico";
                }
            }
            // dd($infoEquipo);
            return PDF::loadView(
                'calidadpcs.reportes.descargas.reportePrimerEtapa',
                compact('infoProyecto', 'infoEquipo', 'integrantes', 'objetivos', 'date', 'time', 'cont')
            )->download('ReporteEtapaInicio.pdf');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
