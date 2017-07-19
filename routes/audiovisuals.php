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
    Route::put('update/{id?}',[             
    	'uses' => $controller.'FuncionarioController@update',
    	'as' => 'funcionario.update'         
    ])->where(['id' => '[0-9]+']);

    Route::delete('delete/{id?}',[             
        'uses' => $controller.'FuncionarioController@destroy',
        'as' => 'funcionario.delete'         
    ])->where(['id' => '[0-9]+']);
    
    Route::post('create',[             
        'uses' => $controller.'FuncionarioController@store',
        'as' => 'funcionario.create'         
    ]);
});