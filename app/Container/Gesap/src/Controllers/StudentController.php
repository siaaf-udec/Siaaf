<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

use App\Http\Controllers\Controller;


use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;

class StudentController extends Controller
{
    private $path='gesap.Estudiante.';
    protected $connection = 'gesap';
    
    public function getSql($query){
        $sql = $query->toSql();
        foreach($query->getBindings() as $binding){
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }
    
    public function index(){
        return redirect()->route('anteproyecto.index.juryList');
    }

    public function proyecto(){
        return view($this->path.'ProyectList');
    }
    
    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
    //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }

    public function studentList(Request $request){
        $result="NO ASIGNADO";
        $anteproyectos = 
            DB::table('gesap.TBL_Anteproyecto AS A')
                ->join('gesap.TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                ->join('gesap.tbl_encargados AS E',function($join)use($request){
                    $join->on(DB::raw('E.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                    ->where(function($query){
                      $query->where('E.NCRD_Cargo', '=', "Estudiante 1")  ;
                      $query->orwhere('E.NCRD_Cargo', '=', "Estudiante 2");
                    })
                    ->where('FK_developer_user_id','=',$request->user()->id);
                })                       
                
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
        return DataTables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
   }
    
    
    
}
