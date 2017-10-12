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
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Acadspace\src\Incidentes;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class IncidentesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acadspace.Incidentes.formularioIncidente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acadspace.Aulas.formularioAulas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function regisIncidente(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Incidentes::create([
                'FK_INC_id_user' => $request['FK_INC_id_user'],
                'INC_nombre_espacio' => $request['INC_nombre_espacio'],
                'INC_descripcion' => $request['INC_descripcion']
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Aula registrada correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    //Funcion creada para cargar datatable con aulas

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
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
     * @param Request $request
     * @param $id
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