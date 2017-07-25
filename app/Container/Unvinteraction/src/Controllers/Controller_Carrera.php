<?php

namespace App\container\Unvinteraction\src\Controllers; 
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use App\Container\Unvinteraction\src\TBL_Carrera;
use App\Container\Unvinteraction\src\TBL_Facultad;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;


class Controller_Carrera extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path='unvinteraction.admin';
    public function index()
    {
        //
        return view($this->path.'.Agregar_Carrera');
    }
    public function listar()
    {
        $Facultad= TBL_Carrera::join('TBL_Facultad','TBL_Carrera.FK_TBL_Facultad','=','TBL_Facultad.PK_Facultad')
            ->select('TBL_Carrera.PK_Carrera','TBL_Carrera.Carrera')
            ->get();
        
      //return view($this->path.'.Listar_Usuarios');
        return Datatables::of( $Carrera)->addIndexColumn()->make(true);   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $fora= TBL_Facultad::select('PK_Facultad','Facultad')
        ->pluck('Facultad','PK_Facultad')
        ->toArray();
        //$fora = TBL_Facultad::all();
        return view($this->path.'.Agregar_Carrera', compact('fora'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $carrera = new TBL_Carrera();
            $carrera->PK_Carrera = $request->PK_Carrera;
            $carrera->Carrera = $request->Carrera;
            $carrera->FK_TBL_Facultad = $request->Facultad;
            $carrera->save();
            return "registro completo";
            
        }catch(Exception $e){
            return "Fatal error - ".$e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
