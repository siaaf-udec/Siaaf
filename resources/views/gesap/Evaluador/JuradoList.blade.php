@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" /><link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Dashboard')

@section('page-title', 'JURADO')

@section('page-description', 'Lista de proyectos como jurado')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Anteproyecto Jurado'])
        <div class="row">
        <div class="col-md-6">
            <div class="btn-group">
                <a href="{{ route('min.create') }}">
                    <button id="sample_editable_1_new" class="btn green" style="margin-bottom:-8px;"> 
                        <i class="fa fa-plus"></i>
                    </button>
                </a> 
            </div>
        </div>
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyecto'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id',
                    'Titulo',
                    'Palabras Clave',
                    'Duracion',
                    'Fecha Radicacion',
                    'Fecha Limite',
                    'Estado',
                    'Min',
                    'Requerimientos',
                    'Director',
                    'Estudiante 1',
                    'Estudiante 2',
                    'Jurado 1',
                    'Jurado 2',
                    'Concepto',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="modal-create-concept" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            {!! Form::open(['id' => 'from_concept_create', 'class' => '', 'url' => '/forms']) !!}
                            <div class="modal-header modal-header-success">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h1><i class="glyphicon glyphicon-thumbs-up"></i> Concepto Final</h1>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! Field::hidden('PK_anteproyecto') !!}
                                        {!! Field::hidden('user', Auth::user()->id) !!}
                                        {!! Field::select('concepto',["1"=>"Aprobado","2"=>"Aplazado","3"=>"Reprobado"],null) !!}
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
@endsection



@push('plugins')
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>


    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

    <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>


<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

@endpush

@push('functions')
<script>
jQuery(document).ready(function () {
    var table, url;
    table = $('#lista-anteproyecto');
    url = "{{ route('anteproyecto.juryList') }}";

    table.DataTable({
       lengthMenu: [
           [5, 10, 25, 50, -1],
           [5, 10, 25, 50, "Todo"]
       ],
       responsive: true,
       colReorder: true,
       processing: true,
       serverSide: true,
       ajax: url,
       searching: true,
       language: {
           "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
           "sLengthMenu": "Mostrar _MENU_ registros",
           "sZeroRecords": "No se encontraron resultados",
           "sEmptyTable": "Ningún dato disponible en esta tabla",
           "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
           "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
           "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
           "sInfoPostFix": "",
           "sSearch": "Buscar:",
           "sUrl": "",
           "sInfoThousands": ",",
           "sLoadingRecords": "Cargando...",
           "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Último",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
           },
           "oAria": {
               "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
           }
       },
       columns:[
           {data: 'DT_Row_Index'},
           {data: 'PK_NPRY_idMinr008', "visible": false },
           {data: 'NPRY_Titulo', searchable: true},
           {data: 'NPRY_Keywords', className:'none',searchable: true},
           {data: 'NPRY_Duracion',className:'none',searchable: true},
           {data: 'NPRY_FechaR', className:'none',searchable: true},
           {data: 'NPRY_FechaL', className:'none',searchable: true},
           {data: 'NPRY_Estado',searchable: true},
           {data: 'RDCN_Min',searchable: true},
           {data: 'RDCN_Requerimientos',searchable: true},
           {data: 'Director',className:'none',searchable: true},
           {data: 'estudiante1',className:'none',searchable: true},
           {data: 'estudiante2', className:'none',searchable: true},
           {data: 'Jurado1', className:'none',searchable: true},
           {data: 'Jurado2',className:'none',searchable: true},
           {data: 'Concepto',"visible": false },
           {data:"PK_NPRY_idMinr008",
            name:'action',
               title:'Acciones',
               orderable: false,
               searchable: false,
               exportable: false,
               printable: false,
               className: '',   
               render: function ( data, type, full, meta ) {
                 return '<a href="/gesap/evaluar/observaciones/'+data+'" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-commenting"> Observaciones</i></a><a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-check"></i>Concepto Final</a>';
                }
               
           }
       ],
       buttons: [
           { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
           { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
           { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
           { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
           { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
           { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
           {text: '<i class="fa fa-refresh"></i>', className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
               }
           }

       ],
       pageLength: 10,
       dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });
   table = table.DataTable();
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input[name="PK_anteproyecto"]').val(dataTable.PK_NPRY_idMinr008);
            $('select[name="concepto"]').val(dataTable.Concepto);
            $('#modal-create-concept').modal('toggle');
        });
    
         var updatePermissions = function () {
            return{
                init: function () {
                    var id_edit = $('input[name="id_edit"]').val();
                    var route = '{{ route('anteproyecto.guardar.conceptos') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('concepto', $('select[name="concepto"]').val());
                    formData.append('user', $('input[name="user"]').val());
                    formData.append('proyecto', $('input[name="PK_anteproyecto"]').val());

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
                                table.ajax.reload();
                                $('#modal-create-concept').modal('hide');
                                $('#from_concept_create')[0].reset(); //Limpia formulario
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
    
    
     var form_edit = $('#from_concept_create');
        var rules_edit = {
            concepto: {required: true}
        };
        FormValidationMd.init(form_edit,rules_edit,false,updatePermissions());

    
    
    
});
    
 

    
    
    
</script>
@endpush