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
use App\Container\Acadspace\src\solSoftware;
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
        return view('acadspace.Solicitudes.formularioSoftware');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registroSoftware(Request $request){
        if ($request->ajax() && $request->isMethod('POST')) {

            solSoftware::create([
                'nombre_soft' => $request['nombre_soft'],
                'version' => $request['version'],
                'licencias' => $request['licencias']
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
           // $articulos = solSoftware::all(['nombre_soft','version','licencias'])->get();
            $software = solSoftware::all();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $solicitudes = solSoftware::all();
        $solicitudes = solSoftware::paginate(10);
        return view('acadspace.Solicitudes.listaSolSoftware', compact('solicitudes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = solSoftware::find($id);
        $solicitud->estado = 1;
        $solicitud->save();

        $solicitudes = solSoftware::all();
        $solicitudes = solSoftware::paginate(10);
        return view('acadspace.Solicitudes.listaSolSoftware', compact('solicitudes'));
    }

    public function mostrarSelect(){
        $software = solSoftware::all();
        echo $software;
        return view('espacios.academicos.espacad.create', compact('$software'));
    }

    public function eliminarSoftware($id)
    {
        $solicitud = solSoftware::find($id);
        $solicitud->delete();

        $solicitudes = solSoftware::all();
        $solicitudes = solSoftware::paginate(10);
        return view('acadspace.Solicitudes.listaSolSoftware', compact('solicitudes'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('DELETE')){

            $solicitud = solSoftware::find($id);
            $solicitud->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Software eliminado correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }



}