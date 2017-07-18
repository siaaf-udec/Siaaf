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

Route::get('/', [
    'as' => 'financial.index',
    'uses' => function(){
        return view('financial.example');
    }
]);
