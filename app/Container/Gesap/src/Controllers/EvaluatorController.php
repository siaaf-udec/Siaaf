<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\File;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Validator;

use App\Http\Controllers\Controller;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Overall\Src\Facades\UploadFile;

use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;
use App\Container\gesap\src;
use App\Container\gesap\src\Observaciones;
use App\Container\gesap\src\Check_Observaciones;
use App\Container\gesap\src\Respuesta;
use App\Container\gesap\src\Conceptos;
use App\Container\Users\Src\User;



class EvaluatorController extends Controller
{
        
    use traits\traitsGesap;
    
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
    
    public function storeObservations(Request $request)
    {
      if($request->ajax() && $request->isMethod('POST'))
      {
            $jurado = Encargados::select('PK_NCRD_idCargo')
                        ->where('FK_TBL_Anteproyecto_id','=',$request['proyecto'])
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
            
          
          
            if($request['Min']=="Vacio" || $request['Requerimientos']=="Vacio")
            {
                $respuesta=new Respuesta();
                if($request['Min']=="Vacio" )
                {
                    $respuesta->RPST_RMin="NO FILE";
                }
                else
                {
                    $respuesta->RPST_RMin=$request['Min']->getClientOriginalName();
                    
                }
                if($request['Requerimientos']!="Vacio"){
                    $respuesta->RPST_Requerimientos=$request['Requerimientos']->getClientOriginalName();
                }
                else
                {
                    $respuesta->RPST_Requerimientos="NO FILE";
                }
                $respuesta->FK_TBL_Observaciones_id=$observacion->PK_BVCS_idObservacion;
                $respuesta->save();
            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Observacion Guardada correctamente.'
            );
    }
      else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
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

    public function show($id,Request $request)
    {   
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view($this->path.'ShowObservation',compact('id'));
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    
    public function observationsList($id)
    {
        $observaciones=Observaciones::from('tbl_observaciones AS O')->List($id);
        return Datatables::of(DB::select($this->getSql($observaciones)))->addIndexColumn()->make(true);
    }

    public function directorList(Request $request)
    {
        $anteproyectos = 
            Anteproyecto::from('TBL_Anteproyecto AS A')->Data()
                ->join('tbl_encargados AS E',function($join)use($request)
                {
                    $join->on(DB::raw('E.FK_TBL_Anteproyecto_id'),'=',DB::raw('A.PK_NPRY_idMinr008'))
                    ->where('NCRD_Cargo','=',"Director")
                    ->where('FK_developer_user_id','=',$request->user()->id);
                });
        
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
   }
    
    public function juryList(Request $request)
    {       
        $anteproyectos = Anteproyecto::from('TBL_Anteproyecto AS A')->distinct()->Data()
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
                ->addSelect(
                    DB::raw('('
                        .$this->getSql(
                            Encargados::join('gesap.tbl_conceptos',function($join)use($request)
                                        {
                                            $join->on('PK_NCRD_idCargo','=','FK_TBL_Encargado_id')
                                            ->where('CNPT_Tipo','=','Anteproyecto')
                                            ->where('FK_developer_user_id','=',$request->user()->id);
                                        })
                                    ->select('CNPT_Concepto')
                                    ->where('gesap.tbl_encargados.FK_TBL_Anteproyecto_id','=',DB::raw('A.PK_NPRY_idMinr008'))
                            )
                        .')AS Concepto'
                    )    
                );
        return Datatables::of(DB::select($this->getSql($anteproyectos)))->addIndexColumn()->make(true);
   }

}
