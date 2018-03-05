<?php
namespace App\Container\Administrative\Src\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Container\Overall\Src\Facades\AjaxResponse;

class MenuAdministrativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('administrative.administrative');
    }

    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('administrative.content-ajax.ajax-registroUsuario');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function index_ajax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('administrative.content-ajax.ajax-administrative');
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function viewRegister(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('administrative.content-ajax.ajax-registroIngreso');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function history()
    {
        return view('administrative.history');
    }
}