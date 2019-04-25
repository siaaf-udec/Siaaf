<?php

namespace App\Container\CalidadPcs\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Container\CalidadPcs\src\Proyectos;
use App\Container\CalidadPcs\src\Usuarios;
use App\Container\CalidadPcs\src\EquipoScrum;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ProyectosController extends Controller
{
     /**
     * Muestra todos los proyectos registrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calidadpcs.proyectos.tablaProyectos');

    }

    /**
     * Muestra todos los proyectos registrados por medio de una petición ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('calidadpcs.proyectos.ajaxTablaProyectos'); 
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

     /**
     * Función que consulta los proyectos registrados y los envía al datatable correspondiente.
     *
     * @param  \Illuminate\Http\Request
     * @return \Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function tablaProyectos(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return Datatables::of(Proyectos::where('FK_CP_Id_Usuario',Auth::user()->id)->get())
                ->addIndexColumn()
                ->make(true);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Función que muestra el formulario de registro de un nuevo proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function create(Request $request, $id)//
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view('calidadpcs.proyectos.registrarNuevoProyecto',
                [
                    'codigoUsuario' => $id,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /**
     * Función que almacena en la base de datos un nuevo proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            //$verificarnombre=Proyectos::where('CP_nombre_proyecto','LIKE',strtoupper($request['CP_nombre_proyecto']))->get(); //VALIDAR QUE LA PLACA NO EXISTA
            $verificarId=Usuarios::where('PK_CU_Id_Usuario','LIKE',strtoupper($request['PK_CU_Id_Usuario']))->get(); //VALIDAR QUE LA PLACA NO EXISTA
            
            if ($verificarId == '[]') {

                Usuarios::create([
                    'PK_CU_Id_Usuario' => $request['PK_CU_Id_Usuario'],
                    'CU_Cedula' => $request['CU_Cedula'],
                    'CU_Nombre' => $request['CU_Nombre'],
                    'CU_Apellido' => $request['CU_Apellido'],
                    'CU_Telefono' => $request['CU_Telefono'],
                    'CU_Correo' => $request['CU_Correo'],
                ]);
                $verificarnombre=Proyectos::where('CP_Nombre_Proyecto','LIKE',strtoupper($request['CP_Nombre_Proyecto']))->get(); 
                if($verificarnombre == '[]'){
                    Proyectos::create([
                        'CP_Nombre_Proyecto' => $request['CP_Nombre_Proyecto'],
                        'CP_Fecha_Inicio' => $request['CP_Fecha_Inicio'],
                        'CP_Fecha_Final' => $request['CP_Fecha_Final'],
                        'FK_CP_Id_Usuario' => $request['FK_CP_Id_Usuario'],
                    ]);

                    $proyecto = Proyectos::where('CP_Nombre_Proyecto',$request['CP_Nombre_Proyecto'])->first();
                    $id= $proyecto->PK_CP_Id_Proyecto;
                    //Primer rol
                    EquipoScrum::create([
                        'CE_Nombre_Persona' => $request['CE_Nombre_1'],
                        'FK_CE_Id_Rol' => 1,
                        'FK_CE_Id_Proyecto' => $id,
                    ]);
                    //Segundo rol
                    EquipoScrum::create([
                        'CE_Nombre_Persona' => $request['CE_Nombre_2'],
                        'FK_CE_Id_Rol' => 2,
                        'FK_CE_Id_Proyecto' => $id,
                    ]);
                    //Tercer rol
                    EquipoScrum::create([
                        'CE_Nombre_Persona' => $request['CE_Nombre_3'],
                        'FK_CE_Id_Rol' => 3,
                        'FK_CE_Id_Proyecto' => $id,
                    ]);
                    //Cuarto rol
                    EquipoScrum::create([
                        'CE_Nombre_Persona' => $request['CE_Nombre_4'],
                        'FK_CE_Id_Rol' => 4,
                        'FK_CE_Id_Proyecto' => $id,
                    ]);
                    //Quinto rol
                    EquipoScrum::create([
                        'CE_Nombre_Persona' => $request['CE_Nombre_5'],
                        'FK_CE_Id_Rol' => 5,
                        'FK_CE_Id_Proyecto' => $id,
                    ]);
                    //Sexto rol
                    EquipoScrum::create([
                        'CE_Nombre_Persona' => $request['CE_Nombre_6'],
                        'FK_CE_Id_Rol' => 5,
                        'FK_CE_Id_Proyecto' => $id,
                    ]);
                    if($request['CE_Nombre_7'] == ''){

                    }else{
                        //Septimo rol opcional
                        EquipoScrum::create([
                            'CE_Nombre_Persona' => $request['CE_Nombre_7'],
                            'FK_CE_Id_Rol' => 5,
                            'FK_CE_Id_Proyecto' => $id,
                        ]);
                    }
                    if($request['CE_Nombre_8'] == ''){

                    }else{
                        //Octavo rol - opcional 
                        EquipoScrum::create([
                            'CE_Nombre_Persona' => $request['CE_Nombre_8'],
                            'FK_CE_Id_Rol' => 5,
                            'FK_CE_Id_Proyecto' => $id,
                        ]);
                    }
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos almacenados correctamente. '
                    );
                }
                $IdError = 422;
                return AjaxResponse::success(
                '¡Lo sentimos!',
                'No se pudo completar la solicitud, ya se encuentra registrado un proyecto con el mismo nombre.',
                $IdError
                );
            }else{
                $verificarnombre=Proyectos::where('CP_Nombre_Proyecto','LIKE',strtoupper($request['CP_Nombre_Proyecto']))->get(); 
                if($verificarnombre == '[]'){
                    Proyectos::create([
                        'CP_Nombre_Proyecto' => $request['CP_Nombre_Proyecto'],
                        'CP_Fecha_Inicio' => $request['CP_Fecha_Inicio'],
                        'CP_Fecha_Final' => $request['CP_Fecha_Final'],
                        'FK_CP_Id_Usuario' => $request['FK_CP_Id_Usuario'],
                    ]);
                    $proyecto = Proyectos::where('CP_Nombre_Proyecto',$request['CP_Nombre_Proyecto'])->first();
                    $id= $proyecto->PK_CP_Id_Proyecto;
                        //Primer rol
                    EquipoScrum::create([
                            'CE_Nombre_Persona' => $request['CE_Nombre_1'],
                            'FK_CE_Id_Rol' => 1,
                            'FK_CE_Id_Proyecto' => $id,
                    ]);
                        //Segundo rol
                    EquipoScrum::create([
                            'CE_Nombre_Persona' => $request['CE_Nombre_2'],
                            'FK_CE_Id_Rol' => 2,
                            'FK_CE_Id_Proyecto' => $id,
                    ]);
                        //Tercer rol
                    EquipoScrum::create([
                            'CE_Nombre_Persona' => $request['CE_Nombre_3'],
                            'FK_CE_Id_Rol' => 3,
                            'FK_CE_Id_Proyecto' => $id,
                    ]);
                        //Cuarto rol
                    EquipoScrum::create([
                            'CE_Nombre_Persona' => $request['CE_Nombre_4'],
                            'FK_CE_Id_Rol' => 4,
                            'FK_CE_Id_Proyecto' => $id,
                    ]);
                    //Quinto rol
                    EquipoScrum::create([
                        'CE_Nombre_Persona' => $request['CE_Nombre_5'],
                        'FK_CE_Id_Rol' => 5,
                        'FK_CE_Id_Proyecto' => $id,
                    ]);
                    //Sexto rol
                    EquipoScrum::create([
                        'CE_Nombre_Persona' => $request['CE_Nombre_6'],
                        'FK_CE_Id_Rol' => 5,
                        'FK_CE_Id_Proyecto' => $id,
                    ]);
                    if($request['CE_Nombre_7'] == ''){
                        EquipoScrum::create([
                            'CE_Nombre_Persona' => ' ',
                            'FK_CE_Id_Rol' => 5,
                            'FK_CE_Id_Proyecto' => $id,
                        ]);
                    }else{
                        //Septimo rol opcional
                        EquipoScrum::create([
                            'CE_Nombre_Persona' => $request['CE_Nombre_7'],
                            'FK_CE_Id_Rol' => 5,
                            'FK_CE_Id_Proyecto' => $id,
                        ]);
                    }
                    if($request['CE_Nombre_8'] == ''){
                        EquipoScrum::create([
                            'CE_Nombre_Persona' => ' ',
                            'FK_CE_Id_Rol' => 5,
                            'FK_CE_Id_Proyecto' => $id,
                        ]);
                    }else{
                        //Octavo rol - opcional 
                        EquipoScrum::create([
                            'CE_Nombre_Persona' => $request['CE_Nombre_8'],
                            'FK_CE_Id_Rol' => 5,
                            'FK_CE_Id_Proyecto' => $id,
                        ]);
                    }
                    return AjaxResponse::success(
                        '¡Bien hecho!',
                        'Datos almacenados correctamente.'
                    );
                }
                $IdError = 422;
                return AjaxResponse::success(
                    '¡Lo sentimos!',
                    'No se pudo completar la solicitud, ya se encuentra registrado un proyecto con el mismo nombre.',
                    $IdError
                );
            }
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Presenta el formulario con los datos para editar el regitro de un proyecto deseado.
     *0
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit(Request $request, $id)
    { 
        if ($request->ajax() && $request->isMethod('GET')) {
           
            $infoProyecto = Proyectos::find($id);
            $infoEquipoScrum = EquipoScrum::where('FK_CE_Id_Proyecto',$id)->get();
                      
            return view('calidadpcs.proyectos.editarProyectos',
                [
                    'infoProyecto' => $infoProyecto,
                    'infoEquipoScrum' => $infoEquipoScrum,
                ]);
        }

        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );

    }

    /**
     * Se realiza la actualización de los datos de un proyecto.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {

            $proyecto = Proyectos::find($request['PK_CP_Id_Proyecto']);
            $proyecto->fill([
                'CP_Fecha_Final' => $request['CP_Fecha_Final'],
            ]);
            $proyecto->save();

            //Tabla equipo scrum

            $EquipoScrum = EquipoScrum::where('FK_CE_Id_Proyecto',$request['FK_CE_Id_Proyecto'])->get();
            
            $Rol1 = $EquipoScrum[0];
            $Rol1 -> fill([
                'CE_Nombre_Persona' => $request['CE_Nombre_1'],
            ]);
            $Rol1->save();

            $Rol2 = $EquipoScrum[1];
            $Rol2 -> fill([
                'CE_Nombre_Persona' => $request['CE_Nombre_2'],
            ]);
            $Rol2 -> save();

            $Rol3 = $EquipoScrum[2];
            $Rol3 -> fill([
                'CE_Nombre_Persona' => $request['CE_Nombre_3'],
            ]);
            $Rol3 -> save();

            $Rol4 = $EquipoScrum[3];
            $Rol4 -> fill([
                'CE_Nombre_Persona' => $request['CE_Nombre_4'],
            ]);
            $Rol4 -> save();

            $Rol5 = $EquipoScrum[4];
            $Rol5 -> fill([
                'CE_Nombre_Persona' => $request['CE_Nombre_5'],
            ]);
            $Rol5 -> save();

            $Rol6 = $EquipoScrum[5];
            $Rol6 -> fill([
                'CE_Nombre_Persona' => $request['CE_Nombre_6'],
            ]);
            $Rol6 -> save();

            $Rol7 = $EquipoScrum[6];
            $Rol7 -> fill([
                'CE_Nombre_Persona' => $request['CE_Nombre_7'],
            ]);
            $Rol7 -> save();

            $Rol8 = $EquipoScrum[7];
            $Rol8 -> fill([
                'CE_Nombre_Persona' => $request['CE_Nombre_8'],
            ]);
            $Rol8 -> save();

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
}
