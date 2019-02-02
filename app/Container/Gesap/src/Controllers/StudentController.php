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
use App\Container\Gesap\src\ObservacionesMct;
use App\Container\Gesap\src\Commits;
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
    public function VerActividadesList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

               $Actividades=Mctr008::all();
                  
        
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
            
                $Anteproyecto = $id;

                return view($this->path .'ActividadesEstudiante',
                [
                    'Anteproyecto' => $Anteproyecto,
                ]);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
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
    public function Radicar(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $commits = Commits::where('FK_NPRY_IdMctr008',$id)->get();
            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            $limit = $anteproyecto  -> NPRY_FCH_Radicacion;
            $mct = Mctr008::all();
            $commitsN = $commits->count();
            $mctN = $mct->count();
            $N = 0;
            $now = date('Y-d-m');
            if($limit >= now()->toDateString()){
                if($commitsN == $mctN){

                    foreach($commits as $commit){
                        $numero = $commit-> FK_CHK_Checklist;
                        if($numero == 2){
                            $N = $N +  1 ;
                        }
                    }
                    $resultado = $mctN - $N ;
                    if($resultado == 0){
                        $Anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
                        $estado = $Anteproyecto -> FK_NPRY_Estado;
                        if($estado == 3){
                            $IdError = 422;
                            return AjaxResponse::success(
                                '¡Lo sentimos!',
                                'El Anteproyecto Ya esta radicado.',
                                $IdError
                            );
                        }else{
                        $Anteproyecto -> FK_NPRY_Estado = 3 ;
                        $Anteproyecto->save();
                        return AjaxResponse::success(
                            '¡Esta Hecho!',
                            'Anteproyecto Radicado.'
                        );
                    }

                    }else{
                        $IdError = 422;
                        return AjaxResponse::success(
                            '¡Lo sentimos!',
                            'No se han avalado todas las Actividades Correspondientes.',
                            $IdError
                        );
                    }

                }else{

                    $IdError = 422;
                    return AjaxResponse::success(
                        '¡Lo sentimos!',
                        'No se han subido todas las Actividades Correspondientes.',
                        $IdError
                    );
                
                }
        }else{
            $fechas = Fechas::all();
            $ultimo = $fechas ->last();
            $anteproyecto  -> NPRY_FCH_Radicacion = $ultimo -> FCH_Radicacion_secundaria ;
            $anteproyecto  -> save();
            return AjaxResponse::success(
                '¡Lo sentimos!',
                'La fecha de Radicación ya expiro.'
            );
        }
            }              
        
    }

    public function ActividadStore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
           // $commit = Commits::where('FK_NPRY_idmctr008',1)->where('FK_MCT_idMctr008',1)->where('FK_User_Codigo', 123456189)->first();
               $commit = Commits::where('FK_NPRY_idMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_idMctr008',$request['FK_MCT_IdMctr008'])->first(); 
                if(is_null($commit)){

                 Commits::create([
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                     'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                     'FK_User_Codigo' => $request['FK_User_Codigo'],
                     'CMMT_Commit' => $request['CMMT_Commit'],
                     'FK_CHK_Checklist' => $request['FK_CHK_Checklist']
                    ]);
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Creados.'
                );
               }else{

                 $commit -> CMMT_Commit = $request['CMMT_Commit'];
            
                 $commit -> save();
                 return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Modificados.'
                );
                
               }


                 
            }              
        
    }
    public function SubirActividad(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                      
                $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->get();
                
                $Actividad->offsetSet('Anteproyecto', $idp);

                $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
                $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
                if($commit2 == null)
                {
                    $Actividad->offsetSet('Commit', "Aún NO se ha hecho ningun cambio a esta actividad del MCT.");
                    $Actividad->offsetSet('Estado', "Sin Enviar Para Calificar.");
                    
                }else{
                    $Actividad->offsetSet('Estado', $commit[0] -> relacionEstado -> CHK_Checlist);
                    $Actividad->offsetSet('Commit', $commit[0] -> CMMT_Commit);
     
                }

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
