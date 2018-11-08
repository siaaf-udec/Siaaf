<?php

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Acadspace\src\Hojavida;
use App\Container\Acadspace\src\Marca;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;
use App\Container\Acadspace\src\Articulo;


class HojavidaController extends Controller
{
    /**
     * Funcion para mostrar la vista de incidentes
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $marca = new Marca();
            $Marcas = $marca->pluck('MAR_Nombre', 'PK_MAR_Id_Marca');
            $obtId = Articulo::select('FK_ART_Id_Hojavida')->where('PK_ART_Id_Articulo', $id)->get();
            $finId = $obtId[0]->FK_ART_Id_Hojavida;
            if($finId == NULL ){
                return view('acadspace.Hojavida.formularioHojavida',
                    [
                        'articulo' => $id,
                        'marcas' => $Marcas->toArray()
                    ]);
            }else{
                $hojavida = Hojavida::select('*')
                ->where('PK_HOJ_Id_Hojavida', $finId)
                ->get();
                return view('acadspace.Hojavida.formulariomostrarHojavida',compact('hojavida'));
            }
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
    public function regisHojavida(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $nuevaHoja = new Hojavida();
            $nuevaHoja->HOJ_Modelo_Equipo = $request['HOJ_Modelo_Equipo'];
            $nuevaHoja->HOJ_Procesador = $request['HOJ_Procesador'];
            $nuevaHoja->HOJ_Memoria_Ram = $request['HOJ_Memoria_Ram'];
            $nuevaHoja->HOJ_Disco_Duro = $request['HOJ_Disco_Duro'];
            $nuevaHoja->HOJ_Mouse = $request['HOJ_Mouse'];
            $nuevaHoja->HOJ_Teclado = $request['HOJ_Teclado'];
            $nuevaHoja->HOJ_Sistema_Operativo = $request['HOJ_Sistema_Operativo'];
            $nuevaHoja->HOJ_Antivirus = $request['HOJ_Antivirus'];
            $nuevaHoja->HOJ_Garantia = $request['HOJ_Garantia'];
            $nuevaHoja->FK_HOJ_Id_Marca = $request['FK_HOJ_Id_Marca'];
            $nuevaHoja->save();
            $idArt =Articulo::findOrFail($request['id']);
            $hojVida = Articulo::select('FK_ART_Id_Hojavida')
                        ->where('PK_ART_Id_Articulo','=', $request['id'])
                        ->get();
            $idArt->FK_ART_Id_Hojavida = $nuevaHoja->PK_HOJ_Id_Hojavida;
            $idArt->save();
            return AjaxResponse::success(
                '¡Registro exitoso!',
                'Hoja de vida registrada correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Funcion para mostrar una hoja de vida registrados
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function data(Request $request)
    {
    }


}