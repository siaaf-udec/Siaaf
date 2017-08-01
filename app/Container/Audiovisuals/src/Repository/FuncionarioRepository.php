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
use App\Container\Overall\Src\Repository\ControllerRepository;

class FuncionarioRepository extends ControllerRepository implements FuncionarioInterface
{
    public function __construct()
    {
        parent::__construct(Funcionario::class);
    }

    protected function process($funcionario, $data)
    {
        $funcionario['PK_FUNCIONARIO_Cedula']   = $data['PK_FUNCIONARIO_Cedula'];
        $funcionario['FUNCIONARIO_Clave']       = $data['FUNCIONARIO_Clave'];
        $funcionario['FK_FUNCIONARIO_Rol']      = $data['FK_FUNCIONARIO_Rol'];
        $funcionario['FUNCIONARIO_Nombres']     = $data['FUNCIONARIO_Nombres'];
        $funcionario['FUNCIONARIO_Apellidos']   = $data['FUNCIONARIO_Apellidos'];
        $funcionario['FUNCIONARIO_Direccion']   = $data['FUNCIONARIO_Direccion'];
        $funcionario['FUNCIONARIO_Correo']      = $data['FUNCIONARIO_Correo'];
        $funcionario['FUNCIONARIO_Telefono']    = $data['FUNCIONARIO_Telefono'];
        $funcionario['FK_FUNCIONARIO_Estado']   = $data['FK_FUNCIONARIO_Estado'];
        $funcionario['FK_FUNCIONARIO_Programa'] = $data['FK_FUNCIONARIO_Programa'];

        $funcionario->save();
        return $funcionario;
    }
}
