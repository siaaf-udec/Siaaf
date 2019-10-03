<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Proyectos:'])
    <div class="row">
        <div class="col-md-12">
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
                            <h2>Formula: Variación del Costo</h2>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC1_valor_ganado',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('MC1_costo_real',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el numero de semanas.']) !!}
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
                            <h1>Formula: Variación del Cronograma</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC2_valor_ganado',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('MC2_valor_planificado',null,['label'=>'Valor Planificado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                    ['help' => 'Digite el numero de semanas.']) !!}
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
                            <h1>Formula: Variación a la Conclusión</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC3_presupuesto',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('MC3_estimacion',null,['label'=>'Estimación a la Conclusión:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el numero de semanas.']) !!}
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
                            <h1>Formula: Índice de Desempeño del Costo</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC4_valor_ganado',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('MC4_costo_real',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
                            <h1>Formula: Índice de Desempeño del Cronograma</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC5_valor_ganado',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('MC5_valor_planificado',null,['label'=>'Valor Planificado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], 
                                        ['help' => 'Digite el numero de semanas.']) !!}
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
                            <h1>Formula: Estimación a la Conclusión</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('MC6_presupuesto_conclucion',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('MC6_indice_costo',null,['label'=>'Índice de Desempeño del Costo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                        ['help' => 'Digite el numero de semanas.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{--   {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} --}}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-7" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_7', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Formula: Índice de Desempeño del Costo</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Costo Real:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}

                                    {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{--   {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} --}}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-8" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_8', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Formula: Estimación a la Conclusión</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Costo Real:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Estimación hasta la Conclusión (ascendente):', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{--   {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} --}}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-9" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_9', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Formula: Estimación a la Conclusión</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Costo Real:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Presupuesto hasta la Conclusión:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}

                                    {!! Field:: text('numero_semanas',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}

                                    {!! Field:: text('numero_semanas',null,['label'=>'Índice de Desempeño del Costo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}

                                    {!! Field:: text('numero_semanas',null,['label'=>'Índice de Desempeño del Cronograma:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{--   {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} --}}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-10" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_10', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Formula: Estimación hasta la Conclusión</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Estimación a la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{--   {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} --}}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-11" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_11', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Formula: Índice de Desempeño del Trabajo por Completar</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}

                                    {!! Field:: text('numero_semanas',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{--   {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} --}}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-12" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_12', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Formula: Índice de Desempeño del Trabajo por Completar</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Valor Ganado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}

                                    {!! Field:: text('numero_semanas',null,['label'=>'Estimación a la Conclusión:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}

                                    {!! Field:: text('numero_semanas',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                        {{--   {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} --}}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
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

        // $(".create").on('click', function(e) {
        //     e.preventDefault();
        //     var route = '{{ route('calidadpcs.proyectosCalidad.RegistrarProyecto') }}' + '/' +{{Auth::user()->id}};
        //     $(".content-ajax").load(route);
        // });

        table.on('click', '.verEtapas', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            console.log(dataTable.PK_CPCI_Id_Costos)
            $('#modal_costos_'+dataTable.PK_CPCI_Id_Costos).modal('toggle');

                // route_edit = '{{ route('calidadpcs.procesosCalidad.etapas')}}'+'/'+dataTable.PK_CP_Id_Proyecto;
            // $(".content-ajax").load(route_edit);
        });

        // table.on('click', '.edit', function(e) {
        //     e.preventDefault();
        //     $tr = $(this).closest('tr');
        //     var dataTable = table.row($tr).data(),
        //         route_edit = '{{ route('calidadpcs.proyectosCalidad.edit')}}'+'/'+ dataTable.PK_CP_Id_Proyecto;
        //     $(".content-ajax").load(route_edit);
        // });

        /* Inicio Modal #1*/
        var createModal_1 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC1_valor_ganado"]').val() - $('input:text[name="MC1_costo_real"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_1,rules_create_modal_1,false,createModal_1());
        /*Fin modal #1 */

        /* Inicio Modal #2*/
        var createModal_2 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC2_valor_ganado"]').val() - $('input:text[name="MC2_valor_planificado"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_2,rules_create_modal_2,false,createModal_2());
        /*Fin modal #2 */

        /* Inicio Modal #3*/
        var createModal_3 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC3_presupuesto"]').val() - $('input:text[name="MC3_estimacion"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_3,rules_create_modal_3,false,createModal_3());
        /*Fin modal #3 */

        /* Inicio Modal #4*/
        var createModal_4 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC4_valor_ganado"]').val() / $('input:text[name="MC4_costo_real"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_4,rules_create_modal_4,false,createModal_4());
        /*Fin modal #4 */

        /* Inicio Modal #5*/
        var createModal_5 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC5_valor_ganado"]').val() / $('input:text[name="MC5_valor_planificado"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_5,rules_create_modal_5,false,createModal_5());
        /*Fin modal #5 */

        /* Inicio Modal #6*/
        var createModal_6 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC6_presupuesto_conclucion"]').val() / $('input:text[name="MC6_indice_costo"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_6,rules_create_modal_6,false,createModal_6());
        /*Fin modal #6 */

        /* Inicio Modal #7*/
        var createModal_7 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC7_valor_ganado"]').val() / $('input:text[name="MC7_costo_real"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_7,rules_create_modal_7,false,createModal_7());
        /*Fin modal #7 */

        /* Inicio Modal #8*/
        var createModal_8 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC8_valor_ganado"]').val() / $('input:text[name="MC8_costo_real"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_8,rules_create_modal_8,false,createModal_8());
        /*Fin modal #8 */

        /* Inicio Modal #9*/
        var createModal_9 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC9_valor_ganado"]').val() / $('input:text[name="MC9_costo_real"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_9,rules_create_modal_9,false,createModal_9());
        /*Fin modal #9 */

        /* Inicio Modal #10*/
        var createModal_10 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC10_valor_ganado"]').val() / $('input:text[name="MC10_costo_real"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_10,rules_create_modal_10,false,createModal_10());
        /*Fin modal #10 */

        /* Inicio Modal #11*/
        var createModal_11 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC11_valor_ganado"]').val() / $('input:text[name="MC11_costo_real"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
        };
        FormValidationMd.init(form_create_modal_11,rules_create_modal_11,false,createModal_11());
        /*Fin modal #11 */

        /* Inicio Modal #12*/
        var createModal_12 = function () {
            return{
                init: function () {
                    let resultado = ($('input:text[name="MC12_valor_ganado"]').val() / $('input:text[name="MC12_costo_real"]').val());
                    console.log(resultado);
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
                                // table.ajax.reload();
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
            // MC1_valor_ganado: { minlength: 1, required: true },
            // MC1_costo_real: { minlength: 1, required: true },
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
                defaultContent: '<a href="javascript:;" class="btn btn-danger verEtapas"  title="Ver los procesos de este Proyecto" ><i class="fa fa-trash-o"></i></a>',
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
    });
</script>