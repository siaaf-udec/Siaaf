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
use App\Container\Acadspace\src\Docentes;
use App\Container\Acadspace\src\Aulas;
use App\Container\Overall\Src\Facades\AjaxResponse;

class DocentesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $aula = new Aulas();
        $nombre = $aula->SAL_nombre_sala . +$aula->SAL_nombre_sala;
        $aulas = $aula->pluck('SAL_nombre_sala', 'PK_SAL_id_sala');
        return view('acadspace.controlDocente', ['aulas' => $aulas->toArray()]);

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function regisAsistenciaDoc(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $model = new Docentes();

            $model->FK_DOC_id_docente = $request['FK_DOC_id_docente'];
            $model->DOC_num_est = $request['SOL_cant_estudiantes'];
            $model->DOC_sala = $request['DOC_sala'];
            $model->DOC_tipo_practica = $request['DOC_tipo_practica'];

            $model->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Asistencia registrada correctamente.'
            );

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


}