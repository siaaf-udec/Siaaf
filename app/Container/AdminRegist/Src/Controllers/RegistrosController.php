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
     *Función que redirecciona a la vista donde se encuentra el formulario de registro de ingreso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminregist.registros.registros');
    }

    /**
     *Función que redirecciona a la vista donde se encuentra el formulario de registro de ingreso.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRegistro()
    {
        return view('adminregist.registros.registroIngreso');
    }

    /**
     * Función que almacena en la base de datos una nuevo registro de ingreso.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
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
                    'FK_RE_Registro' => $request['number_document'],
                    'FK_RE_Novedad' => $request['novedad'],
                ]);
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

    /**
     * Función que consulta los registros de los ingresos realizados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
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
                ->removeColumn('novedad.PK_NOV_IdNovedad')
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
    /**
     *Función que redirecciona a la vista donde se encuentra la tabla de registro de ingreso.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        return view('adminregist.registros.history');
    }

}