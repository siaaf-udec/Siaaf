<?php

namespace App\Container\Permissions\Src\Controllers;

use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Container\Permissions\Src\Interfaces\PermissionInterface;
use App\Container\Permissions\Src\Interfaces\ModuleInterface;
use App\Container\Overall\Src\Facades\AjaxResponse;

class PermissionController extends Controller
{

    protected $permissionRepository;
    protected $moduleRepository;

    public function __construct(PermissionInterface $permissionRepository, ModuleInterface $moduleRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = $this->moduleRepository->index([])->pluck('name', 'id');

        return view('access-control.permissions',[
            'modules' => $modules->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $permission = $this->permissionRepository->show($id);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.',
                $permission
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $permissions = $this->permissionRepository->index([]);
            return DataTables::of($permissions)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->addIndexColumn()
                ->make(true);
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
            $this->permissionRepository->store($request->all());
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
            $permission = [
                'id' => $id,
                'name'=> $request->get('name'),
                'display_name'=> $request->get('display_name'),
                'description'=> $request->get('description'),
                'module_id'=> $request->get('module_id'),
            ];
            $this->permissionRepository->update($permission);
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
