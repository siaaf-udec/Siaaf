<?php
/**
 * Audiovisuales
 */
Route::group(['middleware' => ['auth']], function () {
    //RUTAS SUPERADMIN gestion ARTICULOS(crear , modificar , eliminar articulos y kits)
    //menu -> gestion articulos,validaciones
    Route::group(['prefix' => 'superAdmin'], function () {
        $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
        //rutas manejo articulos
            Route::get('indexArtiulo', [
                'uses' => $controller . 'ArticuloController@indexArticulo',
                'as' => 'audiovisuales.articulo.indexArticulo',             //ruta que conduce al controlador donde se muestra la gestion de los articulos
            ]);
            Route::get('listarArticulos', [
                'uses' => $controller . 'ArticuloController@dataTableArticulos',
                'as' => 'listarArticulo.data',                              //ruta que que conduce al controlador donde realiza la consulta de los articulos registrados
            ]);
            Route::post('elimarArticuloR', [
                'uses' => $controller . 'ArticuloController@elimarArticulo',
                'as' => 'elimarArticulo',                                   //ruta que que conduce al controlador donde elimina el articulo
            ]);
            Route::get('listarKit/{id?}', [
                'uses' => $controller . 'ArticuloController@cargarKits',    //ruta que que conduce al controlador donde consulta los kits
                'as' => 'cargar.kits.select'
            ]);
            Route::get('listarTipoArticulos/{id?}', [
                'uses' => $controller . 'ArticuloController@cargarTipoArticulosA',
                'as' => 'cargar.tipoArticulos.selectArtciulo'               //ruta que que conduce al controlador donde consulta los tipos de articulos
            ]);
            Route::post('storeArticulo', [
                'uses' => $controller . 'ArticuloController@storeArticulos',
                'as' => 'articulo.store',                                   //ruta que que conduce al controlador donde registra el articulo
            ]);
            Route::post('modificarArticuloR', [
                'uses' => $controller . 'ArticuloController@modificarArticulo',
                'as' => 'articuloModificar',                                //ruta que que conduce al controlador donde  modifica el articulo
            ]);
        // rutas manejo tipo de articulo
            Route::get('indexTipoArtciuloAjaxR', [
                'uses' => $controller . 'ArticuloController@indexTipoArtciuloAjax',
                'as' => 'audiovisuales.gestionTipoArticuloAjax',            //ruta que conduce al controlador donde se muestra la gestion de los tipos de articulos
            ]);
            Route::get('listarTipoArticulosdataR', [
                'uses' => $controller . 'ArticuloController@dataTableTipoArticulos',
                'as' => 'listarTipoArticulos.data',                         //ruta que que conduce al controlador donde realiza la consulta de los tipos de articulos registrados
            ]);
            Route::get('indexValidacionesAjaxR', [
                'uses' => $controller . 'ArticuloController@indexValidacionesAjax',
                'as' => 'audiovisuales.gestionArticulos.ValidacionesAjax',  //ruta que que conduce al controlador donde mustra las validaciones
            ]);
            Route::post('tipoArticuloEliminarR/{idTipoArt?}', [
                'uses' => $controller . 'ArticuloController@tipoArticuloEliminar',
                'as' => 'tipoArticuloEliminarA',                            //ruta que que conduce al controlador donde elimina el tipo de articulo
            ]);
            Route::post('audiovisualesModificaTipoR/{idTipoArt?}', [
                'uses' => $controller . 'ArticuloController@modificarTipoArt',
                'as' => 'audiovisuales.articulo.modificarTipo',             //ruta que que conduce al controlador donde modifica el tipo de articulo
            ]);
            Route::post('storestipoArticulosR', [
                'uses' => $controller . 'ArticuloController@storeTipoArt',
                'as' => 'tipoArticulos.store',                              //ruta que que conduce al controlador donde registra el tipo de articulo
            ]);
            Route::post('articles/check_unique', [
                'uses' => $controller . 'ArticuloController@ajaxUniqueTipoArt',
                'as' => 'tipoArticulo.validar',                            //ruta que que conduce al controlador donde valida un unico nombre de tipo de articulo
            ]);
            Route::get('indexGestionArticuloAjaxR', [
                'uses' => $controller . 'ArticuloController@indexGestionArticuloAjax',
                'as' => 'audiovisuales.gestionArticulos.indexAjax',         //ruta que conduce al controlador donde se muestra la gestion de los articulos
            ]);
        //rutas manejo kit
            Route::get('indexKit', [
                'uses' => $controller . 'ArticuloController@indexKit',
                'as' => 'audiovisuales.articulo.indexKit',                  //ruta que conduce al controlador donde se muestra la gestion de los kits
            ]);
            Route::get('listarKitDataR', [
                'uses' => $controller . 'ArticuloController@dataTableKits',
                'as' => 'listarKit.data',                                   //ruta que que conduce al controlador donde realiza la consulta de los kits registrados
            ]);
            Route::get('crearKit', [
                'uses' => $controller . 'ArticuloController@formRepeatKitAjax',
                'as' => 'audiovisuales.articulo.formRepeatKitAjax',         //ruta que conduce al controlador donde se realiza la creacion de un kit
            ]);
            Route::get('listarTipoArticulosKit', [
                'uses' => $controller . 'ArticuloController@cargarTipoArticulos',
                'as' => 'cargar.tipoArticulos.selectKit'                    //ruta que conduce al controlador donde lista los tipos de articulos registrados
            ]);
            Route::get('AsignarArticuloAlkitR/{idArticulo?}/{idkit?}', [
                'uses' => $controller . 'ArticuloController@asignarArticuloAlkit',
                'as' => 'AsignarArticuloAlkit',                             //ruta que conduce al controladre donde registra el articulo a un kit existente
            ]);
            Route::get('removerArticuloKitR/{idArticulo?}', [
                'uses' => $controller . 'ArticuloController@removerArticuloKit',
                'as' => 'removerArticuloKit',                               //ruta que conduce al controlador donde modifica el articulo de kit
            ]);
            Route::post('storeKit', [
                'uses' => $controller . 'ArticuloController@storeKit',
                'as' => 'kit.store',                                        //ruta que conduce al controlador donde registra el kit

            ]);
            Route::get('indexAjax', [
                'uses' => $controller . 'ArticuloController@indexAjax',
                'as' => 'audiovisuales.gestionKits.indexAjax',              //ruta que conduce al controlador donde se muestra la gestion de los kits
            ]);
            Route::post('kits/check_unique', [
                'uses' => $controller . 'ArticuloController@ajaxUniqueKit',
                'as' => 'kit.validar',                                      //ruta que conduce al controlador donde valida un unico nombre de kit
            ]);
            Route::get('listarCodigoArticuloSeleR/{idTipoArticuloVall?}', [
                'uses' => $controller . 'ArticuloController@codigoArticuloSelect',
                'as' => 'listarCodigoArticuloSele',                         //ruta que conduce al controlador donde consulta codigos de los articulos
            ]);
            Route::get('listarCaracteristicaArticuloR/{codigoArticulo?}', [
                'uses' => $controller . 'ArticuloController@caracteristicaArticulo',
                'as' => 'listarCaracteristicaArticulo',                     //ruta que conduce al controlador donde consulta la descripcion del articulo
            ]);
            Route::get('EliminarKitR/{idKit?}', [
                'uses' => $controller . 'ArticuloController@eliminarKit',
                'as' => 'EliminarKit',                                     //ruta que conduce al controlador donde elimina un kit
            ]);
            Route::get('EliminarKitSoftdeleteR/{idKit?}', [
                'uses' => $controller . 'ArticuloController@eliminarKitSoftdelete',
                'as' => 'EliminarKitSoftdelete',                            //ruta que conduce al controlador donde elimina un kit sin dejar registro
            ]);
            Route::get('articuloskitAjaxR/{idKit?}', [
                'uses' => $controller . 'ArticuloController@articuloskitAjax',
                'as' => 'audiovisuales.articulo.articuloskitAjax',          //ruta que conduce al conrolador donde se midifica el contenido del kit
            ]);
            Route::post('kitModificarR', [
                'uses' => $controller . 'ArticuloController@kitModificar',
                'as' => 'kitModificar',                                     //ruta que conduce al controlador donde modifica el kit

            ]);
        //rutas manejo de la tabla validaciones
            Route::get('validaciones', [
                'uses' => $controller . 'ValidacionController@index',
                'as' => 'audiovisuales.validaciones.index',                 //ruta que conduce al controlador donde muestra las preguntas de validacion
            ]);
            Route::post('task/{task?}', [
                'uses' => $controller . 'ValidacionController@edit',
                'as' => 'validaciones.edit',                                //ruta que conduce al controlador donde se modifica la validacion
            ]);
    });
    //RUTAS GESTION ADMINISTRADOR(crear, modificar , consultar solicitudes de prestamos o reservas)
    //menu -> gestion prestamos
    Route::group(['prefix' => 'administrador'], function () {
        $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
        //rutas manejo ingreso prestamo
        Route::get('index', [
            'uses' => $controller . 'AdministradorGestionController@index',
            'as' => 'audiovisuales.gestionPrestamos.index',                 //ruta que conduce al controlador para entrar a la vista solicitud de prestamo
        ]);
        Route::post('CrearFuncionario', [
            'uses' => $controller . 'AdministradorGestionController@storeProgramaAdmin',
            'as' => 'crearFuncionarioAdmin.storePrograma',                  //ruta que conduce al controlador para registrar programa academico
        ]);
        Route::get('validarInfo/{idFuncionarioA?}', [
            'uses' => $controller . 'AdministradorGestionController@validarFuncionario',
            'as' => 'validarInformacionFuncionario',                        //ruta que conduce al controlador para consultar infomacion del usuario
        ]);
        Route::get('listarProgramas', [
            'uses' => $controller . 'AdministradorGestionController@listarProgramas',
            'as' => 'listarProgramas',                                      //ruta que conduce al controlador para consultar programas academicos
        ]);
        Route::post('identificacion/check_unique', [
            'uses' => $controller . 'AdministradorGestionController@ajaxUniqueIdentificacion',
            'as' => 'identificacion.validar',                   //ruta que conduce al controlador para validar identificacion del usuario
        ]);
        //rutas manejo de asignacion del prestamo
        Route::get('formRepeatAjax', [
            'uses' => $controller . 'AdministradorGestionController@formRepeatAjaxindex',
            'as' => 'opcionPrestamoAjax'                                    //ruta que conduce al controlador para la gestion de asignacion de prestamo
        ]);
        Route::get('cargarKitsSelectKitR', [
            'uses' => $controller . 'AdministradorGestionController@cargarKitsSelect',
            'as' => 'cargar.kits.selectKit'                                 //ruta que conduce al controlador para conultar kits
        ]);
        Route::get('asignarKitR/{idKit?}', [
            'uses' => $controller . 'AdministradorGestionController@actualizarKit',
            'as' => 'asignarKit',                                           //ruta que conduce al controlador para modificar estado del kit
        ]);
        Route::get('removerKitR/{idKit?}', [
            'uses' => $controller . 'AdministradorGestionController@removerKit',
            'as' => 'removerKit',                                           //ruta que conduce al controlador para modificar estado del kit
        ]);
        Route::get('cargarArticulosSelectTipoArticulo', [
            'uses' => $controller . 'AdministradorGestionController@cargarArticuloSelect',
            'as' => 'cargar.articulos.selectTipoArticulo'                   //ruta que conduce al controlador para consultar los tipos de articulos
        ]);
        Route::get('asignarArticuloR/{idArticulo?}', [
            'uses' => $controller . 'AdministradorGestionController@actualizarArticulo',
            'as' => 'asignarArticulo',                                      //ruta que conduce al controlador para modificar estado articulo
        ]);
        Route::get('removerArticuloR/{idArticulo?}', [
            'uses' => $controller . 'AdministradorGestionController@removerArticulo',
            'as' => 'removerArticulo',                                      //ruta que conduce al controlador para modificar estado articulo
        ]);
        Route::get('tiempoArticulo/{idTipoArticulo?}', [
            'uses' => $controller . 'AdministradorGestionController@listarTiempoArticulo',
            'as' => 'listarTiempoArticuloSele',                             //ruta que conduce al controlador para consultar el tiempo del articulo
        ]);
        Route::get('ListarTextAreaArticulos/{kit?}', [
            'uses' => $controller . 'AdministradorGestionController@consultarArticulosKit',
            'as' => 'listarArticulosKitAdministrador',                      //ruta que conduce al controlador para consultar los elementos del kit
        ]);
        Route::get('tiempoKit/{idKit?}', [
            'uses' => $controller . 'AdministradorGestionController@listarTiempoKit',
            'as' => 'listarTiempoKitSele',                                  //ruta que conduce al controlador para consultar el tiempo del kit
        ]);
        Route::post('prestamoFormRepeat', [
            'uses' => $controller . 'AdministradorGestionController@crearPrestamoRepeat',
            'as' => 'prestamoRepeat.crear',                                 //ruta que conduce al controlador para registrar la solicitud
        ]);
        Route::get('indexAjax', [
            'uses' => $controller . 'AdministradorGestionController@indexjax',
            'as' => 'audiovisuales.gestionPrestamos.indexAjax',             //ruta que conduce al controlador para entrar a la vista solicitud de prestamo
        ]);
        //rutas vista finalizacion solicitudes
        Route::get('indexListarSolicitudes', [
            'uses' => $controller . 'AdministradorGestionController@indexSolitudPrestamos',
            'as' => 'audiovisuales.gestionPrestamos.listar',                //ruta que conduce al controlador para mostrar las solcitudes generadas
        ]);
        Route::get('dataUsuariosPrestamos', [
            'uses' => $controller . 'AdministradorGestionController@dataListarFuncionariosPrestamos',
            'as' => 'listarFuncionarios.dataTable',                         //ruta que que conduce al controlador donde realiza la consulta de los prestamos
        ]);
        Route::get('indexTablaEntregaPrestamo/{id_orden?}', [
            'uses' => $controller . 'AdministradorGestionController@indexEntregaPrestamos',
            'as' => 'audiovisuales.EntregasPrestamo.index',                 //ruta que conduce al contorlador para listar el prestamo solicitado
        ]);
        //rutas manejo de finalizacion prestamos y reservas
        Route::get('updateSolicitud/{id_articulo?}/{observation?}', [
            'uses' => $controller . 'AdministradorGestionController@updateSolicitud',
            'as' => 'updatePrestamo',                                       //ruta que conduce al controlador para actualizar la solicitud del prestamo(entrega)
        ]);
        Route::get('indexGestionPrestamosAjax', [
            'uses' => $controller . 'AdministradorGestionController@indexGestionPrestamosAjax',
            'as' => 'audiovisuales.ListarPrestamo2.index',                  //ruta que conduce al controlador para mostrar las solcitudes generadas
        ]);
        Route::get('ListarTextAreaArticulosEntrega/{kit?}', [
            'uses' => $controller . 'AdministradorGestionController@consultarArticulosKitAdmin',
            'as' => 'listarArticulosKitEntregaAdministrador',               //ruta que conduce al controlador para consultar los elementos del kit
        ]);
        Route::get('aumentarTiempoSolicitudR/{id_prestamo?}/{numHoras?}', [
            'uses' => $controller . 'AdministradorGestionController@aumentarTiempoSolicitud',
            'as' => 'aumentarTiempo',                                       //ruta que conduce al controlador para aumentar tiempo al prestamo
        ]);
        Route::post('updateGeneral/{idOrden?}', [
            'uses' => $controller . 'AdministradorGestionController@updatePrestamoGeneral',
            'as' => 'updatesPrestamoGeneral',                               //ruta que conduce al controlador para registrar la entrega del prestamo
        ]);
        Route::post('updateKitAdmin/{idKit?}', [
            'uses' => $controller . 'AdministradorGestionController@updateKitAdmin',
            'as' => 'updateKitAdmin',                                       //ruta que conduce al controlador para registrar la devolucion del kit
        ]);
        Route::POST('modificarTiempoSolicitud/{idPrestamo?}', [
            'uses' => $controller . 'AdministradorGestionController@modificarTiempo',
            'as' => 'moreTimeUpdate',                                       //ruta que conduce al controlador para modificar el tiempo de la solicitud
        ]);
        //rutas vista manejo reservas
        Route::get('gestionReserva', [
            'uses' => $controller . 'AdministradorGestionController@reservaindex',
            'as' => 'reserva.index'                                             //ruta que conduce al controlador donde muestra las reservas solicitadas
        ]);
        Route::get('dataArticulos', [
            'uses' => $controller . 'AdministradorGestionController@dataReservasFuncionarios',
            'as' => 'gestionReserva.dataTable',                                 //ruta que que conduce al controlador donde realiza la consulta de las reservas
        ]);
        //rutas gestion entrega y finzalicion reserva
        Route::get('audiovisuales.ListarReservasAccionesR/{id_orden?}', [
            'uses' => $controller . 'AdministradorGestionController@listarReservasAcciones',
            'as' => 'audiovisuales.ListarReservasAcciones',                     //ruta que conduce al controlador para mostrar la solicitud de la reserva
        ]);
        //rutas vista solicitudes finalizadas
        Route::get('indexPrestamosFinalizadosR', [
            'uses' => $controller . 'AdministradorGestionController@indexPrestamosFinalizados',
            'as' => 'audiovisuales.gestionPrestamos.finalizados',           //ruta que conduce al controlador para mostrar las solicitudes finalzadas
        ]);
        Route::get('solicitudesFinalizadasR', [
            'uses' => $controller . 'AdministradorGestionController@dataListarFuncionariosSolicitudesFinalizadas',
            'as' => 'listarFuncionariosSolicitudesFinalizadas.dataTable',       //ruta que conduce al controlador donde consulta las solicitudes finalizadas
        ]);

    });
    // RUTAS FUNCIONARIO gestion reservas (registro , consulta , finalizacion de la solicitud)
    //menu->gestion de reservas
    Route::group(['prefix' => 'funcionario'], function () {
        $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
        /// Vista Principal Reservas
        Route::get('solicitudReservaR', [
            'uses' => $controller . 'FuncionarioController@solicitudReserva',
            'as' => 'audiovisuales.reservas.solicitud.index',              //ruta que conduce al controlador donde muestra la solicitud de las reservas
        ]);
        Route::post('CrearFuncionario', [
            'uses' => $controller . 'FuncionarioController@storePrograma',
            'as' => 'crearFuncionarioPrograma.storePrograma',              //ruta que conduce al controlador para consultar informacion del usuario
        ]);
        Route::get('reservaFormRepeatIndexR', [
            'uses' => $controller . 'FuncionarioController@dataListarFuncionarioReserva',
            'as' => 'listarFuncionarios.reservas.dataTable',                //ruta que conduce al controlador donde muestra las reservas registradas
        ]);
        Route::get('validarNumeroDeReservasR', [
            'uses' => $controller . 'FuncionarioController@validarNumeroDeReservas',
            'as' => 'validarNumeroDeReservas'                               //ruta que conduce al controlador donde consulta numero de reservas
        ]);
        Route::get('gestionReserva', [
            'uses' => $controller . 'FuncionarioController@reservaFormRepeatIndex',
            'as' => 'reserva.formRepeat.index'                              //ruta que conduce al controlador donde muestra la solcitud de la reserva
        ]);
        // rutas manejo registro reserva
        Route::get('cargarKitsSelectReservaR/{fechaInicial?}', [
            'uses' => $controller . 'FuncionarioController@cargarKitsSelectReserva',
            'as' => 'cargar.kits.selectKit.reserva'                         //ruta que conduce al controlador donde consulta los kits
        ]);
        Route::get('cargarArticulosSelectTipoArticuloReservaR', [
            'uses' => $controller . 'FuncionarioController@cargarArticuloSelectReserva',
            'as' => 'cargar.articulos.selectTipoArticulo.reserva'           //ruta que conduce al controlador donde consulta los tipos de articulos
        ]);
        Route::post('asignarArticuloReservaR/{idArticulo?}/{fechaInicial?}/{tiempoAsignar?}/{numeroOrden?}/{kitArticulo?}', [
            'uses' => $controller . 'FuncionarioController@actualizarArticuloReserva',
            'as' => 'asignarArticuloReserva',                               //ruta que conduce al controlador donde registra articulo o kit a la solicitud reserva
        ]);
        Route::get('eliminarSolicitudReservaR/{idReserva?}', [
            'uses' => $controller . 'FuncionarioController@eliminarSolicitudReser',
            'as' => 'eliminarSolicitudReserva',                             //ruta que conduce al controlador donde cancela el articulo o kit registrado en la solicitud reserva
        ]);
        Route::get('solicitudReservaAjaxR', [
            'uses' => $controller . 'FuncionarioController@solicitudReservaAjax',
            'as' => 'audiovisuales.gestionReservas.gestionReservasAjax',    //ruta que conduce al controlador donde muestra las solicitudes de reserva
        ]);
        Route::get('consultarNumeroDeOrdenR', [
            'uses' => $controller . 'FuncionarioController@numeroOrden',
            'as' => 'consultarUltimoNumeroDeOrden',                         //ruta que conduce al controlador donde consulta el numero de orden de la solicitid
        ]);
        Route::get('listarCodigoArticuloSeleReservaR/{idTipoArticuloVall?}/{fechaInicial?}', [
            'uses' => $controller . 'FuncionarioController@codigoArticuloSelectReserva',
            'as' => 'listarCodigoArticuloSeleReserva',                      //ruta que conduce al controlador donde consulta los articulos disponibles para la fecha de la solicitud
        ]);

    });
});