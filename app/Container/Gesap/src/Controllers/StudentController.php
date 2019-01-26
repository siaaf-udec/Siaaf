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


class StudentController extends Controller
{

    private $path = 'gesap.Estudiante.';

    public function index(Request $request)
	{
		
			return view($this->path . 'IndexEstudiante');
		
    }
    public function VerActividadesList(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

           $Actividades=Actividad::all();

        
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
    public function VerActividades(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                      
                  return view($this->path .'ActividadesEstudiante',
                [
                    
                ]);
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }
    public function SubirActividad(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                      
                $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->get();
                
                

                  return view($this->path .'SubirActividad',
                [
                    'datos' => $Actividad,
                ]);
               
                 
            }     
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
        
    }
    public function AnteproyectoList(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

           $Desarrollo=Desarrolladores::where('FK_User_Codigo', $id) ->first();

           if($Desarrollo===null){
               $anteproyecto = [];
           }else{
            $anteproyecto = $Desarrollo -> relacionAnteproyecto()->get();   
               if( $anteproyecto[0]->FK_NPRY_Estado <= 1){
                $anteproyecto = [];
               }else{
                
           
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
            }
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
}
