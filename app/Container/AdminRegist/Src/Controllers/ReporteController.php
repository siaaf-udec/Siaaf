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
    public function indexFecha()
    {
        return view('adminregist.reportes.reporteFechaIndex');
    }

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

    public function reportFecha(Request $request)
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

    public function reportNovedad(Request $request)
    {
        if ($request->isMethod('POST')) {

            $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
            $time = date("h:i A");
            $novedad = Novedad::find($request['novedad']);
            $datos = Registros::where('id_novedad',$novedad->id)->with('registro', 'novedad')->get();
            return view('adminregist.reportes.reporteNovedad',
                compact('datos', 'date', 'time','novedad')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    public function descargarReporteNovedad(Request $request, $novedad)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");//Fecha actual para adjuntar en el reporte
                $time = date("h:i A");
                $novedad = Novedad::find($novedad);
                $datos = Registros::where('id_novedad',$novedad->id)->with('registro', 'novedad')->get();
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

    public function charIndex()
    {
        $novedades = Novedad::all();
        $registros = Registros::with('registro')->get();
        $daPlace = array();
        foreach ($registros as $cont)
        {
            $daPlace[] = $cont->registro->place;
        }
        $place = array_count_values($daPlace);

        $daTypeUser = array();
        foreach ($registros as $cont)
        {
            $daTypeUser[] = $cont->registro->type_user;
        }
        $typeUser = array_count_values($daTypeUser);

        return view('adminregist.reportes.charts',compact('novedades','typeUser','place'));
    }

}