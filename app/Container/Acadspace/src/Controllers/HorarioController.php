<?php
namespace App\Container\Acadspace\src\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\Acadspace\src\Estudiantes;
use App\Container\Acadspace\src\Solicitud;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{

    public function index()
    {
        return view('acadspace.controlEstudiante');
    }

}
?>