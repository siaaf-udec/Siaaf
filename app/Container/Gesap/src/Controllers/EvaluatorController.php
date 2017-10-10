<?php

namespace App\Container\gesap\src\Controllers;

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
use App\Container\gesap\src\CheckObservaciones;
use App\Container\gesap\src\Respuesta;
use App\Container\gesap\src\Conceptos;
use App\Container\Users\Src\User;

class EvaluatorController extends Controller
{
            
    private $path='gesap.Evaluador.';
    
    
    /*
     * Listado de proyectos asignados como jurado
     *
     * @return \Illuminate\Http\Response
     */
    public function jury()
    {
        return view($this->path.'JuradoList');
    }
    
    /*
     * Función de almacenamiento en la base de datos de observaciones de proyectos
     *
     * @param  \Illuminate\Http\Request 
     * 
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeObservations(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $jurado = Encargados::select('PK_NCRD_idCargo')
                        ->where('FK_TBL_Anteproyecto_id', '=', $request->get('proyecto'))
                        ->where('FK_developer_user_id', '=', $request->get('user'))
                        ->where(function ($query) {
                            $query->where('NCRD_Cargo', '=', 'Jurado 1')  ;
                            $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                        })
                        ->firstOrFail();
            
            $observacion= new Observaciones();
            $observacion->BVCS_Observacion=$request->get('observacion');
            $observacion->FK_TBL_Encargado_id=$jurado->PK_NCRD_idCargo;
            $observacion->save();
            
            $checkobservacion= new CheckObservaciones();
            $checkobservacion->FK_TBL_Observaciones_id=$observacion->PK_BVCS_idObservacion;
            $checkobservacion->save();
          
            if ($request->get('Min')=="Vacio" || $request->get('Requerimientos')=="Vacio") {
                $respuesta=new Respuesta();
                if ($request->get('Min')=="Vacio") {
                    $respuesta->RPST_RMin="NO FILE";
                } else {
                    $respuesta->RPST_RMin=$request['Min']->getClientOriginalName();
                }
                if ($request->get('Requerimientos')!="Vacio") {
                    $respuesta->RPST_Requerimientos=$request['Requerimientos']->getClientOriginalName();
                } else {
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
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Función de almacenamiento o actualizacion en la base de datos de conceptos
     *
     * @param  \Illuminate\Http\Request 
     * 
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function storeConcepts(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {//Busco el ID del Encargado(Usuario respecto al proyecto)
            $jurado = Encargados::select('PK_NCRD_idCargo', 'NCRD_Cargo')
                ->where('FK_TBL_Anteproyecto_id', '=', $request->get('proyecto'))
                ->where('FK_developer_user_id', '=', $request->user()->id)
                ->where(function ($query) {
                    $query->where('NCRD_Cargo', '=', 'Jurado 1')  ;
                    $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                })
                ->firstOrFail();
            
            if ($jurado->NCRD_Cargo=="Jurado 1") {
                $other="Jurado 2";
            } else {
                $other="Jurado 1";
            }
            $jurado2=Encargados::select('PK_NCRD_idCargo', 'NCRD_Cargo')
                ->where('FK_TBL_Anteproyecto_id', '=', $request->get('proyecto'))
                ->where('NCRD_Cargo', '=', $other)
                ->firstOrFail();
             
            //Consulto si los jurados ya ha realizado un concepto anteriormente
            $encargado=Conceptos::select('PK_CNPT_Conceptos', 'CNPT_Concepto')
                ->where('FK_TBL_Encargado_id', '=', $jurado->PK_NCRD_idCargo)
                ->where('CNPT_Tipo', '=', 'Anteproyecto')
                ->first();
            
            $encargado2=Conceptos::select('PK_CNPT_Conceptos', 'CNPT_Concepto')
                ->where('FK_TBL_Encargado_id', '=', $jurado2->PK_NCRD_idCargo)
                ->where('CNPT_Tipo', '=', 'Anteproyecto')
                ->first();
             
            $anteproyecto = Anteproyecto::findOrFail($request->get('proyecto'));
            
            if ($encargado==null) {//Averiguo si se encontro un concepto previo
                //si no lo hay se crea el concepto nuevo de este jurado respecto al proyecto
                Conceptos::create([
                    'CNPT_Concepto'=>$request->get('concepto') ,
                    'CNPT_Tipo'    =>"Anteproyecto",
                    'FK_TBL_Encargado_id'=>$jurado->PK_NCRD_idCargo
                ]);
                if ($encargado2!=null) {
                    if ($request->get('concepto')!=$encargado2->CNPT_Concepto) {
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
            } else {//Si existe ya un concepto se actualiza el mismo
                Conceptos::updateOrCreate([
                    'PK_CNPT_Conceptos'=>$encargado->PK_CNPT_Conceptos,
                    'CNPT_Concepto'=>$request->get('concepto'),
                    'CNPT_Tipo'    =>"Anteproyecto",
                    'FK_TBL_Encargado_id'=>$jurado->PK_NCRD_idCargo
                ]);
                if ($encargado2 != null) {
                    if ($request->get('concepto')!=$encargado2->CNPT_Concepto) {
                        $anteproyecto->NPRY_Estado="PENDIENTE";
                        $anteproyecto->save();
                        return AjaxResponse::success(
                            '¡Registro exitoso!',
                            'Los conceptos no estan deacuerdo.'
                        );
                    } else {
                        if ($request->get('concepto')==1) {
                            $anteproyecto->NPRY_Estado="APROBADO";
                        } else {
                            if ($request->get('concepto')==2) {
                                $anteproyecto->NPRY_Estado="APLAZADO";
                            } else {
                                if ($request->get('concepto')==3) {
                                    $anteproyecto->NPRY_Estado="RECHAZADO";
                                } else {
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
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
    }
    
    /*
     * Listado de proyectos asignados como director
     *
     * @return \Illuminate\Http\Response
     */
    public function director()
    {
        return view($this->path.'DirectorList');
    }
    
    /*
     * Listado de proyectos asignados como director con vista AJAX
     *
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function directorAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'DirectorList-ajax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );   
    }
    
    /*
     * Listado de observaciones de proyecto seleccionado
     * Envia el id del proyecto para realizar la consulta
     *
     * @param  int $id 
     * @param  \Illuminate\Http\Request 
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function show($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'ShowObservation', [
                'id' => $id
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
    * Consulta de observaciones de proyecto especifico
    *
    * @param int $id
    *
    * @return Yajra\DataTables\DataTables
    */ 
    public function observationsList($id)
    {
        $observaciones=Observaciones::from('tbl_observaciones AS O')
                ->with(['encargado' => function ($encargados) use ($id) {
                    $encargados->where('FK_TBL_Anteproyecto_id', '=', $id);
                    $encargados->where(function ($query) {
                            $query->where('NCRD_Cargo', '=', 'Jurado 1')  ;
                            $query->orwhere('NCRD_Cargo', '=', 'Jurado 2');
                });
                },
                    'respuesta'])
                ->get();
        return Datatables::of($observaciones)->addIndexColumn()->make(true);
    }

    /*
    * Consulta de proyectos con sus datos correspondientes asignados al usuario actual como director
    *
    * @param  \Illuminate\Http\Request 
    *
    * @return Yajra\DataTables\DataTables
    */ 
    public function directorList(Request $request)
    {
        $anteproyectos = Anteproyecto::from('TBL_Anteproyecto AS A')->distinct()
            ->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2',
                    'encargados' => function ($encargados) use ($request) {
                        $encargados->where('E.NCRD_Cargo', '=', "Director");
                        $encargados->where('FK_developer_user_id', '=', $request->user()->id);
            }])
            ->get();
        
        return Datatables::of($anteproyectos)->addIndexColumn()->make(true);
    }
    
    /*
    * Consulta de proyectos con sus datos correspondientes asignados al usuario actual como jurado
    *
    * @param  \Illuminate\Http\Request 
    *
    * @return Yajra\DataTables\DataTables
    */
    public function juryList(Request $request)
    {
        $anteproyectos = Anteproyecto::from('TBL_Anteproyecto AS A')->distinct()
            ->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2', 'conceptofinal',
                   'encargados' => function ($encargados) use ($request) {
                        $encargados->where(function ($query) {
                            $query->where('NCRD_Cargo', '=', "Jurado 1")  ;
                            $query->orwhere('NCRD_Cargo', '=', "Jurado 2");
                        });
                        $encargados->where('FK_developer_user_id', '=', $request->user()->id);
            }])
            ->get();
        return Datatables::of($anteproyectos)->addIndexColumn()->make(true);
    }
}
