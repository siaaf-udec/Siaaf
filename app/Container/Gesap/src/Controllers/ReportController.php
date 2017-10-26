<?php
namespace App\Container\gesap\src\Controllers;

use Illuminate\Support\Facades\Storage;
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
     * Vista principal de generacion de reportes en PDF
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
	 * @param  \Illuminate\Http\Request 
	 *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function allProject(Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $proyectos=Anteproyecto::
                with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2'])
                ->get();
            return view($this->path.'PDF.AnteproyectosPDF', [
                'proyectos'=>$proyectos,
                'date'=>$date,
                'time'=>$time
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    

    /*
     * Descarga de reporte de todos los proyectos
     *
	 * @param  \Illuminate\Http\Request 
     *
     * @return Barryvdh\Snappy\Facades\SnappyPdf | \App\Container\Overall\Src\Facades\AjaxResponse | \Illuminate\Http\Response
     */
    public function allProjectPrint(Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");
                $time = date("h:i A");
                $proyectos=Anteproyecto::
					with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2'])
                	->get();

                return SnappyPdf::loadView($this->path.'PDF.AnteproyectosPDF', [
                    'proyectos'=>$proyectos,
                    'date'=>$date,
                    'time'=>$time,
                ])->download('ReporteAnteproyectosGesap.pdf');
            } catch (Exception $e) {
                return $this->index();
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Reporte con los proyectos de un jurado seleccionado
     *
     * @param int $jury
	 * @param  \Illuminate\Http\Request 
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function juryProject($jury, Request $request)
    {
        if ($request->isMethod('GET')) {
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
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Descarga de reporte con los proyectos de un jurado seleccionado
     *
     * @param int $jury
	 * @param  \Illuminate\Http\Request 
     *
     * @return Barryvdh\Snappy\Facades\SnappyPdf | \App\Container\Overall\Src\Facades\AjaxResponse | \Illuminate\Http\Response
     */
    public function downloadJuryProject($jury, Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
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
                    'proyectos' =>  $proyectos,
                    'docente'   =>  $docente,
                    'date'      =>  $date,
                    'time'      =>  $time,
                    'cargo'     =>  "JURADO"
                ])->download('ReporteGesapJurado.pdf');
            } catch (Exception $e) {
                return $this->index();
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    
    /*
     * Reporte con los proyectos de un director seleccionado
     *
     * @param int $director
	 * @param  \Illuminate\Http\Request 
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function directorProject($director, Request $request)
    {
        if ($request->isMethod('GET')) {
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
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Descarga de reporte con los proyectos de un director seleccionado
     *
     * @param int $director
	 * @param  \Illuminate\Http\Request 
     *
     * @return Barryvdh\Snappy\Facades\SnappyPdf | \App\Container\Overall\Src\Facades\AjaxResponse | \Illuminate\Http\Response
     */
    public function downloadDirectorProject($director, Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
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
            } catch (Exception $e) {
                return $this->index();
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Vista con graficos
     *
     * @return \Illuminate\Http\Response 
     */
    public function graficos()
    {
        $anteproyectos=Anteproyecto::all()->count();

        $anteproyectosR=Anteproyecto::where('NPRY_Estado', '=', 'RECHAZADO')->count();
        if ($anteproyectos==0) {
            $anteproyectosRP=$anteproyectosR*100/1;
        } else {
            $anteproyectosRP=$anteproyectosR*100/$anteproyectos;
        }
        $proyectos=Proyecto::all()->count();
        if ($anteproyectos==0) {
            $proyectosP=$proyectos*100/1;
        } else {
            $proyectosP=$proyectos*100/$anteproyectos;
        }

        $proyectosT=Proyecto::where('PRYT_Estado', '=', 'TERMINADO')->count();
        if ($proyectos==0) {
            $proyectosTP=$proyectosT*100/1;
        } else {
            $proyectosTP=$proyectosT*100/$proyectos;
        }

        return view('gesap.Coordinador.Graficos', [
            'anteproyectos'=>$anteproyectos,
            'anteproyectosR'=>$anteproyectosR,
            'anteproyectosRP'=>$anteproyectosRP,
            'proyectos'=>$proyectos,
            'proyectosP'=>$proyectosP,
            'proyectosT'=>$proyectosT,
            'proyectosTP'=>$proyectosTP
        ]);
    }
    
    /*
     * Datos de grafico de estado de anteproyectos
     *
	 * @param  \Illuminate\Http\Request 
	 *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function getPreliminary(Request $request)
    {
        if ($request->isMethod('GET')) {
            $stats = Anteproyecto::groupBy('Estado')
            ->get([
				'NPRY_Estado AS Estado',
				DB::raw('COUNT(*) as value')
			])
            ->toJSON();
            return $stats;
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Datos de grafico de estado de proyectos
     *
	 * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function getProject(Request $request)
    {
        if ($request->isMethod('GET')) {
            $stats = Proyecto::groupBy('Estado')

            ->get([
                'PRYT_Estado as Estado',
                DB::raw('COUNT(*) as value')
            ])
            ->toJSON();
            return $stats;
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    
    /*
     * Datos de grafico de proyectos y anteproyectos por jurado
     *
	 * @param  \Illuminate\Http\Request
	 *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function getJury(Request $request)
    {
        if ($request->isMethod('GET')) {
            $stats = Encargados::where(function ($query) {
                $query->where('NCRD_Cargo', '=', "Jurado 1")  ;
                $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
            })
            ->groupBy('FK_Developer_User_Id')
                ->with(['usuarios'=> function ($user) {
                    $user->select('id', 'name', 'lastname');
                }])
                ->get([
					'FK_Developer_User_Id',
					DB::raw('COUNT(*) as value')
				])
                ;

            foreach ($stats as $row) {
                $row['Nombre']=$row->usuarios->name;
                $row['Apellido']=$row->usuarios->lastname;
                unset($row['FK_Developer_User_Id']);
                unset($row['usuarios']);
            }

            return $stats->toJSON();
        
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Datos de grafico de proyectos y anteproyectos por director
     *
	 * @param  \Illuminate\Http\Request
	 *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function getDirector(Request $request)
    {
        if ($request->isMethod('GET')) {
            $stats = Encargados::where('NCRD_Cargo', '=', "Director")
            ->groupBy('FK_Developer_User_Id')
                ->with(['usuarios'=> function ($user) {
                    $user->select('id', 'name', 'lastname');
                }])
                ->get([
					'FK_Developer_User_Id',
					DB::raw('COUNT(*) as value')
				])
                ;

            foreach ($stats as $row) {
                $row['Nombre']=$row->usuarios->name;
                $row['Apellido']=$row->usuarios->lastname;
                unset($row['FK_Developer_User_Id']);
                unset($row['usuarios']);
            }

            return $stats->toJSON();
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
