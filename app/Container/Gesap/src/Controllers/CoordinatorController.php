<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use Validator;
use Exception;

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
    
    private $path='gesap.Coordinador.';
    
    
    /*TABLA DE ANTEPROYECTOS*/
    public function index()
    {
        return view($this->path.'AnteproyectoList');
    } 
    
    /*FORMULARIO DE CREACION DE ANTEPROYECTOS*/
    public function create()
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
    
    
    public function store(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')){
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
            if($request['Requerimientos']=="Vacio"){
                $radicacion->RDCN_Requerimientos="NO FILE";
            }else{
                $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();    
                
                \Storage::disk('local')->put($request['Requerimientos']->getClientOriginalName(),  \File::get($request->file('Requerimientos')));
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
                Encargados::create([
                    'FK_TBL_Anteproyecto_id'    =>$idanteproyecto ,
                    'FK_developer_user_id'      =>$request['estudiante2'],    
                    'NCRD_Cargo'                =>"Estudiante 2"
                ]);
            
             return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    public function show($id)
    {    
    }
    
    /*MODIFICAR ANTEPROYECTOS*/
    public function edit($id)
    {
        $estudiantes=User::select(DB::raw('CONCAT(name, " ", lastname) AS name'),'id')
            ->whereHas('roles', function($e){
                $e->where('name', 'Student_Gesap');
            })
            ->orderBy('name', 'asc')
            ->pluck('name','id')
            ->toArray();
        
        $anteproyecto=Anteproyecto::select('*')
                      ->join('TBL_Radicacion','FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008')
                      ->where('PK_NPRY_idMinr008','=',$id)
                      ->get();
                     
        $estudiante12=Encargados::join('developer.users','FK_developer_user_id','=','users.id')
                        ->join('tbl_anteproyecto',function ($join) use ($id)
                        {    
                            $join->on('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008');    
                            $join->where('PK_NPRY_idMinr008','=',$id);            
                        })
                        ->select(DB::raw('FK_developer_user_id AS Cedula'),'PK_NCRD_idCargo','NCRD_Cargo' )
                        ->where(function($query)
                        {
                            $query->where('NCRD_Cargo','ESTUDIANTE 1')  ;
                            $query->orwhere('NCRD_Cargo','ESTUDIANTE 2');
                        })
                        ->get();

        return view($this->path.'ModificarMin', compact("anteproyecto",'estudiante12',"estudiantes"));
    }
    
    public function update(Request $request, $id)
    {
        try
        {
                
        $anteproyecto = Anteproyecto::findOrFail($id);
        $anteproyecto->NPRY_Titulo=$request['title'];
        $anteproyecto->NPRY_Keywords=$request['Keywords'];
        $anteproyecto->NPRY_Duracion=$request['duracion'];
        $anteproyecto->NPRY_FechaR=$request['FechaR'];
        $anteproyecto->NPRY_FechaL=$request['FechaL'];
        $anteproyecto->save();
            
        $radicacion= Radicacion::findOrFail($request['PK_radicacion']);
        if(!empty($request['Min']))
        {
            $radicacion->RDCN_Min=$request['Min']->getClientOriginalName();
        }
        if(!empty($request['Requerimientos']))
        {
            $radicacion->RDCN_Requerimientos=$request['Requerimientos']->getClientOriginalName();
        }
        $radicacion->save();
            
          
        if(isset($request['PK_estudiante1']))
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
                    'FK_TBL_Anteproyecto_id'    =>$id ,
                    'FK_developer_user_id'      =>$request['estudiante1'],    
                    'NCRD_Cargo'                =>"Estudiante 1"
                ]);
            }
        }
            
        if(isset($request['PK_estudiante2']))
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
                'FK_TBL_Anteproyecto_id'=>$id ,
                'FK_developer_user_id'    =>$request['estudiante2'],    
                'NCRD_Cargo'            =>"Estudiante 2"
                ]);
            }
        }

        
        return redirect()->route('min.index');
    }
    catch(Exception $e)
    {
        return "Fatal Error =".$e->getMessage();;
    }
    }
    /*BORRAR ANTEPROYECTO*/
    public function destroy($id)
    {
        try
        {
            $anteproyecto = Anteproyecto::findOrFail($id);
            $anteproyecto->delete();
            return redirect()->route('min.index');
        }
        catch(Exception $e)
        {
            return "Fatal Error =".$e->getMessage();;
        }
        
    }
    /*ASIGNACION DE DOCENTES*/
    public function assign($id)
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
        
        $encargados=Encargados::join('developer.users','gesap.tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->join('gesap.tbl_anteproyecto',function ($join)use($id) 
                       {
                    $join->on('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=','PK_NPRY_idMinr008');            
                    $join->where('gesap.tbl_anteproyecto.PK_NPRY_idMinr008','=',$id);            
                })
                ->select(DB::raw('FK_developer_user_id AS Cedula'),'PK_NCRD_idCargo','NCRD_Cargo' )
                ->where(function($query)
                        {
                            $query->where('NCRD_Cargo','DIRECTOR')  ;
                            $query->orwhere('NCRD_Cargo','JURADO 1');
                            $query->orwhere('NCRD_Cargo','JURADO 2');
                        })
                ->get();
                
        return view($this->path.'AsignarDocente',compact('anteproyectos','docentes','encargados') );
    }
    
    public function saveAssign(Request $request)
    {
        try
        {
            if(isset($request['PK_director']))
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
            
            if(isset($request['PK_jurado1']))
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
            
            if(isset($request['PK_jurado2']))
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
              
            return redirect()->route('min.index');
        }
        catch(Exception $e)
        {
            return "Fatal Error =".$e->getMessage();;
        }
    }
    
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
    
    public function Encargados($select,$cargo){
        if($select="Nombre")
        {
            $Consulta=DB::table('gesap.tbl_encargados')->
                join('developer.users','gesap.tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->where('NCRD_Cargo',$cargo)
                ->where('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select(DB::raw('concat(name," ",lastname)'));
            return $this->getSql($Consulta);
        }
        if($select="ID")
        {
            $Consulta=DB::table('gesap.tbl_encargados')->join('developer.users','gesap.tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->where('NCRD_Cargo',$cargo)
                ->where('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select('FK_developer_user_id');
            return $this->getSql($Consulta);
        }
        
    }
    
    public function projectList()
    {
        $result="NO ASIGNADO";
        $anteproyectos = 
            DB::table('gesap.TBL_Anteproyecto AS A')
                ->join('gesap.TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select('A.*',
                    'R.RDCN_Min',
                    'R.RDCN_Requerimientos',
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
