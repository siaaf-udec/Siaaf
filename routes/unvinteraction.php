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
//__________________________RUTAS_FUNCIONARIOS
Route::get('funcionarios', [
    'as' => 'funcionarios.index',
    'uses' => $controller.'Controller_Menu_Funcionario@index'
]);
        //________USUARIOS__________________________________________
Route::get('Listar_Usuarios', [
    'as' => 'Listar_Usuarios.index',
    'uses' => $controller.'Controller_Listar_Usuarios_Funcionario@index'
]);

Route::get('Listar', [
    'as' => 'Listar.listar',
    'uses' => $controller.'Controller_Listar_Usuarios_Funcionario@listar'
]);

Route::get('ListarD/{id}', [
    'as' => 'ListarD.listar',
    'uses' => $controller.'Controller_Listar_Usuarios_Funcionario@listarD'
]);


Route::get('Agregar_Usuarios', [
    'as' => 'Agregar_Usuarios.index',
    'uses' => $controller.'Controller_Listar_Usuarios_Funcionario@create'
]);
Route::get('/Editar_Usuarios/{id}', [    
    'as' => 'Esitar_Usuarios.edit', 
    'uses' => $controller.'Controller_Listar_Usuarios_Funcionario@edit'
]);
           //________END___USUARIOS__________________________________________
            //________CONVENIOS__________________________________________
Route::get('Listar_Convenios', [
    'as' => 'Listar_Convenios.index',
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@index'
]);
Route::get('ListarC', [
    'as' => 'ListarC.listar',
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@listar'
]);
Route::get('ListarDC/{id}', [
    'as' => 'ListarDC.listar',
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@listarDC'
]);
Route::get('ListarPC/{id}', [
    'as' => 'ListarPC.listar',
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@listarPC'
]);
Route::get('ListarEPC/{id}', [
    'as' => 'ListarEPC.listar',
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@listarEPC'
]);

Route::get('Agregar_Convenios', [
    'as' => 'Agregar_Convenios.index',
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@create'
]);
Route::get('/Editar_Convenios/{id}', [    
    'as' => 'Esitar_Convenios.edit', 
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@edit'
]);

        //________END___CONVENIOS__________________________________________

Route::get('/Documentos_Usuarios/{id}', [    
    'as' => 'Documentos_Usuarios.documentacion', 
    'uses' => $controller.'Controller_Listar_Usuarios_Funcionario@documentacion'
]);
Route::get('/Documentos_Convenios/{id}', [    
    'as' => 'Documentos_Convenios.documentacion', 
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@documentacion'
]);

Route::post('Evaluaciones_Convenios', [    
    'as' => 'Evaluaciones_Convenios.evaluaciones', 
    'uses' => $controller.'Controller_Listar_Convenios_Funcionario@evaluaciones'
]);







Route::resource('Registro_Convenio',$controller.'Controller_Listar_Convenios_Funcionario');
Route::resource('Registro_Usuario',$controller.'Controller_Listar_Usuarios_Funcionario');
Route::resource('Mod_Convenios',$controller.'Controller_Listar_Convenios_Funcionario');
Route::resource('Mod_Usuarios',$controller.'Controller_Listar_Usuarios_Funcionario');



//_____________________________END_RUTAS_FUNCIONARIOS