<?php

$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => 'AnteproyectosGesap', 'middleware' => ['permission:LIST_ANTEPROYECTOS']], function () {
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
		
		Route::delete('destroy/{id?}', [
			'uses' => $controller . 'CoordinatorController@EliminarAnte', 
			'as' => 'Anteproyecto.destroy'
		]);
		Route::get('editar/{id?}', [
			'uses' => $controller . 'CoordinatorController@EditarAnteproyecto',     
			'as' => 'Anteproyecto.edit'
		]);
		Route::get('create', [
			'uses' => $controller . 'CoordinatorController@CreateAnte',  
			'as' => 'AnteproyectosGesap.create'
		]);
		
		Route::post('store', [
            'uses' => $controller . 'CoordinatorController@CreateAnteproyecto',   
            'as' => 'AnteproyectosGesap.createanteproyecto'
		]);
	});
		
		// Rutas para la parte de Usuarios

	Route::group(['prefix' => 'UsuariosGesap', 'middleware' => ['permission:ADD_USER_GESAP']], function () {
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

		Route::delete('destroy/{id?}', [
			'uses' => $controller . 'CoordinatorController@eliminarUser', 
			'as' => 'Usuarios.destroy'
		]);

		Route::get('editar/{id?}', [
			'uses' => $controller . 'CoordinatorController@editarUser',     
			'as' => 'Usuarios.edit'
		]);

		Route::get('create', [
			'uses' => $controller . 'CoordinatorController@createUser',  
			'as' => 'UsuariosGesap.create'
		]);

		Route::post('store', [
            'uses' => $controller . 'CoordinatorController@createUsuario',   
            'as' => 'UsuariosGesap.createUsuario'
		]);
		
	});

});	


	Route::post('anteproyecto/new', [
		'uses' => $controller.'CoordinatorController@storeAnteproyectoDefault',
		'as' => 'nuevo.anteproyecto'
	])->middleware('permission:CREATE_ACTIVITY_DEFAULT_GESAP');

	Route::get('activities', [
		'uses' => $controller.'CoordinatorController@activityDefaultList',
		'as' => 'actividad.default.list'
	])->middleware('permission:CREATE_ACTIVITY_DEFAULT_GESAP');

	Route::post('activity/new', [
		'uses' => $controller.'CoordinatorController@storeActividadDefault',
		'as' => 'nueva.actividad'
	])->middleware('permission:CREATE_ACTIVITY_DEFAULT_GESAP');

	Route::post('activity/edit', [
		'uses' => $controller.'CoordinatorController@updateActividadDefault',
		'as' => 'editar.actividad'
	])->middleware('permission:EDIT_ACTIVITY_DEFAULT_GESAP');
	Route::delete('activity/{id?}', [
		'uses' => $controller.'CoordinatorController@destroyActividadDefault',
		'as' => 'activity.default.destroy'
	])->middleware('permission:DELETE_ACTIVITY_DEFAULT_GESAP');
	Route::get('min/ajax', [
		'as' => 'min.index.ajax',
		'uses' => $controller.'CoordinatorController@indexAjax'
	])->middleware('permission:GESAP_MODULE');
	Route::delete('min/{id?}', [
		'uses' => $controller.'CoordinatorController@destroy',
		'as' => 'min.destroy'
	])->middleware('permission:DELETE_PROJECT_GESAP');
	Route::get('project/', [
		'uses' => $controller.'CoordinatorController@indexProject',
		'as' => 'project.index'
	])->middleware('permission:GESAP_MODULE');
	Route::delete('project/{id?}', [
		'uses' => $controller.'CoordinatorController@destroyProject',
		'as' => 'project.destroy'
	])->middleware('permission:GESAP_MODULE');
	Route::get('anteproyecto', [
		'as' => 'anteproyecto.list',
		'uses' => $controller.'CoordinatorController@preliminaryList'
	])->middleware('permission:GESAP_MODULE');
	Route::get('proyecto', [
		'as' => 'proyecto.list',
		'uses' => $controller.'CoordinatorController@projectList'
	])->middleware('permission:GESAP_MODULE');

	Route::get('min/create', [
		'uses' => $controller.'CoordinatorController@create',
		'as' => 'min.create'
	])->middleware('permission:CREATE_PROJECT_GESAP');
	Route::post('min/store', [
		'uses' => $controller.'CoordinatorController@store',
		'as' => 'min.store'
	])->middleware('permission:CREATE_PROJECT_GESAP');


	Route::get('min/edit/{id?}', [
		'uses' => $controller.'CoordinatorController@edit',
		'as' => 'min.edit'
	])->middleware('permission:MODIFY_PROJECT_GESAP');
	Route::post('min/update', [
		'uses' => $controller.'CoordinatorController@update',
		'as' => 'min.proyecto.update'
	])->middleware('permission:MODIFY_PROJECT_GESAP');

	Route::get('min/asignar/{id?}', [
		'as' => 'anteproyecto.asignar',
		'uses' => $controller.'CoordinatorController@assign'
	])->middleware('permission:ASSIGN_TEACHER_GESAP');

	Route::post('min/store/docente/', [
		'as' => 'anteproyecto.guardardocente',
		'uses' => $controller.'CoordinatorController@saveAssign'
	])->middleware('permission:ASSIGN_TEACHER_GESAP');

	Route::get('evaluar/', [
		'uses' => $controller.'EvaluatorController@jury',
		'as' => 'evaluar.index'
	])->middleware('permission:JURY_LIST_GESAP');
	Route::get('evaluar/index', [
		'uses' => $controller.'EvaluatorController@jury',
		'as' => 'evaluar.index'
	])->middleware('permission:JURY_LIST_GESAP');
	Route::get('evaluar/ver/jurado', [
		'as' => 'anteproyecto.index.juryList',
		'uses' => $controller.'EvaluatorController@jury'
	])->middleware('permission:JURY_LIST_GESAP');
	Route::get('evaluar/observaciones/{id?}', [
		'as' => 'anteproyecto.observaciones',
		'uses' => $controller.'EvaluatorController@createObservations'
	])->middleware('permission:CREATE_OBSERVATIONS_GESAP');
	Route::post('evaluar/store/observaciones/', [
		'as' => 'anteproyecto.guardar.observaciones',
		'uses' => $controller.'EvaluatorController@storeObservations'
	])->middleware('permission:CREATE_OBSERVATIONS_GESAP');
	Route::get('evaluar/concepto/{id?}', [
		'as' => 'anteproyecto.conceptos',
		'uses' => $controller.'EvaluatorController@createConcepts'
	])->middleware('permission:CREATE_CONCEPT_GESAP');
	Route::post('evaluar/concepto', [
		'as' => 'anteproyecto.guardar.conceptos',
		'uses' => $controller.'EvaluatorController@storeConcepts'
	])->middleware('permission:CREATE_CONCEPT_GESAP');
	Route::get('jurado', [
		'as' => 'anteproyecto.juryList',
		'uses' => $controller.'EvaluatorController@juryList'
	])->middleware('permission:JURY_LIST_GESAP');

	Route::get('evaluar/ver/director', [
		'as' => 'anteproyecto.index.directorList',
		'uses' => $controller.'EvaluatorController@director'
	])->middleware('permission:DIRECTOR_LIST_GESAP');
	Route::get('evaluar/ver/director/ajax', [
		'as' => 'anteproyecto.index.directorList.ajax',
		'uses' => $controller.'EvaluatorController@directorAjax'
	])->middleware('permission:DIRECTOR_LIST_GESAP');
	Route::get('evaluar/aprobar/{id?}', [
		'as' => 'proyecto.aprobado',
		'uses' => $controller.'EvaluatorController@approved'
	])->middleware('permission:APROVED_PROJECT_GESAP');
	Route::get('evaluar/cerrar/{id?}', [
		'as' => 'proyecto.cerrar',
		'uses' => $controller.'EvaluatorController@closeProject'
	])->middleware('permission:CLOSE_PROJECT_GESAP');
	Route::post('actividades/new', [
		'as' => 'proyecto.nueva.actividad',
		'uses' => $controller.'EvaluatorController@storeActividad'
	])->middleware('permission:CREATE_ACTIVITY_GESAP');
	Route::delete('actividades/{id?}', [
		'uses' => $controller.'EvaluatorController@destroyActivity',
		'as' => 'actividad.destroy'
	])->middleware('permission:Delete_Activity_Gesap');
	Route::get('director', [
		'as' => 'anteproyecto.directorList',
		'uses' => $controller.'EvaluatorController@directorList'
	])->middleware('permission:DIRECTOR_LIST_GESAP');
	Route::get('download/proyecto/{actividad?}/{archivo?}', [
		'uses' => $controller.'EvaluatorController@downloadActivity',
		'as' => 'download.activity'
	])->middleware('permission:GESAP_MODULE');

	Route::get('show/{id?}', [
		'as' => 'evaluar.show',
		'uses' => $controller.'EvaluatorController@show'
	])->middleware('permission:GESAP_MODULE');
	Route::get('observaciones/{id?}', [
		'as' => 'anteproyecto.observationsList',
		'uses' => $controller.'EvaluatorController@observationsList'
	])->middleware('permission:SEE_OBSERVATIONS_GESAP');
	Route::get('actividades/{id?}', [
		'as' => 'proyecto.actividades',
		'uses' => $controller.'StudentController@actividad'
	])->middleware('permission:SEE_ACTIVITY_GESAP');
	Route::get('download/{archivo?}', [
		'as' => 'download.documento',
		'uses' => $controller.'EvaluatorController@downloadDocument'
	])->middleware('permission:GESAP_MODULE');


	Route::get('evaluar/ver/proyecto', [
		'as' => 'anteproyecto.index.studentList',
		'uses' => $controller.'StudentController@proyecto'
	])->middleware('permission:STUDENT_LIST_GESAP');
	Route::get('evaluar/ver/proyecto/ajax', [
		'as' => 'anteproyecto.index.studentList.ajax',
		'uses' => $controller.'StudentController@proyectoAjax'
	])->middleware('permission:STUDENT_LIST_GESAP');
	Route::post('actividades/documento', [
		'as' => 'proyecto.actividades.upload',
		'uses' => $controller.'StudentController@uploadActividad'
	])->middleware('permission:UPDATE_FINAL_PROJECT_GESAP');
	Route::get('estudiante', [
		'as' => 'anteproyecto.studentList',
		'uses' => $controller.'StudentController@studentList'
	])->middleware('permission:STUDENT_LIST_GESAP');


	Route::get('graficos/', [
		'as' => 'graficos.index',
		'uses' => $controller.'ReportController@graficos'
	])->middleware('permission:REPORT_GESAP');
	Route::get('graficos/data/preliminary', [
		'as' => 'data.chart.preliminary',
		'uses' => $controller.'ReportController@getPreliminary'
	])->middleware('permission:REPORT_GESAP');
	Route::get('graficos/data/project', [
		'as' => 'data.chart.project',
		'uses' => $controller.'ReportController@getProject'
	])->middleware('permission:REPORT_GESAP');
	Route::get('graficos/data/Jury', [
		'as' => 'data.chart.jury',
		'uses' => $controller.'ReportController@getJury'
	])->middleware('permission:REPORT_GESAP');
	Route::get('graficos/data/Director', [
		'as' => 'data.chart.director',
		'uses' => $controller.'ReportController@getDirector'
	])->middleware('permission:REPORT_GESAP');
	Route::get('Reporte', [
		'as' => 'report.index',
		'uses' => $controller.'ReportController@index'
	])->middleware('permission:REPORT_GESAP');
	Route::get('ReportAnteproyect', [
		'as' => 'report.all.project',
		'uses' => $controller.'ReportController@allProject'
	])->middleware('permission:REPORT_GESAP');
	Route::get('downloadPDF', [
		'as' => 'report.all.project.download',
		'uses' => $controller.'ReportController@allProjectPrint'
	])->middleware('permission:GESAP_MODULE');
	Route::get('ReportJury/{jury?}', [
		'as' => 'report.jury.project',
		'uses' => $controller.'ReportController@juryProject'
	])->middleware('permission:REPORT_GESAP');
	Route::get('ReportJury/{jury?}/download', [
		'as' => 'report.jury.project.download',
		'uses' => $controller.'ReportController@downloadJuryProject'
	])->middleware('permission:REPORT_GESAP');
	Route::get('ReportDirector/{director?}', [
		'as' => 'report.director.project',
		'uses' => $controller.'ReportController@directorProject'
	])->middleware('permission:REPORT_GESAP');
	Route::get('ReportDirector/{jury?}/download', [
		'as' => 'report.director.project.download',
		'uses' => $controller.'ReportController@downloadDirectorProject'
	])->middleware('permission:REPORT_GESAP');

