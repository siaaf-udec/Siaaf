<?php

namespace App\container\Unvinteraction\src\Controllers;

use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;
use App\Container\Unvinteraction\src\TBL_Documentacion;
use App\Container\Unvinteraction\src\TBL_Convenios;
use App\Container\Unvinteraction\src\TBL_Evaluacion;
use App\Container\Unvinteraction\src\TBL_Sede;
use App\Container\Unvinteraction\src\TBL_Estado;
use App\Container\Unvinteraction\src\TBL_Empresas_Participantes;
use App\Container\Unvinteraction\src\TBL_Participantes;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;

class Controller_Listar_Convenios_Funcionario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path='unvinteraction.funcionario';
    public function index()
    {
        //-
         return view($this->path.'.Listar_Convenios',compact('data'));
    }
     public function Listar()
    {
        $Convenio = TBL_Convenios::join('TBL_Estado','TBL_Convenios.FK_TBL_Estado','=','TBL_Estado.PK_Estado')
             ->join('TBL_Sede','TBL_Convenios.FK_TBL_Sede','=','TBL_Sede.PK_Sede')
             ->select('TBL_Convenios.PK_Convenios','TBL_Convenios.Nombre','TBL_Convenios.Fecha_Inicio','TBL_Convenios.Fecha_Fin','TBL_Estado.Estado','TBL_Sede.Sede')
             ->get(); 
         return Datatables::of( $Convenio)->addIndexColumn()->make(true); 
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $opcion = TBL_Sede::all();
        return view($this->path.'.Agregar_Convenios',compact('opcion'));
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
            $convenio = new TBL_Convenios();
            $convenio->PK_Convenios = $request->PK_Convenios;
            $convenio->Nombre= $request->Nombre;
            $convenio->Fecha_Inicio = $request->Fecha_Inicio;
            $convenio->Fecha_Fin = $request->Fecha_Fin;
            $convenio->FK_TBL_Estado = 1;
            $convenio->FK_TBL_Sede = 1;
            $convenio->save();
            return redirect()->route('Listar_Convenios.index');
            
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
        $convenio= TBL_Convenios::findOrFail($id);
        $opcion = TBL_Sede::all();
        $opciond = TBL_Estado::all();
        return view($this->path.'.Editar_Convenios', compact('convenio','opcion','opciond'));
        //return "holaaaa";
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
        $convenio= TBL_Convenios::findOrFail($id);
        $convenio->Nombre =$request->Nombre;
        $convenio->Fecha_Inicio =$request->Fecha_Inicio;
        $convenio->Fecha_Fin =$request->Fecha_Fin;
        $convenio->FK_TBL_Estado =$request->FK_TBL_Estado;
        $convenio->FK_TBL_Sede =$request->FK_TBL_Sede;
        $convenio->save();
        return redirect()->route('Listar_Convenios.index');
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
     public function documentacion($id)
    {
        
        
      
        return view($this->path.'.Listar_Documentos_Convenios', compact('id'));
    }
    public function ListarDC( $id)
    {
        
        $documento = TBL_Documentacion::join('TBL_Tipo_Documentos','TBL_Documentacion.FK_TBL_Tipo_Documentos','=','TBL_Tipo_Documentos.PK_Tipo_Documentos')
             ->select('TBL_Documentacion.PK_Documentacion','TBL_Documentacion.Entidad','TBL_Documentacion.Ubicacion','TBL_Tipo_Documentos.Descripcion')
             ->where('FK_TBL_Convenios',$id)->get();
        return Datatables::of($documento)->addIndexColumn()->make(true);
    }
     public function ListarPC( $id)
    {
        
        $participante = TBL_Participantes::join('TBL_Usuarios','TBL_Participantes.FK_TBL_Usuarios','=','TBL_Usuarios.PK_Usuario')
            ->join('TBL_Convenios','TBL_Participantes.FK_TBL_Convenios','=','TBL_Convenios.PK_Convenios')
             ->select('TBL_Participantes.PK_Participantes','TBL_Participantes.FK_TBL_Usuarios','TBL_Usuarios.Nombre','TBL_Usuarios.Apellido')
             ->where('FK_TBL_Convenios',$id)->get();
        return Datatables::of($participante)->addIndexColumn()->make(true);
    }
    public function ListarEPC( $id)
    {
        
        $EM_participante = TBL_Empresas_Participantes::join('TBL_Empresa','TBL_Empresas_Participantes.FK_TBL_Empresa','=','TBL_Empresa.PK_Empresa')
             ->select('TBL_Empresas_Participantes.PK_Empresas_Participantes','TBL_Empresa.PK_Empresa','TBL_Empresa.Nombre_Empresa')
             ->where('FK_TBL_Convenios',$id)->get();
        return Datatables::of($EM_participante)->addIndexColumn()->make(true);
    }
    //  ;
    public function evaluaciones(Request $request)
    {
        
        $id = $request->PK_Convenios;
        $eva = TBL_Evaluacion::where('FK_TBL_Convenios',$id)->get();;
        return view($this->path.'.Listar_Evaluaciones_Convenios', compact('eva'));
    }
}
