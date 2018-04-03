<?php

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Articulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Procedencia;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class ProcedenciaController extends Controller
{
    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
            $proce = new procedencia();
            $procedencias = $proce->pluck('tipo_procedencia', 'pk_id_procedencia');
            return view('acadspace.Procedencia.formularioProcedencia',
                [
                    'procedencias' => $procedencias->toArray()
                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion registrar procedencia retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function regisProcedencia(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Procedencia::create([
                'tipo_procedencia' => $request['tipo_procedencia']
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Procedencia registrada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
     /**
     * Funcion cargar datatable con procedencias registradas
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $procedencias = Procedencia::select();
            return Datatables::of($procedencias)
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
     * Funcion para eliminar procedencia entre los registrados
     * retorna mensaje ajax
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            $validator=Articulo::where('fk_id_procedencia', $id)
                ->count();
            if ($validator == 0) {
                $procedencia = Procedencia::find($id);
                $procedencia->delete();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Procedencia eliminada correctamente.'
                );
            } else {
                return AjaxResponse::success(
                    '¡Error!',
                    'Primero debe eliminar los elementos asociados a la procedencia.'
                );
            }
        }
    }
}