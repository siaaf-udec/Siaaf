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
            'Abreviatura',
            'Nombre',
            'Uso',
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-1" role="dialog" tabindex="-1">
                <div class="">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_costos_1', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h1>Formula: Variación del Costo</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-2" role="dialog" tabindex="-1">
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Valor Planificado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-3" role="dialog" tabindex="-1">
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Estimación a la Conclusión:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-4" role="dialog" tabindex="-1">
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Costo Real:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-5" role="dialog" tabindex="-1">
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Valor Ganado:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Valor Planificado:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
            <div aria-hidden="true" class="modal fade" id="modal-costos-6" role="dialog" tabindex="-1">
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Presupuesto hasta la Conclusión:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Índice de Desempeño del Costo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
                                   {!! Field:: text('CPC_Nombre_Sprint',null,['label'=>'Nombre del sprint:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre del sprint.'] ) !!}
                                  
                                    {!! Field:: text('numero_semanas',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'], ['help' => 'Digite el numero de semanas.']) !!}
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
                data: 'CPCI_Abreviatura',
                name: 'CPCI_Abreviatura'
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
                defaultContent: '<a href="javascript:;" class="btn btn-success verEtapas"  title="Ver los procesos de este Proyecto" ><i class="fa fa-list-ul"></i></a>',
                data: 'action',
                name: 'Etapas',
                title: 'Etapas',
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
            $('#modal-costos-'+dataTable.PK_CPCI_Id_Costos).modal('toggle');

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

    });
</script>