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
use App\Mail\HumTalent\EmailTalentoHumano;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Permission;
use App\Container\Humtalent\src\StatusOfDocument;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Mail\Message;
use Storage;
use Illuminate\Support\Facades\Auth;
use App\Container\Users\Src\User;

class EmpleadoController extends Controller
{

    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
     * Muestra todos los empleados registrados por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax (Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET'))
        {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxEmpleadosRetirados (Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET'))
        {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxListaEmpleados (Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET'))
        {
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarEmpleadoRetirado (Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET'))
        {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)//
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store (Request $request)//
    {
        if ($request->ajax() && $request->isMethod('POST')){
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
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function importUsers (Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $cont = 0;
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function ($reader) {})->get();
            foreach ($data as $datum)
            {
                $empleado = Persona::where('PK_PRSN_Cedula', $datum['cedula'])->get();
                if (count($empleado) > 0)
                {
                    $cont++;
                }
                else
                {
                    Persona::create([
                        'PK_PRSN_Cedula'         => $datum['cedula'],
                        'PRSN_Rol'               => mb_strtoupper($datum['rol'], 'UTF-8'),
                        'PRSN_Nombres'           => mb_strtoupper($datum['nombres'], 'UTF-8'),
                        'PRSN_Apellidos'         => mb_strtoupper($datum['apellidos'], 'UTF-8'),
                        'PRSN_Telefono'          => mb_strtoupper($datum['telefono'], 'UTF-8'),
                        'PRSN_Correo'            => mb_strtoupper($datum['correo'], 'UTF-8'),
                        'PRSN_Direccion'         => mb_strtoupper($datum['direccion'], 'UTF-8'),
                        'PRSN_Ciudad'            => mb_strtoupper($datum['ciudad'], 'UTF-8'),
                        'PRSN_Salario'           => mb_strtoupper($datum['salario'], 'UTF-8'),
                        'PRSN_Eps'               => mb_strtoupper($datum['eps'], 'UTF-8'),
                        'PRSN_Fpensiones'        => mb_strtoupper($datum['fpensiones'], 'UTF-8'),
                        'PRSN_Area'              => mb_strtoupper($datum['area'], 'UTF-8'),
                        'PRSN_Caja_Compensacion' => mb_strtoupper($datum['cajacompensacion'], 'UTF-8'),
                        'PRSN_Estado_Persona'    => mb_strtoupper($datum['estado'], 'UTF-8'),
                    ]);
                }
            }
            if ($cont > 0)
            {
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'El archivo contenia ' . $cont . ' registros que ya estaban almacenados en la base de datos, los nuevos fueron registrados exitosamente.'
                );
            }

            return AjaxResponse::success(
                '¡Bien hecho!',
                'La información del archivo fue almacenada correctamente.'
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que envia los emails a los empleados .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public  function enviarEmail(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $subject = $request['Asunto'];
            $descripcion = $request['Descripcion'];
            $correos = explode(';',$request['Destinatarios']);
            $file = $request->file('import_file');
            $user = Auth::user()->email;

            if($file !== null)
            {
                $nombre = $file->getClientOriginalName();
                Storage::disk('local')->put($nombre, \File::get($file));

                $public_path = storage_path('app');
                $url = $public_path . '/' . $nombre;
            }
            else
            {
                $url = null;
            }

            for($i = 0 ; $i < count($correos)-1; $i++){
                Mail::to($correos[$i], 'P1')->send(new EmailTalentoHumano($subject,$descripcion, $url));
            }
            Mail::to($user, 'P1')->send(new EmailTalentoHumano($subject,$descripcion, $url));

            if($file !== null)
            {
                $nombre = $file->getClientOriginalName();
                Storage::disk('local')->delete($nombre);
            }

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update (Request $request)//
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
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
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('DELETE'))
        {
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
     * @return \Illuminate\Http\Response
     */
    public function reporteContactoEmpleados()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Nombres','asc')->get();
        $total = count($empleados);
        $cont = 1;
        return view('humtalent.reportes.ReporteContactoEmpleados',
            compact('empleados', 'date', 'time', 'total', 'cont')
        );
    }

    /**
     * Permite descargar el reporte de datos de contacto de los empleados.
     *
     * @return \Barryvdh\Snappy\Facades\SnappyPdf
     */
    public function downloadContactoReporte()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)
                    ->orderBy('PRSN_Nombres', 'asc')
                    ->get();
        $total = count($empleados);
        $cont = 1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteContactoEmpleados',
               compact('empleados', 'date', 'time', 'total', 'cont')
        )->download('ReporteContacto.pdf');
    }

    /**
     * Muestra la vista del reporte de datos de dirección de los empleados.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteDireccionEmpleados()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)
                    ->orderBy('PRSN_Nombres', 'asc')
                    ->get();
        $total = count($empleados);
        $cont = 1;
        return view('humtalent.reportes.ReporteDireccionEmpleados',
            compact('empleados', 'date', 'time', 'total', 'cont')
        );
    }

    /**
     * Permite descargar el reporte de datos de dirección de los empleados.
     *
     * @return \Barryvdh\Snappy\Facades\SnappyPdf
     */
    public function downloadDireccionReporte()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Nombres','asc')->get();
        $total = count($empleados);
        $cont = 1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteDireccionEmpleados',
               compact('empleados', 'date', 'time', 'total', 'cont')
        )->download('ReporteDireccion.pdf');
    }

    /**
     * Muestra la vista del reporte correspondiente al salario de los empleados ordenado por programa.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteSalario1Empleados()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)
                    ->orderBy('PRSN_Area', 'asc')
                    ->get();
        $total = count($empleados);
        $cont = 1;
        return view('humtalent.reportes.ReporteSalario1Empleados',
            compact('empleados', 'date', 'time', 'total', 'cont')
        );
    }

    /**
     * Permite descargar el reporte correspondiente al salario de los empleados ordenado por programa.
     *
     * @return \Barryvdh\Snappy\Facades\SnappyPdf
     */
    public function downloadSalario1Reporte()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Area','asc')->get();
        $total = count($empleados);
        $cont = 1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteSalario1Empleados',
               compact('empleados','date', 'time', 'total', 'cont')
        )->download('ReporteSalarioArea.pdf');
    }

    /**
     * Muestra la vista del reporte correspondiente al salario de los empleados ordenado por rol.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteSalario2Empleados()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Rol','asc')->get();
        $total = count($empleados);
        $cont = 1;
        return view('humtalent.reportes.ReporteSalario2Empleados',
            compact('empleados','date', 'time', 'total', 'cont')
        );
    }

    /**
     * Permite descargar el reporte correspondiente al salario de los empleados ordenado por rol.
     *
     * @return \Barryvdh\Snappy\Facades\SnappyPdf
     */
    public function downloadSalario2Reporte()
    {
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

    /**
     * Muestra la vista del reporte correspondiente a las afiliaciones que tienen los empleados.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteAfiliacionesEmpleados()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)
                    ->orderBy('PRSN_Nombres','asc')
                    ->get();
        $total = count($empleados);
        $cont = 1;
        return view('humtalent.reportes.ReporteAfiliacionesEmpleados',
            compact('empleados', 'date', 'time', 'total', 'cont')
        );

    }

    /**
     * Permite descargar el reporte correspondiente a las afiliaciones que tienen los empleados.
     *
     * @return \Barryvdh\Snappy\Facades\SnappyPdf
     */
    public function downloadAfiliacionesReporte()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)
                   ->orderBy('PRSN_Nombres', 'asc')
                   ->get();
        $total = count($empleados);
        $cont = 1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteAfiliacionesEmpleados',
               compact('empleados', 'date', 'time', 'total', 'cont')
        )->download('ReporteAfiliaciones.pdf');
    }

    /**
     * Muestra la vista del reporte correspondiente al estado que tienen los empleados.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporteEstadoEmpleados()
    {
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

    /**
     * Permite descargar el reporte correspondiente al estado que tienen los empleados.
     *
     * @return \Barryvdh\Snappy\Facades\SnappyPdf
     */
    public function downloadEstadoReporte()
    {
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)
                   ->orderBy('PRSN_Estado_Persona','asc')
                   ->get();
        $total = count($empleados);
        $cont = 1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteEstadoEmpleados',
               compact('empleados','date','time','total','cont')
        )->download('ReporteEstado.pdf');
    }

}