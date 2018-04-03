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
       $Evaluacion = Evaluacion::where('VLCN_Tipo_Evaluacion',1)->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
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
         
       return Datatables::of($Evaluacion)->addIndexColumn()->make(true);
        
    }
    /*funcion para envio de los datos para la tabla de datos
    *
    *@return Yajra\DataTables\DataTable
    */
     public function listarEvaluacionesUsuarios()
    {
       $Evaluacion = Evaluacion::where('VLCN_Tipo_Evaluacion',2)->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
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
        if ($request->ajax() && $request->isMethod('GET')) {
            $pregunta1= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',1)->select('PK_PRGT_Pregunta','PRGT_Enunciado')->get() ;
            $pregunta2= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',2)->select('PK_PRGT_Pregunta','PRGT_Enunciado')->get() ;
            return view($this->path.'.Realizar_Evaluacion',compact('pregunta1','id','pregunta2','convenio','n'));
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
    *@return \Illuminate\Http\Response
    */
    public function realizarEvaluacionEmpresa(Request $request,$id,$convenio)
    {
        $pregunta3= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',3)->select('PK_PRGT_Pregunta','PRGT_Enunciado')->get() ;
        $pregunta4= Pregunta::where('FK_TBL_Tipo_Pregunta_Id',4)->select('PK_PRGT_Pregunta','PRGT_Enunciado')->get() ;
        
        return view($this->path.'.Realizar_Evaluacion_Empresa',compact('id','convenio','pregunta3','pregunta4'));
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
            $Evaluacion = new Evaluacion();
            $Evaluacion->VLCN_Evaluador = $request->user()->identity_no;
            $Evaluacion->VLCN_Evaluado = $id;
            $Evaluacion->FK_TBL_Convenio_Id= $convenio;
            $Evaluacion->VLCN_Tipo_Evaluacion= 1;
            $Evaluacion->VLCN_Nota_Final= 0;
            $Evaluacion->VLCN_Fecha= $carbon->now()->format('y-m-d');
            $Evaluacion->save();
            //saber que evaluacion es 
            $id_Evaluacion=$Evaluacion->PK_VLCN_Evaluacion;
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
    *@return \Illuminate\Http\Response
    *
    */
    public function listarEvaluacionEmpresa(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listar_Evaluaciones_Individuales_Empresa',compact('id'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para mostrar la vista principal de las evaluaciones de los usuarios
    *@param int id
    *@return \Illuminate\Http\Response
    *
    */
    public function listarEvaluacionesUsuario(Request $request,$id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'.listar_Evaluaciones_Individuales',compact('id'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function listarEvaluacionIndividual($id)
    {
         
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
    /*funcion para envio de los datos para la tabla de datos
    *@param int id
    *@return Yajra\DataTables\DataTable
    */
    public function listarEvaluacionIndividualEmpresa($id)
    {
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
        $Evaluacion=EvaluacionPregunta::where('FK_TBL_Evaluacion_Id',$id)->select('VCPT_Puntuacion','FK_TBL_Pregunta_Id')
            ->with(['preguntaPregunta'=>function ($query) {$query->select('PK_PRGT_Pregunta','PRGT_Enunciado');}])
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
        $Evaluacion=Evaluacion::where('VLCN_Evaluado',$id)->whereBetween('VLCN_Fecha',[$fecha_primera,$fecha_segunda])->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado')
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
        return Datatables::of($Evaluacion)->addIndexColumn()->make(true);
      
    }
//_____________________END__EVALUACIONE_______
}
