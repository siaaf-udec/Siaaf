<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Incidentes;
use App\Container\Acadspace\src\Espacios;
use App\Container\Acadspace\src\Articulo;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class IncidentesController extends Controller
{
    /**
     * Funcion para mostrar la vista de incidentes
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
            $espa = new espacios();
            $articulo = new Articulo();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
            $articulos = $articulo->pluck('ART_Codigo','PK_ART_Id_Articulo');
            return view('acadspace.Incidentes.formularioIncidente',
                [
                    'espacios' => $espacios->toArray(),
                    'articulos' => $articulos->toArray()

                ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion registrar incidente retorna un mensaje Ajax
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function regisIncidente(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            Incidentes::create([
                'FK_INC_Id_User' => $request['FK_INC_Id_User'],
                'FK_INC_Id_Espacio' => $request['INC_Nombre_Espacio'],
                'FK_INC_Id_Articulo' => $request['FK_INC_Id_Articulo'],
                'INC_Descripcion' => $request['INC_Descripcion']
            ]);

            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Incidente registrado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Funcion cargar datatable con incidentes registrados
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $incidentes = Incidentes::select()
                ->with(['espacio' => function ($query) {
                    return $query->select('PK_ESP_Id_Espacio',
                        'ESP_Nombre_Espacio');
                }])
                ->with(['articulo' => function ($query) {
                    return $query->select('PK_ART_Id_Articulo',
                        'ART_Codigo');
                }])
                ->get();
            return Datatables::of($incidentes)
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }
    /*funcion para buscar un tipo y pasarle la información
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function editIncidente(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $espa = new espacios();
            $articulo = new Articulo();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
            $articulos = $articulo->pluck('ART_Codigo','PK_ART_Id_Articulo');
            $obtIncidentes = Incidentes::findOrFail($id);
            return view('acadspace.Incidentes.formularioEditarIncidente',compact('obtIncidentes'),[
                'espacios' => $espacios->toArray(),
                'articulos' => $articulos->toArray()
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /*funcion para modificar una categoria 
    *@param int id
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse 
    */
    public function modificarIncidente(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $Incidente = Incidentes::findOrFail($id);
            $Incidente->FK_INC_Id_User = $request->FK_INC_Id_User;
            $Incidente->FK_INC_Id_Espacio = $request->FK_INC_Id_Espacio;
            $Incidente->FK_INC_Id_Articulo = $request->FK_INC_Id_Articulo;
            $Incidente->INC_Descripcion = $request->INC_Descripcion;
            $Incidente->save();
            return AjaxResponse::success('¡Bien hecho!', 'Datos modificados correctamente.');
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Funcion eliminar incidentes registrados
     * @param Request $request
     * @param $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $aulas = Incidentes::find($id);
            $aulas->delete();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Incidente eliminado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

}