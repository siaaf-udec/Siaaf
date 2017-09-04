<?php

namespace App\container\Unvinteraction\src\Controllers; 
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use App\Container\Unvinteraction\src\TBL_Facultad;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;


class Controller_Facultades extends Controller
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
        return view($this->path.'.Agregar_Facultad');
    }
    public function listar()
    {
        $Facultad= TBL_Facultad::select('TBL_Facultad.PK_Facultad','TBL_Facultad.Facultad')
            ->get();
        
      //return view($this->path.'.Listar_Usuarios');
        return DataTables::of( $Facultad)->addIndexColumn()->make(true);
        
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view($this->path.'.Agregar_Facultad');
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
            $facultad = new TBL_Facultad();
            $facultad->PK_Facultad = $request->PK_Facultad;
            $facultad->Facultad = $request->Facultad;
            $facultad->save();
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
