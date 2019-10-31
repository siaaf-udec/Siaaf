<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de planificación:'])
    <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Editar proceso: Gestión del tiempo del proyecto.</h4>
            <br>
            <div class="panel-group accordion" id="date-range">
                    <!--Primer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_1"><strong>CMMI:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Nivel de madurez:</strong> 2. <br><br><strong>Meta especifica:</strong> Gestión de Acuerdos con Proveedores.<br><br><strong>Propósito:</strong>El propósito 
                                de la Gestión de Acuerdos con Proveedores (SAM) es gestionar la adquisición de productos y servicios de proveedores.<br><br><strong>Notas introductorias:</strong>
                                El alcance de esta área de proceso aborda la adquisición de productos, servicios y componentes de producto y de servicio que pueden ser entregados al cliente del 
                                proyecto o incluidos en un producto o sistema de servicios. Estas prácticas del área de proceso también pueden ser utilizadas para otros propósitos que beneficien 
                                al proyecto (p.ej., compra de consumibles). Esta área de proceso no se aplica en todos los contextos en los que se adquieren los componentes comerciales (COTS), 
                                sino que se aplica en los casos donde hay modificaciones a los componentes (COTS), en componentes comerciales de gobierno, o en software libre, que son un valor 
                                importante para el proyecto o que representan un riesgo importante para el proyecto. En las áreas de proceso, donde se utilizan los términos “producto” y “componente 
                                de producto”, sus significados también abarcan servicios, sistemas de servicio y sus componentes. El área de proceso Gestión de Acuerdos con proveedores implica las 
                                siguientes actividades:<br>Determinar el tipo de adquisición.<br>Seleccionar los proveedores.<br>Establecer y mantener acuerdos con los proveedores.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Segundo acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_2"><strong>SCRUM:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                    Roles Scrum que son necesarios para este proceso:<br><strong>Product Owner: </strong>{{ $equipoScrum[1]['CE_Nombre_Persona'] }}<br><strong>Scrum Master:</strong> 
                                    {{$equipoScrum[0]['CE_Nombre_Persona'] }}.<br><br><strong>Equipo desarrollo</strong>
                                    @foreach ($integrantes as $integrante)
                                    <br><strong>Integrante: </strong> {{$integrante->CE_Nombre_Persona}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tercer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_3"><strong>PMBOK:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                    <strong>Proceso:</strong> Gestion de los costos del proyecto.<br>La Gestión de los Costos del Proyecto incluye los procesos relacionados con planificar, estimar, 
                                    presupuestar, financiar, obtener financiamiento, gestionar y controlar los costos de modo que se complete el proyecto dentro del presupuesto aprobado.<br><br>
                                    <strong>Planificar la Gestión de los Costos: </strong>Es el proceso que establece las políticas, los procedimientos y la documentación necesarios para planificar, 
                                    gestionar, ejecutar el gasto y controlar los costos del proyecto.<br><strong>Estimar los Costos:</strong>Es el proceso que consiste en desarrollar una aproximación 
                                    de los recursos financieros necesarios para completar las actividades del proyecto.<br><strong>Determinar el Presupuesto:</strong> Es el proceso que consiste en 
                                    sumar los costos estimados de las actividades individuales o de los paquetes de trabajo para establecer una línea base de costo autorizada.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            <h3>Tabla informativa</h3><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
            @slot('columns', [
            '#',
            'Nombre',
            'Uso',
            'Interpretacion',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h3>Tabla de costos</h3><br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'tablaCostos'])
            @slot('columns', [
            '#',
            'Formula',
            'Valor',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_1" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_1', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Variación del Costo</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_1">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_1" href="#collapse_1"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Valor ganado:</strong>El valor ganado (EV) es la medida del trabajo realizado en términos de presupuesto autorizado para dicho trabajo. 
                                        Es el presupuesto asociado con el trabajo autorizado que se ha completado. El EV medido debe corresponderse con la PMB y no puede ser mayor que el presupuesto
                                        aprobado del PV para un componente. El EV se utiliza a menudo para calcular el porcentaje completado de un proyecto. Deben establecerse criterios de medición 
                                        del avance para cada componente de la EDT/WBS, con objeto de medir el trabajo en curso. Los directores de proyecto monitorean el EV, tanto sus incrementos para 
                                        determinar el estado actual, como el total acumulado, para establecer las tendencias de desempeño a largo plazo.<br><strong>Costo real:</strong>. El costo real 
                                        (AC) es el costo incurrido por el trabajo llevado a cabo en una actividad durante un período de tiempo específico. Es el costo total en el que se ha incurrido 
                                        para llevar a cabo el trabajo medido por el EV. El AC debe corresponderse, en cuanto a definición, con lo que haya sido presupuestado para el PV y medido por el 
                                        EV (p.ej., sólo horas directas, sólo costos directos o todos los costos, incluidos los costos indirectos). El AC no tiene límite superior; se medirán todos los 
                                        costos en los que se incurra para obtener el EV. 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC1_valor_ganado',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el valor ganado.', 'icon' => 'fa fa-usd'] ) !!}
                                  
                                    {!! Field:: text('MC1_costo_real',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el costo real.', 'icon' => 'fa fa-usd']) !!} 
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_2" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_2', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Variación del Cronograma</h3>
                        </div>
                        <div class="modal-body">
                            
                    <div class="panel-group accordion" id="modal_2">
                    <!--Primer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_2" href="#collapse_2"><strong>Variables:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Valor ganado:</strong>El valor ganado (EV) es la medida del trabajo realizado en términos de presupuesto autorizado para dicho trabajo. Es el presupuesto 
                                asociado con el trabajo autorizado que se ha completado. El EV medido debe corresponderse con la PMB y no puede ser mayor que el presupuesto aprobado del PV para 
                                un componente. El EV se utiliza a menudo para calcular el porcentaje completado de un proyecto. Deben establecerse criterios de medición del avance para cada componente 
                                de la EDT/WBS, con objeto de medir el trabajo en curso. Los directores de proyecto monitorean el EV, tanto sus incrementos para determinar el estado actual, como el total 
                                acumulado, para establecer las tendencias de desempeño a largo plazo.<br><strong>Valor planificado:</strong>El valor planificado (PV) es el presupuesto autorizado que se 
                                ha asignado al trabajo programado. Es el presupuesto autorizado asignado al trabajo que debe ejecutarse para completar una actividad o un componente de la estructura de 
                                desglose del trabajo, sin contar con la reserva de gestión. Este presupuesto se adjudica por fase a lo largo del proyecto, pero para un momento determinado, el valor planificado 
                                establece el trabajo físico que se debería haber llevado a cabo hasta ese momento. El PV total se conoce en ocasiones como la línea base para la medición del desempeño (PMB). 
                                El valor planificado total para el proyecto también se conoce como presupuesto hasta la conclusión (BAC).
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC2_valor_ganado',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el valor ganado.', 'icon' => 'fa fa-usd'] ) !!}
                                  
                                    {!! Field:: text('MC2_valor_planificado',null,['label'=>'Valor Planificado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                    ['help' => 'Digite el valor planificado.', 'icon' => 'fa fa-usd']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_3" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_3', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Variación a la Conclusión</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_3">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_3" href="#collapse_3"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Presupuesto hasta la Conclusión:</strong> (BAC) Es la suma de todos los presupuestos establecidos para el trabajo a realizar.<br><strong>Estimación a la 
                                            Conclusión:</strong> (EAC) El costo total previsto de completar todo el trabajo, expresado como la suma del costo real a la fecha y la estimación hasta la conclusión.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC3_presupuesto',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el presupuesto hasta la Conclusión.'] ) !!}
                                  
                                    {!! Field:: text('MC3_estimacion',null,['label'=>'Estimación a la Conclusión:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite la estimación a la Conclusión.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_4" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_4', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Índice de Desempeño del Costo</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_4">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_4" href="#collapse_4"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Valor ganado:</strong> El valor ganado (EV) es la medida del trabajo realizado en términos de presupuesto autorizado para dicho trabajo. Es el presupuesto 
                                        asociado con el trabajo autorizado que se ha completado. El EV medido debe corresponderse con la PMB y no puede ser mayor que el presupuesto aprobado del PV para 
                                        un componente. El EV se utiliza a menudo para calcular el porcentaje completado de un proyecto. Deben establecerse criterios de medición del avance para cada componente
                                        de la EDT/WBS, con objeto de medir el trabajo en curso. Los directores de proyecto monitorean el EV, tanto sus incrementos para determinar el estado actual, como el total
                                        acumulado, para establecer las tendencias de desempeño a largo plazo.<br><strong>Costo real:</strong>El costo real (AC) es el costo incurrido por el trabajo llevado a cabo 
                                        en una actividad durante un período de tiempo específico. Es el costo total en el que se ha incurrido para llevar a cabo el trabajo medido por el EV. El AC debe corresponderse, 
                                        en cuanto a definición, con lo que haya sido presupuestado para el PV y medido por el EV (p.ej., sólo horas directas, sólo costos directos o todos los costos, incluidos los costos 
                                        indirectos). El AC no tiene límite superior; se medirán todos los costos en los que se incurra para obtener el EV
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC4_valor_ganado',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el valor ganado.'] ) !!}
                                  
                                    {!! Field:: text('MC4_costo_real',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el costo real.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_5" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_5', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Índice de Desempeño del Cronograma</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_5">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_5" href="#collapse_5"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Valor ganado:</strong>  El valor ganado (EV) es la medida del trabajo realizado en términos de presupuesto autorizado para dicho trabajo. Es el presupuesto 
                                        asociado con el trabajo autorizado que se ha completado. El EV medido debe corresponderse con la PMB y no puede ser mayor que el presupuesto aprobado del PV para un 
                                        componente. El EV se utiliza a menudo para calcular el porcentaje completado de un proyecto. Deben establecerse criterios de medición del avance para cada componente 
                                        de la EDT/WBS, con objeto de medir el trabajo en curso. Los directores de proyecto monitorean el EV, tanto sus incrementos para determinar el estado actual, como el 
                                        total acumulado, para establecer las tendencias de desempeño a largo plazo.<br><strong>Valor planificado:</strong> El valor planificado (PV) es el presupuesto autorizado 
                                        que se ha asignado al trabajo programado. Es el presupuesto autorizado asignado al trabajo que debe ejecutarse para completar una actividad o un componente de la estructura 
                                        de desglose del trabajo, sin contar con la reserva de gestión. Este presupuesto se adjudica por fase a lo largo del proyecto, pero para un momento determinado, el valor 
                                        planificado establece el trabajo físico que se debería haber llevado a cabo hasta ese momento. El PV total se conoce en ocasiones como la línea base para la medición del 
                                        desempeño (PMB). El valor planificado total para el proyecto también se conoce como presupuesto hasta la conclusión (BAC).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC5_valor_ganado',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el valor ganado.'] ) !!}
                                  
                                    {!! Field:: text('MC5_valor_planificado',null,['label'=>'Valor Planificado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el valor planificado.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_6" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_6', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Estimación a la Conclusión</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_6">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_6" href="#collapse_6"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_6" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Presupuesto hasta la Conclusión:</strong> (BAC) Es la suma de todos los presupuestos establecidos para el trabajo a realizar.<br><strong>Índice de desempeño 
                                            del costo: </strong>El índice de desempeño del costo (CPI) es una medida de eficiencia del costo de los recursos presupuestados, expresado como la razón entre el 
                                            valor ganado y el costo real. Se considera la métrica más crítica del EVM y mide la eficiencia del costo para el trabajo completado. Un valor de CPI inferior a 1,0 
                                            indica un costo superior al planificado con respecto al trabajo completado. Un valor de CPI superior a 1,0 indica un costo inferior con respecto al desempeño hasta 
                                            la fecha. El CPI es igual a la razón entre el EV y el AC. Los índices son útiles para determinar el estado de un proyecto y proporcionar una base para la estimación 
                                            del costo y del cronograma al final del proyecto.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC6_presupuesto_conclucion',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el presupuesto hasta la Conclusión.'] ) !!}
                                  
                                    {!! Field:: text('MC6_indice_costo',null,['label'=>'Índice de Desempeño del Costo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                        ['help' => 'Digite el índice de desempeño del costo.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_7" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_7', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Estimación a la Conclusión</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_7">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_7" href="#collapse_7"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_7" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Costo real: </strong>. El costo real (AC) es el costo incurrido por el trabajo llevado a cabo en una actividad durante un período de tiempo específico.
                                        Es el costo total en el que se ha incurrido para llevar a cabo el trabajo medido por el EV. El AC debe corresponderse, en cuanto a definición, con lo que haya
                                        sido presupuestado para el PV y medido por el EV (p.ej., sólo horas directas, sólo costos directos o todos los costos, incluidos los costos indirectos). El AC 
                                        no tiene límite superior; se medirán todos los costos en los que se incurra para obtener el EV.<br><strong>Presupuesto hasta la Conclusión:</strong> (BAC) Es 
                                        la suma de todos los presupuestos establecidos para el trabajo a realizar.<br> <strong>Valor ganado: </strong>El valor ganado (EV) es la medida del trabajo realizado 
                                        en términos de presupuesto autorizado para dicho trabajo. Es el presupuesto asociado con el trabajo autorizado que se ha completado. El EV medido debe corresponderse 
                                        con la PMB y no puede ser mayor que el presupuesto aprobado del PV para un componente. El EV se utiliza a menudo para calcular el porcentaje completado de un proyecto. 
                                        Deben establecerse criterios de medición del avance para cada componente de la EDT/WBS, con objeto de medir el trabajo en curso. Los directores de proyecto monitorean 
                                        el EV, tanto sus incrementos para determinar el estado actual, como el total acumulado, para establecer las tendencias de desempeño a largo plazo. 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC7_costo_real',null,['label'=>'Costo Real:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el costo real.'] ) !!}

                                    {!! Field:: text('MC7_presupuesto',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el presupuesto hasta la conclusión.'] ) !!}
                                  
                                    {!! Field:: text('MC7_valor_ganado',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el valor ganado.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_8" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_8', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Estimación a la Conclusión</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_8">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_8" href="#collapse_8"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_8" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Costo real:</strong>El costo real (AC) es el costo incurrido por el trabajo llevado a cabo en una actividad durante un período de tiempo específico. Es el 
                                        costo total en el que se ha incurrido para llevar a cabo el trabajo medido por el EV. El AC debe corresponderse, en cuanto a definición, con lo que haya sido presupuestado 
                                        para el PV y medido por el EV (p.ej., sólo horas directas, sólo costos directos o todos los costos, incluidos los costos indirectos). El AC no tiene límite superior; se 
                                        medirán todos los costos en los que se incurra para obtener el EV.<br><strong>Estimación hasta la Conclusión: </strong> (ETC) El costo previsto para terminar todo el 
                                        trabajo restante del proyecto.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC8_costo_real',null,['label'=>'Costo Real:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el costo real.'] ) !!}
                                  
                                    {!! Field:: text('MC8_estimacion',null,['label'=>'Estimación hasta la Conclusión (ascendente):', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite la estimación hasta la conclusión.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_9" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_9', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Estimación a la Conclusión</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_9">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_9" href="#collapse_9"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_9" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Costo real:</strong> El costo real (AC) es el costo incurrido por el trabajo llevado a cabo en una actividad durante un período de tiempo específico. Es el 
                                        costo total en el que se ha incurrido para llevar a cabo el trabajo medido por el EV. El AC debe corresponderse, en cuanto a definición, con lo que haya sido 
                                        presupuestado para el PV y medido por el EV (p.ej., sólo horas directas, sólo costos directos o todos los costos, incluidos los costos indirectos). El AC no tiene 
                                        límite superior; se medirán todos los costos en los que se incurra para obtener el EV.<br><strong>Presupuesto hasta la Conclusión:</strong> (BAC) La suma de todos 
                                        los presupuestos establecidos para el trabajo a realizar.<br><strong>Valor ganado:</strong> El valor ganado (EV) es la medida del trabajo realizado en términos 
                                        de presupuesto autorizado para dicho trabajo. Es el presupuesto asociado con el trabajo autorizado que se ha completado. El EV medido debe corresponderse con la 
                                        PMB y no puede ser mayor que el presupuesto aprobado del PV para un componente. El EV se utiliza a menudo para calcular el porcentaje completado de un proyecto. 
                                        Deben establecerse criterios de medición del avance para cada componente de la EDT/WBS, con objeto de medir el trabajo en curso. Los directores de proyecto monitorean 
                                        el EV, tanto sus incrementos para determinar el estado actual, como el total acumulado, para establecer las tendencias de desempeño a largo plazo.<br><strong>Índice 
                                        de desempeño del costo:</strong> El índice de desempeño del costo (CPI) es una medida de eficiencia del costo de los recursos presupuestados, expresado como la razón 
                                        entre el valor ganado y el costo real. Se considera la métrica más crítica del EVM y mide la eficiencia del costo para el trabajo completado. Un valor de CPI inferior 
                                        a 1,0 indica un costo superior al planificado con respecto al trabajo completado. Un valor de CPI superior a 1,0 indica un costo inferior con respecto al desempeño 
                                        hasta la fecha. El CPI es igual a la razón entre el EV y el AC. Los índices son útiles para determinar el estado de un proyecto y proporcionar una base para la estimación 
                                        del costo y del cronograma al final del proyecto. <br><strong>Índice de desempeño del cronograma:</strong> El índice de desempeño del cronograma (SPI) es una medida de 
                                        eficiencia del cronograma que se expresa como la razón entre el valor ganado y el valor planificado. Refleja la medida de la eficiencia con que el equipo del proyecto está 
                                        utilizando su tiempo. En ocasiones se utiliza en combinación con el índice de desempeño del costo (CPI) para proyectar las estimaciones finales a la conclusión del proyecto. 
                                        Un valor de SPI inferior a 1,0 indica que la cantidad de trabajo llevada a cabo es menor que la prevista. Un valor de SPI superior a 1,0 indica que la cantidad de trabajo 
                                        efectuada es mayor a la prevista. Puesto que el SPI mide todo el trabajo del proyecto, se debe analizar asimismo el desempeño en la ruta crítica, para así determinar si el 
                                        proyecto terminará antes o después de la fecha de finalización programada. El SPI es igual a la razón entre el EV y el PV.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC9_costo_real',null,['label'=>'Costo Real:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el costo real.'] ) !!}
                                  
                                    {!! Field:: text('MC9_presupuesto',null,['label'=>'Presupuesto hasta la Conclusión:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el presupuesto hasta la conclusión.']) !!}

                                    {!! Field:: text('MC9_valor_ganado',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el valor ganado.']) !!}

                                    {!! Field:: text('MC9_indice_costo',null,['label'=>'Índice de Desempeño del Costo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el índice de desempeño del costo.']) !!}

                                    {!! Field:: text('MC9_indice_cronograma',null,['label'=>'Índice de Desempeño del Cronograma:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                         ['help' => 'Digite el índice de desempeño del cronograma.']) !!}

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_10" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_10', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Estimación hasta la Conclusión</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_10">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_10" href="#collapse_10"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_10" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Estimación a la Conclusión: </strong> (EAC) El costo total previsto de completar todo el trabajo, expresado como la suma del costo real a la fecha y la 
                                        estimación hasta la conclusión.<br> <strong>Costo real: </strong>El costo real (AC) es el costo incurrido por el trabajo llevado a cabo en una actividad durante 
                                        un período de tiempo específico. Es el costo total en el que se ha incurrido para llevar a cabo el trabajo medido por el EV. El AC debe corresponderse, en cuanto 
                                        a definición, con lo que haya sido presupuestado para el PV y medido por el EV (p.ej., sólo horas directas, sólo costos directos o todos los costos, incluidos los 
                                        costos indirectos). El AC no tiene límite superior; se medirán todos los costos en los que se incurra para obtener el EV.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC10_estimacion',null,['label'=>'Estimación a la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite la estimación a la conclusión.'] ) !!}
                                  
                                    {!! Field:: text('MC10_costo_real',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el costo real.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_11" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_11', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Índice de Desempeño del Trabajo por Completar</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_11">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_11" href="#collapse_11"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_11" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Presupuesto hasta la Conclusión:</strong> (BAC) La suma de todos los presupuestos establecidos para el trabajo a realizar.<br>
                                        <strong>Valor ganado:</strong> El valor ganado (EV) es la medida del trabajo realizado en términos de presupuesto autorizado para dicho trabajo. Es el presupuesto 
                                        asociado con el trabajo autorizado que se ha completado. El EV medido debe corresponderse con la PMB y no puede ser mayor que el presupuesto aprobado del PV para un 
                                        componente. El EV se utiliza a menudo para calcular el porcentaje completado de un proyecto. Deben establecerse criterios de medición del avance para cada componente 
                                        de la EDT/WBS, con objeto de medir el trabajo en curso. Los directores de proyecto monitorean el EV, tanto sus incrementos para determinar el estado actual, como el 
                                        total acumulado, para establecer las tendencias de desempeño a largo plazo. <br>
                                        <strong>Costo real:</strong> El costo real (AC) es el costo incurrido por el trabajo llevado a cabo en una actividad durante un período de tiempo específico. Es el 
                                        costo total en el que se ha incurrido para llevar a cabo el trabajo medido por el EV. El AC debe corresponderse, en cuanto a definición, con lo que haya sido 
                                        presupuestado para el PV y medido por el EV (p.ej., sólo horas directas, sólo costos directos o todos los costos, incluidos los costos indirectos). El AC no tiene 
                                        límite superior; se medirán todos los costos en los que se incurra para obtener el EV. 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC11_presupuesto',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el presupuesto hasta la conclusión.'] ) !!}
                                  
                                    {!! Field:: text('MC11_valor_ganado',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el valor ganado.']) !!}

                                    {!! Field:: text('MC11_costo_real',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el costo real.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_costos_12" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_12', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Formula: Índice de Desempeño del Trabajo por Completar</h3>
                        </div>
                        <div class="modal-body">
                        <div class="panel-group accordion" id="modal_12">
                            <!--Primer acordeon-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#modal_12" href="#collapse_12"><strong>Variables:</strong></a>
                                    </h4>
                                </div>
                                <div id="collapse_12" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="alert alert-primary">
                                        <strong>Presupuesto hasta la Conclusión:</strong> (BAC) La suma de todos los presupuestos establecidos para el trabajo a realizar.<br>
                                        <strong>Valor ganado:</strong> El valor ganado (EV) es la medida del trabajo realizado en términos de presupuesto autorizado para dicho trabajo. Es el presupuesto 
                                        asociado con el trabajo autorizado que se ha completado. El EV medido debe corresponderse con la PMB y no puede ser mayor que el presupuesto aprobado del PV para un 
                                        componente. El EV se utiliza a menudo para calcular el porcentaje completado de un proyecto. Deben establecerse criterios de medición del avance para cada componente 
                                        de la EDT/WBS, con objeto de medir el trabajo en curso. Los directores de proyecto monitorean el EV, tanto sus incrementos para determinar el estado actual, como el 
                                        total acumulado, para establecer las tendencias de desempeño a largo plazo. <br>
                                        <strong>Estimación a la Conclusión: </strong>(EAC) El costo total previsto de completar todo el trabajo, expresado como la suma del costo real a la fecha y la 
                                        estimación hasta la conclusión. <br>
                                        <strong>Costo real:</strong> El costo real (AC) es el costo incurrido por el trabajo llevado a cabo en una actividad durante un período de tiempo específico. Es el 
                                        costo total en el que se ha incurrido para llevar a cabo el trabajo medido por el EV. El AC debe corresponderse, en cuanto a definición, con lo que haya sido 
                                        presupuestado para el PV y medido por el EV (p.ej., sólo horas directas, sólo costos directos o todos los costos, incluidos los costos indirectos). El AC no tiene 
                                        límite superior; se medirán todos los costos en los que se incurra para obtener el EV. 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                {!! Field:: text('MC12_presupuesto',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el presupuesto hasta la conclusión.'] ) !!}
                                  
                                    {!! Field:: text('MC12_valor',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el valor ganado.']) !!}

                                    {!! Field:: text('MC12_estimacion',null,['label'=>'Estimación a la Conclusión:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite la estimación a la conclusión.']) !!}

                                    {!! Field:: text('MC12_costo',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el costo real.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} 
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                        <a href="javascript:;" class="btn btn-success button-cancel">
                            Continuar <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        var table, url, columns;
        table = $('#listaProyectos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaCostosInformacion')}}";
        columns = [{
                data: 'PK_CPCI_Id_Costos',
                name: 'PK_CPCI_Id_Costos'
            },
            {
                data: 'CPCI_Nombre',
                name: 'CPCI_Nombre'
            },
            {
                data: 'CPCI_Uso',
                name: 'CPCI_Uso'
            },
            {
                data: 'CPCI_Interpretacion',
                name: 'CPCI_Interpretacion'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success verEtapas"  title="Ver los procesos de este Proyecto" ><i class="fa fa-angle-right"></i></a>',
                data: 'action',
                name: '',
                title: '',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        table.on('click', '.verEtapas', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('#modal_costos_'+dataTable.PK_CPCI_Id_Costos).modal('toggle');
        });

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

        /* Inicio Modal #1*/
        var createModal_1 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC1_valor_ganado"]').val()) - parseInt($('input:text[name="MC1_costo_real"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    
                    var formData = new FormData();
                    formData.append('id_formula', '1');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_1').modal('hide');
                                $('#form_costos_1')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_create_modal_1 = $('#form_costos_1');
        var rules_create_modal_1 = {
            MC1_valor_ganado: { min: 1, required: true },
            MC1_costo_real: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_1,rules_create_modal_1,false,createModal_1());
        /*Fin modal #1 */

        /* Inicio Modal #2*/
        var createModal_2 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC2_valor_ganado"]').val()) - parseInt($('input:text[name="MC2_valor_planificado"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    
                    var formData = new FormData();
                    formData.append('id_formula', '2');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_2').modal('hide');
                                $('#form_costos_2')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_create_modal_2 = $('#form_costos_2');
        var rules_create_modal_2 = {
            MC2_valor_ganado: { min: 1, required: true },
            MC2_valor_planificado: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_2,rules_create_modal_2,false,createModal_2());
        /*Fin modal #2 */

        /* Inicio Modal #3*/
        var createModal_3 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC3_presupuesto"]').val()) - parseInt($('input:text[name="MC3_estimacion"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    
                    var formData = new FormData();
                    formData.append('id_formula', '3');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_3').modal('hide');
                                $('#form_costos_3')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_create_modal_3 = $('#form_costos_3');
        var rules_create_modal_3 = {
            MC3_presupuesto: { min: 1, required: true },
            MC3_estimacion: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_3,rules_create_modal_3,false,createModal_3());
        /*Fin modal #3 */

        /* Inicio Modal #4*/
        var createModal_4 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC4_valor_ganado"]').val()) / parseInt($('input:text[name="MC4_costo_real"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '4');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_4').modal('hide');
                                $('#form_costos_4')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_4 = $('#form_costos_4');
        var rules_create_modal_4 = {
            MC4_valor_ganado: { min: 1, required: true },
            MC4_costo_real: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_4,rules_create_modal_4,false,createModal_4());
        /*Fin modal #4 */

        /* Inicio Modal #5*/
        var createModal_5 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC5_valor_ganado"]').val()) / parseInt($('input:text[name="MC5_valor_planificado"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '5');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_5').modal('hide');
                                $('#form_costos_5')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_5 = $('#form_costos_5');
        var rules_create_modal_5 = {
            MC5_valor_ganado: { min: 1, required: true },
            MC5_valor_planificado: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_5,rules_create_modal_5,false,createModal_5());
        /*Fin modal #5 */

        /* Inicio Modal #6*/
        var createModal_6 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC6_presupuesto_conclucion"]').val())/ parseInt($('input:text[name="MC6_indice_costo"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '6');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_6').modal('hide');
                                $('#form_costos_6')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_6 = $('#form_costos_6');
        var rules_create_modal_6 = {
            MC6_presupuesto_conclucion: { min: 1, required: true },
            MC6_indice_costo: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_6,rules_create_modal_6,false,createModal_6());
        /*Fin modal #6 */

        /* Inicio Modal #7*/
        var createModal_7 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC7_costo_real"]').val()) + parseInt($('input:text[name="MC7_presupuesto"]').val()) - parseInt($('input:text[name="MC7_valor_ganado"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '7');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_7').modal('hide');
                                $('#form_costos_7')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_7 = $('#form_costos_7');
        var rules_create_modal_7 = {
            MC7_costo_real: { min: 1, required: true },
            MC7_presupuesto: { min: 1, required: true },
            MC7_valor_ganado: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_7,rules_create_modal_7,false,createModal_7());
        /*Fin modal #7 */

        /* Inicio Modal #8*/
        var createModal_8 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC8_costo_real"]').val()) + parseInt($('input:text[name="MC8_estimacion"]').val()) );
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '8');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_8').modal('hide');
                                $('#form_costos_8')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_8 = $('#form_costos_8');
        var rules_create_modal_8 = {
            MC8_costo_real: { min: 1, required: true },
            MC8_estimacion: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_8,rules_create_modal_8,false,createModal_8());
        /*Fin modal #8 */

        /* Inicio Modal #9*/
        var createModal_9 = function () {
            return{
                init: function () {
                    let resultado = parseInt($('input:text[name="MC9_costo_real"]').val()) + ((parseInt($('input:text[name="MC9_presupuesto"]').val()) - parseInt($('input:text[name="MC9_valor_ganado"]').val())) / (parseInt($('input:text[name="MC9_indice_costo"]').val()) * parseInt($('input:text[name="MC9_indice_cronograma"]').val()))) ;
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '9');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_9').modal('hide');
                                $('#form_costos_9')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_9 = $('#form_costos_9');
        var rules_create_modal_9 = {
            MC9_costo_real: { min: 1, required: true },
            MC9_presupuesto: { min: 1, required: true },
            MC9_valor_ganado: { min: 1, required: true },
            MC9_indice_costo: { min: 1, required: true },
            MC9_indice_cronograma: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_9,rules_create_modal_9,false,createModal_9());
        /*Fin modal #9 */

        /* Inicio Modal #10*/
        var createModal_10 = function () {
            return{
                init: function () {
                    let resultado = (parseInt($('input:text[name="MC10_estimacion"]').val()) - parseInt($('input:text[name="MC10_costo_real"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '10');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_10').modal('hide');
                                $('#form_costos_10')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_10 = $('#form_costos_10');
        var rules_create_modal_10 = {
            MC10_estimacion: { min: 1, required: true },
            MC10_costo_real: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_10,rules_create_modal_10,false,createModal_10());
        /*Fin modal #10 */

        /* Inicio Modal #11*/
        var createModal_11 = function () {
            return{
                init: function () {
                    let resultado = (($('input:text[name="MC11_presupuesto"]').val() - $('input:text[name="MC11_valor_ganado"]').val()) / ($('input:text[name="MC11_presupuesto"]').val() - $('input:text[name="MC11_costo_real"]').val()));
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '11');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_11').modal('hide');
                                $('#form_costos_11')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_11 = $('#form_costos_11');
        var rules_create_modal_11 = {
            MC11_presupuesto: { min: 1, required: true },
            MC11_valor_ganado: { min: 1, required: true },
            MC11_costo_real: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_11,rules_create_modal_11,false,createModal_11());
        /*Fin modal #11 */

        /* Inicio Modal #12*/
        var createModal_12 = function () {
            return{
                init: function () {
                    let resultado = (($('input:text[name="MC12_presupuesto"]').val() - $('input:text[name="MC12_valor"]').val()) / ($('input:text[name="MC12_estimacion"]').val() - $('input:text[name="MC12_costo"]').val()));

                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('id_formula', '12');
                    formData.append('valor', resultado);
                    formData.append('FK_CPC_Id_Proyecto', {{$idProyecto}});
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table2.ajax.reload();
                                $('#modal_costos_12').modal('hide');
                                $('#form_costos_12')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var form_create_modal_12 = $('#form_costos_12');
        var rules_create_modal_12 = {
            MC12_presupuesto: { min: 1, required: true },
            MC12_valor: { min: 1, required: true },
            MC12_estimacion: { min: 1, required: true },
            MC12_costo: { min: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_12,rules_create_modal_12,false,createModal_12());
        /*Fin modal #12 */

        /*
        Segunda tabla: tabla de costos
        */
        var table2, url2, columns2;
        table2 = $('#tablaCostos');
        url2 = "{{ route('calidadpcs.procesosCalidad.tablaCostos')}}" + "/" + {{$idProyecto}};
        columns2 = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'Formula',
                name: 'Formula'
            },
            {
                data: 'CPC_Valor',
                name: 'CPC_Valor'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-danger eliminar"  title="Ver los procesos de este Proyecto" ><i class="fa fa-trash-o"></i></a>',
                data: 'action',
                name: '',
                title: '',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table2, url2, columns2);
        table2 = table2.DataTable();

        table2.on('click', '.eliminar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable2 = table2.row($tr).data();
            var route = '{{ route('calidadpcs.procesosCalidad.destroyCosto') }}' + '/' + dataTable2.PK_CPC_Id_Costo;
            var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este costo?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    table2.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun costo", "error");
                    }
                });
        });

        $(".guardarCosto").on('click', function(e) {
            e.preventDefault();
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso4_1') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('FK_CPP_Id_Proyecto', {{$idProyecto}});
                    formData.append('FK_CPP_Id_Proceso', {{$idProceso}});
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        success: function(response, xhr, request) {
                            if (response.data == 422) {
                                xhr = "warning"
                                UIToastr.init(xhr, response.title, response.message);
                            } else {
                                if (request.status === 200 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
                                }
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });
    });
    
</script>