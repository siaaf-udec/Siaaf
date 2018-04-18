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

Route::group(['middleware' => ['permission:INTE_VER_CONVENIO']], function () use ($controller) {
    Route::get('convenios', [
        'as' => 'convenios.convenios',
        'uses' => $controller.'ConveniosController@convenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_CONVENIO']], function () use ($controller) {
    Route::get('conveniosAjax', [
        'as' => 'conveniosAjax.conveniosAjax',
        'uses' => $controller.'ConveniosController@conveniosAjax'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_MIS_CON']], function () use ($controller) {
    Route::get('misConvenios', [
        'as' => 'misConvenios.misConvenios',
        'uses' => $controller.'ConveniosController@misConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_MIS_CON']], function () use ($controller) {
    Route::get('listarMisConvenios', [
        'as' => 'listarMisConvenios.listarMisConvenios',
        'uses' => $controller.'ConveniosController@listarMisConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_CONVENIO']], function () use ($controller) {
    Route::get('listarConvenios', [
        'as' => 'listarConvenios.listarConvenios',
        'uses' => $controller.'ConveniosController@listarConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_ADD_CONVENIO']], function () use ($controller) {
    Route::post('registroConvenios', [
       'as' => 'registroConvenios.registroConvenios',
       'uses' => $controller.'ConveniosController@registroConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_EDIT_CONVENIO']], function () use ($controller) {
    Route::get('editarConvenios/{id?}', [    
        'as' => 'editarConvenios.editarConvenios', 
        'uses' => $controller.'ConveniosController@editarConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_EDIT_CONVENIO']], function () use ($controller) {
    Route::post('modificarConvenios/{id?}', [
        'as' => 'modificarConvenios.modificarConvenios',
       'uses' => $controller.'ConveniosController@modificarConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_DATO_CON']], function () use ($controller) {
    Route::get('documentosConvenios/{id?}/{estado?}', [    
        'as' => 'documentosConvenios.documentosConvenios', 
        'uses' => $controller.'ConveniosController@documentosConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_ADD_DOC_CON']], function () use ($controller) {
    Route::post('agregarDocumento/{id?}', [    
        'as' => 'agregarDocumento.agregarDocumento', 
        'uses' => $controller.'ConveniosController@agregarDocumento'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_DATO_CON']], function () use ($controller) {
    Route::get('listarDocumentosConvenios/{id?}', [    
        'as' => 'listarDocumentosConvenios.listarDocumentosConvenios', 
        'uses' => $controller.'ConveniosController@listarDocumentosConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_DATO_CON']], function () use ($controller) {
    Route::get('listarParticipantesConvenios/{id?}', [    
        'as' => 'listarParticipantesConvenios.listarParticipantesConvenios', 
        'uses' => $controller.'ConveniosController@listarParticipantesConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_DATO_CON']], function () use ($controller) {
    Route::get('listarEmpresasParticipantesConvenios/{id?}', [    
        'as' => 'listarEmpresasParticipantesConvenios.listarEmpresasParticipantesConvenios', 
        'uses' => $controller.'ConveniosController@listarEmpresasParticipantesConvenios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_ADD_EMP_PARTY']], function () use ($controller) {
    Route::post('empresaConvenio/{id?}', [    
        'as' => 'empresaConvenio.empresaConvenio', 
        'uses' => $controller.'ConveniosController@empresaConvenio'
    ]);
});
Route::group(['middleware' => ['permission:INTE_ADD_PARTI']], function () use ($controller) {
    Route::post('participanteConvenio/{id?}', [    
        'as' => 'participanteConvenio.participanteConvenio', 
        'uses' => $controller.'ConveniosController@participanteConvenio'
    ]);
});
Route::group(['middleware' => ['permission:INTE_DELET_PART']], function () use ($controller) {
    Route::delete('eliminarParticipante/{id?}', [    
        'as' => 'eliminarParticipante.eliminarParticipante', 
        'uses' => $controller.'ConveniosController@eliminarParticipante'
    ]);
});
Route::group(['middleware' => ['permission:INTE_DELET_PART']], function () use ($controller) {
    Route::delete('eliminarEmpresa/{id?}', [    
        'as' => 'eliminarEmpresa.eliminarEmpresa', 
        'uses' => $controller.'ConveniosController@eliminarEmpresa'
    ]);
});
// ___________________________END_________CONVENIOS__________
//___________________SEDES_______________
    
Route::group(['middleware' => ['permission:INTE_VER_SEDES']], function () use ($controller) {
    Route::get('sedes', [
        'as' => 'sedes.sedes',
        'uses' => $controller.'AdministradorController@sedes'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_SEDES']], function () use ($controller) {
    Route::get('sedesAjax', [
        'as' => 'sedesAjax.sedesAjax',
        'uses' => $controller.'AdministradorController@sedesAjax'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_SEDES']], function () use ($controller) {
    Route::get('listarSedes', [
        'as' => 'listarSedes.listarSedes',
        'uses' => $controller.'AdministradorController@listarSedes'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_SEDES']], function () use ($controller) {
    Route::post('resgistrarSedes', [
        'as' => 'resgistrarSedes.resgistrarSedes',
        'uses' => $controller.'AdministradorController@resgistrarSedes'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_SEDES']], function () use ($controller) {
    Route::get('editarSedes/{id?}', [
        'as' => 'editarSedes.editarSedes',
        'uses' => $controller.'AdministradorController@editarSedes'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_SEDES']], function () use ($controller) {
    Route::post('modificarSedes/{id?}', [
        'as' => 'modificarSedes.modificarSedes',
        'uses' => $controller.'AdministradorController@modificarSedes'
    ]);
});
//__________________END___SEDES_______________
//____________________ESTADOS_________________________
Route::group(['middleware' => ['permission:INTE_VER_ESTADOS']], function () use ($controller) {
    Route::get('estados', [
        'as' => 'estados.estados',
        'uses' => $controller.'AdministradorController@estados'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_ESTADOS']], function () use ($controller) {
    Route::get('estadosAjax', [
        'as' => 'estadosAjax.estadosAjax',
        'uses' => $controller.'AdministradorController@estadosAjax'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_ESTADOS']], function () use ($controller) {
    Route::get('listarEstados', [
        'as' => 'listarEstados.listarEstados',
        'uses' => $controller.'AdministradorController@listarEstados'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_ESTADOS']], function () use ($controller) {
    Route::post('resgistrarEstados', [
        'as' => 'resgistrarEstados.resgistrarEstados',
        'uses' => $controller.'AdministradorController@resgistrarEstados'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_ESTADOS']], function () use ($controller) {
    Route::get('editarEstado/{id?}', [
        'as' => 'editarEstado.editarEstado',
        'uses' => $controller.'AdministradorController@editarEstado'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_ESTADOS']], function () use ($controller) {
    Route::post('modificarEstados/{id?}', [
        'as' => 'modificarEstados.modificarEstados',
        'uses' => $controller.'AdministradorController@modificarEstados'
    ]);
});

//__________________END___ESTADOS_______________________
//______________________EMPRESAS________________________
Route::group(['middleware' => ['permission:INTE_VER_EMPRESAS']], function () use ($controller) {
    Route::get('empresas', [
        'as' => 'empresas.empresas',
        'uses' => $controller.'AdministradorController@empresas'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EMPRESAS']], function () use ($controller) {
    Route::get('empresasAjax', [
        'as' => 'empresasAjax.empresasAjax',
        'uses' => $controller.'AdministradorController@empresasAjax'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EMPRESAS']], function () use ($controller) {
    Route::get('listarEmpresas', [
        'as' => 'listarEmpresas.listarEmpresas',
        'uses' => $controller.'AdministradorController@listarEmpresas'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EMPRESAS']], function () use ($controller) {
    Route::get('agregarEmpresas', [
        'as' => 'agregarEmpresas.agregarEmpresas',
        'uses' => $controller.'AdministradorController@agregarEmpresas'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EMPRESAS']], function () use ($controller) {
    Route::post('registroEmpresa', [
       'as' => 'registroEmpresa.registroEmpresa',
       'uses' => $controller.'AdministradorController@registroEmpresa'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EMPRESAS']], function () use ($controller) {
    Route::get('editarEmpresa/{id?}', [    
        'as' => 'editarEmpresa.editarEmpresa', 
        'uses' => $controller.'AdministradorController@editarEmpresa'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EMPRESAS']], function () use ($controller) {
    Route::post('modificarEmpresa/{id?}', [
        'as' => 'modificarEmpresa.modificarEmpresa',
       'uses' => $controller.'AdministradorController@modificarEmpresa'
    ]);
});
//__________________END___EMPRESAS_____________________
//_____________________DOCUMENTOS______________________
Route::group(['middleware' => ['permission:INTE_VER_MIS_DOC']], function () use ($controller) {
    Route::get('misDocumentos', [
        'as' => 'misDocumentos.misDocumentos',
       'uses' => $controller.'DocumentosController@misDocumentos'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_MIS_DOC']], function () use ($controller) {
    Route::get('listarMisDocumentos', [
        'as' => 'listarMisDocumentos.listarMisDocumentos',
       'uses' => $controller.'DocumentosController@listarMisDocumentos'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_MIS_DOC']], function () use ($controller) {
    Route::post('subirDocumentoUsuario', [
        'as' => 'subirDocumentoUsuario.subirDocumentoUsuario',
       'uses' => $controller.'DocumentosController@subirDocumentoUsuario'
    ]);
});
Route::group(['middleware' => ['permission:INTE_DES_DOC_USU']], function () use ($controller) {
    Route::get('descargaUsuario/{id?}', [
        'as' => 'documentoDescargaUsuario.documentoDescargaUsuario',
       'uses' => $controller.'DocumentosController@documentoDescargaUsuario'
    ]);
});
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('documentoReporte/{id?}/{fecha_primero?}/{fecha_segundo?}', [
        'as' => 'documentoReporte.documentoReporte',
       'uses' => $controller.'DocumentosController@documentoReporte'
    ]);
});
Route::group(['middleware' => ['permission:INTE_DES_DOC_CON']], function () use ($controller) {
    Route::get('descarga/{id?}/{idc?}', [
        'as' => 'documentoDescarga.documentoDescarga',
       'uses' => $controller.'DocumentosController@documentoDescarga'
    ]);
});
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('descargarReporte/{id?}/{fecha_primero?}/{fecha_segundo?}', [
        'as' => 'descargarReporte.descargarReporte',
       'uses' => $controller.'DocumentosController@descargarReporte'
    ]);
});
Route::group(['middleware' => ['permission:INTE_DES_DOC_USU']], function () use ($controller) {
    Route::get('documentoUsuario/{id?}/{convenio?}/{estado?}', [
        'as' => 'documentoUsuario.documentoUsuario',
       'uses' => $controller.'DocumentosController@documentoUsuario'
    ]);
});
Route::group(['middleware' => ['permission:INTE_MODULE']], function () use ($controller) {
    Route::get('listarDocumentoUsuario/{id?}', [
        'as' => 'listarDocumentoUsuario.listarDocumentoUsuario',
       'uses' => $controller.'DocumentosController@listarDocumentoUsuario'
    ]);
});
Route::group(['middleware' => ['permission:INTE_ADD_DOC_CON']], function () use ($controller) {
    Route::post('subirDocumentoConvenio/{id?}', [
        'as' => 'subirDocumentoConvenio.subirDocumentoConvenio',
       'uses' => $controller.'DocumentosController@subirDocumentoConvenio'
    ]);
});
Route::group(['middleware' => ['permission:INTE_ADD_DOC_CON']], function () use ($controller) {
    Route::post('subirDocumentoConvenioDB/{id?}', [
        'as' => 'subirDocumentoConvenioDB.subirDocumentoConvenioDB',
       'uses' => $controller.'DocumentosController@subirDocumentoConvenioDB'
    ]);
});
//___________________END_MISDOCUMENTOS______________


    
Route::group(['middleware' => ['permission:INTE_VER_TIPO_PREG']], function () use ($controller) {
    Route::get('tipoPregunta', [    
        'as' => 'tipoPregunta.tipoPregunta', 
        'uses' => $controller.'EvaluacionesController@tipoPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_TIPO_PREG']], function () use ($controller) {
    Route::get('tipoPreguntaAjax', [    
        'as' => 'tipoPreguntaAjax.tipoPreguntaAjax', 
        'uses' => $controller.'EvaluacionesController@tipoPreguntaAjax'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_TIPO_PREG']], function () use ($controller) {
    Route::post('agregarTipoPregunta', [  
        'as' => 'agregarTipoPregunta.agregarTipoPregunta', 
        'uses' => $controller.'EvaluacionesController@agregarTipoPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_TIPO_PREG']], function () use ($controller) {
    Route::get('listarTipoPregunta', [    
        'as' => 'listarTipoPregunta.listarTipoPregunta', 
        'uses' => $controller.'EvaluacionesController@listarTipoPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_TIPO_PREG']], function () use ($controller) {
    Route::get('editarTipoPregunta/{id?}', [    
        'as' => 'editarTipoPregunta.editarTipoPregunta', 
        'uses' => $controller.'EvaluacionesController@editarTipoPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_TIPO_PREG']], function () use ($controller) {
    Route::post('modificarTipoPregunta/{id?}', [    
        'as' => 'modificarTipoPregunta.modificarTipoPregunta', 
        'uses' => $controller.'EvaluacionesController@modificarTipoPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_PREG']], function () use ($controller) {
    Route::get('pregunta', [    
        'as' => 'pregunta.pregunta', 
        'uses' => $controller.'EvaluacionesController@Pregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_PREG']], function () use ($controller) {
    Route::get('preguntaAjax', [    
        'as' => 'preguntaAjax.preguntaAjax', 
        'uses' => $controller.'EvaluacionesController@preguntaAjax'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_PREG']], function () use ($controller) {
    Route::get('editarPregunta/{id?}', [    
        'as' => 'editarPregunta.editarPregunta', 
        'uses' => $controller.'EvaluacionesController@editarPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_PREG']], function () use ($controller) {
    Route::post('modificarPregunta/{id?}', [    
        'as' => 'modificarPregunta.modificarPregunta', 
        'uses' => $controller.'EvaluacionesController@modificarPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_PREG']], function () use ($controller) {
    Route::post('agregarPregunta', [    
        'as' => 'agregarPregunta.agregarPregunta', 
        'uses' => $controller.'EvaluacionesController@agregarPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_PREG']], function () use ($controller) {
    Route::get('listarPregunta', [    
        'as' => 'listarPregunta.listarPregunta', 
        'uses' => $controller.'EvaluacionesController@listarPregunta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA_PRIN']], function () use ($controller) {
    Route::get('evaluaciones', [    
        'as' => 'evaluaciones.evaluaciones', 
        'uses' => $controller.'EvaluacionesController@evaluaciones'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA_PRIN']], function () use ($controller) {
    Route::get('listarEvaluacionesEmpresas', [    
        'as' => 'listarEvaluacionesEmpresas.listarEvaluacionesEmpresas', 
        'uses' => $controller.'EvaluacionesController@listarEvaluacionesEmpresas'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA_PRIN']], function () use ($controller) {
    Route::get('listarEvaluacionesUsuarios', [    
        'as' => 'listarEvaluacionesUsuarios.listarEvaluacionesUsuarios', 
        'uses' => $controller.'EvaluacionesController@listarEvaluacionesUsuarios'
    ]);
});
Route::group(['middleware' => ['permission:INTE_EVA_EMPRESA']], function () use ($controller) {
    Route::get('realizarEvaluacion/{id?}/{convenio?}/{estado?}', [    
        'as' => 'realizarEvaluacion.realizarEvaluacion', 
        'uses' => $controller.'EvaluacionesController@realizarEvaluacion'
    ]);
});
Route::group(['middleware' => ['permission:INTE_EVA_EMPRESA']], function () use ($controller) {
    Route::post('registrarEvaluacion/{id?}/{convenio?}/{n?}', [    
        'as' => 'registrarEvaluacion.registrarEvaluacion', 
        'uses' => $controller.'EvaluacionesController@registrarEvaluacion'
    ]);
});
Route::group(['middleware' => ['permission:INTE_EVA_PASANTE']], function () use ($controller) {
    Route::get('realizarEvaluacionEmpresa/{id?}/{convenio?}/{estado?}', [    
        'as' => 'realizarEvaluacionEmpresa.realizarEvaluacionEmpresar', 
        'uses' => $controller.'EvaluacionesController@realizarEvaluacionEmpresa'
    ]);
});
Route::group(['middleware' => ['permission:INTE_EVA_PASANTE']], function () use ($controller) {
    Route::post('registrarEvaluacionEmpresa/{id?}/{convenio?}/{n?}', [    
        'as' => 'registrarEvaluacionEmpresa.registrarEvaluacionEmpresa', 
        'uses' => $controller.'EvaluacionesController@registrarEvaluacionEmpresa'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::get('listarEvaluacionEmpresa/{id?}/{convenio?}/{estado?}', [    
        'as' => 'listarEvaluacionEmpresa.listarEvaluacionEmpresa', 
        'uses' => $controller.'EvaluacionesController@listarEvaluacionEmpresa'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::get('listarEvaluacionesUsuario/{id?}/{convenio?}/{estado?}', [    
        'as' => 'listarEvaluacionesUsuario.listarEvaluacionesUsuario', 
        'uses' => $controller.'EvaluacionesController@listarEvaluacionesUsuario'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::get('listarEvaluacionIndividual/{id?}', [    
        'as' => 'listarEvaluacionIndividual.listarEvaluacionIndividual', 
        'uses' => $controller.'EvaluacionesController@listarEvaluacionIndividual'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::get('listarEvaluacionIndividualEmpresa/{id?}', [    
        'as' => 'listarEvaluacionIndividualEmpresa.listarEvaluacionIndividualEmpresa', 
        'uses' => $controller.'EvaluacionesController@listarEvaluacionIndividualEmpresa'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::get('listarPreguntaEvaluacion/{id?}', [    
        'as' => 'listarPreguntaEvaluacion.listarPreguntaEvaluacion', 
        'uses' => $controller.'EvaluacionesController@listarPreguntaEvaluacion'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::get('listarPreguntaIndividual/{id?}', [    
        'as' => 'listarPreguntaIndividual.listarPreguntaIndividual',
        'uses' => $controller.'EvaluacionesController@listarPreguntaIndividual'
    ]);
});
//______________________________ALERTAS____________________
Route::group(['middleware' => ['permission:INTE_VER_NOTI']], function () use ($controller) {
    Route::get('alerta', [    
        'as' => 'alerta.alerta',
        'uses' => $controller.'AlertasController@alerta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_NOTI']], function () use ($controller) {
    Route::get('alertaAjax', [    
        'as' => 'alertaAjax.alertaAjax',
        'uses' => $controller.'AlertasController@alertaAjax'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_NOTI']], function () use ($controller) {
    Route::get('listarAlerta', [    
        'as' => 'listarAlerta.listarAlerta',
        'uses' => $controller.'AlertasController@listarAlerta'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_NOTI']], function () use ($controller) {
    Route::get('verAlerta/{id?}', [    
        'as' => 'verAlerta.verAlerta',
        'uses' => $controller.'AlertasController@verAlerta'
    ]);
});
//__________________________END_ALERTAS____________________
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::get('reporte/{id?}/{fechaPrimera?}/{fechaSegunda?}', [    
        'as' => 'reporte.reporte',
        'uses' => $controller.'EvaluacionesController@reporte'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::get('listarReporte/{id?}/{fechaPrimera?}/{fechaSegunda?}', [    
        'as' => 'listarReporte.listarReporte',
        'uses' => $controller.'EvaluacionesController@listarReporte'
    ]);
});
Route::group(['middleware' => ['permission:INTE_VER_EVA']], function () use ($controller) {
    Route::post('vistaReporte/{id?}', [    
        'as' => 'vistaReporte.vistaReporte',
        'uses' => $controller.'EvaluacionesController@vistaReporte'
    ]);
});