<?php
/* Gesap*/
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Container\Gesap\Src\Anteproyecto;
use Illuminate\Support\Facades\DB;

$controller = "\\App\\Container\\Gesap\\Src\\Controllers\\";

/*COORDINADOR*/

Route::resource('min', $controller.'CoordinadorController');

Route::get('anteproyecto', [
    'as' => 'anteproyecto.list',
    'uses' => $controller.'CoordinadorController@Lista'
]);

Route::get('anteproyecto/asignar/{id}', [
    'as' => 'anteproyecto.asignar',
    'uses' => $controller.'CoordinadorController@asignar'
]);

Route::post('anteproyecto/docente/', [
    'as' => 'anteproyecto.guardardocente',
    'uses' => $controller.'CoordinadorController@saveAssign'
]);


/*Evaluador*/

Route::resource('evaluar', $controller.'EvaluatorController');

Route::get('ver/director', [
    'as' => 'anteproyecto.index.listdirector',
    'uses' => $controller.'EvaluatorController@director'
]);

Route::get('ver/jurado', [
    'as' => 'anteproyecto.index.listjurado',
    'uses' => $controller.'EvaluatorController@jurado'
]);

Route::get('director', [
    'as' => 'anteproyecto.listdirector',
    'uses' => $controller.'EvaluatorController@ListDirector'
]);

Route::get('jurado', [
    'as' => 'anteproyecto.listjurado',
    'uses' => $controller.'EvaluatorController@ListJurado'
]);

/*Administrador*/

Route::get('admin/users', [
    'as' => 'admin.listusers',
    'uses' => $controller.'AdminController@ListUsers'
]);

Route::resource('admin', $controller.'AdminController');

