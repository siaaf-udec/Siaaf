<?php
namespace App\Container\Gesap\src\Controllers;


use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;
use Validator;
use Yajra\DataTables\DataTables;

use Illuminate\Http\File;
use Illuminate\Http\Request;



use App\Container\Overall\Src\Facades\AjaxResponse;

use App\Container\gesap\src\Anteproyecto;
use App\Container\gesap\src\Proyecto;
use App\Container\gesap\src\Radicacion;
use App\Container\gesap\src\Encargados;
use App\Container\Users\Src\User;

use Carbon\Carbon;

class CoordinatorController extends Controller
{
    
    private $path='gesap.Coordinador.';
    
    /*
     * Listado de todos los anteproyectos que se han registrado
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path.'AnteproyectoList');
    }
    
    /*
     * Listado de todos los anteproyectos que se han registrado con vista AJAX
     *
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function indexAjax(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            return view($this->path.'AnteproyectoList-ajax');
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Listado de todos los proyectos avalados
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProject()
    {
        return view($this->path.'ProyectoList');
    }
    
    /*
     * Formulario de registro de nuevo proyecto de grado
     * Envia lista de usuarios estudiantes registrados
     *
     * @param  \Illuminate\Http\Request 
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $estudiantes=User::orderBy('name', 'asc')
                ->whereHas('roles', function ($e) {
                    $e->where('name', 'Student_Gesap');
                })
                ->get(['name', 'lastname', 'id'])
                ->pluck('full_name', 'id')
                ->toArray();
            return view($this->path.'RegistroMin', [
                'estudiantes' => $estudiantes
            ]);
        }
        
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
  
    /*
     * Función de almacenamiento en la base de datos de anteproyectos
     *
     * @param  \Illuminate\Http\Request 
     * 
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $date = Carbon::now();
            $date= $date->format('his');
        
            $anteproyecto= new Anteproyecto();
            $anteproyecto->NPRY_Titulo=$request->get('title');
            $anteproyecto->NPRY_Keywords=$request->get('Keywords');
            $anteproyecto->NPRY_Duracion=$request->get('duracion');
            $anteproyecto->NPRY_FechaR=$request->get('FechaR');
            $anteproyecto->NPRY_FechaL=$request->get('FechaL');
            $anteproyecto->save();
            
            $idanteproyecto=$anteproyecto->PK_NPRY_IdMinr008;
            
            $radicacion= new Radicacion();
            $nombre = $date."_".$request['Min']->getClientOriginalName();
            $radicacion->RDCN_Min=$nombre;
            \Storage::disk('local')->put($nombre, \File::get($request->file('Min')));
            if ($request['Requerimientos'] == "Vacio") {
                $radicacion->RDCN_Requerimientos="NO FILE";
            } else {
                $nombre = $date."_".$request['Requerimientos']->getClientOriginalName();
                $radicacion->RDCN_Requerimientos=$nombre;
                \Storage::disk('local')->put($nombre, \File::get($request->file('Requerimientos')));
            }
            $radicacion->FK_TBL_Anteproyecto_Id=$idanteproyecto;
            $radicacion->save();
            
            Encargados::create([
                'FK_TBL_Anteproyecto_Id'    =>$idanteproyecto,
                'FK_Developer_User_Id'      =>$request->get('estudiante1'),
                'NCRD_Cargo'                =>"Estudiante 1"
            ]);
        
            if ($request->get('estudiante2')!=0) {
                Encargados::create([
                    'FK_TBL_Anteproyecto_Id'    =>$idanteproyecto ,
                    'FK_Developer_User_Id'      =>$request->get('estudiante2'),
                    'NCRD_Cargo'                =>"Estudiante 2"
                ]);
                
            }
            return AjaxResponse::success(
                '¡Registro Exitoso!',
                'Anteproyecto creado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
    }
     
     /*
     * Formulario de editar un proyecto de grado ya registrado
     * Envia lista de usuarios estudiantes registrados
     * Envia datos correspondientes al proyecto a editar
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function edit($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $estudiantes=User::orderBy('name', 'asc')
                ->whereHas('roles', function ($e) {
                            $e->where('name', 'Student_Gesap');
                })
                ->get(['name', 'lastname', 'id'])
                ->pluck('full_name', 'id')
                ->toArray();
            
            $anteproyecto=Anteproyecto::where('PK_NPRY_IdMinr008', '=', $id)
				->with('radicacion')
				->get();
                     
            $estudiante12=Anteproyecto::where('PK_NPRY_IdMinr008', '=', $id)
                ->select('PK_NPRY_IdMinr008')
                ->with(['encargados'=>function ($query) {
                    $query->select('PK_NCRD_IdCargo', 'FK_TBL_Anteproyecto_Id', 'FK_Developer_User_Id', 'NCRD_Cargo');
                    $query->where('NCRD_Cargo', 'ESTUDIANTE 1');
                    $query->orwhere('NCRD_Cargo', 'ESTUDIANTE 2');
                }])
                ->get();
            
            
            return view($this->path.'ModificarMin', [
                "anteproyecto"=>$anteproyecto,
                "estudiante12"=>$estudiante12,
                "estudiantes"=>$estudiantes
            ]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Función de actualizacion en la base de datos de anteproyectos
     *
     * @param  \Illuminate\Http\Request
     *
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function update(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $date = Carbon::now();
            $date= $date->format('his');
            $anteproyecto = Anteproyecto::findOrFail($request->get('PK_proyecto'));
            $anteproyecto->NPRY_Titulo=$request->get('title');
            $anteproyecto->NPRY_Keywords=$request->get('Keywords');
            $anteproyecto->NPRY_Duracion=$request->get('duracion');
            $anteproyecto->NPRY_FechaR=$request->get('FechaR');
            $anteproyecto->NPRY_FechaL=$request->get('FechaL');
            $anteproyecto->save();
            
            $radicacion= Radicacion::findOrFail($request->get('PK_radicacion'));
            if ($request->get('Min')!="Vacio") {
                \Storage::delete($radicacion->RDCN_Min);
                $nombre = $date."_".$request['Min']->getClientOriginalName();
                $radicacion->RDCN_Min=$nombre;
                \Storage::disk('local')->put($nombre, \File::get($request->file('Min')));
            }
            if ($request->get('Requerimientos')!="Vacio") {
                \Storage::delete($radicacion->RDCN_Requerimientos);
                $nombre = $date."_".$request['Requerimientos']->getClientOriginalName();
                $radicacion->RDCN_Requerimientos=$nombre;
                \Storage::disk('local')->put($nombre, \File::get($request->file('Requerimientos')));
            }
            $radicacion->save();
                                                     
            if ($request->get('PK_estudiante1')!="") {
                $estudiante1 = Encargados::findOrFail($request->get('PK_estudiante1'));
                if ($request->get('estudiante1')!=0) {
                    $estudiante1->FK_Developer_User_Id=$request->get('estudiante1');
                    $estudiante1->save();
                } else {
                    $estudiante1->delete();
                }
            } else {
                if ($request->get('estudiante1')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_Id'    =>$request->get('PK_proyecto') ,
                        'FK_Developer_User_Id'      =>$request->get('estudiante1'),
                        'NCRD_Cargo'                =>"Estudiante 1"
                    ]);
                }
            }
            
            if ($request->get('PK_estudiante2')!="") {
                $estudiante2 = Encargados::findOrFail($request->get('PK_estudiante2'));
                if ($request->get('estudiante2')!=0) {
                    $estudiante2->FK_Developer_User_Id=$request->get('estudiante2');
                    $estudiante2->save();
                } else {
                    $estudiante2->delete();
                }
            } else {
                if ($request->get('estudiante2')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_Id'=>$request->get('PK_proyecto') ,
                        'FK_Developer_User_Id'    =>$request->get('estudiante2'),
                        'NCRD_Cargo'            =>"Estudiante 2"
                    ]);
                }
            }
            return AjaxResponse::success(
                '¡Actualizacion Existosa!',
                'Anteproyecto modificado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Funcion de eliminacion de anteproyectos de la base de datos
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request
     *
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function destroy($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('DELETE')) {
 
            $anteproyecto = Anteproyecto::findOrFail($id);
            $anteproyecto->delete();
            return AjaxResponse::success(
                '¡Eliminacion Correcta!',
                'Anteproyecto eliminado correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
        
        
    }

    /*
     * Formulario de asignacion de docentes a un proyecto de grado registrados previamente
     * Envia lista de usuarios docentes registrados
     *
     * @param  int $id 
     * @param  \Illuminate\Http\Request 
     *
     * @return \Illuminate\Http\Response | \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function assign($id, Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $anteproyectos = Anteproyecto::select('PK_NPRY_IdMinr008', 'NPRY_Titulo')
                ->where('PK_NPRY_IdMinr008', '=', $id)
                ->get();
        
            $docentes=User::orderBy('name', 'asc')
                ->whereHas('roles', function ($e) {
                    $e->where('name', 'Coordinator_Gesap');
                    $e->orwhere('name', '=', 'Evaluator_Gesap');
                })
                ->get(['name', 'lastname', 'id'])
                ->pluck('full_name', 'id')
                ->toArray();
            
        
        
            $encargados=Anteproyecto::where('PK_NPRY_IdMinr008', '=', $id)
                ->select('PK_NPRY_IdMinr008')
                ->with(['encargados'=>function ($query) {
                    $query->select('PK_NCRD_IdCargo', 'FK_TBL_Anteproyecto_Id', 'FK_Developer_User_Id', 'NCRD_Cargo');
                    $query->where('NCRD_Cargo', 'DIRECTOR')  ;
                    $query->orwhere('NCRD_Cargo', 'JURADO 1');
                    $query->orwhere('NCRD_Cargo', 'JURADO 2');
                }])
                ->get();
                
            return view($this->path.'AsignarDocente', [
                'anteproyectos'=>$anteproyectos,
                'docentes'=>$docentes,
                'encargados'=>$encargados]);
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
     * Función de almacenamiento en la base de datos de los docentes asignados a un proyecto de grado
     *
     * @param  \Illuminate\Http\Request 
     * 
     * @return \App\Container\Overall\Src\Facades\AjaxResponse
     */
    public function saveAssign(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            if ($request->get('PK_director')!="") {
                $director = Encargados::findOrFail($request->get('PK_director'));
                $director->FK_Developer_User_Id=$request->get('director');
                $director->save();
            } else {
                if ($request->get('director')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_Id'=>$request->get('PK_anteproyecto') ,
                        'FK_Developer_User_Id'    =>$request->get('director'),
                        'NCRD_Cargo'            =>"Director"
                    ]);
                }
            }
            
            if ($request->get('PK_jurado1')!="") {
                $jurado1 = Encargados::findOrFail($request->get('PK_jurado1'));
                $jurado1->FK_Developer_User_Id=$request->get('jurado1');
                $jurado1->save();
            } else {
                if ($request->get('jurado1')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_Id'=>$request->get('PK_anteproyecto') ,
                        'FK_Developer_User_Id'    =>$request->get('jurado1'),
                        'NCRD_Cargo'            =>"Jurado 1"
                    ]);
                }
            }
            
            if ($request->get('PK_jurado2')!="") {
                $jurado1 = Encargados::findOrFail($request->get('PK_jurado2'));
                $jurado1->FK_Developer_User_Id=$request->get('jurado2');
                $jurado1->save();
            } else {
                if ($request->get('jurado2')!=0) {
                    Encargados::create([
                        'FK_TBL_Anteproyecto_Id'=>$request->get('PK_anteproyecto') ,
                        'FK_Developer_User_Id'    =>$request->get('jurado2'),
                        'NCRD_Cargo'            =>"Jurado 2"
                    ]);
                }
            }
              
            return AjaxResponse::success(
                '¡Asignacion Exitosa!',
                'Docentes asignados correctamente.'
            );
        }
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
    
    /*
    * Consulta de todos los anteproyectos con sus datos correspondientes
    *
	* @param  \Illuminate\Http\Request 
	*
    * @return Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function preliminaryList(Request $request)
    {
		if ($request->isMethod('GET')) {
			$anteproyectos = Anteproyecto::with([
                'radicacion', 
                'director', 
                'jurado1', 
                'jurado2', 
                'estudiante1', 
                'estudiante2', 
                'proyecto'
            ])
				->get();
			return Datatables::of($anteproyectos)
				->removeColumn('created_at')
				->removeColumn('updated_at')
				->addColumn('NPRY_Estado', function ($users) {
					if (!strcmp($users->NPRY_Estado, 'EN REVISION')) {
							return "<span class='label label-sm label-warning'>"
								.$users->NPRY_Estado
								."</span>";
					} else {
						if (!strcmp($users->NPRY_Estado, 'PENDIENTE')) {
							return "<span class='label label-sm label-warning'>"
								.$users->NPRY_Estado
								."</span>";
						} else {
							if (!strcmp($users->NPRY_Estado, 'APROBADO')) {
								return "<span class='label label-sm label-success'>"
									.$users->NPRY_Estado
									."</span>";
							} else {
								if (!strcmp($users->NPRY_Estado, 'APLAZADO')) {
									return "<span class='label label-sm label-danger'>"
										.$users->NPRY_Estado
										."</span>";
								} else {
									if (!strcmp($users->NPRY_Estado, 'RECHAZADO')) {
										return "<span class='label label-sm label-danger'>"
											.$users->NPRY_Estado
											."</span>";
									} else {
										if (!strcmp($users->NPRY_Estado, 'COMPLETADO')) {
											return "<span class='label label-sm label-success'>"
												.$users->NPRY_Estado
												."</span>";
										} else {
											return "<span class='label label-sm label-info'>"
												.$users->NPRY_Estado
												."</span>";
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
					$titulo=$title->NPRY_Titulo;
					if (strlen($titulo) > $largo) {
						$titulo = wordwrap($title->NPRY_Titulo, $largo, $marca);
						$titulo = explode($marca, $titulo);
						$texto1 = $titulo[0];
						unset($titulo[0]);
						$texto2= implode(' ', $titulo);
						return '<p><span class="texto-mostrado">'
							.$texto1
							.'<span class="puntos">... </span></span><span class="texto-ocultado" style="display:none">'
							.$texto2.'</span> <span class="boton_mas_info">Ver más</span></p>';
					}
					return '<p>'.$titulo.'</p>';
				})
				->rawColumns(['NPRY_Estado', 'NPRY_Titulo'])
				->addIndexColumn()->make(true);	
     	}
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );   
    }
    
    /*
    * Consulta de todos proyectos con sus datos correspondientes
    *
	* @param  \Illuminate\Http\Request 
	*
    * @return Yajra\DataTables\DataTables | \App\Container\Overall\Src\Facades\AjaxResponse
    */
    public function projectList(Request $request)
    {
		if ($request->isMethod('GET')) {
			$proyectos = Proyecto::with([
					'anteproyecto' => function ($anteproyecto) {
						$anteproyecto->with(['radicacion',
											 'director',
											 'jurado1',
											 'jurado2',
											 'estudiante1',
											 'estudiante2',
											 'proyecto']);
					}

				])
				->get();
			return Datatables::of($proyectos)
				->removeColumn('created_at')
				->removeColumn('updated_at')
				->addColumn('PRYT_Estado', function ($users) {
					if (!strcmp($users->PRYT_Estado, 'EN CURSO')) {
							return "<span class='label label-sm label-warning'>"
								.$users->PRYT_Estado
								."</span>";
					} else {
						if (!strcmp($users->PRYT_Estado, 'TERMINADO')) {
							return "<span class='label label-sm label-success'>"
								.$users->PRYT_Estado
								."</span>";
						} else {
							return "<span class='label label-sm label-info'>"
								.$users->PRYT_Estado
								."</span>";
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
				->rawColumns(['PRYT_Estado', 'NPRY_Titulo'])
				->addIndexColumn()->make(true);
		}
        return AjaxResponse::fail(
            '¡Lo sentimos!',
            'No se pudo completar tu solicitud.'
        );
    }
}
