<?php
/**
 * Audiovisuales
 */

//RUTAS GESTION ADMINISTRADOR**************
Route::group(['prefix' => 'administradorGestionPrestamos'], function () {
	$controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
	//RUTA VISTA PRINCIPAL GESTION PRESTAMOS
	Route::get('index', [
		'uses' => $controller . 'AdministradorGestionController@index',
		'as'   => 'audiovisuales.gestionPrestamos.index',
	]);
	//audiovisuales.gestionPrestamos.indexAjax
    Route::get('indexAjax', [
        'uses' => $controller . 'AdministradorGestionController@indexjax',
        'as'   => 'audiovisuales.gestionPrestamos.indexAjax',
    ]);
    Route::get('formRepeatAjax',[
        'uses' => $controller.'AdministradorGestionController@formRepeatAjaxindex',
        'as' => 'opcionPrestamoAjax'
    ]);
    Route::post('CrearFuncionario', [
        'uses' => $controller . 'AdministradorGestionController@storeProgramaAdmin',
        'as'   => 'crearFuncionarioAdmin.storePrograma',
    ]);
    Route::get('validarInfo/{idFuncionarioA?}',[
        'uses' => $controller . 'AdministradorGestionController@validarFuncionario',
        'as'   => 'validarInformacionFuncionario',
    ]);
    Route::get('listarProgramas',[
        'uses' => $controller . 'AdministradorGestionController@listarProgramas',
        'as'   => 'listarProgramas',
    ]);
    Route::get('tiempoArticulo/{idTipoArticulo?}',[
        'uses' => $controller . 'AdministradorGestionController@listarTiempoArticulo',
        'as'   => 'listarTiempoArticuloSele',
    ]);
    Route::post('prestamoFormRepeat',[
        'uses' => $controller . 'AdministradorGestionController@crearPrestamoRepeat',
        'as'   => 'prestamoRepeat.crear',
    ]);
    Route::get('indexTablaPress2', [
        'uses' => $controller . 'AdministradorGestionController@indexTablaPrestamos2',
        'as'   => 'audiovisuales.ListarPrestamo2.index',
    ]);
    Route::get('indexTablaPress', [
        'uses' => $controller . 'AdministradorGestionController@indexTablaPrestamos',
        'as'   => 'audiovisuales.ListarPrestamo.index',
    ]);
    Route::get('dataUsuarios', [
        'uses' => $controller . 'AdministradorGestionController@dataListarFuncionarios',
        'as'   => 'listarFuncionarios.dataTable',
    ]);
    Route::get('indexTablaEntregaPres/{id_orden?}', [
        'uses' => $controller . 'AdministradorGestionController@indexEntregaPrestamos',
        'as'   => 'audiovisuales.EntregasPrestamo.index',
    ]);
    Route::get('gestionReserva',[
        'uses' => $controller.'AdministradorGestionController@reservaindex',
        'as' => 'reserva.index'
    ]);
    Route::get('updateSolicitud/{id_articulo?}/{observation?}', [
        'uses' => $controller . 'AdministradorGestionController@updateSolicitud',
        'as'   => 'updatePrestamo',
    ]);
    Route::get('aumentarTiempoSolicitud/{id_prestamo?}/{numHoras?}', [
        'uses' => $controller . 'AdministradorGestionController@moreTimeSolicitud',
        'as'   => 'aumentarTiempo',
    ]);
    Route::post('updateGeneral/{idOrden?}', [
        'uses' => $controller . 'AdministradorGestionController@updatePrestamoGeneral',
        'as'   => 'updatesPrestamoGeneral',
    ]);
    Route::POST('moreTimeUpdateSolicitud/{idPrestamo?}',[
        'uses' => $controller . 'AdministradorGestionController@moreTimeUpdate',
        'as'   => 'moreTimeUpdate',
    ]);
    Route::get('dataArticulos', [
        'uses' => $controller . 'AdministradorGestionController@dataReservasFuncionarios',
        'as'   => 'gestionReserva.dataTable',
    ]);
    Route::get('infoReserva/{route_ver?}',[
        'uses' => $controller.'AdministradorGestionController@verReserva',
        'as' => 'gestionVerReservaModal'
    ]);
    Route::post('actualizarReserva/{idReserva?}', [
        'uses' => $controller . 'AdministradorGestionController@realizarEntregaReserva',
        'as'   => 'realizarEntregaReserva',
    ]);

});
// RUTAS FUNCIONARIO ************************
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
});
// RUTAS SUPERADMIN **************************
Route::group(['prefix' => 'superAdmin'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    //GESTION VALIDACIONES
    Route::get('validaciones', [
        'uses' => $controller . 'ValidacionController@index',
        'as'   => 'audiovisuales.validaciones.index',
    ]);
    //referencia para editar preguntas
    Route::post('task/{task?}', [
        'uses' => $controller . 'ValidacionController@edit',
        'as'   => 'validaciones.edit',
    ]);
    //GESTION ARTICULO
    Route::get('index', [
        'uses' => $controller . 'ArticuloController@index',
        'as'   => 'audiovisuales.articulo.index',
    ]);
    Route::get('listarKit/{id?}',[
        'uses' => $controller.'ArticuloController@cargarKits',
        'as' => 'cargar.kits.select'
    ]);
    Route::get('listarTipoArticulos/{id?}',[
        'uses' => $controller.'ArticuloController@cargarTipoArticulos',
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
        'uses' => $controller . 'ArticuloController@dataTableArticulos',
        'as'   => 'listarArticulo.data',
    ]);
});