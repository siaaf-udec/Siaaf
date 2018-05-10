<?php

namespace App\Container\AdminRegist\Src\Controllers;

use App\Container\AdminRegist\Src\Sugerencias;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Permissions\src\Role;
use App\Notifications\HeaderSiaaf;

class SugerenciaController extends Controller
{
    /**
     *Función que redirecciona a la vista de la tabla donde se mostraran las sugerencias de las preguntas registradas.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('adminregist.sugerencias.tablaSugerencia');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     *Función que muestra las preguntas sugeridas registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('adminregist.sugerencias.ajaxTablaSugerencia');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Función que consulta las sugerencias de las preguntas registradas y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $sugerencia = Sugerencias::query();

            return DataTables::of($sugerencia)
                ->addColumn('SU_Estado', function ($sugerencia) {
                    if (!strcmp($sugerencia->SU_Estado, 'Resuelta')) {
                        return "<span class='label label-sm label-success'>" . $sugerencia->SU_Estado . "</span>";
                    } elseif (!strcmp($sugerencia->SU_Estado, 'Sin Resolver')) {
                        return "<span class='label label-sm label-warning'>" . $sugerencia->SU_Estado . "</span>";
                    }
                })
                ->rawColumns(['SU_Estado'])
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
     * Función que almacena en la base de datos una sugerencia de las preguntas.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $sugerencia = Sugerencias::create([
                'SU_Username' => $request['SU_Username'],
                'SU_Email' => $request['SU_Email'],
                'SU_Pregunta' => $request['SU_Pregunta'],
            ]);
           $role = Role::where('name', '=', 'Adminis_AdminRegist')->first();
            $user = $role->users()->get();
            foreach ($user as $dato) {
                /*Crea Notificacion*/
                $data = [
                    'url' => '/adminregist/sugerencia/index',
                    'description' => '¡Tienes una Sugerencia!',
                    'image' => 'assets/layouts/layout2/img/avatar3.jpg'
                ];
                $dato->notify(new HeaderSiaaf($data));
            }

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
     * Función que realiza la eliminación de los registros de una nsugerencia de las preguntas.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $sugerencia = Sugerencias::where('PK_SU_IdSugerencia', '=', $id)->delete();

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

}