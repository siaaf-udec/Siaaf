<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

use App\Http\Controllers\Controller;
use Illuminate\Http\File;


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
    
    public function getSql($query){
        $sql = $query->toSql();
        foreach($query->getBindings() as $binding){
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }
    
    public function Lista(){        
        $result="NO ASIGNADO";
        $anteproyectos = 
            DB::table('TBL_Anteproyecto AS A')
                ->join('TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select('A.*','R.RDCN_Min','R.RDCN_Requerimientos',
                    DB::raw('IFNULL(('
                        .$this->getSql(
                                DB::table('tbl_encargados')
                                    ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                    ->select(DB::raw('concat(SRS_Nombre," ",SRS_Apellido)'))
                                    ->where('NCRD_Cargo','=','Director')
                                    ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                                )
                        .'),"'.$result.'")AS Director'
                    ),
                    DB::raw('('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select('FK_TBL_Usuarios_id')
                                ->where('NCRD_Cargo','=','Director')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS DirectorCedula'
                    ),     
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select(DB::raw('concat(SRS_Nombre," ",SRS_Apellido)'))
                                ->where('NCRD_Cargo','=','Jurado 1')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .'),"'.$result.'")AS Jurado1'
                    ), 
                    DB::raw('('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select('FK_TBL_Usuarios_id')
                                ->where('NCRD_Cargo','=','Jurado 1')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS Jurado1Cedula'
                    ),      
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select(DB::raw('concat(SRS_Nombre," ",SRS_Apellido)'))
                                ->where('NCRD_Cargo','=','Jurado 2')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .'),"'.$result.'")AS Jurado2'
                    ), 
                    DB::raw('('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select('FK_TBL_Usuarios_id')
                                ->where('NCRD_Cargo','=','Jurado 2')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS Jurado2Cedula'
                    ),    
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select(DB::raw('concat(SRS_Nombre," ",SRS_Apellido)'))
                                ->where('NCRD_Cargo','=','Estudiante 1')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .'),"'.$result.'")AS estudiante1'
                    ),  
                    DB::raw('('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select('FK_TBL_Usuarios_id')
                                ->where('NCRD_Cargo','=','Estudiante 1')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS estudiante1Cedula'
                    ), 
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select(DB::raw('concat(SRS_Nombre," ",SRS_Apellido)'))
                                ->where('NCRD_Cargo','=','Estudiante 2')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .'),"'.$result.'")AS estudiante2'
                    ), 
                         
                    DB::raw('('
                        .$this->getSql(
                            DB::table('tbl_encargados')
                                ->join('tbl_users','tbl_encargados.FK_TBL_Usuarios_id','=','tbl_users.PK_SRS_Cedula')
                                ->select('FK_TBL_Usuarios_id')
                                ->where('NCRD_Cargo','=','Estudiante 2')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS estudiante2Cedula'
                    )
                );
        
       /* 
        $anteproyectos=DB::select('select `A`.*, `R`.`RDCN_Min`, `R`.`RDCN_Requerimientos`, IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Director" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = A.PK_NPRY_idMinr008),"NO ASIGNADO")AS Director, (select `FK_TBL_Usuarios_id` from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Director" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008")AS DirectorCedula, IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Jurado 1" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008"),"NO ASIGNADO")AS Jurado1, (select `FK_TBL_Usuarios_id` from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Jurado 1" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008")AS Jurado1Cedula, IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Jurado 2" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008"),"NO ASIGNADO")AS Jurado2, (select `FK_TBL_Usuarios_id` from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Jurado 2" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008")AS Jurado2Cedula, IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Estudiante 1" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008"),"NO ASIGNADO")AS estudiante1, (select `FK_TBL_Usuarios_id` from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Estudiante 1" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008")AS estudiante1Cedula, IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Estudiante 2" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008"),"NO ASIGNADO")AS estudiante2, (select `FK_TBL_Usuarios_id` from `tbl_encargados` inner join `tbl_users` on `tbl_encargados`.`FK_TBL_Usuarios_id` = `tbl_users`.`PK_SRS_Cedula` where `NCRD_Cargo` = "Estudiante 2" and `tbl_encargados`.`FK_TBL_Anteproyecto_id` = "TBL_Anteproyecto.PK_NPRY_idMinr008")AS estudiante2Cedula from `TBL_Anteproyecto` as `A` inner join `TBL_Radicacion` as `R` on R.FK_TBL_Anteproyecto_id = A.PK_NPRY_idMinr008');
                        
        
        
        
        $anteproyectos = DB::select('SELECT *, IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Director"),"NO ASIGNADO")AS Director, (select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Director")AS DirectorCedula, IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 1"),"NO ASIGNADO")AS Jurado1, (select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 1")AS Jurado1Cedula ,IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 2"),"NO ASIGNADO")AS Jurado2, (select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Jurado 2")AS Jurado2Cedula,IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 1"),"NO ASIGNADO")AS estudiante1, (select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 1")AS estudiante1Cedula,IFNULL((select concat(SRS_Nombre," ",SRS_Apellido) from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 2"),"NO ASIGNADO") AS estudiante2, (select FK_TBL_Usuarios_id from tbl_encargados e,tbl_users u where e.`FK_TBL_Anteproyecto_id`=a.PK_NPRY_idMinr008 AND e.`FK_TBL_Usuarios_id`=u.`PK_SRS_Cedula` AND e.`NCRD_Cargo`="Estudiante 2")AS estudiante2Cedulafrom TBL_Anteproyecto a,TBL_Radicacion r where r.FK_TBL_Anteproyecto_id=PK_NPRY_idMinr008');   
        */
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
    }
    /*FORMULARIO DE CREACION DE ANTEPROYECTOS*/
    public function create(){
        $estudiantes=DB::table('TBL_Users')
            ->select(DB::raw('CONCAT(SRS_Nombre, " ", SRS_Apellido) AS name'),'PK_SRS_Cedula')
            ->where('FK_TBL_Rol_id','=',4)
            ->orderBy('name', 'asc')
            ->pluck('name','PK_SRS_Cedula')
            ->toArray();
        
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
        
        $docentes=DB::table('tbl_users')
                    ->select(DB::raw('CONCAT(SRS_Nombre, " ", SRS_Apellido) AS name'),'PK_SRS_Cedula')
                    ->where('FK_TBL_Rol_id','=',2)
                    ->orWhere('FK_TBL_Rol_id','=',3)
                    ->orderBy('name', 'asc')
                    ->pluck('name','PK_SRS_Cedula')
                    ->toArray();
        
        $director=DB::select('select PK_NPRY_idMinr008,`FK_TBL_Usuarios_id` as Cedula,concat(SRS_Nombre," ",SRS_Apellido) as name , PK_NPRY_idCargo from TBL_Anteproyecto,tbl_encargados,tbl_users where `FK_TBL_Anteproyecto_id`=PK_NPRY_idMinr008 AND `FK_TBL_Usuarios_id`=`PK_SRS_Cedula` AND `NCRD_Cargo`="Director" AND PK_NPRY_idMinr008= ?',[$id]);     
        
        $jurado2=DB::select('select PK_NPRY_idMinr008,`FK_TBL_Usuarios_id` as Cedula,concat(SRS_Nombre," ",SRS_Apellido) as name ,PK_NPRY_idCargo from TBL_Anteproyecto,tbl_encargados,tbl_users where `FK_TBL_Anteproyecto_id`=PK_NPRY_idMinr008 AND `FK_TBL_Usuarios_id`=`PK_SRS_Cedula` AND `NCRD_Cargo`="Jurado 2" AND PK_NPRY_idMinr008= ?',[$id]);
        
        $jurado1=DB::select('select PK_NPRY_idMinr008,`FK_TBL_Usuarios_id` as Cedula,concat(SRS_Nombre," ",SRS_Apellido) as name , PK_NPRY_idCargo from TBL_Anteproyecto,tbl_encargados,tbl_users where `FK_TBL_Anteproyecto_id`=PK_NPRY_idMinr008 AND `FK_TBL_Usuarios_id`=`PK_SRS_Cedula` AND `NCRD_Cargo`="Jurado 1" AND PK_NPRY_idMinr008= ?',[$id]);     
        
        
        
        return view($this->path.'.Coordinador.AsignarDocente',compact('anteproyectos','docentes','director','jurado2','jurado1') );
    }
    
    public function saveAssign(Request $request){
        try{
            if(isset($request['PK_director'])){
                $director = Encargados::findOrFail($request['PK_director']);
                $director->FK_TBL_Usuarios_id=$request['director'];
                $director->save();
            }else{
                if($request['director']!=0)
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_TBL_Usuarios_id'    =>$request['director'],    
                        'NCRD_Cargo'            =>"Director"
                    ]);
            }
            
            
            if(isset($request['PK_jurado1'])){
                $jurado1 = Encargados::findOrFail($request['PK_jurado1']);
                $jurado1->FK_TBL_Usuarios_id=$request['jurado1'];
                $jurado1->save();
            }else{
                if($request['jurado1']!=0)
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_TBL_Usuarios_id'    =>$request['jurado1'],
                        'NCRD_Cargo'            =>"Jurado 1"
            ]);
            }
            
            if(isset($request['PK_jurado2'])){
                $jurado1 = Encargados::findOrFail($request['PK_jurado2']);
                $jurado1->FK_TBL_Usuarios_id=$request['jurado2'];
                $jurado1->save();
            }else{
                if($request['jurado2']!=0)
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_TBL_Usuarios_id'    =>$request['jurado2'],    
                        'NCRD_Cargo'            =>"Jurado 2"
                    ]);
            }
            
            
                  
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
