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
use App\Container\Acadspace\src\Aulas;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class AulasController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('acadspace.Aulas.formularioAulas');
    }


    /**
     * @param Request $request
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

    //Funcion creada para cargar datatable con aulas

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
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
     * @param Request $request
     * @param $id
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