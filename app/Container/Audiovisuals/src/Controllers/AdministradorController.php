<?php

namespace App\Container\Audiovisuals\Src\Controllers;

use App\Container\Audiovisuals\Src\Interfaces\AdminInterface;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdministradorController extends Controller
{
    protected $adminRepository;

    public function __construct(AdminInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('audiovisuals.administrador.gestionAdministradores');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $admins = $this->adminRepository->index();
            return DataTables::of($admins)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->removeColumn('deleted_at')
                ->removeColumn('remember_token')
                ->removeColumn('ADMIN_Clave')
                ->removeColumn('FK_ADMIN_Rol')
                ->removeColumn('ADMIN_Direccion')
                ->removeColumn('ADMIN_Apellidos')
                ->removeColumn('FK_ADMIN_Estado')
                ->addIndexColumn()
                ->make(true);

        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $this->adminRepository->store($request->all());
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Administrador registrado correctamente.'
            );
        } else {
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $admin = $this->adminRepository->show($id);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos cargados correctamente.',
                $admin
            );
        } else {
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
        if ($request->ajax() && $request->isMethod('POST')) {
            $admin = [
                'id'              => $id,
                'PK_ADMIN_Cedula' => $request->get('PK_ADMIN_Cedula'),
                'ADMIN_Clave'     => $request->get('ADMIN_Clave'),
                'FK_ADMIN_Rol'    => $request->get('FK_ADMIN_Rol'),
                'ADMIN_Nombres'   => $request->get('ADMIN_Nombres'),
                'ADMIN_Apellidos' => $request->get('ADMIN_Apellidos'),
                'ADMIN_Direccion' => $request->get('ADMIN_Direccion'),
                'ADMIN_Correo'    => $request->get('ADMIN_Correo'),
                'ADMIN_Telefono'  => $request->get('ADMIN_Telefono'),
                'FK_ADMIN_Estado' => $request->get('FK_ADMIN_Estado'),
            ];
            $this->adminRepository->update($admin);
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        } else {
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
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $this->adminRepository->destroy($id);

            return AjaxResponse::success(
                '¡Bien hecho!',
                'Administrador eliminado correctamente.'
            );
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
}
