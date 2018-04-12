<?php
/**
 *  Interacción Universitaria
 */
//RUTA DE EJEMPLO


Route::get('/', [
    'as' => 'interaccion.universitaria.index',
    'uses' => function(){
        return view('unvinteraction.Panel_Principal');
    }
]);
$controller = "\\App\\Container\\Unvinteraction\\Src\\Controllers\\";

Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('convenios', [
        'as' => 'convenios.convenios',
        'uses' => $controller.'ControllerConvenios@convenios'
    ]);
    Route::get('conveniosAjax', [
        'as' => 'conveniosAjax.conveniosAjax',
        'uses' => $controller.'ControllerConvenios@conveniosAjax'
    ]);
    Route::get('misConvenios', [
        'as' => 'misConvenios.misConvenios',
        'uses' => $controller.'ControllerConvenios@misConvenios'
    ]);
    Route::get('listarMisConvenios', [
        'as' => 'listarMisConvenios.listarMisConvenios',
        'uses' => $controller.'ControllerConvenios@listarMisConvenios'
    ]);
    Route::get('listarConvenios', [
        'as' => 'listarConvenios.listarConvenios',
        'uses' => $controller.'ControllerConvenios@listarConvenios'
    ]);

    Route::post('registroConvenios', [
       'as' => 'registroConvenios.registroConvenios',
       'uses' => $controller.'ControllerConvenios@registroConvenios'
    ]);
    Route::get('editarConvenios/{id?}', [    
        'as' => 'editarConvenios.editarConvenios', 
        'uses' => $controller.'ControllerConvenios@editarConvenios'
    ]);
    Route::post('modificarConvenios/{id?}', [
        'as' => 'modificarConvenios.modificarConvenios',
       'uses' => $controller.'ControllerConvenios@modificarConvenios'
    ]);
    Route::get('documentosConvenios/{id?}', [    
        'as' => 'documentosConvenios.documentosConvenios', 
        'uses' => $controller.'ControllerConvenios@documentosConvenios'
    ]);
    Route::post('agregarDocumento/{id?}', [    
        'as' => 'agregarDocumento.agregarDocumento', 
        'uses' => $controller.'ControllerConvenios@agregarDocumento'
    ]);
    Route::get('listarDocumentosConvenios/{id?}', [    
        'as' => 'listarDocumentosConvenios.listarDocumentosConvenios', 
        'uses' => $controller.'ControllerConvenios@listarDocumentosConvenios'
    ]);
    Route::get('listarParticipantesConvenios/{id?}', [    
        'as' => 'listarParticipantesConvenios.listarParticipantesConvenios', 
        'uses' => $controller.'ControllerConvenios@listarParticipantesConvenios'
    ]);
    Route::get('listarEmpresasParticipantesConvenios/{id?}', [    
        'as' => 'listarEmpresasParticipantesConvenios.listarEmpresasParticipantesConvenios', 
        'uses' => $controller.'ControllerConvenios@listarEmpresasParticipantesConvenios'
    ]);
    Route::post('empresaConvenio/{id?}', [    
        'as' => 'empresaConvenio.empresaConvenio', 
        'uses' => $controller.'ControllerConvenios@empresaConvenio'
    ]);
    Route::post('participanteConvenio/{id?}', [    
        'as' => 'participanteConvenio.participanteConvenio', 
        'uses' => $controller.'ControllerConvenios@participanteConvenio'
    ]);
});
// ___________________________END_________CONVENIOS__________
//___________________SEDES_______________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('sedes', [
        'as' => 'sedes.sedes',
        'uses' => $controller.'ControllerAdministrador@sedes'
    ]);
    Route::get('sedesAjax', [
        'as' => 'sedesAjax.sedesAjax',
        'uses' => $controller.'ControllerAdministrador@sedesAjax'
    ]);
    Route::get('listarSedes', [
        'as' => 'listarSedes.listarSedes',
        'uses' => $controller.'ControllerAdministrador@listarSedes'
    ]);
    Route::post('resgistrarSedes', [
        'as' => 'resgistrarSedes.resgistrarSedes',
        'uses' => $controller.'ControllerAdministrador@resgistrarSedes'
    ]);
    Route::get('editarSedes/{id?}', [
        'as' => 'editarSedes.editarSedes',
        'uses' => $controller.'ControllerAdministrador@editarSedes'
    ]);
    Route::post('modificarSedes/{id?}', [
        'as' => 'modificarSedes.modificarSedes',
        'uses' => $controller.'ControllerAdministrador@modificarSedes'
    ]);
});
//__________________END___SEDES_______________
//____________________ESTADOS_________________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('estados', [
        'as' => 'estados.estados',
        'uses' => $controller.'ControllerAdministrador@estados'
    ]);
    Route::get('estadosAjax', [
        'as' => 'estadosAjax.estadosAjax',
        'uses' => $controller.'ControllerAdministrador@estadosAjax'
    ]);
    Route::get('listarEstados', [
        'as' => 'listarEstados.listarEstados',
        'uses' => $controller.'ControllerAdministrador@listarEstados'
    ]);
    Route::post('resgistrarEstados', [
        'as' => 'resgistrarEstados.resgistrarEstados',
        'uses' => $controller.'ControllerAdministrador@resgistrarEstados'
    ]);
    Route::get('editarEstado/{id?}', [
        'as' => 'editarEstado.editarEstado',
        'uses' => $controller.'ControllerAdministrador@editarEstado'
    ]);
    Route::post('modificarEstados/{id?}', [
        'as' => 'modificarEstados.modificarEstados',
        'uses' => $controller.'ControllerAdministrador@modificarEstados'
    ]);
});
//__________________END___ESTADOS_______________________
//______________________EMPRESAS________________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('empresas', [
        'as' => 'empresas.empresas',
        'uses' => $controller.'ControllerAdministrador@empresas'
    ]);
    Route::get('empresasAjax', [
        'as' => 'empresasAjax.empresasAjax',
        'uses' => $controller.'ControllerAdministrador@empresasAjax'
    ]);
    Route::get('listarEmpresas', [
        'as' => 'listarEmpresas.listarEmpresas',
        'uses' => $controller.'ControllerAdministrador@listarEmpresas'
    ]);
    Route::get('agregarEmpresas', [
        'as' => 'agregarEmpresas.agregarEmpresas',
        'uses' => $controller.'ControllerAdministrador@agregarEmpresas'
    ]);
    Route::post('registroEmpresa', [
       'as' => 'registroEmpresa.registroEmpresa',
       'uses' => $controller.'ControllerAdministrador@registroEmpresa'
    ]);
    Route::get('editarEmpresa/{id?}', [    
        'as' => 'editarEmpresa.editarEmpresa', 
        'uses' => $controller.'ControllerAdministrador@editarEmpresa'
    ]);
    Route::post('modificarEmpresa/{id?}', [
        'as' => 'modificarEmpresa.modificarEmpresa',
       'uses' => $controller.'ControllerAdministrador@modificarEmpresa'
    ]);
});
//__________________END___EMPRESAS_____________________
//_____________________DOCUMENTOS______________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('misDocumentos', [
        'as' => 'misDocumentos.misDocumentos',
       'uses' => $controller.'ControllerDocumentos@misDocumentos'
    ]);
    Route::get('listarMisDocumentos', [
        'as' => 'listarMisDocumentos.listarMisDocumentos',
       'uses' => $controller.'ControllerDocumentos@listarMisDocumentos'
    ]);
    Route::post('subirDocumentoUsuario', [
        'as' => 'subirDocumentoUsuario.subirDocumentoUsuario',
       'uses' => $controller.'ControllerDocumentos@subirDocumentoUsuario'
    ]);


    Route::get('descargaUsuario/{id?}', [
        'as' => 'documentoDescargaUsuario.documentoDescargaUsuario',
       'uses' => $controller.'ControllerDocumentos@documentoDescargaUsuario'
    ]);

    Route::get('documentoReporte/{id?}/{fecha_primero?}/{fecha_segundo?}', [
        'as' => 'documentoReporte.documentoReporte',
       'uses' => $controller.'ControllerDocumentos@documentoReporte'
    ]);
    Route::get('descarga/{id?}/{idc?}', [
        'as' => 'documentoDescarga.documentoDescarga',
       'uses' => $controller.'ControllerDocumentos@documentoDescarga'
    ]);
    Route::get('descargarReporte/{id?}/{fecha_primero?}/{fecha_segundo?}', [
        'as' => 'descargarReporte.descargarReporte',
       'uses' => $controller.'ControllerDocumentos@descargarReporte'
    ]);
    Route::get('documentoUsuario/{id?}', [
        'as' => 'documentoUsuario.documentoUsuario',
       'uses' => $controller.'ControllerDocumentos@documentoUsuario'
    ]);
    Route::get('listarDocumentoUsuario/{id?}', [
        'as' => 'listarDocumentoUsuario.listarDocumentoUsuario',
       'uses' => $controller.'ControllerDocumentos@listarDocumentoUsuario'
    ]);
    Route::post('subirDocumentoConvenio/{id?}', [
        'as' => 'subirDocumentoConvenio.subirDocumentoConvenio',
       'uses' => $controller.'ControllerDocumentos@subirDocumentoConvenio'
    ]);
    Route::post('subirDocumentoConvenioDB/{id?}', [
        'as' => 'subirDocumentoConvenioDB.subirDocumentoConvenioDB',
       'uses' => $controller.'ControllerDocumentos@subirDocumentoConvenioDB'
    ]);
});
//___________________END_MISDOCUMENTOS______________

//__________________________RUTAS_FUNCIONARIOS
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {

    Route::get('tipoPregunta', [    
        'as' => 'tipoPregunta.tipoPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@tipoPregunta'
    ]);
    Route::get('tipoPreguntaAjax', [    
        'as' => 'tipoPreguntaAjax.tipoPreguntaAjax', 
        'uses' => $controller.'ControllerEvaluaciones@tipoPreguntaAjax'
    ]);
    Route::post('agregarTipoPregunta', [  
        'as' => 'agregarTipoPregunta.agregarTipoPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@agregarTipoPregunta'
    ]);
    Route::get('listarTipoPregunta', [    
        'as' => 'listarTipoPregunta.listarTipoPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@listarTipoPregunta'
    ]);
    Route::get('editarTipoPregunta/{id?}', [    
        'as' => 'editarTipoPregunta.editarTipoPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@editarTipoPregunta'
    ]);
    Route::post('modificarTipoPregunta/{id?}', [    
        'as' => 'modificarTipoPregunta.modificarTipoPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@modificarTipoPregunta'
    ]);
    Route::get('pregunta', [    
        'as' => 'pregunta.pregunta', 
        'uses' => $controller.'ControllerEvaluaciones@Pregunta'
    ]);
    Route::get('preguntaAjax', [    
        'as' => 'preguntaAjax.preguntaAjax', 
        'uses' => $controller.'ControllerEvaluaciones@preguntaAjax'
    ]);

    Route::get('editarPregunta/{id?}', [    
        'as' => 'editarPregunta.editarPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@editarPregunta'
    ]);
    Route::post('modificarPregunta/{id?}', [    
        'as' => 'modificarPregunta.modificarPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@modificarPregunta'
    ]);
    Route::post('agregarPregunta', [    
        'as' => 'agregarPregunta.agregarPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@agregarPregunta'
    ]);
    Route::get('listarPregunta', [    
        'as' => 'listarPregunta.listarPregunta', 
        'uses' => $controller.'ControllerEvaluaciones@listarPregunta'
    ]);
    Route::get('evaluaciones', [    
        'as' => 'evaluaciones.evaluaciones', 
        'uses' => $controller.'ControllerEvaluaciones@evaluaciones'
    ]);
    Route::get('listarEvaluacionesEmpresas', [    
        'as' => 'listarEvaluacionesEmpresas.listarEvaluacionesEmpresas', 
        'uses' => $controller.'ControllerEvaluaciones@listarEvaluacionesEmpresas'
    ]);
    Route::get('listarEvaluacionesUsuarios', [    
        'as' => 'listarEvaluacionesUsuarios.listarEvaluacionesUsuarios', 
        'uses' => $controller.'ControllerEvaluaciones@listarEvaluacionesUsuarios'
    ]);
    Route::get('realizarEvaluacion/{id?}/{convenio?}', [    
        'as' => 'realizarEvaluacion.realizarEvaluacion', 
        'uses' => $controller.'ControllerEvaluaciones@realizarEvaluacion'
    ]);
    Route::post('registrarEvaluacion/{id?}/{convenio?}/{n?}', [    
        'as' => 'registrarEvaluacion.registrarEvaluacion', 
        'uses' => $controller.'ControllerEvaluaciones@registrarEvaluacion'
    ]);
    Route::get('realizarEvaluacionEmpresa/{id?}/{convenio?}', [    
        'as' => 'realizarEvaluacionEmpresa.realizarEvaluacionEmpresar', 
        'uses' => $controller.'ControllerEvaluaciones@realizarEvaluacionEmpresa'
    ]);
    Route::post('registrarEvaluacionEmpresa/{id?}/{convenio?}/{n?}', [    
        'as' => 'registrarEvaluacionEmpresa.registrarEvaluacionEmpresa', 
        'uses' => $controller.'ControllerEvaluaciones@registrarEvaluacionEmpresa'
    ]);
    Route::get('listarEvaluacionEmpresa/{id?}', [    
        'as' => 'listarEvaluacionEmpresa.listarEvaluacionEmpresa', 
        'uses' => $controller.'ControllerEvaluaciones@listarEvaluacionEmpresa'
    ]);
    Route::get('listarEvaluacionesUsuario/{id?}', [    
        'as' => 'listarEvaluacionesUsuario.listarEvaluacionesUsuario', 
        'uses' => $controller.'ControllerEvaluaciones@listarEvaluacionesUsuario'
    ]);
    Route::get('listarEvaluacionIndividual/{id?}', [    
        'as' => 'listarEvaluacionIndividual.listarEvaluacionIndividual', 
        'uses' => $controller.'ControllerEvaluaciones@listarEvaluacionIndividual'
    ]);
    Route::get('listarEvaluacionIndividualEmpresa/{id?}', [    
        'as' => 'listarEvaluacionIndividualEmpresa.listarEvaluacionIndividualEmpresa', 
        'uses' => $controller.'ControllerEvaluaciones@listarEvaluacionIndividualEmpresa'
    ]);
    Route::get('listarPreguntaEvaluacion/{id?}', [    
        'as' => 'listarPreguntaEvaluacion.listarPreguntaEvaluacion', 
        'uses' => $controller.'ControllerEvaluaciones@listarPreguntaEvaluacion'
    ]);
    Route::get('listarPreguntaIndividual/{id?}', [    
        'as' => 'listarPreguntaIndividual.listarPreguntaIndividual',
        'uses' => $controller.'ControllerEvaluaciones@listarPreguntaIndividual'
    ]);
});
//_____________________________END_RUTAS_FUNCIONARIOS
//______________________________ALERTAS____________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('alerta', [    
        'as' => 'alerta.alerta',
        'uses' => $controller.'ControllerAlertas@alerta'
    ]);
    Route::get('alertaAjax', [    
        'as' => 'alertaAjax.alertaAjax',
        'uses' => $controller.'ControllerAlertas@alertaAjax'
    ]);
    Route::get('listarAlerta', [    
        'as' => 'listarAlerta.listarAlerta',
        'uses' => $controller.'ControllerAlertas@listarAlerta'
    ]);
    Route::get('verAlerta/{id?}', [    
        'as' => 'verAlerta.verAlerta',
        'uses' => $controller.'ControllerAlertas@verAlerta'
    ]);
});
//__________________________END_ALERTAS____________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('reporte/{id?}/{fecha_primera?}/{fecha_segunda?}', [    
        'as' => 'reporte.reporte',
        'uses' => $controller.'ControllerEvaluaciones@reporte'
    ]);
    Route::get('listarReporte/{id?}/{fecha_primera?}/{fecha_segunda?}', [    
        'as' => 'listarReporte.listarReporte',
        'uses' => $controller.'ControllerEvaluaciones@listarReporte'
    ]);
    Route::post('vistaReporte/{id?}', [    
        'as' => 'vistaReporte.vistaReporte',
        'uses' => $controller.'ControllerEvaluaciones@vistaReporte'
    ]);
});