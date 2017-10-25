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
    /*funcion para mostrar la vista principal de los tipos de pregunta
    *@return \Illuminate\Http\Response
    *
    */
    public function Tipo_Pregunta()
    {
        return view($this->path.'.listar_Tipo_Pregunta');
    }
    /*funcion para mostrar la vista principal de los tipos de pregunta ajax
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    *
    */
    public function Tipo_Pregunta_Ajax()
    {
        return view($this->path.'.listar_Tipo_Pregunta_Ajax');
    }
    /*funcion para registrar un nuevo tipo de pregunta
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
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
    /*funcion para envio de los datos para la tabla de datos
    *
    *@return Yajra\DataTables\DataTable
    */
    public function Listar_Tipo_Pregunta()
    {
         $Pregunta = TBL_Tipo_Pregunta::all();
         return Datatables::of($Pregunta)->addIndexColumn()->make(true);
    }
    /*funcion para buscar un Tipo de pregunta y enviar la informacion de un Tipo de pregunta
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function Editar_Tipo_Pregunta($id)
    {
        $Pregunta = TBL_Tipo_Pregunta::findOrFail($id);
        return view($this->path.'.Editar_Tipo_Pregunta', compact('Pregunta'));
    }
    /*funcion para registrar los nuevo datos de tipo de pregunta
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
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
    /*funcion para mostrar la vista principal de las preguntas
    *@return \Illuminate\Http\Response
    *
    */
    public function Pregunta()
    {
        $Pregunta = TBL_Tipo_Pregunta::select('PK_Tipo_Pregunta','Tipo')->pluck('Tipo','PK_Tipo_Pregunta')
                ->toArray();  
       
       return view($this->path.'.listar_Pregunta',compact('Pregunta'));
      
    }
    /*funcion para mostrar la vista principal de las preguntas ajax
    *@return \Illuminate\Http\Response
    *
    */
    public function Pregunta_Ajax()
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
    /*funcion para envio de los datos para la tabla de datos
    *
    *@return Yajra\DataTables\DataTable
    */
     public function Listar_Pregunta()
    {
      $Pregunta = TBL_Preguntas::select('PK_Preguntas','Enunciado','FK_TBL_Tipo_pregunta')
            ->with([
                    'preguntas_tiposPreguntas'=>function ($query) {
                    $query->select('PK_Tipo_Pregunta','Tipo');
                    }
            ])
            ->get();
         return Datatables::of( $Pregunta)->addIndexColumn()->make(true);
        
       
    }
    /*funcion para buscar una pregunta y enviar la informacion de una pregunta
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function Editar_Pregunta($id)
    {
        $Pregunta = TBL_Preguntas::findOrFail($id);
        $Pregunta1 = TBL_Tipo_Pregunta::select('PK_Tipo_Pregunta','Tipo')->pluck('Tipo','PK_Tipo_Pregunta')
                ->toArray();  
        return view($this->path.'.Editar_Pregunta', compact('Pregunta','Pregunta1'));
       
    }
    /*funcion para registrar los nuevo datos de pregunta
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
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
    /*funcion para mostrar la vista principal de las evaluaciones
    *@return \Illuminate\Http\Response
    *
    */
    public function Evaluaciones()
    {
        
         return view($this->path.'.listar_Evaluaciones');
       
    }
    /*funcion para envio de los datos para la tabla de datos
    *
    *@return Yajra\DataTables\DataTable
    */
    public function Listar_Evaluaciones_Empresas()
    {
       $Evaluacion=TBL_Evaluacion::where('Tipo_Evaluacion',1)->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado')
            ->with([
                    'convenios_Evaluacion'=>function ($query) {
                        $query->select('PK_Convenios','Nombre');
                    }
            ])
            ->with([
                'evaluado_E'=>function ($query) {
                    $query->select('PK_Empresa','Nombre_Empresa');
                }
            ])
            ->with([
                'evaluador'=>function ($query) {
                    $query->select('identity_no','name','lastname');
                }
            ])
            ->get();  
         
       return Datatables::of($Evaluacion)->addIndexColumn()->make(true);
        
    }
    /*funcion para envio de los datos para la tabla de datos
    *
    *@return Yajra\DataTables\DataTable
    */
     public function Listar_Evaluaciones_Usuarios()
    {
       $Evaluacion=TBL_Evaluacion::where('Tipo_Evaluacion',2)->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado')
            ->with([
                    'convenios_Evaluacion'=>function ($query) {
                        $query->select('PK_Convenios','Nombre');
                    }
            ])
            ->with([
                'evaluado_U'=>function ($query) {
                    $query->select('identity_no','name','lastname');
                }
            ])
            ->with([
                'evaluador'=>function ($query) {
                    $query->select('identity_no','name','lastname');
                }
            ])
            ->get();  
         
       return Datatables::of( $Evaluacion)->addIndexColumn()->make(true);
        
    }
    /*funcion para mostrar las preguntas de la evaluacion
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
    public function Realizar_Evaluacion(Request $request,$id,$convenio)
    {
        $tipo=0;
        $decicion=1;
        $decicion2=1;
        $rol= DB::table('role_user')->join('developer.users','users.id','=','role_user.user_id')
            ->join('developer.roles','roles.id','=','role_user.role_id')->select('roles.name')->where('users.identity_no',$id)->get();
        $rol2= DB::table('role_user')->join('developer.users','users.id','=','role_user.user_id')
            ->join('developer.roles','roles.id','=','role_user.role_id')->select('roles.name')->where('users.identity_no',$request->user()->identity_no)->get();
        //toma la decision de que preguntas debe mostrar segun el rol del evaluador y el evaluado
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
    /*funcion para guardar las preguntas de la evaluacion y los datos correspondientes a esta misma para un usuario
    *@param int n
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
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
            //promedio entre el resultado de las preguntas para sacar una nota promedio final
            $Nota_Final=$Nota_Final / $n;
            $evaluacion= TBL_Evaluacion::findOrFail($id_Evaluacion);
            $evaluacion->Nota_Final =$Nota_Final;
            $evaluacion->save();
            return view('unvinteraction.listar_Mis_Convenios');
        }catch(Exception $e){
            return "Fatal error - ".$e->getMessage();
        }
    }
    /*funcion para mostrar las preguntas de la evaluacion para una empresa
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
    public function Realizar_Evaluacion_Empresa(Request $request,$id,$convenio)
    {
        $tipo=0;
        $id2=$request->user()->identity_no;
        $rol2= DB::table('role_user')->join('developer.users','users.id','=','role_user.user_id')
            ->join('developer.roles','roles.id','=','role_user.role_id')->select('roles.name')->where('users.identity_no',$id2)->get();
        foreach($rol2 as $Rol2) {
            switch($Rol2->name) {
                case 'Coordinador_uni':
                    $decision2=1;
                    break;
                case 'Pasante_uni':
                    $decision2=2;
                    break;
            }
        }
        if( $decision2==1) {
            $tipo=2;
        }
        if( $decision2==2) {
            $tipo=3;
        }
        $Pregunta= TBL_Preguntas::where('FK_TBL_Tipo_Pregunta',$tipo)->get();
        $N= TBL_Preguntas::where('FK_TBL_Tipo_Pregunta',$tipo)->count();
        return view($this->path.'.Realizar_Evaluacion_Empresa',compact('Pregunta','id','N','convenio'));
    }
    /*funcion para guardar las preguntas de la evaluacion y los datos correspondientes a esta misma para una empresa
    *@param int n
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
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
            //promedio entre el resultado de las preguntas para sacar una nota promedio final
            $Nota_Final=$Nota_Final / $n;
            $evaluacion= TBL_Evaluacion::findOrFail($id_Evaluacion);
            $evaluacion->Nota_Final =$Nota_Final;
            $evaluacion->save();
            return view('unvinteraction.listar_Mis_Convenios');
        }catch(Exception $e){
            return "Fatal error - ".$e->getMessage();
        }
    }
    /*funcion para mostrar la vista principal de las evaluaciones de las empresas
    *@param int id
    *@return \Illuminate\Http\Response
    *
    */
    public function Listar_Evaluacion_Empresa($id)
    {
        return view($this->path.'.listar_Evaluaciones_Individuales',compact('id'));
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function Listar_Evaluacion_Individual($id)
    {
        $Evaluacion=TBL_Evaluacion::where('Evaluado',$id)->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado')
            ->with([
                    'convenios_Evaluacion'=>function ($query) {
                        $query->select('PK_Convenios','Nombre');
                    }
            ])
            ->with([
                'evaluado_U'=>function ($query) {
                    $query->select('identity_no','name','lastname');
                }
            ])
            ->with([
                'evaluador'=>function ($query) {
                    $query->select('identity_no','name','lastname');
                }
            ])
            ->get();  
         
       return Datatables::of($Evaluacion)->addIndexColumn()->make(true);
    }
    /*funcion para mostrar la vista principal de las preguntas de las evaluaciones 
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function Listar_Pregunta_Evaluacion($id)
    {
        return view($this->path.'.listar_Preguntas_Individuales',compact('id'));
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function Listar_Pregunta_Individual($id)
    {
        $Evaluacion=TBL_Evaluacion_Preguntas::where('FK_TBL_Evaluacion',$id)->select('Puntuacion','FK_TBL_Preguntas')
            ->with([
                    'preguntas_Preguntas'=>function ($query) {
                        $query->select('PK_Preguntas','Enunciado');
                    }
            ])
            ->get();  
         
       return Datatables::of( $Evaluacion)->addIndexColumn()->make(true);
        
    }
    /*funcion para verificar el envio exitoso del filtro para el reporte
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function Vista_Reporte(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            return AjaxResponse::success('¡Bien hecho!', 'Datos modificados correctamente.'.$id);
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
      
    }
    /*funcion para envio de la vista de filtro de reporte
    *@param \Illuminate\Http\Request
    *@param int id
    *@param Date fecha_primera
    *@param Date fecha_segunda
    *@return \Illuminate\Http\Response
    */
    public function Reporte(Request $request,$id,$fecha_primera,$fecha_segunda)
    {
        return view($this->path.'.Ver_Reporte',compact('id','fecha_primera','fecha_segunda','lava'));
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param \Illuminate\Http\Request
    *@param int id
    *@param Date fecha_primera
    *@param Date fecha_segunda
    *@return Yajra\DataTables\DataTable
    */
    public function Listar_Reporte(Request $request,$id,$fecha_primera,$fecha_segunda)
    {
        $Evaluacion=TBL_Evaluacion::where('Tipo_Evaluacion',2)->where('Evaluado',$id)->whereBetween('Fecha',[$fecha_primera,$fecha_segunda])->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado')
            ->with([
                    'convenios_Evaluacion'=>function ($query) {
                        $query->select('PK_Convenios','Nombre');
                    }
            ])
            ->with([
                'evaluado_U'=>function ($query) {
                    $query->select('identity_no','name','lastname');
                }
            ])
            ->with([
                'evaluador'=>function ($query) {
                    $query->select('identity_no','name','lastname');
                }
            ])
            ->get();
        return Datatables::of($Evaluacion)->addIndexColumn()->make(true);
      
    }
//_____________________END__EVALUACIONE_______
}
