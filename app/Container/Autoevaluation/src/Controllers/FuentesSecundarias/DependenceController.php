<?php

namespace App\Container\Autoevaluation\src\Controllers\FuentesSecundarias;


use App\Container\Autoevaluation\src\Dependencia;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DependenceController extends Controller
{
    public function index(Request $request){
        if ($request->isMethod("GET")){
            return view('autoevaluation.dependencia');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            Dependencia::create($request->all());
            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Dependencia registrada correctamente.'
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
            $dependencia = Dependencia::all();

            return Datatables::of($dependencia)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos mmmm!',
            'No se pudo completar tu solicitud.'
        );

    }

    public function destroy(Request $request, $id){
        if ($request->ajax() && $request->isMethod('DELETE')) {
            $dependencia = Dependencia::find($id);

            $dependencia->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Dependencia eliminada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $dependencia = Dependencia::find($request['PK_DPC_Id']);
            $dependencia->fill($request->all());
            $dependencia->save();
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
}