<?php

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Articulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Mantenimiento;
use App\Container\Acadspace\src\TiposMant;
use App\Container\Acadspace\src\Hojavida;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Services\PayUService\Exception;


class MantenimientoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $tipos=new TiposMant();
            $articulo=new Articulo();
            $tiposmante=$tipos->pluck('MAN_Nombre','PK_MAN_Id_Tipo');
            $articulos = $articulo->pluck('ART_Codigo','PK_ART_Id_Articulo')->sort();
            //Muestra vista elementos
            return view('acadspace.Mantenimiento.formularioMantenimiento',
            [
               'tipos'=>$tiposmante->toArray(),
               'articulos'=>$articulos->toArray()
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Funcion registrar marca retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function regisMantenimiento(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $art =new Articulo();
            $articulo = $art::select('FK_ART_Id_Hojavida')
                ->where('PK_ART_Id_Articulo',$request['ART_Codigo'])
                ->sum('FK_ART_Id_Hojavida');
            if($articulo != 0){          
                Mantenimiento::create([
                'MANT_Nombre_Tecnico' => $request['MANT_Nombre_Tecnico'],
                'FK_MANT_Id_Tipo' => $request['FK_MANT_Id_Tipo'],
                'MANT_Descripcion' => $request['MANT_Descripcion'],
                'FK_MANT_Id_Hojavida' => $articulo,
                'MANT_Fecha_Inicio' => Carbon::now()
                ]);
                return AjaxResponse::success(
                    '¡Registro exitoso!',
                    'Mantenimiento registrado correctamente.'
                );

            }else{
                return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'Agregue primero la hoja de vida del articulo que desea registrar el mantenimiento.'
                );  
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
     /**
     * Funcion cargar datatable con marcas registradas
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $tipos = Mantenimiento::select();
            return Datatables::of($tipos)
                ->addColumn('estado',function($tipos) {
                    if ($tipos->MANT_Descripcion_Errores==NULL) {
                        return "<span class='label label-sm label-warning'>" . "Abierto" . "</span>";
                    } else{
                        return "<span class='label label-sm label-success'>" . "Cerrado" . "</span>";
                    }
                })
                ->addColumn('id_articulo',function($tipos){
                    $articulo = Articulo::select('ART_Codigo')->where('FK_ART_Id_Hojavida','=',$tipos->FK_MANT_Id_Hojavida)->get();
                    return $articulo[0]->ART_Codigo;
                })
                ->rawColumns(['estado'])
                ->removeColumn('MANT_Fecha_Fin') 
                ->removeColumn('FK_MANT_Id_Tipo')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
               /**
     * Funcion para eliminar marca entre los registrados
     * retorna mensaje ajax
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function editMantenimiento(Request $request, $id){
        if ($request->ajax() && $request->isMethod('GET')) {
            $findDescri = Mantenimiento::select('*')->where('PK_MANT_Id_Registro',$id)->get();
            if($findDescri[0]->MANT_Descripcion_Errores ==  null && $findDescri[0]->MANT_Descripcion_Errores ==  ''){
                return view('acadspace.Mantenimiento.formularioCerrarMantenimiento',compact('id'));
            }else{
                return view('acadspace.Mantenimiento.formularioVerDiagnostico',compact('findDescri'));
            }
            return AjaxResponse::fail(
                '¡Error!',
                'La peticion no pudo ser procesada.'
            );
        }
    }
           /**
     * Funcion para eliminar marca entre los registrados
     * retorna mensaje ajax
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cerrarMantenimiento(Request $request){
        if ($request->ajax() && $request->isMethod('POST')) {
                $mantenimiento = Mantenimiento::findOrFail($request['MANT_Id']);
                $mantenimiento->MANT_Fecha_Fin = Carbon::now();
                $mantenimiento->MANT_Descripcion_Errores = $request['MANT_Descripcion_Errores'];
                $mantenimiento->save();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Diagnostico tecnico generado correctamente.'
                );

            }
            return AjaxResponse::fail(
                '¡Error!',
                'No se logro cerrar el Mantenimiento.'
            );
        }
       /**
     * Funcion para eliminar marca entre los registrados
     * retorna mensaje ajax
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id){
        if ($request->ajax() && $request->isMethod('DELETE')) {
                $mantenimiento = Mantenimiento::find($id);
                $mantenimiento->delete();
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Mantenimiento eliminado correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Error!',
                'No se pudo eliminar el mantenimiento.'
            );
        }
}
