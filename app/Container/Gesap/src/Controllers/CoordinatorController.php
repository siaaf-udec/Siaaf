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
use App\Container\Gesap\src\Mctr008;
use App\Container\Users\src\User;
use App\Container\Gesap\src\EstadoAnteproyecto;
use App\Container\Users\src\UsersUdec;

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

    ///// LISTADOS /////
	public function anteproyectoList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

		   
           $anteproyecto=Anteproyecto::all();
           
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

    public function listfechas(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $fechas = Fechas::all();
            if(($fechas->isempty())==true){
                $concatenado=[];
            }else{
            $i=0;
            $concatenado=[];
              
            $ultimo = $fechas ->last();     
                  
                    
            $collection = collect([]);

            $collection->put('FCH_Radicacion_principal',$ultimo-> FCH_Radicacion_principal);
                     
            $collection->put('FCH_Radicacion_secundaria',$ultimo-> FCH_Radicacion_secundaria);

            $concatenado[$i]= $collection;
        
            } 
  
            return DataTables::of($concatenado)
                
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
            $Actividades = Mctr008::all();

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
            
            $pro = Usuarios::where('FK_User_IdRol',1)->where('FK_User_IdEstado',1)->get();
            $i=0;
            $concatenado=[];
              foreach($usuarios as $user){
      
                   $desarrollador= Desarrolladores::where('FK_User_Codigo',  $user->PK_User_Codigo)->first();
                       
                 
                   if(is_null($desarrollador)){
                    $collection = collect([]);
                    $collection->put('Codigo',$user-> PK_User_Codigo);
                    
                    $collection->put('Cedula',$user-> User_Cedula);
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
               
            ]);
            
			return AjaxResponse::success(
				'¡Esta Hecho!',
				'Desarrollador Asignado Al Anteproyecto.'
            );
        }
        }
    }
    
	public function store(Request $request)
    {
	
        if ($request->ajax() && $request->isMethod('POST')) {	
            
            $fechas = Fechas::all();
            if(($fechas->isempty())==true){
                $concatenado=[];
                $fecha = 'null';
            }else{
                $ultimo = $fechas ->last(); 
                $fecha = $ultimo-> FCH_Radicacion_principal;
            }
            if($fecha == 'null'){
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud, no hay fechas disponibles de radicación.',
                    $IdError
                );
            }else{
			Anteproyecto::create([
			 'NPRY_Titulo' => $request['NPRY_Titulo'],
			 'NPRY_Keywords' => $request['NPRY_Keywords'],
			 'NPRY_Descripcion' => $request['NPRY_Descripcion'],
			 'NPRY_Duracion' => $request['NPRY_Duracion'],
			 'FK_NPRY_Pre_Director' => $request['FK_NPRY_Pre_Director'],
             'FK_NPRY_Estado' => $request['FK_NPRY_Estado'],
             'NPRY_FCH_Radicacion' => $fecha,
            ]);
            return AjaxResponse::success(
				'¡Esta Hecho!',
				'Datos Creados.'
			);
            }
        }
	
			
        
    }
    public function storefechas(Request $request)
    {
		if ($request->ajax() && $request->isMethod('POST')) {	
        
	
			Fechas::create([
             'FCH_Radicacion_principal' => $request['FCH_Radicacion_principal'],
             'FCH_Radicacion_secundaria' => $request['FCH_Radicacion_secundaria']
               
			]);
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

            $estado = $datos-> relacionEstado-> EST_estado;

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



    ///////// ELIMINAR /////
       
    public function EliminarDesarrollador(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
			Desarrolladores::destroy($id);
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
    public function EliminarAnte(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
			Anteproyecto::destroy($id);
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
            $documento=(string)$request['User_Cedula'];

            if($request['PK_User_Codigo']==null){
                $request['PK_User_Codigo']=$request['User_Cedula'];

           }

            $verificiaruser = Usuarios::find($request['PK_User_Codigo']); //validar codigo repetido en usuarios gesap
            $verificiarusercedula = Usuarios::where('User_Cedula','=',$request['User_Cedula'])->first();//validar cedula en usuarios gesap
            $verificarUserUdec= UsersUdec::find($documento);//validar cedula en user_udec
            $verificarCorreo = Usuarios::where('User_Correo', '=', $request['User_Correo'])->first(); //validar correo en la tabla usaurios gesap
          
            if (is_null($verificiarusercedula) && empty($verificiaruser) && empty($verificarCorreo)){

                if (is_null($verificarUserUdec) ) {

                    $perfil=RolesUsuario::where('PK_Id_Rol_Usuario', $request['FK_User_IdRol'])->first();

                        UsersUdec::create([

                            'number_document' => $documento,
                            'code' => $request['PK_User_Codigo'],
                            'username' => $request['User_Nombre1'],               
                            'lastname' => $request['User_Apellido1'],
                            'type_user'=>$perfil['Rol_Usuario'],
                            //'number_phone' => $request['CU_Telefono'],
                            'place'=>"Facatativá",
                            'email' => $request['User_Correo'],
                            
                        ]);

                    }

                    if(empty($verificiaruser)){

                        Usuarios::create([
                            'PK_User_Codigo' => $request['PK_User_Codigo'],
                            'User_Cedula' => $request['User_Cedula'],
                            'User_Nombre1' => $request['User_Nombre1'],
                            //'User_Nombre2' => $request['User_Nombre2'],
                            'User_Apellido1' => $request['User_Apellido1'],
                            //'User_Apellido2' => $request['User_Apellido2'],
                            'User_Correo' => $request['User_Correo'],
                            'User_Contra' => Crypt::encrypt($request['User_Cedula']),
                            'User_Direccion' => $request['User_Direccion'],
                            'FK_User_IdEstado' => $request['FK_User_IdEstado'],
                            'FK_User_IdRol' => $request['FK_User_IdRol'],
                        ]);

                        return AjaxResponse::success(
                            '¡Bien hecho!',
                            'Datos creados en Usuarios'
                        );
                    }
                    else{
                        $IdError = 422;
                        return AjaxResponse::success(
                            '¡Lo sentimos!',
                            'No se pudo completar tu solicitud, el código ya está registrado.',
                            $IdError
                        );
                    }
                }
            

            $IdError = 422;
            return AjaxResponse::success(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud, la cedula, el codigo o el correo ya está registrado.',
                $IdError
            );
        }
            //return view($this->path .'Usuarios'); 
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
    
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
