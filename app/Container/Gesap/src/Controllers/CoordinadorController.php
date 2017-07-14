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

    /*TABLA DE ANTEPROYECTOS*/
    public function index(){
        return view($this->path.'.Coordinador.AnteproyectoList');
    }
    public function Lista(){        
        
        $anteproyectos = DB::select('SELECT *, 
IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Director"),"NO ASIGNADO")AS Director, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Director")AS DirectorCedula, 

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 1"),"NO ASIGNADO")AS Jurado1, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 1")AS Jurado1Cedula ,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 2"),"NO ASIGNADO")AS Jurado2, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 2")AS Jurado2Cedula,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 1"),"NO ASIGNADO")AS estudiante1, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 1")AS estudiante1Cedula,

IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 2"),"NO ASIGNADO") AS estudiante2, 
(select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 2")AS estudiante2Cedula

from TBL_Anteproyecto a,TBL_Radicacion r where r.FK_TBL_Anteproyecto_id=PK_NPRY_idMinr008');
            
        
        return Datatables::of($anteproyectos)->addIndexColumn()->make(true);
    }
    /*FORMULARIO DE CREACION DE ANTEPROYECTOS*/
    public function create(){
        $estudiantes=DB::table('TBL_Users')->select(DB::raw('CONCAT(SRS_Nombre, " ", SRS_Apellido) AS name'),'PK_SRS_Cedula')->where('FK_TBL_Rol_id','=',4)->orderBy('name', 'asc')->pluck('name','PK_SRS_Cedula')->toArray();
        
        return view($this->path.'.Coordinador.RegistroMin',compact('estudiantes'));
    }
    public function store(Request $request){
        try{
            $anteproyecto= new Anteproyecto();
            $anteproyecto->NPRY_Titulo=$request['title'];
            $anteproyecto->NPRY_Keywords=$request['Keywords'];
            $anteproyecto->NPRY_Duracion=$request['duracion'];
            $anteproyecto->NPRY_FechaR=$request['FechaR'];
            $anteproyecto->NPRY_FechaL=$request['FechaL'];
            $anteproyecto->NPRY_Estado="EN ESPERA";
            $anteproyecto->save();
            
            $idanteproyecto=$anteproyecto->PK_NPRY_idMinr008;
        
            $radicacion= new Radicacion();
            $radicacion->RDCN_Min=$request['Min']->getClientOriginalName();
            $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();
            $radicacion->FK_TBL_Anteproyecto_id=$idanteproyecto;
            $radicacion->save();
            
            $idRadicacion=$radicacion->PK_RDCN_idRadicacion;
            
            Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$idanteproyecto ,
                'FK_TBL_Usuarios_id'    =>$request['estudiante1'],    
                'NCRD_Cargo'            =>"Estudiante 1"
            ]);
        
            if($request['estudiante2']!=0)
                Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$idanteproyecto ,
                'FK_TBL_Usuarios_id'    =>$request['estudiante2'],    
                'NCRD_Cargo'            =>"Estudiante 2"
                ]);
            
            
            
            
            
            return redirect()->route('min.index');
        
        }catch(Exception $e){
            return "Fatal Error =".$e->getMessage();
        }
    }

    
    public function asignar($id){
        $anteproyectos = DB::select('select PK_NPRY_idMinr008,NPRY_Titulo from TBL_Anteproyecto where PK_NPRY_idMinr008= ?',[$id]);
        
        $docentes=DB::table('tbl_users')->select(DB::raw('CONCAT(SRS_Nombre, " ", SRS_Apellido) AS name'),'PK_SRS_Cedula')->where('FK_TBL_Rol_id','=',2)->orWhere('FK_TBL_Rol_id','=',3)->orderBy('name', 'asc')->pluck('name','PK_SRS_Cedula')->toArray();
        
        return view($this->path.'.Coordinador.AsignarDocente',compact('anteproyectos','docentes') );
    }
    
    public function saveAssign(Request $request){
        try{
            Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                'FK_TBL_Usuarios_id'    =>$request['director'],    
                'NCRD_Cargo'            =>"Director"
            ]);
            Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                'FK_TBL_Usuarios_id'    =>$request['jurado1'],
                'NCRD_Cargo'            =>"Jurado 1"
            ]);
            Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                'FK_TBL_Usuarios_id'    =>$request['jurado2'],    
                'NCRD_Cargo'            =>"Jurado 2"
            ]);
                  
            return redirect()->route('min.index');
        }catch(Exception $e){
            return "Fatal Error =".$e->getMessage();;
        }
    }
    
    
    public function show($id){
        //
    }
    /*MODIFICAR ANTEPROYECTOS*/
    public function edit($id){
        $estudiantes=DB::table('tbl_users')
            ->select(DB::raw('CONCAT(SRS_Nombre, " ", SRS_Apellido) AS name'),'PK_SRS_Cedula')
            ->where('FK_TBL_Rol_id','=',4)
            ->orderBy('name', 'asc')
            ->pluck('name','PK_SRS_Cedula')
            ->toArray();
        
        $anteproyecto = DB::select('select * FROM TBL_Anteproyecto,TBL_Radicacion where FK_TBL_Anteproyecto_id = PK_NPRY_idMinr008 AND PK_NPRY_idMinr008 = ?',[$id]);
        //var_dump($anteproyecto);
        //var_dump($anteproyecto->toArray());
        $estudiante1=DB::select('select PK_NPRY_idMinr008,`FK_TBL_Usuarios_id` as Cedula,concat(SRS_Nombre," ",SRS_Apellido) as name , PK_NPRY_idCargo from TBL_Anteproyecto,tbl_encargados,tbl_users where `FK_TBL_Anteproyecto_id`=PK_NPRY_idMinr008 AND `FK_TBL_Usuarios_id`=`PK_SRS_Cedula` AND `NCRD_Cargo`="ESTUDIANTE 1" AND PK_NPRY_idMinr008= ?',[$id]);     
        
        $estudiante2=DB::select('select PK_NPRY_idMinr008,`FK_TBL_Usuarios_id` as Cedula,concat(SRS_Nombre," ",SRS_Apellido) as name ,PK_NPRY_idCargo from TBL_Anteproyecto,tbl_encargados,tbl_users where `FK_TBL_Anteproyecto_id`=PK_NPRY_idMinr008 AND `FK_TBL_Usuarios_id`=`PK_SRS_Cedula` AND `NCRD_Cargo`="ESTUDIANTE 2" AND PK_NPRY_idMinr008= ?',[$id]);   
        

        return view($this->path.'.Coordinador.ModificarMin', compact("anteproyecto",'estudiante1','estudiante2',"estudiantes"));
    }
    public function update(Request $request, $id){
        try{
                
        $anteproyecto = Anteproyecto::findOrFail($id);
        $anteproyecto->NPRY_Titulo=$request['title'];
        $anteproyecto->NPRY_Keywords=$request['Keywords'];
        $anteproyecto->NPRY_Duracion=$request['duracion'];
        $anteproyecto->NPRY_FechaR=$request['FechaR'];
        $anteproyecto->NPRY_FechaL=$request['FechaL'];
        $anteproyecto->save();
            
        $radicacion= Radicacion::findOrFail($request['PK_radicacion']);
        if(!empty($request['Min']))
            $radicacion->RDCN_Min=$request['Min']->getClientOriginalName();
        if(!empty($request['Requerimientos']!=0))
            $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();
        $radicacion->save();
            
        
        
          
        if(isset($request['PK_estudiante1'])){
            $estudiante1 = Encargados::findOrFail($request['PK_estudiante1']);
            if($request['estudiante1']!=0){    
                $estudiante1->FK_TBL_Usuarios_id=$request['estudiante1'];
                $estudiante1->save();
            }else
                $estudiante2->delete();
        }else{
            if($request['estudiante1']!=0)
                Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$id ,
                'FK_TBL_Usuarios_id'    =>$request['estudiante1'],    
                'NCRD_Cargo'            =>"Estudiante 1"
                ]);
        }
            
            
            
        if(isset($request['PK_estudiante2'])){
            $estudiante2 = Encargados::findOrFail($request['PK_estudiante2']);
            if($request['estudiante2']!=0){    
                $estudiante2->FK_TBL_Usuarios_id=$request['estudiante2'];
                $estudiante1->save();
            }else
                $estudiante2->delete();
        }else{
            if($request['estudiante2']!=0)
                Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$id ,
                'FK_TBL_Usuarios_id'    =>$request['estudiante2'],    
                'NCRD_Cargo'            =>"Estudiante 2"
                ]);
        }

        
        return redirect()->route('min.index');
        }
        catch(Exception $e){
            return "Fatal Error =".$e->getMessage();;
        }
    }
    /*BORRAR ANTEPROYECTO*/
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
