<?php
/**
 * Financiero.
 */

Route::middleware( ['permission:FINAN_MODULE'] )->group( function () {

    Route::namespace('Files')->prefix('gestion-de-archivos')->group(function () {
        Route::prefix('solicitudes')->group(function () {
            /**
             * File Upload by students
             */
            Route::middleware(['role:financial_student'])->resource('estudiantes', 'FileController', [
                'only'  =>  ['index', 'store', 'update', 'show'],
                'names' => [
                    'index'     =>  'financial.files.index',
                    'show'     =>  'financial.files.show',
                    'store'     =>  'financial.files.store',
                    'update'    =>  'financial.files.update',
                ],
                'parameters' => ['estudiantes' => 'id']
            ]);
            /**
             * File management approves
             */
            Route::middleware(['role:financial_administrator'])->resource('aprobaciones', 'ManagementController', [
                'only'  =>  ['index', 'update'],
                'names' => [
                    'index' => 'financial.files.request.index',
                    'update' => 'financial.files.request.update'
                ],
                'parameters' => ['aprobaciones' => 'id']
            ]);
        });
    });

    Route::namespace('Requests')->middleware(['role:financial_student'])->prefix('solicitudes')->group(function () {
        Route::namespace('Student')->group(function () {
            Route::resource('supletorios', 'ExtensionRequestController', [
                'names' => [
                    'index'  => 'financial.requests.student.extension.index',
                    'create' => 'financial.requests.student.extension.create',
                    'store'  => 'financial.requests.student.extension.store',
                    'edit'   => 'financial.requests.student.extension.edit',
                    'show'   => 'financial.requests.student.extension.show',
                    'update' => 'financial.requests.student.extension.update',
                    'destroy'=> 'financial.requests.student.extension.destroy',
                ],
                'parameters' => ['supletorios' => 'id']
            ]);
            Route::resource('adicion-cancelacion-de-materias', 'AddSubRequestController', [
                'names' => [
                    'index'  => 'financial.requests.student.add-sub.index',
                    'create' => 'financial.requests.student.add-sub.create',
                    'store'  => 'financial.requests.student.add-sub.store',
                    'edit'   => 'financial.requests.student.add-sub.edit',
                    'show'   => 'financial.requests.student.add-sub.show',
                    'update' => 'financial.requests.student.add-sub.update',
                    'destroy'=> 'financial.requests.student.add-sub.destroy',
                ],
                'parameters' => ['adicion-cancelacion-de-materias' => 'id']
            ]);
            Route::resource('validacion', 'ValidationRequestController', [
                'names' => [
                    'index'  => 'financial.requests.student.validation.index',
                    'create' => 'financial.requests.student.validation.create',
                    'store'  => 'financial.requests.student.validation.store',
                    'edit'   => 'financial.requests.student.validation.edit',
                    'show'   => 'financial.requests.student.validation.show',
                    'update' => 'financial.requests.student.validation.update',
                    'destroy'=> 'financial.requests.student.validation.destroy',
                ],
                'parameters' => ['validacion' => 'id']
            ]);
            Route::resource('intersemestral', 'IntersemestralRequestController', [
                'names' => [
                    'index'  => 'financial.requests.student.intersemestral.index',
                    'create' => 'financial.requests.student.intersemestral.create',
                    'store'  => 'financial.requests.student.intersemestral.store',
                    'show'   => 'financial.requests.student.intersemestral.show',
                    'edit'   => 'financial.requests.student.intersemestral.edit',
                    'update'   => 'financial.requests.student.intersemestral.update',
                    'destroy'=> 'financial.requests.student.intersemestral.destroy',
                ],
                'parameters' => ['intersemestral' => 'id']
            ]);
        });
    });

    Route::namespace('Cash')->prefix('caja-menor')->group( function () {
        Route::get('', [
            'as'    => 'financial.cash.index',
            'uses'  => 'PettyCashController@index'
        ]);
    });

    Route::namespace('Approval')->middleware(['role:financial_administrator|financial_secretary'])->prefix('administrativo')->group( function () {
        Route::prefix('aprobaciones')->group(function () {
            Route::resource('supletorios', 'ApprovalExtensionController', [
                'only'  => ['index', 'update'],
                'names' => [
                    'index'  => 'financial.admin.approval.extension.index',
                    'update' => 'financial.admin.approval.extension.update',
                ],
                'parameters' => ['supletorios' => 'id']
            ]);
            Route::resource('validaciones', 'ApprovalValidationController', [
                'only'  => ['index', 'update'],
                'names' => [
                    'index'  => 'financial.admin.approval.validation.index',
                    'update' => 'financial.admin.approval.validation.update',
                ],
                'parameters' => ['validaciones' => 'id']
            ]);
            Route::resource('adicion-cancelacion', 'ApprovalAdditionSubtractionController', [
                'only'  => ['index', 'update'],
                'names' => [
                    'index'  => 'financial.admin.approval.addition.subtraction.index',
                    'update' => 'financial.admin.approval.addition.subtraction.update',
                ],
                'parameters' => ['adicion-cancelacion' => 'id']
            ]);
            Route::resource('intersemestral', 'ApprovalIntersemestralController', [
                'only'  => ['index', 'update', 'store'],
                'names' => [
                    'index'  => 'financial.admin.approval.intersemestral.index',
                    'update' => 'financial.admin.approval.intersemestral.update',
                    'store' => 'financial.admin.approval.intersemestral.store',
                ],
                'parameters' => ['intersemestral' => 'id']
            ]);
        });
    });

    Route::namespace('Management')->prefix('recursos')->group( function () {

        /**
         * Approval Management
         */
        Route::middleware(['role:financial_administrator|financial_secretary'])->resource('programas', 'ManageProgramsController', [
            'only'  =>  ['index', 'store', 'update', 'destroy'],
            'names' => [
                'index'     => 'financial.management.programs.index',
                'store'     => 'financial.management.programs.store',
                'update'    => 'financial.management.programs.update',
                'destroy'   => 'financial.management.programs.destroy',
            ],
            'parameters' => ['programas' => 'id']
        ]);

        /**
         * Approval Management
         */
        Route::middleware(['role:financial_administrator|financial_secretary'])->resource('materias', 'ManageSubjectsController', [
            'only'  =>  ['index', 'store', 'update', 'destroy'],
            'names' => [
                'index'     => 'financial.management.subjects.index',
                'store'     => 'financial.management.subjects.store',
                'update'    => 'financial.management.subjects.update',
                'destroy'   => 'financial.management.subjects.destroy',
            ],
            'parameters' => ['materias' => 'id']
        ]);

        /**
         * Approval, Subjects & Teachers Management
         */
        Route::middleware(['role:financial_administrator|financial_secretary'])->resource('materias-programas-docentes', 'ManageSubjectProgramTeacherController', [
            'only'  =>  ['index', 'store'],
            'names' => [
                'index'     => 'financial.management.subjects.programs.teachers.index',
                'store'     => 'financial.management.subjects.programs.teachers.store',
            ],
        ]);
        Route::middleware(['role:financial_administrator|financial_secretary'])->put('materias-programas-docentes', 'ManageSubjectProgramTeacherController@update')
            ->name('financial.management.subjects.programs.teachers.update');
        Route::middleware(['role:financial_administrator|financial_secretary'])->delete('materias-programas-docentes', 'ManageSubjectProgramTeacherController@destroy')
            ->name('financial.management.subjects.programs.teachers.destroy');

        /**
         * Status Request Management
         */
        Route::middleware(['role:financial_administrator'])->resource('estados-de-solicitudes', 'ManageStatusController', [
            'only'  =>  ['index', 'store', 'update', 'destroy'],
            'names' =>  [
                'index' =>  'financial.management.status.index',
                'store' =>  'financial.management.status.store',
                'update' =>  'financial.management.status.update',
                'destroy' =>  'financial.management.status.destroy',
            ],
            'parameters' => ['estados-de-solicitudes' => 'id']
        ]);

        /**
         * Costs Management
         */
        Route::middleware(['role:financial_administrator'])->resource('costos-solicitudes', 'ManageCostController', [
            'only'  =>  ['index', 'store', 'update', 'destroy'],
            'names' =>  [
                'index' =>  'financial.management.costs.index',
                'store' =>  'financial.management.costs.store',
                'update' =>  'financial.management.costs.update',
                'destroy' =>  'financial.management.costs.destroy',
            ],
            'parameters' => ['costos-solicitudes' => 'id']
        ]);

        /**
         * File Type Management
         */
        Route::middleware(['role:financial_administrator'])->resource('tipos-de-archivos', 'ManageFileTypesController', [
            'only'  =>  ['index', 'store', 'update', 'destroy'],
            'names' =>  [
                'index' =>  'financial.management.file.type.index',
                'store' =>  'financial.management.file.type.store',
                'update' =>  'financial.management.file.type.update',
                'destroy' =>  'financial.management.file.type.destroy',
            ],
            'parameters' => ['tipos-de-archivos' => 'id']
        ]);
    });

    /*
     * Financial API
     */
    Route::namespace('Api')->middleware(['api.ajax'])->prefix('api')->group( function () {

        Route::prefix('options')->group( function () {
            Route::prefix('programs')->group( function () {
                Route::get('', 'SubjectsProgramsFilterController@programs')
                    ->name('financial.api.options.programs');
                Route::get('{id}/subjects', 'SubjectsProgramsFilterController@subjects')
                    ->name('financial.api.options.programs.subjects');
                Route::get('subjects/{id}/teachers', 'SubjectsProgramsFilterController@teachers')
                    ->name('financial.api.options.programs.subjects.teachers');
            });
            Route::prefix('teachers')->group( function () {
                Route::get('', 'TeacherController@index')
                    ->name('financial.api.options.teachers');
            });
            Route::prefix('subjects')->group( function () {
                Route::get('', 'SubjectController@index')
                    ->name('financial.api.options.subjects');
                Route::get('show/{id}', 'SubjectController@show')
                    ->name('financial.api.options.subjects.show');
            });
            Route::prefix('requests-list')->group(function () {
                Route::get('', 'RequestsOptionsController@all')
                    ->name('financial.api.options.requests-list.all');
            });
            Route::prefix('file-type')->group(function () {
                Route::get('', 'FileTypeController@options')
                    ->name('financial.api.options.file-type.options');
            });
            Route::prefix('file-status')->group(function () {
                Route::get('', 'FileController@fileStatus')
                    ->name('financial.api.options.file.status.options');
            });
        });

        Route::prefix('datatables')->group( function () {
            /**
             * Requests
             */
            Route::get('extensions', 'ExtensionController@datatable')
                ->name('financial.api.datatables.extensions');
            Route::get('additions-subtractions', 'AdditionSubtractionController@datatable')
                ->name('financial.api.datatables.add-sub');
            Route::get('validation', 'ValidationController@datatable')
                ->name('financial.api.datatables.validation');
            Route::get('intersemestral', 'IntersemestralController@datatable')
                ->name('financial.api.datatables.intersemestral');

            Route::get('programs', 'ProgramsController@datatable')
                ->name('financial.api.datatables.programs');
            Route::get('subjects', 'SubjectController@datatable')
                ->name('financial.api.datatables.subjects');
            Route::get('costs', 'CostServiceController@history')
                ->name('financial.api.datatables.cost');
            Route::get('file-types', 'FileTypeController@datatable')
                ->name('financial.api.datatables.file-type');
        });

        Route::prefix('comments')->group( function () {

            Route::get('extension/{id}', 'CommentController@getExtensionComments')
                ->name('financial.api.extension.comments.index');
            Route::post('extension/store', 'CommentController@storeExtensionComments')
                ->name('financial.api.extension.comments.store');

            Route::get('addition-subtraction/{id}', 'CommentController@getAddSubComments')
                ->name('financial.api.add-sub.comments.index');
            Route::post('addition-subtraction/store', 'CommentController@storeAddSubComments')
                ->name('financial.api.add-sub.comments.store');

            Route::get('validation/{id}', 'CommentController@getValidationComments')
                ->name('financial.api.validation.comments.index');
            Route::post('validation/store', 'CommentController@storeValidationComments')
                ->name('financial.api.validation.comments.store');

            Route::get('intersemestral/{id}', 'CommentController@getIntersemestralComments')
                ->name('financial.api.intersemestral.comments.index');
            Route::post('intersemestral/store', 'CommentController@storeIntersemestralComments')
                ->name('financial.api.intersemestral.comments.store');


            Route::get('file/{id}', 'FileController@getComments')
                ->name('financial.api.file.comment.index');
            Route::post('file/store', 'FileController@storeComment')
                ->name('financial.api.file.comment.store');
        });

        Route::prefix('tree')->group(function () {
            Route::get('status-request/{type}', 'StatusRequestController@tree')
                ->name('financial.api.tree.status-request');
        });

        Route::prefix('editable')->group(function () {
            Route::get('costs', 'CostServiceController@valid')
                ->name('financial.api.editable.cost');
        });

        Route::prefix('files')->group( function () {
            Route::get('own', 'FileController@ownFiles')
                ->name('financial.api.files.own.files');
            Route::get('approved', 'FileController@approvedFiles')
                ->name('financial.api.files.approved.files');
            Route::get('pending', 'FileController@pendingFiles')
                ->name('financial.api.files.pending.files');
            Route::get('show/{id}', 'FileController@showFile')
                ->name('financial.api.files.show.auth');
        });

        Route::prefix('stats')->group( function () {
            Route::get('financial-supply', 'FileTypeController@stats')
                ->name('financial.api.stats.financial.supply');
        });

        Route::prefix('extension')->group( function () {
            Route::get('show/{id}', 'ExtensionController@show')
                ->name('financial.api.extension.show');
            /*
            Route::get('edit/{id}', 'ExtensionController@edit')
                ->name('financial.api.extension.edit');
            */
        });

        Route::prefix('addition-subtraction')->group( function () {
            Route::get('show/{id}', 'AdditionSubtractionController@show')
                ->name('financial.api.add-sub.show');
            Route::get('edit/{id}', 'AdditionSubtractionController@edit')
                ->name('financial.api.add-sub.edit');
        });

        Route::prefix('validation')->group( function () {
            Route::get('show/{id}', 'ValidationController@show')
                ->name('financial.api.validation.show');
            Route::get('edit/{id}', 'ValidationController@edit')
                ->name('financial.api.validation.edit');
        });

        Route::prefix('intersemestral')->group( function () {
            Route::get('show/{id}', 'IntersemestralController@auth')
                ->name('financial.api.intersemestral.show');

            Route::get('show-admin/{id}', 'IntersemestralController@admin')
                ->name('financial.api.intersemestral.admin');

            Route::get('available', 'IntersemestralController@available')
                ->name('financial.api.intersemestral.available');

            Route::get('edit/{id}', 'IntersemestralController@edit')
                ->name('financial.api.intersemestral.edit');
        });

        Route::prefix('approval')->group( function () {
            Route::prefix('sidebar')->group(function (){
                Route::get('extension', 'ApprovalExtensionController@sidebar')
                    ->name('financial.api.approval.sidebar.extension');
                Route::get('validation', 'ApprovalValidationController@sidebar')
                    ->name('financial.api.approval.sidebar.validation');
                Route::get('addition-subtraction', 'ApprovalAdditionSubtractionController@sidebar')
                    ->name('financial.api.approval.sidebar.addition.subtraction');
                Route::get('intersemestral', 'ApprovalIntersemestralController@sidebar')
                    ->name('financial.api.approval.sidebar.intersemestral');
            });
            Route::get('extensions/{status?}', 'ApprovalExtensionController@extensions')
                ->name('financial.api.approval.extensions');
            Route::get('validations/{status?}', 'ApprovalValidationController@validations')
                ->name('financial.api.approval.validation');
            Route::get('addition-subtraction/{status?}', 'ApprovalAdditionSubtractionController@additionsSubtractions')
                ->name('financial.api.approval.addition.subtraction');
            Route::get('intersemestral/{status?}', 'ApprovalIntersemestralController@intersemestral')
                ->name('financial.api.approval.intersemestral');
        });

        Route::prefix('user')->group( function () {
            Route::get('auth', function () {
                return response()->json( auth()->user(), 200 );
            })->name('financial.api.user.auth');
        });
    });

    /*
    Route::get('mailable', function () {
        $invoice = \App\Container\Financial\src\Extension::find(11);

        return new App\Mail\Financial\FinancialExtensionGenerated($invoice);
    });
    */
});
