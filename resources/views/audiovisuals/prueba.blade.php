<?php
/**
 * Created by PhpStorm.
 * User: crist
 * Date: 9/08/2017
 * Time: 5:35 PM
 */
foreach ($usuarioId as $usuario):
    echo $usuario->id;
	echo $usuario->name;
	echo $usuario->lastname;
endforeach;