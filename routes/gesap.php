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
		Route::get('desarrolladores/{id?}', [
			'uses' => $controller . 'CoordinatorController@AsignarDesarrollador',     
			'as' => 'AnteproyectosGesap.AsignarDesarrollador'
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
            'as' => 'AnteproyectosGesap.desarrolladorstore'
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
		Route::get('Anteproyecto/{id?}', [
			'uses' => $controller . 'StudentController@AnteproyectoList',  
			'as' => 'EstudianteGesap.Desarrolladores'
		]);
		Route::get('Actividades/{id?}', [
			'uses' => $controller . 'StudentController@VerActividades',  
			'as' => 'EstudianteGesap.VerActividades'
		]);
		Route::get('SubirActividad/{id?}', [
			'uses' => $controller . 'StudentController@SubirActividad',  
			'as' => 'EstudianteGesap.SubirActividad'
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

		Route::get('Anteproyecto/{id?}', [
			'uses' => $controller . 'DocenteController@VerAnteproyecto',  
			'as' => 'DocenteGesap.VerAnteproyecto'
		]);
		Route::get('AnteproyectoList/{id?}', [
			'uses' => $controller . 'DocenteController@Anteproyectolist',  
			'as' => 'DocenteGesap.Anteproyectolist'
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
