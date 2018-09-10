<?php

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Hojavida;
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
    public function index(Request $request, $id)
    {

        if ($request->isMethod('GET')) {
            $marca = new Marca();
            $Marcas = $marca->pluck('MAR_Nombre', 'PK_MAR_Id_Marca');
            return view('acadspace.Hojavida.formularioHojavida',
                [
                    'marcas' => $Marcas->toArray(),
                    'id_articulo' => $id

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

            Hojavida::create([
                'HOJ_Modelo_Equipo' => $request['HOJ_Modelo_Equipo'],
                'HOJ_Procesador' => $request['HOJ_Procesador'],
                'HOJ_Memoria_Ram' => $request['HOJ_Memoria_Ram'],
                'HOJ_Disco_Duro' => $request['HOJ_Disco_Duro'],
                'HOJ_Mouse' => $request['HOJ_Modelo_Equipo'],
                'HOJ_Teclado' => $request['HOJ_Teclado'],
                'HOJ_Sistema_Operativo' => $request['HOJ_Sistema_Operativo'],
                'HOJ_Antivirus' => $request['HOJ_Antivirus'],
                'HOJ_Garantia' => $request['HOJ_Garantia'],
                'FK_HOJ_Id_Marca' => $request['MAR_Nombre']
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