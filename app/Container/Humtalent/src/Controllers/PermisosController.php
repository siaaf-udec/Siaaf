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


class PermisosController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listaPermisos(Request $request, $id) //función que presenta la  vista con lista de los permisos, en un data table  relacionados con el empleado seleccionado,recibe el id del empleado
    {
        if($request->ajax() && $request->isMethod('GET')) {
            $empleado = Persona::where('PK_PRSN_Cedula', $id)->get(['PK_PRSN_Cedula', 'PRSN_Nombres', 'PRSN_Apellidos', 'PRSN_Telefono', 'PRSN_Correo'])->first();//se realiza la consulta del empleado seleccionado para presentar los datos
            return view('humtalent.permisos.tablaPermisos', compact('empleado')); //se presenta la vista con los datos del empleado y un dataTable
        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function ajaxListaEmpleados(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')) {
            return view('humtalent.permisos.ajaxListaEmpleados');
        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    public function store(Request $request) //función que registra un permiso a travez de un formulario
    {
        if($request->ajax() && $request->isMethod('POST')){
            Permission::create([ //se crea el nuevo registro
                'PERM_Fecha' => $request['PERM_Fecha'],
                'PERM_Descripcion' => $request['PERM_Descripcion'],
                'FK_TBL_Persona_Cedula' =>$request['FK_TBL_Persona_Cedula']
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
    public function consultaPermisos(Request $request, $id){//función ejecutada por el dataTable que consulta los permisos de un empleado seleccionado
        $permisos=Permission::where('FK_TBL_Persona_Cedula',$id)->get(['PERM_Fecha','PERM_Descripcion','PK_PERM_IdPermiso']); //realiza la consulta de los permisos
        if ($request->ajax()) {
            return DataTables::of($permisos ) //se retorna al dataTable la información consultada
                ->addIndexColumn()
                ->make(true);
        } else {
            return response()->json([
                'message' => 'Incorrect request',
                'code' => 412
            ], 412);
        }
    }
    public function update(Request $request) //función que actualiza los datos de un permiso seleccionado
    {
        if($request->ajax() && $request->isMethod('POST')) {
            $permiso = Permission::find($request['PK_PERM_IdPermiso']);
            $permiso->fill($request->all());
            $permiso->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos almacenados correctamente.'
            );
        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function destroy(Request $request, $id){//función que elimina el registro de un permiso seleccionado 
        if($request->ajax() && $request->isMethod('DELETE')){
            Permission::destroy($id);
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
}