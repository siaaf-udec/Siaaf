<?php

namespace App\Container\Gesap\src\Controllers;


use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use Exception;
use Validator;
use Yajra\DataTables\DataTables;


use App\Container\Overall\Src\Facades\AjaxResponse;

use App\Container\Gesap\src\Anteproyecto;
use App\Container\Gesap\src\Proyecto;
use App\Container\Gesap\src\Actividad;
use App\Container\Gesap\src\Radicacion;
use App\Container\Gesap\src\Encargados;
use App\Container\Gesap\src\Usuarios;
use App\Container\Users\src\User;
use App\Container\Users\src\EstadoAnteproyecto;

use Carbon\Carbon;

class CoordinatorController extends Controller
{

	private $path = 'gesap.Coordinador.';


	// CONTROLLERS CREADOS PARA GESAP V2.0//

	public function index(Request $request)
	{
		
			return view($this->path . 'Anteproyectos');
		
	}
	public function usuariosindex(Request $request)
	{
		
			return view($this->path . 'Anteproyectos');
		
	}
<<<<<<< HEAD
	
=======
>>>>>>> develop
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

	public function anteproyectoList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

		   
		   $anteproyecto=Anteproyecto::all();
		   //$estado = EstadoAnteproyecto::find(2); 
		   return DataTables::of($anteproyecto)
			   ->addColumn('Estado','No sirve')
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
	public function listarEstadosAnte(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
			$Estado = EstadoAnteproyecto::all();
			
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

	public function CreateAnteproyecto(Request $request)
    {
		if ($request->isMethod('POST')) {	
        
	
			Anteproyecto::create([
			 'NPRY_Titulo' => $request['NPRY_Titulo'],
			 'NPRY_Keywords' => $request['NPRY_Keywords'],
			 'NPRY_Duracion' => $request['NPRY_Duracion'],
			 'NPRY_FechaR' => $request['NPRY_FechaR'],
			 'NPRY_FechaL' => $request['NPRY_FechaL'],
			 'FK_NPRY_Estado' => $request['FK_NPRY_Estado'],
			]);
		}
	
			return AjaxResponse::success(
				'¡Esta Hecho!',
				'Datos Creados.'
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
	
	
	public function CreateAnte(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
			
            return view($this->path . 'CrearAnteproyecto');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
<<<<<<< HEAD
	}

=======

    }
>>>>>>> develop
	public function EditarAnteproyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
           
            $infoAnte = Anteproyecto::find($id);
                    
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

	//Index para vista de Usuarios
	public function indexUsuarios(Request $request)
	{
		
			return view($this->path . 'Usuarios');
		
	}
	//lista de usuarios
	public function usuariosList(Request $request)
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
		if ($request->isMethod('POST')) {	
        
	
			Usuarios::create([
			 'User_Cedula' => $request['User_Cedula'],
			 'User_Nombre1' => $request['User_Nombre1'],
			 'User_Nombre2' => $request['User_Nombre2'],
			 'User_Apellido1' => $request['User_Apellido1'],
			 'User_Apellido2' => $request['User_Apellido2'],
			 'User_Correo' => $request['User_Correo'],
			 'User_Direccion' => $request['User_Direccion'],
			 'Fk_User_IdEstado' => $request['Fk_User_IdEstado'],
			 'FK_User_IdRol' => $request['FK_User_IdRol'],
			]);
		}
	
            return view($this->path .'Usuarios');
        
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
