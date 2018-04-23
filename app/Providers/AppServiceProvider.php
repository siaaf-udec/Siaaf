<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

/* Financial Uses Start */
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Container\Financial\src\Extension;
use App\Container\Financial\src\AdditionSubtraction;
use App\Container\Financial\src\Intersemestral;
use App\Container\Financial\src\Validation;
use App\Container\Financial\src\File;
use App\Container\Users\Src\User;
use App\Observers\ExtensionObserver;
use App\Observers\FileObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
/* Financial Uses Ends */

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //View share modules permissions
        View::share( 'module_resources_permissions', module_resources_permissions() );
        View::share( 'module_files_permissions', module_files_permissions() );
        View::share( 'module_request_permissions', module_request_permissions() );
        View::share( 'module_approval_permissions', module_approval_permissions() );
        //View share individual permissions
        View::share( 'permission_resources', permission_resources() );
        View::share( 'permission_programs', permission_programs() );
        View::share( 'permission_subjects', permission_subjects() );
        View::share( 'permission_costs', permission_costs() );
        View::share( 'permission_status', permission_status() );
        View::share( 'permission_file_type', permission_file_type() );
        View::share( 'permission_available_module', permission_available_module() );
        View::share( 'permission_file_management', permission_file_management() );
        View::share( 'permission_upload_files', permission_upload_files() );
        View::share( 'permission_approve_files', permission_approve_files() );
        View::share( 'permission_request', permission_request() );
        View::share( 'permission_extension', permission_extension() );
        View::share( 'permission_validation', permission_validation() );
        View::share( 'permission_add_sub', permission_add_sub() );
        View::share( 'permission_intersemestral', permission_intersemestral() );
        View::share( 'permission_approval', permission_approval() );
        View::share( 'permission_extension_approval', permission_extension_approval() );
        View::share( 'permission_validation_approval', permission_validation_approval() );
        View::share( 'permission_add_sub_approval', permission_add_sub_approval() );
        View::share( 'permission_intersemestral_approval', permission_intersemestral_approval() );

        //Custom Financial Polymorphic Types
        Relation::morphMap([
            'extension'         =>  Extension::class,
            'add_sub'           =>  AdditionSubtraction::class,
            'intersemestral'    =>  Intersemestral::class,
            'validation'        =>  Validation::class,
            'file'              =>  File::class,
            'user'              =>  User::class,
        ]);

        //Financial Observers
        File::observe( FileObserver::class );
        Extension::observe(ExtensionObserver::class);

        //Set carbon in Spanish or another language
        Carbon::setLocale( config('app.locale') );

        //Fix Specified key was too long error
        Schema::defaultStringLength(191);

        // Switch case directive
        Blade::extend(function($value, $compiler){
            $value = preg_replace('/(\s*)@switch\((.*)\)(?=\s)/', '$1<?php switch($2):', $value);     $value = preg_replace('/(\s*)@endswitch(?=\s)/', '$1endswitch; ?>', $value);
            $value = preg_replace('/(\s*)@case\((.*)\)(?=\s)/', '$1case $2: ?>', $value);
            $value = preg_replace('/(?<=\s)@default(?=\s)/', 'default: ?>', $value);
            $value = preg_replace('/(?<=\s)@breakswitch(?=\s)/', '<?php break;', $value);
            return $value;
        });

        // Custom If Statements
        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
