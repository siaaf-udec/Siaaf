<?php

namespace App\Container\AdminRegist\Src\Controllers;

use App\Container\AdminRegist\Src\Novedad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Container\Overall\Src\Facades\AjaxResponse;

class NovedadesController extends Controller
{
    /**
     *Función que redirecciona a la vista de la tabla donde se mostraran las novedades registradas.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('adminregist.novedades.tablaNovedad');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     *Función que muestra las novedades registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('adminregist.novedades.ajaxTablaNovedad');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Función que consulta las novedades registradas y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $novedad = Novedad::query();

            return DataTables::of($novedad)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que redirecciona a la vista del formulario de registro de una nueva novedad.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('adminregist.novedades.createNovedad');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos una nueva novedad.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Novedad::create([
                'NOV_NombreNovedad' => $request['NOV_NombreNovedad'],
            ]);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Pregunta Agregada correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que recibe el id de la pregunta a modificar y despues redirecciona a la vista del formulario con los datos para editar el regitro de la novedad.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $novedad = Novedad::find($id);
            return view('adminregist.novedades.editNovedad',
                [
                    'novedad' => $novedad,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Se realiza la actualización de los datos de la novedad.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $novedad = Novedad::find($request['id']);
            $novedad->NOV_NombreNovedad = $request['NOV_NombreNovedad'];
            $novedad->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que realiza la eliminación de los registros de una novedad.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $novedad = Novedad::where('PK_NOV_IdNovedad', '=', $id)->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * Muestra la lista de dependencias registradas para el select del registro.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function listarNovedades(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $novedades = Novedad::all();
            $novedades->pull('created_at', 'updated_at');
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $novedades
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

}