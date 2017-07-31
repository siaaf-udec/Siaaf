<?php

namespace App\Container\Audiovisuals\Src\Repository;

/*
 * Modelos
 */
use App\Container\Audiovisuals\Src\Administrador;
/*
 * Interfaces
 */
use App\Container\Audiovisuals\Src\Interfaces\AdminInterface;
use App\Container\Overall\Src\Repository\ControllerRepository;

class AdminRepository extends ControllerRepository implements AdminInterface
{
    public function __construct()
    {
        parent::__construct(Administrador::class);
    }

    protected function process($admin, $data)
    {
        $admin['PK_ADMIN_Cedula'] = $data['PK_ADMIN_Cedula'];
        $admin['ADMIN_Clave']     = $data['ADMIN_Clave'];
        $admin['FK_ADMIN_Rol']    = $data['FK_ADMIN_Rol'];
        $admin['ADMIN_Nombres']   = $data['ADMIN_Nombres'];
        $admin['ADMIN_Apellidos'] = $data['ADMIN_Apellidos'];
        $admin['ADMIN_Direccion'] = $data['ADMIN_Direccion'];
        $admin['ADMIN_Correo']    = $data['ADMIN_Correo'];
        $admin['ADMIN_Telefono']  = $data['ADMIN_Telefono'];
        $admin['FK_ADMIN_Estado'] = $data['FK_ADMIN_Estado'];

        $admin->save();
        return $admin;
    }
}
