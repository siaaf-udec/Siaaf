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

use App\Container\Gesap\src\Anteproyecto;
use App\Container\Gesap\src\Proyecto;
use App\Container\Gesap\src\Solicitud;
use App\Container\Gesap\src\Actividad;
use App\Container\Gesap\src\Radicacion;
use App\Container\Gesap\src\Encargados;
use App\Container\Gesap\src\Usuarios;
use App\Container\Gesap\src\Fechas;
use App\Container\Gesap\src\Jurados;

use App\Container\Gesap\src\RolesUsuario;
use App\Container\Gesap\src\Desarrolladores;
use App\Container\Gesap\src\Estados;
use App\Container\Gesap\src\Mctr008;
use App\Container\Users\src\User;
use App\Container\Gesap\src\EstadoAnteproyecto;
use App\Container\Users\src\UsersUdec;


use Illuminate\Support\Facades\Auth;

use App\Container\Gesap\src\Mail\EmailGesap;
use Illuminate\Support\Facades\Mail;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

use App\Container\Users\src\Controllers\UsersUdecController;


class CoordinatorController extends Controller
{

	private $path = 'gesap.Coordinador.';


	// CONTROLLERS CREADOS PARA GESAP V2.0//
    /// VISTAS ////////
	public function index(Request $request)
	{
		
			return view($this->path . 'Anteproyectos');
		
    }
    
    public function indexSolicitudes(Request $request)
	{
		
			return view($this->path . 'Coordinador.IndexSolicitudes');
		
    }
    public function indexSolicitudesajax(Request $request, $ids)
	{
		
        if ($request->ajax() && $request->isMethod('GET')) {
            $solicitud = Solicitud::where('PK_Id_Solicitud',$ids)->first();
            $solicitud ->Sol_Estado = 'Realizada';
            $solicitud -> save();
            return view($this->path . 'Coordinador.IndexSolicitudes');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
		);
		
    }
    
   
	public function usuariosindex(Request $request)
	{   
		
			return view($this->path . 'Anteproyectos');
		
    }
    
	public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path .'AnteproyectosAjax');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
		);
    }

    public function mctindex(Request $request)
	{
        if ($request->ajax() && $request->isMethod('GET')) {
           
            return view($this->path .'Mct',
                [
                   
                ]);
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    public function Libro(Request $request)
	{
        if ($request->ajax() && $request->isMethod('GET')) {
           
            return view($this->path .'.Proyecto.Libro',
                [
                   
                ]);
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    
    
    public function CerrarSolicitud(Request $request,$ids)
	{
        if ($request->ajax() && $request->isMethod('GET')) {

            $solicitud = Solicitud::where('PK_Id_Solicitud',$ids)->first();
            $solicitud ->Sol_Estado = 'Realizada';
            $solicitud -> save();


                return AjaxResponse::success(
                    '¡Hecho!',
                    'Solicitud Cerrada.'
                );
        }
    }
    
    public function indexProyecto(Request $request)
	{
        return view($this->path .'Proyecto.ProyectoGesap',
        [
           
        ]);
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    public function indexProyectoajax(Request $request)
	{
        //if ($request->ajax() && $request->isMethod('GET')) {
        return view($this->path .'Proyecto.ProyectoGesap',
        [
           
        ]);
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
   // }
    }
    
    
    public function MctLimit(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path .'MctLimit',
            [
               
            ]);
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function LibroLimit(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path .'Proyecto.LibroLimit',
            [
               
            ]);
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    public function AsignarAnteproyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $infoAnte = Anteproyecto::find($id);

                      
            return view($this->path .'AsignarAnteproyecto',
                [
                    'infoAnte' => $infoAnte,
                ]);
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    public function AsignarDesarrolladorstore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $datos = Anteproyecto::where('PK_NPRY_IdMctr008',$request['PK_NPRY_Mctr008'])->get();
                      
                  return view($this->path .'AsignarDesarrolladores',
                [
                    'datos' => $datos,
                ]);
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                ); 
            }
    }
    public function AsignarDesarrollador(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $datos = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->get();
     
            
                  return view($this->path .'AsignarDesarrolladores',
                [
                    'datos' => $datos,
                ]);
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }
    public function AsignarJurados(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $datos = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->get();
     
            
                  return view($this->path .'AsignarJurados',
                [
                    'datos' => $datos,
                ]);
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }
    
    public function MctCreate(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                      
                  return view($this->path .'MctCrear',
                [
                    
                ]);
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }

    //Funcion que sirve para listar la informacion de proyectos de grado para el rol coordinador
	public function anteproyectoList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

		   
           $anteproyectos=Anteproyecto::all();
           
           $desarrolladorP = "";
           foreach($anteproyectos as $anteproyecto){

            $estado = $anteproyecto -> relacionEstado -> EST_Estado;
            $anteproyecto->offsetSet('Estado',  $estado );

            $Predirector = $anteproyecto-> relacionPredirectores-> User_Nombre1." ".$anteproyecto-> relacionPredirectores-> User_Apellido1;
            $anteproyecto->offsetSet('Nombre',  $Predirector );
            $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$anteproyecto->PK_NPRY_IdMctr008)->get();
            $desarrolladoresv = Desarrolladores::where('FK_NPRY_IdMctr008',$anteproyecto->PK_NPRY_IdMctr008)->first();
            $i=0;
            if($desarrolladores->IsEmpty()){
                $anteproyecto->offsetSet('Desarrolladores',  'Sin Asignar' );
            }else{
                foreach($desarrolladores as $desarrollador){
                    if($i==0){
                        $desarrolladorP = $desarrolladorP.$desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                        $i=1;
                    }else{
                        $desarrolladorP = $desarrolladorP.", ". $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                    }
                }
                $anteproyecto->offsetSet('Desarrolladores',  $desarrolladorP );
            }
            
           }

               return DataTables::of($anteproyectos)
               ->removeColumn('created_at')
			   ->removeColumn('updated_at')
			    
			   ->addIndexColumn()
			   ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function listarPreDirector(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $Pre_directores = Usuarios::Where('FK_User_IdRol','2')->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $Pre_directores
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
    public function FechasRadicacion(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $Fechas = Fechas::where('PK_Id_Radicacion', '<', 3)->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $Fechas
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
    //funcion Que permite mostrar los datos de los proyectos de grado coordinador
    public function ProyectosList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Proyectos = Proyecto::all();
            if(empty($Proyectos)){

                $Proyectos = [];
                
            }else{

                foreach($Proyectos as $proyecto){

                    $Anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->first();

                    $proyecto->offsetSet('Titulo',$Anteproyecto->NPRY_Titulo);
                    $proyecto->offsetSet('Id_Proyecto',$Anteproyecto->PK_NPRY_IdMctr008);
                    $proyecto->offsetSet('Palabras',$Anteproyecto->NPRY_Keywords);
                    $proyecto->offsetSet('Descripcion',$Anteproyecto->NPRY_Descripcion);
                    $proyecto->offsetSet('Duracion',$Anteproyecto->NPRY_Duracion);
                    $proyecto->offsetSet('Director',$Anteproyecto->relacionPredirectores -> User_Nombre1. " ".$Anteproyecto -> relacionPredirectores -> User_Apellido1 );
                    $proyecto->offsetSet('Estado',$proyecto->relacionEstado->EST_Estado);
                    $proyecto->offsetSet('Fecha',$proyecto->PYT_Fecha_Radicacion);
                    $i=0;
                    $desarrolladorP="";
                    $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$proyecto-> FK_NPRY_IdMctr008)->get();
                    if($desarrolladores->IsEmpty()){
                        $proyecto->offsetSet('Desarrolladores',  'Sin Asignar' );
                    }else{
                        foreach($desarrolladores as $desarrollador){
                            if($i==0){
                                $desarrolladorP = $desarrolladorP.$desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                                $i=1;
                            }else{
                                $desarrolladorP = $desarrolladorP.", ". $desarrollador -> relacionUsuario-> User_Nombre1 ." ".$desarrollador -> relacionUsuario-> User_Apellido1 ;
                            }
                        }
                    
                        $proyecto->offsetSet('Desarrolladores',  $desarrolladorP );

                    }

                }

            }
          
            return DataTables::of($Proyectos)
                
                   ->addIndexColumn()
                   ->make(true);
    
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
    }

    public function SolicitudesList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Solicitudes = Solicitud::all();

            if(empty($Solicitudes)){

                $Solicitudes = [];
                
            }else{

                foreach($Solicitudes as $Solicitud){


                    $Solicitud->offsetSet('Usuario',$Solicitud->relacionUsuario->User_Nombre1." ".$Solicitud->relacionUsuario->User_Apellido1);
                    $Solicitud->offsetSet('Proyecto',$Solicitud->relacionProyecto->NPRY_Titulo);
                    $Solicitud->offsetSet('IdProyecto',$Solicitud->relacionProyecto->PK_NPRY_IdMctr008);
                    

                }

            }
          
            return DataTables::of($Solicitudes)
                
                   ->addIndexColumn()
                   ->make(true);
    
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
    }
    
    public function CancelarProyecto(Request $request, $id)
    {
        if ($request->isMethod('GET')) {	

            $Proyecto=Proyecto::where('PK_Id_Proyecto',$id)->first();
            $Proyecto->FK_EST_Id=7;
            $Proyecto->save();

            
            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008', $Proyecto->FK_NPRY_IdMctr008)->first(); 
            $anteproyecto-> FK_NPRY_Estado = 7;
            $anteproyecto->save();
            
            $Desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$Proyecto->FK_NPRY_IdMctr008)->get();
            if(empty($Desarrolladores )){
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Anteproyecto Cancelado Correctamente.'
                );
            }else{
                foreach($Desarrolladores as $Desarrollador){
                    $Desarrollador -> FK_IdEstado = 2;
                    $Desarrollador -> save();
                }

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Anteproyecto Cancelado Correctamente.'
            );
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }   


    public function listfechas(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $fechas = Fechas::where('PK_Id_Radicacion','<',3)->get();
                $i = 1;
                foreach($fechas as $fecha){
                    $titulo = 'Fecha De radicacion Numero -';
                    
                    $fecha->offsetSet('Radicacion',$titulo.$i);
                    
                    $i = $i +1;
                }
            return DataTables::of($fechas)
                
                   ->addIndexColumn()
                   ->make(true);
    
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
    }
    
    public function listfechasProyecto(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $fechas = Fechas::where('PK_Id_Radicacion','>',2)->get();
                $i = 1;
                foreach($fechas as $fecha){
                    $titulo = 'Fecha De radicacion Numero -';
                    
                    $fecha->offsetSet('Radicacion',$titulo.$i);
                    
                    $i = $i +1;
                }
            return DataTables::of($fechas)
                
                   ->addIndexColumn()
                   ->make(true);
    
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
    }
    

    public function listaActividades(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $Actividades = Mctr008::where('FK_Id_Formato','!=',3)->get();
            foreach($Actividades as $Actividad){
                $Formato = $Actividad->relacionFormato-> MCT_Formato;
                $Actividad->offsetSet('Formato',$Formato);
            }

            return DataTables::of($Actividades)
                
			   ->addIndexColumn()
               ->make(true);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    public function listaActividadesLibro(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $Actividades = Mctr008::where('FK_Id_Formato',3)->get();
            foreach($Actividades as $Actividad){
                $Formato = $Actividad->relacionFormato-> MCT_Formato;
                $Actividad->offsetSet('Formato',$Formato);
            }

            return DataTables::of($Actividades)
                
			   ->addIndexColumn()
               ->make(true);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }

    public function AsignarDesarrolladoreslist(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $usuarios = Usuarios::where('FK_User_IdRol',1)->where('FK_User_IdEstado',1)->get();
            
             $i=0;
            $concatenado=[];
              foreach($usuarios as $user){
      
                   $desarrollador= Desarrolladores::where('FK_User_Codigo',  $user->PK_User_Codigo)->where('FK_IdEstado',1)->first();
                       
                 
                   if(is_null($desarrollador)){
                    $collection = collect([]);
                    $collection->put('Codigo',$user-> User_Codigo);
                    
                    $collection->put('Cedula',$user-> PK_User_Codigo);
                    $collection->put('Nombre',$user->  User_Nombre1);
                    $collection->put('Apellido',$user->  User_Apellido1);
                    $collection->put('Correo',$user-> User_Correo);
                       
       
                        
                    $concatenado[$i]= $collection;

                    $i=$i+1;
                       
                    }
                   
               
                   
               }

            return DataTables::of($concatenado)
                
			   ->addIndexColumn()
               ->make(true);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    public function AsignarJuradoslist(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
//disponibles
            $usuarios = Usuarios::where('FK_User_IdRol',2)->where('FK_User_IdEstado',1)->get();       
//unico no disponible
            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            $Predirector =  $anteproyecto -> FK_NPRY_Pre_Director;

            $i=0;
            $concatenado=[];

              foreach($usuarios as $user){
      
                   $jurado = $user -> PK_User_Codigo;
                   if($jurado != $Predirector) {
                    $jurados= Jurados::where('FK_User_Codigo',$jurado)->where('FK_NPRY_IdMctr008',$id)->first();
                    if(is_null($jurados)){
                    $collection = collect([]);
                    $collection->put('Codigo',$user-> User_Codigo);
                   
                    $collection->put('Cedula',$user-> PK_User_Codigo);
                    $collection->put('Nombre',$user->  User_Nombre1);
                    $collection->put('Apellido',$user->  User_Apellido1);
                    $collection->put('Correo',$user-> User_Correo);
                      
      
                       
                    $concatenado[$i]= $collection;

                    $i=$i+1;
                    }
                   }     
               
                   
               }

               return DataTables::of($concatenado)
               ->removeColumn('created_at')
               ->removeColumn('updated_at')
                
               ->addIndexColumn()
               ->make(true);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    public function JuradosList(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Jurados = Jurados::where('FK_NPRY_IdMctr008',$id)->get();

            $s=0;

            foreach($Jurados as $juez){
                
                $id_user[$s]= $juez -> FK_User_Codigo;
            

                $user = Usuarios::where('PK_User_Codigo',$id_user[$s])->first();

                $nombre[$s] = $user -> User_Nombre1;

                $Apellido[$s] = $user -> User_Apellido1;
 
                $juez->offsetSet('Codigo',$id_user[$s]);

                $juez->offsetSet('Nombre',$nombre[$s]);
                
                $juez->offsetSet('Apellido',$Apellido[$s]);             

                $s=$s+1;
               }
         
         
            
              return DataTables::of($Jurados)
              ->removeColumn('created_at')
              ->removeColumn('updated_at')
               
              ->addIndexColumn()
              ->make(true);
            }
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        
    }
    
	public function DesarrolladoresList(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Desarrollador = Desarrolladores::where('FK_NPRY_IdMctr008',$id)->get();

            $s=0;

            foreach($Desarrollador as $desarrollo){
                
                $id_user[$s]= $Desarrollador[$s]-> FK_User_Codigo;
            

                $user = Usuarios::where('PK_User_Codigo',$id_user[$s])->first();

                $nombre[$s] = $user -> User_Nombre1;

                $Apellido[$s] = $user -> User_Apellido1;
 
                $desarrollo->offsetSet('CodigoJ',$id_user[$s]);

                $desarrollo->offsetSet('NombreJ',$nombre[$s]);
                
                $desarrollo->offsetSet('ApellidoJ',$Apellido[$s]);             

                $s=$s+1;
               }
         
         
            
              return DataTables::of($Desarrollador)
              ->removeColumn('created_at')
              ->removeColumn('updated_at')
               
              ->addIndexColumn()
              ->make(true);
            }
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        
    }
    
    public function VerAnteproyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $infoAnte = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->get();
            $infoAnteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            
          
            $estado = $infoAnteproyecto -> relacionEstado -> EST_Estado;

            $Nombre = $infoAnteproyecto -> relacionPredirectores-> User_Nombre1;
            
            $Apellido = $infoAnteproyecto -> relacionPredirectores-> User_Apellido1;

            $infoAnte->put('Estado',$estado);
            
            $infoAnte->put('Nombre',$Nombre);
            
            $infoAnte->put('Apellido',$Apellido);

            $datos = $infoAnte;

            

                return view ($this->path .'VerAnteproyecto',
                [
                   
                    'datos' => $datos,
                ]);

                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    public function VerProyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Proyectos= Proyecto::where('FK_NPRY_IdMctr008',$id)->get();
            foreach($Proyectos as $Proyecto){
            $Proyecto->offsetSet('Estado',$Proyecto->relacionEstado->EST_Estado);
            $Proyecto->offsetSet('id_proyecto',$Proyecto->FK_NPRY_IdMctr008);
            
            $Proyecto->offsetSet('Director',$Proyecto->relacionAnteproyecto->relacionPredirectores->User_Nombre1. " ".$Proyecto->relacionAnteproyecto->relacionPredirectores->User_Apellido1 );
            
            $Proyecto->offsetSet('Titulo', $Proyecto->relacionAnteproyecto->NPRY_Titulo);
            $Proyecto->offsetSet('Palabras', $Proyecto->relacionAnteproyecto->PRY_Keywords);
            $Proyecto->offsetSet('Descripcion', $Proyecto->relacionAnteproyecto->NPRY_Descripcion);
            
            $Proyecto->offsetSet('Fecha', $Proyecto->PYT_Fecha_Radicacion);
            $Proyecto->offsetSet('Duracion', $Proyecto->relacionAnteproyecto->NPRY_Duracion);
            
            }
            
            $datos = $Proyecto;
                return view ($this->path .'Proyecto.VerProyecto',
                [
                   
                    'datos' => $datos,
                ]);

                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    
    public function VerProyectoSolicitud(Request $request, $id,$ids)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Solicitud = Solicitud::where('PK_Id_Solicitud',$ids)->first();
            $Proyecto= Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();


            $Proyecto->offsetSet('Solicitud',$Solicitud->Sol_Solicitud);
            $Proyecto->offsetSet('IDSolicitud',$ids);
            $Proyecto->offsetSet('Solicitud_usuario',$Solicitud ->relacionUsuario->User_Nombre1." ".$Solicitud ->relacionUsuario->User_Apellido1);
            
            $Proyecto->OffsetSet('Proyecto',$Proyecto->NPRY_Titulo);
            $Proyecto->OffsetSet('IdProyecto',$Proyecto->PK_NPRY_IdMctr008);
            $Proyecto->OffsetSet('FechaAnteproyecto',$Proyecto->NPRY_FCH_Radicacion);
            
            $Proyecto->OffsetSet('Director',$Proyecto->User_Nombre1." ".$Proyecto->User_Apellido1);
            $Proyecto->OffsetSet('IdDirector',$Proyecto->FK_NPRY_Pre_Director);

            $ProyectoRadicado = Proyecto::where('FK_NPRY_IdMctr008',$id)->first();
            if($ProyectoRadicado != null){
                $Proyecto->OffsetSet('FechaProyecto',$ProyectoRadicado->PYT_Fecha_Radicacion);
            }else{
                $Proyecto->OffsetSet('FechaProyecto','Aun No Es Un Proyecto Valido');
            }
            
            $datos = $Proyecto;
                return view ($this->path .'Coordinador.VerProyectoSolicitud',
                [
                   
                    'datos' => $datos,
                ]);

                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    
	
	public function listarEstado(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $Estado = EstadoAnteproyecto::where('PK_EST_Id','<',3)->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $Estado
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
    
    /////////////// CREATE ////////
    public function CreateAnte(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $Pre_directores = Usuarios::Where('FK_User_IdRol','5')->get();
            return view($this->path .'CrearAnteproyecto',
                [
                    'Pre_directores' => $Pre_directores,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
    public function desarrolladorstore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $datos = Desarrolladores::Where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->get();
            $numero = $datos->count();
            if ($numero >= 2){
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud, el Anteproyecto ya tiene el numero maximo de desarrolladores asignados.',
                    $IdError
                );

            }else{

            
            Desarrolladores::create([
                'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                'FK_User_Codigo' => $request['PK_User_Codigo'],
                'FK_IdEstado' => 1 ,
               
            ]);
            
			return AjaxResponse::success(
				'¡Esta Hecho!',
				'Desarrollador Asignado al Anteproyecto.'
            );
        }
        }
    }
    public function editarfechas(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$request['proyecto'])->first();
            $proyecto = Proyecto::where('FK_NPRY_IdMctr008',$request['proyecto'])->first();
          
            if($request['Fecha1'] != "undefined"){

                $anteproyecto -> NPRY_FCH_Radicacion = $request['Fecha1'];
                $anteproyecto -> save();    
                
		
            }
            if($proyecto != null){
                
                if($request['Fecha2'] != "undefined"){
                    $proyecto -> PYT_Fecha_Radicacion = $request['Fecha2'];
                    $proyecto -> save();    
                    
            
                }
            }
            
            return AjaxResponse::success(
				'¡Esta Hecho!',
				'Fecha Cambiada.'
            );        
        }
        
    }
    public function juradostore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $datos = Jurados::Where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->get();
            $numero = $datos->count();
            if ($numero >= 2){
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud, el Anteproyecto ya tiene el numero maximo de jurados asignados.',
                    $IdError
                );

            }else{

            
            Jurados::create([
                'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                'FK_User_Codigo' => $request['PK_User_Codigo'],
                'FK_NPRY_Estado' => 3,
                'FK_NPRY_Estado_Proyecto' => 3,
                'JR_Comentario' => "Sin Comentarios.",
                'JR_Comentario_Proyecto' => "Sin Comentarios.",
               
            ]);
            
			return AjaxResponse::success(
				'¡Esta Hecho!',
				'Jurado Asignado al Anteproyecto.'
            );
        }
        }
    }
    
	public function store(Request $request)
    {
	
        if ($request->ajax() && $request->isMethod('POST')) {	
            
           Anteproyecto::create([
			 'NPRY_Titulo' => $request['NPRY_Titulo'],
			 'NPRY_Keywords' => $request['NPRY_Keywords'],
			 'NPRY_Descripcion' => $request['NPRY_Descripcion'],
			 'NPRY_Duracion' => $request['NPRY_Duracion'],
			 'FK_NPRY_Pre_Director' => $request['FK_NPRY_Pre_Director'],
             'FK_NPRY_Estado' => $request['FK_NPRY_Estado'],
             'NPRY_FCH_Radicacion' => $request['NPRY_FCH_Radicacion'],
            ]);

            $user = Usuarios::where('PK_User_Codigo',$request['FK_NPRY_Pre_Director'])->first();
            $correo = $user->User_Correo;
            $nombre = $user->User_Nombre1;
            Mail::to($correo)->send(new EmailGesap($nombre));

            return AjaxResponse::success(
				'¡Esta Hecho!',
				'Datos Creados.'
			);
            
        }
	
			
        
    }
    public function storefechas(Request $request)
    {
		if ($request->ajax() && $request->isMethod('POST')) {	
            
  
            $fecha = Fechas::where('PK_Id_Radicacion',1)->first();
            $fecha -> FCH_Radicacion = $request['FCH_Radicacion_principal'];
            $fecha -> save();
            $fecha = Fechas::where('PK_Id_Radicacion',2)->first();
            $fecha -> FCH_Radicacion = $request['FCH_Radicacion_secundaria'];
            $fecha -> save();

            $anteproyectos = Anteproyecto::where('FK_NPRY_Estado',6)->get();
            foreach($anteproyectos as $anteproyecto){

                $anteproyecto -> NPRY_FCH_Radicacion =  $request['FCH_Radicacion_principal'];
                $anteproyecto -> save();

            }
     
        }
	
		
	
			return AjaxResponse::success(
				'¡Esta Hecho!',
				'Datos Creados.'
			);
        
    }
    public function storefechasProyecto(Request $request)
    {
		if ($request->ajax() && $request->isMethod('POST')) {	
            
  
            $fecha = Fechas::where('PK_Id_Radicacion',3)->first();
            $fecha -> FCH_Radicacion = $request['FCH_Radicacion_principal'];
            $fecha -> save();
            $fecha = Fechas::where('PK_Id_Radicacion',4)->first();
            $fecha -> FCH_Radicacion = $request['FCH_Radicacion_secundaria'];
            $fecha -> save();

            $ProyectosA = Proyecto::where('FK_EST_Id',4)->get();
            foreach($ProyectosA as $ProyectoA){

                $ProyectoA -> PYT_Fecha_Radicacion =  $request['FCH_Radicacion_principal'];
                $ProyectoA -> save();

            }
            $ProyectosAs = Proyecto::where('FK_EST_Id',2)->get();
            foreach($ProyectosAs as $ProyectoAs){

                $ProyectoAs -> PYT_Fecha_Radicacion =  $request['FCH_Radicacion_principal'];
                $ProyectoAs -> save();

            }
     
        }
	
		
	
			return AjaxResponse::success(
				'¡Esta Hecho!',
				'Datos Creados.'
			);
        
    }
    public function CreateMct(Request $request)
    {
		if ($request->ajax() && $request->isMethod('POST')) {	
        
	
			Mctr008::create([
			 'MCT_Actividad' => $request['MCT_Actividad'],
             'MCT_Descripcion' => $request['MCT_Descripcion'],
			 'FK_Id_Formato' => $request['FK_Id_Formato'],
			 
			]);
		}
	
			return AjaxResponse::success(
				'¡Esta Hecho!',
				'Datos Creados.'
			);
        
    }
    public function createlibro(Request $request)
    {
		if ($request->ajax() && $request->isMethod('POST')) {	
        
	
			Mctr008::create([
			 'MCT_Actividad' => $request['MCT_Actividad'],
             'MCT_Descripcion' => $request['MCT_Descripcion'],
			 'FK_Id_Formato' => $request['FK_Id_Formato'],
			 
			]);
		}
	
			return AjaxResponse::success(
				'¡Esta Hecho!',
				'Datos Creados.'
			);
        
    }
          
    //////////////// EDITARR ///////
    
   
    public function updateAnte(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $anteproyecto = Anteproyecto::Where('PK_NPRY_IdMctr008', $request['PK_NPRY_IdMctr008'])->first();
            
            $anteproyecto -> NPRY_Titulo = $request['NPRY_Titulo']; 
            $anteproyecto -> NPRY_Keywords = $request['NPRY_Keywords'];
            $anteproyecto -> NPRY_Descripcion = $request['NPRY_Descripcion'];
            $anteproyecto -> NPRY_Duracion = $request['NPRY_Duracion'];
            $anteproyecto -> FK_NPRY_Pre_Director = $request['FK_NPRY_Pre_Director'];
            
            $anteproyecto -> save();



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

    	

	public function EditarAnteproyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
           
            $datos = Anteproyecto::where('PK_NPRY_IdMctr008', $id)->first();
            $infoAnte = Anteproyecto::where('PK_NPRY_IdMctr008', $id)->get();

            $estado = $datos-> relacionEstado-> EST_Estado;

            $infoAnte->put('Estado',$estado);
            
                    
            return view($this->path .'EditarAnteproyecto',
                [
                    'infoAnte' => $infoAnte,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
    public function CancelarAnte(Request $request, $id)
    {
        if ($request->isMethod('GET')) {	
            
            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008', $id)->first(); 
            $anteproyecto-> FK_NPRY_Estado = 7;
            $anteproyecto->save();
            
            $Desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$id)->get();
            if(empty($Desarrolladores )){
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Anteproyecto Cancelado Correctamente.'
                );
            }else{
                foreach($Desarrolladores as $Desarrollador){
                    $Desarrollador -> FK_IdEstado = 2;
                    $Desarrollador -> save();
                }

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Anteproyecto Cancelado Correctamente.'
            );
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }   



    ///////// ELIMINAR /////
       
   
    public function EliminarDesarrollador(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
            
            $usuario = Desarrolladores::where('FK_User_Codigo',$id)->first();
            
            $usuario -> delete();
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
   
    public function EliminarJurado(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
            $usuario = Jurados::where('FK_User_Codigo',$id)->first();
            $usuario -> delete();
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
    public function EliminarActividadMct(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
			Mctr008::destroy($id);
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
    public function mctdestroyLibro(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
			Mctr008::destroy($id);
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
   
    //------------FUNCIONES PARA CRUD DE USUARIOS ADMIN--------------------
	//Index para vista de Usuarios
	public function indexUsuarios(Request $request)
	{
		
			return view($this->path . 'Usuarios');
		
    }

    //Index con Ajax para usuarios
    public function indexAjaxUsuarios(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path .'UsuariosAjax');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
		);
    }

	//lista de usuarios
	/* public function usuariosList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

		   
		   $usuarios=Usuarios::query();
		   

		   return DataTables::of($usuarios)
			   ->removeColumn('created_at')
			   ->removeColumn('updated_at')
			    
			   ->addIndexColumn()
			   ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    } */

    //lista de usuarios con el metodo para traer los strings en vez de los id's de rol y estado
    public function usuariosList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

		   
           $usuarios=Usuarios::all();
           
           $i=0;
           $i2=0;

           foreach($usuarios as $user){
            $s[$i]=$usuarios[$i] -> relacionUsuariosEstado -> STD_Descripcion;
           
               $i=$i+1;
           }
           $j=0;
           foreach ($usuarios as $user) {
           
            $user->offsetSet('Estado', $s[$j]);
            $j=$j+1;
            }

            foreach($usuarios as $userRol){
                $s2[$i2]=$usuarios[$i2]-> relacionUsuariosRol-> Rol_Usuario;
               
                $i2=$i2+1;
            }
            $j2=0;
           foreach ($usuarios as $userRol) {
           
            $userRol->offsetSet('Rol', $s2[$j2]);
            $j2=$j2+1;
            }
          
            return DataTables::of($usuarios)
		  	   ->removeColumn('created_at')
			   ->removeColumn('updated_at')
			   ->addIndexColumn()
			   ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    
    //Muestra la lista de roles registrados para el select del registro de usuario.
    public function listarRoles(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $roles = RolesUsuario::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $roles
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    
    //Muestra la lista de estados registrados para el select del registro de usuario.
    public function listarEstados(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $estados = Estados::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $estados
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
        
	//Creacion de Usuario
	public function createUser(Request $request)
    {
		if ($request->ajax() && $request->isMethod('GET')) {
			$listaUsuarios = Usuarios::all();
          
				return view($this->path . 'CrearUsuario',
					['listaUsuarios' => $listaUsuarios,]
				);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
	}

	//Metodo de creacion de un usuario
	public function createUsuario(Request $request)
    {
		if ($request->ajax() && $request->isMethod('POST')) {
          /* vairables que resive
             formData.append('PK_User_Codigo', $('input:text[name="User_Cedula"]').val());
            formData.append('User_Codigo', $('input:text[name="User_Codigo"]').val());
            formData.append('User_Nombre1', $('input:text[name="User_Nombre1"]').val());
            formData.append('User_Apellido1', $('input:text[name="User_Apellido1"]').val());
            formData.append('User_Correo', $('input[name="User_Correo"]').val());
            formData.append('User_Contra', $('input:text[name="User_Cedula"]').val());
            formData.append('User_Direccion', $('input:text[name="User_Direccion"]').val());
            formData.append('FK_User_IdEstado', '2');
            formData.append('User_Tipo_Documento', $('select[name="User_Tipo_Documento"]').val());
            formData.append('User_Sexo', $('select[name="User_Sexo"]').val());
            formData.append('User_Nacimiento', $('#User_Nacimiento').val());
            formData.append('User_Fecha_Expedicion', $('#User_Fecha_Expedicion').val());
           */

           //validar Documento identidad           
           $vdocumento = Usuarios::where('PK_User_Codigo',$request['PK_User_Codigo'])->first(); 
           //validar correo
           $vcorreo = Usuarios::where('User_Correo',$request['User_Correo'])->first(); 
           //validar cod interno
           $vcodigo = Usuarios::where('User_Codigo',$request['User_Codigo'])->first();
           
           if($vdocumento != null){
            $IdError = 422;
            return AjaxResponse::success(
                '¡Error!',
                'El Documento de identidad ya se enuentra registrado.',
                $IdError
            );
           }
           if($vcorreo != null){
            $IdError = 422;
            return AjaxResponse::success(
                
                '¡Error!',
                'El Documento de identidad ya se enuentra registrado.',
                $IdError 
              ); 
           }
           if($vcodigo != null){
               $IdError = 422;
            return AjaxResponse::success( 
                '¡Error!',
                'El Documento de identidad ya se enuentra registrado.',
                $IdError
            ); 
           }
           
           $perfil=RolesUsuario::where('PK_Id_Rol_Usuario', $request['FK_User_IdRol'])->first();

           UsersUdec::create([

            'number_document' => $request['PK_User_Codigo'],
            'code' => $request['User_Codigo'],
            'username' => $request['User_Nombre1'],               
            'lastname' => $request['User_Apellido1'],
            'type_user'=>$perfil['Rol_Usuario'],
            'place'=>"Facatativá",
            'email' => $request['User_Correo'],
            
          ]);
          
          Usuarios::create([
            'PK_User_Codigo' => $request['PK_User_Codigo'],
            'User_Codigo' => $request['User_Codigo'],
            'User_Nombre1' => $request['User_Nombre1'],
            'User_Apellido1' => $request['User_Apellido1'],
            'User_Correo' => $request['User_Correo'],
            'User_Contra' => 132,
            'User_Direccion' => $request['User_Direccion'],
            'FK_User_IdEstado' => $request['FK_User_IdEstado'],
            'FK_User_IdRol' => $request['FK_User_IdRol'],
         ]);
         User::create([
            'name'=> $request['User_Nombre1'],
            'lastname'=>$request['User_Apellido1'],
            'birthday'=>$request['User_Nacimiento'],
            'identity_type'=>$request['User_Tipo_Documento'],
            'identity_no'=>$request['PK_User_Codigo'],
            'address'=>$request['User_Direccion'],
            'sexo'=>$request['User_Sexo'],
            'email'=>$request['User_Correo'],
            'password'=> 123,
            'state' => 'Aprobado',
         ]);



     //   Mail::to($request['User_Correo'])->send(new EmailGesap($request['User_Nombre1']));

        return AjaxResponse::success(
            '¡Bien hecho!',
            'Datos creados en Usuarios'
        );

        
        }
    
    }

     //funcion para actualizar los datos del usuario
     public function updateUsuario(Request $request)
     {
         if ($request->ajax() && $request->isMethod('POST')) {
             $usuario = Usuarios::where('PK_User_Codigo', $request['PK_User_Codigo'])->first();
            //  $usuario->fill([
            //     //'PK_User_Codigo' => $request['PK_User_Codigo'],
            //    // 'User_Cedula' => $request['User_Cedula'],
            //     'User_Nombre1' => $request['User_Nombre1'],
            //     //'User_Nombre2' => $request['User_Nombre2'],
            //     'User_Apellido1' => $request['User_Apellido1'],
            //     //'User_Apellido2' => $request['User_Apellido2'],
            //     'User_Correo' => $request['User_Correo'],
            //     //'User_Contra' => Crypt::encrypt($request['User_Cedula']),
            //     'User_Direccion' => $request['User_Direccion'],
            //     'FK_User_IdEstado' => $request['FK_User_IdEstado'],
            //     'FK_User_IdRol' => $request['FK_User_IdRol'],
            //  ]);
            $usuario -> User_Nombre1 = $request['User_Nombre1'];
            $usuario -> User_Apellido1 = $request['User_Apellido1'];
            $usuario -> User_Correo = $request['User_Correo'];
            $usuario -> User_Direccion = $request['User_Direccion'];
            $usuario -> FK_User_IdEstado = $request['FK_User_IdEstado'];
            $usuario -> FK_User_IdRol = $request['FK_User_IdRol'];
            $usuario->save();
 
             
             $documento=(string)$request['User_Cedula'];
             $perfil=RolesUsuario::where('PK_Id_Rol_Usuario', $request['FK_User_IdRol'])->first();
 
             $userudec=UsersUdec::find($documento)->first();
             $userudec->fill([
 
                'number_document' => $documento,
                'code' => $request['PK_User_Codigo'],
                'username' => $request['User_Nombre1'],               
                'lastname' => $request['User_Apellido1'],
                'type_user'=>$perfil['Rol_Usuario'],
                //'number_phone' => $request['CU_Telefono'],
                //'place'=>"Facatativá",
                'email' => $request['User_Correo'],
 
             ]);
 
             $userudec->save();
 
 
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

    //Enviar a la vista de Editar un usuario
    public function editarUser(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
           
            $infoUsuario = Usuarios::find($id);
                    
            return view($this->path . 'EditarUsuario',
                [
                    'infoUsuario' => $infoUsuario,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
    
	//Eliminar un usuario
	public function eliminarUser(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
			Usuarios::destroy($id);
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
    
}
