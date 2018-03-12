
@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Datatables')

@section('page-title', 'Datatables')

@section('page-description', 'ejemplo de uso y personalización del datatable.')

@section('content')
        <div class="col-md-12">
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Datatable Ajax'])

                @slot('actions', [

                    'link_upload' => [
                        'link' => '',
                        'icon' => 'icon-cloud-upload',
                    ],
                    'link_wrench' => [
                        'link' => '',
                        'icon' => 'icon-wrench',
                    ],
                    'link_trash' => [
                        'link' => '',
                        'icon' => 'icon-trash',
                    ],

                ])
                <div class="clearfix"> </div><br><br><br>
                <div class="row">
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'example-table-ajax'])
                            @slot('columns', [
                                '#' => ['style' => 'width:20px;'],
                                'id',
                                'Nombre',
                                'Email',
                                'Acciones' => ['style' => 'width:90px;']
                            ])
                        @endcomponent
                    </div>
                    <div class="clearfix"> </div><br><br><br>
                    <div class="col-md-12">
                        <div class="panel-group accordion" id="datatable-accordion-ajax">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#datatable-accordion-ajax" href="#collapse_3_1"> Método de Creación </a>
                                    </h4>
                                </div>
                                <div id="collapse_3_1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#datatable-accordion-ajax" href="#collapse_3_2"> Requisitos </a>
                                    </h4>
                                </div>
                                <div id="collapse_3_2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#datatable-accordion-ajax" href="#collapse_3_3"> Método de iniciación JS</a>
                                    </h4>
                                </div>
                                <div id="collapse_3_3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endcomponent
        </div>
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {
/*
* Referencia https://datatables.net/reference/option/
*/
    var table, url, columns;
    table = $('#example-table-ajax');
    url = "{{ route('components.datatables.data') }}";
    columns = [
        {data: 'DT_Row_Index'},
        {data: 'id', "visible": false },
        {data: 'name', name: 'Nombre'},
        {data: 'email', name: 'Correo Electronico'},
        {
            defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
            data:'action',
            name:'action',
            title:'Acciones',
            orderable: false,
            searchable: false,
            exportable: false,
            printable: false,
            className: 'text-right',
            render: null,
            responsivePriority:2
        }
    ];
    dataTableServer.init(table, url, columns);

    table = table.DataTable();
    table.on('click', '.remove', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = table.row($tr).data();
        alert(dataTable.id);
    });
    table.on('click', '.edit', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = table.row($tr).data();
        alert(dataTable.id);
    });

});
</script>
@endpush