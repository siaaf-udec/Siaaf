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
        )->download('ReporteDependencias.pdf');
    }

    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteUsuariosRegistrados()
    {
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoUsuarios = Usuarios::all();
        foreach ($infoUsuarios as $infoUsuario)
        {
            $Dependencia = Dependencias::where('PK_CD_IdDependencia', $infoUsuario->FK_CU_IdDependencia)
                                     ->get();    
            
            $infoUsuario->offsetSet('Dependencia',$Dependencia[0]['CD_Dependencia']);
            
        }
        return view('carpark.reportes.reporteUsuariosRegistrados',
            compact('infoUsuarios','date','time','cont'));
    }
    
    /**
     * Permite descargar el reporte correspondiente a los usuarios registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function DescargarreporteUsuariosRegistrados()
    {
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoUsuarios = Usuarios::all();
        foreach ($infoUsuarios as $infoUsuario)
        {
            $Dependencia = Dependencias::where('PK_CD_IdDependencia', $infoUsuario->FK_CU_IdDependencia)
                                     ->get();    
            
            $infoUsuario->offsetSet('Dependencia',$Dependencia[0]['CD_Dependencia']);
            
        }
        return SnappyPdf::loadView('carpark.reportes.reporteUsuariosRegistrados',
            compact('infoUsuarios','date','time','cont'))->download('ReporteUsuariosRegistrados.pdf');
    }

    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteMotosRegistradas()
    {
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoMotos = Motos::all();
        foreach ($infoMotos as $infoMoto)
        {
            $Usuarios = Usuarios::where('PK_CU_Codigo', $infoMoto->FK_CM_CodigoUser)->get();    
            
            $infoMoto->offsetSet('Nombre',$Usuarios[0]['CU_Nombre1']);
            $infoMoto->offsetSet('Apellido',$Usuarios[0]['CU_Apellido1']);
            
        }
        return view('carpark.reportes.reporteMotosRegistradas',
            compact('infoMotos','date','time','cont'));
    }
    
    /**
     * Permite descargar el reporte correspondiente a los usuarios registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function DescargarreporteMotosRegistradas()
    {
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoMotos = Motos::all();
        foreach ($infoMotos as $infoMoto)
        {
            $Usuarios = Usuarios::where('PK_CU_Codigo', $infoMoto->FK_CM_CodigoUser)->get();    
            
            $infoMoto->offsetSet('Nombre',$Usuarios[0]['CU_Nombre1']);
            $infoMoto->offsetSet('Apellido',$Usuarios[0]['CU_Apellido1']);
            
        }
        return SnappyPdf::loadView('carpark.reportes.reporteMotosRegistradas',
            compact('infoMotos','date','time','cont'))->download('ReporteMotosRegistradas.pdf');        
    }

    /**
     * Permite generar el reporte correspondiente a las motos que se encuentran en la universidad.
     *
     * @return \Illuminate\Http\Response
     */
    public function ReporteMotosDentro()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoIngresos = Ingresos::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
        $total = count($infoIngresos);
        $cont = 1;
        return view('carpark.reportes.ReporteMotosDentro',
            compact('infoIngresos', 'date', 'time', 'total', 'cont')
        );
    }
    
    /**
     * Permite descargar el reporte correspondiente a las motos que se encuentran en la universidad.
     *
     * @return \Illuminate\Http\Response
     */
    public function DescargarReporteMotosDentro()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoIngresos = Ingresos::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
        $total = count($infoIngresos);
        $cont = 1;
        return SnappyPdf::loadView('carpark.reportes.ReporteMotosDentro',
            compact('infoIngresos', 'date', 'time', 'total', 'cont')
        )->download('ReporteMotosDentro.pdf');               
    }
    
    /**
     * Permite generar el reporte correspondiente a las motos que se encuentran en la universidad.
     *
     * @return \Illuminate\Http\Response
     */
    public function ReporteHistorico()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoHistoriales = Historiales::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
        $total = count($infoHistoriales);
        $cont = 1;
        return view('carpark.reportes.ReporteHistorico',
            compact('infoHistoriales', 'date', 'time', 'total', 'cont')
        );
    }
    
    /**
     * Permite descargar el reporte correspondiente a las motos que se encuentran en la universidad.
     *
     * @return \Illuminate\Http\Response
     */
    public function DescargarReporteHistorico()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoHistoriales = Historiales::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
        $total = count($infoHistoriales);
        $cont = 1;
        return SnappyPdf::loadView('carpark.reportes.ReporteHistorico',
            compact('infoHistoriales', 'date', 'time', 'total', 'cont')
        )->download('ReporteHistorico.pdf');               
    }

}
