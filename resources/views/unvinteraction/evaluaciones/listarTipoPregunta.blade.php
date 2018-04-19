@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Lista de Tipos De Preguntas')


@section('page-title', 'Lista de Tipos De Preguntas')

@section('page-description', 'Tipos De Convenios Registrados')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR TIPOS DE PREGUNTAS'])
@permission(['INTE_ADD_CONVENIO'])
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
    <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR TIPO PREGUNTA</h1>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Tipo-Pregunta']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('TPPG_Tipo',['label'=>'Tipo','class'=> 'form-control', 'autofocus','required' => 'required', 'maxlength'=>'20','autocomplete'=>'off'],['help' => 'Agregar el tipo','icon'=>'fa fa-line-chart'] ) !!}
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
<!-- Datatables Plugins -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<!-- Validation Plugins -->
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- Utoastr Plugins -->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script>
jQuery(document).ready(function () {
     App.unblockUI('.portlet-form');
     var table, url, columns;
        table = $('#Listar_Convenios');
        url = "{{ route('listarTipoPregunta.listarTipoPregunta') }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_TPPG_Tipo_Pregunta', "visible": true, name:"PK_TPPG_Tipo_Pregunta" },
           {data: 'TPPG_Tipo', searchable: true,name:"TPPG_Tipo"},
           {data:'action',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" title="Editar Convenio" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>'

            
        }
        ];
        dataTableServer.init(table, url, columns);
   
    $("#archivo3").on('click', function (e) {
            e.preventDefault();
            $('#agregar').modal('toggle');
        });
    
    
     table = table.DataTable();
     table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{route('editarTipoPregunta.editarTipoPregunta')}}/'+dataTable.PK_TPPG_Tipo_Pregunta;
         $(".content-ajax").load(route_edit);
        });
   $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            TPPG_Tipo: {required: true},
    };
    var form    =  $('#form-Agregar-Tipo-Pregunta');
    var wizard  =  $('#form_wizard_1');
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('agregarTipoPregunta.agregarTipoPregunta') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('TPPG_Tipo', $('#TPPG_Tipo').val());
                    
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
								App.blockUI({target: '.portlet-form', animate: true});
							},
                        success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                         $('#agregar').modal('hide');
                        $('#form-Agregar-Tipo-Pregunta')[0].reset();
                        table.ajax.reload();
                        UIToastr.init(xhr , response.title , response.message  );
                        App.unblockUI('.portlet-form');
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
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