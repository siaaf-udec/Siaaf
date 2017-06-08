<?php

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

use App\Container\Users\Src\User;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * Rutas de Ejemplo
 *
 * Las siguientes rutas son sólo de muestras
 * y documentación de los componentes que se van a usar
 * para el desarrollo del proyecto.
 *
 * Deben ser elminadas al iniciar con el desarrollo
 * del proyecto
 */

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        return view('material.sample');
    });

    $controller = "\\App\\Container\\Users\\Src\\Controllers\\";
    Route::get('/container', [
        'uses' => $controller.'UserController@index',
        'as' => 'index'
    ]);

    Route::get('/', function () {
        return view('material.sample');
    });

    Route::group(['prefix' => 'components'], function () {
        Route::get('buttons', function ()    {
            return view('examples.buttons');
        });
        Route::get('portlet', function ()    {
            return view('examples.portlet');
        });
        Route::get('icons', function ()    {
            return view('examples.icons');
        });
        Route::get('sidebar', function ()    {
            return view('examples.sidebar');
        });
        Route::get('tabs', function ()    {
            return view('examples.tabs');
        });

        /*
         * Example Datatable
         */
        Route::get('datatables', function ()    {
            return view('examples.datatables');
        });

        Route::get('datatables/index',['as' => 'datatables/index', 'uses' => function (Request $request)    {
            if($request->ajax()){
                return Datatables::of(User::all())
                    ->addIndexColumn()
                    ->make(true);
            }else{
                return response()->json([
                    'message' => 'Incorrect request',
                    'code' => 412
                ],412);
            }
        }]);

    });



    Route::group(['prefix' => 'forms'], function () {
        Route::get('fields', function ()    {
            return view('examples.fields');
        });
        Route::get('validation', function ()    {
            return view('examples.validation');
        });
    });
});




/*
 * Fin de las rutas de ejemplo.
 */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
