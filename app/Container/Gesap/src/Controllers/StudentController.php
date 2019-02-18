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

use App\Container\Gesap\src\Anteproyecto;
use App\Container\Gesap\src\Proyecto;
use App\Container\Gesap\src\Actividad;
use App\Container\Gesap\src\Radicacion;
use App\Container\Gesap\src\Encargados;
use App\Container\Gesap\src\Usuarios;
use App\Container\Gesap\src\Cronograma;
use App\Container\Gesap\src\Resultados;
use App\Container\Gesap\src\Funciones;
use App\Container\Gesap\src\Financiacion;
use App\Container\Gesap\src\PersonaMct;
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
            $requerimientos = Mctr008::where('FK_Id_Formato',2)->get();
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
    public function PersonaDatos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            
          
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
                        'MCT_Detalles_Numero_meses'=>$request['MCT_Detalles_Numero_meses'],
                        'MCT_Detalles_Tipo_vinculacion'=>$request['MCT_Detalles_Tipo_vinculacion'],
                        'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
              

                ]);
                $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                if($commit == null){

                Commits::create([
                'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                 'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                 'FK_User_Codigo' => $request['FK_User_Codigo'],
                 'CMMT_Commit' => $request['CMMT_Commit'],
                 'FK_CHK_Checklist' => $request['FK_CHK_Checklist']
                ]);
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
            $persona -> MCT_Detalles_Numero_meses = $request['MCT_EDITAR_Detalles_Numero_meses'];
            $persona -> MCT_Detalles_Tipo_vinculacion = $request['MCT_EDITAR_Detalles_Tipo_vinculacion'];
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
    public function SubirActividad(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',1)->get();
                    
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
    public function SubirRequerimiento(Request $request, $id, $idp)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $Actividad = Mctr008::where('PK_MCT_IdMctr008', $id)->where('FK_Id_Formato',2)->get();
                    
            $Actividad->offsetSet('Anteproyecto', $idp);

            $commit = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->get();
            $commit2 = Commits::where('FK_NPRY_Idmctr008',$idp)->where('FK_MCT_IdMctr008',$id)->first();
            if($commit2 == null)
            {
                $Actividad->offsetSet('Commit', "Aún NO se ha hecho ningun cambio a esta Requerimiento.");
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
    
    
        public function CronogramaStore(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                
              
                    Cronograma::create([
                        'MCT_CRN_Actividad'=>$request['MCT_CRN_Actividad'],
                        'MCT_CRN_Semana_inicio'=>$request['MCT_CRN_Semana_inicio'],
                        'MCT_CRN_Semana_fin'=>$request['MCT_CRN_Semana_fin'],    
                        'MCT_CRN_Responsable' => $request['MCT_CRN_Responsable'],  
                        'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],                  
    
                    ]);
                    $commit  = Commits::where('FK_NPRY_IdMctr008',$request['FK_NPRY_IdMctr008'])->where('FK_MCT_IdMctr008',$request['FK_MCT_IdMctr008'])->first();
                    if($commit == null){
    
                    Commits::create([
                        'FK_NPRY_IdMctr008' => $request['FK_NPRY_IdMctr008'],
                        'FK_MCT_IdMctr008' => $request['FK_MCT_IdMctr008'],
                        'FK_User_Codigo' => $request['FK_User_Codigo'],
                        'CMMT_Commit' => $request['CMMT_Commit'],
                        'FK_CHK_Checklist' => $request['FK_CHK_Checklist']
                    ]);
                    }
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Creados.'
                );
              
           
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
        public function EditarCronograma(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                
                $Cronograma = Cronograma::where('PK_Id_Cronograma',$request['PK_Id_Cronograma'])->first();
    
                $Cronograma -> MCT_CRN_Actividad = $request['MCT_EDITAR_CRN_Actividad'];
                $Cronograma -> MCT_CRN_Semana_inicio = $request['MCT_EDITAR_CRN_Semana_inicio'];
                $Cronograma -> MCT_CRN_Semana_fin = $request['MCT_EDITAR_CRN_Semana_fin'];
                $Cronograma -> MCT_CRN_Responsable = $request['MCT_EDITAR_CRN_Responsable'];
                
                $Cronograma -> save();
    
                return AjaxResponse::success(
                    '¡Esta Hecho!',
                    'Datos Modificados.'
                );
              
           
                }              
            
        }
    
    
        //
    
    //Resultados
        //cronograma
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
    
    
        public function FuncionStore(Request $request)
        {
            if ($request->ajax() && $request->isMethod('POST')) {
                
              
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
                            'FK_User_Codigo' => $request['FK_User_Codigo'],
                            'CMMT_Commit' => $request['CMMT_Commit'],
                            'FK_CHK_Checklist' => $request['FK_CHK_Checklist']
                        ]);
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
    
    
        //
    
    //Resultados
 
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
                        'FK_User_Codigo' => $request['FK_User_Codigo'],
                        'CMMT_Commit' => $request['CMMT_Commit'],
                        'FK_CHK_Checklist' => $request['FK_CHK_Checklist']
                    ]);
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


    //
    
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
                    'FK_User_Codigo' => $request['FK_User_Codigo'],
                    'CMMT_Commit' => $request['CMMT_Commit'],
                    'FK_CHK_Checklist' => $request['FK_CHK_Checklist']
                ]);
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
    
    public function AnteproyectoList(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $user = Auth::user();
		
       

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
