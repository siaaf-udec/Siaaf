<?php

namespace App\Container\AdminRegist\Src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\AdminRegist\Src\Help;

class HelpController extends Controller
{
    /**
     *Función que redirecciona a la vista de la tabla donde se mostraran las preguntas y respuestas registradas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('adminregist.help.tablaHelp');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     *Función que muestra las preguntas y respuestas registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('adminregist.help.ajaxTablaHelp');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Función que consulta las preguntas y respuestas registradas y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $help = Help::query();

            return DataTables::of($help)
                ->addColumn('HE_Pregunta', function ($help) {
                    return "<textarea readonly class='form-control'>" . $help->HE_Pregunta . "</textarea>";
                })
                ->rawColumns(['HE_Pregunta'])
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
     * Función que redirecciona a la vista del formulario de registro de una nueva pregunta con su respuesta.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('adminregist.help.registroHelp');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos una nueva pregunta con su respuesta.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Help::create([
                'HE_Pregunta' => $request['pregunta'],
                'HE_Respuesta' => $request['respuesta'],
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
     * Función que recibe el id de la pregunta a modificar y despues redirecciona a la vista del formulario con los datos para editar el regitro de la pregunta y su respuesta.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $help = Help::find($id);
            return view('adminregist.help.editHelp',
                [
                    'help' => $help,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Se realiza la actualización de los datos de la pregunta con su respuesta.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $help = Help::find($request['id']);
            $help->HE_Pregunta = $request['pregunta'];
            $help->HE_Respuesta = $request['respuesta'];
            $help->save();
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
     * Función que realiza la eliminación de los registros de una pregunta con su respuesta.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $help = Help::where('PK_HE_IdHelp', '=', $id)->delete();

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
     *Función que redirecciona a la vista donde se mostraran las preguntas y respuestas registradas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPreguntas(Request $request)
    {
        if ($request->isMethod('GET')) {
            $help = Help::all();
            $help->pull('created_at','updated_at','PK_HE_IdHelp');
            return view('adminregist.help.indexHelp', compact('help'));
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }


}