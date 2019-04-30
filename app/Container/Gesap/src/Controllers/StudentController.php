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
use Illuminate\Support\Facades\Mail;

use App\Container\Gesap\src\Anteproyecto;
use App\Container\Gesap\src\Proyecto;
use App\Container\Gesap\src\Actividad;
use App\Container\Gesap\src\Encargados;
use App\Container\Gesap\src\Usuarios;
use App\Container\Gesap\src\Cronograma;
use App\Container\Gesap\src\Resultados;
use App\Container\Gesap\src\Solicitud;
use App\Container\Gesap\src\Funciones;
use App\Container\Gesap\src\NoFunciones;
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


class StudentController extends Controller
{

    private $path = 'gesap.Estudiante.';
    //funcion que redirecciona ala vista principal de anteproyecto//
    public function index(Request $request)
	{
		
			return view($this->path . 'IndexEstudiante');
		
    }
    //funcion que redirecciona a la vista principal de proyectos//
    public function indexProyecto(Request $request)
	{
		
			return view($this->path . 'IndexEstudianteProyecto');
		
    }
    //funcion que carga todas las actividades del anteproyecto $id//
    public function VerActividadesList(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

               $Actividades=Mctr008::where('FK_Id_Formato',1)->get();
               $numero = 1 ;
               foreach($Actividades as $Actividad){
                   $Actividad->offsetSet('Numero', $numero);
                   $check = Commits::where('FK_MCT_IdMctr008', $Actividad->PK_MCT_IdMctr008)->where('FK_NPRY_IdMctr008',$id)->first();
                   
                   if($check != null){
                       if($check ->relacionEstado -> CHK_Checlist == "EN CALIFICACIÓN"){
                          $Actividad->offsetSet('Check', 'Sin Aprobar');
                       }else{
                          $Actividad->offsetSet('Check', 'Aprobado');
                       }
                   }else{
                        $Actividad->offsetSet('Check', 'Sin Subir');
                   }
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
    //funcion que carga todas las actividades de proyecto $id//
    public function VerActividadesListProyecto(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

               $Actividades=Mctr008::where('FK_Id_Formato',3)->get();
               $numero = 1 ;
               foreach($Actividades as $Actividad){
                   $Actividad->offsetSet('Numero', $numero);
                   $check = Commits::where('FK_MCT_IdMctr008', $Actividad->PK_MCT_IdMctr008)->where('FK_NPRY_IdMctr008',$id)->first();
                   
                   if($check != null){
                       if($check ->relacionEstado -> CHK_Checlist == "EN CALIFICACIÓN"){
                          $Actividad->offsetSet('Check', 'Sin Aprobar');
                       }else{
                          $Actividad->offsetSet('Check', 'Aprobado');
                       }
                   }else{
                        $Actividad->offsetSet('Check', 'Sin Subir');
                   }
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
    //funcion que carga las solicitudes hechas por el usuario//
    public function VerSolicitud(Request $request,$id)
    {
        $user = Auth::user();
		$id = $user->identity_no;
        if ($request->ajax() && $request->isMethod('GET')) {

               $Solicitudes=Solicitud::where('FK_User_Codigo',$id)->get();
               
        
               return DataTables::of($Solicitudes)
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
    //funcion que redirecciona a la plantilla de actividades estudiante//
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
    //funcion que retorna la informacion de u proyecto en el banco de proyectos//
    public function VerProyectoCompleto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
                $datos = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();

                $Director = $datos->relacionPredirectores->User_Nombre1." ".$datos->relacionPredirectores->User_Apellido1;

                $datos -> offsetSet('Director', $Director);

                return view($this->path .'.BancoP.BancoVer',
                [
                    'datos' => $datos,
                ]);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }
    //funcion que redirecciona a la vista de requerimeintos//
    public function VerRequerimientos(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
                $Anteproyecto = $id;

                return view($this->path .'RequerimientosEstudiante',
                [
                    'Anteproyecto' => $Anteproyecto,
                ]);
               
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );  
                 
            }              
        
    }
    //funcion que retorna los desarrolladores a la tabla del proyecto//
    public function DesarrolladoresEstudiante(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Desarrolladores=Desarrolladores::where('FK_NPRY_IdMctr008',$id)->where('FK_IdEstado',1)->get();
            if(empty($Desarrolladores)){
                $Desarrolladores = [];
            }else{
            foreach($Desarrolladores as $Desarrollador){
                $Nombre = $Desarrollador->relacionUsuario->User_Nombre1." ".$Desarrollador->relacionUsuario->User_Apellido1;
                $Codigo = $Desarrollador->relacionUsuario->User_Codigo;  
                $Desarrollador->offsetSet('Nombre', $Nombre);
                $Desarrollador->offsetSet('Codigo', $Codigo);
            }
                  
        }
            return DataTables::of($Desarrolladores)
            ->removeColumn('created_at')
            ->removeColumn('updated_at')
             
            ->addIndexColumn()
            ->make(true);
                 
                
        }         
        
    }
    //funcion que retorna los datos de requerimientos para cargar en la tabla de la vista de requerimientos $id = pk del anteporyecto//
    public function VerRequerimientosList(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Actividades=Mctr008::where('FK_Id_Formato',2)->get();
            $numero = 1 ;

            foreach($Actividades as $Actividad){
                $Actividad->offsetSet('Numero', $numero);
                $check = Commits::where('FK_MCT_IdMctr008', $Actividad->PK_MCT_IdMctr008)->where('FK_NPRY_IdMctr008',$id)->first();
                   
                if($check != null){
                    if($check ->relacionEstado -> CHK_Checlist == "EN CALIFICACIÓN"){
                       $Actividad->offsetSet('Check', 'Sin Aprobar');
                    }else{
                       $Actividad->offsetSet('Check', 'Aprobado');
                    }
                }else{
                     $Actividad->offsetSet('Check', 'Sin Subir');
                }
                $numero = $numero +1 ;
            }
                  
        
            return DataTables::of($Actividades)
            ->removeColumn('created_at')
            ->removeColumn('updated_at')
             
            ->addIndexColumn()
            ->make(true);
                 
            }              
        
    }
    //funcion para gaurdar comentarios hechos para la actividad//
    public function ComentarioStore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = Auth::user();
            $id = $user->identity_no;
            $fecha = Carbon::now();
            $fechahoy = $fecha->format('Y-m-d');
            $id_nombre = $user->name." ".$user->lastname;
            if($request['OBS_Limit'] < $fechahoy){
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'La Fecha No puede ser anterior a la Fecha Actual.',
                     $IdError
                );
            } else{
                    ObservacionesMct::create([
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                     'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                     'FK_User_Codigo' => $id,
                     'OBS_Observacion' => $request['OBS_observacion'],
                     'OBS_Limit' => $request['OBS_Limit']

                    ]);
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $commit = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$commit->MCT_Actividad,
                            'usuario'=>$id_nombre,
                            'Fecha'=> $request['OBS_Limit'],
                        );
            
                        Mail::send('gesap.Emails.ActComentstu',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
            
                    
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Comentario Hecho.'
                );
            }
            }              
        
    }
        //funcion que carga las actividades por cronograma ya cuando el anteproyecto es aprobado//
    public function SeguimientoCrono(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                

            $user = Auth::user();
            $id = $user->identity_no;
            
            $desarrollador = Desarrolladores::where('FK_User_Codigo',$id)->where('Fk_IdEstado',1)->get();
            if($desarrollador->IsEmpty()){
                $Anteproyecto=[];
            }else{
            $Anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008', $desarrollador[0]->FK_NPRY_IdMctr008)->get();
            $Proyecto = Proyecto::where('FK_NPRY_IdMctr008', $desarrollador[0]->FK_NPRY_IdMctr008)->first();
            $now = date('Y-m-d');
            $fechaactual = Carbon::now()->format('Y-m-d');
            
            $fecharadicacion = Carbon::parse($Proyecto ->PYT_Fecha_Radicacion );
            $fechahoy = Carbon::parse($fechaactual);
            $diasDiferencia = $fechahoy->diffInWeeks($fecharadicacion);
            $Anteproyecto[0] -> offsetSet('semana', $diasDiferencia);
            $Actividades = "";
            $Cronograma = Cronograma::where('FK_NPRY_IdMctr008', $desarrollador[0]->FK_NPRY_IdMctr008)->get();
            $i = 0;
            foreach($Cronograma as $crono){
                $inicio = $crono->MCT_CRN_Semana_Inicio;
                $fin =  $crono->MCT_CRN_Semana_Fin;
                if($diasDiferencia >= $inicio && $diasDiferencia <= $fin ){
                    if($i == 0){
                        $Actividades = $Actividades."-".$crono->MCT_CRN_Actividad;
                    }else{
                        $Actividades = $Actividades.",".$crono->MCT_CRN_Actividad;
                    }
                }
                
            }
            $Anteproyecto[0] -> offsetSet('actividades', $Actividades);
        }
            
            return DataTables::of($Anteproyecto)
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
    //funcion para cambiar de estado el proyecto a radicado para asi poder asignar jurados//
    public function Radicar(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $commits = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato',1)->get();//miro los comits que se han hecho de Anteproyecto
            $anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            $limit = $anteproyecto  -> NPRY_FCH_Radicacion;
            $mct = Mctr008::where('FK_Id_Formato','!=',3)->get();//miro la cantidad de actividades qeu hay en el mct
            
            $commitsN = $commits->count();
            $mctN = $mct->count();
            $N = 0;
            $now = date('Y-d-m');
            if($limit == now()->toDateString()){
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
                        $fecha = Carbon::now();
                        $data = array(
                            'correo'=>$anteproyecto->relacionPredirectores->User_Correo,
                            'Proy'=>"Anteproyecto : ".$anteproyecto->NPRY_Titulo,
                            'fecha'=>$fecha,
                        );
            
                        Mail::send('gesap.Emails.Radicar',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
            
                        return AjaxResponse::success(
                            '¡Esta Hecho!',
                            'Anteproyecto Radicado.'
                        );
                    }

                    }else{
                        $IdError = 422;
                        return AjaxResponse::success(
                            '¡Lo sentimos!',
                            'No se han aprobado todas las Actividades Correspondientes.',
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
        }
        if($limit < now()->toDateString()){
          
            $IdError = 422;
            return AjaxResponse::success(
 
                '¡Lo sentimos!',
                'La fecha para radicar ya Expiro.',
                $IdError
            );
        }
        if($limit > now()->toDateString()){
          
            $IdError = 422;
            return AjaxResponse::success(
                '¡Lo sentimos!',
                'Aun no es fecha para radicar.',
                $IdError
            );
        }
            }              
        
    }
    //cargar la decision de los jurados a los estudiantes///
    public function ListComentariosJuradoAnteproyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                

                $jurados = Jurados::where('FK_NPRY_IdMctr008',$id)->get();
                if($jurados->IsEmpty()){
                    $jurado ->offsetSet('Nombre',"Sin Asignar");
                    $jurado ->offsetSet('Estado',"Sin Asignar");
                }else{
                    foreach($jurados as $jurado){
                        $nombre = $jurado -> relacionUsuarios -> User_Nombre1 ;
                        $apellido = $jurado -> relacionUsuarios -> User_Apellido1 ;
                        $total = $nombre." ".$apellido;
                        $jurado ->offsetSet('Nombre',$total);
                        $jurado ->offsetSet('Estado',$jurado->relacionEstado->EST_Estado );
                      
                    }
    
                }
                return DataTables::of($jurados)
               ->removeColumn('created_at')
			   ->removeColumn('updated_at')
               ->removeColumn('PK_Id_Jurados')
               ->removeColumn('FK_NPRY_IdMctr008')
               ->removeColumn('PK_Id_Jurados')
               ->removeColumn('FK_User_Codigo')
               ->removeColumn('FK_NPRY_Estado')
               ->removeColumn('FK_NPRY_Estado_Proyecto')
               ->removeColumn('JR_Comentario_Proyecto')
               ->removeColumn('JR_Comentario_Proyecto_2')
			   ->addIndexColumn()
               ->make(true);
        

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
        //cargar la decision de los jurados a los estudiantes PROYECTO///
    public function ListComentariosJuradoProyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
                
                $jurados = Jurados::where('FK_NPRY_IdMctr008',$id)->get();
                foreach($jurados as $jurado){
                    $jurado ->offsetSet('Nombre',$jurado->relacionUsuarios->User_Nombre1." ".$jurado->relacionUsuarios->User_Apellido1);
                    if($jurado->relacionEstadoJurado->EST_Estado == "RADICADO"){
                        $jurado ->offsetSet('Estado',"ASIGNADO");
                    }else{
                        $jurado ->offsetSet('Estado',$jurado->relacionEstadoJurado->EST_Estado );

                    }
                    
                }
               return DataTables::of($jurados)
               ->removeColumn('created_at')
			   ->removeColumn('updated_at')
               ->removeColumn('PK_Id_Jurados')
               ->removeColumn('FK_NPRY_IdMctr008')
               ->removeColumn('PK_Id_Jurados')
               ->removeColumn('FK_User_Codigo')
               ->removeColumn('FK_NPRY_Estado')
               ->removeColumn('FK_NPRY_Estado_Proyecto')
               ->removeColumn('JR_Comentario')
               ->removeColumn('JR_Comentario_2')
			    
			   ->addIndexColumn()
               ->make(true);
        

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    ///envia informacion al formulario para ver la decisiond e los jurados///
    public function VerComentariosJuradoAnteproyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();

            $jurados=Jurados::where('FK_NPRY_IdMctr008',$id)->first();
            if($jurados == null){
                $Anteproyecto->offsetseT('N_Radicacion',1);
            }else{
                if($jurados->JR_Comentario_2 == 'inhabilitado'){
                    $Anteproyecto->offsetseT('N_Radicacion',1);
                }else{
                    $Anteproyecto->offsetseT('N_Radicacion',2);
                }
                
            }
            
            return view($this->path .'ComentariosJurados',
            [
                'Anteproyecto' => $Anteproyecto,
            ]);
           
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );  
             
        }             
        
    }
     ///envia informacion al formulario para ver la decisiond e los jurados PROYECTO///
    public function VerComentariosJuradoProyecto(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Anteproyecto = Anteproyecto::where('PK_NPRY_IdMctr008',$id)->first();
            $estado = $Anteproyecto -> relacionProyecto -> FK_EST_Id ;
            $Anteproyecto -> offsetSet('Estado', $estado);

            $jurados=Jurados::where('FK_NPRY_IdMctr008',$id)->first();
               if($jurados->JR_Comentario_Proyecto_2 == 'inhabilitado'){
                    $Anteproyecto->offsetseT('N_Radicacion',1);
                }else{
                    $Anteproyecto->offsetseT('N_Radicacion',2);
                }
            

            return view($this->path .'.Proyecto.ComentariosJurados',
            [
                'Anteproyecto' => $Anteproyecto,
            ]);
           
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );  
             
        }             
        
    }
    //funcion que retorna la vista de banco de proyectos //
    public function BancoDeProyectos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            

            return view($this->path .'.BancoP.BancoIndex',
            [
                
            ]);
           
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );  
             
        }             
        
    }
    //funncion en la cual se valida si el proyecto esta listo para radicar $id = la PK del Proyecto //
    public function RadicarProyecto(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $commits = Commits::where('FK_NPRY_IdMctr008',$id)->where('CMMT_Formato',3)->get();//miro los comits que se han hecho de proyecto
            $proyt = Mctr008::where('FK_Id_Formato',3)->get();//miro la cantidad de actividades para proyecto

            $commitsN = $commits->count();//cuento los commits hechos
            $proytN = $proyt->count();//cuento las actvidades
            $N = 0; 
            $now = date('Y-d-m');//tomo la fecha de hoy
            $proyecto = Proyecto::where('FK_NPRY_IdMctr008',$id)->first();
            $limit = $proyecto -> PYT_Fecha_Radicacion;
            if($limit == now()->toDateString()){
                if($commitsN == $proytN){

                        foreach($commits as $commit){
                            $numero = $commit-> FK_CHK_Checklist;
                            if($numero == 2){
                                $N = $N +  1 ;
                            }
                        }
                        $resultado = $proytN - $N ;
                        if($resultado == 0){
                                $proyecto = Proyecto::where('FK_NPRY_IdMctr008',$id)->first();
                                $estado = $proyecto -> FK_EST_Id;
                                if($estado == 3){
                                    $IdError = 422;
                                    return AjaxResponse::success(
                                        '¡Lo sentimos!',
                                        'El Proyecto Ya esta radicado.',
                                        $IdError
                                    );
                                }else{
                                    $proyecto -> FK_EST_Id = 3 ;
                                    $proyecto->save();
                                    $fecha = Carbon::now();
                                    $data = array(
                                        'correo'=>$proyecto->relacionAnteproyecto->relacionPredirectores->User_Correo,
                                        'Proy'=>"Proyecto : ".$proyecto->relacionAnteproyecto->NPRY_Titulo,
                                        'fecha'=>$fecha,
                                    );
                        
                                    Mail::send('gesap.Emails.Radicar',$data, function($message) use ($data){
                                        
                                        $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
                        
                                        $message->to($data['correo']);
                        
                                    });
                        
                                    return AjaxResponse::success(
                                        '¡Esta Hecho!',
                                        'Proyecto Radicado.'
                                    );
                                }

                        }else{
                                $IdError = 422;
                                return AjaxResponse::success(
                                    '¡Lo sentimos!',
                                    'No se han aprobado todas las Actividades Correspondientes Del Libro.',
                                    $IdError
                                );
                        }

                    }else{

                        $IdError = 422;
                        return AjaxResponse::success(
                            '¡Lo sentimos!',
                            'No se han subido todas las Actividades Correspondientes Del Proyecto.',
                            $IdError
                        );
                        
                    
                    }
            }
            if($limit < now()->toDateString()){
          
                $IdError = 422;
                return AjaxResponse::success(
     
                    '¡Lo sentimos!',
                    'La fecha para radicar ya Expiro.',
                    $IdError
                );
            }
            if($limit > now()->toDateString()){
              
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'Aun no es fecha para radicar.',
                    $IdError
                );
            }    
        
        }
    }
//funcion para subir una actividad rol estudiante///
    public function ActividadStore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = Auth::user();
            $id = $user->identity_no;
            $id_name = $user->name." ".$user->lastname;
          
           // $commit = Commits::where('FK_NPRY_idmctr008',1)->where('FK_MCT_idMctr008',1)->where('FK_User_Codigo', 123456189)->first();
               $commit = Commits::where('FK_NPRY_idMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_idMctr008',$request['FK_MCT_IdMctr008'])->first(); 
                if(is_null($commit)){

                 Commits::create([
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                     'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                     'FK_User_Codigo' => $id,
                     'CMMT_Commit' => $request['CMMT_Commit'],
                     'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                     'CMMT_Formato' => $request['CMMT_Formato']
                    ]);
                    
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $commit = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$commit->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
            
           
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Creados.'
                );
               }else{

                 $commit -> CMMT_Commit = $request['CMMT_Commit'];
            
                 $commit -> save();
                 $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $commit = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$commit->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                 return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Modificados.'
                );
                
               }
               $IdError = 413;
               return AjaxResponse::success(
                   '¡Lo sentimos!',
                   'El archivo es Demasiado Grande.',
                   $IdError
               );

                 
            }              
        
    }

    //funcion que carga la actividad lo que hace el estudiante//
    public function ActividadStoreProyecto(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
           // $commit = Commits::where('FK_NPRY_idmctr008',1)->where('FK_MCT_idMctr008',1)->where('FK_User_Codigo', 123456189)->first();
               $commit = Commits::where('FK_NPRY_idMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_idMctr008',$request['FK_MCT_IdMctr008'])->first(); 
              // $file = $request->file('CMMT_Commit');
              $img = $request->file('PYT_Actividad');
              $url = Storage::disk('gesap')->putFile('gesap/libro', $img);
              $url = "gesap/" . $url;
              $user = Auth::user();
	        	$id = $user->identity_no;

             
                if(is_null($commit)){

                 Commits::create([
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                     'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                     'FK_User_Codigo' => $id,
                     'CMMT_Commit' =>$url,
                     'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                     'CMMT_Formato'=>$request['CMMT_Formato']
                    ]);
                    
                    $id_name = $user->name." ".$user->lastname;
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $commit = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$commit->MCT_Actividad,
                            'usuario'=>$id_name,
                        );

                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');

                            $message->to($data['correo']);

                        });

                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Creados.'
                );
               }else{

                 $commit -> CMMT_Commit = $url;          
                 $commit -> save();
                 
                $id_name = $user->name." ".$user->lastname;
                $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                $commit = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                    $data = array(
                        'correo'=>$predi->relacionPredirectores->User_Correo ,
                        'Actividad'=>$commit->MCT_Actividad,
                        'usuario'=>$id_name,
                    );

                    Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                        
                        $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');

                        $message->to($data['correo']);

                    });

                 return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Modificados.'
                );
                
               }

                 
            }              
        
    }
    //CRUD rubros persona///
    //esta funcion sirve para agregar datos a la tabla detalles de persona del MCT//
    public function PersonaDatos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
            $user = Auth::user();
            $id = $user->identity_no;
                PersonaMct::create([
                        'MCT_Detalles_Entidad'=>$request['MCT_Detalles_Entidad'],
                        'MCT_Detalles_Primer_Apellido'=>$request['MCT_Detalles_Primer_Apellido'],
                        'MCT_Detalles_Segundo_Apellido'=>$request['MCT_Detalles_Segundo_Apellido'],
                        'MCT_Detalles_Nombres'=>$request['MCT_Detalles_Nombres'],
                        'MCT_Detalles_Genero'=>$request['MCT_Detalles_Genero'],
                        'MCT_Detalles_Fecha_Nacimiento'=>$request['MCT_Detalles_Fecha_Nacimiento'],
                        'MCT_Detalles_Pais'=>$request['MCT_Detalles_Pais'],
                        'MCT_Detalles_Correo'=>$request['MCT_Detalles_Correo'],
                        'MCT_Detalles_Tipo_Doc'=>$request['MCT_Detalles_Tipo_Doc'],
                        'MCT_Detalles_Numero'=>$request['MCT_Detalles_Numero'],
                        'MCT_Detalles_Funcion'=>$request['MCT_Detalles_Funcion'],
                        'MCT_Detalles_Horas_Semanales'=>$request['MCT_Detalles_Horas_Semanales'],
                        'MCT_Detalles_Numero_Meses'=>$request['MCT_Detalles_Numero_meses'],
                        'MCT_Detalles_Tipo_Vinculacion'=>$request['MCT_Detalles_Tipo_vinculacion'],
                        'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
              

                ]);
                $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                if($commit == null){

                Commits::create([
                'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                 'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                 'FK_User_Codigo' => $id,
                 'CMMT_Commit' => $request['CMMT_Commit'],
                 'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                 'CMMT_Formato' => $request['CMMT_Formato']
                ]);
                $id_name=$user->name." ".$user->lastname;
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                }
                return AjaxResponse::success(
                '¡Esta Hecho!',
                'Datos Creados.'
            );
          
       
            }              
        
    }
    public function EditarPersonaDatos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
            $persona = PersonaMct::where('PK_Id_Dpersona',$request['PK_Id_EDITAR_Dpersona'])->first();
            $persona -> MCT_Detalles_Entidad = $request['MCT_EDITAR_Detalles_Entidad'];
            $persona -> MCT_Detalles_Primer_Apellido = $request['MCT_EDITAR_Detalles_Primer_Apellido'];
            $persona -> MCT_Detalles_Segundo_Apellido = $request['MCT_EDITAR_Detalles_Segundo_Apellido'];
            $persona -> MCT_Detalles_Nombres = $request['MCT_EDITAR_Detalles_Nombres'];
            $persona -> MCT_Detalles_Genero = $request['MCT_EDITAR_Detalles_Genero'];
            $persona -> MCT_Detalles_Fecha_Nacimiento = $request['MCT_EDITAR_Detalles_Fecha_Nacimiento'];
            $persona -> MCT_Detalles_Pais = $request['MCT_EDITAR_Detalles_Pais'];
            $persona -> MCT_Detalles_Correo = $request['MCT_EDITAR_Detalles_Correo'];
            $persona -> MCT_Detalles_Tipo_Doc = $request['MCT_EDITAR_Detalles_Tipo_Doc'];
            $persona -> MCT_Detalles_Numero = $request['MCT_EDITAR_Detalles_Numero'];
            $persona -> MCT_Detalles_Funcion = $request['MCT_EDITAR_Detalles_Funcion'];
            $persona -> MCT_Detalles_Horas_Semanales = $request['MCT_EDITAR_Detalles_Horas_Semanales'];
            $persona -> MCT_Detalles_Numero_Meses = $request['MCT_EDITAR_Detalles_Numero_meses'];
            $persona -> MCT_Detalles_Tipo_Vinculacion = $request['MCT_EDITAR_Detalles_Tipo_vinculacion'];
            $persona -> save();

            return AjaxResponse::success(
                '¡Esta Hecho!',
                'Datos Modificados.'
            );
          
       
            }              
        
    }
    public function PersonaDatosdelete(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
            
            $persona = PersonaMct::where('PK_Id_Dpersona',$id)->first();
            
            $persona -> delete();
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
    //fin crud persona 

    //funcion que elimina una solicitud
    
    public function EliminarSolicitud(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
            
            $solicitud = Solicitud::where('Pk_Id_Solicitud',$id)->first();
            
            if(empty($solicitud)){

                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Los Datos Ya Fueron Eliminados.'
                );
            }else{

                $solicitud -> delete();
            }
            
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
   //funcion que sube una actividad PDF al propyecto 
   public function SubirActividadProyecto(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',3)->get();
                    
            $Actividad->offsetSet('Anteproyecto', $idp);

            $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
            $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
            if($commit2 == null)
            {
                $Actividad->offsetSet('Commit', "documents/GESAPPDF.pdf");
                $Actividad->offsetSet('Estado', "Sin Enviar Para Calificar.");
                
            }else{
                $Actividad->offsetSet('Estado', $commit[0] -> relacionEstado -> CHK_Checlist);
                $Actividad->offsetSet('Commit', $commit[0] -> CMMT_Commit);

            }
        
               return view($this->path .'.Proyecto.SubirActividadProyecto',
                [
                'datos' => $Actividad,
                ]);
            
            }     
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
        
    }
    //funcion que redirecciona al formulariodependiendo laactividad proporcionada $Id y el anteproyecto $idp
    public function SubirActividad(Request $request, $id, $idp)
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
                return view($this->path .'SubirActividadCronograma',
                [
                'datos' => $Actividad,
                ]);

            
            }if($act->MCT_Actividad == "Detalles de personas"){
                return view($this->path .'SubirActividadDetalles',
                [
                'datos' => $Actividad,
                ]);

            }if($act->MCT_Actividad == "Financiacion"){
                return view($this->path .'SubirActividadFinanciacion',
                [
                'datos' => $Actividad,
                ]);

            
            }if($act->MCT_Actividad == "Resultados"){
                return view($this->path .'SubirActividadResultados',
                [
                'datos' => $Actividad,
                ]);

            }if($act->MCT_Actividad == "Resumen De Rubros"){
                return view($this->path .'SubirActividadRubros',
                [
                'datos' => $Actividad,
                ]);

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
    //funcion para eliminar una financiacion
    public function Financiaciondelete(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
            
            $persona = Financiacion::where('PK_Id_Financiacion',$id)->first();
            
            $persona -> delete();
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
    //funcion para subir los requerimientos comoactividad $id y al anteproyecto $idp 
    public function SubirRequerimiento(Request $request, $id, $idp)
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
                return view($this->path .'SubirRequerimientoFunciones',
                [
                'datos' => $Actividad,
                ]);   
                 
            }   
            if($act->MCT_Actividad == "Requerimientos No Funcionales"){
                return view($this->path .'SubirRequerimientosNoFuncionales',
                [
                'datos' => $Actividad,
                ]);   
                 
            }     
            return view($this->path .'SubirRequerimiento',
            [
            'datos' => $Actividad,
            ]);
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );         
        
    }
}
        //cronograma
        public function CronogramaDelete(Request $request, $id)
        {
            if ($request->ajax() && $request->isMethod('DELETE')) {	
                
                
                $Cronograma = Cronograma::where('PK_Id_Cronograma',$id)->first();
                
                $Cronograma -> delete();
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
    
        //funcion para subir el cronograma//
        public function CronogramaStore(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                
                $user = Auth::user();
                $id = $user->identity_no;
                
                    Cronograma::create([
                        'MCT_CRN_Actividad'=>$request['MCT_CRN_Actividad'],
                        'MCT_CRN_Semana_Inicio'=>$request['MCT_CRN_Semana_inicio'],
                        'MCT_CRN_Semana_Fin'=>$request['MCT_CRN_Semana_fin'],    
                        'MCT_CRN_Responsable' => $request['MCT_CRN_Responsable'],  
                        'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],                  
    
                    ]);
                    $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                    if($commit == null){
    
                    Commits::create([
                        'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                        'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                        'FK_User_Codigo' => $id,
                        'CMMT_Commit' => $request['CMMT_Commit'],
                        'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                        'CMMT_Formato' => $request['CMMT_Formato']
                    ]);
                    $id_name=$user->name." ".$user->lastname;
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                    }
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Creados.'
                );
              
           
                }              
            
        }
        //funcion para mostrar el cronograma
        public function Cronograma(Request $request,$id)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
    
                    $Cronograma = Cronograma::where('FK_NPRY_IdMctr008', $id)->get();
                    foreach($Cronograma as $Crono){
                        $inicio = $Crono-> MCT_CRN_Semana_Inicio ;
                        $fin = $Crono-> MCT_CRN_Semana_Fin ;
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
        //funcion que edita el cronograma
        public function EditarCronograma(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                
                $Cronograma = Cronograma::where('PK_Id_Cronograma',$request['PK_Id_Cronograma'])->first();
    
                $Cronograma -> MCT_CRN_Actividad = $request['MCT_EDITAR_CRN_Actividad'];
                $Cronograma -> MCT_CRN_Semana_Inicio = $request['MCT_EDITAR_CRN_Semana_inicio'];
                $Cronograma -> MCT_CRN_Semana_Fin = $request['MCT_EDITAR_CRN_Semana_fin'];
                $Cronograma -> MCT_CRN_Responsable = $request['MCT_EDITAR_CRN_Responsable'];
                
                $Cronograma -> save();
    
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Modificados.'
                );
              
           
                }              
            
        }
    
    
        //

               //RUBRO PERSONAL
               //funcion que elimina en la tabla rubro personal
               public function RubroPersonalDelete(Request $request, $id)
               {
                   if ($request->ajax() && $request->isMethod('DELETE')) {	
                       
                       
                       $RubroPersonal = RubroPersonal::where('PK_RBR_Personal',$id)->first();
                       
                       $RubroPersonal -> delete();
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
           
           //funcion que crea en la tabla rubro persona
               public function RubroPersonalStore(Request $request)
               {
                   if ($request->ajax() && $request->isMethod('POST')) {
                    $user = Auth::user();
                    $id = $user->identity_no;
                     
                    RubroPersonal::create([
                               'RBR_PER_Nombre'=>$request['RBR_PER_Nombre'],
                               'RBR_PER_Funcion'=>$request['RBR_PER_Funcion'],
                               'RBR_PER_Tipo'=>$request['RBR_PER_Tipo'],    
                               'RBR_PER_Dedicacion' => $request['RBR_PER_Dedicacion'],  
                               'RBR_PER_Entidad' => $request['RBR_PER_Entidad'],
                               'RBR_PER_Solicitado_Udec'=>$request['RBR_PER_Solicitado_Udec'],
                               'RBR_PER_Contra_Udec'=>$request['RBR_PER_Contra_Udec'],    
                               'RBR_PER_Contra_Otro' => $request['RBR_PER_Contra_Otro'],  
                               'RBR_PER_Total' => $request['RBR_PER_Total'],  
                               'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],                  
                             
           
                           ]);
                           $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                           if($commit == null){
           
                           Commits::create([
                               'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                               'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                               'FK_User_Codigo' => $id,
                               'CMMT_Commit' => $request['CMMT_Commit'],
                               'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                               'CMMT_Formato' => $request['CMMT_Formato']
                           ]);
                           $id_name=$user->name." ".$user->lastname;
                        $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                        $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                           }
                       return AjaxResponse::success(
                           '¡Esta Hecho!',
                           'Datos Creados.'
                       );
                     
                  
                       }              
                   
               }
               //funcion que muestra el rubro persona
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
               //funcion que edita el rubro persona
               public function EditarRubroPersonal(Request $request)
               {
                   if ($request->ajax() && $request->isMethod('POST')) {
                       
                       $RubroPersonal = RubroPersonal::where('PK_RBR_Personal',$request['PK_RBR_Personal'])->first();
           
                       $RubroPersonal -> RBR_PER_Nombre = $request['RBR_PER_EDITAR_Nombre'];
                       $RubroPersonal -> RBR_PER_Funcion = $request['RBR_PER_EDITAR_Funcion'];
                       $RubroPersonal -> RBR_PER_Tipo = $request['RBR_PER_EDITAR_Tipo'];
                       $RubroPersonal -> RBR_PER_Dedicacion = $request['RBR_PER_EDITAR_Dedicacion'];
                       $RubroPersonal -> RBR_PER_Entidad = $request['RBR_PER_EDITAR_Entidad'];
                       $RubroPersonal -> RBR_PER_Solicitado_Udec = $request['RBR_PER_EDITAR_Solicitado_Udec'];
                       $RubroPersonal -> RBR_PER_Contra_Udec = $request['RBR_PER_EDITAR_Contra_Udec'];
                       $RubroPersonal -> RBR_PER_Contra_Otro = $request['RBR_PER_EDITAR_Contra_Otro'];
                       $RubroPersonal -> RBR_PER_Total = $request['RBR_PER_EDITAR_Total'];
                       
                       $RubroPersonal -> save();
           
                       return AjaxResponse::success(
                           '¡Esta Hecho!',
                           'Datos Modificados.'
                       );
                     
                  
                       }              
                   
               }
           
           
               //
           
               // CRUD RUBRO EQUIPOS
               public function RubroEquiposDelete(Request $request, $id)
               {
                   if ($request->ajax() && $request->isMethod('DELETE')) {	
                       
                       
                       $RubroEquipos = RubroEquipos::where('PK_RBR_Equipo',$id)->first();
                       
                       $RubroEquipos -> delete();
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
           
           
               public function RubroEquiposStore(Request $request)
               {
                   if ($request->ajax() && $request->isMethod('POST')) {
                       
                    $user = Auth::user();
                    $id = $user->identity_no;
                    RubroEquipos::create([
                               'RBR_EQP_Descripcion'=>$request['RBR_EQP_Descripcion'],
                               'RBR_EQP_Lab'=>$request['RBR_EQP_Lab'],
                               'RBR_EQP_Actividades'=>$request['RBR_EQP_Actividades'],    
                               'RBR_EQP_Justificacion' => $request['RBR_EQP_Justificacion'],  
                               'RBR_EQP_Cantidad' => $request['RBR_EQP_Cantidad'],
                               'RBR_EQP_Val'=>$request['RBR_EQP_Val'],
                               'RBR_EQP_Solicitado'=>$request['RBR_EQP_Solicitado'],    
                               'RBR_EQP_Contra_Udec' => $request['RBR_EQP_Contra_Udec'],  
                               'RBR_EQP_Contra_Otro' => $request['RBR_EQP_Contra_Otro'],  
                               'RBR_EQP_Total' => $request['RBR_EQP_Total'],  
                               'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],                  
                             
           
                           ]);
                           $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                           if($commit == null){
           
                           Commits::create([
                               'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                               'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                               'FK_User_Codigo' => $id,
                               'CMMT_Commit' => $request['CMMT_Commit'],
                               'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                               'CMMT_Formato' => $request['CMMT_Formato']
                           ]);
                           $id_name=$user->name." ".$user->lastname;
                        $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                        $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                           }
                       return AjaxResponse::success(
                           '¡Esta Hecho!',
                           'Datos Creados.'
                       );
                     
                  
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
               public function EditarRubroEquipos(Request $request)
               {
                   if ($request->ajax() && $request->isMethod('POST')) {
                       
                       $RubroEquipos = RubroEquipos::where('PK_RBR_Equipo',$request['PK_RBR_Equipo'])->first();
           
                       $RubroEquipos -> RBR_EQP_Descripcion = $request['RBR_EQP_EDITAR_Descripcion'];
                       $RubroEquipos -> RBR_EQP_Lab = $request['RBR_EQP_EDITAR_Lab'];
                       $RubroEquipos -> RBR_EQP_Actividades = $request['RBR_EQP_EDITAR_Actividades'];
                       $RubroEquipos -> RBR_EQP_Justificacion = $request['RBR_EQP_EDITAR_Justificacion'];
                       $RubroEquipos -> RBR_EQP_Cantidad = $request['RBR_EQP_EDITAR_Cantidad'];
                       $RubroEquipos -> RBR_EQP_Val = $request['RBR_EQP_EDITAR_Val'];
                       $RubroEquipos -> RBR_EQP_Solicitado = $request['RBR_EQP_EDITAR_Solicitado'];
                       $RubroEquipos -> RBR_EQP_Contra_Udec = $request['RBR_EQP_EDITAR_Contra_Udec'];
                       $RubroEquipos -> RBR_EQP_Contra_Otro = $request['RBR_EQP_EDITAR_Contra_Otro'];
                       $RubroEquipos -> RBR_EQP_Total = $request['RBR_EQP_EDITAR_Total'];
                       
                       $RubroEquipos -> save();
           
                       return AjaxResponse::success(
                           '¡Esta Hecho!',
                           'Datos Modificados.'
                       );
                     
                  
                       }              
                   
               }
           
           
               //
           
       
               //CRUD RUBRO MATERIAL
               public function RubroMaterialDelete(Request $request, $id)
               {
                   if ($request->ajax() && $request->isMethod('DELETE')) {	
                       
                       
                       $RubroMaterial = RubroMaterial::where('PK_RBR_Material',$id)->first();
                       
                       $RubroMaterial -> delete();
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
           
           
               public function RubroMaterialStore(Request $request)
               {
                   if ($request->ajax() && $request->isMethod('POST')) {
                       
                    $user = Auth::user();
                    $id = $user->identity_no;
                    RubroMaterial::create([
                               'RBR_MTL_Descripcion'=>$request['RBR_MTL_Descripcion'],
                               'RBR_MTL_Justificacion'=>$request['RBR_MTL_Justificacion'],
                               'RBR_MTL_Cantidad'=>$request['RBR_MTL_Cantidad'],    
                               'RBR_MTL_Val' => $request['RBR_MTL_Val'],  
                               'RBR_MTL_Solicitado_Udec' => $request['RBR_MTL_Solicitado_Udec'],
                               'RBR_MTL_Contra_Udec'=>$request['RBR_MTL_Contra_Udec'],
                               'RBR_MTL_Contra_Otro'=>$request['RBR_MTL_Contra_Otro'],    
                               'RBR_MTL_Total' => $request['RBR_MTL_Total'],  
                               'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],                  
                             
           
                           ]);
                           $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                           if($commit == null){
           
                           Commits::create([
                               'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                               'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                               'FK_User_Codigo' => $id,
                               'CMMT_Commit' => $request['CMMT_Commit'],
                               'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                               'CMMT_Formato' => $request['CMMT_Formato']
                           ]);
                           $id_name=$user->name." ".$user->lastname;
                        $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                        $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                           }
                       return AjaxResponse::success(
                           '¡Esta Hecho!',
                           'Datos Creados.'
                       );
                     
                  
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
               public function EditarRubroMaterial(Request $request)
               {
                   if ($request->ajax() && $request->isMethod('POST')) {
                       
                       $RubroMaterial = RubroMaterial::where('PK_RBR_Material',$request['PK_RBR_Material'])->first();
           
                       $RubroMaterial -> RBR_MTL_Descripcion = $request['RBR_MTL_EDITAR_Descripcion'];
                       $RubroMaterial -> RBR_MTL_Justificacion = $request['RBR_MTL_EDITAR_Justificacion'];
                       $RubroMaterial -> RBR_MTL_Cantidad = $request['RBR_MTL_EDITAR_Cantidad'];
                       $RubroMaterial -> RBR_MTL_Val = $request['RBR_MTL_EDITAR_Val'];
                       $RubroMaterial -> RBR_MTL_Solicitado_Udec = $request['RBR_MTL_EDITAR_Solicitado_Udec'];
                       $RubroMaterial -> RBR_MTL_Contra_Udec = $request['RBR_MTL_EDITAR_Contra_Udec'];
                       $RubroMaterial -> RBR_MTL_Contra_Otro = $request['RBR_MTL_EDITAR_Contra_Otro'];
                       $RubroMaterial -> RBR_MTL_Total = $request['RBR_MTL_EDITAR_Total'];
                       
                       $RubroMaterial -> save();
           
                       return AjaxResponse::success(
                           '¡Esta Hecho!',
                           'Datos Modificados.'
                       );
                     
                  
                       }              
                   
               }
           
           
               //
           
               //CRUD RUBRO TECNOLOGICO
               public function RubroTecnologicoDelete(Request $request, $id)
               {
                   if ($request->ajax() && $request->isMethod('DELETE')) {	
                       
                       
                       $RubroTecnologico = RubroTecnologico::where('PK_RBR_Tecnologico',$id)->first();
                       
                       $RubroTecnologico -> delete();
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
           
           
               public function RubroTecnologicoStore(Request $request)
               {
                   if ($request->ajax() && $request->isMethod('POST')) {
                       
                    $user = Auth::user();
                    $id = $user->identity_no;
                    RubroTecnologico::create([
                               'RBR_TEC_Descripcion'=>$request['RBR_TEC_Descripcion'],
                               'RBR_TEC_Justificacion'=>$request['RBR_TEC_Justificacion'],
                               'RBR_TEC_Val'=>$request['RBR_TEC_Val'],    
                               'RBR_TEC_Entidad' => $request['RBR_TEC_Entidad'],  
                               'RBR_TEC_Solicitado_Udec' => $request['RBR_TEC_Solicitado_Udec'],
                               'RBR_TEC_Contra_Udec'=>$request['RBR_TEC_Contra_Udec'],
                               'RBR_TEC_Contra_Otro'=>$request['RBR_TEC_Contra_Otro'],    
                               'RBR_TEC_Total' => $request['RBR_TEC_Total'],  
                               'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],                  
                             
           
                           ]);
                           $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                           if($commit == null){
           
                           Commits::create([
                               'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                               'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                               'FK_User_Codigo' => $id,
                               'CMMT_Commit' => $request['CMMT_Commit'],
                               'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                               'CMMT_Formato' => $request['CMMT_Formato']
                           ]);
                           $id_name=$user->name." ".$user->lastname;
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                           }
                       return AjaxResponse::success(
                           '¡Esta Hecho!',
                           'Datos Creados.'
                       );
                     
                  
                       }              
                   
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
               public function EditarRubroTecnologico(Request $request)
               {
                   if ($request->ajax() && $request->isMethod('POST')) {
                       
                       $RubroTecnologico = RubroTecnologico::where('PK_RBR_Tecnologico',$request['PK_RBR_Tecnologico'])->first();
           
                       $RubroTecnologico -> RBR_TEC_Descripcion = $request['RBR_TEC_EDITAR_Descripcion'];
                       $RubroTecnologico -> RBR_TEC_Justificacion = $request['RBR_TEC_EDITAR_Justificacion'];
                       $RubroTecnologico -> RBR_TEC_Val = $request['RBR_TEC_EDITAR_Val'];
                       $RubroTecnologico -> RBR_TEC_Entidad = $request['RBR_TEC_EDITAR_Entidad'];
                       $RubroTecnologico -> RBR_TEC_Solicitado_Udec = $request['RBR_TEC_EDITAR_Solicitado_Udec'];
                       $RubroTecnologico -> RBR_TEC_Contra_Udec = $request['RBR_TEC_EDITAR_Contra_Udec'];
                       $RubroTecnologico -> RBR_TEC_Contra_Otro = $request['RBR_TEC_EDITAR_Contra_Otro'];
                       $RubroTecnologico -> RBR_TEC_Total = $request['RBR_TEC_EDITAR_Total'];
                       
                       $RubroTecnologico -> save();
           
                       return AjaxResponse::success(
                           '¡Esta Hecho!',
                           'Datos Modificados.'
                       );
                     
                  
                       }              
                   
               }
           
           
               //
               //CRUD FUNCION requerimientoos 
        public function FuncionDelete(Request $request, $id)
        {
            if ($request->ajax() && $request->isMethod('DELETE')) {	
                
                
                $Funcion = Funciones::where('PK_Id_Funcion',$id)->first();
                
                $Funcion -> delete();
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
        public function NoFuncionDelete(Request $request, $id)
        {
            if ($request->ajax() && $request->isMethod('DELETE')) {	
                
                
                $Funcion = NoFunciones::where('PK_Id_No_Funcion',$id)->first();
                
                $Funcion -> delete();
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
    
    //funcion para llenar la tabla de funcion de requerimientos del MCT//
        public function FuncionStore(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                
                $user = Auth::user();
                $id = $user->identity_no;
                    Funciones::create([
                        'MCT_Funcion_Nombre'=>$request['MCT_Funcion_Nombre'],
                        'MCT_Funcion_Funcion'=>$request['MCT_Funcion_Funcion'], 
                        'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],                  
    
                    ]);
                    $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                    if($commit == null){
                        Commits::create([
                            'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                            'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                            'FK_User_Codigo' => $id,
                            'CMMT_Commit' => $request['CMMT_Commit'],
                            'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                            'CMMT_Formato' => $request['CMMT_Formato']
                        ]);
                        $id_name=$user->name." ".$user->lastname;
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                    }
                    
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Creados.'
                );
              
           
                }              
            
        }
         //funcion para llenar la tabla de no funcionales de requerimientos del MCT//
         public function NoFuncionStore(Request $request)
         {
             if ($request->ajax() && $request->isMethod('POST')) {
                 
                 $user = Auth::user();
                 $id = $user->identity_no;
                     NoFunciones::create([
                         'MCT_No_Funcion_Nombre'=>$request['MCT_Funcion_Nombre'],
                         'MCT_No_Funcion_Funcion'=>$request['MCT_Funcion_Funcion'], 
                         'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],                  
     
                     ]);
                     $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                     if($commit == null){
                         Commits::create([
                             'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                             'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                             'FK_User_Codigo' => $id,
                             'CMMT_Commit' => $request['CMMT_Commit'],
                             'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                             'CMMT_Formato' => $request['CMMT_Formato']
                         ]);
                         $id_name=$user->name." ".$user->lastname;
                     $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                     $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                         $data = array(
                             'correo'=>$predi->relacionPredirectores->User_Correo ,
                             'Actividad'=>$act->MCT_Actividad,
                             'usuario'=>$id_name,
                         );
             
                         Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                             
                             $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
             
                             $message->to($data['correo']);
             
                         });
                     }
                     
                 return AjaxResponse::success(
                     '¡Esta Hecho!',
                     'Datos Creados.'
                 );
               
            
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
        public function NoFuncion(Request $request,$id)
        {
            if ($request->ajax() && $request->isMethod('GET')) {
    
                    $Funciones = NoFunciones::where('FK_NPRY_IdMctr008', $id)->get();
                    return DataTables::of($Funciones)
                   ->removeColumn('created_at')
                   ->removeColumn('updated_at')
                    
                   ->addIndexColumn()
                   ->make(true);
            }
        }
        public function EditarFuncion(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                
                $Funcion = Funciones::where('PK_Id_Funcion',$request['PK_Id_Funcion'])->first();
    
                $Funcion -> MCT_Funcion_Nombre = $request['MCT_EDITAR_Funcion_Nombre'];
                $Funcion -> MCT_Funcion_Funcion = $request['MCT_EDITAR_Funcion_Funcion'];
                $Funcion -> save();
    
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Modificados.'
                );
              
           
                }              
            
        }
        public function EditarNoFuncion(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                
                $Funcion = NoFunciones::where('PK_Id_No_Funcion',$request['PK_Id_No_Funcion'])->first();
    
                $Funcion -> MCT_No_Funcion_Nombre = $request['MCT_EDITAR_No_Funcion_Nombre'];
                $Funcion -> MCT_No_Funcion_Funcion = $request['MCT_EDITAR_No_Funcion_Funcion'];
                $Funcion -> save();
    
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Modificados.'
                );
              
           
                }              
            
        }
    
    
        //
    
    //CRUD Resultados
 
    public function ResultadoDelete(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {	
            
            
            $resultado = Resultados::where('PK_Id_Resultados',$id)->first();
            
            $resultado -> delete();
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


    public function ResultadoStore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = Auth::user();
		$id = $user->identity_no;
          
                Resultados::create([
                    'MCT_Resultado'=>$request['MCT_Resultado'],
                    'MCT_Producto_Esperado'=>$request['MCT_Producto_Esperado'],
                    'MCT_Indicador'=>$request['MCT_Indicador'],    
                    'MCT_Beneficiario'=>$request['MCT_Beneficiario'],
                    'MCT_Categoria'=>$request['MCT_Categoria'],    
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],          

                ]);
                $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                if($commit == null){

                    Commits::create([
                        'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                        'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                        'FK_User_Codigo' => $id,
                        'CMMT_Commit' => $request['CMMT_Commit'],
                        'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                        'CMMT_Formato' => $request['CMMT_Formato']
                    ]);
                    $id_name=$user->name." ".$user->lastname;
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                }
            return AjaxResponse::success(
                '¡Esta Hecho!',
                'Datos Creados.'
            );
          
       
            }              
        
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
    //
    //funcion que muestra la informacion en la tabla de bancos de proyecto
    public function BancoProyectosList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

             $Anteproyectos = Anteproyecto::all();
             $i=0;
             $concatenado=[];
             foreach($Anteproyectos as $Anteproyecto){
             
             $Proyecto = Proyecto::where('FK_NPRY_IdMctr008', $Anteproyecto -> PK_NPRY_IdMctr008)->where('FK_EST_Id',4)->first();
             
             if($Proyecto != null){
                $collection = collect([]);
                    
                $collection->put('Codigo',$Anteproyecto->  PK_NPRY_IdMctr008);
                $collection->put('Titulo',$Anteproyecto->  NPRY_Titulo);
                $collection->put('Palabras',$Anteproyecto->  NPRY_Keywords);
                $Nombre = $Anteproyecto -> relacionPredirectores -> User_Nombre1;
                $Apellido = $Anteproyecto -> relacionPredirectores -> User_Apellido1;
                $total = $Nombre." ".$Apellido;
                $collection->put('Director',$total);
                $collection->put('Descripcion',$Anteproyecto->  NPRY_Descripcion);
                
                

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
    }
    
    //funcion para crear una solicitud como estudiante
    public function SolicitudStore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = Auth::user();
		$id = $user->identity_no;
            $Desarrollador = Desarrolladores::where('FK_User_Codigo',$id)->first();
            
           // $Anteproyecto = Anteproyecto::where('K_NPRY_IdMctr008', $Desarrollador -> FK_NPRY_IdMctr008)->first();
            Solicitud::create([
                'Sol_Solicitud' => $request['Sol_Solicitud'],
                'Sol_Estado' => "EN ESPERA",
                'FK_NPRY_IdMctr008' => $Desarrollador -> FK_NPRY_IdMctr008,
                'FK_User_Codigo' =>$id,
            ]);
            return AjaxResponse::success(
                '¡Esta Hecho!',
                'Solicitud Hecha.'
            );
          
        }
    }
    //funcion que carga los proyectos en la lista de bancos
    public function BancoAnteProyectosList(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

             $Anteproyectos = Anteproyecto::Where('FK_NPRY_Estado',1)->get();
             $i=0;
             $concatenado=[];
             foreach($Anteproyectos as $Anteproyecto){
             
           
                $collection = collect([]);
                    
                $collection->put('Codigo',$Anteproyecto->  PK_NPRY_IdMctr008);
                $collection->put('Titulo',$Anteproyecto->  NPRY_Titulo);
                $collection->put('Palabras',$Anteproyecto->  NPRY_Keywords);
                $Nombre = $Anteproyecto -> relacionPredirectores -> User_Nombre1;
                $Apellido = $Anteproyecto -> relacionPredirectores -> User_Apellido1;
                $total = $Nombre." ".$Apellido;
                $collection->put('Director',$total);
                $collection->put('Descripcion',$Anteproyecto->  NPRY_Descripcion);
                
                

                $concatenado[$i]= $collection;

                $i=$i+1;
             
            }
             return DataTables::of($concatenado)
               ->removeColumn('created_at')
			   ->removeColumn('updated_at')
			    
			   ->addIndexColumn()
               ->make(true);
        }
    }
    
    //editar en la tabla resultados
    public function EditarResultado(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
            $resultado = Resultados::where('PK_Id_Resultados',$request['PK_Id_Resultados'])->first();

            $resultado -> MCT_Resultado = $request['MCT_EDITAR_Resultado'];
            $resultado -> MCT_Producto_Esperado = $request['MCT_EDITAR_Producto_Esperado'];
            $resultado -> MCT_Indicador = $request['MCT_EDITAR_Indicador'];
            $resultado -> MCT_Beneficiario = $request['MCT_EDITAR_Beneficiario'];
            $resultado -> MCT_Categoria = $request['MCT_EDITAR_Categoria'];
            
            $resultado -> save();

            return AjaxResponse::success(
                '¡Esta Hecho!',
                'Datos Modificados.'
            );
          
       
            }              
        
    }


    //funcion que carga los comentarios hechos por el director y estudiantes en las actvidades asignadas
    
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
    //funcion que carga los detalles de persona la tabla 
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
    //CRUD FINANCIACION
    public function EditarFinanciacion(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
            $financiacion = Financiacion::where('PK_Id_Financiacion',$request['PK_Id_Financiacion'])->first();

            $financiacion -> MCT_Financiacion = $request['MCT_EDITAR_Financiacion'];
            $financiacion -> MCT_Fuente = $request['MCT_EDITAR_Fuente'];
            $financiacion -> MCT_Valor_Aportado = $request['MCT_EDITAR_Valor_Aportado'];
            $financiacion -> save();

            return AjaxResponse::success(
                '¡Esta Hecho!',
                'Datos Modificados.'
            );
          
       
            }              
        
    }
  
    public function FinanciacionStore(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $user = Auth::user();
		$id = $user->identity_no;
          
                Financiacion::create([
                    'MCT_Financiacion'=>$request['MCT_Financiacion'],
                    'MCT_Fuente'=>$request['MCT_Fuente'],
                    'MCT_Valor_Aportado'=>$request['MCT_Valor_Aportado'],    
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],          

                ]);
                $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                if($commit == null){

                Commits::create([
                    'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                    'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                    'FK_User_Codigo' => $id,
                    'CMMT_Commit' => $request['CMMT_Commit'],
                    'FK_CHK_Checklist' => $request['FK_CHK_Checklist'],
                    'CMMT_Formato' => $request['CMMT_Formato']
                ]);
                $id_name=$user->name." ".$user->lastname;
                    $predi = Anteproyecto::where('PK_NPRY_IdMctr008', $request['FK_NPRY_IdMctr008'])->first();
                    $act = Mctr008::where('PK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                        $data = array(
                            'correo'=>$predi->relacionPredirectores->User_Correo ,
                            'Actividad'=>$act->MCT_Actividad,
                            'usuario'=>$id_name,
                        );
            
                        Mail::send('gesap.Emails.SubirAct',$data, function($message) use ($data){
                            
                            $message->from('no-reply@ucundinamarca.edu.co', 'GESAP');
            
                            $message->to($data['correo']);
            
                        });
                }
                return AjaxResponse::success(
                '¡Esta Hecho!',
                'Datos Creados.'
            );
          
       
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
    //
    //funcion apra cargar los proyectos al estduiante
    public function ListaProyecto(Request $request,$idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $user = Auth::user();
            $id = $user->identity_no;

            $Anteproyecto = Desarrolladores::where('FK_User_Codigo',$id)->get(); 
            $i = 0 ;
            $concatenado=[];
       
                foreach($Anteproyecto as $Ante){

                    if($Ante->relacionAnteproyecto->relacionEstado->EST_Estado == "APROBADO"){

                        $Proyecto = Proyecto::where('FK_NPRY_IdMctr008',$Ante->FK_NPRY_IdMctr008 )->first(); 
                        $collection = collect([]);
                        $collection->put('Titulo',$Proyecto -> relacionAnteproyecto -> NPRY_Titulo  );
                        $collection->put('Palabras',$Proyecto -> relacionAnteproyecto ->  NPRY_Keywords );                
                        $collection->put('Des',$Proyecto ->  relacionAnteproyecto ->  NPRY_Descripcion);
                        $collection->put('Duracion',$Proyecto -> relacionAnteproyecto ->  NPRY_Duracion  );                
                        $collection->put('Estado',$Proyecto -> relacionEstado -> EST_Estado  );
                        $collection->put('Fecha',$Proyecto -> PYT_Fecha_Radicacion  );                              
                        $collection->put('Codigo',$Proyecto -> FK_NPRY_IdMctr008  );  
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
    }
    
    
//funcion que redirecciona a la vista para ver las actividades del proyecto
    public function VerActividadesProyecto(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
            $Anteproyecto = $id;

            return view($this->path .'.Proyecto.ActividadesEstudianteProyecto',
            [
                'Anteproyecto' => $Anteproyecto,
            ]);
           
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );  
             
        }              
    }
    //funcion que retorna los proyectos al estudiante
    public function AnteproyectoList(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $user = Auth::user();
            $id = $user->identity_no;
            $i=0;
            $Desarrollos=Desarrolladores::where('FK_User_Codigo', $id)->get();
            $concatenado=[];
            foreach($Desarrollos as $Desarrollo){
                
                if($Desarrollo -> relacionAnteproyecto->FK_NPRY_Estado != 1 && $Desarrollo -> relacionAnteproyecto->FK_NPRY_Estado != 7 ){
                    $collection = collect([]);
                    $collection->put('Titulo',$Desarrollo -> relacionAnteproyecto-> NPRY_Titulo);
                    $collection->put('Palabras',$Desarrollo -> relacionAnteproyecto->NPRY_Keywords);
                    $collection->put('Des',$Desarrollo -> relacionAnteproyecto->NPRY_Descripcion);
                    $collection->put('Duracion',$Desarrollo -> relacionAnteproyecto-> NPRY_Duracion);
                    $collection->put('Estado',$Desarrollo -> relacionAnteproyecto->relacionEstado->EST_Estado );
                    $collection->put('Fecha',$Desarrollo -> relacionAnteproyecto->NPRY_FCH_Radicacion);
                    $collection->put('Codigo',$Desarrollo -> relacionAnteproyecto->PK_NPRY_IdMctr008);

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
}
