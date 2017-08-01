<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\gesap\src;

class EvaluatorController extends Controller
{
    private $path='gesap';
    protected $connection = 'gesap';
    public function index(){
        return redirect()->route('anteproyecto.index.listjurado');
    }

    public function jurado(){
        return view($this->path.'.Evaluador.JuradoList');
    }
    
    public function createObsevaciones($id){
        $anteproyectos = DB::table('TBL_Anteproyecto')
                            ->select('PK_NPRY_idMinr008,NPRY_Titulo')
                            ->where('PK_NPRY_idMinr008','=',$id)
                            ->get();
        return view($this->path.'.Evaluador.Observaciones',compact('anteproyectos'));
    }
    public function storeObservaciones(Request $request){
        return "OK";
    }
    
    public function createConceptos($id){
        $anteproyectos = DB::table('TBL_Anteproyecto')
                            ->select('PK_NPRY_idMinr008,NPRY_Titulo')
                            ->where('PK_NPRY_idMinr008','=',$id)
                            ->get();
        
        return view($this->path.'.Evaluador.Conceptos',compact('anteproyectos'));
    }
    public function storeConceptos(Request $request, $id){
    }
    
    public function director(){
        return view($this->path.'.Evaluador.DirectorList');
    }
    
    public function create(){
    }

    public function store(Request $request){        
    }

    public function show($id){
    }

    public function edit($id){
        return view($this->path.'.Evaluador.Observaciones');
    }
    public function update(Request $request, $id){
    }

    public function destroy($id){
    }

      public function getSql($query){
        $sql = $query->toSql();
        foreach($query->getBindings() as $binding){
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }
    
        public function ListDirector(){
               $result="NO ASIGNADO";
        $anteproyectos = 
            DB::table('gesap.TBL_Anteproyecto AS A')
                ->join('gesap.TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                ->join('gesap.tbl_encargados AS E',function($join){
                    $join->on(DB::raw('E.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                    ->where('NCRD_Cargo','=',"Director")
                    ->where('FK_developer_user_id','=',7);
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
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
   }
    
    public function ListJurado(){
       
            $result="NO ASIGNADO";
        $anteproyectos = 
            DB::table('gesap.TBL_Anteproyecto AS A')
                ->join('gesap.TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                ->join('gesap.tbl_encargados AS E',function($join){
                    $join->on(DB::raw('E.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                    ->where(function($query){
                      $query->where('E.NCRD_Cargo', '=', "Jurado 1")  ;
                      $query->orwhere('E.NCRD_Cargo', '=', "Jurado 2");
                    })
                    ->where('FK_developer_user_id','=',29);
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
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
   }

}
