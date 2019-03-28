<?php

namespace App\Container\Gesap\src\Controllers;


use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection as Collection;

use Illuminate\Support\Facades\Storage;

use Exception;
use Validator;
use Yajra\DataTables\DataTables;


use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Support\Facades\Crypt;


use Illuminate\Support\Facades\Auth;
use Barryvdh\Snappy\Facades\SnappyPdf;

use App\Container\Gesap\src\Anteproyecto;
use App\Container\Gesap\src\Proyecto;
use App\Container\Gesap\src\Actividad;
use App\Container\Gesap\src\Radicacion;
use App\Container\Gesap\src\Encargados;
use App\Container\Gesap\src\Usuarios;
use App\Container\Gesap\src\Cronograma;
use App\Container\Gesap\src\Resultados;
use App\Container\Gesap\src\Solicitud;
use App\Container\Gesap\src\Funciones;
use App\Container\Gesap\src\Financiacion;
use App\Container\Gesap\src\PersonaMct;
use App\Container\Gesap\src\Fechas;
use App\Container\Gesap\src\Jurados;
use App\Container\Gesap\src\RolesUsuario;
use App\Container\Gesap\src\Desarrolladores;
use App\Container\Gesap\src\Estados;
use App\Container\Gesap\src\Mctr008;
use App\Container\Gesap\src\ObservacionesMct;
use App\Container\Gesap\src\Commits;
use App\Container\Users\src\User;
use App\Container\Gesap\src\RubroPersonal;
use App\Container\Gesap\src\RubroEquipos;
use App\Container\Gesap\src\RubroMaterial;
use App\Container\Gesap\src\RubroTecnologico;
use App\Container\Gesap\src\EstadoAnteproyecto;
use App\Container\Users\src\UsersUdec;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

use App\Container\Users\src\Controllers\UsersUdecController;
use Barryvdh\DomPDF\Facade as PDF;


class PdfController extends Controller
{
    private $path = 'gesap.Reportes.';
    //Esta Función Genera la informacion para lelnar los reportes generales de anteproyectos de grado.
    public function reporteAnteproyectos(Request $request)
    {
        if($request->isMethod('GET')){
            $anteproyectos = Anteproyecto::all();
            $cantidad = $anteproyectos->count();
            $CRad = 0;
            $CApr = 0;
            $CRepro = 0;
            $CAplz = 0;
            $CCancel = 0;
            $CAsig = 0;
            $CEsp = 0;

            $title = "Reporte : Historial de Anteproyectos De Grado";
            foreach($anteproyectos as $anteproyecto){
                $anteproyecto->offsetSet('Director',$anteproyecto->relacionPredirectores->User_Nombre1." ".$anteproyecto->relacionPredirectores->User_Apellido1);
                $j=0;
                $desarrolladorP="";
                $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$anteproyecto-> PK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                    $anteproyecto->offsetSet('Desarrolladores',  'Sin Asignar' );
                }else{
                    foreach($desarrolladores as $desarrollador){
                        if($j==0){
                            $desarrolladorP = $desarrolladorP.$desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            $j=1;
                        }else{
                            $desarrolladorP = $desarrolladorP.", ". $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                        }
                    }
                    $anteproyecto->offsetSet('Desarrolladores',  $desarrolladorP );

                }
              
                $anteproyecto->offsetSet('Duracion',  $anteproyecto->NPRY_Duracion." Meses" );
                $anteproyecto->offsetSet('Estado', $anteproyecto->relacionEstado->EST_Estado);
                if( $anteproyecto->relacionEstado->EST_Estado == "EN ESPERA"){
                    $CEsp = $CEsp + 1 ;
                }
                if( $anteproyecto->relacionEstado->EST_Estado == "ASIGNADO"){
                    $CAsig = $CAsig + 1;
                }
                if( $anteproyecto->relacionEstado->EST_Estado == "RADICADO"){
                    $CRad = $CRad + 1 ;
                }
                if( $anteproyecto->relacionEstado->EST_Estado == "APROBADO"){
                    $CApr = $CApr + 1; 
                }
                if( $anteproyecto->relacionEstado->EST_Estado == "REPROBADO"){
                    $CRepro = $CRepro + 1;
                }
                if( $anteproyecto->relacionEstado->EST_Estado == "APLAZADO"){
                    $CAplz = $CAplz + 1;
                }
                if( $anteproyecto->relacionEstado->EST_Estado == "CANCELADO"){
                    $CCancel = $CCancel + 1;
                }
                setlocale(LC_TIME, 'es_ES'); 
                $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 

            }
            return view($this->path .'AnteproyectosPdf',
            compact('anteproyectos', 'title' ,'fecha','cantidad','CAsig','CRad','CApr','CRepro','CAplz','CCancel','CEsp'));  
        }
          
    }
    //funcion que retorna los datos de un anteproyecto en especifico para su respectivo reporte
    public function reporteAnteproyecto(Request $request,$id)
    {
        if ($request->isMethod('GET')) {
            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            $j=0;
            $desarrollador1="Sin Asignar";
            $desarrollador2="Sin Asignar";
            
            $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$anteproyecto-> PK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                }else{
                    foreach($desarrolladores as $desarrollador){
                        if($j==0){
                            $desarrollador1 = $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            $j=1;
                        }else{
                            $desarrollador2 =  $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                        }
                    }
            }
            $i=0;
            $jurado1="Sin Asignar";
            $jurado2="Sin Asignar";
            
            $jurados=Jurados::where('FK_NPRY_IdMctr008',$anteproyecto-> PK_NPRY_IdMctr008)->get();
   
            if($jurados->IsEmpty()){
            
            }else{
                foreach($jurados as $jurado){
                  
                    $jurado->offsetSet('Jurado',$jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1);
                    $jurado->offsetSet('Des',$jurado->JR_Comentario);
                    $jurado->offsetSet('Estado',$jurado->relacionEstado->EST_Estado);

                  
                    if($i == 0){
                        $jurado1 = $jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1;
                        $i = 1;
                    }else{
                        $jurado2 = $jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1;
                    }
                }
            }
            $anteproyecto->offsetSet('Duracion',  $anteproyecto->NPRY_Duracion." Meses" );
            $anteproyecto->offsetSet('Estado', $anteproyecto->relacionEstado->EST_Estado);
            $anteproyecto->offsetSet('Director',$anteproyecto->relacionPredirectores->User_Nombre1." ".$anteproyecto->relacionPredirectores->User_Apellido1);
            


            $title = "Reporte : Anteproyecto De Grado Específico";
            setlocale(LC_TIME, 'es_ES'); 
            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');


            return view($this->path .'AnteproyectoPdf',
            compact('title' ,'fecha','anteproyecto','desarrollador1','desarrollador2','jurado1','jurado2','jurados'));  
     
        }
    }
    //esta funcion es la que envia la informacion de proyectos para el infoprme general
    public function reporteProyectos(Request $request)
    {
        if($request->isMethod('GET')){
            $proyectos = Proyecto::all();
            $cantidad = $proyectos->count();
            $CRad = 0;
            $CApr = 0;
            $CRepro = 0;
            $CAplz = 0;
            $CCancel = 0;
            $CAsig = 0;
            $CEsp = 0;
            $j=0;
            $desarrolladorP = "";
            $title = "Reporte : Historial de Proyectos de Grado";
            setlocale(LC_TIME, 'es_ES'); 
            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');

            foreach($proyectos as $proyecto){
                $proyecto->offsetSet('Titulo',  $proyecto->relacionAnteproyecto-> NPRY_Titulo);
                $proyecto->offsetSet('Descripcion',  $proyecto->relacionAnteproyecto-> NPRY_Descripcion);
                $proyecto->offsetSet('Director', $proyecto->relacionAnteproyecto->relacionPredirectores->User_Nombre1." ".$proyecto->relacionAnteproyecto->relacionPredirectores->User_Apellido1);
                $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                    $anteproyecto->offsetSet('Desarrolladores',  'Sin Asignar' );
                }else{
                    foreach($desarrolladores as $desarrollador){
                        if($j==0){
                            $desarrolladorP = $desarrolladorP.$desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            $j=1;
                        }else{
                            $desarrolladorP = $desarrolladorP.", ". $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                        }
                    }
                    $proyecto->offsetSet('Desarrolladores',  $desarrolladorP );

                }
                $proyecto->offsetSet('Estado',  $proyecto->relacionEstado->EST_Estado." Meses" );

                if( $proyecto->relacionEstado->EST_Estado == "EN ESPERA"){
                    $CEsp = $CEsp + 1 ;
                }
                if( $proyecto->relacionEstado->EST_Estado == "ASIGNADO"){
                    $CAsig = $CAsig + 1;
                }
                if( $proyecto->relacionEstado->EST_Estado == "RADICADO"){
                    $CRad = $CRad + 1 ;
                }
                if( $proyecto->relacionEstado->EST_Estado == "APROBADO"){
                    $CApr = $CApr + 1; 
                }
                if( $proyecto->relacionEstado->EST_Estado == "REPROBADO"){
                    $CRepro = $CRepro + 1;
                }
                if( $proyecto->relacionEstado->EST_Estado == "APLAZADO"){
                    $CAplz = $CAplz + 1;
                }
                if( $proyecto->relacionEstado->EST_Estado == "CANCELADO"){
                    $CCancel = $CCancel + 1;
                }

            }
            return view($this->path .'ProyectosPdf',
            compact('proyectos', 'title' ,'fecha','cantidad','CAsig','CRad','CApr','CRepro','CAplz','CCancel','CEsp'));  
     
        }
    }
    
    //funcion que retorna los datos de un proyecto en especifico para su respectivo reporte
    public function reporteProyecto(Request $request,$id)
    {
        if ($request->isMethod('GET')) {
            $proyecto = Proyecto::where('FK_NPRY_IdMctr008',$id)->first();
            $j=0;
            $desarrollador1="Sin Asignar";
            $desarrollador2="Sin Asignar";
            
            $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                }else{
                    foreach($desarrolladores as $desarrollador){
                        if($j==0){
                            $desarrollador1 = $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            $j=1;
                        }else{
                            $desarrollador2 =  $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                        }
                    }
            }
            $i=0;
            $jurado1="Sin Asignar";
            $jurado2="Sin Asignar";
            
            $jurados=Jurados::where('FK_NPRY_IdMctr008',$proyecto->FK_NPRY_IdMctr008)->get();
   
            if($jurados->IsEmpty()){
            
            }else{
                foreach($jurados as $jurado){
                  
                    $jurado->offsetSet('Jurado',$jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1);
                    $jurado->offsetSet('Des',$jurado->JR_Comentario_Proyecto);
                    $jurado->offsetSet('Estado',$jurado->relacionEstadoJurado->EST_Estado);

                  
                    if($i == 0){
                        $jurado1 = $jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1;
                        $i = 1;
                    }else{
                        $jurado2 = $jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1;
                    }
                }
            }
            $proyecto->offsetSet('Titulo',  $proyecto->relacionAnteproyecto-> NPRY_Titulo);
            $proyecto->offsetSet('Descripcion',  $proyecto->relacionAnteproyecto-> NPRY_Descripcion);
            $proyecto->offsetSet('Director', $proyecto->relacionAnteproyecto->relacionPredirectores->User_Nombre1." ".$proyecto->relacionAnteproyecto->relacionPredirectores->User_Apellido1);
            $proyecto->offsetSet('Palabras',  $proyecto->relacionAnteproyecto-> NPRY_Keywords);
            $proyecto->offsetSet('Duracion',  $proyecto->relacionAnteproyecto->NPRY_Duracion." Meses" );
            $proyecto->offsetSet('Estado', $proyecto->relacionEstado->EST_Estado);
            $proyecto->offsetSet('Director',$proyecto->relacionAnteproyecto->relacionPredirectores->User_Nombre1." ".$proyecto->relacionAnteproyecto->relacionPredirectores->User_Apellido1);
            


            $title = "Reporte : Proyecto De Grado Específico";
            setlocale(LC_TIME, 'es_ES'); 
            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');


            return view($this->path .'ProyectoPdf',
            compact('title' ,'fecha','proyecto','desarrollador1','desarrollador2','jurado1','jurado2','jurados'));  
     
        }
    }
    public function descargarReporteAnteproyectos(Request $request)
    {
        if ($request->isMethod('GET')) {
        
           
            $date = date("d/m/Y");
            $time = date("h:i A");
            $anteproyectos = Anteproyecto::all();


            return SnappyPdf::loadView($this->path .'AnteproyectosPdf',
                compact('anteproyectos', 'date', 'time' ))->download('ReporteAnteproyectos.pdf');
       
    }
    }

}




