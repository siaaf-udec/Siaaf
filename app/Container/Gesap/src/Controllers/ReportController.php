<?php
namespace App\Container\gesap\src\Controllers;

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

use Illuminate\Support\Facades\DB;

use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;
use App\Container\Users\Src\User;

use Carbon\Carbon;

class ReportController extends Controller
{
    
    private $path='gesap.Reportes';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docentes=User::orderBy('name', 'asc')
                ->whereHas('roles', function ($e) {
                    $e->where('name', 'Coordinator_Gesap');
                    $e->orwhere('name', '=', 'Evaluator_Gesap');
                })
                ->get(['name', 'lastname', 'id'])
                ->pluck('full_name', 'id')
                ->toArray();
        return view($this->path.'PDF.PrincipalView', [
            'docentes'=>$docentes
        ]);
    }
    
    
    public function allProject()
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')
            ->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2'])
            //->whereNotBetween('NPRY_FechaR',["2017-07-05","2017-07-11"])
//            ->groupBy(['NPRY_FechaR',''])
            ->get();
            //return $proyectos->toSql();
        return view($this->path.'PDF.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ]);
    }
    
    public function allProjectPrint()
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')->get();
        
        return SnappyPdf::loadView($this->path.'PDF.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ])->download('ReporteAnteproyectosGesap.pdf');
    }
    
    public function juryProject(Request $request, $jury)
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')
            ->join('gesap.tbl_encargados AS E', function ($join) use ($request, $jury) {
                $join->on('E.FK_TBL_Anteproyecto_id', '=', 'A.PK_NPRY_idMinr008')
                ->where(function ($query) {
                    $query->where('E.NCRD_Cargo', '=', "Jurado 1")  ;
                    $query->orwhere('E.NCRD_Cargo', '=', "Jurado 2");
                })
                ->where('FK_developer_user_id', '=', $jury);
            })
            ->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2'])
            ->get();
        return view($this->path.'PDF.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ]);
    }
    
    
    public function directorProject(Request $request, $director)
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')
            ->join('gesap.tbl_encargados AS E', function ($join) use ($director) {
                $join->on('E.FK_TBL_Anteproyecto_id', '=', 'A.PK_NPRY_idMinr008')
                ->where('E.NCRD_Cargo', '=', "Director")
                ->where('FK_developer_user_id', '=', $director);
            })
            ->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2'])
            ->get();
        return view($this->path.'PDF.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ]);
    }
    
    
    
    
    
    
    
    
    
    
    
}
