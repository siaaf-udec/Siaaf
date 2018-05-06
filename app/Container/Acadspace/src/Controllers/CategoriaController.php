<?php

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Articulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Categoria;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class CategoriaController extends Controller
{
    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
            $cate = new categoria();
            $categorias = $cate->pluck('CAT_Nombre', 'PK_CAT_Id_Categoria');
            return view('acadspace.Categoria.formularioCategoria',
                [
                    'categoria' => $categorias->toArray()
                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion registrar categoria retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function regisCategoria(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Categoria::create([
                'CAT_Nombre' => $request['CAT_Nombre']
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Categoria agregada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
     /**
     * Funcion cargar datatable con categorias registradas
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $categorias = Categoria::select();
            return Datatables::of($categorias)
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
     * Funcion para eliminar categoria entre los registrados
     * retorna mensaje ajax
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            $validator=Articulo::where('FK_ART_Id_Categoria', $id)
                ->count();
            if ($validator == 0) {
                $categoria = Categoria::find($id);
                $categoria->delete();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Categoria eliminada correctamente.'
                );
            } else {
                return AjaxResponse::success(
                    '¡Error!',
                    'Primero debe eliminar los elementos asociados a la categoria.'
                );
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}