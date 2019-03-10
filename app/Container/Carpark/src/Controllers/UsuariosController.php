<?php

namespace App\Container\Carpark\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Yajra\DataTables\DataTables;
use App\Container\Carpark\src\Dependencias;
use App\Container\Carpark\src\Estados;
use App\Container\Carpark\src\Usuarios;
use App\Container\Users\src\UsersUdec;
use App\Container\Carpark\src\Ingresos;
use App\Container\Carpark\src\Motos;
use Illuminate\Support\Facades\Storage;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use App\Container\Users\src\Controllers\UsersUdecController;

class UsuariosController extends UsersUdecController
{
    /**
     * Muestra todos los usuarios registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carpark.usuarios.tablaUsuarios');

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
     * Función que muestra el formulario de registro de un nuevo usuario.
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

    //ruta para crear usuarios usando la camara

    public function create2(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $listaDependencias = Dependencias::all();
            return view('carpark.usuarios.registroUsuario2',
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
     * Muestra la lista de dependencias registradas para el select del registro.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
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
     *  Muestra la lista de estados registrados para el select del registro.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
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
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $documento=(string)$request['CU_Cedula'];

            if($request['PK_CU_Codigo']==null){
                $request['PK_CU_Codigo']=$request['CU_Cedula'];

           }

            $verificiaruser = Usuarios::find($request['PK_CU_Codigo']); //validar codigo repetido en usuarios carpark
            $verificiarusercedula = Usuarios::where('CU_Cedula','=',$request['CU_Cedula'])->first();//validar cedula en usuarios carpark
            $verificarUserUdec= UsersUdec::find($documento);//validar cedula en user_udec
          
            
            if (is_null($verificiarusercedula) && empty($verificiaruser)){

                    if (is_null($verificarUserUdec) ) {
                        
                        $perfil=Dependencias::where('PK_CD_IdDependencia', $request['FK_CU_IdDependencia'])->first();


                        UsersUdec::create([

                            'number_document' => $documento,
                            'code' => $request['PK_CU_Codigo'],
                            'username' => $request['CU_Nombre1'],               
                            'lastname' => $request['CU_Apellido1'],
                            'type_user'=>$perfil['CD_Dependencia'],
                            'number_phone' => $request['CU_Telefono'],
                            'place'=>"Facatativá",
                            'email' => $request['CU_Correo'],
                            
                        ]);


                    }
        

            
                if (empty($verificiaruser)) {

                    $img = $request->file('CU_UrlFoto');
                    $url = Storage::disk('developer')->putFile('carpark/usuarios', $img);
                    $url = "developer/" . $url;


                    Usuarios::create([
                        'PK_CU_Codigo' => $request['PK_CU_Codigo'],
                        'CU_Cedula' => $request['CU_Cedula'],
                        'CU_Nombre1' => $request['CU_Nombre1'],
                        'CU_Apellido1' => $request['CU_Apellido1'],
                        'CU_Telefono' => $request['CU_Telefono'],
                        'CU_Correo' => $request['CU_Correo'],
                        'CU_Direccion' => $request['CU_Direccion'],
                        'CU_UrlFoto' => $url,
                        'FK_CU_IdDependencia' => $request['FK_CU_IdDependencia'],
                        'FK_CU_IdEstado' => $request['FK_CU_IdEstado'],
                    ]);


                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos creados en Usuarios'
                    );
                }
                else{
                    $IdError = 422;
                    return AjaxResponse::success(
                        '¡Lo sentimos!',
                        'No se pudo completar tu solicitud, el código ya está registrado.',
                        $IdError
                    );
                }
        }



            $IdError = 422;
            return AjaxResponse::success(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud, la cedula o el codigo ya está registrado.',
                $IdError
            );

        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Presenta el formulario con los datos para editar el regitro de un usuario deseado.
     *0
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
           
            $infoUsuario = Usuarios::find($id);
           // $infoUsuario=Usuarios::all()->first();
            
           //$infoUsuario=Usuarios::all()->where('CU_Cedula',$id)->get();

           
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
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $usuario = Usuarios::find($request['PK_CU_Codigo']);
            $usuario->fill($request->all());
            $usuario->save();

            
            $documento=(string)$request['CU_Cedula'];
             $perfil=Dependencias::where('PK_CD_IdDependencia', $request['FK_CU_IdDependencia'])->first();

            $userudec=UsersUdec::find($documento);
            $userudec->fill([

                'number_document' => $documento,
                'code' => $request['PK_CU_Codigo'],
                'username' => $request['CU_Nombre1'],                    
                'lastname' => $request['CU_Apellido1'],
                'type_user'=>$perfil['CD_Dependencia'],
                'number_phone' => $request['CU_Telefono'],
                'email' => $request['CU_Correo'],

            ]);

            $userudec->save();



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
     * @param  int $id
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
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
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {

            $infoIngresos = Ingresos::where('CI_CodigoUser','=',$id)->delete();            

            $infoMoto = Usuarios::with('relacionUsuariosMotos')->where('PK_CU_Codigo', $id)->get();

            if (null === $infoMoto[0]['relacionUsuariosMotos']) {
                Usuarios::destroy($id);
                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Datos eliminados correctamente del usuario.'
                );
            }

            for ($i = 0; $i < sizeof($infoMoto[0]['relacionUsuariosMotos']); $i++) {
                Motos::destroy($infoMoto[0]['relacionUsuariosMotos'][$i]['PK_CM_IdMoto']);
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
     * @param  \Illuminate\Http\Request $request
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
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }



      public function data2(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {

            //$user = UsersUdec::query();
            $user2=Usuarios::query();
            //$user3=UsersUdec::has('relacionUsersUdecUsuarios')->get();
           

            return DataTables::of($user2)
                ->removeColumn('company')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->removeColumn('deleted_at')
                
                ->addColumn('CU_Perfil', function ($user2) {
                    $perfil=Dependencias::where('PK_CD_IdDependencia', $user2->FK_CU_IdDependencia)->first();
                    return $perfil['CD_Dependencia'];
                     
                })//agregar columna a datatable, agregar informacion a esa columna nueva
                ->addIndexColumn()
                ->make(true);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }


}
