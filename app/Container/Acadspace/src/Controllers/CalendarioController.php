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
use App\Container\Acadspace\src\calendarioSalones;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\Aulas;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;

class CalendarioController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*  $sala = new Aulas();
          $sala = $sala->pluck('SAL_nombre_sala','SAL_nombre_sala');
          return view('acadspace.gestionhorarios.calendarioaulas', ['sala'=>$sala->toArray()]);*/
        return view('acadspace.gestionhorarios.calendarioaulas');
    }

    /**
     * @param Request $request
     * @param $espacio
     * @return \Illuminate\Http\JsonResponse
     */
    public function cargarSalasCalendario(Request $request, $espacio)
    {
        if ($request->ajax()) {
            $aula = Aulas::where('SAL_nombre_espacio', '=', $espacio)
                ->get();
            return response()->json($aula);
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function cargaEventos(Request $request)
    {
        $sala = $request['sala'];
        $data = array();
        $id = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('PK_CAL_id');
        $titulo = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('CAL_titulo');
        $color = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('CAL_color');
        $fecha_inicial = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('CAL_fecha_ini');
        $fecha_final = calendarioSalones::where('CAL_sala', '=', $sala)->pluck('CAL_fecha_fin');
        $count = count($id);

        for ($i = 0; $i < $count; $i++) {
            $data[$i] = array(
                "title" => $titulo[$i],
                "start" => $fecha_inicial[$i],
                "end" => $fecha_final[$i],
                "backgroundColor" => $color[$i],
                "id" => $id[$i],

            );
        }
        json_encode($data);
        return $data;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titulo = $_POST['title'];
        $fecha_inicio = $_POST['start'];
        // $fecha_fin = date($fecha_inicio, (strtotime ("+2 Hours")));
        $fecha_fin = strtotime('+2 hours', strtotime($fecha_inicio));
        $fecha_final = date('Y-m-d H:i:s', $fecha_fin);
        $color = $_POST['background'];
        $sala = $_POST['salaSeleccionada'];
        $evento = new calendarioSalones();

        $evento->CAL_titulo = $titulo;
        $evento->CAL_fecha_ini = $fecha_inicio;
        $evento->CAL_fecha_fin = $fecha_final;
        $evento->CAL_color = $color;
        $evento->CAL_sala = $sala;


        $evento->save();
    }


    /**
     *
     */
    public function update()
    {

        //Valores recibidos via ajax
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $allDay = $_POST['allday'];
        $back = $_POST['background'];

        $evento = calendarioSalones::find($id);
        if ($end == 'NULL') {
        } else {
            $evento->CAL_fecha_fin = $end;
        }
        $evento->CAL_fecha_ini = $start;
        $evento->CAL_color = $back;
        $evento->CAL_titulo = $title;
        //$evento->fechaFin=$end;

        $evento->save();
    }


    /**
     *
     */
    public function delete()
    {
        $id = $_POST['id'];

        calendarioSalones::destroy($id);
    }

    /**
     * @param Request $request
     * @param $sala
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request, $sala)
    {

        if ($request->ajax() && $request->isMethod('GET')) {
            //unicamente las solicitudes aprobadas y muestra en el datatable
            $solicitud = Solicitud::select('PK_SOL_id_solicitud', 'SOL_id_docente',
                'SOL_nucleo_tematico', 'SOL_cant_estudiantes', 'SOL_id_practica',
                'created_at', 'SOL_carrera', 'SOL_dias', 'SOL_hora_inicio',
                'SOL_hora_fin', 'SOL_guia_practica', 'SOL_software', 'SOL_rango_fechas')
                ->with(['user' => function ($query) {
                    return $query->select('id', 'name', 'lastname');
                }])
                ->where('FK_SOL_id_sala', '=', $sala)
                ->where('SOL_estado', '=', 1)
                ->get();
            return DataTables::of($solicitud)
                ->addColumn('tipo_prac', function ($solicitud) {
                    if ($solicitud->SOL_id_practica == 1) {
                        return "Libre";
                    } elseif ($solicitud->SOL_id_practica == 2) {
                        return "Grupal";
                    }
                })
                ->rawColumns(['tipo_prac'])
                ->addIndexColumn()
                ->make(true);

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );


    }


}