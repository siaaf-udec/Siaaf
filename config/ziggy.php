<?php

return [
    /*
      |--------------------------------------------------------------------------
      | ZIggy Routes Name to use in Javascript Files
      |--------------------------------------------------------------------------
      |
      | Filtering routes is completely optional. If you want to pass all of your
      | routes to JavaScript by default, you can carry on using Ziggy as described above.
      |
      | You may also optionally define multiple whitelists by defining.
      |
      */

    'whitelist' => [
        /**
         * All routes used on financial project
         */
        'home',
        // Manage Approval
        'financial.management.programs.store',
        'financial.management.programs.update',
        'financial.management.programs.destroy',
        //Manage Subjects
        'financial.management.subjects.store',
        'financial.management.subjects.update',
        'financial.management.subjects.destroy',
        //Manage Subjects Approval Teachers Assignments
        'financial.management.subjects.programs.teachers.index',
        'financial.management.subjects.programs.teachers.store',
        'financial.management.subjects.programs.teachers.update',
        'financial.management.subjects.programs.teachers.destroy',
        //Manage Status
        'financial.management.status.store',
        'financial.management.status.update',
        'financial.management.status.destroy',
        //Manage Costs
        'financial.management.costs.store',
        'financial.management.costs.update',
        'financial.management.costs.destroy',
        //Manage File Types
        'financial.management.file.type.store',
        'financial.management.file.type.update',
        'financial.management.file.type.destroy',
        //Manage Available Modules
        'financial.management.available.modules.index',
        'financial.management.available.modules.store',
        //File Student Upload,
        'financial.files.store',
        'financial.files.update',
        //File Manage Approves,
        'financial.files.request.update',
        // Extension
        'financial.requests.student.extension.index',
        'financial.requests.student.extension.create',
        'financial.requests.student.extension.store',
        'financial.requests.student.extension.update',
        'financial.requests.student.extension.destroy',
        'financial.requests.student.extension.edit',
        //Approve Extension
        'financial.admin.approval.extension.update',
        'financial.admin.approval.extension.report',
        // Addition Subtraction
        'financial.requests.student.add-sub.index',
        'financial.requests.student.add-sub.create',
        'financial.requests.student.add-sub.store',
        'financial.requests.student.add-sub.update',
        'financial.requests.student.add-sub.destroy',
        'financial.requests.student.add-sub.edit',
        //Approve Addition Subtraction
        'financial.admin.approval.addition.subtraction.update',
        'financial.admin.approval.addition.subtraction.report',
        // Validation
        'financial.requests.student.validation.index',
        'financial.requests.student.validation.create',
        'financial.requests.student.validation.store',
        'financial.requests.student.validation.update',
        'financial.requests.student.validation.destroy',
        'financial.requests.student.validation.edit',
        //Approve Validation
        'financial.admin.approval.validation.update',
        'financial.admin.approval.validation.report',
        // Intersemestral
        'financial.requests.student.intersemestral.index',
        'financial.requests.student.intersemestral.create',
        'financial.requests.student.intersemestral.store',
        'financial.requests.student.intersemestral.update',
        'financial.requests.student.intersemestral.destroy',
        'financial.requests.student.intersemestral.edit',
        //Approve Intersemestral
        'financial.admin.approval.intersemestral.store',
        'financial.admin.approval.intersemestral.update',
        'financial.admin.approval.intersemestral.report',
        //Checks
        'financial.money.checks.index',
        'financial.money.checks.store',
        'financial.money.checks.update',
        'financial.money.checks.destroy',
        'financial.money.checks.report',
        //Petty Cash
        'financial.money.cash.index',
        'financial.money.cash.store',
        'financial.money.cash.update',
        'financial.money.cash.destroy',
        'financial.money.cash.report',
        //Api
        'financial.api.*',
    ],

    'groups' => [
        'api_options' => [
            /**
             * Routes to get programs and related subjects and
             * teachers
             */
            'financial.api.options.programs',
            'financial.api.options.programs.*',
            'financial.api.extension.comments.*',
        ],
        'api_datatables' => [
            /**
             * Route to get extensions on data tables
             */
            'financial.requests.student.extension.destroy',
            'financial.api.datatables.extensions',
        ],
    ],
];