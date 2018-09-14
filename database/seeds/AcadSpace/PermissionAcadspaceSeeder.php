<?php

use App\Container\Permissions\Src\Permission;
use Illuminate\Database\Seeder;

class PermissionAcadspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission= new Permission;
        $permission->name = 'ACAD_MODULE';
        $permission->display_name = 'Espacios Academicos';
        $permission->description = 'Acceso completo al modulo de espacios academicos.';
        $permission->module_id = 1;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'FUNC_ESPA';
        $permission->display_name = 'Acadspace';
        $permission->description = 'Acceso completo al modulo de espacios academicos.';
        $permission->module_id = 1;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'ACAD_FORMATOS';
        $permission->display_name = 'Formatos Academicos';
        $permission->description = 'Acceso al menu de formatos academicos.';
        $permission->module_id = 1;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'ACAD_REGISTRAR_FORMATOS';
        $permission->display_name = 'Registrar Formatos';
        $permission->description = 'Acceso a registrar espacios academicos.';
        $permission->module_id = 1;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'ACAD_CONSULTAR_FORMATOS';
        $permission->display_name = 'Consultar Formatos';
        $permission->description = 'Acceso a consultar las solicitudes de espacios academicos realizadas.';
        $permission->module_id = 1;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'ACAD_DESCARGAR_FORMATO';
        $permission->display_name = 'Descargar Formatos';
        $permission->description = 'Acceso a descargar el archivo de las solicitudes de espacios academicos realizadas.';
        $permission->module_id = 1;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'ACAD_GESTION_FORMATOS';
        $permission->display_name = 'Gestion Formatos';
        $permission->description = 'Acceso a gestionar las solicitudes de espacios academicos recibidas.';
        $permission->module_id = 1;
        $permission ->save();

        $permission= new Permission;
        $permission->name = 'ACAD_EDIT_ESTADO_FORMATO';
        $permission->display_name = 'Editar Formatos';
        $permission->description = 'Acceso a editar el estado de las solicitudes de espacios academicos recibidas.';
        $permission->module_id = 1;
        $permission ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_SOL_FORMATO';
        $permission2->display_name = 'Eliminar Solicitud Formato';
        $permission2->description = 'Acceso a eliminar solicitud.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_AULAS';
        $permission2->display_name = 'Aulas';
        $permission2->description = 'Acceso al modulo aulas.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_AULA';
        $permission2->display_name = 'Registrar Aulas';
        $permission2->description = 'Acceso a registrar aulas.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_CONSULTAR_AULA';
        $permission2->display_name = 'Consultar Aulas';
        $permission2->description = 'Acceso a consultar aulas.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_AULA';
        $permission2->display_name = 'Eliminar Aulas';
        $permission2->description = 'Acceso a eliminar aulas.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_SOFTWARE';
        $permission2->display_name = 'software';
        $permission2->description = 'Acceso al modulo software.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_SOFTWARE';
        $permission2->display_name = 'Registrar Software';
        $permission2->description = 'Acceso a registrar software.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_CONSULTAR_SOFTWARE';
        $permission2->display_name = 'Consultar Software';
        $permission2->description = 'Acceso a consultar software.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_SOFTWARE';
        $permission2->display_name = 'Eliminar Software';
        $permission2->description = 'Acceso a eliminar software.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_INCIDENTES';
        $permission2->display_name = 'incidentes';
        $permission2->description = 'Acceso al modulo incidentes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_INCIDENTE';
        $permission2->display_name = 'Registrar Incidente';
        $permission2->description = 'Acceso a registrar incidente.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_CONSULTAR_INCIDENTE';
        $permission2->display_name = 'Consultar Incidente';
        $permission2->description = 'Acceso a consultar incidente.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_INCIDENTE';
        $permission2->display_name = 'Eliminar Incidente';
        $permission2->description = 'Acceso a eliminar incidente.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_EVENTOS';
        $permission2->display_name = 'Eventos';
        $permission2->description = 'Acceso a modulo de eventos - horario.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_EVENTO';
        $permission2->display_name = 'Registrar Evento';
        $permission2->description = 'Acceso a registrar eventos.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_VER_MAS_EVENTO';
        $permission2->display_name = 'Informacion Evento';
        $permission2->description = 'Acceso a informacion de evento.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_IMPRIMIR_PDF';
        $permission2->display_name = 'Imprimir pdf';
        $permission2->description = 'Acceso a impresion de pdf.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REPORTES';
        $permission2->display_name = 'Reportes';
        $permission2->description = 'Acceso a reportes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REALIZAR_REPORTE';
        $permission2->display_name = 'Realizar Reporte';
        $permission2->description = 'Acceso a realizar reportes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_PUBLICO';
        $permission2->display_name = 'Publico ';
        $permission2->description = 'Acceso a modulo publico para registrar asistencia.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_ASISTENCIA';
        $permission2->display_name = 'Registrar Asistencia';
        $permission2->description = 'Acceso a modulo publico para registrar asistencia.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_SOLICITUDES';
        $permission2->display_name = 'Solicitudes';
        $permission2->description = 'Acceso a modulo solicitudes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REALIZAR_SOLICITUDES';
        $permission2->display_name = 'Realizar Solicitudes';
        $permission2->description = 'Acceso a registrar solicitudes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_GESTION_SOLICITUDES';
        $permission2->display_name = 'Gestion Solicitudes';
        $permission2->description = 'Acceso a gestion de solicitudes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_CONSULTAR_SOLICITUDES';
        $permission2->display_name = 'Consultar Solicitudes';
        $permission2->description = 'Acceso a consulta de solicitudes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_APROBAR_SOLICITUDES';
        $permission2->display_name = 'Aprobar Solicitudes';
        $permission2->description = 'Acceso a aprobacion de solicitudes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_RECHAZAR_SOLICITUDES';
        $permission2->display_name = 'Rechazar Solicitudes';
        $permission2->description = 'Acceso a rechazar solicitudes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_SOLICITUDES';
        $permission2->display_name = 'Eliminar Solicitudes';
        $permission2->description = 'Acceso a eliminar solicitudes.';
        $permission2->module_id = 1;
        $permission2 ->save();

        //PERMISOS CATEGORIA

        $permission2= new Permission;
        $permission2->name = 'ACAD_CATEGORIA';
        $permission2->display_name = 'Acesso al modulo Categoria';
        $permission2->description = 'Acceso al modulo categoria.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_CONSULTAR_CATEGORIA';
        $permission2->display_name = 'Consultar las categorias';
        $permission2->description = 'Acceso a consultar las categorias.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_CATEGORIA';
        $permission2->display_name = 'Registrar Categoria';
        $permission2->description = 'Acceso a registrar categorias.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_CATEGORIA';
        $permission2->display_name = 'Eliminar Categoria';
        $permission2->description = 'Acceso a eliminar categorias.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_EDITAR_CATEGORIA';
        $permission2->display_name = 'Editar Categoria';
        $permission2->description = 'Acceso a editar categorias.';
        $permission2->module_id = 1;
        $permission2 ->save();


        //PERMISOS MARCA

        $permission2= new Permission;
        $permission2->name = 'ACAD_MARCA';
        $permission2->display_name = 'Acesso al modulo marca';
        $permission2->description = 'Acceso al modulo marca.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_CONSULTAR_MARCA';
        $permission2->display_name = 'Consultar las marcas';
        $permission2->description = 'Acceso a consultar las marcas.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_MARCA';
        $permission2->display_name = 'Registrar marca';
        $permission2->description = 'Acceso a registrar marca.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_MARCA';
        $permission2->display_name = 'Eliminar marca';
        $permission2->description = 'Acceso a eliminar marca.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_EDITAR_MARCA';
        $permission2->display_name = 'Editar marca';
        $permission2->description = 'Acceso a editar Marcas.';
        $permission2->module_id = 1;
        $permission2 ->save();

        //PERMISOS TIPOS MANTENIMIENTOS

        $permission2= new Permission;
        $permission2->name = 'ACAD_TIPMANT';
        $permission2->display_name = 'Acesso al modulo tipo de mantenimiento';
        $permission2->description = 'Acceso al modulo tipo de mantenimiento.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_CONSULTAR_TIPMANT';
        $permission2->display_name = 'Consultar los tipos de mantenimiento';
        $permission2->description = 'Acceso a consultar los tipos de mantenimiento.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_TIPMANT';
        $permission2->display_name = 'Registrar tipos de mantenimientos';
        $permission2->description = 'Acceso a registrar tipos de mantenimientos.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_TIPMANT';
        $permission2->display_name = 'Eliminar tipos de mantenimientos';
        $permission2->description = 'Acceso a eliminar tipos de mantenimientos.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_EDITAR_TIPMANT';
        $permission2->display_name = 'Editar tipos de mantenimientos';
        $permission2->description = 'Acceso a editar tipos de mantenimientos.';
        $permission2->module_id = 1;
        $permission2 ->save();

        //PERMISOS DE ARTICULOS

        $permission2= new Permission;
        $permission2->name = 'ACAD_ARTICULO';
        $permission2->display_name = 'Acesso al modulo articulo';
        $permission2->description = 'Acceso al modulo articulo.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_CONSULTAR_ARTICULO';
        $permission2->display_name = 'Consultar los articulos';
        $permission2->description = 'Acceso a consultar los articulos.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_REGISTRAR_ARTICULO';
        $permission2->display_name = 'Registrar articulos';
        $permission2->description = 'Acceso a registrar articulos.';
        $permission2->module_id = 1;
        $permission2 ->save();

        $permission2= new Permission;
        $permission2->name = 'ACAD_ELIMINAR_ARTICULO';
        $permission2->display_name = 'Eliminar articulos';
        $permission2->description = 'Acceso a eliminar articulos.';
        $permission2->module_id = 1;
        $permission2 ->save();

    }
}
