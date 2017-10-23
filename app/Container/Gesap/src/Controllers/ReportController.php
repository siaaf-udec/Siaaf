<?php
namespace App\Container\gesap\src\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
use App\Container\gesap\src\Proyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;
use App\Container\Users\Src\User;

use Carbon\Carbon;

class ReportController extends Controller
{
    
    private $path='gesap.Reportes';

    /*
     * Vista principal de generacion de reportes
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
    
    public function graficos()
    {
        return view('gesap.Coordinador.Graficos',['stats']);
    }
    
    public function getPreliminary()
    {
        $stats = Anteproyecto::groupBy('Estado')
        ->get([
            DB::raw('NPRY_Estado as Estado'),
            DB::raw('COUNT(*) as value')
        ])
        ->toJSON();
        return $stats;    
    }
    
    public function getProject()
    {
        $stats = Proyecto::groupBy('Estado')
            
        ->get([
            DB::raw('PRYT_Estado as Estado'),
            DB::raw('COUNT(*) as value')
        ])
        ->toJSON();
        return $stats;    
    }
    
    
    
    public function getJury()
    {
        $stats = Encargados::where(function ($query) {
            $query->where('NCRD_Cargo', '=', "Jurado 1")  ;
            $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
        })
        ->groupBy('FK_Developer_User_Id')    
            ->with(['usuarios'=> function ($user) {
                $user->select('id','name');
            }])
            ->get(['FK_Developer_User_Id',DB::raw('COUNT(*) as value')])
            ;
        return $stats;
    }
    public function getDirector()
    {
        
    }
    
    /*
     * Reporte con todos los proyectos
     *
     * @return \Illuminate\Http\Response
     */
    public function allProject()
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')
            ->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2'])
            ->get();
        return view($this->path.'PDF.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ]);
    }
    
    /*
     * Descarga de reporte de todos los proyectos
     *
     * @return Barryvdh\Snappy\Facades\SnappyPdf
     */
    public function allProjectPrint()
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')->get();
        
        return SnappyPdf::loadView($this->path.'PDF.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ])->download('ReporteAnteproyectosGesap.pdf');
    }
    
    /*
     * Reporte con los proyectos de un jurado seleccionado
     *
     * @param int $jury
     *
     * @return \Illuminate\Http\Response
     */
    public function juryProject($jury)
    {
        $proyectos = Anteproyecto::from('TBL_Anteproyecto AS A')->distinct()
            ->with(['radicacion',
                    'director',
                    'jurado1',
                    'jurado2',
                    'estudiante1',
                    'estudiante2',
                    'conceptofinal',
                    'encargados' => function ($encargados) use ($jury) {
                        $encargados->where(function ($query) {
                            $query->where('NCRD_Cargo', '=', "Jurado 1")  ;
                            $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
                        });
                        $encargados->where('FK_developer_user_id', '=', $jury);
                    }])
            ->get();
        return view($this->path.'PDF.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ]);
    }
    
    /*
     * Reporte con los proyectos de un director seleccionado
     *
     * @param int $director
     *
     * @return \Illuminate\Http\Response
     */
    public function directorProject(Resquest $request)
    {
        $proyectos=Anteproyecto::from('TBL_Anteproyecto AS A')
            ->with(['radicacion',
                    'director',
                    'jurado1',
                    'jurado2',
                    'estudiante1',
                    'estudiante2',
                    'encargados' => function ($encargados) use ($request) {
                        $encargados->where('E.NCRD_Cargo', '=', "Director");
                        $encargados->where('FK_developer_user_id', '=', $request->user()->id);
                    }])
            ->get();
        return view($this->path.'PDF.AnteproyectosPDF', [
            'proyectos'=>$proyectos
        ]);
    }
}
