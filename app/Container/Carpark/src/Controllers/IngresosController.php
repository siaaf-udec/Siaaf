<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use App\Container\Carpark\src\Usuarios;
use App\Container\Carpark\src\Motos;
use App\Container\Carpark\src\Ingresos;
use App\Container\Carpark\src\Historiales;
use Illuminate\Support\Facades\Storage;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class IngresosController extends Controller
{

    /**
     * Muestra la vista de inicio de la información de motocicletas dentro del parqueadero.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carpark.ingresos.tablaIngresos');
    }

    /**
     * Muestra la vista de inicio de la información de motocicletas dentro del parqueadero medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('carpark.ingresos.ajaxTablaIngresos');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que consulta las motos dentro del parqueadero las envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaMotosDentro(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return Datatables::of(Ingresos::all())
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Muestra el formulario de registro de una nueva entrada o salida.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('carpark.ingresos.registroIngreso');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que que devuelve el formulario para verificar registro de ingresos.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function verificar(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $infoMoto = Motos::where([['CM_Placa', '=', $request['PlacaMoto']], ['FK_CM_CodigoUser', '=', $request['CodigoUsuario']]])->get();

            if ($infoMoto == '[]') {
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud-valores inexistentes.',
                    $IdError
                );
            }

            $idMoto = $infoMoto[0]['PK_CM_IdMoto'];
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos encontrados.',
                $idMoto
            );


        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Presenta el formulario con los datos para confirmar el regitro de un ingreso o salida.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function confirmar(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $infoMoto = Motos::find($id);
            $infoUsuario = Usuarios::find($infoMoto['FK_CM_CodigoUser']);

            return view('carpark.ingresos.confirmacion',
                [
                    'infoMoto' => $infoMoto,
                    'infoUsuario' => $infoUsuario,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Presenta el formulario con los datos para confirmar el regitro de un ingreso o salida por medio de la tarjeta RFID.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function confirmarTarjeta(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            $infoMoto = Motos::find($id);

            if (is_null($infoMoto)) {
                return view('carpark.ingresos.tablaIngresos');
            }

            $infoUsuario = Usuarios::find($infoMoto['FK_CM_CodigoUser']);

            return view('carpark.ingresos.confirmacionTarjeta',
                [
                    'infoMoto' => $infoMoto,
                    'infoUsuario' => $infoUsuario,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos un las acciones del parqueadero.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            ////////////////Validación entrada o salida//////////////////
            $infoIngresos = Ingresos::where([['CI_CodigoUser', '=', $request['CI_CodigoUser']], ['CI_CodigoMoto', '=', $request['CI_CodigoMoto']]])->get();
            if ($infoIngresos == '[]') {
                $generadorID = date_create();
                Ingresos::create([
                    'PK_CI_IdIngreso' => date_timestamp_get($generadorID),
                    'CI_NombresUser' => $request['CI_NombresUser'],
                    'CI_CodigoUser' => $request['CI_CodigoUser'],
                    'CI_Placa' => $request['CI_Placa'],
                    'CI_CodigoMoto' => $request['CI_CodigoMoto']
                ]);

                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Ingreso almacenados correctamente.'
                );
            }

            $generadorID = date_create();
            Historiales::create([
                'PK_CH_IdHistorial' => date_timestamp_get($generadorID),
                'CH_NombresUser' => $request['CI_NombresUser'],
                'CH_CodigoUser' => $request['CI_CodigoUser'],
                'CH_Placa' => $request['CI_Placa'],
                'CH_CodigoMoto' => $request['CI_CodigoMoto'],
                'CH_FHentrada' => $infoIngresos[0]['created_at'],
            ]);

            Ingresos::destroy($infoIngresos[0]['PK_CI_IdIngreso']); // limpia la entrada

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Salida almacenada correctamente.'
            );

            //////////////// FIN Validación entrada o salida//////////////////
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Presenta el formulario con los datos para confirmar el regitro de un ingreso o salida por medio de la tarjeta RFID.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function confirmarTarjetaMasIA(Request $request, $id, $placa)
    {
        if ($request->isMethod('GET')) {
            $infoMoto = Motos::where([['PK_CM_IdMoto', '=', $id], ['CM_Placa', '=', $placa]])->get();

            if ($infoMoto == '[]') {
                return view('carpark.ingresos.tablaIngresos');
            }
            $infoMoto = Motos::find($id);
            $infoUsuario = Usuarios::find($infoMoto['FK_CM_CodigoUser']);

            return view('carpark.ingresos.confirmacionTarjeta',
                [
                    'infoMoto' => $infoMoto,
                    'infoUsuario' => $infoUsuario,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos un las acciones del parqueadero por medio de la tarjeta RFID.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeTarjeta(Request $request)
    {
        if ($request->isMethod('POST')) {
            ////////////////Validación entrada o salida//////////////////
            $infoIngresos = Ingresos::where([['CI_CodigoUser', '=', $request['CI_CodigoUser']], ['CI_CodigoMoto', '=', $request['CI_CodigoMoto']]])->get();
            if ($infoIngresos == '[]') {
                $generadorID = date_create();
                Ingresos::create([
                    'PK_CI_IdIngreso' => date_timestamp_get($generadorID),
                    'CI_NombresUser' => $request['CI_NombresUser'],
                    'CI_CodigoUser' => $request['CI_CodigoUser'],
                    'CI_Placa' => $request['CI_Placa'],
                    'CI_CodigoMoto' => $request['CI_CodigoMoto']
                ]);

                return view('carpark.ingresos.tablaIngresos');
            }

            $generadorID = date_create();
            Historiales::create([
                'PK_CH_IdHistorial' => date_timestamp_get($generadorID),
                'CH_NombresUser' => $request['CI_NombresUser'],
                'CH_CodigoUser' => $request['CI_CodigoUser'],
                'CH_Placa' => $request['CI_Placa'],
                'CH_CodigoMoto' => $request['CI_CodigoMoto'],
                'CH_FHentrada' => $infoIngresos[0]['created_at'],
            ]);

            Ingresos::destroy($infoIngresos[0]['PK_CI_IdIngreso']); // limpia la entrada

            return view('carpark.ingresos.tablaIngresos');

            //////////////// FIN Validación entrada o salida//////////////////
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud, petición errada.'
        );

    }

}
