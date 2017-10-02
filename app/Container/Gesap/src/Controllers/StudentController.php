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
    use traits\traitsGesap;
    
    private $path='gesap.Estudiante.';
    protected $connection = 'gesap';
        
    public function index()
    {
        return redirect()->route('anteproyecto.index.studentList');
    }

    public function proyecto()
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

    public function studentList(Request $request)
    {
        $result="NO ASIGNADO";
        $anteproyectos = Anteproyecto::from('TBL_Anteproyecto AS A')->Data()
                ->join('gesap.tbl_encargados AS E',function($join)use($request){
                    $join->on(DB::raw('E.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                    ->where(function($query){
                      $query->where('E.NCRD_Cargo', '=', "Estudiante 1")  ;
                      $query->orwhere('E.NCRD_Cargo', '=', "Estudiante 2");
                    })
                    ->where('FK_developer_user_id','=',$request->user()->id);
                });
                
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
   }
    
}
