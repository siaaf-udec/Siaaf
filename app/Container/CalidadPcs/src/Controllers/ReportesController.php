<?php

namespace App\Container\CalidadPcs\src\Controllers;

use App\Container\CalidadPcs\src\EquipoScrum;
use App\Container\CalidadPcs\src\Proceso_Objetivos;
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
                if ($objetivo->CO_Tipo_Objetivo == 1){
                    $objetivo->Tipo = "General";
                }else{
                    $objetivo->Tipo = "Especifico";
                }
            }
            // dd($infoEquipo);
            return view('calidadpcs.reportes.reportePrimerEtapa',
                compact('infoProyecto', 'infoEquipo','integrantes','objetivos', 'date', 'time', 'cont'));
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
                if ($objetivo->CO_Tipo_Objetivo == 1){
                    $objetivo->Tipo = "General";
                }else{
                    $objetivo->Tipo = "Especifico";
                }
            }
            // dd($infoEquipo);
            return PDF::loadView('calidadpcs.reportes.descargas.reportePrimerEtapa',
                compact('infoProyecto', 'infoEquipo','integrantes','objetivos', 'date', 'time', 'cont'))->download('ReporteEtapaInicio.pdf');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

}