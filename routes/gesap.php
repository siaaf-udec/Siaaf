<?php
/* Gesap*/
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Container\Gesap\Src\Anteproyecto;
use Illuminate\Support\Facades\DB;

$controller = "\\App\\Container\\Gesap\\Src\\Controllers\\";

/*COORDINADOR
*/
Route::group(['prefix' => 'min', 'middleware' => ['role:Coordinator_Gesap']], function ()use($controller) 
{
    Route::get('/',[
        'uses' => $controller.'CoordinatorController@index',
        'as' => 'min.index'      
    ]);
    
    Route::get('ajax', [
        'as' => 'min.index.ajax',
        'uses' => $controller.'CoordinatorController@index_ajax'
    ]);
    
    Route::get('create',[
        'uses' => $controller.'CoordinatorController@create',
        'as' => 'min.create'
    ]);
    
    Route::post('store',[
        'uses' => $controller.'CoordinatorController@store',
        'as' => 'min.store'
    ]);
    
    Route::get('{id?}/edit',[
        'uses' => $controller.'CoordinatorController@edit',  
        'as' => 'min.edit'
    ]);
    
    Route::post('update',[ 
        'uses' => $controller.'CoordinatorController@update', 
        'as' => 'min.proyecto.update' 
    ]); 
    
     Route::delete('{id?}',[
        'uses' => $controller.'CoordinatorController@destroy',
        'as' => 'min.destroy'
    ]);
});



Route::get('anteproyecto/asignar/{id}', [
    'middleware'=>['permission:Create_Project_Gesap'],
    'as' => 'anteproyecto.asignar',
    'uses' => $controller.'CoordinatorController@assign'
]);

Route::post('anteproyecto/docente/', [
    'as' => 'anteproyecto.guardardocente',
    'uses' => $controller.'CoordinatorController@saveAssign'
]);

Route::post('anteproyecto/observaciones/', [
    'as' => 'anteproyecto.guardar.observaciones',
    'uses' => $controller.'EvaluatorController@storeObservations'
]);

/*Evaluador*/

Route::group(['prefix' => 'evaluar'], function ()use($controller) 
{
Route::get('/',[
        'uses' => $controller.'EvaluatorController@index',
        'as' => 'evaluar.index'      
    ]);
    
    Route::get('index',[
        'uses' => $controller.'EvaluatorController@index',
        'as' => 'evaluar.index'      
    ]);
    
    Route::get('{id}', [
        'as' => 'evaluar.show',
        'uses' => $controller.'EvaluatorController@show'
    ]);    
    
    Route::get('ver/director', [
    'as' => 'anteproyecto.index.directorList',
    'uses' => $controller.'EvaluatorController@director'
    ]);

    Route::get('ver/jurado', [
        'as' => 'anteproyecto.index.juryList',
        'uses' => $controller.'EvaluatorController@jury'
    ]);

    Route::get('observaciones/{id}', [
        'as' => 'anteproyecto.observaciones',
        'uses' => $controller.'EvaluatorController@createObservations'
    ]);

    Route::get('concepto/{id}', [
        'as' => 'anteproyecto.conceptos',
        'uses' => $controller.'EvaluatorController@createConcepts'
    ]);
});



Route::post('anteproyecto/concepto/', [
    'as' => 'anteproyecto.guardar.conceptos',
    'uses' => $controller.'EvaluatorController@storeConcepts'
]);



/*ESTUDIANTE*/
//Route::group(['middleware' => ['permission:Update_Final_Project_Gesap']],function()use($controller){
    
Route::get('evaluar/ver/proyecto', [
    'as' => 'anteproyecto.index.studentList',
    'uses' => $controller.'StudentController@proyecto'
]);

//});

Route::get('estudiante', [
    'as' => 'anteproyecto.studentList',
    'uses' => $controller.'StudentController@studentList'
]);

    
Route::get('anteproyecto', [
    'as' => 'anteproyecto.list',
        'uses' => $controller.'CoordinatorController@projectList'
]);

Route::get('director', [
    'as' => 'anteproyecto.directorList',
    'uses' => $controller.'EvaluatorController@directorList'
]);

Route::get('jurado', [
    'as' => 'anteproyecto.juryList',
    'uses' => $controller.'EvaluatorController@juryList'
]);

Route::get('observaciones/{id}', [
    'as' => 'anteproyecto.observationsList',
    'uses' => $controller.'EvaluatorController@observationsList'
]);







//Descarga de archivos
Route::get('download/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = 'C:\xampp\htdocs\gesap\storage\app/'.$archivo;
     if (Storage::exists($archivo))
       return response()->download($url);
     abort(404);
});

Route::get('ReportAnteproyect',  $controller.'CoordinatorController@indexPDF')->name('ReportAnteproyect'); 
Route::get('downloadPDF',  $controller.'CoordinatorController@createPDF')->name('ReporteAnteproyectosGesap.pdf');