<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

use App\Http\Controllers\Controller;

use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;

use Exception;
class CoordinadorController extends Controller
{
    
    private $path='gesap';
    protected $connection = 'gesap';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path.'.AnteproyectoList');
    }

     public function asignar($id)
    {
        $anteproyecto = DB::select('select PK_NPRY_idMinr008,NPRY_Titulo from TBL_Anteproyecto where PK_NPRY_idMinr008= ?',[$id]);
        return view($this->path.'.AsignarDocente',['anteproyectos' => $anteproyecto]);
    }
    
    public function Lista()
    {        
        $anteproyectos = DB::select('select * from TBL_Anteproyecto,TBL_Radicacion where FK_TBL_Radicacion_id=PK_RDCN_idRadicacion');
        return Datatables::of($anteproyectos)->addIndexColumn()->make(true);
    }
     /* Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path.'.RegistroMin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            
        $radicacion= new Radicacion();
        $radicacion->RDCN_Min=$request['Min']->getClientOriginalName();
        $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();
        $radicacion->save();
            
        $idRadicacion=$radicacion->PK_RDCN_idRadicacion;
        
        $anteproyecto= new Anteproyecto();
        $anteproyecto->NPRY_Titulo=$request['title'];
        $anteproyecto->NPRY_Keywords=$request['Keywords'];
        $anteproyecto->NPRY_Duracion=$request['duracion'];
        $anteproyecto->NPRY_FechaR=$request['FechaR'];
        $anteproyecto->NPRY_FechaL=$request['FechaL'];
        $anteproyecto->NPRY_Estado="EN ESPERA";
        $anteproyecto->FK_TBL_Radicacion_id=$idRadicacion;
        $anteproyecto->save();
            
        $idanteproyecto=$anteproyecto->PK_NPRY_idMinr008;
            
        /*Encargados::create([
            'FK_TBL_Anteproyecto_id'=>$idanteproyecto ,
            'NCRD_Usuario'          =>1,
            'NCRD_Cargo'            =>"Estudiante"
        ]);*/
        
        
        return redirect()->route('min.index');
            
            
            
        }
        catch(Exception $e){
            
            return "Fatal Error =".$e->getMessage();
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
        //$anteproyecto = Anteproyecto::findOrFail($id;
        $anteproyecto = DB::select('select * from TBL_Anteproyecto,TBL_Radicacion where FK_TBL_Radicacion_id=PK_RDCN_idRadicacion AND PK_NPRY_idMinr008= ?',[$id]);
        return view($this->path.'.ModificarMin', ['anteproyectos' => $anteproyecto]);
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
        try{
            
        /*$radicacion= new Radicacion();
        $radicacion->RDCN_Min=$request['Min']->getClientOriginalName();
        $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();
        $radicacion->save();
            
        $idRadicacion=$radicacion->PK_RDCN_idRadicacion;*/
        
        $anteproyecto = Anteproyecto::findOrFail($id);
        $anteproyecto->NPRY_Titulo=$request['title'];
        $anteproyecto->NPRY_Keywords=$request['Keywords'];
        $anteproyecto->NPRY_Duracion=$request['duracion'];
        $anteproyecto->NPRY_FechaR=$request['FechaR'];
        $anteproyecto->NPRY_FechaL=$request['FechaL'];
        $anteproyecto->save();
            
        /*$idanteproyecto=$radicacion->PK_NPRY_idMinr008;
            
        Encargados::create([
            'FK_TBL_Anteproyecto_id'=>$idanteproyecto ,
            'NCRD_Usuario'          =>1,
            'NCRD_Cargo'            =>"Estudiante"
        ]);*/
        
        
        return redirect()->route('min.index');
        }
        catch(Exception $e){
            return "Fatal Error =".$e->getMessage();;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        try{
            $anteproyecto = Anteproyecto::findOrFail($id);
            $anteproyecto->delete();
            return redirect()->route('min.index');
        }
        catch(Exception $e){
            return "Fatal Error =".$e->getMessage();;
        }
        
    }
}
