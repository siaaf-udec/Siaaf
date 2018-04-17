<?php

namespace App\Container\AdminRegist\Src\Controllers;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Users\src\UsersUdec;
use App\Container\Users\src\Controllers\UsersUdecController;

class UsuariosController extends UsersUdecController
{
    /**
     *Función que redirecciona a la vista donde se encuentra la tabla de registro de usuarios.
     *
     *
     */
    public function index()
    {
            return view('adminregist.usuarios.tablaUsuarios');
    }

    /**
     * Función que redirecciona a la vista del formulario de registro de un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
*/
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('adminregist.usuarios.registroUsuarios');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     *Función que muestra los usuarios registrados por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('adminregist.usuarios.ajaxTablaUsuarios');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

}