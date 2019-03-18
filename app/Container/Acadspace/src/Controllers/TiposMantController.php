<?php

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Articulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\TiposMant;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class TiposMantController extends Controller
{
    private $path='acadspace.TiposMant';
    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
            $tipo = new TiposMant();
            $tipos = $tipo->pluck('MAN_Nombre', 'PK_MAN_Id_Tipo');
            return view('acadspace.TiposMant.formularioTiposMant',
                [
                    'tiposmant' => $tipos->toArray()
                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion registrar tipo retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function regisTipo(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            TiposMant::create([
                'MAN_Nombre' => $request['MAN_Nombre'],
                'MAN_Descripcion' => $request['MAN_Descripcion'],
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Tipo registrado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
     /**
     * Funcion cargar datatable con tipos registrados
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $tiposMant = TiposMant::select();
            return Datatables::of($tiposMant)
                ->removeColumn('create_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
         /*funcion para buscar un tipo y pasarle la información
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function editarTipo(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $tiposMant = TiposMant::findOrFail($id);
            return view($this->path.'.formularioEditarTiposMant',compact('tiposMant'));
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    /*funcion para modificar un tipo 
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function modificarTipo(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $tiposMant = TiposMant::findOrFail($id);
            $tiposMant->MAN_Nombre = $request->MAN_Nombre;
            $tiposMant->MAN_Descripcion = $request->MAN_Descripcion;
            $tiposMant->save();
            return AjaxResponse::success('¡Bien hecho!', 'Datos modificados correctamente.');

        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
       /**
     * Funcion para eliminar tipos entre los registrados
     * retorna mensaje ajax
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            $tipoMant = TiposMant::find($id);
            $tipoMant->delete();
            return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Tipo eliminado correctamente.'
                );
        } else {
            return AjaxResponse::fail(
                '¡Error!',
                'Primero debe eliminar los elementos asociados al tipo.'
            );
        }
    }
}