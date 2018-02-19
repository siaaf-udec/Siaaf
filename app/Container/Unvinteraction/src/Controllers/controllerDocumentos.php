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
use App\Container\Unvinteraction\src\Documentacion_Extra;
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
        $Ubicacion="unvinteraction/convenios/".$id;
        $files = $request->file('file');
        foreach ($files as $file) {
            $url = Storage::disk('developer')->putFileAs($Ubicacion, $file, $carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName());
        }
        $Estado = new TBL_Documentacion();
        $Estado->Entidad =$carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName();
        $Estado->Ubicacion = $Ubicacion."/".$carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName() ;
        $Estado->FK_TBL_Convenios= $id;
        $Estado->save();
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
        $Ubicacion ="unvinteraction/convenios/".$id;
        $Documento = TBL_Documentacion::select('TBL_Documentacion.Ubicacion')->where('PK_Documentacion', $id)->get();
        foreach ($Documento as $row) {
            if ($exists = Storage::disk('developer')->exists($row->Ubicacion)) {
                $Contents = Storage::disk('developer')->get($row->Ubicacion);
                return response()->download(storage_path()."/app/public/developer/".$row->Ubicacion, "documento.jpg");
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
        $documento = TBL_Documentacion_Extra::select('PK_Documentacion_Extra', 'Descripcion', 'Ubicacion', 'Entidad')
            ->where('FK_TBL_Usuarios', $request->user()->identity_no)->get();
        return Datatables::of($documento)->addIndexColumn()->make(true);
    }
    /*funcion para subir el documento para los Usuarios
    *@param \Illuminate\Http\Request
    *@return
    */
    public function subirDocumentoUsuario(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $Ubicacion="unvinteraction/usuario/".$request->user()->identity_no;
        $files = $request->file('file');
        foreach ($files as $file) {
            $url = Storage::disk('developer')->putFileAs($Ubicacion, $file,$carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName());
        }
        $Estado = new TBL_Documentacion_Extra();
        $Estado->Entidad = $carbon->now()->format('y-m-d-h-m-s').$file->getClientOriginalName();
        $Estado->Ubicacion = $Ubicacion ;
        $Estado->FK_TBL_Usuarios=$request->user()->identity_no ;
        $Estado->Descripcion = 'NINGUNA';
        $Estado->save();
        return $request->get('name');
    }
    /*funcion para descargar el documento subido para el usuario
    *@param int id
    *@param \Illuminate\Http\Request
    *@return App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function documentoDescargaUsuario(Request $request, $id)
    {
        $Ubicacion="unvinteraction/usuario/".$request->user()->identity_no;
        $Documento=TBL_Documentacion_Extra::select('Ubicacion', 'Entidad')
            ->where('FK_TBL_Usuarios', $request->user()->identity_no)
            ->where('PK_Documentacion_Extra', $id)->get();
        foreach ($Documento as $row) {
            if ($exists = Storage::disk('developer')->exists($row->Ubicacion."/".$row->Entidad)) {
                return response()
                    ->download(storage_path()."/app/public/developer/".$row->Ubicacion."/".$row->Entidad,"Documento.jpg");
                return AjaxResponse::success('¡Bien hecho!', 'documento descargado correctamente.');
            } else {
                return AjaxResponse::fail('¡Lo sentimos!', 'No se pudo completar tu solicitud.');
            }
        }
    }
    public function documentoReporte(Request $request,$id,$fecha_primera,$fecha_segunda)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $Evaluacion=TBL_Evaluacion::where('Evaluado',$id)->whereBetween('Fecha',[$fecha_primera,$fecha_segunda])->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado','Fecha')
                ->with([
                    'convenios_Evaluacion'=>function ($query) {
                        $query->select('PK_Convenios','Nombre');
                    }
                ])
            ->with([
                'evaluador'=>function ($query) {
                    $query->select('identity_no','name','lastname');
                }
            ])
            ->get();
            return view($this->path.'.ReportePDF', [
                'Evaluacion'=>$Evaluacion,
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
                $Evaluacion=TBL_Evaluacion::where('Evaluado',$id)->whereBetween('Fecha',[$fecha_primera,$fecha_segunda])->select('FK_TBL_Convenios','PK_Evaluacion','Nota_Final','Evaluador','Evaluado','Fecha')
                    ->with([
                        'convenios_Evaluacion'=>function ($query) {
                            $query->select('PK_Convenios','Nombre');
                        }
                    ])
                    ->with([
                        'evaluador'=>function ($query) {
                            $query->select('identity_no','name','lastname');
                        }
                    ])
                    ->get();
                return SnappyPdf::loadView($this->path.'.ReportePDF', [
                    'Evaluacion'=>$Evaluacion,
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
  
}
