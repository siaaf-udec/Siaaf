<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Container\Carpark\src\Dependencias;
use App\Container\Carpark\src\Estados;
use App\Container\Carpark\src\Usuarios;
use App\Container\Carpark\src\Motos;
use App\Container\Carpark\src\Ingresos;
use App\Container\Carpark\src\Historiales;
use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;


class ReportesController extends Controller
{

	/**
     * Permite generar el reporte correspondiente al las dependencias registradas.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteDependencia()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoDependencias = Dependencias::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
        $total = count($infoDependencias);
        $cont = 1;
        return view('carpark.reportes.reporteDependencias',
            compact('infoDependencias', 'date', 'time', 'total', 'cont')
        );
    }

    /**
     * Permite descargar el reporte correspondiente al las dependencias registradas.
     *
     * @return \Illuminate\Http\Response
     */
    public function DescargarReporteDependencia()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoDependencias = Dependencias::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
        $total = count($infoDependencias);
        $cont = 1;
        return SnappyPdf::loadView('carpark.reportes.reporteDependencias',
               compact('infoDependencias','date', 'time', 'total', 'cont')
        )->download('ReporteDEpendencias.pdf');
    }
}
