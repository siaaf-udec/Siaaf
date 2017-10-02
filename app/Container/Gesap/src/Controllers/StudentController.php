<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Validator;
use Yajra\DataTables\DataTables;

use Illuminate\Http\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Overall\Src\Facades\UploadFile;

use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;

class StudentController extends Controller
{
    
    private $path='gesap.Estudiante.';
    protected $connection = 'gesap';
    
    public function getSql($query)
    {
        $sql = $query->toSql();
        foreach($query->getBindings() as $binding)
        {
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }
        return $sql;
    }
    
    public function index()
    {
        return redirect()->route('anteproyecto.index.juryList');
    }

    public function proyecto()//PONER AJAX
    {
        return view($this->path.'ProyectList');
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
    //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function Encargados($select,$cargo)
    {
        if($select=="Nombre")
        {
            $Consulta=DB::table('gesap.tbl_encargados')->
                join('developer.users','gesap.tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->where('NCRD_Cargo',$cargo)
                ->where('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select(DB::raw('concat(name," ",lastname)'));
            return $this->getSql($Consulta);
        }
        if($select=="ID")
        {
            $Consulta=DB::table('gesap.tbl_encargados')->join('developer.users','gesap.tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->where('NCRD_Cargo',$cargo)
                ->where('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select('FK_developer_user_id');
            return $this->getSql($Consulta);
        }
        
    }
    
    public function studentList(Request $request)
    {
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
                    DB::raw('IFNULL(('.$this->Encargados("Nombre","Director").'),"'.$result.'")AS Director'),
                    DB::raw('('.$this->Encargados("ID","Director").')AS DirectorCedula'),     
                    DB::raw('IFNULL(('.$this->Encargados("Nombre","Jurado 1").'),"'.$result.'")AS Jurado1'), 
                    DB::raw('('.$this->Encargados("ID","Jurado 1").')AS Jurado1Cedula'),      
                    DB::raw('IFNULL(('.$this->Encargados("Nombre","Jurado 2").'),"'.$result.'")AS Jurado2'), 
                    DB::raw('('.$this->Encargados("ID","Jurado 2").')AS Jurado2Cedula'), 
                    DB::raw('IFNULL(('.$this->Encargados("Nombre","Estudiante 1").'),"'.$result.'")AS estudiante1'),  
                    DB::raw('('.$this->Encargados("ID","Estudiante 1").')AS estudiante1Cedula'), 
                    DB::raw('IFNULL(('.$this->Encargados("Nombre","Estudiante 2").'),"'.$result.'")AS estudiante2'),  
                    DB::raw('('.$this->Encargados("ID","Estudiante 2").')AS estudiante2Cedula')
                );
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
   }
    
}
