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
		
		Route::delete('destroy/{id?}', [
			'uses' => $controller . 'CoordinatorController@EliminarAnte', 
			'as' => 'Anteproyecto.destroy'
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
	});
	// Rutas para la parte de Usuarios

	Route::group(['prefix' => 'UsuariosGesap', 'middleware' => ['permission:ADD_USER_GESAP']], function () {
			$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

		Route::get('Users/', [
            'uses' => $controller . 'CoordinatorController@indexUsuarios',   
            'as' => 'UsuariosGesap.index'
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
		

		Route::get('Users/Ajax', [
			'uses' => $controller.'CoordinatorController@indexAjaxUsuarios',
			'as' => 'UsuariosGesap.index.Ajax'
		]);
		
		Route::get('Usuarios', [
			'uses' => $controller.'CoordinatorController@usuariosList',
			'as' => 'UsuariosGesap.List'
		]);
		Route::post('updateAnteproyecto', [
            'uses' => $controller . 'CoordinatorController@updateAnte',      
            'as' => 'AnteproyectoGesap.updateAnte'
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

		Route::post('store', [
            'uses' => $controller . 'CoordinatorController@createUsuario',   
            'as' => 'UsuariosGesap.createUsuario'
		]);
		
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
		Route::get('ActividadesList/{id?}', [
			'uses' => $controller . 'StudentController@VerActividadesList',  
			'as' => 'EstudianteGesap.VerActividadesList'
		]);
		Route::get('SubirActividad/{id?}/{idp?}', [
			'uses' => $controller . 'StudentController@SubirActividad',  
			'as' => 'EstudianteGesap.SubirActividad'
		]);
		Route::get('Comentarios/{id?}/{idp?}', [
			'uses' => $controller . 'StudentController@Comentarios',  
			'as' => 'EstudianteGesap.Comentarios'
		]);
		Route::get('Radicar/{id?}', [
			'uses' => $controller . 'StudentController@Radicar',  
			'as' => 'EstudianteGesap.RADICAR'
		]);
		Route::post('ActividadStore', [
			'uses' => $controller . 'StudentController@ActividadStore',  
			'as' => 'EstudianteGesap.ActividadStore'
		]);
		Route::post('ComentarioStore', [
			'uses' => $controller . 'StudentController@ComentarioStore',  
			'as' => 'EstudianteGesap.ComentarioStore'
		]);
		
	});
	//
	//rutas PROFESORES//
	Route::group(['prefix' => 'DocenteGesap', 'middleware' => ['permission:TEACHER_GESAP']], function () {
		
		$controller = "\\App\\Container\\Gesap\\src\\Controllers\\";

	
		Route::get('index', [
			'uses' => $controller . 'DocenteController@index',  
			'as' => 'DocenteGesap.index'
		]);
		Route::get('indexAjax', [
			'uses' => $controller . 'DocenteController@index',  
			'as' => 'DocenteGesap.index.ajax'
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
		Route::get('Avalar/{id?}/{idp?}', [
			'uses' => $controller . 'DocenteController@Avalar',  
			'as' => 'DocenteGesap.Avalar'
		]);
		Route::get('CalificarJurado/{id?}', [
			'uses' => $controller . 'DocenteController@CalificarJurado',  
			'as' => 'DocenteGesap.CalificarJurado'
		]);
		Route::get('ComentariosJu/{id?}', [
			'uses' => $controller . 'DocenteController@ComentariosJu',  
			'as' => 'DocenteGesap.ComentariosJu'
		]);
		Route::get('DesicionJurados/{id?}', [
			'uses' => $controller . 'DocenteController@DesicionJurados',  
			'as' => 'DocenteGesap.DesicionJurados'
		]);
		Route::post('ComentarioStore', [
			'uses' => $controller . 'DocenteController@ComentarioStore',  
			'as' => 'DocenteGesap.ComentarioStore'
		]);
		Route::post('CambiarEstadoJurado', [
			'uses' => $controller . 'DocenteController@CambiarEstadoJurado',  
			'as' => 'DocenteGesap.CambiarEstadoJurado'
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
		Route::get('CalificarAnteproyecto/{id?}', [
			'uses' => $controller . 'DocenteController@CalificarAnteproyecto',  
			'as' => 'DocenteGesap.Calificar'
		]);
		Route::get('Desarrolladores/{id?}', [
			'uses' => $controller . 'DocenteController@DesarrolladoresList',  
			'as' => 'DocenteGesap.Desarrolladores'
		]);

		Route::get('Asignar/{id?}', [
			'uses' => $controller . 'DocenteController@Asignar',  
			'as' => 'DocenteGesap.Asignar'
		]);



	
	});
	//

});	
