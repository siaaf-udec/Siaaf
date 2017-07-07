<?php
/* Gesap*/

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

use App\Container\Gesap\Src\Anteproyecto;
use Illuminate\Support\Facades\DB;

//RUTA DE EJEMPLO
Route::get('/', [
    'as' => 'gesap.index',
    'uses' => function(){
        return view('gesap.example');
    }
]);



$controller = "\\App\\Container\\Gesap\\Src\\Controllers\\";

Route::resource('min', $controller.'CoordinadorController');

Route::get('anteproyecto', [
    'as' => 'anteproyecto.list',
    'uses' => $controller.'CoordinadorController@Lista'
]);

Route::get('anteproyecto/asignar/{id}', [
    'as' => 'anteproyecto.asignar',
    'uses' => $controller.'CoordinadorController@asignar'
]);
