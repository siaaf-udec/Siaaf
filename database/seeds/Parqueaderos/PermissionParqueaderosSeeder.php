<?php

use Illuminate\Database\Seeder;
/*
 * Modelos
 */
use App\Container\Permissions\Src\Permission;

class PermissionParqueaderosSeeder extends Seeder
{

    public function run()
    {
        //Inicio De Permisos Generales De Los Roles
        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'PARK_MODULE';
        $permissionFuncionario->display_name = 'Parqueaderos';
        $permissionFuncionario->description = 'Acceso completo a la modulo de parqueaderos.';
        $permissionFuncionario->module_id = 3;
        $permissionFuncionario->save();

        $permissionFuncionario = new Permission;
        $permissionFuncionario->name = 'FUNC_CARPARK';
        $permissionFuncionario->display_name = 'Parqueaderos';
        $permissionFuncionario->description = 'Acceso completo a la modulo de parqueaderos.';
        $permissionFuncionario->module_id = 3;
        $permissionFuncionario->save();

        $permissionAdmin = new Permission;
        $permissionAdmin->name = 'ADMIN_CARPARK';
        $permissionAdmin->display_name = 'Parqueaderos';
        $permissionAdmin->description = 'Acceso completo a la modulo de parqueaderos.';
        $permissionAdmin->module_id = 3;
        $permissionAdmin->save();

        //Fin De Permisos Generales De Los Roles

        //Inicio De Permisos Sobre CRUD De Usuarios

        $permissionCreateUser = new Permission;
        $permissionCreateUser->name = 'PARK_CREATE_USER';
        $permissionCreateUser->display_name = 'Parqueaderos';
        $permissionCreateUser->description = 'Permiso para autorizar la creación de usuarios nuevos.';
        $permissionCreateUser->module_id = 3;
        $permissionCreateUser->save();

        $permissionSeeUser = new Permission;
        $permissionSeeUser->name = 'PARK_SEE_USER';
        $permissionSeeUser->display_name = 'Parqueaderos';
        $permissionSeeUser->description = 'Permiso para autorizar la vista del perfil de los usuarios.';
        $permissionSeeUser->module_id = 3;
        $permissionSeeUser->save();

        $permissionUpdateUser = new Permission;
        $permissionUpdateUser->name = 'PARK_UPDATE_USER';
        $permissionUpdateUser->display_name = 'Parqueaderos';
        $permissionUpdateUser->description = 'Permiso para autorizar la actualización de la información de los usuarios.';
        $permissionUpdateUser->module_id = 3;
        $permissionUpdateUser->save();

        $permissionDeleteUser = new Permission;
        $permissionDeleteUser->name = 'PARK_DELETE_USER';
        $permissionDeleteUser->display_name = 'Parqueaderos';
        $permissionDeleteUser->description = 'Permiso para autorizar la eliminación de usuarios.';
        $permissionDeleteUser->module_id = 3;
        $permissionDeleteUser->save();

        $permissionReportUser = new Permission;
        $permissionReportUser->name = 'PARK_REPORT_USER';
        $permissionReportUser->display_name = 'Parqueaderos';
        $permissionReportUser->description = 'Permiso para autorizar sacar los reportes de los usuarios.';
        $permissionReportUser->module_id = 3;
        $permissionReportUser->save();

        //Fin De Permisos Sobre CRUD De Usuarios

        //Inicio De Permisos Sobre CRUD De Motos

        $permissionCreateMoto = new Permission;
        $permissionCreateMoto->name = 'PARK_CREATE_MOTO';
        $permissionCreateMoto->display_name = 'Parqueaderos';
        $permissionCreateMoto->description = 'Permiso para autorizar la creación de motocicletas nuevas.';
        $permissionCreateMoto->module_id = 3;
        $permissionCreateMoto->save();

        $permissionSeeMoto = new Permission;
        $permissionSeeMoto->name = 'PARK_SEE_MOTO';
        $permissionSeeMoto->display_name = 'Parqueaderos';
        $permissionSeeMoto->description = 'Permiso para autorizar la vista del perfil de las motocicletas.';
        $permissionSeeMoto->module_id = 3;
        $permissionSeeMoto->save();

        $permissionUpdateMoto = new Permission;
        $permissionUpdateMoto->name = 'PARK_UPDATE_MOTO';
        $permissionUpdateMoto->display_name = 'Parqueaderos';
        $permissionUpdateMoto->description = 'Permiso para autorizar la actualización de la información de las motocicletas.';
        $permissionUpdateMoto->module_id = 3;
        $permissionUpdateMoto->save();

        $permissionDeleteMoto = new Permission;
        $permissionDeleteMoto->name = 'PARK_DELETE_MOTO';
        $permissionDeleteMoto->display_name = 'Parqueaderos';
        $permissionDeleteMoto->description = 'Permiso para autorizar la eliminación de motocicletas.';
        $permissionDeleteMoto->module_id = 3;
        $permissionDeleteMoto->save();

        $permissionReportMoto = new Permission;
        $permissionReportMoto->name = 'PARK_REPORT_MOTO';
        $permissionReportMoto->display_name = 'Parqueaderos';
        $permissionReportMoto->description = 'Permiso para autorizar sacar los reportes de las motocicletas.';
        $permissionReportMoto->module_id = 3;
        $permissionReportMoto->save();

        //Fin De Permisos Sobre CRUD De Motos

        //Inicio De Permisos Sobre CRUD De ingresos

        $permissionCreateIngreso = new Permission;
        $permissionCreateIngreso->name = 'PARK_CREATE_INGRESO';
        $permissionCreateIngreso->display_name = 'Parqueaderos';
        $permissionCreateIngreso->description = 'Permiso para autorizar la creación de acciones de ingreso nuevas.';
        $permissionCreateIngreso->module_id = 3;
        $permissionCreateIngreso->save();

        $permissionReportIngresos = new Permission;
        $permissionReportIngresos->name = 'PARK_REPORT_INGRESO';
        $permissionReportIngresos->display_name = 'Parqueaderos';
        $permissionReportIngresos->description = 'Permiso para autorizar sacar los reportes de acciones de ingreso.';
        $permissionReportIngresos->module_id = 3;
        $permissionReportIngresos->save();

        //Fin De Permisos Sobre CRUD De ingresos

        //Inicio De Permisos Sobre CRUD De historiales        

        $permissionReportHistoriales = new Permission;
        $permissionReportHistoriales->name = 'PARK_REPORT_HISTORIAL';
        $permissionReportHistoriales->display_name = 'Parqueaderos';
        $permissionReportHistoriales->description = 'Permiso para autorizar sacar los reportes de historiales.';
        $permissionReportHistoriales->module_id = 3;
        $permissionReportHistoriales->save();

        $permissionReportHistoFechas = new Permission;
        $permissionReportHistoFechas->name = 'PARK_REPORT_HISTOFECHA';
        $permissionReportHistoFechas->display_name = 'Parqueaderos';
        $permissionReportHistoFechas->description = 'Permiso para autorizar sacar los reportes de historiales filtrado por fecha.';
        $permissionReportHistoFechas->module_id = 3;
        $permissionReportHistoFechas->save();

        $permissionReportHistoCodigo = new Permission;
        $permissionReportHistoCodigo->name = 'PARK_REPORT_HISTOCODIGO';
        $permissionReportHistoCodigo->display_name = 'Parqueaderos';
        $permissionReportHistoCodigo->description = 'Permiso para autorizar sacar los reportes de historiales filtrado por código.';
        $permissionReportHistoCodigo->module_id = 3;
        $permissionReportHistoCodigo->save();

        $permissionReportHistoPlaca = new Permission;
        $permissionReportHistoPlaca->name = 'PARK_REPORT_HISTOPLACA';
        $permissionReportHistoPlaca->display_name = 'Parqueaderos';
        $permissionReportHistoPlaca->description = 'Permiso para autorizar sacar los reportes de historiales filtrado por placa.';
        $permissionReportHistoPlaca->module_id = 3;
        $permissionReportHistoPlaca->save();

        //Fin De Permisos Sobre CRUD De historiales

        //Inicio De Permisos Sobre CRUD De Dependencias

        $permissionCreateDependencia = new Permission;
        $permissionCreateDependencia->name = 'PARK_CREATE_DEPENDENCIA';
        $permissionCreateDependencia->display_name = 'Parqueaderos';
        $permissionCreateDependencia->description = 'Permiso para autorizar la creación de Dependencias nuevas.';
        $permissionCreateDependencia->module_id = 3;
        $permissionCreateDependencia->save();

        $permissionUpdateDependencia = new Permission;
        $permissionUpdateDependencia->name = 'PARK_UPDATE_DEPENDENCIA';
        $permissionUpdateDependencia->display_name = 'Parqueaderos';
        $permissionUpdateDependencia->description = 'Permiso para autorizar la actualización de la información de las Dependencias.';
        $permissionUpdateDependencia->module_id = 3;
        $permissionUpdateDependencia->save();

        $permissionReportDependencia = new Permission;
        $permissionReportDependencia->name = 'PARK_REPORT_DEPENDENCIA';
        $permissionReportDependencia->display_name = 'Parqueaderos';
        $permissionReportDependencia->description = 'Permiso para autorizar sacar los reportes de Dependencias.';
        $permissionReportDependencia->module_id = 3;
        $permissionReportDependencia->save();

        //Fin De Permisos Sobre CRUD De Dependencias

        //Inicio De Permisos Sobre Cerrar Parqueadero

        $permissionClosePark = new Permission;
        $permissionClosePark->name = 'PARK_CLOSE_CARPARK';
        $permissionClosePark->display_name = 'Parqueaderos';
        $permissionClosePark->description = 'Permiso para autorizar el envio de correos de advertencia sobre el cierre del parqueadero.';
        $permissionClosePark->module_id = 3;
        $permissionClosePark->save();

        //Fin De Permisos Sobre Cerrar Parqueadero

    }
}   