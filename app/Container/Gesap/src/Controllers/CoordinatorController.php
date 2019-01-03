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

    }
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



    
}
