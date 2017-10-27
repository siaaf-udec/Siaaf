<?php
/**
 * Audiovisuales
 */

//RUTAS GESTION ADMINISTRADOR**************
Route::group(['prefix' => 'administradorGestionPrestamos', 'middleware' => ['permission:ADMIN_AUDIOVISUALES']], function () {
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
        'as'   => 'audiovisuales.gestionPrestamos.listar',
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
    Route::post('updateKitAdmin/{idKit?}', [
        'uses' => $controller . 'AdministradorGestionController@updateKitAdmin',
        'as'   => 'updateKitAdmin',
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
    ///////
    Route::get('infoReservaArticulos/{route_articulos?}',[
    'uses' => $controller.'AdministradorGestionController@verReservaArticulos',
        'as' => 'gestionVerReservaArticulosModal'
    ]);
    Route::post('actualizarReserva/{idReserva?}', [
        'uses' => $controller . 'AdministradorGestionController@realizarEntregaReserva',
        'as'   => 'realizarEntregaReserva',
    ]);

    Route::get('reportes', [
        'uses' => $controller . 'AdministradorGestionController@reportes',
        'as'   => 'audiovisuales.reportes.index',
    ]);

    Route::get('pdfCarreras/{anio?}/{mes?}', [
        'uses' => $controller . 'AdministradorGestionController@reporteCarreras',
        'as' => 'audiovisuales.pdfCarreras'             //ruta que conduce al controlador para mostrar  el reporte referente a los datos de contacto de los empleados
    ]);
    Route::get('DownloadPdfCarreras/{anio?}/{mes?}', [
        'uses' => $controller . 'AdministradorGestionController@downloadCarreras',
        'as' => 'audiovisuales.DownloadPdfCarreras'             //ruta que conduce al controlador para descargar el reporte de contacto
    ]);
    Route::get('pdfTiempoUso', [
        'uses' => $controller . 'AdministradorGestionController@reporteTiempoUso',
        'as' => 'audiovisuales.pdfTiempoUso'             //ruta que conduce al controlador para mostrar  el reporte referente a los datos de contacto de los empleados
    ]);
    Route::get('DownloadPdfTiempoUso', [
        'uses' => $controller . 'AdministradorGestionController@downloadTiempoUso',
        'as' => 'audiovisuales.DownloadTiempoUso'             //ruta que conduce al controlador para descargar el reporte de contacto
    ]);
    Route::post('identificacion/check_unique', [
        'uses' => $controller . 'AdministradorGestionController@ajaxUniqueIdentificacion',
        'as'   => 'identificacion.validar',
    ]);
    Route::get('ListarTextAreaArticulos/{kit?}', [
        'uses' => $controller . 'AdministradorGestionController@consultarArticulosKit',
        'as' => 'listarArticulosKitAdministrador',
    ]);
    Route::get('ListarTextAreaArticulosEntrega/{kit?}', [
        'uses' => $controller . 'AdministradorGestionController@consultarArticulosKitAdmin',
        'as' => 'listarArticulosKitEntregaAdministrador',
    ]);

});
// RUTAS FUNCIONARIO ************************
Route::group(['prefix' => 'funcionario', 'middleware' => ['permission:FUNC_AUDIOVISUALES']], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    //ruta para vista reservar Articulos
    Route::get('reservasArticulos', [
        'uses' => $controller . 'FuncionarioController@reserva',//cambiar por indexArticulos
        'as' => 'audiovisuales.reservas.articulos.index',
    ]);
    //ruta ajax para vista reservar articulos
    Route::get('reservasArticulosAjax', [
        'uses' => $controller . 'FuncionarioController@reservaindexAjax',//cambiar por indexArticulos
        'as' => 'audiovisuales.reservaArticulo.indexAjax',
    ]);
    //ruta para crear reserva articulos
    Route::post('guardarArticulos', [
        'uses' => $controller . 'FuncionarioController@almacenarArticulo',
        'as' => 'reservaArticulo.store',
    ]);
    Route::post('VistaReservaArticulo', [
        'uses' => $controller . 'FuncionarioController@cargarVistaReservaArticulo',
        'as' => 'cargarVistaReservaArticulos',
    ]);
    //ruta para crear la reserva kit
    Route::post('guardarKits', [
        'uses' => $controller . 'FuncionarioController@storeKit',
        'as' => 'reservaKit.store',
    ]);
    //ruta para vista reservasKits
    Route::get('reservasKits', [
        'uses' => $controller . 'FuncionarioController@reservaKits',//cambiar por indexkit
        'as' => 'audiovisuales.reservas.kits.index',
    ]);
    //ruta para almacenar los datos del selec tipo articulo dispobibles
    Route::get('ListarSelectTipoArticulo', [
        'uses' => $controller . 'FuncionarioController@consultarTiposArticulosDisposnibles',
        'as' => 'cargar.tipoArticulosDisponibles.select',
    ]);
    //ruta para almacenar los datos del selec kits dispobibles
    Route::get('ListarSelectKits', [
        'uses' => $controller . 'FuncionarioController@consultarKitsDisposnibles',
        'as' => 'cargar.kitsDisponibles.select',
    ]);
    //ruta para almacenar los datos del selec kits dispobibles
    Route::get('ListarTextAreaArticulos/{kit?}', [
        'uses' => $controller . 'FuncionarioController@consultarArticulosKit',
        'as' => 'listarArticulosKit',
    ]);
    //ruta para crear funcionario
    Route::post('CrearFuncionario', [
        'uses' => $controller . 'FuncionarioController@storePrograma',
        'as' => 'crearFuncionarioPrograma.storePrograma',
    ]);
    //ruta datatable articulos
    Route::get('dataArticulos', [
        'uses' => $controller . 'FuncionarioController@dataArticulo',
        'as' => 'funcionarioReservas.dataArticulo',
    ]);
    //ruta datatable kits
    Route::get('dataKits', [
        'uses' => $controller . 'FuncionarioController@dataKit',
        'as' => 'funcionarioReservas.dataKit',
    ]);

    Route::get('opcionReservaArticuloFuncionario', [
        'uses' => $controller . 'FuncionarioController@opcionReservaArticuloAjax',
        'as'   => 'opcionReservaArticuloAjax',
    ]);
    Route::post('reservaFormRepeat',[
        'uses' => $controller . 'FuncionarioController@reservaRepeatcrear',
        'as'   => 'reservaRepeat.crear',
    ]);

});
// RUTAS SUPERADMIN **************************
Route::group(['prefix' => 'superAdmin', 'middleware' => ['permission:SUPER_ADMIN_AUDIOVISUALES']], function () {
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
    Route::get('listarEstadoArticulos/{id?}',[
        'uses' => $controller.'ArticuloController@cargarEstadoArticulos',
        'as' => 'cargar.estadoArticulos.select'
    ]);
    Route::post('updateArticulo', [
        'uses' => $controller . 'ArticuloController@update',
        'as'   => 'articulo.update',
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
    //Ruta para editar el Articulo
    Route::get('edit/{id?}', [
        'uses' => $controller . 'ArticuloController@edit',
        'as'   => 'articulo.edit',
    ])->where(['id' => '[0-9]+']);
    Route::get('listar', [
        'uses' => $controller . 'ArticuloController@dataTableArticulos',
        'as'   => 'listarArticulo.data',
    ]);

});