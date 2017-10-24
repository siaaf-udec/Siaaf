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
        $date = date("d/m/Y");
        $time = date("h:i A");
        $proyectos = Encargados::where(function ($query) {
                            $query->where('NCRD_Cargo', '=', "Jurado 1")  ;
                            $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
        })
            ->where('FK_Developer_User_Id', '=', $jury)
            ->with(['anteproyecto' => function ($proyecto) {
                $proyecto->with(['radicacion',
                                 'director',
                                 'jurado1',
                                 'jurado2',
                                 'estudiante1',
                                 'estudiante2',
                                 'proyecto',
                                 'conceptoFinal']);
            }])
            ->get();
        $docente = User::find($jury);
        return view($this->path.'PDF.ProyectoDocentePDF', [
            'proyectos'=>$proyectos,
            'docente'=>$docente,
            'date'=>$date,
            'time'=>$time,
            'cargo'=>"JURADO"
        ]);
    } 
    
    /*
     * Descarga de reporte con los proyectos de un jurado seleccionado
     *
     * @param int $jury
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadJuryProject($jury)
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
         $proyectos = Encargados::where(function ($query) {
                            $query->where('NCRD_Cargo', '=', "Jurado 1")  ;
                            $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
        })
            ->where('FK_Developer_User_Id', '=', $jury)
            ->with(['anteproyecto' => function ($proyecto) {
                $proyecto->with(['radicacion',
                                 'director',
                                 'jurado1',
                                 'jurado2',
                                 'estudiante1',
                                 'estudiante2',
                                 'proyecto',
                                 'conceptoFinal']);
            }])
            ->get();
        $docente = User::find($jury);
        return SnappyPdf::loadView($this->path.'PDF.ProyectoDocentePDF', [
            'proyectos'=>$proyectos,
            'docente'=>$docente,
            'date'=>$date,
            'time'=>$time,
            'cargo'=>"JURADO"
        ])->download('ReporteGesapJurado.pdf');
    }
    
    /*
     * Reporte con los proyectos de un director seleccionado
     *
     * @param int $director
     *
     * @return \Illuminate\Http\Response
     */
    public function directorProject($director)
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $proyectos = Encargados::where('NCRD_Cargo', '=', "Director")
            ->where('FK_Developer_User_Id', '=', $director)
            ->with(['anteproyecto' => function ($proyecto) {
                $proyecto->with(['radicacion',
                                 'director',
                                 'jurado1',
                                 'jurado2',
                                 'estudiante1',
                                 'estudiante2',
                                 'proyecto',
                                 'conceptoFinal']);
            }])
            ->get();
        $docente = User::find($director);
        return view($this->path.'PDF.ProyectoDocentePDF', [
            'proyectos'=>$proyectos,
            'docente'=>$docente,
            'date'=>$date,
            'time'=>$time,
            'cargo'=>"DIRECTOR"
        ]);
        
    }
    
        /*
     * Descarga de reporte con los proyectos de un director seleccionado
     *
     * @param int $jury
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadDirectorProject($director)
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
         $proyectos = Encargados::where(function ($query) {
                            $query->where('NCRD_Cargo', '=', "Jurado 1")  ;
                            $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
        })
            ->where('FK_Developer_User_Id', '=', $director)
            ->with(['anteproyecto' => function ($proyecto) {
                $proyecto->with(['radicacion',
                                 'director',
                                 'jurado1',
                                 'jurado2',
                                 'estudiante1',
                                 'estudiante2',
                                 'proyecto',
                                 'conceptoFinal']);
            }])
            ->get();
        $docente = User::find($director);
        return SnappyPdf::loadView($this->path.'PDF.ProyectoDocentePDF', [
            'proyectos'=>$proyectos,
            'docente'=>$docente,
            'date'=>$date,
            'time'=>$time,
            'cargo'=>"JURADO"
        ])->download('ReporteGesapDirector.pdf');
    }
    
    
    
    public function graficos()
    {
        $anteproyectos=Anteproyecto::all()->count();
        
        $anteproyectosR=Anteproyecto::where('NPRY_Estado','=','RECHAZADO')->count();
        if($anteproyectos==0){
            $anteproyectosRP=$anteproyectosR*100/1;    
        }else{
            $anteproyectosRP=$anteproyectosR*100/$anteproyectos;
        }
        $proyectos=Proyecto::all()->count();
        if($anteproyectos==0){
            $proyectosP=$proyectos*100/1;    
        }else{
            $proyectosP=$proyectos*100/$anteproyectos;
        }
        
        $proyectosT=Proyecto::where('PRYT_Estado','=','TERMINADO')->count();
        if($proyectos==0){
            $proyectosTP=$proyectosT*100/1;
        }else{
            $proyectosTP=$proyectosT*100/$proyectos;
        }
        
        return view('gesap.Coordinador.Graficos',[
            'anteproyectos'=>$anteproyectos,
            'anteproyectosR'=>$anteproyectosR,
            'anteproyectosRP'=>$anteproyectosRP,
            'proyectos'=>$proyectos,
            'proyectosP'=>$proyectosP,
            'proyectosT'=>$proyectosT,
            'proyectosTP'=>$proyectosTP
        ]);
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
                $user->select('id','name','lastname');
            }])
            ->get(['FK_Developer_User_Id',DB::raw('COUNT(*) as value')])
            ;
        
        foreach($stats as $row){
            $row['Nombre']=$row->usuarios->name;
            $row['Apellido']=$row->usuarios->lastname;
            unset($row['FK_Developer_User_Id']);
            unset($row['usuarios']);
        }
        
        return $stats->toJSON();
    }
    public function getDirector()
    {
        $stats = Encargados::where('NCRD_Cargo', '=', "Director") 
        ->groupBy('FK_Developer_User_Id')    
            ->with(['usuarios'=> function ($user) {
                $user->select('id','name','lastname');
            }])
            ->get(['FK_Developer_User_Id',DB::raw('COUNT(*) as value')])
            ;
        
        foreach($stats as $row){
            $row['Nombre']=$row->usuarios->name;
            $row['Apellido']=$row->usuarios->lastname;
            unset($row['FK_Developer_User_Id']);
            unset($row['usuarios']);
        }
        
        return $stats->toJSON();
    }
    
    
    
    
}
