<?php
/**
 * Gesap
 */
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

use App\Container\Users\Src\User;

$controller = "\\App\\Container\\Gesap\\Src\\Controllers\\";

Route::resource('min', $controller.'CoordinadorController');
