<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;

use App\Container\gesap\src;
use App\Container\gesap\src\Observaciones;
use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Encargados;
use App\Container\gesap\src\Check_Observaciones;
use App\Container\gesap\src\Respuesta;
use App\Container\gesap\src\Conceptos;

use App\Container\Overall\Src\Facades\AjaxResponse;

class EvaluatorController extends Controller
{
    
    
    private $path='gesap.Evaluador.';
    protected $connection = 'gesap';
    
    public function index()
    {
        return redirect()->route('anteproyecto.index.juryList');
    }

    public function jury()
    {
        return view($this->path.'JuradoList');
    }
    
    public function createObservations($id)
    {
        $anteproyectos = Anteproyecto::select('PK_NPRY_idMinr008','NPRY_Titulo')
                            ->where('PK_NPRY_idMinr008','=',$id)
                            ->get();
        return view($this->path.'Observaciones',compact('anteproyectos'));
    }
    public function storeObservations(Request $request)
    {
        try
        {
            $jurado = Encargados::select('PK_NCRD_idCargo')
                        ->where('FK_TBL_Anteproyecto_id','=',$request['PK_anteproyecto'])
                        ->where('FK_developer_user_id','=',$request['user'])
                        ->where(function($query){
                            $query->where('NCRD_Cargo', '=', 'Jurado 1')  ;
                            $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                        })
                        ->firstOrFail();
            
            $observacion= new Observaciones();
            $observacion->BVCS_Observacion=$request['observacion'];
            $observacion->FK_TBL_Encargado_id=$jurado->PK_NCRD_idCargo;
            $observacion->save();
            
            $checkobservacion= new Check_Observaciones();
            $checkobservacion->FK_TBL_Observaciones_id=$observacion->PK_BVCS_idObservacion;
            $checkobservacion->save();
            

            if(!empty($request['Min']) || !empty($request['Requerimientos']))
            {
                $respuesta=new Respuesta();
                if(!empty($request['Min']))
                {
                    $respuesta->RPST_RMin=$request['Min']->getClientOriginalName();
                }
                else{
                    $respuesta->RPST_RMin=0;
                }
                if(!empty($request['Requerimientos'])){
                    $respuesta->RPST_Requerimientos=$request['Requerimientos']->getClientOriginalName();
                }
                else
                {
                    $respuesta->RPST_Requerimientos=0;
                }
                $respuesta->FK_TBL_Observaciones_id=$observacion->PK_BVCS_idObservacion;
                $respuesta->save();
            }
        
            return redirect()->route('anteproyecto.index.juryList');
        
        }
        catch(Exception $e)
        {
            return "Fatal Error =".$e->getMessage();
        }
        
    }
    
    public function createConcepts($id)
    {
        $anteproyectos = Anteproyecto::select('PK_NPRY_idMinr008','NPRY_Titulo')
                            ->where('PK_NPRY_idMinr008','=',$id)
                            ->get();
        return view($this->path.'Conceptos',compact('anteproyectos'));
    }
    
    public function storeConcepts(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            //Busco el ID del Encargado(Usuario respecto al proyecto)
            $jurado = Encargados::select('PK_NCRD_idCargo','NCRD_Cargo')
                ->where('FK_TBL_Anteproyecto_id','=',$request['proyecto'])
                ->where('FK_developer_user_id','=',$request->user()->id)
                ->where(function($query){
                    $query->where('NCRD_Cargo', '=', 'Jurado 1')  ;
                    $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                })
                ->firstOrFail();
            
            if($jurado->NCRD_Cargo=="Jurado 1") 
            {
                $other="Jurado 2";
            }
            else 
            {
                $other="Jurado 1";
            }
             
            $jurado2=Encargados::select('PK_NCRD_idCargo','NCRD_Cargo')
                ->where('FK_TBL_Anteproyecto_id','=',$request['proyecto'])
                ->where('NCRD_Cargo','=',$other)
                ->firstOrFail();
             
             
            //Consulto si los jurados ya ha realizado un concepto anteriormente
            $encargado=Conceptos::select('PK_CNPT_Conceptos','CNPT_Concepto')
                ->where('FK_TBL_Encargado_id','=',$jurado->PK_NCRD_idCargo)
                ->where('CNPT_Tipo','=','Anteproyecto')
                ->first();
            
             $encargado2=Conceptos::select('PK_CNPT_Conceptos','CNPT_Concepto')
                ->where('FK_TBL_Encargado_id','=',$jurado2->PK_NCRD_idCargo)
                ->where('CNPT_Tipo','=','Anteproyecto')
                ->first();
             
             $anteproyecto = Anteproyecto::findOrFail($request['proyecto']);
            
             if($encargado==null)//Averiguo si se encontro un concepto previo
             {
                //si no lo hay se crea el concepto nuevo de este jurado respecto al proyecto
                Conceptos::create([
                    'CNPT_Concepto'=>$request['concepto'] ,
                    'CNPT_Tipo'    =>"Anteproyecto",    
                    'FK_TBL_Encargado_id'=>$jurado->PK_NCRD_idCargo
                ]);
                if($encargado2!=null)
                {
                    if($request['concepto']!=$encargado2->CNPT_Concepto)
                    {
                        $anteproyecto->NPRY_Estado="PENDIENTE";
                        $anteproyecto->save();
                        return AjaxResponse::success(
                            '¡Registro exitoso!',
                            'Los conceptos no estan deacuerdo.'
                        ); 
                     }
                 }
                 $anteproyecto->NPRY_Estado="EN REVISION";
                 $anteproyecto->save();
                 return AjaxResponse::success(
                    '¡Registro exitoso!',
                    'El concepto fue registrado correctamente.'
                 );
             }
             else//Si existe ya un concepto se actualiza el mismo
             {
                Conceptos::updateOrCreate(
                    ['PK_CNPT_Conceptos'=>$encargado->PK_CNPT_Conceptos],
                    ['CNPT_Concepto'=>$request['concepto'] ,
                    'CNPT_Tipo'    =>"Anteproyecto",    
                    'FK_TBL_Encargado_id'=>$jurado->PK_NCRD_idCargo]
                );
                if($encargado2!=null)
                {
                    if($request['concepto']!=$encargado2->CNPT_Concepto)
                    {
                        $anteproyecto->NPRY_Estado="PENDIENTE";
                        $anteproyecto->save();
                        return AjaxResponse::success(
                            '¡Registro exitoso!',
                            'Los conceptos no estan deacuerdo.'
                        ); 
                     }
                    else
                    {
                        if($request['concepto']==1)
                        {
                            $anteproyecto->NPRY_Estado="APROBADO";    
                        }
                        else
                        {
                            if($request['concepto']==2)
                            {
                                $anteproyecto->NPRY_Estado="APLAZADO";
                            }
                            else
                            {
                                if($request['concepto']==3)
                                {
                                    $anteproyecto->NPRY_Estado="RECHAZADO";
                                }
                                else
                                {
                                    $anteproyecto->NPRY_Estado="COMPLETADO";
                                }
                            }
                        }
                     }
                    $anteproyecto->save();
                    return AjaxResponse::success(
                        '¡Actualizacion exitosa!',
                        'El concepto se ha actualizado correctamente.'
                    );
                 }
            }
            $anteproyecto->NPRY_Estado="EN REVISION";
            $anteproyecto->save();
            return AjaxResponse::success(
                '¡Actualizacion exitosa!',
                'El concepto se ha actualizado correctamente.'
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
    
    public function director()
    {
        return view($this->path.'DirectorList');
    }
    
    public function create()
    {
    }

    public function store(Request $request)
    {        
    }

    public function show($id)
    {
        return view($this->path.'ShowObservation',compact('id'));
    }

    public function edit($id)
    {
        return view($this->path.'Observaciones');
    }
    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
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
    
    public function observationsList($id)
    {
        $observaciones=
            DB::table('gesap.tbl_observaciones AS O')
                ->select('PK_BVCS_idObservacion','BVCS_Observacion',
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            Encargados::join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                                ->select(DB::raw('concat(name," ",lastname)'))
                                ->where('tbl_encargados.PK_NCRD_idCargo','=',DB::raw('O.FK_TBL_Encargado_id'))
                        )
                    .'),"error")AS Jurado'),
                    DB::raw('IFNULL(('
                        .$this->getSql(
                            Respuesta::select('RPST_RMin')
                                ->where('FK_TBL_Observaciones_id','=',DB::raw('O.PK_BVCS_idObservacion'))
                        )
                    .'),"No existe")AS Rmin'),
                     DB::raw('IFNULL(('
                        .$this->getSql(
                            Respuesta::select('RPST_Requerimientos')
                                ->where('FK_TBL_Observaciones_id','=',DB::raw('O.PK_BVCS_idObservacion'))
                            )
                    .'),"No existe")AS Rreq')
                )
                ->where('FK_TBL_Anteproyecto_id','=',$id)
                ->where(function($query)
                        {
                            $query->where('NCRD_Cargo', '=', 'Jurado 1')  ;
                            $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                        })
                ->join('gesap.tbl_encargados','FK_TBL_Encargado_id','=','PK_NCRD_idCargo');
        return Datatables::of(DB::select($this->getSql($observaciones)))->addIndexColumn()->make(true);
    }

    
    public function Encargados($select,$cargo){
        if($select="Nombre")
        {
            $Consulta=Encargados::join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->where('NCRD_Cargo',$cargo)
                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select(DB::raw('concat(name," ",lastname)'));
        }
        if($select="ID")
        {
            $Consulta=Encargados::join('developer.users','tbl_encargados.FK_developer_user_id','=','developer.users.id')
                ->where('NCRD_Cargo',$cargo)
                ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                ->select('FK_developer_user_id');
        }
        return $this->getSql($Consulta);
    }
    
    
    public function directorList(Request $request)
    {
        $result="NO ASIGNADO";
        $anteproyectos = 
            DB::table('gesap.TBL_Anteproyecto AS A')
                ->join('gesap.TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                ->join('gesap.tbl_encargados AS E',function($join)use($request)
                {
                    $join->on(DB::raw('E.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                    ->where('NCRD_Cargo','=',"Director")
                    ->where('FK_developer_user_id','=',$request->user()->id);
                })                       
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
    
    public function juryList(Request $request)
    {
       $result="NO ASIGNADO";
       
        $anteproyectos = 
            DB::table('gesap.TBL_Anteproyecto AS A')
                ->join('gesap.TBL_Radicacion AS R',DB::raw('R.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                ->join('gesap.tbl_encargados AS E',function($join)use($request)
                {
                    $join->on(DB::raw('E.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                    ->where(function($query)
                    {
                      $query->where('E.NCRD_Cargo', '=', "Jurado 1")  ;
                      $query->orwhere('E.NCRD_Cargo', '=', "Jurado 2");
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
                    DB::raw('('.$this->Encargados("ID","Estudiante 2").')AS estudiante2Cedula'),
                    DB::raw('('
                        .$this->getSql(
                            Encargados::join('tbl_conceptos',function($join)use($request)
                                        {
                                            $join->on('tbl_encargados.PK_NCRD_idCargo','=','FK_TBL_Encargado_id')
                                            ->where('CNPT_Tipo','=','Anteproyecto')
                                            ->where('FK_developer_user_id','=',$request->user()->id);
                                        })
                                    ->select('CNPT_Concepto')
                                    ->where('tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS Concepto'
                    )    
                );
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
   }

}
