<?php
/**
 * Financiero.
 */

Route::namespace('Files')->prefix('gestion-de-archivos')->group(function () {
    Route::prefix('cargar')->group(function () {
        Route::get('', [
            'uses' => 'FileController@index',
            'as'   => 'financial.files.index'
        ]);
        Route::post('', [
            'uses' => 'FileController@store',
            'as'   => 'financial.files.store'
        ]);
    });

    Route::resource('solicitudes', 'ManagementController', [
        'names' => [
            'index' => 'financial.files.request.index'
        ]
    ]);
});

Route::namespace('Requests')->prefix('solicitudes')->group(function () {
    Route::namespace('Student')->group(function () {
        Route::resource('supletorios', 'ExtensionRequestController', [
            'names' => [
                'index' => 'financial.requests.student.extension.index',
                'store' => 'financial.requests.student.extension.store',
            ]
        ]);
        Route::resource('adicion-cancelación-de-materias', 'AddSubRequestController', [
            'names' => [
                'index' => 'financial.requests.student.add.sub.index',
                'store' => 'financial.requests.student.add.sub.store',
            ]
        ]);
        Route::resource('validacion', 'ValidationRequestController', [
            'names' => [
                'index' => 'financial.requests.student.validation.index',
                'store' => 'financial.requests.student.validation.store',
            ]
        ]);
        Route::resource('intersemestral', 'IntersemestralRequestController', [
            'names' => [
                'index' => 'financial.requests.student.inter.index',
                'store' => 'financial.requests.student.inter.store',
            ]
        ]);
    });
});