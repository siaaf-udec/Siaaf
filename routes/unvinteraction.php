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
        'uses' => $controller.'controllerConvenios@convenios'
    ]);
    Route::get('conveniosAjax', [
        'as' => 'conveniosAjax.conveniosAjax',
        'uses' => $controller.'controllerConvenios@conveniosAjax'
    ]);
    Route::get('misConvenios', [
        'as' => 'misConvenios.misConvenios',
        'uses' => $controller.'controllerConvenios@misConvenios'
    ]);
    Route::get('listarMisConvenios', [
        'as' => 'listarMisConvenios.listarMisConvenios',
        'uses' => $controller.'controllerConvenios@listarMisConvenios'
    ]);
    Route::get('listarConvenios', [
        'as' => 'listarConvenios.listarConvenios',
        'uses' => $controller.'controllerConvenios@listarConvenios'
    ]);

    Route::post('registroConvenios', [
       'as' => 'registroConvenios.registroConvenios',
       'uses' => $controller.'controllerConvenios@registroConvenios'
    ]);
    Route::get('editarConvenios/{id?}', [    
        'as' => 'editarConvenios.editarConvenios', 
        'uses' => $controller.'controllerConvenios@editarConvenios'
    ]);
    Route::post('modificarConvenios/{id}', [
        'as' => 'modificarConvenios.modificarConvenios',
       'uses' => $controller.'controllerConvenios@modificarConvenios'
    ]);
    Route::get('documentosConvenios/{id}', [    
        'as' => 'documentosConvenios.documentosConvenios', 
        'uses' => $controller.'controllerConvenios@documentosConvenios'
    ]);
    Route::post('agregarDocumento/{id}', [    
        'as' => 'agregarDocumento.agregarDocumento', 
        'uses' => $controller.'controllerConvenios@agregarDocumento'
    ]);
    Route::get('listarDocumentosConvenios/{id}', [    
        'as' => 'listarDocumentosConvenios.listarDocumentosConvenios', 
        'uses' => $controller.'controllerConvenios@listarDocumentosConvenios'
    ]);
    Route::get('listarParticipantesConvenios/{id}', [    
        'as' => 'listarParticipantesConvenios.listarParticipantesConvenios', 
        'uses' => $controller.'controllerConvenios@listarParticipantesConvenios'
    ]);
    Route::get('listarEmpresasParticipantesConvenios/{id}', [    
        'as' => 'listarEmpresasParticipantesConvenios.listarEmpresasParticipantesConvenios', 
        'uses' => $controller.'controllerConvenios@listarEmpresasParticipantesConvenios'
    ]);
    Route::post('empresaConvenio/{id}', [    
        'as' => 'empresaConvenio.empresaConvenio', 
        'uses' => $controller.'controllerConvenios@empresaConvenio'
    ]);
    Route::post('participanteConvenio/{id}', [    
        'as' => 'participanteConvenio.participanteConvenio', 
        'uses' => $controller.'controllerConvenios@participanteConvenio'
    ]);
});
// ___________________________END_________CONVENIOS__________
//___________________SEDES_______________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('sedes', [
        'as' => 'sedes.sedes',
        'uses' => $controller.'controllerAdministrador@sedes'
    ]);
    Route::get('sedesAjax', [
        'as' => 'sedesAjax.sedesAjax',
        'uses' => $controller.'controllerAdministrador@sedesAjax'
    ]);
    Route::get('listarSedes', [
        'as' => 'listarSedes.listarSedes',
        'uses' => $controller.'controllerAdministrador@listarSedes'
    ]);
    Route::post('resgistrarSedes', [
        'as' => 'resgistrarSedes.resgistrarSedes',
        'uses' => $controller.'controllerAdministrador@resgistrarSedes'
    ]);
    Route::get('editarSedes/{id}', [
        'as' => 'editarSedes.editarSedes',
        'uses' => $controller.'controllerAdministrador@editarSedes'
    ]);
    Route::post('modificarSedes/{id}', [
        'as' => 'modificarSedes.modificarSedes',
        'uses' => $controller.'controllerAdministrador@modificarSedes'
    ]);
});
//__________________END___SEDES_______________
//____________________ESTADOS_________________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('estados', [
        'as' => 'estados.estados',
        'uses' => $controller.'controllerAdministrador@estados'
    ]);
    Route::get('estadosAjax', [
        'as' => 'estadosAjax.estadosAjax',
        'uses' => $controller.'controllerAdministrador@estadosAjax'
    ]);
    Route::get('listarEstados', [
        'as' => 'listarEstados.listarEstados',
        'uses' => $controller.'controllerAdministrador@listarEstados'
    ]);
    Route::post('resgistrarEstados', [
        'as' => 'resgistrarEstados.resgistrarEstados',
        'uses' => $controller.'controllerAdministrador@resgistrarEstados'
    ]);
    Route::get('editarEstado/{id}', [
        'as' => 'editarEstado.editarEstado',
        'uses' => $controller.'controllerAdministrador@editarEstado'
    ]);
    Route::post('modificarEstados/{id}', [
        'as' => 'modificarEstados.modificarEstados',
        'uses' => $controller.'controllerAdministrador@modificarEstados'
    ]);
});
//__________________END___ESTADOS_______________________
//______________________EMPRESAS________________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('empresas', [
        'as' => 'empresas.empresas',
        'uses' => $controller.'controllerAdministrador@empresas'
    ]);
    Route::get('empresasAjax', [
        'as' => 'empresasAjax.empresasAjax',
        'uses' => $controller.'controllerAdministrador@empresasAjax'
    ]);
    Route::get('listarEmpresas', [
        'as' => 'listarEmpresas.listarEmpresas',
        'uses' => $controller.'controllerAdministrador@listarEmpresas'
    ]);
    Route::get('agregarEmpresas', [
        'as' => 'agregarEmpresas.agregarEmpresas',
        'uses' => $controller.'controllerAdministrador@agregarEmpresas'
    ]);
    Route::post('registroEmpresa', [
       'as' => 'registroEmpresa.registroEmpresa',
       'uses' => $controller.'controllerAdministrador@registroEmpresa'
    ]);
    Route::get('editarEmpresa/{id}', [    
        'as' => 'editarEmpresa.editarEmpresa', 
        'uses' => $controller.'controllerAdministrador@editarEmpresa'
    ]);
    Route::post('modificarEmpresa/{id}', [
        'as' => 'modificarEmpresa.modificarEmpresa',
       'uses' => $controller.'controllerAdministrador@modificarEmpresa'
    ]);
});
//__________________END___EMPRESAS_____________________
//_____________________DOCUMENTOS______________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('misDocumentos', [
        'as' => 'misDocumentos.misDocumentos',
       'uses' => $controller.'controllerDocumentos@misDocumentos'
    ]);
    Route::get('listarMisDocumentos', [
        'as' => 'listarMisDocumentos.listarMisDocumentos',
       'uses' => $controller.'controllerDocumentos@listarMisDocumentos'
    ]);
    Route::post('subirDocumentoUsuario', [
        'as' => 'subirDocumentoUsuario.subirDocumentoUsuario',
       'uses' => $controller.'controllerDocumentos@subirDocumentoUsuario'
    ]);


    Route::get('descargaUsuario/{id}', [
        'as' => 'documentoDescargaUsuario.documentoDescargaUsuario',
       'uses' => $controller.'controllerDocumentos@documentoDescargaUsuario'
    ]);

    Route::get('documentoReporte/{id}/{fecha_primero}/{fecha_segundo}', [
        'as' => 'documentoReporte.documentoReporte',
       'uses' => $controller.'controllerDocumentos@documentoReporte'
    ]);
    Route::get('descarga/{id}/{idc}', [
        'as' => 'documentoDescarga.documentoDescarga',
       'uses' => $controller.'controllerDocumentos@documentoDescarga'
    ]);
    Route::get('descargarReporte/{id}/{fecha_primero}/{fecha_segundo}', [
        'as' => 'descargarReporte.descargarReporte',
       'uses' => $controller.'controllerDocumentos@descargarReporte'
    ]);
    Route::get('documentoUsuario/{id}', [
        'as' => 'documentoUsuario.documentoUsuario',
       'uses' => $controller.'controllerDocumentos@documentoUsuario'
    ]);
    Route::get('listarDocumentoUsuario/{id}', [
        'as' => 'listarDocumentoUsuario.listarDocumentoUsuario',
       'uses' => $controller.'controllerDocumentos@listarDocumentoUsuario'
    ]);
    Route::post('subirDocumentoConvenio/{id}', [
        'as' => 'subirDocumentoConvenio.subirDocumentoConvenio',
       'uses' => $controller.'controllerDocumentos@subirDocumentoConvenio'
    ]);
    Route::post('subirDocumentoConvenioDB/{id}', [
        'as' => 'subirDocumentoConvenioDB.subirDocumentoConvenioDB',
       'uses' => $controller.'controllerDocumentos@subirDocumentoConvenioDB'
    ]);
});
//___________________END_MISDOCUMENTOS______________

//__________________________RUTAS_FUNCIONARIOS
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {

    Route::get('tipoPregunta', [    
        'as' => 'tipoPregunta.tipoPregunta', 
        'uses' => $controller.'controllerEvaluaciones@tipoPregunta'
    ]);
    Route::get('tipoPreguntaAjax', [    
        'as' => 'tipoPreguntaAjax.tipoPreguntaAjax', 
        'uses' => $controller.'controllerEvaluaciones@tipoPreguntaAjax'
    ]);
    Route::post('agregarTipoPregunta', [  
        'as' => 'agregarTipoPregunta.agregarTipoPregunta', 
        'uses' => $controller.'controllerEvaluaciones@agregarTipoPregunta'
    ]);
    Route::get('listarTipoPregunta', [    
        'as' => 'listarTipoPregunta.listarTipoPregunta', 
        'uses' => $controller.'controllerEvaluaciones@listarTipoPregunta'
    ]);
    Route::get('editarTipoPregunta/{id}', [    
        'as' => 'editarTipoPregunta.editarTipoPregunta', 
        'uses' => $controller.'controllerEvaluaciones@editarTipoPregunta'
    ]);
    Route::post('modificarTipoPregunta/{id}', [    
        'as' => 'modificarTipoPregunta.modificarTipoPregunta', 
        'uses' => $controller.'controllerEvaluaciones@modificarTipoPregunta'
    ]);
    Route::get('pregunta', [    
        'as' => 'pregunta.pregunta', 
        'uses' => $controller.'controllerEvaluaciones@Pregunta'
    ]);
    Route::get('preguntaAjax', [    
        'as' => 'preguntaAjax.preguntaAjax', 
        'uses' => $controller.'controllerEvaluaciones@preguntaAjax'
    ]);

    Route::get('editarPregunta/{id}', [    
        'as' => 'editarPregunta.editarPregunta', 
        'uses' => $controller.'controllerEvaluaciones@editarPregunta'
    ]);
    Route::post('modificarPregunta/{id}', [    
        'as' => 'modificarPregunta.modificarPregunta', 
        'uses' => $controller.'controllerEvaluaciones@modificarPregunta'
    ]);
    Route::post('agregarPregunta', [    
        'as' => 'agregarPregunta.agregarPregunta', 
        'uses' => $controller.'controllerEvaluaciones@agregarPregunta'
    ]);
    Route::get('listarPregunta', [    
        'as' => 'listarPregunta.listarPregunta', 
        'uses' => $controller.'controllerEvaluaciones@listarPregunta'
    ]);
    Route::get('evaluaciones', [    
        'as' => 'evaluaciones.evaluaciones', 
        'uses' => $controller.'controllerEvaluaciones@evaluaciones'
    ]);
    Route::get('listarEvaluacionesEmpresas', [    
        'as' => 'listarEvaluacionesEmpresas.listarEvaluacionesEmpresas', 
        'uses' => $controller.'controllerEvaluaciones@listarEvaluacionesEmpresas'
    ]);
    Route::get('listarEvaluacionesUsuarios', [    
        'as' => 'listarEvaluacionesUsuarios.listarEvaluacionesUsuarios', 
        'uses' => $controller.'controllerEvaluaciones@listarEvaluacionesUsuarios'
    ]);
    Route::get('realizarEvaluacion/{id}/{convenio}', [    
        'as' => 'realizarEvaluacion.realizarEvaluacion', 
        'uses' => $controller.'controllerEvaluaciones@realizarEvaluacion'
    ]);
    Route::post('registrarEvaluacion/{id}/{convenio}/{n}', [    
        'as' => 'registrarEvaluacion.registrarEvaluacion', 
        'uses' => $controller.'controllerEvaluaciones@registrarEvaluacion'
    ]);
    Route::get('realizarEvaluacionEmpresa/{id}/{convenio}', [    
        'as' => 'realizarEvaluacionEmpresa.realizarEvaluacionEmpresar', 
        'uses' => $controller.'controllerEvaluaciones@realizarEvaluacionEmpresa'
    ]);
    Route::post('registrarEvaluacionEmpresa/{id}/{convenio}/{n}', [    
        'as' => 'registrarEvaluacionEmpresa.registrarEvaluacionEmpresa', 
        'uses' => $controller.'controllerEvaluaciones@registrarEvaluacionEmpresa'
    ]);
    Route::get('listarEvaluacionEmpresa/{id}', [    
        'as' => 'listarEvaluacionEmpresa.listarEvaluacionEmpresa', 
        'uses' => $controller.'controllerEvaluaciones@listarEvaluacionEmpresa'
    ]);
    Route::get('listarEvaluacionesUsuario/{id}', [    
        'as' => 'listarEvaluacionesUsuario.listarEvaluacionesUsuario', 
        'uses' => $controller.'controllerEvaluaciones@listarEvaluacionesUsuario'
    ]);
    Route::get('listarEvaluacionIndividual/{id}', [    
        'as' => 'listarEvaluacionIndividual.listarEvaluacionIndividual', 
        'uses' => $controller.'controllerEvaluaciones@listarEvaluacionIndividual'
    ]);
    Route::get('listarEvaluacionIndividualEmpresa/{id}', [    
        'as' => 'listarEvaluacionIndividualEmpresa.listarEvaluacionIndividualEmpresa', 
        'uses' => $controller.'controllerEvaluaciones@listarEvaluacionIndividualEmpresa'
    ]);
    Route::get('listarPreguntaEvaluacion/{id}', [    
        'as' => 'listarPreguntaEvaluacion.listarPreguntaEvaluacion', 
        'uses' => $controller.'controllerEvaluaciones@listarPreguntaEvaluacion'
    ]);
    Route::get('listarPreguntaIndividual/{id}', [    
        'as' => 'listarPreguntaIndividual.listarPreguntaIndividual',
        'uses' => $controller.'controllerEvaluaciones@listarPreguntaIndividual'
    ]);
});
//_____________________________END_RUTAS_FUNCIONARIOS
//______________________________ALERTAS____________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('alerta', [    
        'as' => 'alerta.alerta',
        'uses' => $controller.'controllerAlertas@alerta'
    ]);
    Route::get('alertaAjax', [    
        'as' => 'alertaAjax.alertaAjax',
        'uses' => $controller.'controllerAlertas@alertaAjax'
    ]);
    Route::get('listarAlerta', [    
        'as' => 'listarAlerta.listarAlerta',
        'uses' => $controller.'controllerAlertas@listarAlerta'
    ]);
    Route::get('verAlerta/{id}', [    
        'as' => 'verAlerta.verAlerta',
        'uses' => $controller.'controllerAlertas@verAlerta'
    ]);
});
//__________________________END_ALERTAS____________________
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('reporte/{id}/{fecha_primera}/{fecha_segunda}', [    
        'as' => 'reporte.reporte',
        'uses' => $controller.'controllerEvaluaciones@reporte'
    ]);
    Route::get('listarReporte/{id}/{fecha_primera}/{fecha_segunda}', [    
        'as' => 'listarReporte.listarReporte',
        'uses' => $controller.'controllerEvaluaciones@listarReporte'
    ]);
    Route::post('vistaReporte/{id}', [    
        'as' => 'vistaReporte.vistaReporte',
        'uses' => $controller.'controllerEvaluaciones@vistaReporte'
    ]);
});