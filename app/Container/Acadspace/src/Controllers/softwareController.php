<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Acadspace\src\Software;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class softwareController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acadspace.Software.formularioSoftware');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function registroSoftware(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Software::create([
                'SOF_nombre_soft' => $request['SOF_nombre_soft'],
                'SOF_version' => $request['SOF_version'],
                'SOF_licencias' => $request['SOF_licencias']
            ]);
            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Software registrado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    //Funcion creada para cargar datatable con software
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            // $articulos = software::all(['nombre_soft','version','licencias'])->get();
            $software = Software::all();
            return Datatables::of($software)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

/*
    public function cargarjson()
    {
        $users = software::select('SOF_nombre_soft', 'SOF_version', 'SOF_licencias')->get();

        return Datatables::of($users)->make(true);
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    public function mostrarSelect()
    {
        $software = software::all();
        //  echo $software;
        return view('espacios.academicos.espacad.create', compact('$software'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $solicitud = software::find($id);
            $solicitud->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Software eliminado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }


}