<?php
/**
 * Created by PhpStorm.
 * User: Edwin Clavijo
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Acadspace\src\solFormatAcad;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Facades\Validator;

class solFormAcadController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = solFormatAcad::all();
        $solicitudes = solFormatAcad::paginate(10);
        // return view('usuario.mostrarUsuario', compact('usuarios'));
        /* $estado=0;
         $sol = solFormatAcad::where('SOL_estado',$estado)->get();*/
        return view('acadspace.FormatosAcademicos.mostrarSolicitudesFormAcad', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('acadspace.FormatosAcademicos.registroSolicitudFormAcad');
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


            solFormatAcad::create([
                    'titulo_doc' => $request['titulo'],
                    'descripcion_doc' => $request['descripcion'],
                    'nombre_doc' => $request['file'],
                    'id_secretaria' => 3,
                    'estado' => 0
                ]);

                return AjaxResponse::success(
                    '¡Bien hecho!',
                    'Solicitud registrada correctamente.'
                );

        }else{
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $empleado = Solicitud::find($id);
            $empleado->SOL_estado = 1;
            $empleado->save();
            return back()->with('success','La solicitud fue aprobada correctamente');

        //return view('humtalent.empleado.editarEmpleado', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $empleado = Solicitud::find($id);
        $empleado->SOL_estado = 2;
        $empleado->save();
        return back()->with('success','La solicitud fue rechazada correctamente');
        //return view('humtalent.empleado.editarEmpleado', compact('empleado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function descargar_publicacion($id){

        $solicitudess= solFormatAcad::find($id);
        $rutaarchivo= "../storage/app/".$solicitudess->nombre_doc;
        return response()->download($rutaarchivo);

    }
}