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

    public function Asignar(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $anteproyecto = Anteproyecto::Where('PK_NPRY_IdMctr008', $id)->first();
            
            $anteproyecto -> FK_NPRY_Estado = 5;
            
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




            return view($this->path .'VerAnteproyectoDocente',
                [
                    'datos' => $datos,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

}
