<?php
namespace App\Container\Unvinteraction\src\Controllers;

use App\Container\Unvinteraction\src\Usuarios;
use App\Container\Unvinteraction\src\Tipo_Usuario;
use App\Container\Unvinteraction\src\Estado_Usuario;
use App\Container\Unvinteraction\src\Carrera;
use App\Container\Unvinteraction\src\Facultad;
use App\Container\Unvinteraction\src\Documentacion;
use App\Container\Unvinteraction\src\Convenios;
use App\Container\Unvinteraction\src\Evaluacion;
use App\Container\Unvinteraction\src\Evaluacion_Preguntas;
use App\Container\Unvinteraction\src\Preguntas;
use App\Container\Unvinteraction\src\Sede;
use App\Container\Unvinteraction\src\Estado;
use App\Container\Unvinteraction\src\Empresas_Participantes;
use App\Container\Unvinteraction\src\Empresa;
use App\Container\Unvinteraction\src\Participantes;
use App\Container\Unvinteraction\src\DocumentacionExtra;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Users\Src\User;
use App\Container\Overall\Src\Facades\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Validator;

class controllerDocumentos extends Controller
{
    private $path='unvinteraction';
    /*funcion para subir el documento para los convenios
    *@param int id
    *@param \Illuminate\Http\Request
    *@return
    *
    */
    public function subirDocumentoConvenio(Request $request, $id)
    {
        $carbon = new \Carbon\Carbon();
        $ubicacion="unvinteraction/convenios/".$id;
        $files = $request->file('file');
        foreach ($files as $file) {
            $url = Storage::disk('developer')->putFileAs($ubicacion, $file, $carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName());
        }
        $documento = new Documentacion();
        $documento->DOCU_Nombre =$file->getClientOriginalName();
        $documento->DOCU_Ubicacion = $ubicacion."/".$carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName() ;
        $documento->FK_TBL_Convenio_Id= $id;
        $documento->save();
    }
    /*funcion para descargar el documento subido para el convenio
    *@param int id  
    *@param int idc
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    *
    */
    public function documentoDescarga(Request $request, $id, $idc)
    {
        $documento = Documentacion::select('DOCU_Ubicacion')->where('PK_DOCU_Documentacion', $id)->get();
        foreach ($documento as $row) {
            if ($exists = Storage::disk('developer')->exists($row->DOCU_Ubicacion)) {
                $Contents = Storage::disk('developer')->get($row->DOCU_Ubicacion);
                return response()->download(storage_path()."/app/public/developer/".$row->DOCU_Ubicacion, $row->DOCU_Nombre);
                return AjaxResponse::success('¡Bien hecho!', 'documento descargado correctamente.');
            } else {
                return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
            }
        }
    }
    /*funcion para enviar a la vista principal de listar mis documentos
    *@return \Illuminate\Http\Response
    */
    public function misDocumentos()
    {
        return view($this->path.'.Listar_Mis_Documentos');
    }
    /*funcion para envio de los datos para la tabla de datos
    *@param \Illuminate\Http\Request
    *@return Yajra\DataTables\DataTable
    */
    public function listarMisDocumentos(Request $request)
    {
        $documento = DocumentacionExtra::select('PK_DCET_Documentacion_Extra', 'DCET_Ubicacion', 'DCET_Nombre')
            ->where('FK_TBL_Usuarios_Id', $request->user()->identity_no)->get();
        return Datatables::of($documento)->addIndexColumn()->make(true);
    }
    /*funcion para subir el documento para los Usuarios
    *@param \Illuminate\Http\Request
    *@return
    */
    public function subirDocumentoUsuario(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $ubicacion="unvinteraction/usuario/".$request->user()->identity_no;
        $files = $request->file('file');
        foreach ($files as $file) {
            $url = Storage::disk('developer')->putFileAs($ubicacion, $file,$carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName());
        }
        $doc = new DocumentacionExtra();
        $doc->DCET_Nombre = $carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName();
        $doc->DCET_Ubicacion = $ubicacion ;
        $doc->FK_TBL_Usuarios_Id=$request->user()->identity_no ;
        $doc->save();
        return $request->get('name');
    }
    /*funcion para descargar el documento subido para el usuario
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function documentoDescargaUsuario(Request $request, $id)
    {
        $ubicacion="unvinteraction/usuario/".$request->user()->identity_no;
        $documento=DocumentacionExtra::select('DCET_Ubicacion', 'DCET_Nombre')
            ->where('FK_TBL_Usuarios_Id', $request->user()->identity_no)
            ->where('PK_DCET_Documentacion_Extra', $id)->get();
        foreach ($documento as $row) {
            if ($exists = Storage::disk('developer')->exists($row->DCET_Ubicacion."/".$row->DCET_Nombre)) {
                return response()
                    ->download(storage_path()."/app/public/developer/".$row->DCET_Ubicacion."/".$row->DCET_Nombre,$row->DCET_Nombre);
                return AjaxResponse::success('¡Bien hecho!', 'documento descargado correctamente.');
            } else {
                return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
            }
        }
    }
    /*funcion para descargar el documento subido para el usuario
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function documentoReporte(Request $request,$id,$fecha_primera,$fecha_segunda)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $evaluacion=Evaluacion::where('VLCN_Evaluado',$id)->whereBetween('VLCN_Fecha',[$fecha_primera,$fecha_segunda])->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado','VLCN_Fecha')
                ->with([
                    'conveniosEvaluacion'=>function ($query) {
                        $query->select('PK_CVNO_Convenio','CVNO_Nombre');
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
            return view($this->path.'.ReportePDF', [
                'evaluacion'=>$evaluacion,
                'date'=>$date,
                'time'=>$time,
                'id'=>$id,
                'fecha_primera'=>$fecha_primera,
                'fecha_segunda'=>$fecha_segunda
            ]);
            }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar su solicitud.'
        );
    }
    /*
     * Descarga de reporte de evaluaciones filtradas por fechas
     *
	 * @param  \Illuminate\Http\Request 
     * @param   int id
     * @param   date fecha_primera
     * @param   date fecha_segunda
     *
     * @return Barryvdh\Snappy\Facades\SnappyPdf | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function descargarReporte(Request $request,$id,$fecha_primera,$fecha_segunda)
    {
        if ($request->isMethod('GET')) {
            try{
                $date = date("d/m/Y");
                $time = date("h:i A");
                $evaluacion=Evaluacion::where('VLCN_Evaluado',$id)->whereBetween('VLCN_Fecha',[$fecha_primera,$fecha_segunda])->select('FK_TBL_Convenio_Id','PK_VLCN_Evaluacion','VLCN_Nota_Final','VLCN_Evaluador','VLCN_Evaluado','VLCN_Fecha')
                ->with([
                    'conveniosEvaluacion'=>function ($query) {
                        $query->select('PK_CVNO_Convenio','CVNO_Nombre');
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
                return SnappyPdf::loadView($this->path.'.ReportePDF', [
                    'evaluacion'=>$evaluacion,
                    'date'=>$date,
                    'time'=>$time,
                    'id'=>$id,
                    'fecha_primera'=>$fecha_primera,
                    'fecha_segunda'=>$fecha_segunda
                ])->download('ReporteEvaluaciones.pdf');
            } catch (Exception $e) {
                return $e."error";
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar su solicitud.'
        );
    }
    /*
     * Descarga de reporte de evaluaciones filtradas por fechas
     *
	 * @param  \Illuminate\Http\Request 
     * @param   int id
     * @param   date fecha_primera
     * @param   date fecha_segunda
     *
     * @return Barryvdh\Snappy\Facades\SnappyPdf | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function documentoUsuario(Request $request,$id){
        
        return view($this->path.'.Listar_Documentos_Usuarios',compact('id'));
    }
    /*
     * Descarga de reporte de evaluaciones filtradas por fechas
     *
	 * @param  \Illuminate\Http\Request 
     * @param   int id
     * @param   date fecha_primera
     * @param   date fecha_segunda
     *
     * @return Barryvdh\Snappy\Facades\SnappyPdf | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function listarDocumentoUsuario(Request $request,$id){
        $documento = DocumentacionExtra::select('PK_DCET_Documentacion_Extra', 'DCET_Ubicacion', 'DCET_Nombre')
            ->where('FK_TBL_Usuarios_Id', $id)->get();
        return Datatables::of($documento)->addIndexColumn()->make(true);
    }
  
}
