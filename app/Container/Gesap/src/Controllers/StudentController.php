<?php
namespace App\Container\Gesap\src\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Yajra\DataTables\DataTables;
use Exception;
use Validator;
use Carbon\Carbon;


use App\Container\Overall\Src\Facades\AjaxResponse;
use App\Container\Overall\Src\Facades\UploadFile;

use App\Container\Gesap\src\Anteproyecto;
use App\Container\Gesap\src\Radicacion;
use App\Container\Gesap\src\Documentos;
use App\Container\Gesap\src\Encargados;

class StudentController extends Controller
{
       
    private $path='gesap.Estudiante.';
    protected $connection = 'gesap';
        
    /*
     * Listado de proyectos asignados como estudiantes
     *
     * @param  \Illuminate\Http\Request
	 *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function proyecto(Request $request)
    {
		if ($request->isMethod('GET')) {
        	return view($this->path.'ProponenteList');
		}
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Listado de proyectos asignados como estudiantes
     *
     * @param  \Illuminate\Http\Request
	 *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function proyectoajax(Request $request)
    {
		if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'ProponenteList-ajax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
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
        if ($request->ajax() && $request->isMethod('GET')) {
            $anteproyecto=Anteproyecto::select('*')
                    ->where('PK_NPRY_IdMinr008', '=', $id)
                    ->with(['radicacion',
                            'proyecto' => function ($proyecto) {
                                $proyecto->with(['documentos'=> function ($documento) {
                                    $documento->with('actividad');
                                }]);
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
     * Subida de archivo por actividad
     *
     * @param  \Illuminate\Http\Request 
     *
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function uploadActividad(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $date = Carbon::now();
            $date= $date->format('his');
            $files = $request->file('file');
            $Ubicacion="gesap/proyecto/".$request->get('PK_actividad');
            foreach ($files as $file) {
                $nombre=$date."_".$file->getClientOriginalName();
                \Storage::disk('local')->putFileAs($Ubicacion, $file, $nombre);
                $documento = Documentos::findOrFail($request->get('PK_actividad'));
                $documento->DMNT_Archivo =$nombre;
                $documento->save();
            }
          return AjaxResponse::success(
            'COMPLETADA SUBIDA',
            'SUBIDA CORRECTAMENTE.',
             $request->get('PK_actividad')
        );
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
    * @return Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function studentList(Request $request)
    {
		if ($request->isMethod('GET')) {
			$anteproyectos = Encargados::where(function ($query) {
								$query->where('NCRD_Cargo', '=', "Estudiante 1")  ;
								$query->orwhere('NCRD_Cargo', '=', "Estudiante 2");
			})
				->where('FK_Developer_User_Id', '=', $request->user()->id)
				->with(['anteproyecto' => function ($proyecto) {
					$proyecto->with(['radicacion',
									 'director',
									 'jurado1',
									 'jurado2',
									 'estudiante1',
									 'estudiante2',
									 'conceptoFinal',
									 'proyecto']);
				}])
				->get();

			return Datatables::of($anteproyectos)
				->removeColumn('created_at')
				->removeColumn('updated_at')
				->addColumn('NPRY_Estado', function ($users) {
					if (!strcmp($users->anteproyecto->NPRY_Estado, 'EN REVISION')) {
						return "<span class='label label-sm label-warning'>"
							.$users->anteproyecto->NPRY_Estado."</span>";
					} else {
						if (!strcmp($users->anteproyecto->NPRY_Estado, 'PENDIENTE')) {
							return "<span class='label label-sm label-warning'>"
								.$users->anteproyecto->NPRY_Estado."</span>";
						} else {
							if (!strcmp($users->anteproyecto->NPRY_Estado, 'APROBADO')) {
								return "<span class='label label-sm label-success'>"
								   .$users->anteproyecto->NPRY_Estado."</span>";
							} else {
								if (!strcmp($users->anteproyecto->NPRY_Estado, 'APLAZADO')) {
									return "<span class='label label-sm label-danger'>"
										.$users->anteproyecto->NPRY_Estado."</span>";
								} else {
									if (!strcmp($users->anteproyecto->NPRY_Estado, 'RECHAZADO')) {
										return "<span class='label label-sm label-danger'>"
											.$users->anteproyecto->NPRY_Estado."</span>";
									} else {
										if (!strcmp($users->anteproyecto->NPRY_Estado, 'COMPLETADO')) {
											return "<span class='label label-sm label-success'>"
												.$users->anteproyecto->NPRY_Estado."</span>";
										} else {
											return "<span class='label label-sm label-info'>"
												.$users->anteproyecto->NPRY_Estado."</span>";
										}
									}
								}
							}
						}
					}
				})
				->addColumn('NPRY_Titulo', function ($title) {
					$marca = "<!--corte-->";
					$largo=50;
					$titulo=$title->anteproyecto->NPRY_Titulo;
					if (strlen($titulo) > $largo) {
						$titulo = wordwrap($title->anteproyecto->NPRY_Titulo, $largo, $marca);
						$titulo = explode($marca, $titulo);
						$texto1 = $titulo[0];
						unset($titulo[0]);
						$texto2= implode(' ', $titulo);
						return '<p><span class="texto-mostrado">'
							.$texto1
							.'<span class="puntos">... </span></span><span class="texto-ocultado" style="display:none">'
							.$texto2
							.'</span> <span class="boton_mas_info">Ver más</span></p>';
					}
					return '<p>'.$titulo.'</p>';
				})
				->rawColumns(['NPRY_Estado','NPRY_Titulo'])
				->addIndexColumn()->make(true);
		}
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
