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

use App\Container\Gesap\src\Controllers\PdfController;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

use App\Container\Users\src\Controllers\UsersUdecController;
use Barryvdh\DomPDF\Facade as PDF;


class PdfController extends Controller
{
    private $path = 'gesap.Reportes.';
    //Esta Función Genera la informacion para lelnar los reportes generales de anteproyectos de grado.
    public function reporteAnteproyectos(Request $request,$id)
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
            if($id == 1){
                $n=1;
                return view($this->path .'AnteproyectosPdf',
                compact('anteproyectos','n', 'title' ,'fecha','cantidad','CAsig','CRad','CApr','CRepro','CAplz','CCancel','CEsp'));
            }else{
                $n=2;
                return PDF::loadView($this->path .'.Descargables.AnteproyectosPdfD',
                compact('anteproyectos','n', 'title' ,'fecha','cantidad','CAsig','CRad','CApr','CRepro','CAplz','CCancel','CEsp'))->download('ReporteAnteproyectos.pdf');
            }
              
        }
          
    }
    //funcion que retorna los datos de un anteproyecto en especifico para su respectivo reporte
    public function reporteAnteproyecto(Request $request,$id,$idd)
    {
        if ($request->isMethod('GET')) {
            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            $j=0;
            $desarrollador1="Sin Asignar";
            $desarrollador2="Sin Asignar";
            $desarrollador1id = 0;
            $desarrollador2id = 0;
            $interacciones1v = null;
            $interacciones2v = null;
            
            $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$anteproyecto-> PK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                }else{
                    foreach($desarrolladores as $desarrollador){
                        if($j==0){
                            $desarrollador1 = $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            $desarrollador1id = $desarrollador -> relacionUsuario-> PK_User_Codigo;
                            $interacciones1 = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato','<',3)->where('FK_User_Codigo',$desarrollador -> relacionUsuario-> PK_User_Codigo)->get();
                            $interacciones1v= Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato','<',3)->where('FK_User_Codigo',$desarrollador -> relacionUsuario-> PK_User_Codigo)->first();
                            $j=1;
                        }else{
                            $desarrollador2 =  $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            $desarrollador2id = $desarrollador -> relacionUsuario-> PK_User_Codigo;
                            $interacciones2 = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato','<',3)->where('FK_User_Codigo',$desarrollador -> relacionUsuario-> PK_User_Codigo)->get();
                            $interacciones2v = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato','<',3)->where('FK_User_Codigo',$desarrollador -> relacionUsuario-> PK_User_Codigo)->first();
                        }
                    }
            }
            //interacciones de los desarrolladores
            $interacciontotal = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato','<',3)->get();
            if($interacciontotal->IsEmpty()){
                $inestotal = 1 ;
            }else{
                $inestotal = $interacciontotal->count();
            }
            if($interacciones1v==null){
                $inest1 = 0;
            }else{
                $inest1 = $interacciones1->count();
            }
            
            if($interacciones2v==null){
                $inest2 = 0;
            }else{
                $inest2 = $interacciones2->count();
            }
            $interaccionest1 = ($inest1*100)/$inestotal;
            $interaccionest2 = ($inest2*100)/$inestotal;
            //
            $i=0;
            $jurado1="Sin Asignar";
            $jurado2="Sin Asignar";
            $REntrega = 1 ;
            $jurados=Jurados::where('FK_NPRY_IdMctr008',$anteproyecto-> PK_NPRY_IdMctr008)->get();
   
            if($jurados->IsEmpty()){
            
            }else{
                foreach($jurados as $jurado){
                    
                    if($jurado->JR_Comentario_2 != 'inhabilitado'){
                        $jurado->offsetSet('Jurado',$jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1);
                        $jurado->offsetSet('Des1',$jurado->JR_Comentario);
                        $jurado->offsetSet('Des2',$jurado->JR_Comentario_2);
                        $jurado->offsetSet('Estado',$jurado->relacionEstado->EST_Estado);
                        $REntrega=2;

                    }else{
                        $jurado->offsetSet('Jurado',$jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1);
                        $jurado->offsetSet('Des',$jurado->JR_Comentario);
                        $jurado->offsetSet('Estado',$jurado->relacionEstado->EST_Estado);
                    }
                    
                  
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
            
            setlocale(LC_TIME, 'es_ES'); 
            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');


            $title = "Reporte : Anteproyecto De Grado Específico";
            $n=1;
            if($idd == 1){
                return view($this->path .'AnteproyectoPdf',
                compact('title' ,'REntrega','n','fecha','anteproyecto','desarrollador1','desarrollador2','jurado1','jurado2','jurados','interaccionest1','interaccionest2'));
            }else{
                $n=2;
                return PDF::loadView($this->path .'.Descargables.AnteproyectoPdfD',
                compact('title','n','REntrega','fecha','anteproyecto','desarrollador1','desarrollador2','jurado1','jurado2','jurados','interaccionest1','interaccionest2'))->download('ReporteAnteproyecto.pdf');
        
            }

            
              
     
        }
    }
    //esta funcion es la que envia la informacion de proyectos para el infoprme general
    public function reporteProyectos(Request $request,$id)
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

            foreach($proyectos as $proyecto){
                setlocale(LC_TIME, 'es_ES'); 
                $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');
    
                $proyecto->offsetSet('Titulo',  $proyecto->relacionAnteproyecto-> NPRY_Titulo);
                $proyecto->offsetSet('Descripcion',  $proyecto->relacionAnteproyecto-> NPRY_Descripcion);
                $proyecto->offsetSet('Director', $proyecto->relacionDirectores->User_Nombre1." ".$proyecto->relacionDirectores->User_Apellido1);
                $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                    $proyecto->offsetSet('Desarrolladores',  'Sin Asignar' );
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
                $proyecto->offsetSet('Estado',  $proyecto->relacionEstado->EST_Estado);

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
            if($id == 1){
                $n=1;
                return view($this->path .'ProyectosPdf',
                compact('proyectos','n', 'title' ,'fecha','cantidad','CAsig','CRad','CApr','CRepro','CAplz','CCancel','CEsp'));  
        
            }else{
                $n=2;
                $data = compact('proyectos','n', 'title' ,'fecha','cantidad','CAsig','CRad','CApr','CRepro','CAplz','CCancel','CEsp');
                $pdf = PDF::loadView($this->path .'.Descargables.ProyectosPdfD', $data);
                return $pdf->download('Proyectos.pdf');

            }
             
        }
    }
    public function reporteUsuario(Request $request,$id,$idd)
    {
        if ($request->isMethod('GET')) {
            $usuario= usuarios::where('PK_User_Codigo',$id)->first();
            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');
            $title = "Reporte : Usuario Especifico";
            setlocale(LC_TIME, 'es_ES'); 
            
            if($usuario->FK_User_IdEstado == 1){
                $usuario->offsetSet('Estado',  'Activo' );
            }else{
                $usuario->offsetSet('Estado',  'Inactivo' );
            }

            $usuario->offsetSet('Rol',  $usuario ->relacionUsuariosRol->Rol_Usuario );

            if($usuario->FK_User_IdRol == 1){//est
                $jurado="";
                $director="";
                $juradosproy="";
                $Proydirector="";
                $juradosante="";
                $desarrollador = Desarrolladores::where('FK_User_Codigo',$id)->get();
                if($desarrollador->IsEmpty()){
                    $usuario->offsetSet('Ante', 'Sin Asignar');
                }else{
                    foreach($desarrollador as $desarrollo){
                        $desarrollo->offsetSet('Ante', $desarrollo->relacionAnteproyecto->NPRY_Titulo);
                        $desarrollo->offsetSet('AnteEstado', $desarrollo->relacionAnteproyecto->relacionEstado->EST_Estado);
                        $desarrollo->offsetSet('AntePreDirec',$desarrollo->relacionAnteproyecto->relacionPredirectores->User_Nombre1." ".$desarrollo->relacionAnteproyecto->relacionPredirectores->User_Apellido1);
                        $proyecto=Proyecto::where('FK_NPRY_IdMctr008',$desarrollo->FK_NPRY_IdMctr008)->first();
                        if($proyecto != null){
                            $desarrollo->offsetSet('Proy', $proyecto->relacionAnteproyecto->NPRY_Titulo );
                            $desarrollo->offsetSet('Direc', $proyecto->relacionDirectores->User_Nombre1." ".$proyecto->relacionDirectores->User_Apellido1);
                            $desarrollo->offsetSet('ProyEstado', $proyecto->relacionEstado->EST_Estado); 
                        }
                    }
                }
            }

            if($usuario->FK_User_IdRol == 2){//docente
                $desarrollador = "";
                $jurado="";
                $director = Anteproyecto::where('FK_NPRY_Pre_Director',$id)->get();
                //pre director director
                foreach($director as $direc){
                    $direc->offsetSet('AnteEstado', $direc->relacionEstado->EST_Estado);
                    $direc->offsetSet('Titulo', $direc->NPRY_Titulo);
                    $j=0;
                    $desarrolladorP="";
                    $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$direc->PK_NPRY_IdMctr008)->get();
                    if($desarrolladores->IsEmpty()){
                        $direc->offsetSet('AnteDesarrolladores',  'Sin Asignar' );
                    }else{
                        foreach($desarrolladores as $desarrollador){
                            if($j==0){
                                $desarrolladorP = $desarrolladorP.$desarrollador->relacionUsuario->User_Nombre1." ".$desarrollador->relacionUsuario->User_Apellido1 ;
                                $j=1;
                            }else{
                                $desarrolladorP = $desarrolladorP.", ".$desarrollador->relacionUsuario->User_Nombre1." ".$desarrollador->relacionUsuario->User_Apellido1 ;
                            }
                        }
                        $direc->offsetSet('AnteDesarrolladores',  $desarrolladorP );
    
                    }

                }
                //proyectos director
                $Proydirector= Proyecto::where('FK_NPRY_Director',$id)->get();
                foreach($Proydirector as $proydirec){
                    $proydirec->offsetSet('Titulo',$proydirec->relacionAnteproyecto->NPRY_Titulo);
                    $proydirec->offsetSet('EstadoProy',$proydirec->relacionEstado->EST_Estado);
                    $jj=0;
                    $desarrolladorProy="";
                    $desarrolladoresProyecto = Desarrolladores::where('FK_NPRY_IdMctr008',$proydirec->FK_NPRY_IdMctr008)->get();
                    if($desarrolladoresProyecto->IsEmpty()){
                        $proydirec->offsetSet('ProyDesarrolladores',  'Sin Asignar' );
                    }else{
                        foreach($desarrolladoresProyecto as $desarrollador){
                            if($jj==0){
                                $desarrolladorProy = $desarrolladorProy.$desarrollador->relacionUsuario->User_Nombre1." ".$desarrollador->relacionUsuario->User_Apellido1 ;
                                $jj=1;
                            }else{
                                $desarrolladorProy = $desarrolladorProy.", ".$desarrollador->relacionUsuario->User_Nombre1." ".$desarrollador->relacionUsuario->User_Apellido1 ;
                            }
                        }
                        $proydirec->offsetSet('ProyDesarrolladores',  $desarrolladorProy );
    
                    }

                }
                //anteproyecto como jurado
                $juradosante = Jurados::where('FK_User_Codigo',$id)->get();
                foreach($juradosante as $juradoante){
                    $juradoante->offsetSet('Titulo', $juradoante->relacionAnteproyecto->NPRY_Titulo );
                    $juradoante->offsetSet('Estado',$juradoante->relacionAnteproyecto->relacionEstado->EST_Estado );
                    $juradoante->offsetSet('EstadoJur',$juradoante->relacionEstado->EST_Estado );

                    $jja=0;
                    $desarrolladorAntroyjur="";
                    $desarrolladoresAnteproyectojur = Desarrolladores::where('FK_NPRY_IdMctr008',$juradoante->FK_NPRY_IdMctr008)->get();

                    if($desarrolladoresAnteproyectojur->IsEmpty()){
                        $juradoante->offsetSet('Desarrolladores',  'Sin Asignar' );
                    }else{
                        foreach($desarrolladoresAnteproyectojur as $desarrollador){
                            if($jja==0){
                                $desarrolladorAntroyjur = $desarrolladorAntroyjur.$desarrollador->relacionUsuario->User_Nombre1." ".$desarrollador->relacionUsuario->User_Apellido1 ;
                                $jja=1;
                            }else{
                                $desarrolladorAntroyjur = $desarrolladorAntroyjur.", ".$desarrollador->relacionUsuario->User_Nombre1." ".$desarrollador->relacionUsuario->User_Apellido1 ;
                            }
                        }
                        $juradoante->offsetSet('Desarrolladores',  $desarrolladorAntroyjur );
    
                    }
                   
                }
                //proyecto asignado como juruado
                $juradosproy = Jurados::where('FK_User_Codigo',$id)->get();
                $concatenadoi=0;
                $proyectossirve=[];
                foreach($juradosproy as $juradoproy){
                    $juradoproy->offsetSet('Titulo',$juradoproy->relacionAnteproyecto->NPRY_Titulo);
                    if($juradoproy->relacionAnteproyecto->FK_NPRY_Estado == 4 ){
                       
                        $juradoproy->offsetSet('Estado',$juradoproy->relacionProyecto->relacionEstado->EST_Estado);      
                    }else{
                        $juradoproy->offsetSet('Estado','Sin Aprobar');
                    }
                    $jjp=0;
                    $desarrolladorProyjur="";
                    $desarrolladoresProyectojurado = Desarrolladores::where('FK_NPRY_IdMctr008',$juradoproy->FK_NPRY_IdMctr008)->get();

                    if($desarrolladoresProyectojurado->IsEmpty()){
                        $juradoproy->offsetSet('Desarrolladores',  'Sin Asignar' );
                    }else{
                        foreach($desarrolladoresProyectojurado as $desarrollador){
                            if($jjp==0){
                                $desarrolladorProyjur = $desarrolladorProyjur.$desarrollador->relacionUsuario->User_Nombre1." ".$desarrollador->relacionUsuario->User_Apellido1 ;
                                $jjp=1;
                            }else{
                                $desarrolladorProyjur = $desarrolladorProyjur.", ".$desarrollador->relacionUsuario->User_Nombre1." ".$desarrollador->relacionUsuario->User_Apellido1 ;
                            }
                        }
                        $juradoproy->offsetSet('Desarrolladores',  $desarrolladorProyjur );
    
                    }
                    if( $juradoproy->relacionEstadoJurado->EST_Estado == "RADICADO"){
                        $juradoproy->offsetSet('EstadoJur',"ASIGNADO");
                    }else{
                        $juradoproy->offsetSet('EstadoJur',  $juradoproy->relacionEstadoJurado->EST_Estado );
                    }  
                    

                    
                }
               


            }


            if($idd == 1){
                $n=1;
                return view($this->path .'UsuarioPdf',
                compact('usuario','n', 'fecha','title','desarrollador','director','jurado','Proydirector','juradosante','juradosproy'));  
         
        
            }else{
                $n=2;
                $data = compact('usuario','n', 'fecha','title','desarrollador','director','jurado','Proydirector','juradosante','juradosproy');
                $pdf = PDF::loadView($this->path .'.Descargables.UsuarioPdfD', $data);
                return $pdf->download('Usuario.pdf');

            }
        }
    }
    //reporte que devuelve los datops para el reporte de usuarios en general
    public function reporteUsuarios(Request $request,$id)
    {
        if($request->isMethod('GET')){
            $usuarios= usuarios::all();
            $total = $usuarios->count();
            $estudiantes = 0 ;
            $profesores = 0;
            $admin = 0 ;
            $title = "Reporte : Historial de Usuarios Registrados";
            
          

            foreach($usuarios as $usuario){
                if($usuario->FK_User_IdRol == 1){
                    $estudiantes = $estudiantes + 1;
                }
                if($usuario->FK_User_IdRol == 2){
                    $profesores = $profesores + 1;
                }
                if($usuario->FK_User_IdRol == 3){   
                    $admin = $admin + 1 ;
                }

                if($usuario->FK_User_IdEstado == 1){
                    $usuario->offsetSet('Estado',  'Activo' );
                }else{
                    $usuario->offsetSet('Estado',  'Inactivo' );
                }

                $usuario->offsetSet('Rol',  $usuario ->relacionUsuariosRol->Rol_Usuario );
                $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');
            
                setlocale(LC_TIME, 'es_ES'); 
            }
            if($id == 1){
                $n=1;
                return view($this->path .'UsuariosPdf',
                compact('usuarios','n', 'estudiantes' ,'profesores','admin','total','fecha','title'));  
        
            }else{
                $n=0;
                $data = compact('usuarios','n', 'estudiantes' ,'profesores','admin','total','fecha','title');
                $pdf = PDF::loadView($this->path .'.Descargables.UsuariosPdfD', $data);
                return $pdf->download('Usuarios.pdf');

            }
           
        }
    }
    //funcion que retorna los datos de un proyecto en especifico para su respectivo reporte
    public function reporteProyecto(Request $request,$id,$idd)
    {
        if ($request->isMethod('GET')) {
            $proyecto = Proyecto::where('FK_NPRY_IdMctr008',$id)->first();
            $j=0;
            $desarrollador1="Sin Asignar";
            $desarrollador2="Sin Asignar";
            $interacciones1v=null;
            $interacciones2v=null;
            $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                }else{
                    foreach($desarrolladores as $desarrollador){
                        if($j==0){
                            $desarrollador1 = $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            $desarrollador1id = $desarrollador -> relacionUsuario-> PK_User_Codigo;
                            $interacciones1 = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato',3)->where('FK_User_Codigo',$desarrollador -> relacionUsuario-> PK_User_Codigo)->get();
                            $interacciones1v = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato',3)->where('FK_User_Codigo',$desarrollador -> relacionUsuario-> PK_User_Codigo)->first();
                       
                            $j=1;
                        }else{
                            $desarrollador2 =  $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            $desarrollador2id = $desarrollador -> relacionUsuario-> PK_User_Codigo;
                            $interacciones2 = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato',3)->where('FK_User_Codigo',$desarrollador -> relacionUsuario-> PK_User_Codigo)->get();
                            $interacciones2v = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato',3)->where('FK_User_Codigo',$desarrollador -> relacionUsuario-> PK_User_Codigo)->first();
                       
                        }
                    }
            }
            $i=0;
            $jurado1="Sin Asignar";
            $jurado2="Sin Asignar";
              //interacciones de los desarrolladores
              $interacciontotal = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato',3)->get();
              if($interacciontotal->IsEmpty()){
                  $inestotal = 1 ;
              }else{
                  $inestotal = $interacciontotal->count();
              }
              if($interacciontotal->IsEmpty()){
                $inestotal = 1 ;
                }else{
                    $inestotal = $interacciontotal->count();
                }
                if($interacciones1v==null){
                    $inest1 = 0;
                }else{
                    $inest1 = $interacciones1->count();
                }
                
                if($interacciones2v==null){
                    $inest2 = 0;
                }else{
                    $inest2 = $interacciones2->count();
                }
              $interaccionest1 = ($inest1*100)/$inestotal;
              $interaccionest2 = ($inest2*100)/$inestotal;
              //
            
            $jurados=Jurados::where('FK_NPRY_IdMctr008',$proyecto->FK_NPRY_IdMctr008)->get();
            $REntrega = 1;
            if($jurados->IsEmpty()){
            
            }else{
                foreach($jurados as $jurado){

                    if($jurado->JR_Comentario_Proyecto_2 != 'inhabilitado'){
                        $jurado->offsetSet('Jurado',$jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1);
                        $jurado->offsetSet('Des1',$jurado->JR_Comentario_Proyecto);
                        $jurado->offsetSet('Des2',$jurado->JR_Comentario_Proyecto_2);
                        $jurado->offsetSet('Estado',$jurado->relacionEstadoJurado->EST_Estado);
                        $REntrega = 2;
                    }else{
                        $jurado->offsetSet('Jurado',$jurado->relacionUsuarios->User_Nombre1. " ".$jurado->relacionUsuarios->User_Apellido1);
                        $jurado->offsetSet('Des',$jurado->JR_Comentario_Proyecto);
                        $jurado->offsetSet('Estado',$jurado->relacionEstadoJurado->EST_Estado);
    
                    }
                  
                    
                  
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
            $proyecto->offsetSet('Director', $proyecto->relacionDirectores->User_Nombre1." ".$proyecto->relacionDirectores->User_Apellido1);
            $proyecto->offsetSet('Palabras',  $proyecto->relacionAnteproyecto-> NPRY_Keywords);
            $proyecto->offsetSet('Duracion',  $proyecto->relacionAnteproyecto->NPRY_Duracion." Meses" );
            $proyecto->offsetSet('Estado', $proyecto->relacionEstado->EST_Estado);
            $proyecto->offsetSet('Semillero', $proyecto->relacionAnteproyecto->NPRY_Semillero);
            
            setlocale(LC_TIME, 'es_ES'); 
            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');


            $title = "Reporte : Proyecto De Grado Específico";
            
            if($idd == 1){
                $n=1;
                return view($this->path .'ProyectoPdf',
                  compact('title','REntrega','n','fecha','proyecto','desarrollador1','desarrollador2','jurado1','jurado2','jurados','interaccionest1','interaccionest2'));  
     
            }else{
                $n=2;
                return PDF::loadView($this->path .'.Descargables.ProyectoPdfD',
                compact('title','n','fecha','REntrega','proyecto','desarrollador1','desarrollador2','jurado1','jurado2','jurados','interaccionest1','interaccionest2'))->download('ReporteProyecto.pdf');
     
            }
            
        }
    }
    //funcion para descargar un reporte en especifico con el esta $id= estado//

    public function ReportesEspAnteproyecto(Request $request,$id)
    {
        if ($request->isMethod('GET')) {
        
               $anteproyectos = Anteproyecto::where('FK_NPRY_Estado',$id)->get();
            
                $title = "Reporte : Historial de Anteproyectos De Grado Por Estado";
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

                }    
            
                setlocale(LC_TIME, 'es_ES'); 

                $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 
                return PDF::loadView($this->path .'.Descargables.AnteproyectosFiltroPdfD',
                compact('anteproyectos','title' ,'fecha'))->download('ReportePorEstado.pdf');  
 
        }
    }
//descargar un reporte especifico con las fechas $id = fecha inicial $id2= fecha secundaria///
    public function ReportesEspAnteproyectoF(Request $request,$id,$id2)
    {
        if ($request->isMethod('GET')) {
        
               
               $anteproyectos = Anteproyecto::whereBetween('NPRY_FCH_Radicacion',[$id,$id2])->get(); 
               
                $title = "Reporte : Historial de Anteproyectos De Grado Por Estado";
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

                }    
            
                setlocale(LC_TIME, 'es_ES'); 

                $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 
                
                return PDF::loadView($this->path .'.Descargables.AnteproyectosFiltroPdfD',
                compact('anteproyectos','title' ,'fecha'))->download('ReportePorFecha.pdf');  
 
        }
    }

//descargar un reporte especifico con las palabras clave///
public function ReportesEspAnteproyectoPC(Request $request,$id)
{
    if ($request->isMethod('GET')) {
    
           $anteproyectos = Anteproyecto::where('NPRY_Keywords','LIKE','%'.$id.'%')->get();
        
            $title = "Reporte : Historial de Anteproyectos De Grado Por Palabras Clave";
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

            }    
        
            setlocale(LC_TIME, 'es_ES'); 

            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 
            return PDF::loadView($this->path .'.Descargables.AnteproyectosFiltroPdfD',
            compact('anteproyectos','title' ,'fecha'))->download('ReportePorFecha.pdf');  

    }
}

//descargar un reporte especifico por porfesores y proyectos activos o inactivos///
public function ReportesEspAnteproyectoPE(Request $request,$id,$id2)
{
    if ($request->isMethod('GET')) {
        if($id2==1){
            $anteproyectos = Anteproyecto::where('FK_NPRY_Pre_Director',$id)->where('NPRY_Ante_Estado',1)->get();
            
        }else{
            $anteproyectos = Anteproyecto::where('FK_NPRY_Pre_Director',$id)->where('NPRY_Ante_Estado',2)->get();
    
        }
        
            $title = "Reporte : Historial de Anteproyectos De Grado Por Docente y Estado";
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

            }    
        
            setlocale(LC_TIME, 'es_ES'); 

            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 
            return PDF::loadView($this->path .'.Descargables.AnteproyectosFiltroPdfD',
            compact('anteproyectos','title' ,'fecha'))->download('ReportePorFecha.pdf');  

    }
}

//funcion que imprime el reporte por estado de PROYECTOS
public function ReportesEspProyecto(Request $request,$id)
{
    if ($request->isMethod('GET')) {
    
           $proyectos = Proyecto::where('FK_EST_Id',$id)->get();
        
            $title = "Reporte : Historial de Proyectos De Grado Por Estado";
            $j=0;
            $desarrolladorP = "";
            foreach($proyectos as $proyecto){
                setlocale(LC_TIME, 'es_ES'); 
                $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');

                $proyecto->offsetSet('Titulo',  $proyecto->relacionAnteproyecto-> NPRY_Titulo);
                $proyecto->offsetSet('Descripcion',  $proyecto->relacionAnteproyecto-> NPRY_Descripcion);
                $proyecto->offsetSet('Director', $proyecto->relacionDirectores->User_Nombre1." ".$proyecto->relacionDirectores->User_Apellido1);
                $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                    $proyecto->offsetSet('Desarrolladores',  'Sin Asignar' );
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
                $proyecto->offsetSet('Estado',  $proyecto->relacionEstado->EST_Estado);

            } 
        
           
        
            setlocale(LC_TIME, 'es_ES'); 

            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 
            return PDF::loadView($this->path .'.Descargables.ProyectosFiltroPdfD',
            compact('proyectos','title' ,'fecha'))->download('ReportePorEstado.pdf');  

    }
}
//descargar un reporte especifico con las fechas $id = fecha inicial $id2= fecha secundaria de proyectos///
public function ReportesEspProyectoF(Request $request,$id,$id2)
{
    if ($request->isMethod('GET')) {
    
           
           $proyectos = Proyecto::whereBetween('PYT_Fecha_Radicacion',[$id,$id2])->get(); 
           
           $title = "Reporte : Historial de Proyectos De Grado Por Docente y Estado";
            $j=0;
            $desarrolladorP = "";
            foreach($proyectos as $proyecto){
                setlocale(LC_TIME, 'es_ES'); 
                $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');

                $proyecto->offsetSet('Titulo',  $proyecto->relacionAnteproyecto-> NPRY_Titulo);
                $proyecto->offsetSet('Descripcion',  $proyecto->relacionAnteproyecto-> NPRY_Descripcion);
                $proyecto->offsetSet('Director', $proyecto->relacionDirectores->User_Nombre1." ".$proyecto->relacionDirectores->User_Apellido1);
                $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                    $proyecto->offsetSet('Desarrolladores',  'Sin Asignar' );
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
                $proyecto->offsetSet('Estado',  $proyecto->relacionEstado->EST_Estado);

            } 
        
            setlocale(LC_TIME, 'es_ES'); 

            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 
            
            return PDF::loadView($this->path .'.Descargables.ProyectosFiltroPdfD',
            compact('proyectos','title' ,'fecha'))->download('ReportePorFecha.pdf');  

    }
}

//descargar un reporte especifico con las palabras clave de proyectos///
public function ReportesEspProyectoPC(Request $request,$id)
{
if ($request->isMethod('GET')) {

       $anteproyectos = Anteproyecto::where('NPRY_Keywords','LIKE','%'.$id.'%')->where('FK_NPRY_Estado',4)->get();
    
        $title = "Reporte : Historial de Proyecto De Grado Por Palabras Clave";
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

        }    
    
        setlocale(LC_TIME, 'es_ES'); 

        $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 
        return PDF::loadView($this->path .'.Descargables.AnteproyectosFiltroPdfD',
        compact('anteproyectos','title' ,'fecha'))->download('ReportePorFecha.pdf');  

}
}

//descargar un reporte especifico por porfesores y proyectos activos o inactivos ///
public function ReportesEspProyectoPE(Request $request,$id,$id2)
{
    if ($request->isMethod('GET')) {
        if($id2==1){
            $proyectos = Proyecto::where('FK_NPRY_Director',$id)->where('NPRY_Pro_Estado',1)->get();
            
        }else{
            $proyectos = Proyecto::where('FK_NPRY_Director',$id)->where('NPRY_Pro_Estado',2)->get();

        }
        
            $title = "Reporte : Historial de Proyectos De Grado Por Docente y Estado";
            $j=0;
            $desarrolladorP = "";
            foreach($proyectos as $proyecto){
                setlocale(LC_TIME, 'es_ES'); 
                $fecha = Carbon::now()->formatlocalized('%A %d %B %Y');

                $proyecto->offsetSet('Titulo',  $proyecto->relacionAnteproyecto-> NPRY_Titulo);
                $proyecto->offsetSet('Descripcion',  $proyecto->relacionAnteproyecto-> NPRY_Descripcion);
                $proyecto->offsetSet('Director', $proyecto->relacionDirectores->User_Nombre1." ".$proyecto->relacionDirectores->User_Apellido1);
                $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->get();
                if($desarrolladores->IsEmpty()){
                    $proyecto->offsetSet('Desarrolladores',  'Sin Asignar' );
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
                $proyecto->offsetSet('Estado',  $proyecto->relacionEstado->EST_Estado);

            }
        
            setlocale(LC_TIME, 'es_ES'); 

            $fecha = Carbon::now()->formatlocalized('%A %d %B %Y'); 

            return PDF::loadView($this->path .'.Descargables.ProyectosFiltroPdfD',
            compact('proyectos','title' ,'fecha'))->download('ReportePorFecha.pdf');  

    }
}


    public function descargarReporteAnteproyectos($data)
    {
       
    }

}




