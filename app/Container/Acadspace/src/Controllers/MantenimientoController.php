<?php

namespace App\Container\Acadspace\src\Controllers;

use App\Container\Acadspace\src\Articulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Mantenimiento;
use App\Container\Acadspace\src\TiposMant;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class MantenimientoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $tipos=new TiposMant();
            $tiposmante=$tipos->pluck('MAN_Nombre','PK_MAN_Id_Tipo');
            //Muestra vista elementos
            return view('acadspace.Mantenimiento.formularioMantenimiento',
            [
               'tipos'=>$tiposmante->toArray()
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

            Mantenimiento::create([
                'MANT_Nombre_Tecnico' => $request['MANT_Nombre_Tecnico'],
                'FK_MANT_Id_Tipo' => $request['FK_MANT_Id_Tipo'],
                'MANT_Descripcion' => $request['MANT_Descripcion'],
                'FK_MANT_Id_Hojavida' => '1',
                'MANT_Fecha_Inicio' => Carbon::now()
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Mantenimiento registrado correctamente.'
            );
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
                ->removeColumn('MANT_Fecha_Fin')    
                ->removeColumn('MANT_Descripcion_Errores')
                ->removeColumn('FK_MANT_Id_Hojavida')
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
                    'Marca eliminada correctamente.'
                );
            }
            return AjaxResponse::fail(
                '¡Error!',
                'Primero debe eliminar los elementos asociados a la marca.'
            );
        }
}
