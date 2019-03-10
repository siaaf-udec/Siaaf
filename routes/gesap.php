<?php

$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => 'AnteproyectosGesap', 'middleware' => ['permission:ADMIN_GESAP']], function () {
		$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

		Route::get('Mctr008/', [
			'uses' => $controller.'CoordinatorController@index',
			'as' => 'AnteproyectosGesap.index'
		]);

		Route::get('Mctr008/Ajax', [
			'uses' => $controller.'CoordinatorController@indexAjax',
			'as' => 'AnteproyectosGesap.index.Ajax'
		]);
		Route::get('Anteproyecto', [
			'uses' => $controller.'CoordinatorController@anteproyectoList',
			'as' => 'AnteproyectosGesap.List'
		]);
		Route::get('MctCreate', [
			'uses' => $controller.'CoordinatorController@MctCreate',
			'as' => 'AnteproyectosGesap.MctCreate'
		]);
		Route::get('CANCELAR/{id?}', [
			'uses' => $controller . 'CoordinatorController@CancelarAnte', 
			'as' => 'Anteproyecto.Cancelar'
		]);
		Route::delete('EliminarJurados/{id?}', [
			'uses' => $controller . 'CoordinatorController@EliminarJurado', 
			'as' => 'AnteproyectoGesap.EliminarJurados'
		]);
		Route::delete('destroyAcMct/{id?}', [
			'uses' => $controller . 'CoordinatorController@EliminarActividadMct', 
			'as' => 'Anteproyecto.mctdestroy'
		]);
		Route::delete('destroyDesarrollador/{id?}', [
			'uses' => $controller . 'CoordinatorController@EliminarDesarrollador', 
			'as' => 'Desarrollador.destroy'
		]);
		Route::get('editar/{id?}', [
			'uses' => $controller . 'CoordinatorController@EditarAnteproyecto',     
			'as' => 'AnteproyectoGesap.edit'
		]);
		Route::get('asignar/{id?}', [
			'uses' => $controller . 'CoordinatorController@AsignarAnteproyecto',     
			'as' => 'AnteproyectoGesap.asignar'
		]);
		Route::get('ver/{id?}', [
			'uses' => $controller . 'CoordinatorController@VerAnteproyecto',     
			'as' => 'AnteproyectoGesap.VerAnteproyecto'
		]);
		Route::post('createmct', [
			'uses' => $controller . 'CoordinatorController@CreateMCT',  
			'as' => 'AnteproyectosGesap.createmct'
		]);
		Route::get('mctlimit', [
			'uses' => $controller . 'CoordinatorController@MctLimit',  
			'as' => 'AnteproyectosGesap.MctLimit'
		]);
		
		
		Route::get('verdesarroladores/{id?}', [
			'uses' => $controller . 'CoordinatorController@DesarrolladoresList',     
			'as' => 'AnteproyectosGesap.Desarrolladoreslist'
		]);
		Route::get('verjurado/{id?}', [
			'uses' => $controller . 'CoordinatorController@AsignarJuradoslist',     
			'as' => 'AnteproyectosGesap.AsignarJuradoslist'
		]);
		Route::get('verjurados/{id?}', [
			'uses' => $controller . 'CoordinatorController@JuradosList',     
			'as' => 'AnteproyectosGesap.JuradosList'
		]);

		Route::get('desarrolladores/{id?}', [
			'uses' => $controller . 'CoordinatorController@AsignarDesarrollador',     
			'as' => 'AnteproyectosGesap.AsignarDesarrollador'
		]);
		Route::get('jurados/{id?}', [
			'uses' => $controller . 'CoordinatorController@AsignarJurados',     
			'as' => 'AnteproyectosGesap.AsignarJurados'
		]);
		
		Route::get('desarrolladoresstore/{id?}', [
			'uses' => $controller . 'CoordinatorController@AsignarDesarrolladorstore',     
			'as' => 'AnteproyectosGesap.AsignarDesarrolladorstore'
		]);
		
		Route::get('asignardesarrolladorlist', [
			'uses' => $controller . 'CoordinatorController@AsignarDesarrolladoreslist',     
			'as' => 'AnteproyectosGesap.AsignarDesarrolladoreslist'
		]);
		Route::get('listfechas', [
			'uses' => $controller . 'CoordinatorController@listfechas',     
			'as' => 'AnteproyectosGesap.listfechas'
		]);
		//menu al crear
		Route::get('create', [
			'uses' => $controller . 'CoordinatorController@CreateAnte',  
			'as' => 'AnteproyectosGesap.create'
		]);
		//crear
		Route::post('store', [
            'uses' => $controller . 'CoordinatorController@store',   
            'as' => 'AnteproyectosGesap.store'
		]);
		Route::post('storefechas', [
            'uses' => $controller . 'CoordinatorController@storefechas',   
            'as' => 'AnteproyectosGesap.storefechas'
		]);
		Route::POST('creardesarrollador', [
            'uses' => $controller . 'CoordinatorController@desarrolladorstore',   
            'as' => 'AnteproyectosGesap.desarrolladorStore'
		]);
		
		Route::POST('crearjurado', [
            'uses' => $controller . 'CoordinatorController@juradostore',   
            'as' => 'AnteproyectosGesap.juradostore'
		]);
		//cargar list
		Route::get('Pre_Director', [
            'uses' => $controller . 'CoordinatorController@listarPreDirector',
            'as' => 'AnteproyectoGesap.listarpredirector'
		]);
		Route::get('FechasWindget', [
            'uses' => $controller . 'CoordinatorController@FechasRadicacion',
            'as' => 'AnteproyectoGesap.FechasRadicacion'
		]);
		Route::get('Estado_Ante', [
            'uses' => $controller . 'CoordinatorController@listarEstado',
            'as' => 'AnteproyectoGesap.listarEstado'
		]);	
		Route::get('mct', [
            'uses' => $controller . 'CoordinatorController@mctindex',
            'as' => 'AnteproyectosGesap.mct'
		]);	
		Route::get('mctlist', [
            'uses' => $controller . 'CoordinatorController@listaActividades',
            'as' => 'AnteproyectosGesap.listaActividades'
		]);	
		Route::post('updateAnteproyecto', [
            'uses' => $controller . 'CoordinatorController@updateAnte',      
            'as' => 'AnteproyectoGesap.updateAnte'
        ]);
	});
	//rutas proyectos

	Route::group(['prefix' => 'Proyectos', 'middleware' => ['permission:ADMIN_GESAP']], function () {
		$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

		Route::get('ProyectoGesap/', [
            'uses' => $controller . 'CoordinatorController@indexProyecto',   
            'as' => 'Proyectos.index'
		]);
		
		Route::get('ProyectoGesapAjax/', [
            'uses' => $controller . 'CoordinatorController@indexProyectoajax',   
            'as' => 'Proyectos.indexajax'
		]);

		Route::get('Proyectos/', [
            'uses' => $controller . 'CoordinatorController@ProyectosList',   
            'as' => 'Proyectos.List'
		]);
		
		Route::get('VerProyecto/{id?}', [
            'uses' => $controller . 'CoordinatorController@VerProyecto',   
            'as' => 'Proyectos.VerProyecto'
		]);
		
		Route::post('createactividadlibro/', [
            'uses' => $controller . 'CoordinatorController@createlibro',   
            'as' => 'Proyectos.createlibro'
		]);
		
		Route::post('storefechasProyecto/', [
            'uses' => $controller . 'CoordinatorController@storefechasProyecto',   
            'as' => 'Proyectos.storefechasProyecto'
		]);
		Route::get('LibroLimit/', [
            'uses' => $controller . 'CoordinatorController@LibroLimit',   
            'as' => 'Proyectos.LibroLimit'
		]);
		
		Route::get('listfechasProyecto/', [
            'uses' => $controller . 'CoordinatorController@listfechasProyecto',   
            'as' => 'Proyectos.listfechasProyecto'
		]);
		
		
		
		Route::get('CancelarProyecto/{id?}', [
            'uses' => $controller . 'CoordinatorController@CancelarProyecto',   
            'as' => 'Proyecto.Cancelar'
		]);

		Route::get('Libro/{id?}', [
            'uses' => $controller . 'CoordinatorController@Libro',   
            'as' => 'Proyecto.Libro'
		]);
		Route::get('listaActividadesLibro/{id?}', [
            'uses' => $controller . 'CoordinatorController@listaActividadesLibro',   
            'as' => 'Proyecto.listaActividadesLibro'
		]);
		
		Route::delete('mctdestroyLibro/{id?}', [
			'uses' => $controller . 'CoordinatorController@mctdestroyLibro', 
			'as' => 'Proyecto.mctdestroyLibro'
		]);
		
	
	});
	// Rutas para la parte de Usuarios

	Route::group(['prefix' => 'UsuariosGesap', 'middleware' => ['permission:ADMIN_GESAP']], function () {
			$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

		Route::get('Users/', [
            'uses' => $controller . 'CoordinatorController@indexUsuarios',   
            'as' => 'UsuariosGesap.index'
		]);
		
		

		Route::get('Users/Ajax', [
			'uses' => $controller.'CoordinatorController@indexAjaxUsuarios',
			'as' => 'UsuariosGesap.index.Ajax'
		]);
		
		Route::get('Usuarios', [
			'uses' => $controller.'CoordinatorController@usuariosList',
			'as' => 'UsuariosGesap.List'
		]);
		

		//Ruta que carga la información de roles ancladas a los usuarios
        Route::get('RolesUser', [
            'uses' => $controller . 'CoordinatorController@listarRoles',
            'as' => 'UsuariosGesap.listRoles'
        ]);

        //Ruta que carga la información de estados anclados a los usuarios
        Route::get('EstadosUser', [
            'uses' => $controller . 'CoordinatorController@listarEstados',
            'as' => 'UsuariosGesap.listEstados'
        ]);

		Route::delete('destroy/{id?}', [
			'uses' => $controller . 'CoordinatorController@eliminarUser', 
			'as' => 'Usuarios.destroy'
		]);

		Route::get('editar/{id?}', [
			'uses' => $controller . 'CoordinatorController@editarUser',     
			'as' => 'Usuarios.edit'
		]);

		//ruta que conduce al controlador para actulizar datos del usuario
        Route::post('update', [
            'uses' => $controller . 'CoordinatorController@updateUsuario',      
            'as' => 'UsuariosGesap.update'
        ]);

		Route::get('create', [
			'uses' => $controller . 'CoordinatorController@createUser',  
			'as' => 'UsuariosGesap.create'
		]);
		/////USER DEVELOPER////
		Route::post('storeusuarios', [
            'uses' => $controller . 'UserControllerGesap@store',   
            'as' => 'UsuariosGesap.createUsuario'
		]);
		/////////////
		
	});
	//rutas estudiantes//
	Route::group(['prefix' => 'EstudianteGesap', 'middleware' => ['permission:STUDENT_GESAP']], function () {
		$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

		Route::get('index', [
			'uses' => $controller . 'StudentController@index',  
			'as' => 'EstudianteGesap.index'
		]);
		Route::get('indexAjax', [
			'uses' => $controller . 'StudentController@index',  
			'as' => 'EstudianteGesap.index.ajax'
		]);
		Route::get('Anteproyecto/{id?}', [
			'uses' => $controller . 'StudentController@AnteproyectoList',  
			'as' => 'EstudianteGesap.Desarrolladores'
		]);
		Route::get('Actividades/{id?}', [
			'uses' => $controller . 'StudentController@VerActividades',  
			'as' => 'EstudianteGesap.VerActividades'
		]);
		Route::get('BancoProyectosList', [
			'uses' => $controller . 'StudentController@BancoProyectosList',  
			'as' => 'EstudianteGesap.BancoProyectosList'
		]);
		
		Route::get('VerSolicitud/{id?}', [
			'uses' => $controller . 'StudentController@VerSolicitud',  
			'as' => 'EstudianteGesap.VerSolicitud'
		]);
		
		Route::get('BancoAnteProyectosList', [
			'uses' => $controller . 'StudentController@BancoAnteProyectosList',  
			'as' => 'EstudianteGesap.BancoAnteProyectosList'
		]);
		
		
		Route::get('VerProyectoCompleto/{id?}', [
			'uses' => $controller . 'StudentController@VerProyectoCompleto',  
			'as' => 'EstudianteGesap.VerProyectoCompleto'
		]);
		Route::get('DesarrolladoresEstudiante/{id?}', [
			'uses' => $controller . 'StudentController@DesarrolladoresEstudiante',  
			'as' => 'EstudianteGesap.DesarrolladoresEstudiante'
		]);
		
		Route::get('ListComentariosJuradoAnteproyecto/{id?}', [
			'uses' => $controller . 'StudentController@ListComentariosJuradoAnteproyecto',  
			'as' => 'EstudianteGesap.ListComentariosJuradoAnteproyecto'
		]);
		Route::get('BancoDeProyectos/{id?}', [
			'uses' => $controller . 'StudentController@BancoDeProyectos',  
			'as' => 'EstudianteGesap.BancoDeProyectos'
		]);
		Route::get('ListComentariosJuradoProyecto/{id?}', [
			'uses' => $controller . 'StudentController@ListComentariosJuradoProyecto',  
			'as' => 'EstudianteGesap.ListComentariosJuradoProyecto'
		]);
		Route::get('VerComentariosJuradoAnteproyecto/{id?}', [
			'uses' => $controller . 'StudentController@VerComentariosJuradoAnteproyecto',  
			'as' => 'EstudianteGesap.VerComentariosJuradoAnteproyecto'
		]);
		Route::get('VerComentariosJuradoProyecto/{id?}', [
			'uses' => $controller . 'StudentController@VerComentariosJuradoProyecto',  
			'as' => 'EstudianteGesap.VerComentariosJuradoProyecto'
		]);
		Route::get('ActividadesProyecto/{id?}', [
			'uses' => $controller . 'StudentController@VerActividadesProyecto',  
			'as' => 'EstudianteGesap.VerActividadesProyecto'
		]);
		Route::get('VerRequerimientos/{id?}', [
			'uses' => $controller . 'StudentController@VerRequerimientos',  
			'as' => 'EstudianteGesap.VerRequerimientos'
		]);
	
		Route::get('ActividadesList/{id?}', [
			'uses' => $controller . 'StudentController@VerActividadesList',  
			'as' => 'EstudianteGesap.VerActividadesList'
		]);
		Route::get('ActividadesListProyecto/{id?}', [
			'uses' => $controller . 'StudentController@VerActividadesListProyecto',  
			'as' => 'EstudianteGesap.VerActividadesListProyecto'
		]);
		Route::get('Requerimientoslist/{id?}', [
			'uses' => $controller . 'StudentController@VerRequerimientosList',  
			'as' => 'EstudianteGesap.VerRequerimientosList'
		]);
		Route::get('SubirActividad/{id?}/{idp?}', [
			'uses' => $controller . 'StudentController@SubirActividad',  
			'as' => 'EstudianteGesap.SubirActividad'
		]);
		Route::get('SubirActividadProyecto/{id?}/{idp?}', [
			'uses' => $controller . 'StudentController@SubirActividadProyecto',  
			'as' => 'EstudianteGesap.SubirActividadProyecto'
		]);
		Route::get('Comentarios/{id?}/{idp?}', [
			'uses' => $controller . 'StudentController@Comentarios',  
			'as' => 'EstudianteGesap.Comentarios'
		]);
		Route::get('DetallesPersona/{id?}', [
			'uses' => $controller . 'StudentController@DetallesPersona',  
			'as' => 'EstudianteGesap.DetallesPersona'
		]);
		
		Route::get('Financiacion/{id?}', [
			'uses' => $controller . 'StudentController@Financiacion',  
			'as' => 'EstudianteGesap.Financiacion'
		]);
		
		Route::post('SolicitudStore', [
			'uses' => $controller . 'StudentController@SolicitudStore',  
			'as' => 'EstudianteGesap.SolicitudStore'
		]);
		Route::post('FinanciacionStore', [
			'uses' => $controller . 'StudentController@FinanciacionStore',  
			'as' => 'EstudianteGesap.FinanciacionStore'
		]);
		Route::post('EditarFinanciacion', [
			'uses' => $controller . 'StudentController@EditarFinanciacion',  
			'as' => 'EstudianteGesap.EditarFinanciacion'
		]);
		//
		Route::post('ResultadoStore', [
			'uses' => $controller . 'StudentController@ResultadoStore',  
			'as' => 'EstudianteGesap.ResultadoStore'
		]);
		
		Route::post('EditarResultado', [
			'uses' => $controller . 'StudentController@EditarResultado',  
			'as' => 'EstudianteGesap.EditarResultado'
		]);
		Route::delete('ResultadoDelete/{id?}', [
			'uses' => $controller . 'StudentController@ResultadoDelete',  
			'as' => 'EstudianteGesap.ResultadoDelete'
		]);
		Route::delete('EliminarSolicitud/{id?}', [
			'uses' => $controller . 'StudentController@EliminarSolicitud',  
			'as' => 'EstudianteGesap.EliminarSolicitud'
		]);
		Route::get('Resultados/{id?}', [
			'uses' => $controller . 'StudentController@Resultados',  
			'as' => 'EstudianteGesap.Resultados'
		]);
		
		//
		//
		Route::post('RubroPersonalStore', [
			'uses' => $controller . 'StudentController@RubroPersonalStore',  
			'as' => 'EstudianteGesap.RubroPersonalStore'
		]);
		
		Route::post('EditarRubroPersonal', [
			'uses' => $controller . 'StudentController@EditarRubroPersonal',  
			'as' => 'EstudianteGesap.EditarRubroPersonal'
		]);
		Route::delete('RubroPersonalDelete/{id?}', [
			'uses' => $controller . 'StudentController@RubroPersonalDelete',  
			'as' => 'EstudianteGesap.RubroPersonalDelete'
		]);
		Route::get('RubroPersonal/{id?}', [
			'uses' => $controller . 'StudentController@RubroPersonal',  
			'as' => 'EstudianteGesap.RubroPersonal'
		]);
		
		//
			//
		Route::post('RubroEquiposStore', [
			'uses' => $controller . 'StudentController@RubroEquiposStore',  
			'as' => 'EstudianteGesap.RubroEquiposStore'
		]);
		
		Route::post('EditarRubroEquipos', [
			'uses' => $controller . 'StudentController@EditarRubroEquipos',  
			'as' => 'EstudianteGesap.EditarRubroEquipos'
		]);
		Route::delete('RubroEquiposDelete/{id?}', [
			'uses' => $controller . 'StudentController@RubroEquiposDelete',  
			'as' => 'EstudianteGesap.RubroEquiposDelete'
		]);
		Route::get('RubroEquipos/{id?}', [
			'uses' => $controller . 'StudentController@RubroEquipos',  
			'as' => 'EstudianteGesap.RubroEquipos'
		]);
		
		//
			//
			Route::post('RubroMaterialStore', [
				'uses' => $controller . 'StudentController@RubroMaterialStore',  
				'as' => 'EstudianteGesap.RubroMaterialStore'
			]);
			
			Route::post('EditarRubroMaterial', [
				'uses' => $controller . 'StudentController@EditarRubroMaterial',  
				'as' => 'EstudianteGesap.EditarRubroMaterial'
			]);
			Route::delete('RubroMaterialDelete/{id?}', [
				'uses' => $controller . 'StudentController@RubroMaterialDelete',  
				'as' => 'EstudianteGesap.RubroMaterialDelete'
			]);
			Route::get('RubroMaterial/{id?}', [
				'uses' => $controller . 'StudentController@RubroMaterial',  
				'as' => 'EstudianteGesap.RubroMaterial'
			]);
			
		
		//
			//
			Route::post('RubroTecnologicoStore', [
				'uses' => $controller . 'StudentController@RubroTecnologicoStore',  
				'as' => 'EstudianteGesap.RubroTecnologicoStore'
			]);
			
			Route::post('EditarRubroTecnologico', [
				'uses' => $controller . 'StudentController@EditarRubroTecnologico',  
				'as' => 'EstudianteGesap.EditarRubroTecnologico'
			]);
			Route::delete('RubroTecnologicoDelete/{id?}', [
				'uses' => $controller . 'StudentController@RubroTecnologicoDelete',  
				'as' => 'EstudianteGesap.RubroTecnologicoDelete'
			]);
			Route::get('RubroTecnologico/{id?}', [
				'uses' => $controller . 'StudentController@RubroTecnologico',  
				'as' => 'EstudianteGesap.RubroTecnologico'
			]);
		//
		
		//
		Route::post('CronogramaStore', [
			'uses' => $controller . 'StudentController@CronogramaStore',  
			'as' => 'EstudianteGesap.CronogramaStore'
		]);
		
		Route::post('EditarCronograma', [
			'uses' => $controller . 'StudentController@EditarCronograma',  
			'as' => 'EstudianteGesap.EditarCronograma'
		]);
		Route::delete('CronogramaDelete/{id?}', [
			'uses' => $controller . 'StudentController@CronogramaDelete',  
			'as' => 'EstudianteGesap.CronogramaDelete'
		]);
		Route::get('Cronograma/{id?}', [
			'uses' => $controller . 'StudentController@Cronograma',  
			'as' => 'EstudianteGesap.Cronograma'
		]);
		
		//
				//
		Route::post('FuncionStore', [
			'uses' => $controller . 'StudentController@FuncionStore',  
			'as' => 'EstudianteGesap.FuncionStore'
		]);
		
		Route::post('EditarFuncion', [
			'uses' => $controller . 'StudentController@EditarFuncion',  
			'as' => 'EstudianteGesap.EditarFuncion'
		]);
		Route::delete('FuncionDelete/{id?}', [
			'uses' => $controller . 'StudentController@FuncionDelete',  
			'as' => 'EstudianteGesap.FuncionDelete'
		]);
		Route::get('Funcion/{id?}', [
			'uses' => $controller . 'StudentController@Funcion',  
			'as' => 'EstudianteGesap.Funcion'
		]);
		
		//
		
		Route::delete('Financiaciondelete/{id?}', [
			'uses' => $controller . 'StudentController@Financiaciondelete',  
			'as' => 'EstudianteGesap.Financiaciondelete'
		]);
		Route::get('Radicar/{id?}', [
			'uses' => $controller . 'StudentController@Radicar',  
			'as' => 'EstudianteGesap.RADICAR'
		]);
		Route::get('RadicarProyecto/{id?}', [
			'uses' => $controller . 'StudentController@RadicarProyecto',  
			'as' => 'EstudianteGesap.RADICARPROYECTO'
		]);
		Route::post('ActividadStore', [
			'uses' => $controller . 'StudentController@ActividadStore',  
			'as' => 'EstudianteGesap.ActividadStore'
		]);
		Route::post('ActividadStoreProyecto', [
			'uses' => $controller . 'StudentController@ActividadStoreProyecto',  
			'as' => 'EstudianteGesap.ActividadStoreProyecto'
		]);
		Route::post('PersonaDatos', [
			'uses' => $controller . 'StudentController@PersonaDatos',  
			'as' => 'EstudianteGesap.PersonaDatos'
		]);
		Route::post('EditarPersonaDatos', [
			'uses' => $controller . 'StudentController@EditarPersonaDatos',  
			'as' => 'EstudianteGesap.EditarPersonaDatos'
		]);
		Route::delete('PersonaDatosdelete/{id?}', [
			'uses' => $controller . 'StudentController@PersonaDatosdelete',  
			'as' => 'EstudianteGesap.PersonaDatosdelete'
		]);
		Route::post('ComentarioStore', [
			'uses' => $controller . 'StudentController@ComentarioStore',  
			'as' => 'EstudianteGesap.ComentarioStore'
		]);
		Route::get('SubirRequerimiento/{id?}/{idp?}', [
			'uses' => $controller . 'StudentController@SubirRequerimiento',  
			'as' => 'EstudianteGesap.SubirRequerimiento'
		]);
		Route::get('ListaProyecto/{id?}', [
			'uses' => $controller . 'StudentController@ListaProyecto',  
			'as' => 'EstudianteGesap.ListaProyecto'
		]);
	});
	//
	//rutas PROFESORES//
	Route::group(['prefix' => 'DocenteGesap', 'middleware' => ['permission:DOCENTE_GESAP']], function () {
		
		$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

	
		Route::get('index', [
			'uses' => $controller . 'DocenteController@index',  
			'as' => 'DocenteGesap.index'
		]);
		Route::get('indexAjax', [
			'uses' => $controller . 'DocenteController@index',  
			'as' => 'DocenteGesap.index.ajax'
		]);

		Route::get('Resultados/{id?}', [
			'uses' => $controller . 'DocenteController@Resultados',  
			'as' => 'DocenteGesap.Resultados'
		]);
		Route::get('Financiacion/{id?}', [
			'uses' => $controller . 'DocenteController@Financiacion',  
			'as' => 'DocenteGesap.Financiacion'
		]);
		Route::get('DetallesPersona/{id?}', [
			'uses' => $controller . 'DocenteController@DetallesPersona',  
			'as' => 'DocenteGesap.DetallesPersona'
		]);
		Route::get('Cronograma/{id?}', [
			'uses' => $controller . 'DocenteController@Cronograma',  
			'as' => 'DocenteGesap.Cronograma'
		]);
		
		Route::get('Comentarios/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@Comentarios',  
			'as' => 'DocenteGesap.Comentarios'
		]);
		Route::get('ComentariosJurado/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@ComentariosJurado',  
			'as' => 'DocenteGesap.ComentariosJurado'
		]);
		Route::get('listarEstadoJurado', [
            'uses' => $controller . 'DocenteController@listarEstadoJurado',
            'as' => 'DocenteGesap.listarEstadoJurado'
		]);
		Route::get('VerActividadesProyecto/{id?}', [
            'uses' => $controller . 'DocenteController@VerActividadesProyecto',
            'as' => 'DocenteGesap.VerActividadesProyecto'
		]);
		Route::get('VerActividadesProyectoJurado/{id?}', [
            'uses' => $controller . 'DocenteController@VerActividadesProyectoJurado',
            'as' => 'DocenteGesap.VerActividadesProyectoJurado'
		]);
		Route::get('VerActividadesListProyectoDirector/{id?}', [
			'uses' => $controller . 'DocenteController@VerActividadesListProyectoDirector',  
			'as' => 'DocenteGesap.VerActividadesListProyectoDirector'
		]);
		Route::get('VerActividadProyecto/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@VerActividadProyecto',  
			'as' => 'DocenteGesap.VerActividadProyecto'
		]);
		Route::get('VerActividadProyectoJurado/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@VerActividadProyectoJurado',  
			'as' => 'DocenteGesap.VerActividadProyectoJurado'
		]);
		Route::get('Avalar/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@Avalar',  
			'as' => 'DocenteGesap.Avalar'
		]);
		Route::get('CalificarJurado/{id?}', [
			'uses' => $controller . 'DocenteController@CalificarJurado',  
			'as' => 'DocenteGesap.CalificarJurado'
		]);
		Route::get('CalificarProyectoJurado/{id?}', [
			'uses' => $controller . 'DocenteController@CalificarProyectoJurado',  
			'as' => 'DocenteGesap.CalificarProyectoJurado'
		]);
		Route::get('ComentariosJu/{id?}', [
			'uses' => $controller . 'DocenteController@ComentariosJu',  
			'as' => 'DocenteGesap.ComentariosJu'
		]);
		Route::get('ComentariosJuProyecto/{id?}', [
			'uses' => $controller . 'DocenteController@ComentariosJuProyecto',  
			'as' => 'DocenteGesap.ComentariosJuProyecto'
		]);
		Route::get('DesicionJurados/{id?}', [
			'uses' => $controller . 'DocenteController@DesicionJurados',  
			'as' => 'DocenteGesap.DesicionJurados'
		]);
		Route::get('DesicionJuradosProyecto/{id?}', [
			'uses' => $controller . 'DocenteController@DesicionJuradosProyecto',  
			'as' => 'DocenteGesap.DesicionJuradosProyecto'
		]);
		
		Route::post('ComentarioStore', [
			'uses' => $controller . 'DocenteController@ComentarioStore',  
			'as' => 'DocenteGesap.ComentarioStore'
		]);
		Route::post('CambiarEstadoJurado', [
			'uses' => $controller . 'DocenteController@CambiarEstadoJurado',  
			'as' => 'DocenteGesap.CambiarEstadoJurado'
		]);
		Route::post('CambiarEstadoJuradoProyecto', [
			'uses' => $controller . 'DocenteController@CambiarEstadoJuradoProyecto',  
			'as' => 'DocenteGesap.CambiarEstadoJuradoProyecto'
		]);
		Route::post('ComentarioStoreJurado', [
			'uses' => $controller . 'DocenteController@ComentarioStoreJurado',  
			'as' => 'DocenteGesap.ComentarioStoreJurado'
		]);
		Route::get('ActividadesList/{id?}', [
			'uses' => $controller . 'DocenteController@VerActividadesList',  
			'as' => 'DocenteGesap.VerActividadesList'
		]);
		Route::get('VerActividad/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@VerActividad',  
			'as' => 'DocenteGesap.VerActividad'
		]);
		Route::get('Funciones/{id?}', [
			'uses' => $controller . 'DocenteController@Funcion',  
			'as' => 'DocenteGesap.Funcion'
		]);
		Route::get('VerRequerimientos/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@VerRequerimientos',  
			'as' => 'DocenteGesap.VerRequerimientos'
		]);
		Route::get('RequerimientosJurado/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@RequerimientosJurado',  
			'as' => 'DocenteGesap.RequerimientosJurado'
		]);
		Route::get('VerActividadJurado/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@VerActividadJurado',  
			'as' => 'DocenteGesap.VerActividadJurado'
		]);
		Route::get('Actividades/{id?}', [
			'uses' => $controller . 'DocenteController@VerActividades',  
			'as' => 'DocenteGesap.VerActividades'
		]);
		Route::get('ActividadesJurado/{id?}', [
			'uses' => $controller . 'DocenteController@VerActividadesJurado',  
			'as' => 'DocenteGesap.VerActividadesJurado'
		]);
		Route::get('RequerimientosDocente/{id?}', [
			'uses' => $controller . 'DocenteController@VerRequerimientosDocente',  
			'as' => 'DocenteGesap.VerRequerimientosDocente'
		]);
		Route::get('VerRequerimientosJurado/{id?}', [
			'uses' => $controller . 'DocenteController@VerRequerimientosJurado',  
			'as' => 'DocenteGesap.VerRequerimientosJurado'
		]);
		Route::get('VerRequerimientosList/{id?}', [
			'uses' => $controller . 'DocenteController@VerRequerimientosList',  
			'as' => 'DocenteGesap.VerRequerimientosList'
		]);

		Route::get('Anteproyecto/{id?}', [
			'uses' => $controller . 'DocenteController@VerAnteproyecto',  
			'as' => 'DocenteGesap.VerAnteproyecto'
		]);
		Route::get('AnteproyectoJurado/{id?}', [
			'uses' => $controller . 'DocenteController@VerAnteproyectoJurado',  
			'as' => 'DocenteGesap.VerAnteproyectoJurado'
		]);
		Route::get('AnteproyectoList/{id?}', [
			'uses' => $controller . 'DocenteController@Anteproyectolist',  
			'as' => 'DocenteGesap.Anteproyectolist'
		]);
		Route::get('AnteproyectoListJurado/{id?}', [
			'uses' => $controller . 'DocenteController@AnteproyectoListJurado',  
			'as' => 'DocenteGesap.AnteproyectoListJurado'
		]);
		Route::get('ProyectosListRadicados/{id?}', [
			'uses' => $controller . 'DocenteController@ProyectosListRadicados',  
			'as' => 'DocenteGesap.ProyectosListRadicados'
		]);
		Route::get('ProyectosList/{id?}', [
			'uses' => $controller . 'DocenteController@ProyectosList',  
			'as' => 'DocenteGesap.ProyectosList'
		]);
		Route::get('CalificarAnteproyecto/{id?}', [
			'uses' => $controller . 'DocenteController@CalificarAnteproyecto',  
			'as' => 'DocenteGesap.Calificar'
		]);
		Route::get('VerSolicitud', [
			'uses' => $controller . 'DocenteController@VerSolicitud',  
			'as' => 'DocenteGesap.VerSolicitud'
		]);
		Route::get('WidgetProyecto', [
			'uses' => $controller . 'DocenteController@WidgetProyecto',  
			'as' => 'DocenteGesap.WidgetProyecto'
		]);
		
		Route::post('SolicitudStore', [
			'uses' => $controller . 'DocenteController@SolicitudStore',  
			'as' => 'DocenteGesap.SolicitudStore'
		]);
		Route::get('Desarrolladores/{id?}', [
			'uses' => $controller . 'DocenteController@DesarrolladoresList',  
			'as' => 'DocenteGesap.Desarrolladores'
		]);
		Route::get('Anteproyectosdocente', [
			'uses' => $controller.'DocenteController@Anteproyectosdocente',
			'as' => 'DocenteGesap.Anteproyectosdocente'
		]);
		
		Route::delete('EliminarSolicitud/{id?}', [
			'uses' => $controller.'DocenteController@EliminarSolicitud',
			'as' => 'DocenteGesap.EliminarSolicitud'
		]);

		Route::get('Asignar/{id?}', [
			'uses' => $controller . 'DocenteController@Asignar',  
			'as' => 'DocenteGesap.Asignar'
		]);

		Route::get('RubroMaterial/{id?}', [
			'uses' => $controller . 'DocenteController@RubroMaterial',  
			'as' => 'DocenteGesap.RubroMaterial'
		]);

		Route::get('RubroTecnologico/{id?}', [
			'uses' => $controller . 'DocenteController@RubroTecnologico',  
			'as' => 'DocenteGesap.RubroTecnologico'
		]);

		Route::get('RubroEquipos/{id?}', [
		'uses' => $controller . 'DocenteController@RubroEquipos',  
		'as' => 'DocenteGesap.RubroEquipos'
		]);

		Route::get('RubroPersonal/{id?}', [
		'uses' => $controller . 'DocenteController@RubroPersonal',  
		'as' => 'DocenteGesap.RubroPersonal'
		]);



	
	});
	//
	Route::group(['prefix' => 'CoordinadorGesap', 'middleware' => ['permission:ADMIN_GESAP']], function () {
		
		$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

		Route::get('index', [
			'uses' => $controller . 'CoordinatorController@indexSolicitudes',  
			'as' => 'CoordinadorGesap.indexSolicitudes'
		]);

		
		Route::get('solicitudesindex/{ids?}', [
			'uses' => $controller . 'CoordinatorController@indexSolicitudesajax',  
			'as' => 'CoordinadorGesap.indexSolicitudes.Ajax'
		]);

		Route::get('SolicitudesList', [
			'uses' => $controller . 'CoordinatorController@SolicitudesList',  
			'as' => 'CoordinadorGesap.SolicitudesList'
		]);

		Route::get('CerrarSolicitud/{ids?}', [
			'uses' => $controller . 'CoordinatorController@CerrarSolicitud',  
			'as' => 'CoordinadorGesap.CerrarSolicitud'
		]);

		
		Route::get('VerProyectoSolicitud/{id?}/{ids?}', [
			'uses' => $controller . 'CoordinatorController@VerProyectoSolicitud',  
			'as' => 'CoordinadorGesap.VerProyectoSolicitud'
		]);

		
		Route::post('editarfechas', [
			'uses' => $controller . 'CoordinatorController@editarfechas',  
			'as' => 'CoordinadorGesap.editarfechas'
		]);

		


	});

});	
