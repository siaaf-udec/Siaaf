<?php

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Container\Gesap\Src\Anteproyecto;
use Illuminate\Support\Facades\DB;

$controller = "\\App\\Container\\Gesap\\Src\\Controllers\\";

/*COORDINADOR*/
Route::group(['middleware' => ['permission:See_All_Project_Gesap']], function () use ($controller) {
    Route::get('min/', [
        'uses' => $controller.'CoordinatorController@index',
        'as' => 'min.index'
    ]);
    
    Route::get('min/ajax', [
        'as' => 'min.index.ajax',
        'uses' => $controller.'CoordinatorController@indexAjax'
    ]);
    
    Route::delete('min/{id?}', [
        'uses' => $controller.'CoordinatorController@destroy',
        'as' => 'min.destroy'
    ]);
    
    Route::get('project/', [
        'uses' => $controller.'CoordinatorController@indexProject',
        'as' => 'project.index'
    ]);
    Route::delete('project/{id?}', [
        'uses' => $controller.'CoordinatorController@destroyProject',
        'as' => 'project.destroy'
    ]);
    
});
    
Route::group(['middleware' => ['permission:Create_Project_Gesap']], function () use ($controller) {
    Route::get('min/create', [
        'uses' => $controller.'CoordinatorController@create',
        'as' => 'min.create'
    ]);
    
    Route::post('min/store', [
        'uses' => $controller.'CoordinatorController@store',
        'as' => 'min.store'
    ]);

});
Route::group(['middleware' => ['permission:Modify_Project_Gesap']], function () use ($controller) {
    Route::get('min/{id?}/edit', [
        'uses' => $controller.'CoordinatorController@edit',
        'as' => 'min.edit'
    ]);
    
    Route::post('min/update', [
        'uses' => $controller.'CoordinatorController@update',
        'as' => 'min.proyecto.update'
    ]);
});
Route::group(['middleware' => ['permission:Assign_teacher_Gesap']], function () use ($controller) {
    Route::get('min/asignar/{id}', [
        'as' => 'anteproyecto.asignar',
        'uses' => $controller.'CoordinatorController@assign'
    ]);
    
    Route::post('min/store/docente/', [
    'as' => 'anteproyecto.guardardocente',
    'uses' => $controller.'CoordinatorController@saveAssign'
    ]);
});


/*Evaluador*/

Route::group(['middleware' => ['permission:Jury_List_Gesap']], function () use ($controller) {
    Route::get('evaluar/', [
        'uses' => $controller.'EvaluatorController@jury',
        'as' => 'evaluar.index'
    ]);
    
    Route::get('evaluar/index', [
        'uses' => $controller.'EvaluatorController@jury',
        'as' => 'evaluar.index'
    ]);
    
    Route::get('evaluar/ver/jurado', [
        'as' => 'anteproyecto.index.juryList',
        'uses' => $controller.'EvaluatorController@jury'
     ]);
    Route::get('evaluar/observaciones/{id}', [
        'as' => 'anteproyecto.observaciones',
        'uses' => $controller.'EvaluatorController@createObservations'
    ]);

    Route::post('evaluar/store/observaciones/', [
    'as' => 'anteproyecto.guardar.observaciones',
    'uses' => $controller.'EvaluatorController@storeObservations'
    ]);
    
    Route::get('evaluar/concepto/{id}', [
        'as' => 'anteproyecto.conceptos',
        'uses' => $controller.'EvaluatorController@createConcepts'
    ]);
    
    Route::post('evaluar/concepto', [
        'as' => 'anteproyecto.guardar.conceptos',
        'uses' => $controller.'EvaluatorController@storeConcepts'
    ]);
});

Route::group(['middleware' => ['permission:Director_List_Gesap']], function () use ($controller) {
    Route::get('evaluar/ver/director', [
    'as' => 'anteproyecto.index.directorList',
    'uses' => $controller.'EvaluatorController@director'
    ]);
    
    Route::get('evaluar/ver/director/ajax', [
    'as' => 'anteproyecto.index.directorList.ajax',
    'uses' => $controller.'EvaluatorController@directorAjax'
    ]); 
    
    Route::get('evaluar/aprobar/{id}', [
    'as' => 'proyecto.aprobado',
    'uses' => $controller.'EvaluatorController@approved'
    ]);
    
    Route::get('evaluar/cerrar/{id}', [
    'as' => 'proyecto.cerrar',
    'uses' => $controller.'EvaluatorController@closeProject'
    ]);
    
    Route::post('actividades/new', [
        'as' => 'proyecto.nueva.actividad',
        'uses' => $controller.'EvaluatorController@storeActividad'
    ]);
    
    Route::delete('actividades/{id?}', [
        'uses' => $controller.'EvaluatorController@destroyActivity',
        'as' => 'actividad.destroy'
    ]);


});

Route::group(['middleware' => ['permission:See_Observations_Gesap']], function () use ($controller) {
    Route::get('show/{id}', [
        'as' => 'evaluar.show',
        'uses' => $controller.'EvaluatorController@show'
    ]);
});
/*ESTUDIANTE*/

Route::group(['middleware' => ['permission:Update_Final_Project_Gesap']], function () use ($controller) {
        Route::get('evaluar/ver/proyecto', [
        'as' => 'anteproyecto.index.studentList',
        'uses' => $controller.'StudentController@proyecto'
    ]);
    Route::get('evaluar/ver/proyecto/ajax', [
        'as' => 'anteproyecto.index.studentList.ajax',
        'uses' => $controller.'StudentController@proyectoajax'
    ]);
    
    Route::post('actividades/documento', [
        'as' => 'proyecto.actividades.upload',
        'uses' => $controller.'StudentController@uploadActividad'
    ]); 
    
    
});
/*DATATABLES RUTAS*/
Route::get('graficos/', [
        'as' => 'graficos',
        'uses' => $controller.'ReportController@graficos'
    ]); 

Route::get('graficos/data/preliminary', [
        'as' => 'data.chart.preliminary',
        'uses' => $controller.'ReportController@getPreliminary'
    ]); 
Route::get('graficos/data/project', [
        'as' => 'data.chart.project',
        'uses' => $controller.'ReportController@getProject'
    ]); 
Route::get('graficos/data/Jury', [
        'as' => 'data.chart.jury',
        'uses' => $controller.'ReportController@getJury'
    ]); 

Route::get('graficos/data/Director', [
        'as' => 'data.chart.director',
        'uses' => $controller.'ReportController@getDirector'
    ]); 

Route::get('actividades/{id}', [
        'as' => 'proyecto.actividades',
        'uses' => $controller.'StudentController@actividad'
    ]); 

Route::get('estudiante', [
    'as' => 'anteproyecto.studentList',
    'uses' => $controller.'StudentController@studentList'
]);
    
Route::get('anteproyecto', [
    'as' => 'anteproyecto.list',
    'uses' => $controller.'CoordinatorController@preliminaryList'
]);

Route::get('proyecto', [
    'as' => 'proyecto.list',
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


/*DOCUMENTOS*/
Route::get('download/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = 'C:\xampp\htdocs\siaaf\storage\app/'.$archivo;
     if (Storage::exists($archivo))
       return response()->download($url);
     abort(404);
});
Route::get('download/proyecto/{actividad}/{archivo}', function ($actividad, $archivo) { 
     $public_path = public_path(); 
     $url = 'C:\xampp\htdocs\siaaf\storage\app/gesap/proyecto/'.$actividad.'/'.$archivo; 
     if (Storage::exists('gesap/proyecto/'.$actividad.'/'.$archivo)) 
       return response()->download($url); 
    abort(404); 
      
}); 



Route::get('Reporte', $controller.'ReportController@index')->name('report.index');
Route::get('ReportAnteproyect', $controller.'ReportController@allProject')->name('report.all.project');
Route::get('ReportJury/{jury}', $controller.'ReportController@juryProject')->name('report.jury.project');
Route::get('ReportDirector/{director}', $controller.'ReportController@directorProject')->name('report.director.project');
Route::get('downloadPDF', $controller.'ReportController@allProjectPrint')
    ->name('ReporteAnteproyectosGesap.pdf');
