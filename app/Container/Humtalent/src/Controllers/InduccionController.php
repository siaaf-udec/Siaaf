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
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class InduccionController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listarEmpleadosNuevos(Request $request){
        if ($request->ajax()) {
            return Datatables::of(Persona::where('PRSN_Estado_Persona', 'Nuevo')->get())
                ->addIndexColumn()
                ->make(true);
        } else {
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
    public function index($id)//muestra todos los empleados registrados
    {
        $procesoInduccion=Induction::where('FK_TBL_Persona_Cedula',$id)->get(['INDC_ProcesoInduccion']);
        if(count($procesoInduccion)>0) {
            foreach ($procesoInduccion as $value) {
                $proceso = $value->INDC_ProcesoInduccion;
            }
        }else{
            $proceso='Inicio';
        }
        return view('humtalent.inducciones.procesoInduccion', compact('id', 'proceso'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//muestra el formulario de registro de un nuevo empleado
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $induccion=Induction::where('FK_TBL_Persona_Cedula',$request['FK_TBL_Persona_Cedula'])->get(['PK_INDC_ID_Induccion']);
        if(count($induccion) > 0){
            $induccion=Induction::find($induccion[0]['PK_INDC_ID_Induccion']);
            $induccion->INDC_ProcesoInduccion = $request[$request['numCheck']];
            $induccion->save();
            if(strcasecmp( $request[$request['numCheck']], "Resultados de evaluación") == 0){
                $empleado=Persona::find($request['FK_TBL_Persona_Cedula']);
                $empleado->PRSN_Estado_Persona="Antiguo";
                $empleado->save();
            }
        }else {
            Induction::create([
                'INDC_ProcesoInduccion' => $request[$request['numCheck']],
                'FK_TBL_Persona_Cedula' => $request['FK_TBL_Persona_Cedula'],
            ]);
        }
        $notification=array(
            'message'=>'El proceso de inducción fue almacenado correctamente',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //return "en el show";
        // return view('humtalent.empleado.consultaEmpleado');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//presenta el formulario con los datos para editar el regitro de un empleado deseado
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)//re realiza la actualización de los datos
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)//se realiza la eliminación de un registro de empleado en caso de que asi se desee
    {

    }
}