<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Container\Carpark\src\Dependencias;
use App\Container\Carpark\src\Estados;
use App\Container\Carpark\src\Usuarios;
use App\Container\Carpark\src\Motos;
use App\Container\Carpark\src\Ingresos;
use App\Container\Carpark\src\Historiales;
use Illuminate\Support\Facades\Storage;
use App\Container\Overall\Src\Facades\UploadFile;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class UsuariosController extends Controller
{
    /**
     * Muestra todos los empleados registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carpark.usuarios.TablaUsuarios');

    }

    /**
     * Muestra todos los usuarios registradas por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('carpark.usuarios.ajaxTablaUsuarios');
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
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $listaDependencias = Dependencias::all();
            return view('carpark.usuarios.registroUsuario',
                [
                    'listaDependencias' => $listaDependencias,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function listarDependencias(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $dependencias = Dependencias::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $dependencias
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function listarEstados(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $estados = Estados::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $estados
            );
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }

    /**
     * Función que almacena en la base de datos un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $verificiaruser = Usuarios::find($request['PK_CU_Codigo']);
            if (empty($verificiaruser)) {

                $img = $request->file('CU_UrlFoto');
                $url = Storage::disk('developer')->putFile('carpark/usuarios', $img);
                $url = "developer/" . $url;


                Usuarios::create([
                    'PK_CU_Codigo' => $request['PK_CU_Codigo'],
                    'CU_Cedula' => $request['CU_Cedula'],
                    'CU_Nombre1' => $request['CU_Nombre1'],
                    'CU_Nombre2' => $request['CU_Nombre2'],
                    'CU_Apellido1' => $request['CU_Apellido1'],
                    'CU_Apellido2' => $request['CU_Apellido2'],
                    'CU_Telefono' => $request['CU_Telefono'],
                    'CU_Correo' => $request['CU_Correo'],
                    'CU_Direccion' => $request['CU_Direccion'],
                    'CU_UrlFoto' => $url,
                    'FK_CU_IdDependencia' => $request['FK_CU_IdDependencia'],
                    'FK_CU_IdEstado' => $request['FK_CU_IdEstado'],
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

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Presenta el formulario con los datos para editar el regitro de un usuario deseado.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $infoUsuario = Usuarios::find($id);
            return view('carpark.usuarios.editarUsuario',
                [
                    'infoUsuario' => $infoUsuario,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Se realiza la actualización de los datos de un usuario.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $usuario = Usuarios::find($request['PK_CU_Codigo']);
            $usuario->fill($request->all());
            $usuario->save();
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
     * Se realiza la actualización de la foto de perfil de un usuario.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function updateFotoUsuario(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $img = $request->file('CU_UrlFoto');
            $url = Storage::disk('developer')->putFile('carpark/usuarios', $img);
            $url = "developer/" . $url;

            $usuariosPK = Usuarios::find($id);
            $usuariosPK->CU_UrlFoto = $url;
            $usuariosPK->save();
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
     * Se realiza la eliminación de los registros de un usuario.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $Infomoto = Usuarios::with('relacionUsuariosMotos')->where('PK_CU_Codigo', $id)->get();

            if (null === $Infomoto[0]['relacionUsuariosMotos']) {
                Usuarios::destroy($id);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos eliminados correctamente del usuario.'
                );
            }

            for ($i = 0; $i < sizeof($Infomoto[0]['relacionUsuariosMotos']); $i++) {
                Motos::destroy($Infomoto[0]['relacionUsuariosMotos'][$i]['PK_CM_IdMoto']);
            }

            Usuarios::destroy($id);
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
     * Muestra el perfil de un usuario especifico.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function verPerfil(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $infoUsuario = Usuarios::with('relacionUsuariosDependencia', 'relacionUsuariosEstado')->where('PK_CU_Codigo', $id)->get();
            return view('carpark.usuarios.perfilUsuario',
                [
                    'infoUsuario' => $infoUsuario,
                ]);
        } else {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

}
