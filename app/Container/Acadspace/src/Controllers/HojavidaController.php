<?php

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Incidentes;
use App\Container\Acadspace\src\Marca;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class HojavidaController extends Controller
{
    /**
     * Funcion para mostrar la vista de incidentes
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
            $marca = new Marca();
            $Marcas = $marca->pluck('PK_MAR_Id_Marca', 'MAR_Nombre');
            return view('acadspace.Hojavida.formularioHojavida',
                [
                    'marcas' => $Marcas->toArray()
                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion registrar incidente retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function regisHojavida(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Incidentes::create([
                'FK_INC_Id_User' => $request['FK_INC_Id_User'],
                'FK_INC_Id_Articulo' => $request['FK_INC_Id_Articulo'],
                'FK_INC_Id_Espacio' => $request['INC_Nombre_Espacio'],
                'INC_Descripcion' => $request['INC_Descripcion']
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Incidente registrado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Funcion cargar datatable con incidentes registrados
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function data(Request $request)
    {
    }

    /**
     * Funcion eliminar incidentes registrados
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {

    }

}