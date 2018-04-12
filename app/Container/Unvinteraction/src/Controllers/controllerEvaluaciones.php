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
     private $path='unvinteraction.evaluaciones';
    //__________________EVALUACIONES___________
    /*funcion para mostrar la vista principal de los tipos de pregunta
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function tipoPregunta(Request $request)
    {
        if($request->isMethod('GET')){
            return view($this->path.'.listarTipoPregunta');
        }
        return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar la vista principal de los tipos de pregunta ajax
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function tipoPreguntaAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listarTipoPreguntaAjax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para registrar un nuevo tipo de pregunta
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function agregarTipoPregunta(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')){
            $tipo = new TipoPregunta();
            $tipo->TPPG_Tipo= $request->TPPG_Tipo;
            $tipo->save();
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
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarTipoPregunta(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            
         $pregunta = TipoPregunta::all();
         return Datatables::of($pregunta)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para buscar un Tipo de pregunta y enviar la informacion de un Tipo de pregunta
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function editarTipoPregunta(Request $request,$id)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            $pregunta = TipoPregunta::findOrFail($id);
            return view($this->path.'.editarTipoPregunta', compact('pregunta'));
        }
        return AjaxResponse::fail('¡Lo sentimos!','No se pudo completar tu solicitud.');
    }
    /*funcion para registrar los nuevo datos de tipo de pregunta
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function modificarTipoPregunta(Request $request,$id)
    {
      if($request->ajax() && $request->isMethod('POST')){
          $pregunta= TipoPregunta::findOrFail($id);
          $pregunta->TPPG_Tipo=$request->TPPG_Tipo;
          $pregunta->save();
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
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function pregunta(Request $request)
    {
        if($request->isMethod('GET')){
            $pregunta = TipoPregunta::select('PK_TPPG_Tipo_Pregunta','TPPG_Tipo')->pluck('TPPG_Tipo','PK_TPPG_Tipo_Pregunta')
                ->toArray();
            return view($this->path.'.listarPregunta',compact('pregunta'));
        }
        return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
        );
      
    }
    /*funcion para mostrar la vista principal de las preguntas ajax
    *@return \Illuminate\Http\Response
    *
    */
    public function preguntaAjax(Request $request)
    {
       if ($request->ajax() && $request->isMethod('GET')) {
            $pregunta = TipoPregunta::select('PK_TPPG_Tipo_Pregunta','TPPG_Tipo')->pluck('TPPG_Tipo','PK_TPPG_Tipo_Pregunta')->toArray();
            return view($this->path.'.listarPreguntaAjax',compact('pregunta'));
       }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para registrar una nueva pregunta
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
     public function agregarPregunta(Request $request)
    {
         
        if($request->ajax() && $request->isMethod('POST'))
        {
            $pregunta = TipoPregunta::all(); 
            $tipo = new Pregunta();
            $tipo->PRGT_Enunciado= $request->PRGT_Enunciado;
            $tipo->FK_TBL_Tipo_Pregunta_Id= $request->FK_TBL_Tipo_Pregunta_Id;
            $tipo->save();
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
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
     public function listarPregunta(Request $request)
    {
         if($request->ajax() && $request->isMethod('GET')){
              $pregunta = Pregunta::select('PK_PRGT_Pregunta','PRGT_Enunciado','FK_TBL_Tipo_Pregunta_Id')
                    ->with([
                            'preguntaTiposPregunta'=>function ($query) {
                            $query->select('PK_TPPG_Tipo_Pregunta','TPPG_Tipo');
                            }
                    ])
                    ->get();
                 return Datatables::of( $pregunta)->addIndexColumn()->make(true);
         }
         return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
       
    }
    /*funcion para buscar una pregunta y enviar la informacion de una pregunta
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function editarPregunta(Request $request,$id)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            $pregunta = Pregunta::findOrFail($id);
            $pregunta1 = TipoPregunta::select('PK_TPPG_Tipo_Pregunta','TPPG_Tipo')->pluck('TPPG_Tipo','PK_TPPG_Tipo_Pregunta')
                ->toArray();  
            return view($this->path.'.editarPregunta', compact('pregunta','pregunta1'));
        }
        return AjaxResponse::fail('¡Lo sentimos!','No se pudo completar tu solicitud.');
    }
    /*funcion para registrar los nuevo datos de pregunta
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function modificarPregunta(Request $request,$id)
    {
        if($request->ajax() && $request->isMethod('POST')) {
            $pregunta= Pregunta::findOrFail($id);
            $pregunta->PRGT_Enunciado=$request->PRGT_Enunciado;
            $pregunta->FK_TBL_Tipo_Pregunta_Id =$request->FK_TBL_Tipo_Pregunta_Id;
            $pregunta->save();
            return AjaxResponse::success('¡Bien hecho!','Datos modificados correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!','No se pudo completar tu solicitud.');
        }
    }
    /*funcion para mostrar la vista principal de las evaluaciones
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    
    public function evaluaciones(Request $request)
    {
        if( $request->isMethod('GET')){
            return view($this->path.'.listarEvaluaciones');
        }
        return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
        );
    }
    
    /*funcion para envio de los datos para la tabla de datos
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarEvaluacionesEmpresas(Request $request)
    {
        
        if($request->ajax() && $request->isMethod('GET')){
           $evaluacion = Evaluacion::where('VLCN_Tipo_Evaluacion',1)->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
               ->with([
                        'conveniosEvaluacion'=>function ($query) {
                            $query->select('PK_CVNO_Convenio','CVNO_Nombre');
                        }
                ])
                ->with([
                    'evaluadoEmpresa'=>function ($query) {
                        $query->select('PK_EMPS_Empresa','EMPS_Nombre_Empresa');
                    }
                ])
                ->with([
                    'evaluador'=>function ($query) {
                        $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                            'datoUsuario'=>function ($query) {
                                $query->select('name','identity_no','lastname');
                            }
                        ]);
                    }
                ])
                ->get();  

           return Datatables::of($evaluacion)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
        );
    }
    
    /*funcion para envio de los datos para la tabla de datos
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
     public function listarEvaluacionesUsuarios(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
           $evaluacion = Evaluacion::where('VLCN_Tipo_Evaluacion',2)->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
                ->with([
                        'conveniosEvaluacion'=>function ($query) {
                            $query->select('PK_CVNO_Convenio','CVNO_Nombre');
                        }
                ])
                ->with([
                    'evaluado'=>function ($query) {
                        $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                            'datoUsuario'=>function ($query) {
                                $query->select('name','identity_no','lastname');
                            }
                        ]);
                    }
                ])
                ->with([
                    'evaluador'=>function ($query) {
                        $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                            'datoUsuario'=>function ($query) {
                                $query->select('name','identity_no','lastname');
                            }
                        ]);
                    }
                ])
                ->get();  

           return Datatables::of($evaluacion)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
                 '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar las preguntas de la evaluacion
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
    public function realizarEvaluacion(Request $request,$id,$convenio)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $pregunta1= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',1)->select('PK_PRGT_Pregunta','PRGT_Enunciado')->get() ;
            $pregunta2= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',2)->select('PK_PRGT_Pregunta','PRGT_Enunciado')->get() ;
            return view($this->path.'.realizarEvaluacion',compact('pregunta1','id','pregunta2','convenio','n'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para guardar las preguntas de la evaluacion y los datos correspondientes a esta misma para un usuario
    *@param int n
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
    public function registrarEvaluacion(Request $request,$id,$convenio,$n)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $carbon = new \Carbon\Carbon();
            $evaluacion = new Evaluacion();
            $evaluacion->VLCN_Evaluador = $request->user()->identity_no;
            $evaluacion->VLCN_Evaluado = $id;
            $evaluacion->FK_TBL_Convenio_Id= $convenio;
            $evaluacion->VLCN_Tipo_Evaluacion= 2;
            $evaluacion->VLCN_Nota_Final= 0;
            $evaluacion->VLCN_Fecha= $carbon->now()->format('y-m-d');
            $evaluacion->save();
            //saber que evaluacion es 
            $id_Evaluacion=$evaluacion->PK_VLCN_Evaluacion;
            $Nota_Final=0.000;
            for($i=1;$i<=$n;$i++){
                $IDpregunta="Pregunta_".$i;
                $IDrespuesta= 'Respuesta_'.$i;
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
            
            return AjaxResponse::success('¡Bien hecho!', 'Convenio Registrado correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
    }
    /*funcion para mostrar las preguntas de la evaluacion para una empresa
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function realizarEvaluacionEmpresa(Request $request,$id,$convenio)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $pregunta3= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',3)->select('PK_PRGT_Pregunta','PRGT_Enunciado')->get() ;
            $pregunta4= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',4)->select('PK_PRGT_Pregunta','PRGT_Enunciado')->get() ;
            return view($this->path.'.realizarEvaluacionEmpresa',compact('id','convenio','pregunta3','pregunta4'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para guardar las preguntas de la evaluacion y los datos correspondientes a esta misma para una empresa
    *@param int n
    *@param int id
    *@param int convenio
    *@param \Illuminate\Http\Request
    *@return \Illuminate\Http\Response
    */
    public function registrarEvaluacionEmpresa(Request $request,$id,$convenio,$n)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $carbon = new \Carbon\Carbon();
            $evaluacion = new Evaluacion();
            $evaluacion->VLCN_Evaluador = $request->user()->identity_no;
            $evaluacion->VLCN_Evaluado = $id;
            $evaluacion->FK_TBL_Convenio_Id= $convenio;
            $evaluacion->VLCN_Tipo_Evaluacion= 1;
            $evaluacion->VLCN_Nota_Final= 0;
            $evaluacion->VLCN_Fecha= $carbon->now()->format('y-m-d');
            $evaluacion->save();
            //saber que evaluacion es 
            $id_Evaluacion=$evaluacion->PK_VLCN_Evaluacion;
            $Nota_Final=0.000;
            for($i=1;$i<=$n;$i++){
                $IDpregunta="Pregunta_".$i;
                $IDrespuesta= 'Respuesta_'.$i;
                $resultado= new EvaluacionPregunta();
                $resultado->VCPT_Puntuacion=$request->$IDrespuesta;
                $resultado->FK_TBL_Evaluacion_Id=$id_Evaluacion;
                $resultado->FK_TBL_Pregunta_Id=$request->$IDpregunta;
                $resultado->save();
                $Nota_Final= $Nota_Final + $request->$IDpregunta;
            }
            //promedio entre el resultado de las preguntas para sacar una nota promedio final
            $Nota_Final=$Nota_Final / $n;
            $evaluacion= Evaluacion::findOrFail($id_Evaluacion);
            $evaluacion->VLCN_Nota_Final =$Nota_Final;
            $evaluacion->save();
            
            return AjaxResponse::success('¡Bien hecho!', 'Convenio Registrado correctamente.');
        } else {
            return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
        }
    }
    /*funcion para mostrar la vista principal de las evaluaciones de las empresas
    *@param int id
    *@param  \Illuminate\Http\Request
    *@return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function listarEvaluacionEmpresa(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listarEvaluacionesIndividualesEmpresa',compact('id'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar la vista principal de las evaluaciones de los usuarios
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function listarEvaluacionesUsuario(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listarEvaluacionesIndividuales',compact('id'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarEvaluacionIndividual(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $evaluacion=Evaluacion::where('VLCN_Evaluado',$id)->where('VLCN_Tipo_Evaluacion',2)->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
                ->with([
                        'conveniosEvaluacion'=>function ($query) {
                            $query->select('PK_CVNO_Convenio','CVNO_Nombre');
                        }
                ])
                ->with([
                    'evaluado'=>function ($query) {
                        $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                            'datoUsuario'=>function ($query) {
                                $query->select('name','identity_no','lastname');
                            }
                        ]);
                    }
                ])
                ->with([
                    'evaluador'=>function ($query) {
                        $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                            'datoUsuario'=>function ($query) {
                                $query->select('name','identity_no','lastname');
                            }
                        ]);
                    }
                ])
                ->get();  

           return Datatables::of($evaluacion)->addIndexColumn()->make(true);
       }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarEvaluacionIndividualEmpresa(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $evaluacion=Evaluacion::where('VLCN_Evaluado',$id)->where('VLCN_Tipo_Evaluacion',1)->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
                ->with([
                        'conveniosEvaluacion'=>function ($query) {
                            $query->select('PK_CVNO_Convenio','CVNO_Nombre');
                        }
                ])
                ->with([
                    'evaluadoEmpresa'=>function ($query) {
                        $query->select('PK_EMPS_Empresa','EMPS_Nombre_Empresa');
                    }
                ])
                ->with([
                    'evaluador'=>function ($query) {
                        $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                            'datoUsuario'=>function ($query) {
                                $query->select('name','identity_no','lastname');
                            }
                        ]);
                    }
                ])
                ->get();  

           return Datatables::of($evaluacion)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar la vista principal de las preguntas de las evaluaciones 
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function listarPreguntaEvaluacion(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) { 
            return view($this->path.'.listarPreguntasIndividuales',compact('id'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarPreguntaIndividual(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $evaluacion=EvaluacionPregunta::where('FK_TBL_Evaluacion_Id',$id)->select('VCPT_Puntuacion','FK_TBL_Pregunta_Id')
                ->with(['preguntaPregunta'=>function ($query) {$query->select('PK_PRGT_Pregunta','PRGT_Enunciado');}])
                ->get();
            return Datatables::of($evaluacion)->addIndexColumn()->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
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
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function reporte(Request $request,$id,$fecha_primera,$fecha_segunda)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.verReporte',compact('id','fecha_primera','fecha_segunda'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param \Illuminate\Http\Request
    *@param int id
    *@param Date fecha_primera
    *@param Date fecha_segunda
    *@param \Illuminate\Http\Request
    *@return \App\Container\Overall\Src\Facades\AjaxResponse |Yajra\DataTables\DataTable
    */
    public function listarReporte(Request $request,$id,$fecha_primera,$fecha_segunda)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $evaluacion=Evaluacion::where('VLCN_Evaluado',$id)->whereBetween('VLCN_Fecha',[$fecha_primera,$fecha_segunda])->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
                ->with([
                        'conveniosEvaluacion'=>function ($query) {
                            $query->select('PK_CVNO_Convenio','CVNO_Nombre');
                        }
                ])
                ->with([
                    'evaluado'=>function ($query) {
                        $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                            'datoUsuario'=>function ($query) {
                                $query->select('name','identity_no','lastname');
                            }
                        ]);
                    }
                ])
                ->with([
                    'evaluador'=>function ($query) {
                        $query->select('PK_USER_Usuario','USER_FK_Users')->with([
                            'datoUsuario'=>function ($query) {
                                $query->select('name','identity_no','lastname');
                            }
                        ]);
                    }
                ])
                ->get(); 
            return Datatables::of($evaluacion)->addIndexColumn()->make(true);
      }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
//_____________________END__EVALUACIONE_______
}
