<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\comentariosSolicitud;
use App\Container\Acadspace\src\Formatos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Users\src\User;
use App\Container\Acadspace\src\solSoftware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

use App\Notifications\HeaderSiaaf;

use PhpParser\Node\Stmt\Return_;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Container\Permissions\Src\Interfaces\ModuleInterface;
use App\Container\Permissions\Src\Interfaces\RoleInterface;
use App\Container\Overall\Src\Facades\UploadFile;

use App\Container\Users\Src\Country;

use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;

class formatosController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Muestra vista de solicitudes por id_secretaria
        return view('acadspace.FormatosAcademicos.mostrarEstSolFormAcad');
    }

    public function indexajax()
    {
        //Muestra vista de solicitudes por id_secretaria
        return view('acadspace.FormatosAcademicos.mostrarEstSolFormAcad-ajax');
    }

    public function listSol()
    {
        //Muestra vista de solicitudes realizadas por secretarias
        return view('acadspace.FormatosAcademicos.mostrarSolicitudesFormAcad');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //Recibe peticion Ajax
        if ($request->ajax() && $request->isMethod('GET')) {
            //Carga formulario para crear solicitud
            return view('acadspace.FormatosAcademicos.registroSolicitudFormAcad');

        } else {
            //Envia notificacion de no recibir peticion ajax
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Recibe peticion Ajax
        if ($request->ajax() && $request->isMethod('POST')) {

            $model = new formatos();//Crea nuevo modelo
            $id = Auth::id();//Trae ID usuario
            $archivo = $request->file('path');//Recibe archivo a cargar
            if ($archivo !== null) {
                $url = Storage::disk('acadspace')->putFile('formatos', $archivo);;//Guarda el archivo
                //Asigna valores a los campos
                $model->FAC_nombre_doc = $url;
                $model->FAC_titulo_doc = $request['nombre'];
                $model->FAC_descripcion_doc = $request['descripcion'];
                $model->FK_FAC_id_secretaria = $id;
                $model->FAC_correo = $request['correo'];
                $model->FAC_estado = 0;
                $model->save(); //Registra los campos

                return AjaxResponse::success(
                //Envia notificacion de registro satisfactorio
                    '¡Bien hecho!',
                    'Formato registrado correctamente.'
                );
            }


        } else {
            //Envia notificacion de no recibir peticion ajax
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $solicitud = formatos::find($id);
            $solicitud->FAC_estado = 1;
            $solicitud->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function descargar_publicacion(Request $request, $id)
    {
        //Recibe id de solicitud
        $solicitudess = formatos::find($id);
        //Crea ruta con el nombre del archivo a descargar
        $rutaarchivo = "../storage/app/public/acadspace/" . $solicitudess->FAC_nombre_doc;
        //Retorna y descarga el archivo
        return response()->download($rutaarchivo);

    }

    public function data(Request $request)
    {
        //Recibe peticion Ajax
        if ($request->ajax() && $request->isMethod('GET')) {
            //$solic = formatos::all();
            $id = Auth::id();//Trae ID usuario
            $solic = formatos::where('FK_FAC_id_secretaria', $id)->get();//Trae solicitudes por id_secretaria

            return DataTables::of($solic)
                //Realiza consulta ide de estado y carga con nombre
                ->addColumn('estado', function ($solic) {
                    if ($solic->FAC_estado == 1) {
                        return "<span class='label label-sm label-success'>" . 'Revisado' . "</span>";
                    } elseif ($solic->FAC_estado == 0) {
                        return "<span class='label label-sm label-warning'>" . 'Pendiente' . "</span>";
                    }
                })
                ->rawColumns(['estado'])
                //Elimina columnas no necesarias
                ->removeColumn('FAC_correo')
                ->removeColumn('FAC_descripcion_doc')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);//Retorna tabla creada

        } else {
            //Envia notificacion de no recibir peticion ajax
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    public function dataListSol(Request $request)
    {
        $id = Auth::id();//Trae ID usuario
        //Recibe peticion Ajax
        if ($request->ajax() && $request->isMethod('GET')) {
            $solic = formatos::where('FAC_estado', '=', 0)->select(['tbl_solformacad.PK_FAC_id_solicitud', 'tbl_solformacad.FAC_titulo_doc', 'tbl_solformacad.created_at', 'users.name as name', 'users.lastname as lastname'])
                ->join('developer.users', 'tbl_solformacad.FK_FAC_id_secretaria', '=', 'developer.users.id')
                ->get();
            return DataTables::of($solic)
                ->addIndexColumn()
                ->make(true);//Retorna tabla creada

        } else {
            //Envia notificacion de no recibir peticion ajax
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }
}
