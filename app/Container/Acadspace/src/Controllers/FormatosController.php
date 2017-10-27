<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Formatos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;
use App\Mail\Acadspace\EmailAcadspace;
use Illuminate\Support\Facades\Mail;


class formatosController extends Controller
{

    /**
     * Funcion para mostrar la vista de solicitudes de formatos academicos para secretarias
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //Muestra vista de solicitudes por id_secretaria
        return view('acadspace.FormatosAcademicos.mostrarEstSolFormAcad');
    }

    /**
     * Funcion para mostrar la vista de solicitudes de formatos academicos para secretarias
     * @return \Illuminate\View\View
     */
    public function indexAjax()
    {
        //Muestra vista de solicitudes por id_secretaria
        return view('acadspace.FormatosAcademicos.mostrarEstSolFormAcad-ajax');
    }

    /**
     * Funcion para mostrar la vista de solicitudes de formatos academicos para el administrador
     * @return \Illuminate\View\View
     */
    public function listSol()
    {
        //Muestra vista de solicitudes realizadas por secretarias
        return view('acadspace.FormatosAcademicos.mostrarSolicitudesFormAcad');

    }


    /**
     * Funcion para registrar un nuevo formato academico mediante ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        if ($request->ajax() && $request->isMethod('POST')) {
            $model = new formatos();//Crea nuevo modelo
            $archivos = $request->file('file');
            foreach ($archivos as $archivo) {
                $url = Storage::disk('acadspace')->putFile('formatos', $archivo);
            }
            $model->FAC_Titulo_Doc = $request['titulo'];
            $model->FAC_Descripcion_Doc = $request['descripcion'];
            $model->FAC_Nombre_Doc = $url;
            $model->FAC_Correo = $request['email'];
            $model->FAC_Estado = 0;
            $model->FK_FAC_Id_Secretaria = $id;
            $model->save();
            //Envio de correo
            Mail::to($request['email'])->send(new EmailAcadspace("Nuevo formato academico", "Ha recibido un nuevo formato academico"));

            return AjaxResponse::success(
            //Envia notificacion de registro satisfactorio
                '¡Bien hecho!',
                'Formato registrado correctamente.'
            );

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * Funcion para editar el estado de la solicitud, 0 => sin revisar; 1=> editada
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $solicitud = formatos::find($id);
            $solicitud->FAC_Estado = 1;
            $solicitud->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * Funcion para descargar el archivo que se ha cargado en la solicitud
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function descargarPublicacion(Request $request, $id)
    {
        //Recibe id de solicitud
        $solicitudess = formatos::find($id);
        //Crea ruta con el nombre del archivo a descargar
        $rutaarchivo = "../storage/app/public/acadspace/" . $solicitudess->FAC_Nombre_Doc;
        //Retorna y descarga el archivo
        return response()->download($rutaarchivo);

    }

    /**
     * funcion para cargar las solicitudes realizadas y saber el estado actual en el que esta
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function data(Request $request)
    {
        //Recibe peticion Ajax
        if ($request->ajax() && $request->isMethod('GET')) {
            $id = Auth::id();//Trae ID usuario
            $solic = formatos::where('FK_FAC_Id_Secretaria', $id)->get();//Trae solicitudes por id_secretaria
            return DataTables::of($solic)
                //Realiza consulta ide de estado y carga con nombre
                ->addColumn('estado', function ($solic) {
                    if ($solic->FAC_Estado == 1) {
                        return "<span class='label label-sm label-success'>" . 'Revisado' . "</span>";
                    } elseif ($solic->FAC_Estado == 0) {
                        return "<span class='label label-sm label-warning'>" . 'Pendiente' . "</span>";
                    }
                })
                ->rawColumns(['estado'])
                //Elimina columnas no necesarias
                ->removeColumn('FAC_Correo')
                ->removeColumn('FAC_Descripcion_Doc')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);//Retorna tabla creada

        }
        //Envia notificacion de no recibir peticion ajax
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }

    /**
     * Funcion para cargar las solicitudes existentes sin editar en la tabla
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function dataListSol(Request $request)
    {
        $id = Auth::id();//Trae ID usuario
        //Recibe peticion Ajax
        if ($request->ajax() && $request->isMethod('GET')) {
            $solic = formatos::select(['PK_FAC_Id_Formato',
                'FAC_Titulo_Doc', 'created_at', 'FK_FAC_Id_Secretaria'])
                ->with(['user' => function ($query) {
                    return $query->select('id', 'name', 'lastname');
                }])
                ->where('FAC_Estado', '=', 0)
                ->get();
            return DataTables::of($solic)
                ->addIndexColumn()
                ->make(true);//Retorna tabla creada
        }
        //Envia notificacion de no recibir peticion ajax
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }
}
