<?php

use App\Container\Permissions\Src\Permission;
use \Illuminate\Database\Seeder;

class PermissionAudiovisualsSeeder extends Seeder
{

    public function run()
    {
        $permisos = [
            ['name'=>'AUDI_MODULE','display_name'=>'Funcionario de Audiovisuales','description'=>'Acceso de funcionario a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_ART_KIT','display_name'=>'Gestion Articulos-Kits','description'=>'Acceso de Vista Gestion Articulos-Kits a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_ADMIN','display_name'=>'Gestion Solicitudes Prestamos Reservas','description'=>'Acceso de de Vista Gestion Solicitudes a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_CLERK','display_name'=>'Gestion Solicitud Reservas','description'=>'Acceso de funcionario a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_UPDATE_VALIDATIONS','display_name'=>'Gestion Validaciones','description'=>'Acceso de modificacion de Validaciones a el modulo de audiovisuales.','module_id'=>'2'],

            ['name'=>'AUDI_ART_EDIT','display_name'=>'Editar Articulo','description'=>'Acceso de modificacion de articulo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_ART_DELETE','display_name'=>'Borrar Articulo','description'=>'Acceso de eliminacion de articulo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_ART_CREATE','display_name'=>'Crear Articulo','description'=>'Acceso de de creacion de articulo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_ART_TYPE_VIEW','display_name'=>'Gestion Tipo Articulo','description'=>'Acceso de creacion de tipo de articulo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_ART_TYPE_CREATE','display_name'=>'Crea Tipo Articulo','description'=>'Acceso de creacion tipo de articulo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_ART_TYPE_EDIT','display_name'=>'Modifica Tipo Articulo','description'=>'Acceso de modificacion de tipo articulo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_ART_TYPE_DELETE','display_name'=>'Elimina Tipo Articulo','description'=>'Acceso de eliminacion de tipo de articulo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_KIT_VIEW_CREATE','display_name'=>'Gestion registro Kit','description'=>'Acceso de de creacion de kit a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_KIT_EDIT','display_name'=>'Modifica kit','description'=>'Acceso de modificacion de kit a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_KIT_DELETE','display_name'=>'Elimina Kit','description'=>'Acceso de eliminacion de kit a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_KIT_ASSIGN','display_name'=>'Asignar articulo al kit','description'=>'Acceso de asignacion de articulos a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_KIT_CREATE','display_name'=>'Crea Kit','description'=>'Acceso de creacion de kit a el modulo de audiovisuales.','module_id'=>'2'],

            ['name'=>'AUDI_REQUESTS_ENTER','display_name'=>'Gestion Solicitud Prestamo','description'=>'Acceso de creacion de Gestion de solicitud prestamo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_KIT_ART','display_name'=>'Opciones prestamo','description'=>'Acceso de opccion de asignacion prestamo de articulo o kit  a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_ASSIGN_ART','display_name'=>'Asignar Articulo a la solicitud','description'=>'Acceso de  articulo a la solicitud a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_ASSIGN_KIT','display_name'=>'Asignar kit a la solicitud ','description'=>'Acceso de  kit a la solicitud a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_CREATE','display_name'=>'Crea Solicitud','description'=>'Acceso de creacion de solicitud a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_VIEW_LENDING','display_name'=>'Gestion Solicitud Prestamo vista','description'=>'Acceso de Gestion de solicitud prestamo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_VIEW_RESERVATION','display_name'=>'Gestion Solicitud reserva vista','description'=>'Acceso de Gestion de solicitud reserva a el modulo de audiovisuales.','module_id'=>'2'],

            ['name'=>'AUDI_LENDING_GET_ALL','display_name'=>'Recibir prestamo','description'=>'Acceso de recibir solicitud prestamo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_LENDING_EDIT','display_name'=>'Gestion modificar prestamo ','description'=>'Acceso de modificacion de la solicitud prestamo a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_LENDING_KIT_GET','display_name'=>'Recibir Kit','description'=>'Acceso de recibir el kit de la solicitud prestamo a el modulo de audiovisuales.','module_id'=>'2'],

            ['name'=>'AUDI_VIEW_CREATE_LENDING','display_name'=>'Gestion reserva vista','description'=>'Acceso de  solicitud reserva vista a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_LENDING_KIT_ART','display_name'=>'Asignar kit o articulo reserva ','description'=>'Acceso de asignacion de articulo o kit a la solicitud reserva a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_LENDING_ASSIGN_ART','display_name'=>'Asigna articulo','description'=>'Acceso de asignacion de articulo a la reserva a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_LENDING_ASSIGN_KIT','display_name'=>'Asigna kit','description'=>'Acceso de asignacion de kit a la reserva a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_LENDING_CREATE','display_name'=>'Crear Solicitud reserva ','description'=>'Acceso de Creacion de solicitud reserva a el modulo de audiovisuales.','module_id'=>'2'],

            ['name'=>'AUDI_VIEW_SANCTION','display_name'=>'Vista sanciones ','description'=>'Acceso a ver las sanciones asignadas en el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_CANCEL_SANCTION','display_name'=>'Anular sanciones','description'=>'Acceso a anular sanciones en el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUESTS_CREATE_ASSENT','display_name'=>'Asignacion sancion','description'=>'Acceso a realizar sanciones en el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_LENDING_CREATE_ASSENT','display_name'=>'Asignacion sancion','description'=>'Acceso a realizar sanciones en el modulo de audiovisuales.','module_id'=>'2'],

            ['name'=>'AUDI_MAINTENANCE_ART','display_name'=>'Mantenimiento articulos ','description'=>'Acceso al mantenimiento de articulos en el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_MAINTENANCE_CREATE','display_name'=>'Crear Solicitud Mantenimiento ','description'=>'Acceso de visualizar las solicitudes de mantenimientos a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_REQUEST_MAINTENANCE_VIEW','display_name'=>'Visualiza Mantenimientos ','description'=>'Acceso de creacion solicitud mantenimiento a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_RECORD_MAINTENANCE_VIEW','display_name'=>'Gestion Mantenimientos ','description'=>'Acceso a la vista de solicitudes de mantenimientos a el modulo de audiovisuales.','module_id'=>'2'],
            ['name'=>'AUDI_END_MAINTENANCE','display_name'=>'Finalizar Mantenimiento ','description'=>'Acceso de finalizacion de mantenimiento a un articulo a el modulo de audiovisuales.','module_id'=>'2'],


        ];

        foreach ($permisos as $permiso ) {
            $aux = new Permission;
            $aux->name = $permiso['name'];
            $aux->display_name = $permiso['display_name'];
            $aux->description = $permiso['description'];
            $aux->module_id = $permiso['module_id']; //2
            $aux->save();
        }
    }
}