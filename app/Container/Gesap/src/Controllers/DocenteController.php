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
use App\Container\Gesap\src\Actividad;
use App\Container\Gesap\src\Radicacion;
use App\Container\Gesap\src\Encargados;
use App\Container\Gesap\src\Usuarios;
use App\Container\Gesap\src\Fechas;
use App\Container\Gesap\src\RolesUsuario;
use App\Container\Gesap\src\Desarrolladores;
use App\Container\Gesap\src\Estados;
use App\Container\Gesap\src\Resultados;

use App\Container\Gesap\src\RubroPersonal;
use App\Container\Gesap\src\RubroEquipos;
use App\Container\Gesap\src\RubroMaterial;
use App\Container\Gesap\src\RubroTecnologico;
use App\Container\Gesap\src\Cronograma;
use App\Container\Gesap\src\Jurados;
use App\Container\Gesap\src\Mctr008;

use App\Container\Gesap\src\PersonaMct;

use App\Container\Gesap\src\Financiacion;
use App\Container\Gesap\src\ObservacionesMct;

use App\Container\Gesap\src\ObservacionesMctJurado;
use App\Container\Gesap\src\Commits;
use App\Container\Users\src\User;
use App\Container\Gesap\src\EstadoAnteproyecto;
use App\Container\Users\src\UsersUdec;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

use App\Container\Users\src\Controllers\UsersUdecController;



class DocenteController extends Controller
{
    private $path = 'gesap.Docente.';

    public function index(Request $request)
	{
		
			return view($this->path . 'IndexDocente');
		
    }
    public function AnteproyectoList(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

           $anteproyecto=Anteproyecto::where('FK_NPRY_Pre_Director', $id) -> get();
           $anteproyecto = Anteproyecto::where('FK_NPRY_Pre_Director', $id)->where('FK_NPRY_Estado','!=',4)->get();
              
           
           $i=0;
           $i2=0;

           foreach($anteproyecto as $ante){
            $s[$i]=$anteproyecto[$i] -> relacionEstado -> EST_estado;
           
               $i=$i+1;
           }
           $j=0;
           foreach ($anteproyecto as $ante) {
           
            $ante->offsetSet('Estado', $s[$j]);
            $j=$j+1;
            }

            foreach($anteproyecto as $antep){
                $s2[$i2]=$anteproyecto[$i2]-> relacionPredirectores-> User_Nombre1;
               
                $i2=$i2+1;
            }
            $j2=0;
           foreach ($anteproyecto as $antep) {
           
            $antep->offsetSet('Nombre', $s2[$j2]);
            $j2=$j2+1;
            }
          
               return DataTables::of($anteproyecto)
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

    public function AnteproyectoListJurado(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

           $jurado = Jurados::where('FK_User_Codigo',$id)->get(); 
           $i=0;
           $concatenado=[];
           foreach($jurado as $jur){

                $ante = $jur -> FK_NPRY_IdMctr008;
                $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008', $ante)->first();
                $collection = collect([]);
                $collection->put('Codigo',$anteproyecto-> PK_NPRY_IdMctr008);
                $collection->put('Titulo',$anteproyecto-> NPRY_Titulo);
                $collection->put('Descripcion',$anteproyecto-> NPRY_Descripcion);
                $collection->put('Duracion',$anteproyecto-> NPRY_Duracion);
                $collection->put('Fecha_Radicacion',$anteproyecto-> NPRY_FCH_Radicacion);
                $director = Usuarios::where('PK_user_Codigo', $anteproyecto-> FK_NPRY_Pre_Director)->first();
                $nombred = $director -> User_Nombre1;
                $apellidod = $director -> User_Apellido1;
                $space = " ";
                $NombreDirector = $nombred.$space.$apellidod;
                $collection->put('Director',$NombreDirector);
              //  $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$ante)->get();

                $concatenado[$i]= $collection;

                $i=$i+1;
           }
          
               return DataTables::of($concatenado)
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

    public function ProyectosListRadicados(Request $request, $id)
    {
        if ($request->isMethod('GET')) {

           $jurado = Jurados::where('FK_User_Codigo',$id)->get(); 
           $i=0;
           $concatenado=[];
           foreach($jurado as $jur){

                $ante = $jur -> FK_NPRY_IdMctr008;
                $proyecto = Proyecto::where('FK_NPRY_IdMctr008', $ante)->first();
                if( $proyecto == null){
                    $concatenado=[];
                }else{

                $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008', $proyecto-> FK_NPRY_IdMctr008)->first();
                
                $collection = collect([]);
                $collection->put('Codigo',$anteproyecto-> PK_NPRY_IdMctr008);
                $collection->put('Titulo',$anteproyecto-> NPRY_Titulo);
                $collection->put('Descripcion',$anteproyecto-> NPRY_Descripcion);
                $collection->put('Duracion',$anteproyecto-> NPRY_Duracion);
                $collection->put('Fecha_Radicacion',$anteproyecto-> NPRY_FCH_Radicacion);
                $director = Usuarios::where('PK_user_Codigo', $anteproyecto-> FK_NPRY_Pre_Director)->first();
                $nombred = $director -> User_Nombre1;
                $apellidod = $director -> User_Apellido1;
                $space = " ";
                $NombreDirector = $nombred.$space.$apellidod;
                $collection->put('Director',$NombreDirector);
                  //  $desarrolladores = Desarrolladores::where('FK_NPRY_IdMctr008',$ante)->get();
    
                $concatenado[$i]= $collection;
    
                $i=$i+1;
                }
        }
          
               return DataTables::of($concatenado)
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
    
    

    public function VerActividadesProyecto(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Anteproyecto = $id;

            return view($this->path .'.Proyecto.Director.VerActividadesProyectoDirector',
            [
                'Anteproyecto' => $Anteproyecto,
            ]);
           
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );  
             
        }              
    }

    public function VerActividadesProyectoJurado(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Anteproyecto = $id;

            return view($this->path .'.Proyecto.Jurado.VerActividadesProyectoJurado',
            [
                'Anteproyecto' => $Anteproyecto,
            ]);
           
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );  
             
        }              
    }
    public function VerActividadProyecto(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',3)->get();
                    
            $Actividad->offsetSet('Anteproyecto', $idp);

            $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
            $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
            if($commit2 == null)
            {
                $Actividad->offsetSet('Commit', "Aún NO se ha SUBIDO ningún Archivo a la actividad del Libro.");
                $Actividad->offsetSet('Estado', "Sin Enviar Para Calificar.");
                
            }else{
                $Actividad->offsetSet('Estado', $commit[0] -> relacionEstado -> CHK_Checlist);
                $Actividad->offsetSet('Commit', $commit[0] -> CMMT_Commit);

            }
        
               return view($this->path .'.Proyecto.Director.VerActividadProyecto',
                [
                'datos' => $Actividad,
                ]);
            
               
                 
            }     
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
        
    }
    public function VerActividadProyectoJurado(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',3)->get();
                    
            $Actividad->offsetSet('Anteproyecto', $idp);

            $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
            $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
            if($commit2 == null)
            {
                $Actividad->offsetSet('Commit', "Aún NO se ha SUBIDO ningún Archivo a la actividad del Libro.");
                $Actividad->offsetSet('Estado', "Sin Enviar Para Calificar.");
                
            }else{
                $Actividad->offsetSet('Estado', $commit[0] -> relacionEstado -> CHK_Checlist);
                $Actividad->offsetSet('Commit', $commit[0] -> CMMT_Commit);

            }
        
               return view($this->path .'.Proyecto.Jurado.VerActividadProyectoJurado',
                [
                'datos' => $Actividad,
                ]);
            
               
                 
            }     
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
        
    }
    public function VerActividadesListProyectoDirector(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

               $Actividades=Mctr008::where('FK_Id_Formato',3)->get();
               $numero = 1 ;
               foreach($Actividades as $Actividad){
                   $Actividad->offsetSet('Numero', $numero);
                   $numero = $numero +1 ;
               }
                  
        
               return DataTables::of($Actividades)
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
    
    public function ProyectosList(Request $request, $id)
    {
        if ( $request->isMethod('GET')) {

            $proyectos=Proyecto::all();
            $i=0;
            $concatenado=[];
            foreach($proyectos as $proyecto){
                
                $proyectodirector = Anteproyecto::where('PK_NPRY_IdMctr008',$proyecto->FK_NPRY_IdMctr008)->where('FK_NPRY_Pre_Director',$id)->first();
                if($proyectodirector==null){
                    $collection = collect([]);
                }else{
                    $collection = collect([]);

                    $collection->put('Codigo',$proyectodirector-> PK_NPRY_IdMctr008);
                    
                    $collection->put('Titulo',$proyectodirector-> NPRY_Titulo);
                       
                    $collection->put('Descripcion',$proyectodirector-> NPRY_Descripcion);
                    $collection->put('Duracion',$proyectodirector->  NPRY_Duracion);
                    $collection->put('Fecha_Radicacion',$proyectodirector->  NPRY_FCH_Radicacion);
                    $collection->put('Director',$proyectodirector -> relacionPredirectores -> User_Nombre1 );
                    $collection->put('Estado',$proyecto->relacionEstado->EST_estado );
                          
          
                           
                    $concatenado[$i]= $collection;
                    $i=$i+1;
    
                }
                
            }

               return DataTables::of($concatenado)
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
 
                $desarrollo->offsetSet('Codigo',$id_user[$s]);

                $desarrollo->offsetSet('Nombre',$nombre[$s]);
                
                $desarrollo->offsetSet('Apellido',$Apellido[$s]);             

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
            
          
            $estado = $infoAnteproyecto -> relacionEstado -> EST_estado;

            $Nombre = $infoAnteproyecto -> relacionPredirectores-> User_Nombre1;
            
            $Apellido = $infoAnteproyecto -> relacionPredirectores-> User_Apellido1;

            $infoAnte->put('Estado',$estado);
            
            $infoAnte->put('Nombre',$Nombre);
            
            $infoAnte->put('Apellido',$Apellido);

            $datos = $infoAnte;

            

                return view ($this->path .'VerAnteproyectoDocente',
                [
                   
                    'datos' => $datos,
                ]);

                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }
    public function VerAnteproyectoJurado(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $infoAnte = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->get();
            $infoAnteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            
          
            $estado = $infoAnteproyecto -> relacionEstado -> EST_estado;

            $Nombre = $infoAnteproyecto -> relacionPredirectores-> User_Nombre1;
            
            $Apellido = $infoAnteproyecto -> relacionPredirectores-> User_Apellido1;

            $infoAnte->put('Estado',$estado);
            
            $infoAnte->put('Nombre',$Nombre);
            
            $infoAnte->put('Apellido',$Apellido);

            $datos = $infoAnte;

            

                return view ($this->path .'.Jurado.VerAnteproyectoJurado',
                [
                   
                    'datos' => $datos,
                ]);

                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
        }
    }

    public function Asignar(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $anteproyecto = Anteproyecto::Where('PK_NPRY_IdMctr008', $id)->first();
            
            $anteproyecto -> FK_NPRY_Estado = 2;
            
            $anteproyecto -> save();

            $infoAnte = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->get();
            $infoAnteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            
          
            $estado = $infoAnteproyecto -> relacionEstado -> EST_estado;

            $Nombre = $infoAnteproyecto -> relacionPredirectores-> User_Nombre1;
            
            $Apellido = $infoAnteproyecto -> relacionPredirectores-> User_Apellido1;

            $infoAnte->put('Estado',$estado);
            
            $infoAnte->put('Nombre',$Nombre);
            
            $infoAnte->put('Apellido',$Apellido);

            $datos = $infoAnte;




            return AjaxResponse::Success(
                '¡Esta Hecho!',
                'Proyecto Asignado.'
            );
        }
        

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    public function VerActividadesList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

               $Actividades=Mctr008::where('FK_Id_Formato',1)->get();
               $numero = 1 ;
               foreach($Actividades as $Actividad){
                   $Actividad->offsetSet('Numero', $numero);
                   $numero = $numero +1 ;
               }
                  
        
               return DataTables::of($Actividades)
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
    public function ComentarioStore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
                     ObservacionesMct::create([
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                     'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                     'FK_User_Codigo' => $request['FK_User_Codigo'],
                     'OBS_observacion' => $request['OBS_observacion'],
                     'OBS_Limit' => $request['OBS_Limit']

                    ]);
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Comentario Hecho.'
                );
       
            }              
        
    }
    public function ComentarioStoreJurado(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
                     ObservacionesMctJurado::create([
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                     'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                     'FK_User_Codigo' => $request['FK_User_Codigo'],
                     'OBS_observacion' => $request['OBS_observacion'],
                     'OBS_Formato' => $request['OBS_Formato'],
                     

                    ]);
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Comentario Hecho.'
                );
       
            }   
                       
        
    }
    public function DesicionJurados(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $desicion = Jurados::where('FK_NPRY_IdMctr008',$id)->get();

            foreach($desicion as $des){
               
                $Nombre1 = $des -> relacionUsuarios -> User_Nombre1;
                $Apellido = $des -> relacionUsuarios -> User_Apellido1;
                $space = " ";
                $Nombre = $Nombre1.$space.$Apellido;
                $Estado = $des -> relacionEstado -> EST_estado;

                $des-> offsetSet('Jurado',$Nombre);
                $des-> offsetSet('Estado',$Estado);

            }
                     
            return DataTables::of($desicion)
           
            ->addIndexColumn()
            ->make(true);
       
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );              
        
    }
    public function DesicionJuradosProyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $desicion = Jurados::where('FK_NPRY_IdMctr008',$id)->get();

            foreach($desicion as $des){
               
                $Nombre1 = $des -> relacionUsuarios -> User_Nombre1;
                $Apellido = $des -> relacionUsuarios -> User_Apellido1;
                $space = " ";
                $Nombre = $Nombre1.$space.$Apellido;
                $Estado = $des -> relacionEstadoJurado -> EST_estado;

                $des-> offsetSet('Jurado',$Nombre);
                $des-> offsetSet('Estado',$Estado);

            }
                     
            return DataTables::of($desicion)
           
            ->addIndexColumn()
            ->make(true);
       
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );              
        
    }
    public function listarEstadoJurado(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $Estado = EstadoAnteproyecto::Where('PK_EST_Id','>','3  ')->get();
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
   
    public function CambiarEstadoJurado(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $Jurado = Jurados::where('FK_User_Codigo',$request['FK_User_Codigo'])->first();

            $Jurado -> FK_NPRY_Estado = $request['FK_NPRY_Estado'];
            $Jurado ->  JR_Comentario =  $request['JR_Comentario'];
            
            $Jurado -> save();
            $Jurado = Jurados::where('FK_NPRY_IdMctr008',$request['PK_NPRY_Id_Mctr008'])->get();
            $i = 0;
            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$request['PK_NPRY_Id_Mctr008'])->first();
            $if= $Jurado->count();
            if($if==2){
                foreach($Jurado as $jur)
                {
                 $numero[$i] = $jur -> FK_NPRY_Estado;
                 $i = $i + 1 ;   
                }
                $i = 0 ;
                $suma = $numero[0]+$numero[1];
                if(($suma/8)==1){
                    $anteproyecto -> FK_NPRY_Estado = 4;
                    $anteproyecto -> save();
                    //aprovado
                    Proyecto::create([
                        'FK_EST_Id' => 2 , 
                        'FK_NPRY_IdMctr008' => $request['PK_NPRY_Id_Mctr008']
                    ]);
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );
                }
                if(($suma/10)==1){
                    $anteproyecto -> FK_NPRY_Estado = 5;
                    //rechazado
                    $anteproyecto -> save();
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );
                }
                if(($suma/12)==1){
                    $anteproyecto -> FK_NPRY_Estado = 6;
                    //aplazado
                    $anteproyecto -> save();
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );
                }else{
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );
                }
                

            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    public function CambiarEstadoJuradoproyecto(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //variable de sesion

            $Jurado = Jurados::where('FK_User_Codigo',$request['FK_User_Codigo'])->first();

            $Jurado -> FK_NPRY_Estado_Proyecto = $request['FK_NPRY_Estado'];
            $Jurado ->  JR_Comentario_Proyecto =  $request['JR_Comentario_Proyecto'];
            
            $Jurado -> save();
            $Jurado = Jurados::where('FK_NPRY_IdMctr008',$request['PK_NPRY_Id_Mctr008'])->get();
            $i = 0;
            $Proyecto = Proyecto::where('FK_NPRY_IdMctr008',$request['PK_NPRY_Id_Mctr008'])->first();
            $if= $Jurado->count();
            if($if==2){
                foreach($Jurado as $jur)
                {
                 $numero[$i] = $jur -> FK_NPRY_Estado_Proyecto;
                 $i = $i + 1 ;   
                }
                $i = 0 ;
                $suma = $numero[0]+$numero[1];
                if(($suma/8)==1){
                    $Proyecto -> FK_EST_Id = 4;
                    $Proyecto -> save();
                    //aprobado
                    
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );
                }
                if(($suma/10)==1){
                    $Proyecto -> FK_EST_Id = 5;
                    //rechazado
                    $Proyecto -> save();
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );
                }
                if(($suma/12)==1){
                    $Proyecto -> FK_EST_Id = 6;
                    //aplazado
                    $Proyecto -> save();
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );
                }else{
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos modificados correctamente.'
                    );
                }
                

            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    
    public function ComentariosJu(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $ObservacionesJurado = ObservacionesMctJurado::where('FK_NPRY_IdMctr008',$id)->where('OBS_Formato',1)->get();

            foreach($ObservacionesJurado as $observacion){
               
                $Nombre1 = $observacion -> relacionUsuario -> User_Nombre1;
                $Apellido = $observacion -> relacionUsuario -> User_Apellido1;
                $space = " ";
                $Nombre = $Nombre1.$space.$Apellido;

                $Actividad = $observacion -> relacionActividad -> MCT_Actividad;
                $tipo = $observacion -> relacionActividad;
                $formato = $tipo -> relacionFormato -> MCT_Formato;
                $linea="-";

                $nombreActividad = $Actividad.$linea.$formato;
                $observacion -> offsetSet('Nombre',$Nombre);
                $observacion -> offsetSet('Actividad',$nombreActividad);

            }
                     
            return DataTables::of($ObservacionesJurado)
           
            ->addIndexColumn()
            ->make(true);
       
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );              
        
    }
    public function ComentariosJuProyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $ObservacionesJurado = ObservacionesMctJurado::where('FK_NPRY_IdMctr008',$id)->where('OBS_Formato',2)->get();

            foreach($ObservacionesJurado as $observacion){
               
                $Nombre1 = $observacion -> relacionUsuario -> User_Nombre1;
                $Apellido = $observacion -> relacionUsuario -> User_Apellido1;
                $space = " ";
                $Nombre = $Nombre1.$space.$Apellido;

                $Actividad = $observacion -> relacionActividad -> MCT_Actividad;
                $tipo = $observacion -> relacionActividad;
                $formato = $tipo -> relacionFormato -> MCT_Formato;
                $linea="-";

                $nombreActividad = $Actividad.$linea.$formato;
                $observacion -> offsetSet('Nombre',$Nombre);
                $observacion -> offsetSet('Actividad',$nombreActividad);

            }
                     
            return DataTables::of($ObservacionesJurado)
           
            ->addIndexColumn()
            ->make(true);
       
            }
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );              
        
    }
    
    public function CalificarJurado(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id )->first();
            $Nombre1 = $Anteproyecto -> relacionPredirectores -> User_Nombre1;
            $Apellido = $Anteproyecto -> relacionPredirectores -> User_Apellido1;
            $space = " ";
            $Nombre = $Nombre1.$space.$Apellido;
            
            $Anteproyecto -> offsetSet('Director', $Nombre);
            $Estado = $Anteproyecto -> relacionEstado -> EST_estado;
            $Anteproyecto -> offsetSet('Estado', $Estado);

                
            return view ($this->path .'CalificarAnteproyecto',
            [
               
                'datos' => $Anteproyecto,
            ]);
    

                  
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Comentario Hecho.'
                );
       
            }              
        
    }

    public function CalificarProyectoJurado(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id )->first();
            $Nombre1 = $Anteproyecto -> relacionPredirectores -> User_Nombre1;
            $Apellido = $Anteproyecto -> relacionPredirectores -> User_Apellido1;
            $space = " ";
            $Nombre = $Nombre1.$space.$Apellido;
            
            $Anteproyecto -> offsetSet('Director', $Nombre);
            $proyecto = proyecto::where('FK_NPRY_IdMctr008',$id )->first();
            $Estado = $proyecto -> relacionestado -> EST_estado ;
            $Anteproyecto -> offsetSet('Estado', $Estado);

                
            return view ($this->path .'.Proyecto.Jurado.CalificarProyecto',
            [
               
                'datos' => $Anteproyecto,
            ]);
    

                  
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Comentario Hecho.'
                );
       
            }              
        
    }
    public function Avalar(Request $request, $id,$idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {	
            
        $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
        $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$idp)->first();
        $limit = $anteproyecto  -> NPRY_FCH_Radicacion;
      
        if($limit >= now()->toDateString()){
            $commit -> FK_CHK_Checklist = 2;
                
            $commit -> save();
            
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Actividad Avalada.'
                );
        }else{
           
            $IdError = 422;
            return AjaxResponse::success(
                '¡Lo sentimos!',
                'La fecha de Radicación ya expiro.',
                $IdError
            );
          
        }
        }
       

    }

    public function Comentarios(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                      
                $Comentario = ObservacionesMct::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
               $Comentario_2 = ObservacionesMct::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
                $i=0;
                foreach($Comentario as $coment){
                    $usuarioN = $coment -> relacionUsuario;
                    $Nombre = $usuarioN -> User_Nombre1;
                    $Apellido = $usuarioN -> User_Apellido1;
                    $space = " ";
                    $Nombretotal = $Nombre.$space.$Apellido;
                    $s[$i] = $Nombretotal;
                    $i = $i+1;
                }
                $j=0;
                foreach($Comentario as $comen){
                    $comen->offsetSet('Usuario', $s[$j]);
                    $j=$j+1;
                }
                

                return DataTables::of($Comentario)
                ->removeColumn('created_at')
                ->addIndexColumn()
                ->make(true);
               
        }
   
    }
    public function Cronograma(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

                $Cronograma = Cronograma::where('FK_NPRY_IdMctr008', $id)->get();
                foreach($Cronograma as $Crono){
                    $inicio = $Crono-> MCT_CRN_Semana_inicio ;
                    $fin = $Crono-> MCT_CRN_Semana_fin ;
                    $tab = '-';
                    $fecha =  $inicio.$tab.$fin;
                    $Crono ->offsetSet('Semana',$fecha);

                }

                return DataTables::of($Cronograma)
               ->removeColumn('created_at')
               ->removeColumn('updated_at')
                
               ->addIndexColumn()
               ->make(true);
        }
    }
    public function ComentariosJurado(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                      
                $Comentario = ObservacionesMctJurado::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
               $Comentario_2 = ObservacionesMctJurado::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
                $i=0;
                foreach($Comentario as $coment){
                    $usuarioN = $coment -> relacionUsuario;
                    $Nombre = $usuarioN -> User_Nombre1;
                    $Apellido = $usuarioN -> User_Apellido1;
                    $space = " ";
                    $Nombretotal = $Nombre.$space.$Apellido;
                    $s[$i] = $Nombretotal;
                    $i = $i+1;
                }
                $j=0;
                foreach($Comentario as $comen){
                    $comen->offsetSet('Usuario', $s[$j]);
                    $j=$j+1;
                }
                

                return DataTables::of($Comentario)
                ->removeColumn('created_at')
                ->addIndexColumn()
                ->make(true);
               
        }
   
    }
    public function VerActividades(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
                $Anteproyecto = $id;

                return view($this->path .'ActividadesDocente',
                [
                    'Anteproyecto' => $Anteproyecto,
                ]);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }

    public function VerActividadesJurado(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
                $Anteproyecto = $id;

                return view($this->path .'.Jurado.ActividadesJurado',
                [
                    'Anteproyecto' => $Anteproyecto,
                ]);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }
    public function VerRequerimientosDocente(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
                $Anteproyecto = $id;

                return view($this->path .'RequerimientosDocente',
                [
                    'Anteproyecto' => $Anteproyecto,
                ]);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }
    public function VerRequerimientosJurado(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
                $Anteproyecto = $id;

                return view($this->path .'.Jurado.RequerimientosJurado',
                [
                    'Anteproyecto' => $Anteproyecto,
                ]);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }
    public function VerRequerimientosList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

               $Actividades=Mctr008::where('FK_Id_Formato',2)->get();
               $numero = 1 ;
               foreach($Actividades as $Actividad){
                   $Actividad->offsetSet('Numero', $numero);
                   $numero = $numero +1 ;
               }
                  
        
               return DataTables::of($Actividades)
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

    public function CalificarAnteproyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
      
                 
            }     
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
        
    }
    public function Resultados(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

                $resultado = Resultados::where('FK_NPRY_IdMctr008', $id)->get();

                return DataTables::of($resultado)
               ->removeColumn('created_at')
			   ->removeColumn('updated_at')
			    
			   ->addIndexColumn()
               ->make(true);
        }
    }
    public function Financiacion(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

                $Financiacion = Financiacion::where('FK_NPRY_IdMctr008', $id)->get();

                return DataTables::of($Financiacion)
               ->removeColumn('created_at')
			   ->removeColumn('updated_at')
			    
			   ->addIndexColumn()
               ->make(true);
        }
    }
    public function DetallesPersona(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

                $DPersona = PersonaMct::where('FK_NPRY_IdMctr008', $id)->get();

                return DataTables::of($DPersona)
               ->removeColumn('created_at')
			   ->removeColumn('updated_at')
			    
			   ->addIndexColumn()
               ->make(true);
        }
    }
    public function Funcion(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

                $Funciones = Funciones::where('FK_NPRY_IdMctr008', $id)->get();
                return DataTables::of($Funciones)
               ->removeColumn('created_at')
               ->removeColumn('updated_at')
                
               ->addIndexColumn()
               ->make(true);
        }
    }
    public function VerRequerimientos(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',2)->get();
                    
            $Actividad->offsetSet('Anteproyecto', $idp);

            $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
            $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
            if($commit2 == null)
            {
                $Actividad->offsetSet('Commit', "Aún NO se ha hecho ningún cambio a este Requerimiento.");
                $Actividad->offsetSet('Estado', "Sin Enviar Para Calificar.");
                
            }else{
                $Actividad->offsetSet('Estado', $commit[0] -> relacionEstado -> CHK_Checlist);
                $Actividad->offsetSet('Commit', $commit[0] -> CMMT_Commit);

            }
            $act = Mctr008::where('PK_MCT_IdMctr008',$id)->first();
            if($act->MCT_Actividad == "Funciones"){
                return view($this->path .'VerRequerimientoFunciones',
                [
                'datos' => $Actividad,
                ]);   
                 
            }     
            return view($this->path .'VerRequerimiento',
            [
            'datos' => $Actividad,
            ]);
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
        
    }
    
}
public function RequerimientosJurado(Request $request, $id, $idp)
{
    if ($request->ajax() && $request->isMethod('GET')) {

        $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',2)->get();
                
        $Actividad->offsetSet('Anteproyecto', $idp);

        $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
        $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
        if($commit2 == null)
        {
            $Actividad->offsetSet('Commit', "Aún NO se ha hecho ningún cambio a este Requerimiento.");
            $Actividad->offsetSet('Estado', "Sin Enviar Para Calificar.");
            
        }else{
            $Actividad->offsetSet('Estado', $commit[0] -> relacionEstado -> CHK_Checlist);
            $Actividad->offsetSet('Commit', $commit[0] -> CMMT_Commit);

        }
        $act = Mctr008::where('PK_MCT_IdMctr008',$id)->first();
        if($act->MCT_Actividad == "Funciones"){
            return view($this->path .'.Jurado.VerRequerimientoFuncionesJurado',
            [
            'datos' => $Actividad,
            ]);   
             
        }     
        return view($this->path .'.Jurado.VerRequerimientoJurado',
        [
        'datos' => $Actividad,
        ]);
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );         
    
}

}
    public function VerActividad(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',1)->get();
                    
            $Actividad->offsetSet('Anteproyecto', $idp);

            $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
            $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
            if($commit2 == null)
            {
                $Actividad->offsetSet('Commit', "Aún NO se ha hecho ningún cambio a esta actividad del MCT.");
                $Actividad->offsetSet('Estado', "Sin Enviar Para Calificar.");
                
            }else{
                $Actividad->offsetSet('Estado', $commit[0] -> relacionEstado -> CHK_Checlist);
                $Actividad->offsetSet('Commit', $commit[0] -> CMMT_Commit);

            }
            $act = Mctr008::where('PK_MCT_IdMctr008',$id)->first();
            if($act->MCT_Actividad == "Cronograma"){
                return view($this->path .'.Director.ActividadCronograma',
                [
                'datos' => $Actividad,
                ]);

            
            }if($act->MCT_Actividad == "Detalles de personas"){
                return view($this->path .'.Director.ActividadDetalles',
                [
                'datos' => $Actividad,
                ]);

            }if($act->MCT_Actividad == "Financiacion"){
                return view($this->path .'.Director.ActividadFinanciacion',
                [
                'datos' => $Actividad,
                ]);

            
            }if($act->MCT_Actividad == "Resultados"){
                return view($this->path .'.Director.ActividadResultados',
                [
                'datos' => $Actividad,
                ]);

            }
            if($act->MCT_Actividad == "Resumen De Rubros"){
                return view($this->path .'.Director.ActividadRubros',
                [
                'datos' => $Actividad,
                ]);

            }
               return view($this->path .'.Director.VerActividadDocente',
                [
                'datos' => $Actividad,
                ]);
            
               
                 
            }     
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
        
    }
    public function RubroTecnologico(Request $request,$id)
               {
                   if ($request->ajax() && $request->isMethod('GET')) {
           
                           $RubroTecnologico = RubroTecnologico::where('FK_NPRY_IdMctr008', $id)->get();
                          
                           return DataTables::of($RubroTecnologico)
                          ->removeColumn('created_at')
                          ->removeColumn('updated_at')
                           
                          ->addIndexColumn()
                          ->make(true);
                   }
               }

    public function RubroMaterial(Request $request,$id)
               {
                   if ($request->ajax() && $request->isMethod('GET')) {
           
                           $RubroMaterial = RubroMaterial::where('FK_NPRY_IdMctr008', $id)->get();
                          
                           return DataTables::of($RubroMaterial)
                          ->removeColumn('created_at')
                          ->removeColumn('updated_at')
                           
                          ->addIndexColumn()
                          ->make(true);
                   }
               }

 public function RubroEquipos(Request $request,$id)
               {
                   if ($request->ajax() && $request->isMethod('GET')) {
           
                           $RubroEquipos = RubroEquipos::where('FK_NPRY_IdMctr008', $id)->get();
                          
                           return DataTables::of($RubroEquipos)
                          ->removeColumn('created_at')
                          ->removeColumn('updated_at')
                           
                          ->addIndexColumn()
                          ->make(true);
                   }
               }	

   public function RubroPersonal(Request $request,$id)
               {
                   if ($request->ajax() && $request->isMethod('GET')) {
           
                           $RubroPersonal = RubroPersonal::where('FK_NPRY_IdMctr008', $id)->get();
                          
                           return DataTables::of($RubroPersonal)
                          ->removeColumn('created_at')
                          ->removeColumn('updated_at')
                           
                          ->addIndexColumn()
                          ->make(true);
                   }
               }
  
    public function VerActividadJurado(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',1)->get();
                    
            $Actividad->offsetSet('Anteproyecto', $idp);

            $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
            $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
            if($commit2 == null)
            {
                $Actividad->offsetSet('Commit', "Aún NO se ha hecho ningún cambio a esta actividad del MCT.");
                $Actividad->offsetSet('Estado', "Sin Enviar Para Calificar.");
                
            }else{
                $Actividad->offsetSet('Estado', $commit[0] -> relacionEstado -> CHK_Checlist);
                $Actividad->offsetSet('Commit', $commit[0] -> CMMT_Commit);

            }
            $act = Mctr008::where('PK_MCT_IdMctr008',$id)->first();
            if($act->MCT_Actividad == "Cronograma"){
                return view($this->path .'.Jurado.ActividadCronogramaJurado',
                [
                'datos' => $Actividad,
                ]);

            
            }if($act->MCT_Actividad == "Detalles de personas"){
                return view($this->path .'.Jurado.ActividadDetallesJurado',
                [
                'datos' => $Actividad,
                ]);

            }if($act->MCT_Actividad == "Financiacion"){
                return view($this->path .'.Jurado.ActividadFinanciacionJurado',
                [
                'datos' => $Actividad,
                ]);

            
            }if($act->MCT_Actividad == "Resultados"){
                return view($this->path .'.Jurado.ActividadResultadosJurado',
                [
                'datos' => $Actividad,
                ]);

            }
            if($act->MCT_Actividad == "Resumen De Rubros"){
                return view($this->path .'.Jurado.ActividadRubrosJurado',
                [
                'datos' => $Actividad,
                ]);

            }
               return view($this->path .'.Jurado.VerActividadJurado',
                [
                'datos' => $Actividad,
                ]);
            
               
                 
            }     
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
       
    }

}
