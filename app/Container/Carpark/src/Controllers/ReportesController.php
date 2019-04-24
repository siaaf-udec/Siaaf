<?php

namespace App\Container\Carpark\src\Controllers;

use App\Container\Users\src\UsersUdec;
use Illuminate\Http\Request;
use Exception;
use App\Container\Carpark\src\Dependencias;
use App\Container\Carpark\src\Estados;
use App\Container\Carpark\src\Usuarios;
use App\Container\Carpark\src\Motos;
use App\Container\Carpark\src\Ingresos;
use App\Container\Carpark\src\Historiales;
use Barryvdh\Snappy\Facades\SnappyPdf;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Barryvdh\DomPDF\Facade as PDF;


class ReportesController extends Controller
{

    /**
     * Permite generar el reporte correspondiente al las dependencias registradas.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteDependencia(Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoDependencias = Dependencias::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
            $total = count($infoDependencias);
            $cont = 1;
            return view('carpark.reportes.reporteDependencias',
                compact('infoDependencias', 'date', 'time', 'total', 'cont'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el reporte correspondiente al las dependencias registradas.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarReporteDependencia(Request $request)
    {
        if ($request->isMethod('GET')) {
            try {

                $date = date("d/m/Y");
                $time = date("h:i A");
                $infoDependencias = Dependencias::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
                $total = count($infoDependencias);
                $cont = 1;
                return SnappyPdf::loadView('carpark.reportes.reporteDependencias',
                    compact('infoDependencias', 'date', 'time', 'total', 'cont')
                )->download('ReporteDependencias.pdf');

            } catch (Exception $e) {

                return view('carpark.reportes.reporteDependencias',
                    compact('infoDependencias', 'date', 'time', 'total', 'cont'));

            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteUsuariosRegistrados(Request $request)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoUsuarios = Usuarios::all();
            return view('carpark.reportes.reporteUsuariosRegistrados',
                compact('infoUsuarios', 'date', 'time', 'cont'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Permite descargar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarreporteUsuariosRegistrados(Request $request)
    {
        if ($request->isMethod('GET')) {
        
        try {
                $cont = 1;
                $date = date("d/m/Y");
                $time = date("h:i A");
                $infoUsuarios = Usuarios::all();
               return PDF::loadView('carpark.reportes.reporteUsuariosRegistrados', 
                    compact('infoUsuarios', 'date', 'time', 'cont'))->download('ReporteUsuariosRegistrados.pdf'); 


        
         } catch (Exception $e) {

                return view('carpark.reportes.reporteMotosRegistradas',
                    compact('infoMotos', 'date', 'time', 'cont'));

            }
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

}
    /**
     * Permite generar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteMotosRegistradas(Request $request)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoMotos = Motos::all();
            foreach ($infoMotos as $infoMoto) {
                $Usuarios = UsersUdec::where('number_document', $infoMoto->FK_CM_CodigoUser)->first();

                $infoMoto->offsetSet('Nombre', $Usuarios ['username']);
                $infoMoto->offsetSet('Apellido', $Usuarios ['lastname']);

            }
            return view('carpark.reportes.reporteMotosRegistradas',
                compact('infoMotos', 'date', 'time', 'cont'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el reporte correspondiente a los usuarios registrados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarreporteMotosRegistradas(Request $request)
    {
        if ($request->isMethod('GET')) {
            try {

                $cont = 1;
                $date = date("d/m/Y");
                $time = date("h:i A");
                $infoMotos = Motos::all();
                foreach ($infoMotos as $infoMoto) {
                    $Usuarios = UsersUdec::where('code', $infoMoto->FK_CM_CodigoUser)->first();;

                    $infoMoto->offsetSet('Nombre', $Usuarios['username']);
                    $infoMoto->offsetSet('Apellido', $Usuarios['lastname']);

                }
                return PDF::loadView('carpark.reportes.reporteMotosRegistradas',
                    compact('infoMotos', 'date', 'time', 'cont'))->download('ReporteMotosRegistradas.pdf');

            } catch (Exception $e) {

                return view('carpark.reportes.reporteMotosRegistradas',
                    compact('infoMotos', 'date', 'time', 'cont'));

            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a las motos que se encuentran en la universidad.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteMotosDentro(Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoIngresos = Ingresos::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
            $total = count($infoIngresos);
            $cont = 1;
            return view('carpark.reportes.reporteMotosDentro',
                compact('infoIngresos', 'date', 'time', 'total', 'cont')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el reporte correspondiente a las motos que se encuentran en la universidad.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarReporteMotosDentro(Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");
                $time = date("h:i A");
                $infoIngresos = Ingresos::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
                $total = count($infoIngresos);
                $cont = 1;
                return SnappyPdf::loadView('carpark.reportes.reporteMotosDentro',
                    compact('infoIngresos', 'date', 'time', 'total', 'cont')
                )->download('ReporteMotosDentro.pdf');
            } catch (Exception $e) {
                return view('carpark.reportes.reporteMotosDentro',
                    compact('infoIngresos', 'date', 'time', 'total', 'cont'));
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a las motos que se encuentran en la universidad.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteHistorico(Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoHistoriales = Historiales::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
            $total = count($infoHistoriales);
            $cont = 1;
            return view('carpark.reportes.reporteHistorico',
                compact('infoHistoriales', 'date', 'time', 'total', 'cont')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el reporte correspondiente a las motos que se encuentran en la universidad.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarReporteHistorico(Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");
                $time = date("h:i A");
                $infoHistoriales = Historiales::all();//->orderBy('PK_CD_IdDependencia','asc')->get();
                $total = count($infoHistoriales);
                $cont = 1;
                return SnappyPdf::loadView('carpark.reportes.reporteHistorico',
                    compact('infoHistoriales', 'date', 'time', 'total', 'cont')
                )->download('ReporteHistorico.pdf');
            } catch (Exception $e) {
                return view('carpark.reportes.reporteHistorico',
                    compact('infoHistoriales', 'date', 'time', 'total', 'cont')
                );
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function filtradoFecha(Request $request)
    {
        if ($request->isMethod('POST')) {
            $fechas = $request['FechasLimite'];
            $limites = explode(" ", $fechas);
            $limMin = date('Y-m-d 00:00:00', strtotime($limites[0]));
            $limMax = date('Y-m-d 23:59:59', strtotime($limites[2]));
            $FechaMinDescarga = date('Y-m-d', strtotime($limites[0]));
            $FechaMaxDescarga = date('Y-m-d', strtotime($limites[2]));
            $infoHistoriales = Historiales::whereBetween('CH_FHsalida', [$limMin, $limMax])->get();
            $total = count($infoHistoriales);

            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");

            return view('carpark.reportes.reportePorFecha', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'FechaMinDescarga', 'FechaMaxDescarga'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el reporte correspondiente a las historiales filtrados por fecha.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $limMinGET
     * @param  string $limMaxGET
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarFiltradoFecha(Request $request, $limMinGET, $limMaxGET)
    {
        if ($request->isMethod('GET')) {
            try {
                $limMin = date('Y-m-d 00:00:00', strtotime($limMinGET));
                $limMax = date('Y-m-d 23:59:59', strtotime($limMaxGET));
                $FechaMinDescarga = $limMin;
                $FechaMaxDescarga = $limMax;
                $infoHistoriales = Historiales::whereBetween('CH_FHsalida', [$limMin, $limMax])->get();
                $total = count($infoHistoriales);

                $cont = 1;
                $date = date("d/m/Y");
                $time = date("h:i A");

                return SnappyPdf::loadView('carpark.reportes.reportePorFecha', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'FechaMinDescarga', 'FechaMaxDescarga'))->download('ReportePorFechas.pdf');
            } catch (Exception $e) {
                return view('carpark.reportes.reportePorFecha', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'FechaMinDescarga', 'FechaMaxDescarga'));
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function filtradoCodigo(Request $request)
    {
        if ($request->isMethod('POST')) {
            $codigo = $request['CodigoUsuario'];

            $infoHistoriales = Historiales::where('CH_CodigoUser', $codigo)->get();
            $total = count($infoHistoriales);

            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");

            return view('carpark.reportes.reporteFiltradoCodigo', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'codigo'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarFiltradoCodigo(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            try {
                $codigo = $id;

                $infoHistoriales = Historiales::where('CH_CodigoUser', $codigo)->get();
                $total = count($infoHistoriales);

                $cont = 1;
                $date = date("d/m/Y");
                $time = date("h:i A");

                return SnappyPdf::loadView('carpark.reportes.reporteFiltradoCodigo', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'codigo'))->download('ReportePorCódigo.pdf');
            } catch (Exception $e) {
                return view('carpark.reportes.reporteFiltradoCodigo', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'codigo'));
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Permite generar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function filtradoPlaca(Request $request)
    {
        if ($request->isMethod('POST')) {
            $placa = strtoupper($request['PlacaVehiculo']);

            $infoHistoriales = Historiales::where('CH_Placa', $placa)->get();
            $total = count($infoHistoriales);

            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");

            return view('carpark.reportes.reporteFiltradoPlaca', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'placa'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el reporte correspondiente a las historiales filtrados por codigo.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $id
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarFiltradoPlaca(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            try {
                $placa = strtoupper($id);

                $infoHistoriales = Historiales::where('CH_Placa', $placa)->get();
                $total = count($infoHistoriales);

                $cont = 1;
                $date = date("d/m/Y");
                $time = date("h:i A");

                return SnappyPdf::loadView('carpark.reportes.reporteFiltradoPlaca', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'placa'))->download('ReportePorPlaca.pdf');
            } catch (Exception $e) {
                return view('carpark.reportes.reporteFiltradoPlaca', compact('infoHistoriales', 'date', 'time', 'cont', 'total', 'placa'));
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a la información de un usuario concretro.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function reporteUsuario(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoUsuarios = UsersUdec::where('number_document', $id)->get();

            $infoHistoriales = Historiales::where('CH_CodigoUser', $id)->get();
            $total = count($infoHistoriales);
            return view('carpark.reportes.reporteUsuario',
                compact('infoUsuarios', 'infoHistoriales', 'date', 'time', 'total', 'cont')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite descargar el reporte correspondiente a la información de un usuario concretro.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarReporteUsuario(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            try {
                $cont = 1;
                $date = date("d/m/Y");
                $time = date("h:i A");
                $infoUsuarios = UsersUdec::where('number_document', $id)->get();

                $infoHistoriales = Historiales::where('CH_CodigoUser', $id)->get();
                $total = count($infoHistoriales);

                return SnappyPdf::loadView('carpark.reportes.ReporteUsuario',
                    compact('infoUsuarios', 'infoHistoriales', 'date', 'time', 'total', 'cont'))->download('ReportePorCódigo.pdf');
            } catch (Exception $e) {
                return view('carpark.reportes.reporteUsuario',
                    compact('infoUsuarios', 'infoHistoriales', 'date', 'time', 'total', 'cont')
                );
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Permite generar el reporte correspondiente a la información de un usuario concretro.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function reporteMoto(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $cont = 1;
            $date = date("d/m/Y");
            $time = date("h:i A");
            $infoMoto = Motos::find($id);

            $infoHistoriales = Historiales::where('CH_Placa', $infoMoto->CM_Placa)->get();

            $total = count($infoHistoriales);
            return view('carpark.reportes.reporteMoto',
                compact('infoMoto', 'infoHistoriales', 'date', 'time', 'total', 'cont')
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Permite descargar el reporte correspondiente a la información de un usuario concretro.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function descargarReporteMoto(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            try {
                $cont = 1;
                $date = date("d/m/Y");
                $time = date("h:i A");
                $infoMoto = Motos::find($id);
                $infoUsuario = UsersUdec::find($infoMoto['FK_CM_CodigoUser']);

                $infoMoto->offsetSet('Nombre', $infoUsuario->username);
                $infoMoto->offsetSet('Apellido', $infoUsuario->lastname);

                $infoHistoriales = Historiales::where('CH_Placa', $infoMoto->CM_Placa)->get();

                $total = count($infoHistoriales);
                return SnappyPdf::loadView('carpark.reportes.reporteMoto',
                    compact('infoMoto', 'infoHistoriales', 'date', 'time', 'total', 'cont')
                )->download('ReporteMoto.pdf');
            } catch (Exception $e) {
                return view('carpark.reportes.ReporteMoto',
                    compact('infoMoto', 'infoHistoriales', 'date', 'time', 'total', 'cont')
                );
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

}

