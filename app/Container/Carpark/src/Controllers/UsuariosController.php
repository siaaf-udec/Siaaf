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
        return view('carpark.usuarios.tablaUsuarios');
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
            $listaDependencias = Dependencias::all();
            return view('carpark.usuarios.registroUsuario',
                [
                    'listaDependencias' =>  $listaDependencias,
                ]);
        }
        else
        {
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
    public function listarDependencias(Request $request)
    {
        if($request->ajax() && $request->isMethod('GET')){
            $dependencias = Dependencias::all();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos consultados correctamente.',
                $dependencias
            );
        }else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }

    }

    /**
     * Función que almacena en la base de datos un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)//
    {
        if ($request->ajax() && $request->isMethod('POST'))
        {
            $verificiaruser = Usuarios::find($request['PK_CU_Codigo' ]);
            if( empty($verificiaruser )) 
            {
                
                $img = $request->file('CU_UrlFoto');
                $url = Storage::disk('developer')->putFile('carpark/usuarios', $img);
                $url = "developer/".$url;


                Usuarios::create([
                    'PK_CU_Codigo'          => $request['PK_CU_Codigo'],
                    'CU_Cedula'             => $request['CU_Cedula'],
                    'CU_Nombre1'            => $request['CU_Nombre1'],
                    'CU_Nombre2'            => $request['CU_Nombre2'],               
                    'CU_Apellido1'          => $request['CU_Apellido1'],
                    'CU_Apellido2'          => $request['CU_Apellido2'],
                    'CU_Telefono'           => $request['CU_Telefono'],                
                    'CU_Correo'             => $request['CU_Correo'],
                    'CU_Direccion'          => $request['CU_Direccion'],
                    'CU_UrlFoto'            => $url,
                    'FK_CU_IdDependencia'   => $request['FK_CU_IdDependencia'],
                    'FK_CU_IdEstado'        => $request['FK_CU_IdEstado'],                            
                ]);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos almacenados correctamente.'
                );                
            }
            else
            {
                return AjaxResponse::fail(
                    '¡Lo sentimos!',
                    'No se pudo completar tu solicitud.'
                );
            }
        }
        else
        {
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
     * Presenta el formulario con los datos para editar el regitro de un usuario deseado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit (Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            $infoUsuario = Usuarios::find($id);
            $infoDependencia = Usuarios::find($id)->FunDependencias;
            $infoEstado = Usuarios::find($id)->FunEstados;
            return view('carpark.usuarios.editarUsuario',
                [
                    'infoUsuario'     => $infoUsuario,
                    'infoDependencia' => $infoDependencia,
                    'infoEstado'      => $infoEstado,
                ]);
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Se realiza la actualización de los datos de un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update (Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {            
            $usuario = Usuarios::find($request['PK_CU_Codigo']);
            $usuario->fill($request->all());
            $usuario->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Se realiza la actualización de la foto de perfil de un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateFotoUsuario(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $img = $request->file('CU_UrlFoto');
            $url = Storage::disk('developer')->putFile('carpark/usuarios', $img);
            $url = "developer/".$url;

            $usuariosPK = Usuarios::find($id);
            $usuariosPK ->CU_UrlFoto = $url;
            $usuariosPK ->save();
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos modificados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Se realiza la eliminación de los registros de un usuario.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('DELETE'))
        {
            
            $Infomoto = Usuarios::with('FunBuscarMotos')->where('PK_CU_Codigo',$id)->get();

            if(is_null($Infomoto[0]['FunBuscarMotos']))
            {
                Usuarios::destroy($id);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos eliminados correctamente del usuario.'
                );
            }else{                
         
                for ($i=0; $i < sizeof($Infomoto[0]['FunBuscarMotos']); $i++) 
                { 
                    Motos::destroy($Infomoto[0]['FunBuscarMotos'][$i]['PK_CM_IdMoto']);                  
                }
                Usuarios::destroy($id);            

            }
            return AjaxResponse::success(
                '¡Bien hecho!',
                'Datos eliminados correctamente.'
            );
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

    /**
     * Muestra el perfil de un usuario especifico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verPerfil(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            $infoUsuario = Usuarios::find($id);
            $infoDependencia = Usuarios::find($id)->FunDependencias;
            $infoEstado = Usuarios::find($id)->FunEstados;
            return view('carpark.usuarios.perfilUsuario',
                [
                    'infoUsuario'     => $infoUsuario,
                    'infoDependencia' => $infoDependencia,
                    'infoEstado'      => $infoEstado,
                ]);
        }
        else
        {
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }

}
