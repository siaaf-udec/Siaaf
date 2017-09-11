<?php
/**
 * Audiovisuales
 */

Route::get('/', [
    'as'   => 'audiovisuales.index',
    'uses' => function () {
        return view('audiovisuals.example');
    },
]);
Route::group(['prefix' => 'autenticacion'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'UsuarioAudiovisualesController@index',
        'as'   => 'audiovisuales.autenticacion.index',
    ]);
    Route::get('data', [
        'uses' => $controller . 'AdministradorController@data',
        'as'   => 'administrador.data',
    ]);
    Route::get('all/{id}', [
        'uses' => $controller . 'AdministradorController@all',
        'as'   => 'administrador.all',
    ]);
    Route::post('store', [
        'uses' => $controller . 'AdministradorController@store',
        'as'   => 'administrador.store',
    ]);
    Route::delete('delete/{id?}', [
        'uses' => $controller . 'AdministradorController@destroy',
        'as'   => 'administrador.destroy',
    ])->where(['id' => '[0-9]+']);
});
//RUTAS GESTION ADMINISTRADOR
Route::group(['prefix' => 'administradorGestionPrestamos'], function () {
	$controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
	//RUTA VISTA PRINCIPAL GESTION PRESTAMOS
	Route::get('index', [
		'uses' => $controller . 'AdministradorGestionController@index',
		'as'   => 'audiovisuales.gestionPrestamos.index',
	]);
	//RUTA AJAX GESTIONRESERVAS INDEX
	Route::get('gestionReserva',[
		'uses' => $controller.'AdministradorGestionController@reservaindex',
		'as' => 'reserva.index'
	]);
	Route::get('dataArticulos', [
		'uses' => $controller . 'AdministradorGestionController@dataReservasFuncionarios',
		'as'   => 'gestionReserva.dataTable',
	]);
	Route::get('data', [
		'uses' => $controller . 'AdministradorController@data',
		'as'   => 'administrador.data',
	]);
	Route::get('all/{id}', [
		'uses' => $controller . 'AdministradorController@all',
		'as'   => 'administrador.all',
	]);
	Route::post('store', [
		'uses' => $controller . 'AdministradorController@store',
		'as'   => 'administrador.store',
	]);
	Route::delete('delete/{id?}', [
		'uses' => $controller . 'AdministradorController@destroy',
		'as'   => 'administrador.destroy',
	])->where(['id' => '[0-9]+']);
});
// RUTAS FUNCIONARIO
Route::group(['prefix' => 'funcionario'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    //ruta para vista reservar Articulos
    Route::get('reservasArticulos', [
        'uses' => $controller . 'FuncionarioController@reserva',//cambiar por indexArticulos
        'as'   => 'audiovisuales.reservas.articulos.index',
    ]);
    //ruta para crear reserva articulos
	Route::post('guardarArticulos', [
		'uses' => $controller . 'FuncionarioController@almacenarArticulo',
		'as'   => 'reservaArticulo.store',
	]);
	//ruta para crear la reserva kit
	Route::post('guardarKits', [
		'uses' => $controller . 'FuncionarioController@storeKit',
		'as'   => 'reservaKit.store',
	]);
	//ruta para vista reservasKits
	Route::get('reservasKits', [
		'uses' => $controller . 'FuncionarioController@reservaKits',//cambiar por indexkit
		'as'   => 'audiovisuales.reservas.kits.index',
	]);
	//ruta para almacenar los datos del selec tipo articulo dispobibles
	Route::get('ListarSelectTipoArticulo', [
		'uses' => $controller . 'FuncionarioController@consultarTiposArticulosDisposnibles',
		'as'   => 'cargar.tipoArticulosDisponibles.select',
	]);
	//ruta para almacenar los datos del selec kits dispobibles
	Route::get('ListarSelectKits', [
		'uses' => $controller . 'FuncionarioController@consultarKitsDisposnibles',
		'as'   => 'cargar.kitsDisponibles.select',
	]);
	//ruta para almacenar los datos del selec kits dispobibles
	Route::get('ListarTextAreaArticulos/{kit?}', [
		'uses' => $controller . 'FuncionarioController@consultarArticulosKit',
		'as'   => 'listarArticulosKit',
	]);


	//ruta para crear funcionario
	Route::post('CrearFuncionario', [
		'uses' => $controller . 'FuncionarioController@storePrograma',
		'as'   => 'crearFuncionarioPrograma.storePrograma',
	]);
	//ruta datatable articulos
    Route::get('dataArticulos', [
        'uses' => $controller . 'FuncionarioController@dataArticulo',
        'as'   => 'funcionarioReservas.dataArticulo',
    ]);
	//ruta datatable kits
	Route::get('dataKits', [
		'uses' => $controller . 'FuncionarioController@dataKit',
		'as'   => 'funcionarioReservas.dataKit',
	]);
    Route::get('all/{id}', [
        'uses' => $controller . 'FuncionarioController@all',
        'as'   => 'funcionario.all',
    ]);
    Route::get('modal', [
        'uses' => $controller . 'FuncionarioController@modal',
        'as'   => 'funcionario.modal',
    ]);
    Route::post('store', [
        'uses' => $controller . 'FuncionarioController@store',
        'as'   => 'funcionario.store',
    ]);

    Route::delete('delete/{id?}', [
        'uses' => $controller . 'FuncionarioController@destroy',
        'as'   => 'funcionario.destroy',
    ])->where(['id' => '[0-9]+']);
});
// RUTAS SUPERADMIN
Route::group(['prefix' => 'superAdmin'], function () {
	$controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
	//GESTION VALIDACIONES
	Route::get('validaciones', [
		'uses' => $controller . 'ValidacionController@index',
		'as'   => 'audiovisuales.validaciones.index',
	]);
	//GESTION ARTICULO
	Route::get('index', [
		'uses' => $controller . 'ArticuloController@index',
		'as'   => 'audiovisuales.articulo.index',
	]);
	Route::get('listarKit/{id?}',[
		'uses' => $controller.'ArticuloController@carcargarKits',
		'as' => 'cargar.kits.select'
	]);
	Route::get('listarTipoArticulos/{id?}',[
		'uses' => $controller.'ArticuloController@carcargarTipoArticulos',
		'as' => 'cargar.tipoArticulos.select'
	]);

	Route::post('stores', [
		'uses' => $controller . 'ArticuloController@storeTipoArt',
		'as'   => 'tipoArticulos.store',
	]);

	Route::post('articles/check_unique', [
		'uses' => $controller . 'ArticuloController@ajaxUniqueTipoArt',
		'as'   => 'tipoArticulo.validar',

	]);
	Route::post('store', [
		'uses' => $controller . 'ArticuloController@storeKit',
		'as'   => 'kit.store',

	]);
	Route::post('kits/check_unique', [
		'uses' => $controller . 'ArticuloController@ajaxUniqueKit',
		'as'   => 'kit.validar',

	]);

	Route::post('storeArticulo', [
		'uses' => $controller . 'ArticuloController@storeArticulos',
		'as'   => 'articulo.store',

	]);
	Route::get('listar', [
		'uses' => $controller . 'ArticuloController@data',
		'as'   => 'listarArticulo.data',
	]);


});
// RUTAS ADMINISTRADOR
Route::group(['prefix' => 'administrador'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'AdministradorController@index',
        'as'   => 'audiovisuales.administrador.index',
    ]);
    Route::get('data', [
        'uses' => $controller . 'AdministradorController@data',
        'as'   => 'administrador.data',
    ]);
    Route::get('all/{id}', [
        'uses' => $controller . 'AdministradorController@all',
        'as'   => 'administrador.all',
    ]);
    Route::post('store', [
        'uses' => $controller . 'AdministradorController@store',
        'as'   => 'administrador.store',
    ]);
    Route::delete('delete/{id?}', [
        'uses' => $controller . 'AdministradorController@destroy',
        'as'   => 'administrador.destroy',
    ])->where(['id' => '[0-9]+']);

    Route::get('edit/{id?}', [
        'uses' => $controller . 'AdministradorController@edit',
        'as'   => 'administrador.edit',
    ])->where(['id' => '[0-9]+']);
    Route::post('update/{id?}', [
        'uses' => $controller . 'AdministradorController@update',
        'as'   => 'administrador.update',
    ])->where(['id' => '[0-9]+']);
});


//RUTAS FUNCIONES ADMINISTRADPR
Route::group(['prefix' => 'adminView'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index', [
        'uses' => $controller . 'AdminviewController@index',
        'as'   => 'audiovisuales.adminview.index',
    ]);
    Route::get('data', [
        'uses' => $controller . 'AdminviewController@data',
        'as'   => 'adminview.data',
    ]);
    Route::get('all/{id}', [
        'uses' => $controller . 'AdminviewController@all',
        'as'   => 'adminview.all',
    ]);
    Route::post('store', [
        'uses' => $controller . 'AdminviewController@store',
        'as'   => 'adminview.store',
    ]);
    Route::delete('delete/{id?}', [
        'uses' => $controller . 'AdminviewController@destroy',
        'as'   => 'adminview.destroy',
    ])->where(['id' => '[0-9]+']);
});
