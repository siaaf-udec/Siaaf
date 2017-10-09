<?php
/**
 *  Interacción Universitaria
 */
//RUTA DE EJEMPLO
use App\Container\Users\Src\User;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Container\Gesap\Src\Anteproyecto;
use Illuminate\Support\Facades\DB;

Route::get('/', [
    'as' => 'interaccion.universitaria.index',
    'uses' => function(){
        return view('unvinteraction.Panel_Principal');
    }
]);
$controller = "\\App\\Container\\Unvinteraction\\Src\\Controllers\\";
//_____________________________RUTAS___ADMINISTRADOR________________
Route::get('Administrador', [
    'as' => 'administrador.index',
    'uses' => $controller.'Controller_Administrador@index'
]);

//_____________________CONVENIOS__________________________
Route::get('Convenios', [
    'as' => 'Convenios.Convenios',
    'uses' => $controller.'Controller_Convenios@Convenios'
]);
Route::get('Convenios_Ajax', [
    'as' => 'Convenios_Ajax.Convenios_Ajax',
    'uses' => $controller.'Controller_Convenios@Convenios_Ajax'
]);
Route::get('Mis_Convenios', [
    'as' => 'Mis_Convenios.Mis_Convenios',
    'uses' => $controller.'Controller_Convenios@Mis_Convenios'
]);
Route::get('Listar_Mis_Convenios', [
    'as' => 'Listar_Mis_Convenios.Listar_Mis_Convenios',
    'uses' => $controller.'Controller_Convenios@Listar_Mis_Convenios'
]);
Route::get('Listar_Convenios', [
    'as' => 'Listar_Convenios.Listar_Convenios',
    'uses' => $controller.'Controller_Convenios@Listar_Convenios'
]);

Route::post('Registro_Convenios', [
   'as' => 'Registro_Convenios.Registro_Convenios',
   'uses' => $controller.'Controller_Convenios@Registro_Convenios'
])  ;
Route::get('Editar_Convenios/{id}', [    
    'as' => 'Editar_Convenios.Editar_Convenios', 
    'uses' => $controller.'Controller_Convenios@Editar_Convenios'
]);
Route::post('Modificar_Convenios/{id}', [
    'as' => 'Modificar_Convenios.Modificar_Convenios',
   'uses' => $controller.'Controller_Convenios@Modificar_Convenios'
]);
Route::get('Documentos_Convenios/{id}', [    
    'as' => 'Documentos_Convenios.Documentos_Convenios', 
    'uses' => $controller.'Controller_Convenios@Documentos_Convenios'
]);
Route::post('Agregar_Documento/{id}', [    
    'as' => 'Agregar_Documento.Agregar_Documento', 
    'uses' => $controller.'Controller_Convenios@Agregar_Documento'
]);
Route::get('Listar_Documentos_Convenios/{id}', [    
    'as' => 'Listar_Documentos_Convenios.Listar_Documentos_Convenios', 
    'uses' => $controller.'Controller_Convenios@Listar_Documentos_Convenios'
]);
Route::get('Listar_Participantes_Convenios/{id}', [    
    'as' => 'Listar_Participantes_Convenios.Listar_Participantes_Convenios', 
    'uses' => $controller.'Controller_Convenios@Listar_Participantes_Convenios'
]);
Route::get('Listar_Empresas_Participantes_Convenios/{id}', [    
    'as' => 'Listar_Empresas_Participantes_Convenios.Listar_Empresas_Participantes_Convenios', 
    'uses' => $controller.'Controller_Convenios@Listar_Empresas_Participantes_Convenios'
]);
Route::post('Empresa_Convenio/{id}', [    
    'as' => 'Empresa_Convenio.Empresa_Convenio', 
    'uses' => $controller.'Controller_Convenios@Empresa_Convenio'
]);
Route::post('Participante_Convenio/{id}', [    
    'as' => 'Participante_Convenio.Participante_Convenio', 
    'uses' => $controller.'Controller_Convenios@Participante_Convenio'
]);
// ___________________________END_________CONVENIOS__________
//___________________SEDES_______________

Route::get('Sedes', [
    'as' => 'Sedes.Sedes',
    'uses' => $controller.'Controller_Administrador@Sedes'
]);
Route::get('Sedes_Ajax', [
    'as' => 'Sedes_Ajax.Sedes_Ajax',
    'uses' => $controller.'Controller_Administrador@Sedes_Ajax'
]);
Route::get('Listar_Sedes', [
    'as' => 'Listar_Sedes.Listar_Sedes',
    'uses' => $controller.'Controller_Administrador@Listar_Sedes'
]);
Route::post('Resgistrar_Sedes', [
    'as' => 'Resgistrar_Sedes.Resgistrar_Sedes',
    'uses' => $controller.'Controller_Administrador@Resgistrar_Sedes'
]);
Route::get('Editar_Sedes/{id}', [
    'as' => 'Editar_Sedes.Editar_Sedes',
    'uses' => $controller.'Controller_Administrador@Editar_Sedes'
]);
Route::post('Modificar_Sedes/{id}', [
    'as' => 'Modificar_Sedes.Modificar_Sedes',
    'uses' => $controller.'Controller_Administrador@Modificar_Sedes'
]);
//__________________END___SEDES_______________
//____________________ESTADOS_________________________

Route::get('Estados', [
    'as' => 'Estados.Estados',
    'uses' => $controller.'Controller_Administrador@Estados'
]);
Route::get('Estados_Ajax', [
    'as' => 'Estados_Ajax.Estados_Ajax',
    'uses' => $controller.'Controller_Administrador@Estados_Ajax'
]);
Route::get('Listar_Estados', [
    'as' => 'Listar_Estados.Listar_Estados',
    'uses' => $controller.'Controller_Administrador@Listar_Estados'
]);
Route::post('Resgistrar_Estados', [
    'as' => 'Resgistrar_Estados.Resgistrar_Estados',
    'uses' => $controller.'Controller_Administrador@Resgistrar_Estados'
]);
Route::get('Editar_Estado/{id}', [
    'as' => 'Editar_Estado.Editar_Estado',
    'uses' => $controller.'Controller_Administrador@Editar_Estado'
]);
Route::post('Modificar_Estados/{id}', [
    'as' => 'Modificar_Estados.Modificar_Estados',
    'uses' => $controller.'Controller_Administrador@Modificar_Estados'
]);
//__________________END___ESTADOS_______________________
//______________________EMPRESAS________________________
Route::get('Empresas', [
    'as' => 'Empresas.Empresas',
    'uses' => $controller.'Controller_Administrador@Empresas'
]);
Route::get('Empresas_Ajax', [
    'as' => 'Empresas_Ajax.Empresas_Ajax',
    'uses' => $controller.'Controller_Administrador@Empresas_Ajax'
]);
Route::get('Listar_Empresas', [
    'as' => 'Listar_Empresas.Listar_Empresas',
    'uses' => $controller.'Controller_Administrador@Listar_Empresas'
]);
Route::get('Agregar_Empresas', [
    'as' => 'Agregar_Empresas.Agregar_Empresas',
    'uses' => $controller.'Controller_Administrador@Agregar_Empresas'
]);
Route::post('Registro_Empresa', [
   'as' => 'Registro_Empresa.Registro_Empresa',
   'uses' => $controller.'Controller_Administrador@Registro_Empresa'
]);
Route::get('Editar_Empresa/{id}', [    
    'as' => 'Editar_Empresa.Editar_Empresa', 
    'uses' => $controller.'Controller_Administrador@Editar_Empresa'
]);
Route::post('Modificar_Empresa/{id}', [
    'as' => 'Modificar_Empresa.Modificar_Empresa',
   'uses' => $controller.'Controller_Administrador@Modificar_Empresa'
]);
//__________________END___EMPRESAS_____________________
//_____________________MIS_DOCUMENTOS______________________

Route::get('Mis_Documentos', [
    'as' => 'Mis_Documentos.Mis_Documentos',
   'uses' => $controller.'Controller_Documentos@Mis_Documentos'
]);
Route::get('Listar_Mis_Documentos', [
    'as' => 'Listar_Mis_Documentos.Listar_Mis_Documentos',
   'uses' => $controller.'Controller_Documentos@Listar_Mis_Documentos'
]);
Route::post('Subir_Documento_Usuario', [
    'as' => 'Subir_Documento_Usuario.Subir_Documento_Usuario',
   'uses' => $controller.'Controller_Documentos@Subir_Documento_Usuario'
]);


Route::get('Descarga_Usuario/{id}', [
    'as' => 'Documento_Descarga_Usuario.Documento_Descarga_Usuario',
   'uses' => $controller.'Controller_Documentos@Documento_Descarga_Usuario'
]);

//___________________END_MISDOCUMENTOS______________
//_________________________END____RUTAS___ADMINISTRADOR________________
Route::post('Subir_Documento_Convenio/{id}', [
    'as' => 'Subir_Documento_Convenio.Subir_Documento_Convenio',
   'uses' => $controller.'Controller_Documentos@Subir_Documento_Convenio'
]);
Route::post('Subir_Documento_Convenio_DB/{id}', [
    'as' => 'Subir_Documento_Convenio_DB.Subir_Documento_Convenio_DB',
   'uses' => $controller.'Controller_Documentos@Subir_Documento_Convenio_DB'
]);
Route::get('Descarga/{id}/{idc}', [
    'as' => 'Documento_Descarga.Documento_Descarga',
   'uses' => $controller.'Controller_Documentos@Documento_Descarga'
]);

//__________________________RUTAS_FUNCIONARIOS

Route::get('Tipo_Pregunta', [    
    'as' => 'Tipo_Pregunta.Tipo_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Tipo_Pregunta'
]);
Route::get('Tipo_Pregunta_Ajax', [    
    'as' => 'Tipo_Pregunta_Ajax.Tipo_Pregunta_Ajax', 
    'uses' => $controller.'Controller_Evaluaciones@Tipo_Pregunta_Ajax'
]);
Route::post('Agregar_Tipo_Pregunta', [  
    'as' => 'Agregar_Tipo_Pregunta.Agregar_Tipo_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Agregar_Tipo_Pregunta'
]);
Route::get('Listar_Tipo_Pregunta', [    
    'as' => 'Listar_Tipo_Pregunta.Listar_Tipo_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Listar_Tipo_Pregunta'
]);
Route::get('Editar_Tipo_Pregunta/{id}', [    
    'as' => 'Editar_Tipo_Pregunta.Editar_Tipo_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Editar_Tipo_Pregunta'
]);
Route::post('Modificar_Tipo_Pregunta/{id}', [    
    'as' => 'Modificar_Tipo_Pregunta.Modificar_Tipo_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Modificar_Tipo_Pregunta'
]);
Route::get('Pregunta', [    
    'as' => 'Pregunta.Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Pregunta'
]);
Route::get('Pregunta_Ajax', [    
    'as' => 'Pregunta_Ajax.Pregunta_Ajax', 
    'uses' => $controller.'Controller_Evaluaciones@Pregunta_Ajax'
]);

Route::get('Editar_Pregunta/{id}', [    
    'as' => 'Editar_Pregunta.Editar_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Editar_Pregunta'
]);
Route::post('Modificar_Pregunta/{id}', [    
    'as' => 'Modificar_Pregunta.Modificar_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Modificar_Pregunta'
]);
Route::post('Agregar_Pregunta', [    
    'as' => 'Agregar_Pregunta.Agregar_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Agregar_Pregunta'
]);
Route::get('Listar_Pregunta', [    
    'as' => 'Listar_Pregunta.Listar_Pregunta', 
    'uses' => $controller.'Controller_Evaluaciones@Listar_Pregunta'
]);
Route::get('Evaluaciones', [    
    'as' => 'Evaluaciones.Evaluaciones', 
    'uses' => $controller.'Controller_Evaluaciones@Evaluaciones'
]);
Route::get('Listar_Evaluaciones_Empresas', [    
    'as' => 'Listar_Evaluaciones_Empresas.Listar_Evaluaciones_Empresas', 
    'uses' => $controller.'Controller_Evaluaciones@Listar_Evaluaciones_Empresas'
]);
Route::get('Listar_Evaluaciones_Usuarios', [    
    'as' => 'Listar_Evaluaciones_Usuarios.Listar_Evaluaciones_Usuarios', 
    'uses' => $controller.'Controller_Evaluaciones@Listar_Evaluaciones_Usuarios'
]);
Route::get('Realizar_Evaluacion/{id}/{convenio}', [    
    'as' => 'Realizar_Evaluacion.Realizar_Evaluacion', 
    'uses' => $controller.'Controller_Evaluaciones@Realizar_Evaluacion'
]);
Route::post('Registrar_Evaluacion/{n}/{id}/{convenio}', [    
    'as' => 'Registrar_Evaluacion.Registrar_Evaluacion', 
    'uses' => $controller.'Controller_Evaluaciones@Registrar_Evaluacion'
]);
Route::get('Realizar_Evaluacion_Empresa/{id}/{convenio}', [    
    'as' => 'Realizar_Evaluacion_Empresa.Realizar_Evaluacion_Empresar', 
    'uses' => $controller.'Controller_Evaluaciones@Realizar_Evaluacion_Empresa'
]);
Route::post('Registrar_Evaluacion_Empresa/{n}/{id}/{convenio}', [    
    'as' => 'Registrar_Evaluacion_Empresa.Registrar_Evaluacion_Empresa', 
    'uses' => $controller.'Controller_Evaluaciones@Registrar_Evaluacion_Empresa'
]);
Route::get('Listar_Evaluacion_Empresa/{id}', [    
    'as' => 'Listar_Evaluacion_Empresa.Listar_Evaluacion_Empresa', 
    'uses' => $controller.'Controller_Evaluaciones@Listar_Evaluacion_Empresa'
]);
Route::get('Listar_Evaluacion_Individual/{id}', [    
    'as' => 'Listar_Evaluacion_Individual.Listar_Evaluacion_Individual', 
    'uses' => $controller.'Controller_Evaluaciones@Listar_Evaluacion_Individual'
]);
Route::get('Listar_Pregunta_Evaluacion/{id}', [    
    'as' => 'Listar_Pregunta_Evaluacion.Listar_Pregunta_Evaluacion', 
    'uses' => $controller.'Controller_Evaluaciones@Listar_Pregunta_Evaluacion'
]);
Route::get('Listar_Pregunta_Individual/{id}', [    
    'as' => 'Listar_Pregunta_Individual.Listar_Pregunta_Individual',
    'uses' => $controller.'Controller_Evaluaciones@Listar_Pregunta_Individual'
]);
//_____________________________END_RUTAS_FUNCIONARIOS
