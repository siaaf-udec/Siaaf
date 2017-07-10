<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 19/06/2017
 * Time: 2:20 PM
 */

namespace App\Container\Humtalent\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Persona;
use App\Container\Humtalent\src\DocumentacionPersona;
use App\Container\Humtalent\src\StatusOfDocument;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{

    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$empleados = Persona::all();
        return view('humtalent.empleado.tablasEmpleados');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('humtalent.empleado.registroEmpleado');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Persona::create([
            'PK_PRSN_Cedula'          => $request['PK_PRSN_Cedula' ],
            'PRSN_Rol'                => $request['PRSN_Rol'],
            'PRSN_Nombres'            => $request['PRSN_Nombres'],
            'PRSN_Apellidos'          => $request['PRSN_Apellidos'],
            'PRSN_Telefono'           => $request['PRSN_Telefono'],
            'PRSN_Correo'             => $request['PRSN_Correo'],
            'PRSN_Direccion'          => $request['PRSN_Direccion'],
            'PRSN_Ciudad'             => $request['PRSN_Ciudad'],
            'PRSN_Eps'                => $request['PRSN_Eps'],
            'PRSN_Fpensiones'         => $request['PRSN_Fpensiones'],
            'PRSN_Area'               => $request['PRSN_Area'],
            'PRSN_Caja_Compensacion'  => $request['PRSN_Caja_Compensacion'],
            'PRSN_Estado_Persona'     => $request['PRSN_Estado_Persona'],
        ]);
        
        return back()->with('success','El empleado fue registrado correctamente');

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
    public function edit($id)
    {
        $empleado = Persona::find($id);
        return view('humtalent.empleado.editarEmpleado', compact('empleado'));
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
        $empleado= Persona::find($id);
        $empleado->fill($request->all());
        //$empleado-> PRSN_Rol = $request['PRSN_Rol'];
        //$empleado-> PRSN_Estado_Persona = $request['PRSN_Estado_Persona'];
        $empleado->save();
        return back()->with('success','El empleado fue actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Persona::destroy($id);
        return('El empleado fue eliminado correctamente');
    }

}