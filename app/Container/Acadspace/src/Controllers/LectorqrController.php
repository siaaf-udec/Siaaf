<?php

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Acadspace\src\Asistencia;
use App\Container\Acadspace\src\Aulas;
use App\Container\Acadspace\src\Espacios;


class LectorqrController extends Controller
{
    /**
     * Funcion para mostrar la vista lectorqr
     * @param Request $request
     * @return \Illuminate\View\View | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function index(Request $request)
    {

        if ($request->isMethod('GET')) {
            $espa = new espacios();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
                return view('acadspace.LectorQr.lectorqr',[
                    'espacios' => $espacios->toArray()
                ]);
            }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /**
     * Recibe el parametro espacio y retorna aulas
     * @param \Illuminate\Http\Request $request
     * @param varchar $espacio
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */

    public function cargarSalas(Request $request, $espacio)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $aula = Aulas::where('FK_SAL_Id_Espacio', '=', $espacio)
                ->get();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos recibidos correctamente.', $aula
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


}