<?php
/**
 * Created by PhpStorm.
 * User: crist
 * Date: 9/08/2017
 * Time: 2:41 PM
 */
namespace App\Container\Audiovisuals\Src\Repository;

/*
 * Modelos
 */
use App\Container\Audiovisuals\Src\UsuarioAudiovisuales;
/*
 * Interfaces
 */
use App\Container\Audiovisuals\Src\Interfaces\UsuarioAudiovisualesInterface;

use App\Container\Overall\Src\Repository\ControllerRepository;

class UsuarioAudiovisualesRepository extends ControllerRepository implements UsuarioAudiovisualesInterface
{
	public function __construct()
	{
		parent::__construct(UsuarioAudiovisuales::class);
	}

	protected function process($usuarioAudiovisuales, $data)
	{
		$usuarioAudiovisuales['id']   = $data['id'];
		$usuarioAudiovisuales['USER_FK_Programa'] = $data['USER_FK_Programa'];

		$usuarioAudiovisuales->save();
		return $usuarioAudiovisuales;
	}
}