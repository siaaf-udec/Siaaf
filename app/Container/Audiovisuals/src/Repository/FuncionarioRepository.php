<?php

namespace App\Container\Audiovisuals\Src\Repository;

/*
 * Modelos
 */
use App\Container\Audiovisuals\Src\Funcionario;
/*
 * Interfaces
 */
use App\Container\Audiovisuals\Src\Interfaces\FuncionarioInterface;
use App\Container\Audiovisuals\src\UsuarioAudiovisuales;
use App\Container\Overall\Src\Repository\ControllerRepository;

class FuncionarioRepository extends ControllerRepository implements FuncionarioInterface
{
    public function __construct()
    {
        parent::__construct(UsuarioAudiovisuales::class);
    }

    protected function process($funcionario, $data)
    {
        $funcionario['id'] = $data['id'];
        $funcionario['USER_FK_Programa']       = $data['USER_FK_Programa'];


        $funcionario->save();
        return $funcionario;
    }
}
