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

Route::get('convenios',['middleware' => ['permission:INTE_VER_CONVENIO'],
    'as' => 'convenios.convenios',
    'uses' => $controller.'ConveniosController@convenios'
]);
Route::get('conveniosAjax',['middleware' => ['permission:INTE_VER_CONVENIO'],
    'as' => 'conveniosAjax.conveniosAjax',
    'uses' => $controller.'ConveniosController@conveniosAjax'
]);
Route::get('misConvenios',['middleware' => ['permission:INTE_VER_MIS_CON'],
    'as' => 'misConvenios.misConvenios',
    'uses' => $controller.'ConveniosController@misConvenios'
]);
Route::get('listarMisConvenios',['middleware' => ['permission:INTE_VER_MIS_CON'],
    'as' => 'listarMisConvenios.listarMisConvenios',
    'uses' => $controller.'ConveniosController@listarMisConvenios'
]);
Route::get('listarConvenios',['middleware' => ['permission:INTE_VER_CONVENIO'],
    'as' => 'listarConvenios.listarConvenios',
    'uses' => $controller.'ConveniosController@listarConvenios'
]);
Route::post('registroConvenios',['middleware' => ['permission:INTE_ADD_CONVENIO'],
   'as' => 'registroConvenios.registroConvenios',
   'uses' => $controller.'ConveniosController@registroConvenios'
]);
Route::get('editarConvenios/{id?}',['middleware' => ['permission:INTE_EDIT_CONVENIO'],   
    'as' => 'editarConvenios.editarConvenios', 
    'uses' => $controller.'ConveniosController@editarConvenios'
]);
Route::post('modificarConvenios/{id?}',['middleware' => ['permission:INTE_EDIT_CONVENIO'],
    'as' => 'modificarConvenios.modificarConvenios',
   'uses' => $controller.'ConveniosController@modificarConvenios'
]);
Route::get('documentosConvenios/{id?}/{estado?}',['middleware' => ['permission:INTE_VER_DATO_CON'],   
    'as' => 'documentosConvenios.documentosConvenios', 
    'uses' => $controller.'ConveniosController@documentosConvenios'
]);
Route::post('agregarDocumento/{id?}',['middleware' => ['permission:INTE_ADD_DOC_CON'],    
    'as' => 'agregarDocumento.agregarDocumento', 
    'uses' => $controller.'ConveniosController@agregarDocumento'
]);
Route::get('listarDocumentosConvenios/{id?}',['middleware' => ['permission:INTE_VER_DATO_CON'],    
    'as' => 'listarDocumentosConvenios.listarDocumentosConvenios', 
    'uses' => $controller.'ConveniosController@listarDocumentosConvenios'
]);
Route::get('listarParticipantesConvenios/{id?}',['middleware' => ['permission:INTE_VER_DATO_CON'],   
    'as' => 'listarParticipantesConvenios.listarParticipantesConvenios', 
    'uses' => $controller.'ConveniosController@listarParticipantesConvenios'
]);
Route::get('listarEmpresasParticipantesConvenios/{id?}',['middleware' => ['permission:INTE_VER_DATO_CON'],    
    'as' => 'listarEmpresasParticipantesConvenios.listarEmpresasParticipantesConvenios', 
    'uses' => $controller.'ConveniosController@listarEmpresasParticipantesConvenios'
]);
Route::post('empresaConvenio/{id?}',['middleware' => ['permission:INTE_ADD_EMP_PARTY'],   
    'as' => 'empresaConvenio.empresaConvenio', 
    'uses' => $controller.'ConveniosController@empresaConvenio'
]);
Route::post('participanteConvenio/{id?}',['middleware' => ['permission:INTE_ADD_PARTI'],    
    'as' => 'participanteConvenio.participanteConvenio', 
    'uses' => $controller.'ConveniosController@participanteConvenio'
]);
Route::delete('eliminarParticipante/{id?}',['middleware' => ['permission:INTE_DELET_PART'],   
    'as' => 'eliminarParticipante.eliminarParticipante', 
    'uses' => $controller.'ConveniosController@eliminarParticipante'
]);
Route::delete('eliminarEmpresa/{id?}',['middleware' => ['permission:INTE_DELET_PART'],    
    'as' => 'eliminarEmpresa.eliminarEmpresa', 
    'uses' => $controller.'ConveniosController@eliminarEmpresa'
]);
///___________________SEDES_______________
Route::get('sedes',['middleware' => ['permission:INTE_VER_SEDES'],
    'as' => 'sedes.sedes',
    'uses' => $controller.'AdministradorController@sedes'
]);
Route::get('sedesAjax',['middleware' => ['permission:INTE_VER_SEDES'],
    'as' => 'sedesAjax.sedesAjax',
    'uses' => $controller.'AdministradorController@sedesAjax'
]);
Route::get('listarSedes',['middleware' => ['permission:INTE_VER_SEDES'],
    'as' => 'listarSedes.listarSedes',
    'uses' => $controller.'AdministradorController@listarSedes'
]);
Route::post('resgistrarSedes',['middleware' => ['permission:INTE_VER_SEDES'],
    'as' => 'resgistrarSedes.resgistrarSedes',
    'uses' => $controller.'AdministradorController@resgistrarSedes'
]);
Route::get('editarSedes/{id?}',['middleware' => ['permission:INTE_VER_SEDES'],
    'as' => 'editarSedes.editarSedes',
    'uses' => $controller.'AdministradorController@editarSedes'
]);
Route::post('modificarSedes/{id?}',['middleware' => ['permission:INTE_VER_SEDES'],
    'as' => 'modificarSedes.modificarSedes',
    'uses' => $controller.'AdministradorController@modificarSedes'
]);
Route::delete('eliminarSedes/{id?}',['middleware' => ['permission:INTE_VER_SEDES'],
    'as' => 'eliminarSedes.eliminarSedes',
    'uses' => $controller.'AdministradorController@eliminarSedes'
]);
///____________________ESTADOS_________________________
Route::get('estados',['middleware' => ['permission:INTE_VER_ESTADOS'],
    'as' => 'estados.estados',
    'uses' => $controller.'AdministradorController@estados'
]);
Route::get('estadosAjax',['middleware' => ['permission:INTE_VER_ESTADOS'],
    'as' => 'estadosAjax.estadosAjax',
    'uses' => $controller.'AdministradorController@estadosAjax'
]);
Route::get('listarEstados',['middleware' => ['permission:INTE_VER_ESTADOS'],
    'as' => 'listarEstados.listarEstados',
    'uses' => $controller.'AdministradorController@listarEstados'
]);
Route::post('resgistrarEstados',['middleware' => ['permission:INTE_VER_ESTADOS'],
    'as' => 'resgistrarEstados.resgistrarEstados',
    'uses' => $controller.'AdministradorController@resgistrarEstados'
]);
Route::get('editarEstado/{id?}',['middleware' => ['permission:INTE_VER_ESTADOS'],
    'as' => 'editarEstado.editarEstado',
    'uses' => $controller.'AdministradorController@editarEstado'
]);
Route::post('modificarEstados/{id?}',['middleware' => ['permission:INTE_VER_ESTADOS'],
    'as' => 'modificarEstados.modificarEstados',
    'uses' => $controller.'AdministradorController@modificarEstados'
]);
Route::delete('eliminarEstado/{id?}',['middleware' => ['permission:INTE_VER_ESTADOS'],
    'as' => 'eliminarEstado.eliminarEstado',
    'uses' => $controller.'AdministradorController@eliminarEstado'
]);
//______________________EMPRESAS________________________
Route::get('empresas',['middleware' => ['permission:INTE_VER_EMPRESAS'],
    'as' => 'empresas.empresas',
    'uses' => $controller.'AdministradorController@empresas'
]);
Route::get('empresasAjax',['middleware' => ['permission:INTE_VER_EMPRESAS'],
    'as' => 'empresasAjax.empresasAjax',
    'uses' => $controller.'AdministradorController@empresasAjax'
]);
Route::get('listarEmpresas',['middleware' => ['permission:INTE_VER_EMPRESAS'],
    'as' => 'listarEmpresas.listarEmpresas',
    'uses' => $controller.'AdministradorController@listarEmpresas'
]);
Route::get('agregarEmpresas',['middleware' => ['permission:INTE_VER_EMPRESAS'],
    'as' => 'agregarEmpresas.agregarEmpresas',
    'uses' => $controller.'AdministradorController@agregarEmpresas'
]);
Route::post('registroEmpresa',['middleware' => ['permission:INTE_VER_EMPRESAS'],
   'as' => 'registroEmpresa.registroEmpresa',
   'uses' => $controller.'AdministradorController@registroEmpresa'
]);
Route::get('editarEmpresa/{id?}',['middleware' => ['permission:INTE_VER_EMPRESAS'],   
    'as' => 'editarEmpresa.editarEmpresa', 
    'uses' => $controller.'AdministradorController@editarEmpresa'
]);
Route::post('modificarEmpresa/{id?}',['middleware' => ['permission:INTE_VER_EMPRESAS'],
    'as' => 'modificarEmpresa.modificarEmpresa',
   'uses' => $controller.'AdministradorController@modificarEmpresa'
]);
//_____________________DOCUMENTOS______________________
Route::get('misDocumentos',['middleware' => ['permission:INTE_VER_MIS_DOC'],
    'as' => 'misDocumentos.misDocumentos',
   'uses' => $controller.'DocumentosController@misDocumentos'
]);
Route::get('listarMisDocumentos',['middleware' => ['permission:INTE_VER_MIS_DOC'],
    'as' => 'listarMisDocumentos.listarMisDocumentos',
   'uses' => $controller.'DocumentosController@listarMisDocumentos'
]);
Route::post('subirDocumentoUsuario',['middleware' => ['permission:INTE_VER_MIS_DOC'],
    'as' => 'subirDocumentoUsuario.subirDocumentoUsuario',
   'uses' => $controller.'DocumentosController@subirDocumentoUsuario'
]);
Route::get('descargaUsuario/{id?}',['middleware' => ['permission:INTE_DES_DOC_USU'],
    'as' => 'documentoDescargaUsuario.documentoDescargaUsuario',
   'uses' => $controller.'DocumentosController@documentoDescargaUsuario'
]);
Route::get('documentoReporte/{id?}/{fecha_primero?}/{fecha_segundo?}',['middleware' => ['permission:INTE_MODULE'],
    'as' => 'documentoReporte.documentoReporte',
   'uses' => $controller.'DocumentosController@documentoReporte'
]);
Route::get('descarga/{id?}/{idc?}',['middleware' => ['permission:INTE_DES_DOC_CON'],
    'as' => 'documentoDescarga.documentoDescarga',
   'uses' => $controller.'DocumentosController@documentoDescarga'
]);
Route::get('descargarReporte/{id?}/{fecha_primero?}/{fecha_segundo?}',['middleware' => ['permission:INTE_MODULE'],
    'as' => 'descargarReporte.descargarReporte',
   'uses' => $controller.'DocumentosController@descargarReporte'
]);
Route::get('documentoUsuario/{id?}/{convenio?}/{estado?}',['middleware' => ['permission:INTE_DES_DOC_USU'],
    'as' => 'documentoUsuario.documentoUsuario',
   'uses' => $controller.'DocumentosController@documentoUsuario'
]);
Route::get('listarDocumentoUsuario/{id?}',['middleware' => ['permission:INTE_MODULE'],
    'as' => 'listarDocumentoUsuario.listarDocumentoUsuario',
   'uses' => $controller.'DocumentosController@listarDocumentoUsuario'
]);
Route::post('subirDocumentoConvenio/{id?}',['middleware' => ['permission:INTE_ADD_DOC_CON'],
    'as' => 'subirDocumentoConvenio.subirDocumentoConvenio',
   'uses' => $controller.'DocumentosController@subirDocumentoConvenio'
]);

Route::post('subirDocumentoConvenioDB/{id?}',['middleware' => ['permission:INTE_ADD_DOC_CON'],
    'as' => 'subirDocumentoConvenioDB.subirDocumentoConvenioDB',
   'uses' => $controller.'DocumentosController@subirDocumentoConvenioDB'
]);
//___________________END_MISDOCUMENTOS_____________
Route::get('tipoPregunta',['middleware' => ['permission:INTE_VER_TIPO_PREG'],    
    'as' => 'tipoPregunta.tipoPregunta', 
    'uses' => $controller.'EvaluacionesController@tipoPregunta'
]);
Route::get('tipoPreguntaAjax',['middleware' => ['permission:INTE_VER_TIPO_PREG'],    
    'as' => 'tipoPreguntaAjax.tipoPreguntaAjax', 
    'uses' => $controller.'EvaluacionesController@tipoPreguntaAjax'
]);
Route::post('agregarTipoPregunta',['middleware' => ['permission:INTE_VER_TIPO_PREG'], 
    'as' => 'agregarTipoPregunta.agregarTipoPregunta', 
    'uses' => $controller.'EvaluacionesController@agregarTipoPregunta'
]);
Route::get('listarTipoPregunta',['middleware' => ['permission:INTE_VER_TIPO_PREG'],   
    'as' => 'listarTipoPregunta.listarTipoPregunta', 
    'uses' => $controller.'EvaluacionesController@listarTipoPregunta'
]);
Route::get('editarTipoPregunta/{id?}',['middleware' => ['permission:INTE_VER_TIPO_PREG'],    
    'as' => 'editarTipoPregunta.editarTipoPregunta', 
    'uses' => $controller.'EvaluacionesController@editarTipoPregunta'
]);
Route::post('modificarTipoPregunta/{id?}',['middleware' => ['permission:INTE_VER_TIPO_PREG'],   
    'as' => 'modificarTipoPregunta.modificarTipoPregunta', 
    'uses' => $controller.'EvaluacionesController@modificarTipoPregunta'
]);
Route::delete('eliminarTipoPregunta/{id?}',['middleware' => ['permission:INTE_VER_TIPO_PREG'],
    'as' => 'eliminarTipoPregunta.eliminarTipoPregunta',
    'uses' => $controller.'EvaluacionesController@eliminarTipoPregunta'
]);
Route::get('pregunta',['middleware' => ['permission:INTE_VER_PREG'],    
    'as' => 'pregunta.pregunta', 
    'uses' => $controller.'EvaluacionesController@Pregunta'
]);
Route::get('preguntaAjax',['middleware' => ['permission:INTE_VER_PREG'],   
    'as' => 'preguntaAjax.preguntaAjax', 
    'uses' => $controller.'EvaluacionesController@preguntaAjax'
]);
Route::get('editarPregunta/{id?}',['middleware' => ['permission:INTE_VER_PREG'],   
    'as' => 'editarPregunta.editarPregunta', 
    'uses' => $controller.'EvaluacionesController@editarPregunta'
]);
Route::post('modificarPregunta/{id?}',['middleware' => ['permission:INTE_VER_PREG'],   
    'as' => 'modificarPregunta.modificarPregunta', 
    'uses' => $controller.'EvaluacionesController@modificarPregunta'
]);
Route::delete('eliminarPregunta/{id?}',['middleware' => ['permission:INTE_VER_PREG'],
    'as' => 'eliminarPregunta.eliminarPregunta',
    'uses' => $controller.'EvaluacionesController@eliminarPregunta'
]);

Route::post('agregarPregunta',['middleware' => ['permission:INTE_VER_PREG'],   
    'as' => 'agregarPregunta.agregarPregunta', 
    'uses' => $controller.'EvaluacionesController@agregarPregunta'
]);
Route::get('listarPregunta',['middleware' => ['permission:INTE_VER_PREG'],   
    'as' => 'listarPregunta.listarPregunta', 
    'uses' => $controller.'EvaluacionesController@listarPregunta'
]);
Route::get('evaluaciones',['middleware' => ['permission:INTE_VER_EVA_PRIN'],    
    'as' => 'evaluaciones.evaluaciones', 
    'uses' => $controller.'EvaluacionesController@evaluaciones'
]);
Route::get('listarEvaluacionesEmpresas',['middleware' => ['permission:INTE_VER_EVA_PRIN'],    
    'as' => 'listarEvaluacionesEmpresas.listarEvaluacionesEmpresas', 
    'uses' => $controller.'EvaluacionesController@listarEvaluacionesEmpresas'
]);
Route::get('listarEvaluacionesUsuarios',['middleware' => ['permission:INTE_VER_EVA_PRIN'],    
    'as' => 'listarEvaluacionesUsuarios.listarEvaluacionesUsuarios', 
    'uses' => $controller.'EvaluacionesController@listarEvaluacionesUsuarios'
]);
Route::get('realizarEvaluacion/{id?}/{convenio?}/{estado?}',['middleware' => ['permission:INTE_EVA_EMPRESA'],   
    'as' => 'realizarEvaluacion.realizarEvaluacion', 
    'uses' => $controller.'EvaluacionesController@realizarEvaluacion'
]);
Route::post('registrarEvaluacion/{id?}/{convenio?}/{n?}',['middleware' => ['permission:INTE_EVA_EMPRESA'],    
    'as' => 'registrarEvaluacion.registrarEvaluacion', 
    'uses' => $controller.'EvaluacionesController@registrarEvaluacion'
]);
Route::get('realizarEvaluacionEmpresa/{id?}/{convenio?}/{estado?}',['middleware' => ['permission:INTE_EVA_PASANTE'],    
    'as' => 'realizarEvaluacionEmpresa.realizarEvaluacionEmpresar', 
    'uses' => $controller.'EvaluacionesController@realizarEvaluacionEmpresa'
]);
Route::post('registrarEvaluacionEmpresa/{id?}/{convenio?}/{n?}',['middleware' => ['permission:INTE_EVA_PASANTE'],   
    'as' => 'registrarEvaluacionEmpresa.registrarEvaluacionEmpresa', 
    'uses' => $controller.'EvaluacionesController@registrarEvaluacionEmpresa'
]);
Route::get('listarEvaluacionEmpresa/{id?}/{convenio?}/{estado?}',['middleware' => ['permission:INTE_VER_EVA'],   
    'as' => 'listarEvaluacionEmpresa.listarEvaluacionEmpresa', 
    'uses' => $controller.'EvaluacionesController@listarEvaluacionEmpresa'
]);
Route::get('listarEvaluacionesUsuario/{id?}/{convenio?}/{estado?}',['middleware' => ['permission:INTE_VER_EVA'],    
    'as' => 'listarEvaluacionesUsuario.listarEvaluacionesUsuario', 
    'uses' => $controller.'EvaluacionesController@listarEvaluacionesUsuario'
]);
Route::get('listarEvaluacionIndividual/{id?}',['middleware' => ['permission:INTE_VER_EVA'],    
    'as' => 'listarEvaluacionIndividual.listarEvaluacionIndividual', 
    'uses' => $controller.'EvaluacionesController@listarEvaluacionIndividual'
]);
Route::get('listarEvaluacionIndividualEmpresa/{id?}',['middleware' => ['permission:INTE_VER_EVA'],   
    'as' => 'listarEvaluacionIndividualEmpresa.listarEvaluacionIndividualEmpresa', 
    'uses' => $controller.'EvaluacionesController@listarEvaluacionIndividualEmpresa'
]);
Route::get('listarPreguntaEvaluacion/{id?}',['middleware' => ['permission:INTE_VER_EVA'],    
    'as' => 'listarPreguntaEvaluacion.listarPreguntaEvaluacion', 
    'uses' => $controller.'EvaluacionesController@listarPreguntaEvaluacion'
]);
Route::get('listarPreguntaIndividual/{id?}',['middleware' => ['permission:INTE_VER_EVA'],    
    'as' => 'listarPreguntaIndividual.listarPreguntaIndividual',
    'uses' => $controller.'EvaluacionesController@listarPreguntaIndividual'
]);
//______________________________ALERTAS____________________
Route::get('alerta',['middleware' => ['permission:INTE_VER_NOTI'],    
    'as' => 'alerta.alerta',
    'uses' => $controller.'AlertasController@alerta'
]);
Route::get('alertaAjax',['middleware' => ['permission:INTE_VER_NOTI'],    
    'as' => 'alertaAjax.alertaAjax',
    'uses' => $controller.'AlertasController@alertaAjax'
]);
Route::get('listarAlerta',['middleware' => ['permission:INTE_VER_NOTI'],   
    'as' => 'listarAlerta.listarAlerta',
    'uses' => $controller.'AlertasController@listarAlerta'
]);
Route::get('verAlerta/{id?}',['middleware' => ['permission:INTE_VER_NOTI'],    
    'as' => 'verAlerta.verAlerta',
    'uses' => $controller.'AlertasController@verAlerta'
]);
//__________________________END_ALERTAS____________________
Route::get('reporte/{id?}/{fechaPrimera?}/{fechaSegunda?}',['middleware' => ['permission:INTE_VER_EVA'],   
    'as' => 'reporte.reporte',
    'uses' => $controller.'EvaluacionesController@reporte'
]);
Route::get('listarReporte/{id?}/{fechaPrimera?}/{fechaSegunda?}',['middleware' => ['permission:INTE_VER_EVA'],   
    'as' => 'listarReporte.listarReporte',
    'uses' => $controller.'EvaluacionesController@listarReporte'
]);
Route::post('vistaReporte/{id?}',['middleware' => ['permission:INTE_VER_EVA'],    
    'as' => 'vistaReporte.vistaReporte',
    'uses' => $controller.'EvaluacionesController@vistaReporte'
]);
