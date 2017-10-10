<?php

namespace App\Container\gesap\src\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Validator;
use Yajra\DataTables\DataTables;

use Illuminate\Http\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Overall\Src\Facades\UploadFile;

use App\Container\Users\Src\Interfaces\UserInterface;
use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;

class StudentController extends Controller
{
       
    private $path='gesap.Estudiante.';
    protected $connection = 'gesap';
        
    /*
     * Listado de proyectos asignados como estudiantes
     *
     * @return \Illuminate\Http\Response
     */
    public function proyecto()
    {
        return view($this->path.'ProyectList');
    }
    
    /*
    * Consulta de proyectos con sus datos correspondientes asignados al usuario actual como estudiante
    *
    * @param  \Illuminate\Http\Request 
    *
    * @return Yajra\DataTables\DataTables
    */
    public function studentList(Request $request)
    {
        $anteproyectos = Anteproyecto::from('TBL_Anteproyecto AS A')->distinct()
            ->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2', 'conceptofinal',
                   'encargados' => function ($encargados) use ($request) {
                        $encargados->where(function ($query) {
                            $query->where('E.NCRD_Cargo', '=', "Estudiante 1")  ;
                            $query->orwhere('E.NCRD_Cargo', '=', "Estudiante 2");
                        });
                        $encargados->where('FK_developer_user_id', '=', $request->user()->id);
            }])
            ->get();
        return Datatables::of($anteproyectos)->addIndexColumn()->make(true);
    }
}
