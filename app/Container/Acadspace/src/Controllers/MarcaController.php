<?php

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Articulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Marca;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class MarcaController extends Controller
{
    private $path='acadspace.Marca';
    public function index(Request $request)
    {
        return view('acadspace.Marca.formularioMarca');
    }

    /**
     * Funcion registrar marca retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function regisMarca(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Marca::create([
                'MAR_Nombre' => $request['MAR_Nombre']
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Marca registrada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
     /**
     * Funcion cargar datatable con marcas registradas
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $marcas = Marca::select();
            return Datatables::of($marcas)
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
    /*funcion para buscar una Marca y pasarle la información
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function editarMarca(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $marca = Marca::findOrFail($id);
            return view($this->path.'.formularioEditarMarca',compact('marca'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para modificar una Marca
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function modificarMarca(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $marca = Marca::findOrFail($id);
            $marca->MAR_Nombre = $request->MAR_Nombre;
            $marca->save();
            return AjaxResponse::success('¡Bien hecho!', 'Datos modificados correctamente.');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
       /**
     * Funcion para eliminar marca entre los registrados
     * retorna mensaje ajax
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id){
        if ($request->ajax() && $request->isMethod('DELETE')) {
                $marca = Marca::find($id);
                $marca->delete();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Marca eliminada correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Error!',
                'Primero debe eliminar los elementos asociados a la marca.'
            );
        }
}
