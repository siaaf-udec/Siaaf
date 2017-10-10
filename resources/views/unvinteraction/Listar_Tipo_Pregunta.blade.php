@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
        <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Lista de Tipos De Preguntas')


@section('page-title', 'Lista de Tipos De Preguntas')

@section('page-description', 'Tipos De Convenios Registrados')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR TIPOS DE PREGUNTAS'])
@permission(['Add_Convenio'])
 <div class="col-md-12">
                    <div class="actions">
                        <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar un convenio"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
 @endpermission

    <div class="row">
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Convenios'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Codigo',
                    'Tipo',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    @endcomponent
 <!-- Modal agregar Tipo -->
<div class="col-md-12">
                    <!-- Modal -->
                    <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header modal-header-success">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR EMPRESA</h1>
                                </div>
                                <div class="modal-body">
                                {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Tipo-Pregunta']) !!}
                                <div class="form-wizard">
                                {!! Field:: text('Tipo',['label'=>'Tipo','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Agregar el tipo','icon'=>'fa fa-line-chart'] ) !!}
                    
                              <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    
                                  
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Agregar', ['class' => 'btn blue']) !!}
                                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                                  </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
@endsection



@push('plugins')
     <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/form-wizard.js') }}" type="text/javascript"></script>
    
     <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
     <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
     <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {
    var table, url;
    table = $('#Listar_Convenios');
    url = "{{ route('Listar_Tipo_Pregunta.Listar_Tipo_Pregunta') }}";
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
           {data: 'PK_Tipo_Pregunta', "visible": true, name:"documento" },
           {data: 'Tipo', searchable: true},
           {data:'action',className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" title="Editar Convenio" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>'

            
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
    $("#archivo3").on('click', function (e) {
            e.preventDefault();
            $('#agregar').modal('toggle');
        });
    
    
     table = table.DataTable();
     table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/Editar_Tipo_Pregunta/'+dataTable.PK_Tipo_Pregunta;

            $(".content-ajax").load(route_edit);
        });
   $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            };
            
    var form=$('#form-Agregar-Tipo-Pregunta');
    var wizard =  $('#form_wizard_1');
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('Agregar_Tipo_Pregunta.Agregar_Tipo_Pregunta') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('Tipo', $('#Tipo').val());
                    
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        
                     
                        success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                         $('#agregar').modal('hide');
                        table.ajax.reload();
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
    
    var messages = {};
        
    FormValidationMd.init( form, rules, messages , crearConvenio());
     
    
  
});
</script>
@endpush