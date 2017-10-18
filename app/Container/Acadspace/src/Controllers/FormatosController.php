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
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;
use App\Mail\Acadspace\EmailAcadspace;
use Illuminate\Support\Facades\Mail;


class formatosController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //Muestra vista de solicitudes por id_secretaria
        return view('acadspace.FormatosAcademicos.mostrarEstSolFormAcad');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexajax()
    {
        //Muestra vista de solicitudes por id_secretaria
        return view('acadspace.FormatosAcademicos.mostrarEstSolFormAcad-ajax');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSol()
    {
        //Muestra vista de solicitudes realizadas por secretarias
        return view('acadspace.FormatosAcademicos.mostrarSolicitudesFormAcad');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {

        //Recibe peticion Ajax
        if ($request->ajax() && $request->isMethod('GET')) {
            //Carga formulario para crear solicitud
            return view('acadspace.FormatosAcademicos.registroSolicitudFormAcad');

        }
        //Envia notificacion de no recibir peticion ajax
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
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
            $model->FAC_Nombre_Doc = $url;
            $model->FAC_Estado = 0;
            $model->FK_FAC_Id_Secretaria = $id;
            $model->save();
            return AjaxResponse::success(
            //Envia notificacion de registro satisfactorio
                '¡Bien hecho!',
                'Formato registrado correctamente.'
            );

        }
    }




    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
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
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function descargar_publicacion(Request $request, $id)
    {
        //Recibe id de solicitud
        $solicitudess = formatos::find($id);
        //Crea ruta con el nombre del archivo a descargar
        $rutaarchivo = "../storage/app/public/acadspace/" . $solicitudess->FAC_Nombre_Doc;
        //Retorna y descarga el archivo
        return response()->download($rutaarchivo);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        //Recibe peticion Ajax
        if ($request->ajax() && $request->isMethod('GET')) {
            //$solic = formatos::all();
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
     * @param Request $request
     * @return \Illuminate\Http\Response
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
