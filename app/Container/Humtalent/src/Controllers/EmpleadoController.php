<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Humtalent\src\Controllers;

use App\Container\Humtalent\src\Asistent;
use App\Container\Humtalent\src\Induction;
use App\Container\Humtalent\src\Mail\EmailTalentoHumano;
use File;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Permission;
use App\Container\Humtalent\src\StatusOfDocument;
use App\Container\Humtalent\src\Notification;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Validator;


class EmpleadoController extends Controller
{

    /**
     * Muestra todos los empleados registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('humtalent.empleado.tablasEmpleados');
    }

    /**
     * Función que consulta los empleados registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaEmpleados(Request $request){

        if ($request->ajax() && $request->isMethod('GET')) {
            $empleados = Persona::all();
            return Datatables::of($empleados)
                    ->removeColumn('PRSN_Direccion')
                    ->removeColumn('PRSN_Ciudad')
                    ->removeColumn('PRSN_Eps')
                    ->removeColumn('PRSN_Fpensiones')
                    ->removeColumn('PRSN_Caja_Compensacion')
                    ->removeColumn('PRSN_Estado_Persona')
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
     * Función que consulta los empleados retirados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function empleadosRetirados(Request $request){

        if ($request->ajax() && $request->isMethod('GET')) {
            $empleados = Persona::where('PRSN_Estado_Persona', 'Retirado')->get();
            return Datatables::of($empleados)
                ->removeColumn('PRSN_Direccion')
                ->removeColumn('PRSN_Ciudad')
                ->removeColumn('PRSN_Eps')
                ->removeColumn('PRSN_Fpensiones')
                ->removeColumn('PRSN_Caja_Compensacion')
                ->removeColumn('PRSN_Telefono')
                ->removeColumn('PRSN_Salario')
                ->removeColumn('PRSN_Area')
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
     * Función que consulta los empleados que tienen la documentación completa y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function listaEmpleadosDocumentosCompletos(Request $request){

        if ($request->ajax() && $request->isMethod('GET')) {
            $empleados = StatusOfDocument::with('personas')->where('EDCMT_Proceso_Documentacion', "Documentación completa EPS")
                            ->orWhere('EDCMT_Proceso_Documentacion', "Documentación completa Caja de compensación")
                            ->distinct()->get(['FK_TBL_Persona_Cedula']);
            return Datatables::of($empleados)
                ->removeColumn('PRSN_Direccion')
                ->removeColumn('PRSN_Ciudad')
                ->removeColumn('PRSN_Eps')
                ->removeColumn('PRSN_Fpensiones')
                ->removeColumn('PRSN_Caja_Compensacion')
                ->removeColumn('PRSN_Estado_Persona')
                ->removeColumn('PRSN_Salario')
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
     * Verifica que no exista un correo ya registrado
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verificarEmail(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')){

            if (Persona::where('PRSN_Correo', $request['PRSN_Correo'])->exists()) {
                return response('false');
            } else {
                return response('true');
            }

        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }


    /**
     * Función que consulta los empleados que tienen la documentación incompleta y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function listaEmpleadosDocumentosIncompletos(Request $request){

        if ($request->ajax() && $request->isMethod('GET')) {
            $empleados = StatusOfDocument::with('personas')->where('EDCMT_Proceso_Documentacion', "Documentación incompleta EPS")
                ->orWhere('EDCMT_Proceso_Documentacion', "Documentación incompleta Caja de compensación")
                ->distinct()->get(['FK_TBL_Persona_Cedula']);
            return Datatables::of($empleados)
                ->removeColumn('PRSN_Direccion')
                ->removeColumn('PRSN_Ciudad')
                ->removeColumn('PRSN_Eps')
                ->removeColumn('PRSN_Fpensiones')
                ->removeColumn('PRSN_Caja_Compensacion')
                ->removeColumn('PRSN_Estado_Persona')
                ->removeColumn('PRSN_Salario')
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
     * Muestra todos los empleados registrados por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.empleado.ajaxTablaEmpleados');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Muestra todos los empleados que tienen estado retirado.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function ajaxEmpleadosRetirados(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.empleado.ajaxEmpleadosRetirados');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Muestra todos los empleados registrados para acceder a su historial de documentación.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function ajaxListaEmpleados(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.empleado.ajaxListaEmpleados');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el formulario para editar un empleado retirado.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function editarEmpleadoRetirado(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $empleado = Persona::find($id);
            return view('humtalent.empleado.editarEmpleadoRetirado',
                [
                    'empleado' => $empleado,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que muestra el formulario de registro de un nuevo empleado.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function create(Request $request)//
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.empleado.registroEmpleado');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos un nuevo registro de un empleado.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            Persona::create($request->all());
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos el registro del archivo de excel.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function importUsers(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            try {
                $cont = 0;
                $path = Input::file('import_file')->getRealPath();
                $data = Excel::load($path, function ($reader) {
                })->get();
                foreach ($data as $datum) {
                    $empleado = Persona::where('PK_PRSN_Cedula', $datum['cedula'])->get();
                    if (count($empleado) > 0) {
                        $cont++;
                    } else {
                        Persona::create([
                            'PK_PRSN_Cedula' => $datum['cedula'],
                            'PRSN_Rol' => mb_strtoupper($datum['rol'], 'UTF-8'),
                            'PRSN_Nombres' => mb_strtoupper($datum['nombres'], 'UTF-8'),
                            'PRSN_Apellidos' => mb_strtoupper($datum['apellidos'], 'UTF-8'),
                            'PRSN_Telefono' => mb_strtoupper($datum['telefono'], 'UTF-8'),
                            'PRSN_Correo' => mb_strtoupper($datum['correo'], 'UTF-8'),
                            'PRSN_Direccion' => mb_strtoupper($datum['direccion'], 'UTF-8'),
                            'PRSN_Ciudad' => mb_strtoupper($datum['ciudad'], 'UTF-8'),
                            'PRSN_Salario' => mb_strtoupper($datum['salario'], 'UTF-8'),
                            'PRSN_Eps' => mb_strtoupper($datum['eps'], 'UTF-8'),
                            'PRSN_Fpensiones' => mb_strtoupper($datum['fpensiones'], 'UTF-8'),
                            'PRSN_Area' => mb_strtoupper($datum['area'], 'UTF-8'),
                            'PRSN_Caja_Compensacion' => mb_strtoupper($datum['cajacompensacion'], 'UTF-8'),
                            'PRSN_Estado_Persona' => mb_strtoupper($datum['estado'], 'UTF-8'),
                        ]);
                    }
                }
                if ($cont > 0) {
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'El archivo contenia ' . $cont . ' registros que ya estaban almacenados en la base de datos, los nuevos fueron registrados exitosamente.'
                    );
                }

                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'La información del archivo fue almacenada correctamente.'
                );
            }catch(Exception $e){
                return AjaxResponse::success(
                    'Ocurrió un problema',
                    'El archivo adjunto no cumple con las especificaciones'
                );
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que envia los emails a los empleados .
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function enviarEmail(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $subject = $request['Asunto'];
            $descripcion = $request['Descripcion'];
            $correos = explode(';', $request['Destinatarios']);
            $file = $request->file('import_file');
            $user = Auth::user()->email;

            if ($file !== null) {
                $nombre = $file->getClientOriginalName();
                Storage::disk('local')->put($nombre, \File::get($file));

                $public_path = storage_path('app');
                $url = $public_path . '/' . $nombre;
            } else {
                $url = null;
            }

            for ($i = 0; $i < count($correos) - 1; $i++) {
                Mail::to($correos[$i], 'P1')->send(new EmailTalentoHumano($subject, $descripcion, $url));
            }
            Mail::to($user, 'P1')->send(new EmailTalentoHumano($subject, $descripcion, $url));

            Notification::create([      //para asi poder crear el registro nuevo a la base de datos
                'NOTIF_Descripcion' => $nombre,
                'NOTIF_Estado_Notificacion' => "Archivo",
            ]);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Mensaje enviado correctamente.'
            );

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


    /**
     * Presenta el formulario con los datos para editar el regitro de un empleado deseado.
     *
     * @param  \Illuminate\Http\Request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $empleado = Persona::find($id);
            return view('humtalent.empleado.editarEmpleado',
                [
                    'empleado' => $empleado,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Se realiza la actualización de los datos de un empleado.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $empleado = Persona::find($request['PK_PRSN_Cedula']);
            $empleado->fill($request->all());
            $empleado->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Se realiza la eliminación de un registro de empleado en caso de que asi se desee.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
            Induction::with('Persona')
                ->where('FK_TBL_Persona_Cedula', $id)
                ->delete();
            StatusOfDocument::with('Persona')
                ->where('FK_TBL_Persona_Cedula', $id)
                ->delete();
            Asistent::with('Persona')
                ->where('FK_TBL_Persona_Cedula', $id)
                ->delete();
            Permission::where('FK_TBL_Persona_Cedula', $id)->delete();
            Persona::destroy($id);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Muestra la vista del reporte de datos de contacto de los empleados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteContactoEmpleados(Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $empleados = Persona::whereNotNull('created_at', null)->orderBy('PRSN_Nombres', 'asc')->get();
            $total = count($empleados);
            $cont = 1;
            return view('humtalent.reportes.ReporteContactoEmpleados',
                compact('empleados', 'date', 'time', 'total', 'cont')
            );
        }
    }

    /**
     * Permite descargar el reporte de datos de contacto de los empleados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function downloadContactoReporte(Request $request)
    {
        if ($request->isMethod('GET')) {
            try {

                $date = date("d/m/Y");
                $time = date("h:i A");
                $empleados = Persona::whereNotNull('created_at', null)
                    ->orderBy('PRSN_Nombres', 'asc')
                    ->get();
                $total = count($empleados);
                $cont = 1;
                return SnappyPdf::loadView('humtalent.reportes.ReporteContactoEmpleados',
                    compact('empleados', 'date', 'time', 'total', 'cont')
                )->download('ReporteContacto.pdf');

            } catch ( Exception $e ){
                return view('humtalent.empleado.tablasEmpleados');
            }
        }
    }

    /**
     * Muestra la vista del reporte de datos de dirección de los empleados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteDireccionEmpleados(Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $empleados = Persona::whereNotNull('created_at', null)
                ->orderBy('PRSN_Nombres', 'asc')
                ->get();
            $total = count($empleados);
            $cont = 1;
            return view('humtalent.reportes.ReporteDireccionEmpleados',
                compact('empleados', 'date', 'time', 'total', 'cont')
            );
        }
    }

    /**
     * Permite descargar el reporte de datos de dirección de los empleados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function downloadDireccionReporte(Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");
                $time = date("h:i A");
                $empleados = Persona::whereNotNull('created_at', null)->orderBy('PRSN_Nombres', 'asc')->get();
                $total = count($empleados);
                $cont = 1;
                return SnappyPdf::loadView('humtalent.reportes.ReporteDireccionEmpleados',
                    compact('empleados', 'date', 'time', 'total', 'cont')
                )->download('ReporteDireccion.pdf');
            }
            catch ( Exception $e ){
                return view('humtalent.empleado.tablasEmpleados');
            }
        }
    }

    /**
     * Muestra la vista del reporte correspondiente al salario de los empleados ordenado por programa.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteSalario1Empleados( Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $empleados = Persona::whereNotNull('created_at', null)
                ->orderBy('PRSN_Area', 'asc')
                ->get();
            $total = count($empleados);
            $cont = 1;
            return view('humtalent.reportes.ReporteSalario1Empleados',
                compact('empleados', 'date', 'time', 'total', 'cont')
            );
        }
    }

    /**
     * Permite descargar el reporte correspondiente al salario de los empleados ordenado por programa.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function downloadSalario1Reporte( Request $request)
    {
        if ($request->isMethod('GET')) {
            try {

                $date = date("d/m/Y");
                $time = date("h:i A");
                $empleados = Persona::whereNotNull('created_at', null)->orderBy('PRSN_Area', 'asc')->get();
                $total = count($empleados);
                $cont = 1;
                return SnappyPdf::loadView('humtalent.reportes.ReporteSalario1Empleados',
                    compact('empleados', 'date', 'time', 'total', 'cont')
                )->download('ReporteSalarioArea.pdf');

            }
            catch (Exception $e){

                return view('humtalent.empleado.tablasEmpleados');
            }
        }
    }

    /**
     * Muestra la vista del reporte correspondiente al salario de los empleados ordenado por rol.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteSalario2Empleados( Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $empleados = Persona::whereNotNull('created_at', null)->orderBy('PRSN_Rol', 'asc')->get();
            $total = count($empleados);
            $cont = 1;
            return view('humtalent.reportes.ReporteSalario2Empleados',
                compact('empleados', 'date', 'time', 'total', 'cont')
            );
        }
    }

    /**
     * Permite descargar el reporte correspondiente al salario de los empleados ordenado por rol.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function downloadSalario2Reporte( Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");
                $time = date("h:i A");
                $empleados = Persona::whereNotNull('created_at', null)
                    ->orderBy('PRSN_Rol', 'asc')
                    ->get();
                $total = count($empleados);
                $cont = 1;
                return SnappyPdf::loadView('humtalent.reportes.ReporteSalario2Empleados',
                    compact('empleados', 'date', 'time', 'total', 'cont')
                )->download('ReporteSalarioRol.pdf');
            }
            catch ( Exception $e){
                return view('humtalent.empleado.tablasEmpleados');
            }
        }
    }

    /**
     * Muestra la vista del reporte correspondiente a las afiliaciones que tienen los empleados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteAfiliacionesEmpleados( Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $empleados = Persona::whereNotNull('created_at', null)
                ->orderBy('PRSN_Nombres', 'asc')
                ->get();
            $total = count($empleados);
            $cont = 1;
            return view('humtalent.reportes.ReporteAfiliacionesEmpleados',
                compact('empleados', 'date', 'time', 'total', 'cont')
            );
        }

    }

    /**
     * Permite descargar el reporte correspondiente a las afiliaciones que tienen los empleados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function downloadAfiliacionesReporte( Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");
                $time = date("h:i A");
                $empleados = Persona::whereNotNull('created_at', null)
                    ->orderBy('PRSN_Nombres', 'asc')
                    ->get();
                $total = count($empleados);
                $cont = 1;
                return SnappyPdf::loadView('humtalent.reportes.ReporteAfiliacionesEmpleados',
                    compact('empleados', 'date', 'time', 'total', 'cont')
                )->download('ReporteAfiliaciones.pdf');
            }
            catch ( Exception $e ){
                return view('humtalent.empleado.tablasEmpleados');
            }
        }
    }

    /**
     * Muestra la vista del reporte correspondiente al estado que tienen los empleados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function reporteEstadoEmpleados( Request $request)
    {
        if ($request->isMethod('GET')) {
            $date = date("d/m/Y");
            $time = date("h:i A");
            $empleados = Persona::whereNotNull('created_at', null)
                ->orderBy('PRSN_Estado_Persona', 'asc')
                ->get();
            $total = count($empleados);
            $cont = 1;
            return view('humtalent.reportes.ReporteEstadoEmpleados',
                compact('empleados', 'date', 'time', 'total', 'cont')
            );
        }
    }

    /**
     * Permite descargar el reporte correspondiente al estado que tienen los empleados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Barryvdh\Snappy\Facades\SnappyPdf | \Illuminate\Http\Response
     */
    public function downloadEstadoReporte( Request $request)
    {
        if ($request->isMethod('GET')) {
            try {
                $date = date("d/m/Y");
                $time = date("h:i A");
                $empleados = Persona::whereNotNull('created_at', null)
                    ->orderBy('PRSN_Estado_Persona', 'asc')
                    ->get();
                $total = count($empleados);
                $cont = 1;
                return SnappyPdf::loadView('humtalent.reportes.ReporteEstadoEmpleados',
                    compact('empleados', 'date', 'time', 'total', 'cont')
                )->download('ReporteEstado.pdf');
            }
            catch ( Exception $e ){
                return view('humtalent.empleado.tablasEmpleados');
            }
        }
    }
}