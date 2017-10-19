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
use App\Container\Acadspace\src\Incidentes;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class IncidentesController extends Controller
{
    /**
     * Funcion para mostrar la vista de incidentes
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('acadspace.Incidentes.formularioIncidente');
    }

    /**
     * Funcion registrar incidente retorna un mensaje Ajax
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function regisIncidente(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Incidentes::create([
                'FK_INC_Id_User' => $request['FK_INC_Id_User'],
                'INC_Nombre_Espacio' => $request['INC_Nombre_Espacio'],
                'INC_Descripcion' => $request['INC_Descripcion']
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Incidente registrado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Funcion cargar datatable con incidentes registrados
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \Yajra\DataTables\DataTables
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $incidentes = Incidentes::all();
            return Datatables::of($incidentes)
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
     * Funcion eliminar incidentes registrados
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $aulas = Incidentes::find($id);
            $aulas->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Incidente eliminado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


}