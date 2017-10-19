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
use App\Container\Acadspace\src\Calendario;
use App\Container\Acadspace\src\Solicitud;
use App\Container\Acadspace\src\Aulas;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;

class CalendarioController extends Controller
{


    /**
     * Funcion mostrar vista de gestion aulas - calendario
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('acadspace.gestionhorarios.calendarioaulas');
    }

    /**
     * Funcion para cargar un select en la vista de acuerdo a la informacion
     * recibida de otro select que viene en $espacio
     * @param \Illuminate\Http\Request $request
     * @param varchar $espacio
     * @return \Illuminate\Http\JsonResponse
     */
    public function cargarSalasCalendario(Request $request, $espacio)
    {
        if ($request->ajax()) {
            $aula = Aulas::where('SAL_Nombre_Espacio', '=', $espacio)
                ->get();
            return response()->json($aula);
        }
    }

    /**
     * Retorno un arreglo tipo JSON con todos los eventos actuales en
     * el calendario de acuerdo a la sala seleccionada
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cargaEventos(Request $request)
    {
        $sala = $request['sala'];
        $data = array();
        $id = Calendario::where('CAL_Sala', '=', $sala)->pluck('PK_CAL_id');
        $titulo = Calendario::where('CAL_Sala', '=', $sala)->pluck('CAL_Titulo');
        $color = Calendario::where('CAL_Sala', '=', $sala)->pluck('CAL_Color');
        $fecha_inicial = Calendario::where('CAL_Sala', '=', $sala)->pluck('CAL_Fecha_Ini');
        $fecha_final = Calendario::where('CAL_Sala', '=', $sala)->pluck('CAL_Fecha_Fin');
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
     *Funcion para crear evento en el calendario
     * no retorna nada, la validacion de que se creo
     * se hace en el formulario
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
        $evento = new Calendario();

        $evento->CAL_Titulo = $titulo;
        $evento->CAL_Fecha_Ini = $fecha_inicio;
        $evento->CAL_Fecha_Fin = $fecha_final;
        $evento->CAL_Color = $color;
        $evento->CAL_Sala = $sala;


        $evento->save();
    }


    /**
     *Funcion para actualizar evento en el calendario
     * no retorna nada, la validacion de que se actualizo
     * se hace en el formulario
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

        $evento = Calendario::find($id);
        if (empty($end)) {
        } else {
            $evento->CAL_Fecha_Fin = $end;
        }
        $evento->CAL_Fecha_Ini = $start;
        $evento->CAL_Color = $back;
        $evento->CAL_Titulo = $title;

        $evento->save();
    }


    /**
     *Funcion para eliminar un evento del calendario
     */
    public function delete()
    {
        $id = $_POST['id'];

        Calendario::destroy($id);
    }

    /**
     * Funcion que carga el datatable con solicitudes aprobadas de acuerdo
     * a la sala seleccionada
     * @param \Illuminate\Http\Request $request
     * @param id $sala
     * @return \Illuminate\Http\Response | \Yajra\DataTables\DataTables
     */
    public function data(Request $request, $sala)
    {

        if ($request->ajax() && $request->isMethod('GET')) {
            //unicamente las solicitudes aprobadas y muestra en el datatable
            $solicitud = Solicitud::select('PK_SOL_id_solicitud', 'FK_SOL_Id_Docente',
                'SOL_Nucleo_Tematico', 'SOL_Cant_Estudiantes', 'SOL_Id_Practica',
                'created_at', 'SOL_Carrera', 'SOL_Dias', 'SOL_Hora_Inicio',
                'SOL_Hora_Fin', 'SOL_Guia_Practica', 'SOL_Software', 'SOL_Rango_Fechas',
                'SOL_fecha_inicial')
                ->with(['user' => function ($query) {
                    return $query->select('id', 'name', 'lastname');
                }])
                ->where('FK_SOL_Id_Sala', '=', $sala)
                ->where('SOL_Estado', '=', 1)
                ->get();
            return DataTables::of($solicitud)
                ->addColumn('tipo_prac', function ($solicitud) {
                    if ($solicitud->SOL_Id_Practica == 1) {
                        return "Libre";
                    } elseif ($solicitud->SOL_Id_Practica == 2) {
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