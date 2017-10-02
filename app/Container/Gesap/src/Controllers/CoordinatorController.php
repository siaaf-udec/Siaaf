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
use App\Container\Users\Src\User;


class CoordinatorController extends Controller
{
    use traits\traitsGesap;
    
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
     * @return \Illuminate\Http\Response
     */
    public function index_ajax(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view($this->path.'AnteproyectoList-ajax');
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    } 
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {    
       if($request->ajax() && $request->isMethod('GET'))
       {
            $estudiantes=User::select(DB::raw('CONCAT(name, " ", lastname) AS name'),'id')
                ->whereHas('roles', function($e){
                    $e->where('name', 'Student_Gesap');
                })
                ->orderBy('name', 'asc')
                ->pluck('name','id')
                ->toArray();
            return view($this->path.'RegistroMin',compact('estudiantes'));
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
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
            \Storage::disk('local')->put($request['Min']->getClientOriginalName(),  \File::get($request->file('Min')));
            if($request['Requerimientos']=="Vacio")
            {
                $radicacion->RDCN_Requerimientos="NO FILE";
            }
            else
            {
                $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();        
                \Storage::disk('local')->put($request['Requerimientos']->getClientOriginalName(), \File::get($request->file('Requerimientos')));
            }
            $radicacion->FK_TBL_Anteproyecto_id=$idanteproyecto;
            
            $radicacion->save();
            
            $idRadicacion=$radicacion->PK_RDCN_idRadicacion;
            
            Encargados::create([
                'FK_TBL_Anteproyecto_id'    =>$idanteproyecto ,
                'FK_developer_user_id'      =>$request['estudiante1'],    
                'NCRD_Cargo'                =>"Estudiante 1"
            ]);
        
            if($request['estudiante2']!=0)
            {
                Encargados::create([
                    'FK_TBL_Anteproyecto_id'    =>$idanteproyecto ,
                    'FK_developer_user_id'      =>$request['estudiante2'],    
                    'NCRD_Cargo'                =>"Estudiante 2"
                ]);
                
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
     
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        if($request->ajax() && $request->isMethod('GET'))
       {

            $estudiantes=User::select(DB::raw('CONCAT(name, " ", lastname) AS name'),'id')
                ->whereHas('roles', function($e){
                    $e->where('name', 'Student_Gesap');
                })
                ->orderBy('name', 'asc')
                ->pluck('name','id')
                ->toArray();
            
            $anteproyecto=Anteproyecto::Project($id)->get();
                     
            $estudiante12=Encargados::Search($id)
                ->where(function($query)
                {
                    $query->where('NCRD_Cargo','ESTUDIANTE 1')  ;
                    $query->orwhere('NCRD_Cargo','ESTUDIANTE 2');
                })
                ->get();
            
            return view($this->path.'ModificarMin', compact("anteproyecto",'estudiante12',"estudiantes"));
           }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
                
        $anteproyecto = Anteproyecto::findOrFail($request['PK_proyecto']);
        $anteproyecto->NPRY_Titulo=$request['title'];
        $anteproyecto->NPRY_Keywords=$request['Keywords'];
        $anteproyecto->NPRY_Duracion=$request['duracion'];
        $anteproyecto->NPRY_FechaR=$request['FechaR'];
        $anteproyecto->NPRY_FechaL=$request['FechaL'];
        $anteproyecto->save();
            
        $radicacion= Radicacion::findOrFail($request['PK_radicacion']);
        if($request['Min']!="Vacio")
        {
            $radicacion->RDCN_Min=$request['Min']->getClientOriginalName();
            \Storage::disk('local')->put($request['Min']->getClientOriginalName(),  \File::get($request->file('Min')));
        }
        if($request['Requerimientos']!="Vacio")
        {
            $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();
            \Storage::disk('local')->put($request['Requerimientos']->getClientOriginalName(), \File::get($request->file('Requerimientos')));
        }
        $radicacion->save();
            
          
        if($request['PK_estudiante1']!="")
        {
            $estudiante1 = Encargados::findOrFail($request['PK_estudiante1']);
            if($request['estudiante1']!=0)
            {    
                $estudiante1->FK_developer_user_id=$request['estudiante1'];
                $estudiante1->save();
            }
            else{
                $estudiante1->delete();
            }
        }
        else
        {
            if($request['estudiante1']!=0)
            {
                Encargados::create([
                    'FK_TBL_Anteproyecto_id'    =>$request['PK_proyecto'] ,
                    'FK_developer_user_id'      =>$request['estudiante1'],    
                    'NCRD_Cargo'                =>"Estudiante 1"
                ]);
            }
        }
            
        if($request['PK_estudiante2']!="")
        {
            $estudiante2 = Encargados::findOrFail($request['PK_estudiante2']);
            if($request['estudiante2']!=0)
            {    
                $estudiante2->FK_developer_user_id=$request['estudiante2'];
                $estudiante2->save();
            }
            else{
                $estudiante2->delete();
            }
        }
        else
        {
            if($request['estudiante2']!=0)
            {
                Encargados::create([
                'FK_TBL_Anteproyecto_id'=>$request['PK_proyecto'] ,
                'FK_developer_user_id'    =>$request['estudiante2'],    
                'NCRD_Cargo'            =>"Estudiante 2"
                ]);
            }
        }

      return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        if($request->ajax() && $request->isMethod('DELETE')){
 
            $anteproyecto = Anteproyecto::findOrFail($id);
            $anteproyecto->delete();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
        
    }
    
    
    /*ASIGNACION DE DOCENTES*/
    public function assign($id,Request $request)
    {   
        if($request->ajax() && $request->isMethod('GET'))
        {
            $anteproyectos = Anteproyecto::select('PK_NPRY_idMinr008','NPRY_Titulo')
                ->where('PK_NPRY_idMinr008','=',$id)
                ->get();
        
            $docentes=User::select(DB::raw('CONCAT(name, " ", lastname) AS name'),'id')
                ->whereHas('roles', function($e){
                    $e->where('name', 'Coordinator_Gesap');
                    $e->orwhere('name', '=', 'Evaluator_Gesap');
                })
                ->orderBy('name', 'asc')
                ->pluck('name','id')
                ->toArray();
        
            $encargados=Encargados::Search($id)
                ->where(function($query)
                {
                    $query->where('NCRD_Cargo','DIRECTOR')  ;
                    $query->orwhere('NCRD_Cargo','JURADO 1');
                    $query->orwhere('NCRD_Cargo','JURADO 2');
                })
                ->get();
                
            return view($this->path.'AsignarDocente',compact('anteproyectos','docentes','encargados') );
         }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    public function saveAssign(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            if($request['PK_director']!="")
            {
                $director = Encargados::findOrFail($request['PK_director']);
                $director->FK_developer_user_id=$request['director'];
                $director->save();
            }
            else
            {
                if($request['director']!=0)
                {                    
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_developer_user_id'    =>$request['director'],    
                        'NCRD_Cargo'            =>"Director"
                    ]);
                }
            }
            
            if($request['PK_jurado1']!="")
            {
                $jurado1 = Encargados::findOrFail($request['PK_jurado1']);
                $jurado1->FK_developer_user_id=$request['jurado1'];
                $jurado1->save();
            }
            else
            {
                if($request['jurado1']!=0)
                {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_developer_user_id'    =>$request['jurado1'],
                        'NCRD_Cargo'            =>"Jurado 1"
                    ]);
                }
            }
            
            if($request['PK_jurado2']!="")
            {
                $jurado1 = Encargados::findOrFail($request['PK_jurado2']);
                $jurado1->FK_developer_user_id=$request['jurado2'];
                $jurado1->save();
            }
            else
            {
                if($request['jurado2']!=0)
                {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_id'=>$request['PK_anteproyecto'] ,
                        'FK_developer_user_id'    =>$request['jurado2'],    
                        'NCRD_Cargo'            =>"Jurado 2"
                    ]);
                }
            }
              
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
  
    public function indexPDF()
    {
        $proyectos=DB::select($this->getSql(Anteproyecto::from('TBL_Anteproyecto AS A')->Data()));
        
        return view($this->path.'pdf.AnteproyectosPDF',compact('proyectos'));
    }
    
    public function createPDF()
    {
        $proyectos=DB::select($this->getSql(Anteproyecto::from('TBL_Anteproyecto AS A')->Data()));
        
        return SnappyPdf::loadView($this->path.'pdf.AnteproyectosPDF',compact('proyectos'))->download('ReporteAnteproyectosGesap.pdf');
    }
    
    public function projectList()
    {
        $anteproyectos = Anteproyecto::from('TBL_Anteproyecto AS A')->Data();
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
    
    }
    
    
}
