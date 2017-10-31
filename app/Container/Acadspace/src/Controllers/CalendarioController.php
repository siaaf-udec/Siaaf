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
use App\Container\Acadspace\src\Espacios;
use App\Container\Acadspace\src\Aulas;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Yajra\DataTables\DataTables;


class CalendarioController extends Controller
{
    /**
     * Funcion mostrar vista de gestion aulas - calendario
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $espa = new espacios();
            $espacios = $espa->pluck('ESP_Nombre_Espacio', 'PK_ESP_Id_Espacio');
            return view('acadspace.GestionHorarios.calendarioAulas',
                [
                    'espacios' => $espacios->toArray()
                ]);
        }
    }

    /**
     * Funcion para cargar un select en la vista de acuerdo a la informacion
     * recibida de otro select que viene en $espacio
     * @param Request $request
     * @param $espacio
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cargarSalasCalendario(Request $request, $espacio)
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

    /**
     * Retorno un arreglo tipo JSON con todos los eventos actuales en
     * el calendario de acuerdo a la sala seleccionada
     * @param Request $request
     * @return array | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function cargaEventos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $sala = $request['sala'];
            $data = array();
            $id = Calendario::where('FK_CAL_Id_Sala', '=', $sala)->pluck('PK_CAL_id');
            $titulo = Calendario::where('FK_CAL_Id_Sala', '=', $sala)->pluck('CAL_Titulo');
            $color = Calendario::where('FK_CAL_Id_Sala', '=', $sala)->pluck('CAL_Color');
            $fecha_inicial = Calendario::where('FK_CAL_Id_Sala', '=', $sala)->pluck('CAL_Fecha_Ini');
            $fecha_final = Calendario::where('FK_CAL_Id_Sala', '=', $sala)->pluck('CAL_Fecha_Fin');
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
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * Funcion para crear evento en el calendario
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $fecha_fin = strtotime('+2 hours', strtotime($request['start']));
            $fecha_final = date('Y-m-d H:i:s', $fecha_fin);

            $evento = new Calendario();

            $evento->CAL_Titulo = $request['title'];
            $evento->CAL_Fecha_Ini = $request['start'];
            $evento->CAL_Fecha_Fin = $fecha_final;
            $evento->CAL_Color = $request['background'];
            $evento->FK_CAL_Id_Sala = $request['salaSeleccionada'];
            $evento->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Evento registrado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * Funcion para editar evento en el calendario
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            //Valores recibidos via ajax
            $id = $request['id'];
            $title = $request['title'];
            $start = $request['start'];
            $end = $request['end'];
            $allDay = $request['allday'];
            $back = $request['background'];
            $evento = Calendario::find($id);
            if (empty($end)) {
            } else {
                $evento->CAL_Fecha_Fin = $end;
            }
            $evento->CAL_Fecha_Ini = $start;
            $evento->CAL_Color = $back;
            $evento->CAL_Titulo = $title;

            $evento->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Evento actualizado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * Funcion para eliminar evento en el calendario
     * @param Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function delete(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $id = $request['id'];
            Calendario::destroy($id);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Evento eliminado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Funcion que carga el datatable con solicitudes aprobadas de acuerdo
     * a la sala seleccionada
     * @param Request $request
     * @param $sala
     * @return \App\Container\Overall\Src\Facades\AjaxResponse | \Yajra\DataTables\
     */
    public function data(Request $request, $sala)
    {

        if ($request->ajax() && $request->isMethod('GET')) {
            //unicamente las solicitudes aprobadas y muestra en el datatable
            $solicitud = Solicitud::select('PK_SOL_id_solicitud', 'FK_SOL_Id_Docente',
                'SOL_Nucleo_Tematico', 'SOL_Cant_Estudiantes', 'SOL_Id_Practica',
                'created_at', 'SOL_Carrera', 'SOL_Dias', 'SOL_Hora_Inicio',
                'SOL_Hora_Fin', 'SOL_Guia_Practica', 'FK_SOL_Id_Software', 'SOL_Rango_Fechas',
                'SOL_fecha_inicial')
                ->with(['user' => function ($query) {
                    return $query->select('id', 'name', 'lastname');
                }])
                ->with(['software' => function ($query) {
                    return $query->select('PK_SOF_Id',
                        'SOF_Nombre_Soft');
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