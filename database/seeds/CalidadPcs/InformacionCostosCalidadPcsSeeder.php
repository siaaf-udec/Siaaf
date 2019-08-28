<?php

use App\Container\CalidadPcs\src\Costos_Informacion;
use Illuminate\Database\Seeder;

class InformacionCostosCalidadPcsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $costos = [
            [ 'CPCI_Abreviatura' => 'PV','CPCI_Nombre' => 'Valor Planificado', 'CPCI_Definicion' => 'El presupuesto autorizado que ha sido asignado al trabajo programado.', 'CPCI_Uso' => 'El valor del trabajo planificado hasta un determinado momento, generalmente la fecha de corte o la de finalización del proyecto.', 'CPCI_Formula' => '', 'CPCI_Interpretacion' => '' ],
            [ 'CPCI_Abreviatura' => 'EV','CPCI_Nombre' => 'Valor Ganado', 'CPCI_Definicion' => 'La medida del trabajo realizado, expresado en términos del presupuesto autorizado para dicho trabajo.', 'CPCI_Uso' => 'El valor planificado de todo el trabajo completado (ganado) hasta un determinado momento, generalmente la fecha de corte, sin referencia a los costos reales.', 'CPCI_Formula' => 'EV = suma del valor planificado del trabajo realizado.', 'CPCI_Interpretacion' => '' ],
            
        ];

        foreach ($costos as $costo ) {
            $aux = new Costos_Informacion();
            // $aux->PK_CE_Id_Etapa = $costo['PK_CE_Id_Etapa'];
            $aux->CPCI_Abreviatura      = $costo['CPCI_Abreviatura'];
            $aux->CPCI_Nombre           = $costo['CPCI_Nombre'];
            $aux->CPCI_Definicion       = $costo['CPCI_Definicion'];
            $aux->CPCI_Uso              = $costo['CPCI_Uso'];
            $aux->CPCI_Formula          = $costo['CPCI_Formula'];
            $aux->CPCI_Interpretacion   = $costo['CPCI_Interpretacion'];
            $aux->save();
        }
    }
}
