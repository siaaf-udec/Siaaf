<?php

namespace App\Container\Adminregist\Src\Controllers;

use App\Container\AdminRegist\Src\Novedad;
use App\Container\AdminRegist\Src\Registros;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Barryvdh\Snappy\Facades\SnappyPdf;

class ReporteController extends Controller
{
    /**
     *Función que redirecciona a la vista del formulario para realizar el reporte por fechas.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFecha()
    {
        return view('adminregist.reportes.reporteFechaIndex');
    }

    /**
     *Función que redirecciona a la vista del formulario para realizar el reporte por novedad.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNovedad()
    {
        return view('adminregist.reportes.reporteNovedadIndex');
    }

    /**
     * Recibe el formato de fecha del data_range_picker
     * y lo cambia por el formato usado en BD
     * @param $fech
     * @return string
     */
    public function changeForm($fech)
    {
        //10-05-2101
        $aaaa = substr($fech, -4);
        $dd = substr($fech, -7, -5);
        $mm = substr($fech, -10, -8);
        return $aaaa . '-' . $mm . '-' . $dd;
    }

    /**
     * Función que redirecciona a la vista del reporte con sus respectivos datos a mostrar.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function reporteFecha(Request $request)
    {
        if ($request->isMethod('POST')) {
            $fecha = $request['date_range'];
            $f2 = substr($fecha, -10);
            $f1 = substr($fecha, -23, -13);

            $fech1 = $this->changeForm($f1);//Cambia el formato de la fecha
            $fech2 = $this->changeForm($f2);

            $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
            $time = date("h:i A");

            $datos = Registros::with('registro', 'novedad')->whereBetween('created_at', [$fech1, $fech2])->get();
            return view('adminregist.reportes.reporteFecha',
                compact('datos', 'date', 'time', 'fech1', 'fech2')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que redirecciona a la vista del reporte con sus respectivos datos a mostrar, descargando así el reporte por fechas.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function descargarReporteFecha(Request $request, $fech1, $fech2)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
                $time = date("h:i A");
                $datos = Registros::with('registro', 'novedad')->whereBetween('created_at', [$fech1, $fech2])->get();
                return SnappyPdf::loadView('adminregist.reportes.reporteFecha',
                    compact('datos', 'date', 'time', 'fech1', 'fech2'))->download('ReporteFecha.pdf');
            } catch (Exception $e) {
                return view('adminregist.reportes.reporteFecha',
                    compact('datos', 'date', 'time', 'fech1', 'fech2')
                );
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar su solicitud.'
        );
    }

    /**
     * Función que redirecciona a la vista del reporte por novedad con sus respectivos datos a mostrar.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function reporteNovedad(Request $request)
    {
        if ($request->isMethod('POST')) {

            $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
            $time = date("h:i A");
            $novedad = Novedad::find($request['novedad']);
            $datos = Registros::where('FK_RE_Novedad',$novedad->PK_NOV_IdNovedad)->with('registro', 'novedad')->get();
            return view('adminregist.reportes.reporteNovedad',
                compact('datos', 'date', 'time','novedad')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que redirecciona a la vista del reporte con sus respectivos datos a mostrar, descargando así el reporte por novedad.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function descargarReporteNovedad(Request $request, $novedad)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
                $time = date("h:i A");
                $novedad = Novedad::find($novedad);
                $datos = Registros::where('FK_RE_Novedad',$novedad->PK_NOV_IdNovedad)->with('registro', 'novedad')->get();
                return SnappyPdf::loadView('adminregist.reportes.reporteNovedad',
                    compact('datos', 'date', 'time', 'novedad'))->download('ReporteNovedad.pdf');
            } catch (Exception $e) {
                return view('adminregist.reportes.reporteNovedad',
                    compact('datos', 'date', 'time', 'novedad')
                );
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar su solicitud.'
        );
    }

    /**
     * Función que redirecciona a la vista del reporte general con sus respectivos datos a mostrar.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function reporteGeneral(Request $request)
    {
        if ($request->isMethod('GET')) {

            $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
            $time = date("h:i A");
            $datos = Registros::with('registro', 'novedad')->get();
            return view('adminregist.reportes.reporteGeneral',
                compact('datos', 'date', 'time')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que redirecciona a la vista del reporte con sus respectivos datos a mostrar, descargando así el reporte general de ingreso.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function descargarReporteGeneral(Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
                $time = date("h:i A");
                $datos = Registros::with('registro', 'novedad')->get();
                return SnappyPdf::loadView('adminregist.reportes.reporteGeneral',
                    compact('datos', 'date', 'time'))->download('ReporteGeneral.pdf');
            } catch (Exception $e) {
                return view('adminregist.reportes.reporteGeneral',
                    compact('datos', 'date', 'time')
                );
            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar su solicitud.'
        );
    }

    /**
     *Función que redirecciona a la vista de los graficos los cuales se muestran por novedad, fecha, tipo de usuario y por sedes.
     *
     * @return \Illuminate\Http\Response
     */
    public function charIndex()
    {
        $novedades = Novedad::all();
        $registros = Registros::with('registro')->get();
        //foreach que se encarga de guardar el registro de la sede traida de la base de datos y contar cuantas veces se repite cada sede
        $daPlace = array();
        foreach ($registros as $cont)
        {
            $daPlace[] = $cont->registro->place;
        }
        //contar el numero de veces que se encuentra repetida la sede
        $place = array_count_values($daPlace);

        //foreach que se encarga de guardar el registro de los tipos de usuario de la base de datos y contar cuantas veces se repite cada tipo de usuario
        $daTypeUser = array();
        foreach ($registros as $cont)
        {
            $daTypeUser[] = $cont->registro->type_user;
        }
        //contar el numero de veces que se encuentra repetido el tipo de usuario
        $typeUser = array_count_values($daTypeUser);

        //foreach que se encarga de guardar el registro de la fecha de ingreso de los usuarios de la base de datos y contar cuantas veces se repite cada fecha del registro
        $daFecha = array();
        foreach ($registros as $cont)
        {
            $daFecha[] = $cont->created_at->format('Y-m-d');
        }
        //contar el numero de veces que se encuentra repetida la fecha de ingreso
        $date = array_count_values($daFecha);

        return view('adminregist.reportes.charts',compact('novedades','typeUser','place', 'date'));
    }

}