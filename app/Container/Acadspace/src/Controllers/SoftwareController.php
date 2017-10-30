<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Solicitud;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Software;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class SoftwareController extends Controller
{


    /**
     * Funcion mostrar vista de gestion software
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('acadspace.Software.formularioSoftware');
        }
    }

    /**
     * Funcion para registrar un nuevo software retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
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
     * @return \Yajra\DataTables\ | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $software = Software::where('PK_SOF_Id', '!=', 1);
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
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            $validator = Solicitud::where('FK_SOL_Id_Software', $id)
                ->count();
            if ($validator == 0) {
                $software = software::find($id);
                $software->delete();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Software eliminado correctamente.'
                );
            } else {
                return AjaxResponse::success(
                    '¡Error!',
                    'Primero debe eliminar las solicitudes asociadas al software.'
                );
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


}