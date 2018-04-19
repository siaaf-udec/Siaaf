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
