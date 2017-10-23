<?php

namespace App\Container\Unvinteraction\src\Controllers;



use App\Container\Unvinteraction\src\TBL_Usuarios;
use App\Container\Unvinteraction\src\TBL_Tipo_Pregunta;
use App\Container\Unvinteraction\src\TBL_Estado_Usuario;
use App\Container\Unvinteraction\src\TBL_Carrera;
use App\Container\Unvinteraction\src\TBL_Facultad;
use App\Container\Unvinteraction\src\TBL_Documentacion;
use App\Container\Unvinteraction\src\TBL_Convenios;
use App\Container\Unvinteraction\src\TBL_Evaluacion;
use App\Container\Unvinteraction\src\TBL_Evaluacion_Preguntas;
use App\Container\Unvinteraction\src\TBL_Preguntas;
use App\Container\Unvinteraction\src\TBL_Sede;
use App\Container\Unvinteraction\src\TBL_Estado;
use App\Container\Unvinteraction\src\TBL_Empresas_Participantes;
use App\Container\Unvinteraction\src\TBL_Empresa;
use App\Container\Unvinteraction\src\TBL_Participantes;
use App\Container\Unvinteraction\src\TBL_Documentacion_Extra;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;

class Controller_Evaluaciones extends Controller
{
     private $path='unvinteraction';
    //__________________EVALUACIONES___________
    public function Tipo_Pregunta()
    {
        
       return view($this->path.'.listar_Tipo_Pregunta');
    }
    public function Tipo_Pregunta_Ajax()
    {
        
       return view($this->path.'.listar_Tipo_Pregunta_Ajax');
    }
     public function Agregar_Tipo_Pregunta(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $Tipo = new TBL_Tipo_Pregunta();
           $Tipo->Tipo= $request->Tipo;
            $Tipo->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'tipo de Pregunta agregada correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
     public function Listar_Tipo_Pregunta()
    {
      $Pregunta = TBL_Tipo_Pregunta::all(); 
         return Datatables::of( $Pregunta)->addIndexColumn()->make(true); 
       
    }
    public function Editar_Tipo_Pregunta($id)
    {
      $Pregunta = TBL_Tipo_Pregunta::findOrFail($id);; 
        return view($this->path.'.Editar_Tipo_Pregunta', compact('Pregunta'));
       
    }
    public function Modificar_Tipo_Pregunta(Request $request,$id)
    {
      if($request->ajax() && $request->isMethod('POST'))
        {
        $Pregunta= TBL_Tipo_Pregunta::findOrFail($id);
        $Pregunta->Tipo=$request->Tipo;
        
        $Pregunta->save();
             
        return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
       
    }
    public function Pregunta()
    {
        $Pregunta = TBL_Tipo_Pregunta::select('PK_Tipo_Pregunta','Tipo')->pluck('Tipo','PK_Tipo_Pregunta')
                ->toArray();  
       
       return view($this->path.'.listar_Pregunta',compact('Pregunta'));
      
    }public function Pregunta_Ajax()
    {
       $Pregunta = TBL_Tipo_Pregunta::select('PK_Tipo_Pregunta','Tipo')->pluck('Tipo','PK_Tipo_Pregunta')
                ->toArray();  
       return view($this->path.'.listar_Pregunta_Ajax',compact('Pregunta'));
      
    }
     public function Agregar_Pregunta(Request $request)
    {
         $Pregunta = TBL_Tipo_Pregunta::all(); 
        if($request->ajax() && $request->isMethod('POST'))
        {
            $Tipo = new TBL_Preguntas();
            $Tipo->Enunciado= $request->Enunciado;
            $Tipo->FK_TBL_Tipo_Pregunta= $request->FK_TBL_Tipo_Pregunta;
            $Tipo->save();
          return AjaxResponse::success(
                '¡Bien hecho!',
                'pregunta agregada correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
     public function Listar_Pregunta()
    {
      $Pregunta = TBL_Preguntas::join('TBL_Tipo_Pregunta','TBL_Tipo_Pregunta.PK_Tipo_Pregunta','=','TBL_Preguntas.FK_TBL_Tipo_Pregunta')
             ->select('TBL_Preguntas.PK_Preguntas','TBL_Preguntas.Enunciado','TBL_Tipo_pregunta.Tipo')
             ->get();  
         return Datatables::of( $Pregunta)->addIndexColumn()->make(true);
        
       
    }
    public function Editar_Pregunta($id)
    {
        $Pregunta = TBL_Preguntas::findOrFail($id);
        $Pregunta1 = TBL_Tipo_Pregunta::select('PK_Tipo_Pregunta','Tipo')->pluck('Tipo','PK_Tipo_Pregunta')
                ->toArray();  
        return view($this->path.'.Editar_Pregunta', compact('Pregunta','Pregunta1'));
       
    }
    public function Modificar_Pregunta(Request $request,$id)
    {
         if($request->ajax() && $request->isMethod('POST'))
        {
        $Pregunta= TBL_Preguntas::findOrFail($id);
        $Pregunta->Enunciado=$request->Enunciado;
        $Pregunta->FK_TBL_Tipo_Pregunta =$request->FK_TBL_Tipo_Pregunta;
        $Pregunta->save();
             
        return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
       
    }
     public function Evaluaciones()
    {
        
         return view($this->path.'.listar_Evaluaciones');
       
    }
    public function Listar_Evaluaciones_Empresas()
    {
       $Evaluacion=TBL_Evaluacion::join('TBL_Empresa','TBL_Empresa.PK_Empresa','=','TBL_Evaluacion.Evaluado')
           ->join('developer.users','users.identity_no','=','TBL_Evaluacion.Evaluador')
           ->join('TBL_Convenios','TBL_Convenios.PK_Convenios','=','TBL_Evaluacion.FK_TBL_Convenios')
             ->select('users.name','users.lastname','TBL_Evaluacion.PK_Evaluacion','TBL_Empresa.Nombre_Empresa','TBL_Evaluacion.Nota_Final','TBL_Convenios.Nombre')->where('TBL_Evaluacion.Tipo_Evaluacion',1)
             ->get();  
         
       return Datatables::of($Evaluacion)->addIndexColumn()->make(true);
        
    }
     public function Listar_Evaluaciones_Usuarios()
    {
       $Evaluacion=TBL_Evaluacion::join('developer.users','users.identity_no','=','TBL_Evaluacion.Evaluado')
         
           ->join('TBL_Convenios','TBL_Convenios.PK_Convenios','=','TBL_Evaluacion.FK_TBL_Convenios')
             ->select('users.name','users.lastname','TBL_Evaluacion.PK_Evaluacion','TBL_Evaluacion.Nota_Final','TBL_Convenios.Nombre')->where('TBL_Evaluacion.Tipo_Evaluacion',2)
             ->get();  
         
       return Datatables::of( $Evaluacion)->addIndexColumn()->make(true);
        
    }
     public function Realizar_Evaluacion(Request $request,$id,$convenio)
    {
         $tipo=0;
         $decicion=1;
         $decicion2=1;
         $rol= DB::table('role_user')->join('developer.users','users.id','=','role_user.user_id')
             ->join('developer.roles','roles.id','=','role_user.role_id')->select('roles.name')->where('users.identity_no',$id)->get();
         $rol2= DB::table('role_user')->join('developer.users','users.id','=','role_user.user_id')
             ->join('developer.roles','roles.id','=','role_user.role_id')->select('roles.name')->where('users.identity_no',$request->user()->identity_no)->get();
         
         foreach($rol as $Rol){
             switch($Rol->name){
                 case 'Pasante_uni': 
                     $decicion=1;
                     break;
                 case 'Empresario_uni':
                      $decicion=2;
                     break;
                case 'Coordinador_uni':
                      $decicion=1;
                break;

             }
        }
         foreach($rol2 as $Rol2){
              switch($Rol2->name){
                 case 'Coordinador_uni': 
                     $decicion2=1;
                     break;
                 case 'Empresario_uni':
                      $decicion2=2;
                     break;

             }
        }
        if( $decicion2==1  and  $decicion==1){
             $tipo=1;
          
         }
        if( $decicion2==2 and  $decicion==1){
             $tipo=4;
            
         }
         if( $decicion2==1 and  $decicion==2){
              $tipo=2;
           
          }
        if( $decicion2==2 and  $decicion==2){
                         $tipo=4;
               
             }
             
         $Pregunta= TBL_Preguntas::where('FK_TBL_Tipo_Pregunta',$tipo)->get();
         $N= TBL_Preguntas::where('FK_TBL_Tipo_Pregunta',$tipo)->count();
        return view($this->path.'.Realizar_Evaluacion',compact('Pregunta','id','N','convenio'));
      
    }
    public function Registrar_Evaluacion(Request $request,$n,$id,$convenio)
    {
        $carbon = new \Carbon\Carbon();
       try{
            $Evaluacion = new TBL_Evaluacion();
            $Evaluacion->Evaluador = $request->user()->identity_no;
            $Evaluacion->Evaluado = $id;
            $Evaluacion->FK_TBL_Convenios= $convenio;
            $Evaluacion->Tipo_Evaluacion= 2;
            $Evaluacion->Nota_Final= 0;
            $Evaluacion->Fecha= $carbon->now()->format('y-m-d');
            $Evaluacion->save();
        //saber que evaluacion es    
           $id_Evaluacion=$Evaluacion->PK_Evaluacion;
            $Nota_Final=0.000;
            for($i=1;$i<=$n;$i++){
               
                $IDpregunta="Pregunta_".$i;
                $IDrespuesta='Respuesta_'.$request->$IDpregunta;
                $resultado= new TBL_Evaluacion_Preguntas();
                $resultado->Puntuacion=$request->$IDrespuesta;
                $resultado->FK_TBL_Evaluacion=$id_Evaluacion;
                $resultado->FK_TBL_Preguntas=$request->$IDpregunta;
                $resultado->save();
                $Nota_Final= $Nota_Final + $request->$IDrespuesta;
          
           }
           $Nota_Final=$Nota_Final / $n;
           
        $evaluacion= TBL_Evaluacion::findOrFail($id_Evaluacion);
        $evaluacion->Nota_Final =$Nota_Final;
        $evaluacion->save();
           
            
             return view('unvinteraction.listar_Mis_Convenios');
            
        }catch(Exception $e){
            return "Fatal error - ".$e->getMessage();
        }
       
    }
    
    public function Realizar_Evaluacion_Empresa(Request $request,$id,$convenio)
    {
         $tipo=0;
         $id2=$request->user()->identity_no;
         
         
         $rol2= DB::table('role_user')->join('developer.users','users.id','=','role_user.user_id')
             ->join('developer.roles','roles.id','=','role_user.role_id')->select('roles.name')->where('users.identity_no',$id2)->get();
        
         foreach($rol2 as $Rol2){
              switch($Rol2->name){
                 case 'Coordinador_uni': 
                     $decision2=1;
                     break;
                 case 'Pasante_uni':
                      $decision2=2;
                     break;
             }
        }
         
         if( $decision2==1){
             $tipo=2;
         }
        if( $decision2==2){
             $tipo=3;
        }
        $Pregunta= TBL_Preguntas::where('FK_TBL_Tipo_Pregunta',$tipo)->get();
        $N= TBL_Preguntas::where('FK_TBL_Tipo_Pregunta',$tipo)->count();
        return view($this->path.'.Realizar_Evaluacion_Empresa',compact('Pregunta','id','N','convenio'));
      
    }
    
    public function Registrar_Evaluacion_Empresa(Request $request,$n,$id,$convenio)
    {
        $carbon = new \Carbon\Carbon();
       try{
            $Evaluacion = new TBL_Evaluacion();
            $Evaluacion->Evaluador = $request->user()->identity_no;
            $Evaluacion->Evaluado = $id;
            $Evaluacion->FK_TBL_Convenios= $convenio;
            $Evaluacion->Tipo_Evaluacion= 1;
            $Evaluacion->Nota_Final= 0;
            $Evaluacion->Fecha= $carbon->now()->format('y-m-d');
            $Evaluacion->save();
        //saber que evaluacion es    
           $id_Evaluacion=$Evaluacion->PK_Evaluacion;
            $Nota_Final=0.000;
            for($i=1;$i<=$n;$i++){
               
                $IDpregunta="Pregunta_".$i;
                $IDrespuesta='Respuesta_'.$request->$IDpregunta;
                $resultado= new TBL_Evaluacion_Preguntas();
                $resultado->Puntuacion=$request->$IDrespuesta;
                $resultado->FK_TBL_Evaluacion=$id_Evaluacion;
                $resultado->FK_TBL_Preguntas=$request->$IDpregunta;
                $resultado->save();
                $Nota_Final= $Nota_Final + $request->$IDrespuesta;
          
           }
           $Nota_Final=$Nota_Final / $n;
           
        $evaluacion= TBL_Evaluacion::findOrFail($id_Evaluacion);
        $evaluacion->Nota_Final =$Nota_Final;
        $evaluacion->save();
           
            
             return view('unvinteraction.listar_Mis_Convenios');
            
        }catch(Exception $e){
            return "Fatal error - ".$e->getMessage();
        }
       
    }
    
    public function Listar_Evaluacion_Empresa($id)
    {
        return view($this->path.'.listar_Evaluaciones_Individuales',compact('id'));
    }
    public function Listar_Evaluacion_Individual($id)
    {
        $Evaluacion=TBL_Evaluacion::join('developer.users','users.identity_no','=','TBL_Evaluacion.Evaluador')->join('TBL_Convenios','TBL_Convenios.PK_Convenios','=','TBL_Evaluacion.FK_TBL_Convenios')
             ->select('users.name','users.lastname','TBL_Evaluacion.PK_Evaluacion','TBL_Evaluacion.Nota_Final','TBL_Convenios.Nombre')->where('TBL_Evaluacion.Evaluado',$id)
             ->get();  
         
       return Datatables::of($Evaluacion)->addIndexColumn()->make(true);
       // return $Evaluacion;
        
    }
    public function Listar_Pregunta_Evaluacion($id)
    {
        //return "hola";
        return view($this->path.'.listar_Preguntas_Individuales',compact('id'));
    }
    public function Listar_Pregunta_Individual($id)
    {
        $Evaluacion=TBL_Evaluacion_Preguntas::join('TBL_Preguntas','TBL_Preguntas.PK_Preguntas','=','TBL_Evaluacion_Preguntas.FK_TBL_Preguntas')
             ->select('TBL_Evaluacion_Preguntas.Puntuacion','TBL_Preguntas.Enunciado')->where('TBL_Evaluacion_Preguntas.FK_TBL_Evaluacion',$id)
             ->get();  
         
       return Datatables::of( $Evaluacion)->addIndexColumn()->make(true);
        
    }
//_____________________END__EVALUACIONE_______
    
    public function create()
    {
        //
    }

 
}
