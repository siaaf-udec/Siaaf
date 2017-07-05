<?php
/**
 * Created by PhpStorm.
 * User: Yeison Gomez
 * Date: 24/06/2017
 * Time: 6:18 PM
 */

namespace App\Container\Humtalent\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Humtalent\src\Persona;

class accionEmpController extends Controller
{
    public function listarDocentes()
    {
        $rol='Docente';
        $empleados = Persona::where('PRSN_Rol',$rol)->get();
        return view('humtalent.empleado.listaEmpleados', compact('empleados'));
    }
    public function listarFuncionarios()
    {
        $rol='Administrativo';
        $empleados = Persona::where('PRSN_Rol',$rol)->get();
        return view('humtalent.empleado.listaEmpleados', compact('empleados'));
    }

    public function consultarByCedula(){
        return view('humtalent.empleado.consultaEmpleado');
    }
    public function buscarByCedula(Request $request){
        $id  = $request['PK_PRSN_Cedula'];
        $empleados = Persona::where('PK_PRSN_Cedula',$id)->get();
        return view('humtalent.empleado.listaEmpleados', compact('empleados'));
    }
}