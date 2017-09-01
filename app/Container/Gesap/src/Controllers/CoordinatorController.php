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
use App\Container\Users\Src\User;

use Exception;
class CoordinatorController extends Controller
{
    
    private $path='gesap.Coordinador.';
    
    /*TABLA DE ANTEPROYECTOS*/
    public function index(){
        return view($this->path.'AnteproyectoList');
    }  
    /*FORMULARIO DE CREACION DE ANTEPROYECTOS*/
    public function create(){
        $estudiantes=User::select(DB::raw('CONCAT(name, " ", lastname) AS name'),'id')
            ->join('developer.role_user', function ($join) {
                $join->on('users.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', '=', 3);
            })
            ->orderBy('name', 'asc')
            ->pluck('name','id')
            ->toArray();
        
        return view($this->path.'RegistroMin',compact('estudiantes'));
    }
    
    public function store(Request $request){
        try{
            $anteproyecto= new Anteproyecto();
            $anteproyecto->NPRY_Titulo=$request['title'];
            $anteproyecto->NPRY_Keywords=$request['Keywords'];
            $anteproyecto->NPRY_Duracion=$request['duracion'];
            $anteproyecto->NPRY_FechaR=$request['FechaR'];
            $anteproyecto->NPRY_FechaL=$request['FechaL'];
            $anteproyecto->save();
            
            $idanteproyecto=$anteproyecto->PK_NPRY_idMinr008;
            
            $radicacion= new Radicacion();
            $radicacion->RDCN_Min=$request['Min']->getClientOriginalName();
            $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();
            $radicacion->FK_TBL_Anteproyecto_id=$idanteproyecto;
            
            \Storage::disk('local')->put($request['Min']->getClientOriginalName(),  \File::get($request->file('Min')));
            \Storage::disk('local')->put($request['Requerimientos']->getClientOriginalName(),  \File::get($request->file('Requerimientos')));
            
            
            $radicacion->save();
            
            $idRadicacion=$radicacion->PK_RDCN_idRadicacion;
            
            Encargados::create([
                'FK_TBL_Anteproyecto_id'    =>$idanteproyecto ,
                'FK_developer_user_id'      =>$request['estudiante1'],    
                'NCRD_Cargo'                =>"Estudiante 1"
            ]);
        
            if($request['estudiante2']!=0)
                Encargados::create([
                    'FK_TBL_Anteproyecto_id'    =>$idanteproyecto ,
                    'FK_developer_user_id'      =>$request['estudiante2'],    
                    'NCRD_Cargo'                =>"Estudiante 2"
                ]);
            
            return redirect()->route('min.index');
            
            /*$notification=array(
                'message'=>'El proceso de inducción fue almacenado correctamente',
                'alert-type'=>'success'
            );
            return back()->with($notification);*/
        
        }catch(Exception $e){
            return "Fatal Error =".$e->getMessage();
        }
    }
    
    public function show($id){
        //
    }
    /*MODIFICAR ANTEPROYECTOS*/
    public function edit($id){
        $estudiantes=User::select(DB::raw('CONCAT(name, " ", lastname) AS name'),'id')
            ->join('developer.role_user', function ($join) {
                $join->on('users.id', '=', 'role_user.user_id')
                    ->where('role_user.role_id', '=', 3);
            })
            ->orderBy('name', 'asc')
            ->pluck('name','id')
            ->toArray();
        
        $anteproyecto=Anteproyecto::select('*')
                      ->join('TBL_Radicacion','FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008')
                      ->where('PK_NPRY_idMinr008','=',$id)
                      ->get();
                     
        $estudiante1=Encargados::join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->join('gesap.tbl_anteproyecto',function ($join)use($id) {
                    $join->on('tbl_encargados.FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008');            
                    $join->where('tbl_anteproyecto.PK_NPRY_idMinr008','=',$id);            
                })
                ->select(DB::raw('FK_developer_user_id AS Cedula'),'PK_NPRY_idMinr008','PK_NCRD_idCargo' )
                ->where('NCRD_Cargo','=',"ESTUDIANTE 1")
                ->get();
        $estudiante2=Encargados::join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->join('gesap.tbl_anteproyecto',function ($join)use($id) {
                    $join->on('tbl_encargados.FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008');            
                    $join->where('tbl_anteproyecto.PK_NPRY_idMinr008','=',$id);            
                })
                ->select(DB::raw('FK_developer_user_id AS Cedula'),'PK_NPRY_idMinr008','PK_NCRD_idCargo' )
                ->where('NCRD_Cargo','=',"ESTUDIANTE 2")
                ->get();

        return view($this->path.'ModificarMin', compact("anteproyecto",'estudiante1','estudiante2',"estudiantes"));
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
        if(!empty($request['Requerimientos']))
            $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();
        $radicacion->save();
            
        
        
          
        if(isset($request['PK_estudiante1'])){
            $estudiante1 = Encargados::findOrFail($request['PK_estudiante1']);
            if($request['estudiante1']!=0){    
                $estudiante1->FK_developer_user_id=$request['estudiante1'];
                $estudiante1->save();
            }else
                $estudiante1->delete();
        }else{
            if($request['estudiante1']!=0)
                Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$id ,
                'FK_developer_user_id'    =>$request['estudiante1'],    
                'NCRD_Cargo'            =>"Estudiante 1"
                ]);
        }
            
            
            
        if(isset($request['PK_estudiante2'])){
            $estudiante2 = Encargados::findOrFail($request['PK_estudiante2']);
            if($request['estudiante2']!=0){    
                $estudiante2->FK_developer_user_id=$request['estudiante2'];
                $estudiante2->save();
            }else
                $estudiante2->delete();
        }else{
            if($request['estudiante2']!=0)
                Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$id ,
                'FK_developer_user_id'    =>$request['estudiante2'],    
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
    /*ASIGNACION DE DOCENTES*/
    public function assign($id){ 
        $anteproyectos = Anteproyecto::select('PK_NPRY_idMinr008','NPRY_Titulo')
                                        ->where('PK_NPRY_idMinr008','=',$id)
                                        ->get();
        
        $docentes=User::select(DB::raw('CONCAT(name, " ", lastname) AS name'),'id')
                  ->join('developer.role_user', function ($join) {
                    $join->on('users.id', '=', 'role_user.user_id')
                    ->where(function($query){
                      $query->where('role_user.role_id', '=', 2)  ;
                      $query->orwhere('role_user.role_id', '=', 1);
                    });
            })
            ->orderBy('name', 'asc')
            ->pluck('name','id')
            ->toArray();
        
        
        $director=Encargados::join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->join('gesap.tbl_anteproyecto',function ($join)use($id) {
                    $join->on('tbl_encargados.FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008');            
                    $join->where('tbl_anteproyecto.PK_NPRY_idMinr008','=',$id);            
                })
                ->select(DB::raw('FK_developer_user_id AS Cedula'),'PK_NPRY_idMinr008','PK_NCRD_idCargo' )
                ->where('NCRD_Cargo','=',"Director")
                ->get();
                
        $jurado1=Encargados::join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->join('gesap.tbl_anteproyecto',function ($join)use($id) {
                    $join->on('tbl_encargados.FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008');            
                    $join->where('tbl_anteproyecto.PK_NPRY_idMinr008','=',$id);            
                })
                ->select(DB::raw('FK_developer_user_id AS Cedula'),'PK_NPRY_idMinr008','PK_NCRD_idCargo' )
                ->where('NCRD_Cargo','=',"Jurado 1")
                ->get();
        
        $jurado2=Encargados::join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->join('gesap.tbl_anteproyecto',function ($join)use($id) {
                    $join->on('tbl_encargados.FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008');            
                    $join->where('tbl_anteproyecto.PK_NPRY_idMinr008','=',$id);            
                })
                ->select(DB::raw('FK_developer_user_id AS Cedula'),'PK_NPRY_idMinr008','PK_NCRD_idCargo' )
                ->where('NCRD_Cargo','=',"Jurado 2")
                ->get();     
        
        return view($this->path.'AsignarDocente',compact('anteproyectos','docentes','director','jurado2','jurado1') );
    }
    
    public function saveAssign(Request $request){
        try{
            if(isset($request['PK_director'])){
                $director = Encargados::findOrFail($request['PK_director']);
                $director->FK_developer_user_id=$request['director'];
                $director->save();
            }else{
                if($request['director']!=0)
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_developer_user_id'    =>$request['director'],    
                        'NCRD_Cargo'            =>"Director"
                    ]);
            }
            
            
            if(isset($request['PK_jurado1'])){
                $jurado1 = Encargados::findOrFail($request['PK_jurado1']);
                $jurado1->FK_developer_user_id=$request['jurado1'];
                $jurado1->save();
            }else{
                if($request['jurado1']!=0)
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_developer_user_id'    =>$request['jurado1'],
                        'NCRD_Cargo'            =>"Jurado 1"
            ]);
            }
            
            if(isset($request['PK_jurado2'])){
                $jurado1 = Encargados::findOrFail($request['PK_jurado2']);
                $jurado1->FK_developer_user_id=$request['jurado2'];
                $jurado1->save();
            }else{
                if($request['jurado2']!=0)
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_developer_user_id'    =>$request['jurado2'],    
                        'NCRD_Cargo'            =>"Jurado 2"
                    ]);
            }
            
            
                  
            return redirect()->route('min.index');
        }catch(Exception $e){
            return "Fatal Error =".$e->getMessage();;
        }
    }
    
    public function getSql($query){
        $sql = $query->toSql();
        foreach($query->getBindings() as $binding){
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }
    
    public function projectList(){        
        $result="NO ASIGNADO";
        $anteproyectos = 
            DB::table('gesap.TBL_Anteproyecto AS A')
                ->join('gesap.TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select('A.*','R.RDCN_Min','R.RDCN_Requerimientos',
                    DB::raw('IFNULL(('
                        .$this->getSql(
                                DB::table('gesap.tbl_encargados')
                                    ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                    ->select(DB::raw('concat(name," ",lastname)'))
                                    ->where('NCRD_Cargo','=','Director')
                                    ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                                )
                        .'),"'.$result.'")AS Director'
                    ),
                    DB::raw('('
                        .$this->getSql(
                            DB::table('gesap.tbl_encargados')
                                ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                ->select('FK_developer_user_id')
                                ->where('NCRD_Cargo','=','Director')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS DirectorCedula'
                    ),     
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('gesap.tbl_encargados')
                                    ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                    ->select(DB::raw('concat(name," ",lastname)'))
                                ->where('NCRD_Cargo','=','Jurado 1')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .'),"'.$result.'")AS Jurado1'
                    ), 
                    DB::raw('('
                        .$this->getSql(
                            DB::table('gesap.tbl_encargados')
                                ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                ->select('FK_developer_user_id')
                                ->where('NCRD_Cargo','=','Jurado 1')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS Jurado1Cedula'
                    ),      
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            DB::table('gesap.tbl_encargados')
                                    ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                    ->select(DB::raw('concat(name," ",lastname)'))
                                ->where('NCRD_Cargo','=','Jurado 2')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .'),"'.$result.'")AS Jurado2'
                    ), 
                    DB::raw('('
                        .$this->getSql(
                            DB::table('gesap.tbl_encargados')
                                ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                ->select('FK_developer_user_id')
                                ->where('NCRD_Cargo','=','Jurado 2')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS Jurado2Cedula'
                    ),    
                    DB::raw('IFNULL(('
                        .$this->getSql(
                                DB::table('gesap.tbl_encargados')
                                    ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                    ->select(DB::raw('concat(name," ",lastname)'))
                                ->where('NCRD_Cargo','=','Estudiante 1')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .'),"'.$result.'")AS estudiante1'
                    ),  
                    DB::raw('('
                        .$this->getSql(
                            DB::table('gesap.tbl_encargados')
                                ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                ->select('FK_developer_user_id')
                                ->where('NCRD_Cargo','=','Estudiante 1')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS estudiante1Cedula'
                    ), 
                    DB::raw('IFNULL(('
                        .$this->getSql(
                                DB::table('gesap.tbl_encargados')
                                    ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                    ->select(DB::raw('concat(name," ",lastname)'))
                                ->where('NCRD_Cargo','=','Estudiante 2')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .'),"'.$result.'")AS estudiante2'
                    ), 
                         
                    DB::raw('('
                        .$this->getSql(
                            DB::table('gesap.tbl_encargados')
                                ->join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                ->select('FK_developer_user_id')
                                ->where('NCRD_Cargo','=','Estudiante 2')
                                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS estudiante2Cedula'
                    )
                );
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
    }
    
}
