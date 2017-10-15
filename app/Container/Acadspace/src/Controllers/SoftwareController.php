<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Software;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class SoftwareController extends Controller
{


    /**
     * Funcion mostrar vista de gestion software
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('acadspace.Software.formularioSoftware');
    }

    /**
     * Funcion para registrar un nuevo software retorna un mensaje Ajax
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function registroSoftware(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Software::create($request->all());
            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Software registrado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Funcion creada para cargar datatable con software
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $software = Software::all();
            return Datatables::of($software)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * Funcion para eliminar software entre los registrados
     * retorna mensaje ajax
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $software = software::find($id);
            $software->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Software eliminado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


}