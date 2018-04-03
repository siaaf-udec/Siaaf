<?php

namespace App\Container\AdminRegist\Src\Controllers;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\AdminRegist\Src\Registros;

class RegistrosController extends Controller
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
        return view('adminregist.registros.registros');
    }

    public function registrar(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'number_document' => 'unique:developer.users_udec'
            ]);

            if (empty($validator->errors()->all())) {
                return AjaxResponse::success(
                    'false',
                    'false'
                );
            } else {
                Registros::create([
                    'id_registro' => $request['number_document'],
                    'id_novedad' => $request['novedad'],
                ]);
                /*$user = Registro::find($request['number_document']);
                $user->registroIngreso()->create([ 'id_proceso' => $request['id_proceso']]);*/
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Registro de ingreso correcto.'
                );
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $history = Registros::with('registro', 'novedad')->get();

            return DataTables::of($history)
                ->removeColumn('registro.number_document')
                ->removeColumn('registro.company')
                ->removeColumn('registro.created_at')
                ->removeColumn('registro.updated_at')
                ->removeColumn('registro.number_phone')
                ->removeColumn('registro.email')
                ->removeColumn('novedad.id')
                ->removeColumn('novedad.updated_at')
                ->removeColumn('novedad.created_at')
                ->removeColumn('registro.updated_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function history()
    {
        return view('adminregist.registros.history');
    }

}