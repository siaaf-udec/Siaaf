<?php
/**
 * Created by PhpStorm.
 * User: crist
 * Date: 9/08/2017
 * Time: 2:28 PM
 */
namespace App\Container\Audiovisuals\Src\Facades;

use Illuminate\Support\Facades\Facade;
class UsuarioAudiovisualesFacades extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'UsuarioAudivisuals';
	}
}
