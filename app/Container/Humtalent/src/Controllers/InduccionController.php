<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 20/07/2017
 * Time: 9:57 PM
 */

namespace App\Container\Humtalent\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\Induction;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Container\Overall\Src\Facades\AjaxResponse;

class InduccionController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listarEmpleadosNuevos(Request $request)
    {
        if ($request->ajax())
        {
            return DataTables::of(Persona::where('PRSN_Estado_Persona', 'Nuevo')->get())
                ->addIndexColumn()
                ->make(true);
        }
        else
        {
            return response()->json([
                'message' => 'Incorrect request',
                'code' => 412
            ], 412);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            $procesoInduccion = Induction::where('FK_TBL_Persona_Cedula', $id)->get(['INDC_ProcesoInduccion']);
            if (count($procesoInduccion) > 0)
            {
                foreach ($procesoInduccion as $value)
                {
                    $proceso = $value->INDC_ProcesoInduccion;
                }
            }
            else
            {
                $proceso = 'Inicio';
            }
            return view('humtalent.inducciones.procesoInduccion', compact('id', 'proceso'));
        }
        else{
            return AjaxResponse::fail(
                '¡Lo sentimos!',
                'No se pudo completar tu solicitud.'
            );
        }
    }
    /**
     *
     */
    public function ajaxEmpleadosNuevos (Request $request)
    {
        if($request->ajax() && $request->isMethod('GET'))
        {
            return view('humtalent.inducciones.ajaxTablaEmpleadosNuevos');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        if($request->ajax() && $request->isMethod('POST'))
        {
            $induccion = Induction::where('FK_TBL_Persona_Cedula', $request['FK_TBL_Persona_Cedula'])
                       ->get(['PK_INDC_ID_Induccion']);
            if (count($induccion) > 0)
            {
                $induccion = Induction::find($induccion[0]['PK_INDC_ID_Induccion']);
                $induccion->INDC_ProcesoInduccion = $request[$request['numCheck']];
                $induccion->save();
                if (strcasecmp($request[$request['numCheck']], "Resultados de evaluación") == 0)
                {
                    $empleado = Persona::find($request['FK_TBL_Persona_Cedula']);
                    $empleado->PRSN_Estado_Persona = "Antiguo";
                    $empleado->save();
                }
            }
            else
            {
                Induction::create([
                    'INDC_ProcesoInduccion' => $request[$request['numCheck']],
                    'FK_TBL_Persona_Cedula' => $request['FK_TBL_Persona_Cedula'],
                ]);
            }
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
}