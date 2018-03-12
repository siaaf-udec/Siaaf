<?php

namespace App\Container\Permissions\Src\Controllers;

use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Container\Permissions\Src\Interfaces\PermissionInterface;
use App\Container\Permissions\Src\Interfaces\RoleInterface;
use App\Container\Permissions\Src\Interfaces\ModuleInterface;

use App\Container\Overall\Src\Facades\AjaxResponse;

class RolePermissionController extends Controller
{

    protected $permissionRepository;
    protected $roleRepository;
    protected $moduleRepository;

    public function __construct(PermissionInterface $permissionRepository, RoleInterface $roleRepository, ModuleInterface $moduleRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $style = [
            'badge-danger', 'badge-warning', 'badge-info', 'badge-success'
        ];
        $roles = $this->roleRepository->index([]);
        $modules = $this->moduleRepository->index([]);
        return view('access-control.role_permission', [
            'roles' => $roles,
            'style' => $style,
            'modules' => $modules
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET')){
        $roles = $this->roleRepository->show($id, []);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.',
                $roles->perms
            );
        }else{
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
    public function store(Request $request)
    {
        if($request->ajax() && $request->isMethod('POST')){
            $this->roleRepository->store($request->all());
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('POST')){
            $role = $this->roleRepository->show($id, []);
            $role->perms()->sync(
                ($request->get('multi_permission') !== null) ? explode(',', $request->get('multi_permission')) : []
            );
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
    public function destroy(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('DELETE')){

            $this->permissionRepository->destroy($id);

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
}
