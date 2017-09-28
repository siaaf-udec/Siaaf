<?php
/* Gesap*/
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Container\Gesap\Src\Anteproyecto;
use Illuminate\Support\Facades\DB;

$controller = "\\App\\Container\\Gesap\\Src\\Controllers\\";

/*COORDINADOR
*/
//Route::group(['prefix'=>'Coordinador','middleware'=>['role:Coordinator_Gesap']],function()use($controller){
    Route::resource('min', $controller.'CoordinatorController');
    
Route::get('anteproyecto', [
    'as' => 'anteproyecto.list',
        'uses' => $controller.'CoordinatorController@projectList'
]);

Route::get('anteproyecto/asignar/{id}', [
    'middleware'=>['permission:Create_Project_Gesap'],
    'as' => 'anteproyecto.asignar',
    'uses' => $controller.'CoordinatorController@assign'
]);

Route::post('anteproyecto/docente/', [
    'as' => 'anteproyecto.guardardocente',
    'uses' => $controller.'CoordinatorController@saveAssign'
]);
  
//});


/*Evaluador*/

Route::resource('evaluar', $controller.'EvaluatorController');

Route::get('evaluar/ver/director', [
    'as' => 'anteproyecto.index.directorList',
    'uses' => $controller.'EvaluatorController@director'
]);

Route::get('evaluar/ver/jurado', [
    'as' => 'anteproyecto.index.juryList',
    'uses' => $controller.'EvaluatorController@jury'
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



Route::get('evaluar/observaciones/{id}', [
    'as' => 'anteproyecto.observaciones',
    'uses' => $controller.'EvaluatorController@createObservations'
]);

Route::post('anteproyecto/observaciones/', [
    'as' => 'anteproyecto.guardar.observaciones',
    'uses' => $controller.'EvaluatorController@storeObservations'
]);

Route::get('evaluar/concepto/{id}', [
    'as' => 'anteproyecto.conceptos',
    'uses' => $controller.'EvaluatorController@createConcepts'
]);

Route::post('anteproyecto/concepto/', [
    'as' => 'anteproyecto.guardar.conceptos',
    'uses' => $controller.'EvaluatorController@storeConcepts'
]);



/*ESTUDIANTE*/

Route::get('estudiante', [
    'as' => 'anteproyecto.studentList',
    'uses' => $controller.'StudentController@studentList'
]);

Route::get('evaluar/ver/proyecto', [
    'as' => 'anteproyecto.index.studentList',
    'uses' => $controller.'StudentController@proyecto'
]);



//Descarga de archivos
Route::get('download/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = 'C:\xampp\htdocs\gesap\storage\app/'.$archivo;
     if (Storage::exists($archivo))
       return response()->download($url);
     abort(404);
});
