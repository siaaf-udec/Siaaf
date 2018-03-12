<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Aulas;
use App\Container\Acadspace\src\Espacios;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;

class AulasController extends Controller
{

    /**
     * Funcion para mostrar la vista de Aulas
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $espa = new espacios();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
            return view('acadspace.Aulas.formularioAulas',
                [
                    'espacios' => $espacios->toArray()
                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Verificando que el aula no exista.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function verificarAula(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'nomb_sala' => 'unique:acadspace.TBL_Aulas,SAL_Nombre_Sala'
            ]);
            if (empty($validator->errors()->all())) {
                return response('true');
            } else {
                return response('false');
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * Funcion para registrar una nueva aula retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
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
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $aulas = Aulas::select('PK_SAL_Id_Sala', 'SAL_Nombre_Sala', 'FK_SAL_Id_Espacio')
                ->with(['espacio' => function ($query) {
                    return $query->select('PK_ESP_Id_Espacio',
                        'ESP_Nombre_Espacio as N_espacio');
                }])
                ->get();
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
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
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