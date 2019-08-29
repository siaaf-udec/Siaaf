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
            [ 'CPCI_Abreviatura' => 'AC','CPCI_Nombre' => 'Costo Real', 'CPCI_Definicion' => 'El costo incurrido por el trabajo llevado a cabo en una actividad durante un determinado periodo de tiempo.', 'CPCI_Uso' => 'El costo real de todo el trabajo realizado hasta un determinado momento, generalmente la fecha de corte.', 'CPCI_Formula' => '', 'CPCI_Interpretacion' => '' ],
            [ 'CPCI_Abreviatura' => 'BAC','CPCI_Nombre' => 'Presupuesto hasta la Conclusión', 'CPCI_Definicion' => 'La suma de todos los presupuestos establecidos para el trabajo a realizar.', 'CPCI_Uso' => 'El valor de la totalidad del trabajo planificado, la línea base de costos del proyecto.', 'CPCI_Formula' => '', 'CPCI_Interpretacion' => '' ],
            [ 'CPCI_Abreviatura' => 'CV','CPCI_Nombre' => 'Variación del Costo', 'CPCI_Definicion' => 'El monto del déficit o superávit presupuestario en un momento dado, expresado como la diferencia entre el valor ganado y el costo real.', 'CPCI_Uso' => 'La diferencia entre el valor del trabajo realizado hasta un determinado momento, generalmente la fecha de corte, y los costos reales en ese mismo momento.', 'CPCI_Formula' => 'CV = EV – AC', 'CPCI_Interpretacion' => 'Positiva = Por debajo del costo planificado Neutra = Igual al costo planificado Negativa = Por encima del costo planificado' ],
            [ 'CPCI_Abreviatura' => 'SV','CPCI_Nombre' => 'Variación del Cronograma', 'CPCI_Definicion' => 'La medida en que el proyecto está adelantado o retrasado en relación con la fecha de entrega planificada, en un determinado momento, expresada como la diferencia entre el valor ganado y el valor planificado.', 'CPCI_Uso' => 'La diferencia entre el valor del trabajo realizado hasta un determinado momento, generalmente la fecha de corte, y el trabajo planificado que debería estar finalizado en ese mismo momento.', 'CPCI_Formula' => 'SV = EV – PV', 'CPCI_Interpretacion' => 'Positiva = Adelanto con respecto al cronograma Neutra = De acuerdo con el cronograma Negativa = Retraso con respecto al cronograma' ],
            [ 'CPCI_Abreviatura' => 'VAC','CPCI_Nombre' => 'Variación a la Conclusión', 'CPCI_Definicion' => 'Proyección del monto del déficit o superávit presupuestario, expresada como la diferencia entre el presupuesto al concluir y la estimación al concluir.', 'CPCI_Uso' => 'La diferencia estimada en costo a la conclusión del proyecto.', 'CPCI_Formula' => 'VAC = BAC – EAC', 'CPCI_Interpretacion' => 'Positiva = Por debajo del costo planificado Neutra = Igual al costo planificado Negativa = Por encima del costo planificado' ],
            [ 'CPCI_Abreviatura' => 'CPI','CPCI_Nombre' => 'Índice de Desempeño del Costo', 'CPCI_Definicion' => 'Una medida de la eficiencia en costos de los recursos presupuestados expresada como la razón entre el valor ganado y el costo real.', 'CPCI_Uso' => 'Un CPI de 1,0 significa que el proyecto está exactamente en el presupuesto, que el trabajo realizado hasta el momento es exactamente igual al costo hasta la fecha. Otros valores muestran el porcentaje de los costos que han sobrepasado o que no han alcanzado la cantidad presupuestada para el trabajo realizado.', 'CPCI_Formula' => 'CPI = EV/AC', 'CPCI_Interpretacion' => 'Mayor que 1,0 = Por debajo del costo planificado Costo Exactamente 1,0 = En el costo planificado Menor que 1,0 = Por encima del costo planificado' ],
            [ 'CPCI_Abreviatura' => 'SPI','CPCI_Nombre' => 'Índice de Desempeño del Cronograma', 'CPCI_Definicion' => 'Una medida de la eficiencia del cronograma que se expresa como la razón entre el valor ganado y el valor planificado.', 'CPCI_Uso' => 'Un SPI de 1,0 significa que el proyecto se ajusta exactamente al cronograma, que el trabajo realizado hasta el momento coincide exactamente con el trabajo planificado hasta la fecha. Otros valores muestran el porcentaje de los costos que han sobrepasado o que no han alcanzado la cantidad presupuestada para el trabajo realizado.', 'CPCI_Formula' => 'SPI = EV/PV', 'CPCI_Interpretacion' => 'Mayor que 1,0 = Adelanto con respecto al cronograma Exactamente 1,0 = Ajustado al cronograma Menor que 1,0 = Retraso con respecto al cronograma' ],
            [ 'CPCI_Abreviatura' => 'EAC','CPCI_Nombre' => 'Estimación a la Conclusión', 'CPCI_Definicion' => 'El costo total previsto de completar todo el trabajo, expresado como la suma del costo real a la fecha y la estimación hasta la conclusión.', 'CPCI_Uso' => 'Si se espera que el CPI sea el mismo para el resto del proyecto, se puede calcular EAC con la fórmula: Si el trabajo futuro se va a realizar según la tasa planificada, utilizar: Si el plan inicial ya no fuera viable, utilizar: Si tanto CPI como SPI tienen influencia sobre el trabajo restante, utilizar:', 'CPCI_Formula' => 'EAC = BAC/CPI EAC = AC + BAC – EV EAC = AC + ETC ascendente.EAC = AC + [(BAC – EV)/ (CPI x SPI)]', 'CPCI_Interpretacion' => '' ],
            [ 'CPCI_Abreviatura' => 'ETC','CPCI_Nombre' => 'Estimación hasta la Conclusión', 'CPCI_Definicion' => 'El costo previsto para terminar todo el trabajo restante del proyecto.', 'CPCI_Uso' => 'Si se asume que el trabajo está avanzando de acuerdo con el plan, el costo para completar el trabajo autorizado restante se puede calcular mediante la utilización de: Volver a estimar el trabajo restante de manera ascendente.', 'CPCI_Formula' => 'ETC = EAC – AC ETC = Volver a estimar', 'CPCI_Interpretacion' => '' ],
            [ 'CPCI_Abreviatura' => 'TCPI','CPCI_Nombre' => 'Índice de Desempeño del Trabajo por Completar', 'CPCI_Definicion' => 'Medida del desempeño del costo que se debe alcanzar con los recursos restantes a fin de cumplir con un objetivo de gestión especificado, expresada como la tasa entre el costo para culminar el trabajo pendiente y el presupuesto restante.', 'CPCI_Uso' => 'La eficiencia que es preciso mantener para cumplir el plan. La eficiencia que es preciso mantener para completar la EAC actual.', 'CPCI_Formula' => 'TCPI = (BAC – EV)/(BAC – AC) TCPI = (BAC – EV)/(EAC – AC)', 'CPCI_Interpretacion' => 'Mayor que 1,0 = Más difícil de completar Exactamente 1,0 = Igual Menor que 1,0 = Más fácil de completar Mayor que 1,0 = Más difícil de completar Exactamente 1,0 = Igual Menor que 1,0 = Más fácil de completar' ]
        ];

        foreach ($costos as $costo ) {
            $aux = new Costos_Informacion();
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
