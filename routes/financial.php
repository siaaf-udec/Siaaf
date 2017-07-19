<?php
/**
 * Financiero.
 */
//RUTA DE EJEMPLO

Route::group(['prefix' => 'lol'], function () {
  $controller = "\\App\\Container\\Financial\\Src\\Controllers\\";
  Route::get('/laura', [
      'uses' => $controller.'SampleController@index',
      'as' => 'laura'
  ]);
});

Route::group(['prefix' => 'icetex'], function () {
  $controller = "\\App\\Container\\Financial\\Src\\Controllers\\";
  Route::get('app/index', [
      'uses' => $controller.'IcetexController@index',
      'as' => 'icetex.index'
  ]);
});


Route::get('/', [
    'as' => 'financial.index',
    'uses' => function(){
        return view('financial.example');
    }
]);
