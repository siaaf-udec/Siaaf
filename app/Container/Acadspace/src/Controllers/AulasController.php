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
use App\Container\Acadspace\src\Aulas;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;

class AulasController extends Controller
{

    /**
     * Funcion para mostrar la vista de Aulas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('acadspace.Aulas.formularioAulas');
    }


    /**
     * Funcion para registrar una nueva aula retorna un mensaje Ajax
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function regisAula(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Aulas::create($request->all());
            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Aula registrada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Funcion creada para cargar datatable con aulas actuales
     * @param \Illuminate\Http\Request $request
     * @return \Yajra\DataTables\DataTables | \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            // $articulos = software::all(['nombre_soft','version','licencias'])->get();
            $aulas = Aulas::all();
            return Datatables::of($aulas)
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
     * Funcion para eliminar aulas de acuerdo al id
     * retorna mensaje ajax
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $aulas = Aulas::find($id);
            $aulas->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Aula eliminada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

}