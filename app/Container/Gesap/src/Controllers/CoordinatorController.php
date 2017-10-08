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

class CoordinatorController extends Controller
{
    
    private $path='gesap.Coordinador.';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path.'AnteproyectoList');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'AnteproyectoList-ajax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
     
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $estudiantes=User::orderBy('name', 'asc')
                ->whereHas('roles', function ($e) {
                    $e->where('name', 'Student_Gesap');
                })
                ->get(['name','lastname','id'])
                ->pluck('full_name', 'id')
                ->toArray();
            return view($this->path.'RegistroMin', [
                'estudiantes' => $estudiantes
            ]);
        }
        
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $date = Carbon::now();
            $date= $date->format('his');
        
            $anteproyecto= new Anteproyecto();
            $anteproyecto->NPRY_Titulo=$request->get('title');
            $anteproyecto->NPRY_Keywords=$request->get('Keywords');
            $anteproyecto->NPRY_Duracion=$request->get('duracion');
            $anteproyecto->NPRY_FechaR=$request->get('FechaR');
            $anteproyecto->NPRY_FechaL=$request->get('FechaL');
            $anteproyecto->save();
            
            $idanteproyecto=$anteproyecto->PK_NPRY_idMinr008;
            
            $radicacion= new Radicacion();
            $nombre = $date."_".$request->get('Min')->getClientOriginalName();
            $radicacion->RDCN_Min=$nombre;
            \Storage::disk('local')->put($nombre, \File::get($request->file('Min')));
            if ($request->get('Requerimientos') == "Vacio") {
                $radicacion->RDCN_Requerimientos="NO FILE";
            } else {
                $nombre = $date."_".$request->get('Requerimientos')->getClientOriginalName();
                $radicacion->RDCN_Requerimientos=$nombre;
                \Storage::disk('local')->put($nombre, \File::get($request->file('Requerimientos')));
            }
            $radicacion->FK_TBL_Anteproyecto_id=$idanteproyecto;
            $radicacion->save();
            
            Encargados::create([
                'FK_TBL_Anteproyecto_id'    =>$idanteproyecto,
                'FK_developer_user_id'      =>$request->get('estudiante1'),
                'NCRD_Cargo'                =>"Estudiante 1"
            ]);
        
            if ($request->get('estudiante2')!=0) {
                Encargados::create([
                    'FK_TBL_Anteproyecto_id'    =>$idanteproyecto ,
                    'FK_developer_user_id'      =>$request->get('estudiante2'),
                    'NCRD_Cargo'                =>"Estudiante 2"
                ]);
                
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
    }
     
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $estudiantes=User::orderBy('name', 'asc')
                ->whereHas('roles', function ($e) {
                            $e->where('name', 'Student_Gesap');
                })
                ->get(['name','lastname','id'])
                ->pluck('full_name', 'id')
                ->toArray();
            
            $anteproyecto=Anteproyecto::Project($id)->get();
                     
            $estudiante12=Encargados::Search($id)
                ->where(function ($query) {
                    $query->where('NCRD_Cargo', 'ESTUDIANTE 1')  ;
                    $query->orwhere('NCRD_Cargo', 'ESTUDIANTE 2');
                })
                ->get();
            
            return view($this->path.'ModificarMin', [
                "anteproyecto"=>$anteproyecto,
                "estudiante12"=>$estudiante12,
                "estudiantes"=>$estudiantes
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $date = Carbon::now();
            $date= $date->format('his');
            $anteproyecto = Anteproyecto::findOrFail($request->get('PK_proyecto'));
            $anteproyecto->NPRY_Titulo=$request->get('title');
            $anteproyecto->NPRY_Keywords=$request->get('Keywords');
            $anteproyecto->NPRY_Duracion=$request->get('duracion');
            $anteproyecto->NPRY_FechaR=$request->get('FechaR');
            $anteproyecto->NPRY_FechaL=$request->get('FechaL');
            $anteproyecto->save();
            
            $radicacion= Radicacion::findOrFail($request->get('PK_radicacion'));
            if ($request->get('Min')!="Vacio") {
                \Storage::delete($radicacion->RDCN_Min);
                $nombre = $date."_".$request->get('Min')->getClientOriginalName();
                $radicacion->RDCN_Min=$nombre;
                \Storage::disk('local')->put($nombre, \File::get($request->file('Min')));
            }
            if ($request->get('Requerimientos')!="Vacio") {
                \Storage::delete($radicacion->RDCN_Requerimientos);
                $nombre = $date."_".$request->get('Requerimientos')->getClientOriginalName();
                $radicacion->RDCN_Requerimientos=$nombre;
                \Storage::disk('local')->put($nombre, \File::get($request->file('Requerimientos')));
            }
            $radicacion->save();
                                                     
            if ($request->get('PK_estudiante1')!="") {
                $estudiante1 = Encargados::findOrFail($request->get('PK_estudiante1'));
                if ($request->get('estudiante1')!=0) {
                    $estudiante1->FK_developer_user_id=$request->get('estudiante1');
                    $estudiante1->save();
                } else {
                    $estudiante1->delete();
                }
            } else {
                if ($request->get('estudiante1')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'    =>$request->get('PK_proyecto') ,
                        'FK_developer_user_id'      =>$request->get('estudiante1'),
                        'NCRD_Cargo'                =>"Estudiante 1"
                    ]);
                }
            }
            
            if ($request->get('PK_estudiante2')!="") {
                $estudiante2 = Encargados::findOrFail($request->get('PK_estudiante2'));
                if ($request->get('estudiante2')!=0) {
                    $estudiante2->FK_developer_user_id=$request->get('estudiante2');
                    $estudiante2->save();
                } else {
                    $estudiante2->delete();
                }
            } else {
                if ($request->get('estudiante2')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request->get('PK_proyecto') ,
                        'FK_developer_user_id'    =>$request->get('estudiante2'),
                        'NCRD_Cargo'            =>"Estudiante 2"
                    ]);
                }
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
 
            $anteproyecto = Anteproyecto::findOrFail($id);
            $anteproyecto->delete();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $anteproyectos = Anteproyecto::select('PK_NPRY_idMinr008', 'NPRY_Titulo')
                ->where('PK_NPRY_idMinr008', '=', $id)
                ->get();
        
            $docentes=User::orderBy('name', 'asc')
                ->whereHas('roles', function ($e) {
                    $e->where('name', 'Coordinator_Gesap');
                    $e->orwhere('name', '=', 'Evaluator_Gesap');
                })
                ->get(['name', 'lastname', 'id'])
                ->pluck('full_name', 'id')
                ->toArray();
        
            $encargados=Encargados::Search($id)
                ->where(function ($query) {
                    $query->where('NCRD_Cargo', 'DIRECTOR')  ;
                    $query->orwhere('NCRD_Cargo', 'JURADO 1');
                    $query->orwhere('NCRD_Cargo', 'JURADO 2');
                })
                ->get();
                
            return view($this->path.'AsignarDocente', [
                'anteproyectos'=>$anteproyectos,
                'docentes'=>$docentes,
                'encargados'=>$encargados]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveAssign(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            if ($request->get('PK_director')!="") {
                $director = Encargados::findOrFail($request->get('PK_director'));
                $director->FK_developer_user_id=$request->get('director');
                $director->save();
            } else {
                if ($request->get('director')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request->get('PK_anteproyecto') ,
                        'FK_developer_user_id'    =>$request->get('director'),
                        'NCRD_Cargo'            =>"Director"
                    ]);
                }
            }
            
            if ($request->get('PK_jurado1')!="") {
                $jurado1 = Encargados::findOrFail($request->get('PK_jurado1'));
                $jurado1->FK_developer_user_id=$request->get('jurado1');
                $jurado1->save();
            } else {
                if ($request->get('jurado1')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request->get('PK_anteproyecto') ,
                        'FK_developer_user_id'    =>$request->get('jurado1'),
                        'NCRD_Cargo'            =>"Jurado 1"
                    ]);
                }
            }
            
            if ($request->get('PK_jurado2')!="") {
                $jurado1 = Encargados::findOrFail($request->get('PK_jurado2'));
                $jurado1->FK_developer_user_id=$request->get('jurado2');
                $jurado1->save();
            } else {
                if ($request->get('jurado2')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request->get('PK_anteproyecto') ,
                        'FK_developer_user_id'    =>$request->get('jurado2'),
                        'NCRD_Cargo'            =>"Jurado 2"
                    ]);
                }
            }
              
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    public function projectList()
    {
        $anteproyectos = Anteproyecto::from('TBL_Anteproyecto AS A')
            ->with(['radicacion','director','jurado1','jurado2','estudiante1','estudiante2'])
            ->get();
        return Datatables::of($anteproyectos)->addIndexColumn()->make(true);
        
    }
    
}
