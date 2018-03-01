<?php

namespace App\Container\Administrative\Src\Controllers;


use Yajra\DataTables\DataTables;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Administrative\Src\Interfaces\RegistroInterface;
use App\Container\Administrative\Src\Interfaces\RegistroIngresoInterface;
use App\Container\Administrative\Src\Registro;

class RegistroController extends Controller
{
    protected $registroRepository;
    protected $registroIngresoRepository;

    public function __construct(RegistroInterface $registroRepository,RegistroIngresoInterface $registroIngresoRepository)
    {
        $this->registroRepository = $registroRepository;
        $this->registroIngresoRepository = $registroIngresoRepository;
    }

    public function checkDocument(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'number_document' => 'unique:adminis.ingreso'
            ]);

            if (empty($validator->errors()->all())) {
                return response('true');
            }

            return response('false');

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            /*Guarda Usuario*/
            $user = $this->registroRepository->store($request->all());

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos guardados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            $user = Registro::query();

            return DataTables::of($user)
                ->removeColumn('company')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function entry(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'number_document' => 'unique:adminis.ingreso'
            ]);

            if (empty($validator->errors()->all())) {
                return AjaxResponse::success(
                    'false',
                    'false'
                );
            } else {
                $this->registroIngresoRepository->store([ 'id_proceso' => $request['process'], 'id_registro' => $request['number_document']
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

}