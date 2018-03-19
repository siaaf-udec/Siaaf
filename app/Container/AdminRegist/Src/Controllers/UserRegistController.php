<?php

namespace App\Container\AdminRegist\Src\Controllers;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Users\src\UsersUdec;
use App\Container\Users\src\Controllers\UsersUdecController;

class UserRegistController extends UsersUdecController
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminregist.usuarios.tablaUsuarios');
    }

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

    public function index_ajax(Request $request)
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