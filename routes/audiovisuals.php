<?php
/**
 * Audiovisuales
 */

Route::get('/', [
    'as' => 'audiovisuales.index',
    'uses' => function(){
        return view('audiovisuals.example');
    }
]);




Route::group(['prefix' => 'funcionario'], function () {
    $controller = "\\App\\Container\\Audiovisuals\\Src\\Controllers\\";
    Route::get('index',[
	    'uses' => $controller.'FuncionarioController@index',
	    'as' => 'funcionario.index'
    ]);
    Route::get('listing',[
        'uses' => $controller.'FuncionarioController@listing',
        'as' => 'funcionario.listing'
    ]);
    Route::get('all/{id}',[
        'uses' => $controller.'FuncionarioController@all',
        'as' => 'funcionario.all'
    ]);
    Route::get('editar/{id}',[
        'uses' => $controller.'FuncionarioController@update',
        'as' => 'funcionario.editar'
    ]);
});