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
    
    /**
     * Permite generar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtradoFecha(Request $request)
    {
        if ($request->isMethod('POST')){
            $fechas = $request['FechasLimite'];
            $limites = explode(" ", $fechas);   
            $limMin = date('Y-m-d 00:00:00', strtotime($limites[0]));
            $limMax = date('Y-m-d 23:59:59', strtotime($limites[2]));
            $FechaMinDescarga = date('Y-m-d',strtotime($limites[0]));
            $FechaMaxDescarga = date('Y-m-d',strtotime($limites[2]));
            $infoHistoriales = Historiales::whereBetween('CH_FHsalida', [$limMin, $limMax])->get();
            $total=count($infoHistoriales);
            
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");                        
            
            return view('carpark.reportes.ReportePorFecha',compact('infoHistoriales','date','time','cont','total','FechaMinDescarga','FechaMaxDescarga'));
        }
    }    
    
    /**
     * Permite descargar el reporte correspondiente a las historiales filtrados por fecha.
     *
     * @return \Illuminate\Http\Response
     */
    public function DescargarfiltradoFecha($limMinGET,$limMaxGET)
    {   
        $limMin = date('Y-m-d 00:00:00', strtotime($limMinGET));
        $limMax = date('Y-m-d 23:59:59', strtotime($limMaxGET));
        $FechaMinDescarga = $limMin;
        $FechaMaxDescarga = $limMax;     
        $infoHistoriales = Historiales::whereBetween('CH_FHsalida', [$limMin, $limMax])->get();
        $total=count($infoHistoriales);
        
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");                        
            
        return SnappyPdf::loadView('carpark.reportes.ReportePorFecha',compact('infoHistoriales','date','time','cont','total','FechaMinDescarga','FechaMaxDescarga'))->download('ReportePorFechas.pdf');           
    }
    
    /**
     * Permite generar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtradoCodigo(Request $request)
    {
        if ($request->isMethod('POST')){
            $codigo = $request['CodigoUsuario'];
            
            $infoHistoriales = Historiales::where('CH_CodigoUser', $codigo)->get();
            $total=count($infoHistoriales);
            
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");                        
            
            return view('carpark.reportes.reporteFiltradoCodigo',compact('infoHistoriales','date','time','cont','total','codigo'));
        }
    }

    /**
     * Permite descargar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @return \Illuminate\Http\Response
     */
    public function DescargarfiltradoCodigo($id)
    {
        $codigo = $id;
            
        $infoHistoriales = Historiales::where('CH_CodigoUser', $codigo)->get();
        $total=count($infoHistoriales);
            
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");                        
            
        return SnappyPdf::loadView('carpark.reportes.reporteFiltradoCodigo',compact('infoHistoriales','date','time','cont','total','codigo'))->download('ReportePorCódigo.pdf');            
                    
    }
    
    /**
     * Permite generar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @return \Illuminate\Http\Response
     */
    public function filtradoPlaca(Request $request)
    {
        if ($request->isMethod('POST')){
            $placa = strtoupper($request['PlacaVehiculo']);
            
            $infoHistoriales = Historiales::where('CH_Placa', $placa)->get();
            $total=count($infoHistoriales);
            
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");                        
            
            return view('carpark.reportes.reporteFiltradoPlaca',compact('infoHistoriales','date','time','cont','total','placa'));
        }
    }

    /**
     * Permite descargar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @return \Illuminate\Http\Response
     */
    public function DescargarfiltradoPlaca($id)
    {
        $placa = strtoupper($id);
            
        $infoHistoriales = Historiales::where('CH_Placa', $placa)->get();
        $total=count($infoHistoriales);
            
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");                        
        
        return SnappyPdf::loadView('carpark.reportes.reporteFiltradoPlaca',compact('infoHistoriales','date','time','cont','total','placa'))->download('ReportePorPlaca.pdf');               
                    
    }

    /**
     * Permite generar el reporte correspondiente a la información de un usuario concretro.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteUsuario($id)
    {        
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoUsuarios = Usuarios::find($id);        
        $infoDependencia = Dependencias::where('PK_CD_IdDependencia', $infoUsuarios->FK_CU_IdDependencia)->get();    
            
        $infoUsuarios->offsetSet('Dependencia',$infoDependencia[0]['CD_Dependencia']);
            
        $infoHistoriales = Historiales::where('CH_CodigoUser',$id)->get();
        $total=count($infoHistoriales);
        return view('carpark.reportes.ReporteUsuario',
            compact('infoUsuarios','infoHistoriales', 'date', 'time', 'total', 'cont')
        );  
    }
    
    /**
     * Permite descargar el reporte correspondiente a la información de un usuario concretro.
     *
     * @return \Illuminate\Http\Response
     */
    public function descargarreporteUsuario($id)
    {
         $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoUsuarios = Usuarios::find($id);        
        $infoDependencia = Dependencias::where('PK_CD_IdDependencia', $infoUsuarios->FK_CU_IdDependencia)->get();    
            
        $infoUsuarios->offsetSet('Dependencia',$infoDependencia[0]['CD_Dependencia']);
            
        $infoHistoriales = Historiales::where('CH_CodigoUser',$id)->get();
        $total=count($infoHistoriales);
        return SnappyPdf::loadView('carpark.reportes.ReporteUsuario',
            compact('infoUsuarios','infoHistoriales', 'date', 'time', 'total', 'cont'))->download('ReportePorCódigo.pdf');         
                    
    }

    /**
     * Permite generar el reporte correspondiente a la información de un usuario concretro.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteMoto($id)
    {        
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoMoto = Motos::find($id);        
            
        $infoHistoriales = Historiales::where('CH_Placa',$infoMoto->CM_Placa)->get();

        $total=count($infoHistoriales);
        return view('carpark.reportes.ReporteMoto',
            compact('infoMoto','infoHistoriales', 'date', 'time', 'total', 'cont')
        );  
    }
    
    /**
     * Permite descargar el reporte correspondiente a la información de un usuario concretro.
     *
     * @return \Illuminate\Http\Response
     */
    public function descargarreporteMoto($id)
    {
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $infoMoto = Motos::find($id);
        $infoUsuario = Usuarios::find($infoMoto['FK_CM_CodigoUser']);    
            
        $infoMoto->offsetSet('Nombre1',$infoUsuario->CU_Nombre1);
        $infoMoto->offsetSet('Nombre2',$infoUsuario->CU_Nombre2);
        $infoMoto->offsetSet('Apellido1',$infoUsuario->CU_Apellido1);
        $infoMoto->offsetSet('Apellido2',$infoUsuario->CU_Apellido2);        
            
        $infoHistoriales = Historiales::where('CH_Placa',$infoMoto->CM_Placa)->get();
        
        $total=count($infoHistoriales);
        return SnappyPdf::loadView('carpark.reportes.ReporteMoto',
            compact('infoMoto','infoHistoriales', 'date', 'time', 'total', 'cont')
        )->download('ReporteMoto.pdf');          
                    
    }

}

