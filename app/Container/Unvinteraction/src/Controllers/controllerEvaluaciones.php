<?php

namespace App\Container\Unvinteraction\src\Controllers;
use App\Container\Unvinteraction\src\TipoPregunta;
use App\Container\Unvinteraction\src\Documentacion;
use App\Container\Unvinteraction\src\Convenios;
use App\Container\Unvinteraction\src\Evaluacion;
use App\Container\Unvinteraction\src\EvaluacionPregunta;
use App\Container\Unvinteraction\src\Pregunta;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use App\Container\Unvinteraction\src\EmpresasParticipantes;
use App\Container\Unvinteraction\src\Empresa;
use App\Container\Unvinteraction\src\Participantes;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;

class controllerEvaluaciones extends Controller
{
     private $path='unvinteraction';
    //__________________EVALUACIONES___________
    /*funcion para mostrar la vista principal de los tipos de pregunta
    *@return \Illuminate\Http\Response
    *
    */
    public function tipoPregunta()
    {
        return view($this->path.'.listar_Tipo_Pregunta');
    }
    /*funcion para mostrar la vista principal de los tipos de pregunta ajax
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    *
    */
    public function tipoPreguntaAjax()
    {
        return view($this->path.'.listar_Tipo_Pregunta_Ajax');
    }
    /*funcion para registrar un nuevo tipo de pregunta
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function agregarTipoPregunta(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')){
            $Tipo = new TipoPregunta();
            $Tipo->TPPG_Tipo= $request->TPPG_Tipo;
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
    public function listarTipoPregunta()
    {
         $Pregunta = TipoPregunta::all();
         return Datatables::of($Pregunta)->addIndexColumn()->make(true);
    }
    /*funcion para buscar un Tipo de pregunta y enviar la informacion de un Tipo de pregunta
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function editarTipoPregunta($id)
    {
        $Pregunta = TipoPregunta::findOrFail($id);
        return view($this->path.'.Editar_Tipo_Pregunta', compact('Pregunta'));
    }
    /*funcion para registrar los nuevo datos de tipo de pregunta
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function modificarTipoPregunta(Request $request,$id)
    {
      if($request->ajax() && $request->isMethod('POST')){
          $Pregunta= TipoPregunta::findOrFail($id);
          $Pregunta->TPPG_Tipo=$request->TPPG_Tipo;
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
    public function pregunta()
    {
        $Pregunta = TipoPregunta::select('PK_TPPG_Tipo_Pregunta','TPPG_Tipo')->pluck('TPPG_Tipo','PK_TPPG_Tipo_Pregunta')
                ->toArray();  
       
       return view($this->path.'.listar_Pregunta',compact('Pregunta'));
      
    }
    /*funcion para mostrar la vista principal de las preguntas ajax
    *@return \Illuminate\Http\Response
    *
    */
    public function preguntaAjax()
    {
       $Pregunta = TipoPregunta::select('PK_TPPG_Tipo_Pregunta','TPPG_Tipo')->pluck('TPPG_Tipo','PK_TPPG_Tipo_Pregunta')
                ->toArray();  
        
       return view($this->path.'.listar_Pregunta_Ajax',compact('Pregunta'));
      
    }
    /*funcion para registrar una nueva pregunta
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
     public function agregarPregunta(Request $request)
    {
         $Pregunta = TipoPregunta::all(); 
        if($request->ajax() && $request->isMethod('POST'))
        {
            $Tipo = new Pregunta();
            $Tipo->PRGT_Enunciado= $request->PRGT_Enunciado;
            $Tipo->FK_TBL_Tipo_Pregunta_Id= $request->FK_TBL_Tipo_Pregunta_Id;
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
     public function listarPregunta()
    {
      $Pregunta = Pregunta::select('PK_PRGT_Pregunta','PRGT_Enunciado','FK_TBL_Tipo_Pregunta_Id')
            ->with([
                    'preguntaTiposPregunta'=>function ($query) {
                    $query->select('PK_TPPG_Tipo_Pregunta','TPPG_Tipo');
                    }
            ])
            ->get();
         return Datatables::of( $Pregunta)->addIndexColumn()->make(true);
        
       
    }
    /*funcion para buscar una pregunta y enviar la informacion de una pregunta
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function editarPregunta($id)
    {
        $Pregunta = Pregunta::findOrFail($id);
        $Pregunta1 = TipoPregunta::select('PK_TPPG_Tipo_Pregunta','TPPG_Tipo')->pluck('TPPG_Tipo','PK_TPPG_Tipo_Pregunta')
                ->toArray();  
        return view($this->path.'.Editar_Pregunta', compact('Pregunta','Pregunta1'));
       
    }
    /*funcion para registrar los nuevo datos de pregunta
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function modificarPregunta(Request $request,$id)
    {
        if($request->ajax() && $request->isMethod('POST')) {
            $Pregunta= Pregunta::findOrFail($id);
            $Pregunta->PRGT_Enunciado=$request->PRGT_Enunciado;
            $Pregunta->FK_TBL_Tipo_Pregunta_Id =$request->FK_TBL_Tipo_Pregunta_Id;
            $Pregunta->save();
            return AjaxResponse::success('¡Bien hecho!','Datos modificados correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!','No se pudo completar tu solicitud.');
        }
    }
    /*funcion para mostrar la vista principal de las evaluaciones
    *@return \Illuminate\Http\Response
    *
    */
    
    public function evaluaciones()
    {
        return view($this->path.'.listar_Evaluaciones');
    }
    
    /*funcion para envio de los datos para la tabla de datos
    *
    *@return Yajra\DataTables\DataTable
    */
    
    public function listarEvaluacionesEmpresas()
    {
       $Evaluacion=Evaluacion::where('Tipo_Evaluacion',1)->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado')
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
     public function listarEvaluacionesUsuarios()
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
    public function realizarEvaluacion(Request $request,$id,$convenio)
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
        $Pregunta= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',$tipo)->get();
        $N= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',$tipo)->count();
        return view($this->path.'.Realizar_Evaluacion',compact('Pregunta','id','N','convenio'));
    }
    /*funcion para guardar las preguntas de la evaluacion y los datos correspondientes a esta misma para un usuario
    *@param int n
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
    public function registrarEvaluacion(Request $request,$n,$id,$convenio)
    {
        $carbon = new \Carbon\Carbon();
        try{
            $Evaluacion = new Evaluacion();
            $Evaluacion->VLCN_Evaluador = $request->user()->identity_no;
            $Evaluacion->VLCN_Evaluado = $id;
            $Evaluacion->FK_TBL_Convenio_Id= $convenio;
            $Evaluacion->VLCN_Tipo_Evaluacion= 2;
            $Evaluacion->VLCN_Nota_Final= 0;
            $Evaluacion->VLCN_Fecha= $carbon->now()->format('y-m-d');
            $Evaluacion->save();
            //saber que evaluacion es 
            $id_Evaluacion=$Evaluacion->PK_VLCN_Evaluacion;
            $Nota_Final=0.000;
            for($i=1;$i<=$n;$i++){
                $IDpregunta="Pregunta_".$i;
                $IDrespuesta='Respuesta_'.$request->$IDpregunta;
                $resultado= new EvaluacionPregunta();
                $resultado->VCPT_Puntuacion=$request->$IDrespuesta;
                $resultado->FK_TBL_Evaluacion_Id=$id_Evaluacion;
                $resultado->FK_TBL_Pregunta_Id=$request->$IDpregunta;
                $resultado->save();
                $Nota_Final= $Nota_Final + $request->$IDrespuesta;
            }
            //promedio entre el resultado de las preguntas para sacar una nota promedio final
            $Nota_Final=$Nota_Final / $n;
            $evaluacion= Evaluacion::findOrFail($id_Evaluacion);
            $evaluacion->VLCN_Nota_Final =$Nota_Final;
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
    public function realizarEvaluacionEmpresa(Request $request,$id,$convenio)
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
    public function registrarEvaluacionEmpresa(Request $request,$n,$id,$convenio)
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
    public function listarEvaluacionEmpresa($id)
    {
        return view($this->path.'.listar_Evaluaciones_Individuales_Empresa',compact('id'));
    }
    /*funcion para mostrar la vista principal de las evaluaciones de los usuarios
    *@param int id
    *@return \Illuminate\Http\Response
    *
    */
    public function listarEvaluacionesUsuario($id)
    {
        return view($this->path.'.listar_Evaluaciones_Individuales',compact('id'));
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function listarEvaluacionIndividual($id)
    {
        $Evaluacion=Evaluacion::where('VLCN_Evaluado',$id)->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
            ->with([
                    'conveniosEvaluacion'=>function ($query) {
                        $query->select('PK_CVNO_Convenio','CVNO_Nombre');
                    }
            ])
            ->with([
                'evaluado'=>function ($query) {
                    $query->select('PK_USER_Usuario');
                }
            ])
            ->with([
                'evaluador'=>function ($query) {
                    $query->select('PK_USER_Usuario');
                }
            ])
            ->get();  
         
       return Datatables::of($Evaluacion)->addIndexColumn()->make(true);
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function listarEvaluacionIndividualEmpresa($id)
    {
        $Evaluacion=TBL_Evaluacion::where('Evaluado',$id)->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado')
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
    /*funcion para mostrar la vista principal de las preguntas de las evaluaciones 
    *@param int id
    *@return \Illuminate\Http\Response
    */
    public function listarPreguntaEvaluacion($id)
    {
        return view($this->path.'.listar_Preguntas_Individuales',compact('id'));
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function listarPreguntaIndividual($id)
    {
        $Evaluacion=TBL_Evaluacion_Preguntas::where('FK_TBL_Evaluacion',$id)->select('Puntuacion','FK_TBL_Preguntas')
            ->with(['preguntas_Preguntas'=>function ($query) {$query->select('PK_Preguntas','Enunciado');}])
            ->get();
        return Datatables::of( $Evaluacion)->addIndexColumn()->make(true);
    }
    /*funcion para verificar el envio exitoso del filtro para el reporte
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function vistaReporte(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            return AjaxResponse::success('¡Bien hecho!', 'Datos filtrados correctamente.');
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
    public function reporte(Request $request,$id,$fecha_primera,$fecha_segunda)
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
    public function listarReporte(Request $request,$id,$fecha_primera,$fecha_segunda)
    {
        $Evaluacion=TBL_Evaluacion::where('Evaluado',$id)->whereBetween('Fecha',[$fecha_primera,$fecha_segunda])->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado')
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
