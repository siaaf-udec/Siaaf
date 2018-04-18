<?php
/**
 * Created by PhpStorm.
 * User: crist
 * Date: 9/08/2017
 * Time: 2:38 PM
 */
namespace App\Container\Audiovisuals\Src\Providers;

use App\Container\Audiovisuals\Src\Repository\UsuarioAudiovisualesRepository;
use Illuminate\Support\ServiceProvider;

class UsuarioAudiovisualesServiceProvider extends ServiceProvider
{

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('App\Container\Audiovisuals\Src\Interfaces\UsuarioAudiovisualesInterface', function ($app) {
			return new UsuarioAudiovisualesRepository;
		});
	}
}
