<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 22/08/2017
 * Time: 1:58 PM
 */

namespace App\Container\Humtalent\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Permission;
use Yajra\DataTables\DataTables;
use App\Container\Overall\Src\Facades\AjaxResponse;
use Barryvdh\Snappy\Facades\SnappyPdf;


class PermisosController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Función que presenta la  vista con lista de los permisos, en un data table
     * relacionados con el empleado seleccionado,recibe el id del empleado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listaPermisos(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            //se realiza la consulta del empleado seleccionado para presentar los datos
            $empleado = Persona::where('PK_PRSN_Cedula', $id)
                        ->get(['PK_PRSN_Cedula', 'PRSN_Nombres', 'PRSN_Apellidos',
                               'PRSN_Telefono', 'PRSN_Correo']
                        )->first();
            //se presenta la vista con los datos del empleado y un dataTable
            return view('humtalent.permisos.tablaPermisos', compact('empleado'));
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que presenta el listado de empleados registrados por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxListaEmpleados (Request $request)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('humtalent.permisos.ajaxListaEmpleados');
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que registra un permiso a través de un formulario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            Permission::create([ //se crea el nuevo registro
                'PERM_Fecha'            => $request['PERM_Fecha'],
                'PERM_Descripcion'      => $request['PERM_Descripcion'],
                'FK_TBL_Persona_Cedula' => $request['FK_TBL_Persona_Cedula']
            ]);
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
     * Función ejecutada por el dataTable que consulta los permisos de un empleado seleccionado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function consultaPermisos(Request $request, $id)
    {
        //realiza la consulta de los permisos
        $permisos = Permission::where('FK_TBL_Persona_Cedula', $id)
                    ->get(['PERM_Fecha','PERM_Descripcion','PK_PERM_IdPermiso']);
        if ($request->ajax())
        {
            //se retorna al dataTable la información consultada
            return DataTables::of($permisos )
                ->addIndexColumn()
                ->make(true);
        }

        return response()->json([
            'message' => 'Incorrect request',
            'code' => 412
        ], 412);
    }

    /**
     * Función que actualiza los datos de un permiso seleccionado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update (Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $permiso = Permission::find($request['PK_PERM_IdPermiso']);
            $permiso->fill($request->all());
            $permiso->save();
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
     * Función que elimina el registro de un permiso seleccionado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy (Request $request, $id)
    {   //
        if($request->ajax() && $request->isMethod('DELETE'))
        {
            Permission::destroy($id);
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
     * Función que genera la vista del reporte de los permisos que cada empleado tiene.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportePermisosEmpleados ($id)
    {
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleado = Persona::where('PK_PRSN_Cedula',$id)
                    ->get(['PK_PRSN_Cedula', 'PRSN_Nombres', 'PRSN_Apellidos',
                           'PRSN_Area', 'PRSN_Correo', 'PRSN_Rol'])
                    ->first();
        $permisos = Permission::where('FK_TBL_Persona_Cedula',$id)
                    ->get(['PERM_Fecha', 'PERM_Descripcion', 'PK_PERM_IdPermiso']);
        $total = count($permisos);
        return view('humtalent.reportes.ReportePermisosEmpleados',
            compact('empleado', 'date', 'time', 'permisos', 'total', 'cont')
        );
    }

    /**
     * Función que permite descargar el reporte de los permisos que cada empleado tiene.
     *
     * @param  int  $id
     * @return \Barryvdh\Snappy\Facades\SnappyPdf
     */
    public function downloadReportePermisosEmpleados ($id)
    {
        $cont = 1;
        $date = date("d/m/Y");
        $time = date("h:i A");
        $empleado = Persona::where('PK_PRSN_Cedula',$id)
                    ->get(['PK_PRSN_Cedula', 'PRSN_Nombres', 'PRSN_Apellidos',
                           'PRSN_Area', 'PRSN_Correo', 'PRSN_Rol'])
                    ->first();
        $permisos = Permission::where('FK_TBL_Persona_Cedula',$id)
                    ->get(['PERM_Fecha', 'PERM_Descripcion', 'PK_PERM_IdPermiso']);
        $total = count($permisos);
        return SnappyPdf::loadView('humtalent.reportes.ReportePermisosEmpleados',
               compact('empleado', 'date', 'time', 'permisos', 'total', 'cont')
        )->download('ReportePermisos.pdf');
    }
}