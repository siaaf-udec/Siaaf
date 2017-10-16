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
use App\Container\gesap\src\Documentos;
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
     * Formulario para subir las actividades del proyecto
     *
     * @param  int $id 
     * @param  \Illuminate\Http\Request 
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function actividad($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')){
            $anteproyecto=Anteproyecto::select('*')
                    ->where('PK_NPRY_IdMinr008', '=', $id)
                    ->with(['radicacion',
                            'proyecto' => function ($proyecto) {
                                $proyecto->with('documentos');
                            }])
                    ->get();
            
            return view($this->path.'Actividades', [
                'id' => $id,
                'anteproyecto' => $anteproyecto
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
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
        $anteproyectos = Encargados::where(function ($query) {
                            $query->where('NCRD_Cargo', '=', "Estudiante 1")  ;
                            $query->orwhere('NCRD_Cargo', '=', "Estudiante 2");
                        })
                        ->where('FK_Developer_User_Id', '=', $request->user()->id)
                        ->with(['anteproyecto' => function ($proyecto) {
                            $proyecto->with(['radicacion', 'director', 'jurado1', 'jurado2', 'estudiante1', 'estudiante2','conceptoFinal','proyecto']);
                        }])
                        ->get();
        
        return Datatables::of($anteproyectos)->addColumn('NPRY_Estado', function ($users){
                    if(!strcmp($users->anteproyecto->NPRY_Estado, 'EN REVISION')){
                        return "<span class='label label-sm label-warning'>".$users->anteproyecto->NPRY_Estado. "</span>";
                    }else
                        if (!strcmp($users->anteproyecto->NPRY_Estado, 'PENDIENTE')){
                            return "<span class='label label-sm label-warning'>".$users->anteproyecto->NPRY_Estado. "</span>";
                        }else{
                            if (!strcmp($users->anteproyecto->NPRY_Estado, 'APROBADO')){
                                return "<span class='label label-sm label-success'>".$users->anteproyecto->NPRY_Estado. "</span>";
                            }else{
                                if (!strcmp($users->anteproyecto->NPRY_Estado, 'APLAZADO')){
                                    return "<span class='label label-sm label-danger'>".$users->anteproyecto->NPRY_Estado. "</span>";
                                }else{
                                    if (!strcmp($users->anteproyecto->NPRY_Estado, 'RECHAZADO')){
                                        return "<span class='label label-sm label-danger'>".$users->anteproyecto->NPRY_Estado. "</span>";
                                    }else{
                                        if (!strcmp($users->anteproyecto->NPRY_Estado, 'COMPLETADO')){
                                            return "<span class='label label-sm label-success'>".$users->anteproyecto->NPRY_Estado. "</span>";
                                        }else{
                                            return "<span class='label label-sm label-info'>".$users->anteproyecto->NPRY_Estado. "</span>";
                                        }   
                                    }
                                    
                                }
                                
                            }
                        }
                })
                ->rawColumns(['NPRY_Estado'])
                ->addIndexColumn()->make(true);
    }
}
