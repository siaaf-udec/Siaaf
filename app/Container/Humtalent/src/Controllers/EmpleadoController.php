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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Permission;
use App\Container\Humtalent\src\StatusOfDocument;
use App\Container\Humtalent\src\DocumentacionPersona;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\Snappy\Facades\SnappyPdf;

class EmpleadoController extends Controller
{

    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//muestra todos los empleados registrados
    {
        return view('humtalent.empleado.tablasEmpleados');
    }

    public function indexAjax(Request $request)//muestra todos los empleados registrados
    {
        if($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.empleado.ajaxTablaEmpleados');
        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function ajaxEmpleadosRetirados(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.empleado.ajaxEmpleadosRetirados');
        }
        else{
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
            }
    }

    public function ajaxListaEmpleados(Request $request){
        if($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.empleado.ajaxListaEmpleados');
        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function editarEmpleadoRetirado(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $empleado = Persona::find($id);
            return view('humtalent.empleado.editarEmpleadoRetirado', [
                'empleado' => $empleado,
            ]);
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)//muestra el formulario de registro de un nuevo empleado
    {
        if($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.empleado.registroEmpleado');
        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//se alamacena en la base de datos un nuevo registro del empleado
    {
        if($request->ajax() && $request->isMethod('POST')){
            Persona::create([
                'PK_PRSN_Cedula'          => $request['PK_PRSN_Cedula'],
                'PRSN_Rol'                => $request['PRSN_Rol'],
                'PRSN_Nombres'            => $request['PRSN_Nombres'],
                'PRSN_Apellidos'          => $request['PRSN_Apellidos'],
                'PRSN_Telefono'           => $request['PRSN_Telefono'],
                'PRSN_Correo'             => $request['PRSN_Correo'],
                'PRSN_Direccion'          => $request['PRSN_Direccion'],
                'PRSN_Ciudad'             => $request['PRSN_Ciudad'],
                'PRSN_Salario'             => $request['PRSN_Salario'],
                'PRSN_Eps'                => $request['PRSN_Eps'],
                'PRSN_Fpensiones'         => $request['PRSN_Fpensiones'],
                'PRSN_Area'               => $request['PRSN_Area'],
                'PRSN_Caja_Compensacion'  => $request['PRSN_Caja_Compensacion'],
                'PRSN_Estado_Persona'     => $request['PRSN_Estado_Persona'],
            ]);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }
    public function importUsers(Request $request)//se almacena en la base de datos el registro del archivo de excel
    {
        if($request->ajax() && $request->isMethod('POST')) {
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
            };
            if ($cont > 0) {

                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'El archivo contenia ' . $cont . ' registros que ya estaban almacenados en la base de datos, los nuevos fueron registrados exitosamente.'
                );

            } else {
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'La información del archivo fue almacenada correctamente.'
                );

            }

        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //return "en el show";
       // return view('humtalent.empleado.consultaEmpleado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)//presenta el formulario con los datos para editar el regitro de un empleado deseado
    {
        if($request->ajax() && $request->isMethod('GET')){
            $empleado = Persona::find($id);
            return view('humtalent.empleado.editarEmpleado', [
                'empleado' => $empleado,
            ]);
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)//re realiza la actualización de los datos
    {
        if($request->ajax() && $request->isMethod('POST')) {
            $empleado = Persona::find($request['PK_PRSN_Cedula']);
            $empleado->fill($request->all());
            $empleado->save();

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)//se realiza la eliminación de un registro de empleado en caso de que asi se desee
    {
        if($request->ajax() && $request->isMethod('DELETE')){
            Induction::with('Persona')->where('FK_TBL_Persona_Cedula',$id)->delete();
            StatusOfDocument::with('Persona')->where('FK_TBL_Persona_Cedula',$id)->delete();
            Asistent::with('Persona')->where('FK_TBL_Persona_Cedula',$id)->delete();
            Permission::where('FK_TBL_Persona_Cedula',$id)->delete();
            Persona::destroy($id);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function reporteContactoEmpleados()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Nombres','asc')->get();
        $total=count($empleados);
        $cont=1;
        return view('humtalent.reportes.ReporteContactoEmpleados',compact('empleados','date','time','total','cont'));

    }
    public function DownloadContactoReporte()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Nombres','asc')->get();
        $total=count($empleados);
        $cont=1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteContactoEmpleados',compact('empleados','date','time','total','cont'))->download('ReporteContacto.pdf');
    }
    public function reporteDireccionEmpleados()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Nombres','asc')->get();
        $total=count($empleados);
        $cont=1;
        return view('humtalent.reportes.ReporteDireccionEmpleados',compact('empleados','date','time','total','cont'));

    }
    public function DownloadDireccionReporte()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Nombres','asc')->get();
        $total=count($empleados);
        $cont=1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteDireccionEmpleados',compact('empleados','date','time','total','cont'))->download('ReporteDireccion.pdf');
    }
    public function reporteSalario1Empleados()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Area','asc')->get();
        $total=count($empleados);
        $cont=1;
        return view('humtalent.reportes.ReporteSalario1Empleados',compact('empleados','date','time','total','cont'));

    }
    public function DownloadSalario1Reporte()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Area','asc')->get();
        $total=count($empleados);
        $cont=1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteSalario1Empleados',compact('empleados','date','time','total','cont'))->download('ReporteSalarioArea.pdf');
    }
    public function reporteSalario2Empleados()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Rol','asc')->get();
        $total=count($empleados);
        $cont=1;
        return view('humtalent.reportes.ReporteSalario2Empleados',compact('empleados','date','time','total','cont'));

    }
    public function DownloadSalario2Reporte()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Rol','asc')->get();
        $total=count($empleados);
        $cont=1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteSalario2Empleados',compact('empleados','date','time','total','cont'))->download('ReporteSalarioRol.pdf');
    }
    public function reporteAfiliacionesEmpleados()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Nombres','asc')->get();
        $total=count($empleados);
        $cont=1;
        return view('humtalent.reportes.ReporteAfiliacionesEmpleados',compact('empleados','date','time','total','cont'));

    }
    public function DownloadAfiliacionesReporte()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Nombres','asc')->get();
        $total=count($empleados);
        $cont=1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteAfiliacionesEmpleados',compact('empleados','date','time','total','cont'))->download('ReporteAfiliaciones.pdf');
    }
    public function reporteEstadoEmpleados()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Estado_Persona','asc')->get();
        $total=count($empleados);
        $cont=1;
        return view('humtalent.reportes.ReporteEstadoEmpleados',compact('empleados','date','time','total','cont'));

    }
    public function DownloadEstadoReporte()
    {
        $date=date("d/m/Y");
        $time=date("h:i A");
        $empleados = Persona::whereNotNull('created_at',null)->orderBy('PRSN_Estado_Persona','asc')->get();
        $total=count($empleados);
        $cont=1;
        return SnappyPdf::loadView('humtalent.reportes.ReporteEstadoEmpleados',compact('empleados','date','time','total','cont'))->download('ReporteEstado.pdf');
    }

}