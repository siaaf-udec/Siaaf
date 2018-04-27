<?php
/**
 * Created by PhpStorm.
 * User: crist
 * Date: 26/04/2018
 * Time: 3:50 AM
 */
use Illuminate\Database\Seeder;
use App\Container\Audiovisuals\src\Solicitudes;
class ReporteCarrerasArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prestamos = [

            ['PRT_FK_Articulos_id' => '8', 'PRT_FK_Funcionario_id' => '1', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '8', 'PRT_FK_Funcionario_id' => '2', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '8', 'PRT_FK_Funcionario_id' => '3', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '7', 'PRT_FK_Funcionario_id' => '1', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '7', 'PRT_FK_Funcionario_id' => '2', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '7', 'PRT_FK_Funcionario_id' => '3', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '6', 'PRT_FK_Funcionario_id' => '1', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '6', 'PRT_FK_Funcionario_id' => '2', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '6', 'PRT_FK_Funcionario_id' => '3', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '5', 'PRT_FK_Funcionario_id' => '1', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '5', 'PRT_FK_Funcionario_id' => '2', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],
            ['PRT_FK_Articulos_id' => '5', 'PRT_FK_Funcionario_id' => '3', 'PRT_FK_Kits_id' => '1', 'PRT_Fecha_Inicio' => '2018-04-23 21:01:33', 'PRT_Fecha_Fin' => '2018-04-23 23:01:33', 'PRT_Observacion_Entrega' => 'bueno', 'PRT_Observacion_Recibe' => 'bueno', 'PRT_Num_Orden' => '1', 'PRT_Cantidad' => '1', 'PRT_FK_Estado' => '2', 'PRT_FK_Tipo_Solicitud' => '2', 'PRT_FK_Administrador_Entrega_id' => '1', 'PRT_FK_Administrador_Recibe_id' => '1'],

        ];

        foreach ($prestamos as $prestamo) {
            $aux = new Solicitudes();
            $aux->PRT_FK_Articulos_id = $prestamo['PRT_FK_Articulos_id'];
            $aux->PRT_FK_Funcionario_id = $prestamo['PRT_FK_Funcionario_id'];
            $aux->PRT_FK_Kits_id = $prestamo['PRT_FK_Kits_id'];
            $aux->PRT_Fecha_Inicio = $prestamo['PRT_Fecha_Inicio'];
            $aux->PRT_Fecha_Fin = $prestamo['PRT_Fecha_Fin'];
            $aux->PRT_Observacion_Entrega = $prestamo['PRT_Observacion_Entrega'];
            $aux->PRT_Observacion_Recibe = $prestamo['PRT_Observacion_Recibe'];
            $aux->PRT_Num_Orden = $prestamo['PRT_Num_Orden'];
            $aux->PRT_Cantidad = $prestamo['PRT_Cantidad'];
            $aux->PRT_FK_Estado = $prestamo['PRT_FK_Estado'];
            $aux->PRT_FK_Tipo_Solicitud = $prestamo['PRT_FK_Tipo_Solicitud'];
            $aux->PRT_FK_Administrador_Entrega_id = $prestamo['PRT_FK_Administrador_Entrega_id'];
            $aux->PRT_FK_Administrador_Recibe_id = $prestamo['PRT_FK_Administrador_Recibe_id'];

            $aux->save();
        }
    }
}