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
use Illuminate\Support\Facades\DB;

class softwareController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('acadspace.Solicitudes.registroSolSoftware');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        solSoftware::create($request->all());
        return view('acadspace.Solicitudes.registroSolSoftware');

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
    public function destroy($id)
    {

    }

}