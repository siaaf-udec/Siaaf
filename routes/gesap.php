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
		
		Route::delete('destroy/{id?}', [
			'uses' => $controller . 'CoordinatorController@EliminarAnte', 
			'as' => 'Anteproyecto.destroy'
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

});	
