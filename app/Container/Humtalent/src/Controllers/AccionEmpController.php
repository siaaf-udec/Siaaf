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
    public function listar()
    {
        $empleados = Persona::all();

        return view('humtalent.empleado.listaEmpleados', compact('empleados'));
    }

    public function consultarById(){
        return "consultando por cedula";
    }
}