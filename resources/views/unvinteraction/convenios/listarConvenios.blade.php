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
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('title', '| Lista de Convenios')
    @section('page-title', 'Lista de Convenios') @section('page-description', 'Convenios registrados')      
        @section('content')
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR CONVENIOS']) 
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
                            @slot('columns', 
                            [ '#' => ['style' => 'width:20px;'], 
                            'ID', 
                            'Nombre',
                            'Fecha de inicio',
                            'Fecha finalizacion',
                            'Estado',
                            'Sede',
                            'Acciones' => ['style' => 'width:160px;'] ])
                        @endcomponent
                    </div>
                </div>
@endcomponent
<!-- Modal agregar convenio -->
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

                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Convenio']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('CVNO_Nombre',['label'=>'nombre del convenio', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Nombre de convenio','icon'=>'fa fa-line-chart'] ) !!} 
                        
                        {!! Field::date('CVNO_Fecha_Inicio',['label'=>'Fecha Inicio','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                        
                        {!! Field::date('CVNO_Fecha_Fin',['label'=>'Fecha Final','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                        
                       
                        {!! Field::select('FK_TBL_Sede_Id',$sede,[ 'label' => 'Selecciona una sede'])!!}
                       
                        <div class="form-actions">
                            <div class="row">
                                <div class="modal-footer">
                                    {!! Form::submit('Agregar', ['class' => 'btn blue']) !!} {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}


                    </div>
                </div>
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
<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/form-dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
@endpush

@push('functions')

<script>
    var ComponentsDateTimePickers = function () {
            var handleDatePickers = function () {
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        regional: 'es',
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'yyyy-mm-dd',
                        firstDay: 1,
                        yearSuffix: '',
                        startDate: null,
                       
                    });
                }
            }
            return {
                init: function () {
                    handleDatePickers();
                }
            };
        }();
    var ComponentsSelect2 = function() {
        var handleSelect = function() {
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                width: null,
                placeholder: "Selecccionar",
            });
        }
        return {
            init: function() {
                handleSelect();
            }
        };

    }();
    jQuery(document).ready(function() {
        
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        
        var table, url, columns;
        table = $('#Listar_Convenios');
        url = "{{ route('listarConvenios.listarConvenios') }}";
        columns = [
            {data: 'DT_Row_Index'},
                {data: 'PK_CVNO_Convenio',"visible": true,name: "documento"},
                {data: 'CVNO_Nombre',searchable: true},
                {data: 'CVNO_Fecha_Inicio',searchable: true},
                {data: 'CVNO_Fecha_Fin',searchable: true},
                {data: 'convenio_estado.ETAD_Estado',searchable: true},
                {data: 'convenio_sede.SEDE_Sede',searchable: true},
                {
                    data: 'action',
                    className: '',
                    searchable: false,
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    exportable: false,
                    printable: false,
                    defaultContent: '@permission(['INTE_EDIT_CONVENIO'])<a href="#" id="editar" title="Editar Convenio" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>@endpermission @permission(['INTE_VER_DATO_CON'])<a href="#" id="ver" title="Documentos e informacion del Convenio" class="btn btn-simple btn-success btn-icon editar2"><i class="icon-notebook"></i></a> @endpermission'


                }
        ];
        dataTableServer.init(table, url, columns);
        
        var form = $('#form-Agregar-Convenio');
        var wizard = $('#form_wizard_1');
        var rules = {
            CVNO_Nombre: {required: true},
            CVNO_Fecha_Inicio: {required: true},
            CVNO_Fecha_Fin: {required: true},
            FK_TBL_Sede_Id: {required: true}
            
        };
        var crearConvenio = function() {
            return {
                init: function() {
                    var route = '{{ route('registroConvenios.registroConvenios') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('CVNO_Nombre', $('#CVNO_Nombre').val());
                    formData.append('CVNO_Fecha_Inicio', $('#CVNO_Fecha_Inicio').val());
                    formData.append('CVNO_Fecha_Fin', $('#CVNO_Fecha_Fin').val());
                    formData.append('FK_TBL_Sede_Id', $('select[name="FK_TBL_Sede_Id"]').val());
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
                            if (request.status === 200 && xhr === 'success') {
                                $('#agregar').modal('hide');
                                $('#form-Agregar-Convenio')[0].reset();
                                table.ajax.reload();
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var messages = {};
        FormValidationMd.init(form, rules, false, crearConvenio());


        $("#archivo3").on('click', function(e) {
            e.preventDefault();
            $('#agregar').modal('toggle');
        });

        table = table.DataTable();
        table.on('click', '.edit', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('editarConvenios.editarConvenios') }}'+'/'+dataTable.PK_CVNO_Convenio;

            $(".content-ajax").load(route_edit);
        });
        table.on('click', '.editar2', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                 route_edit = '{{ route('documentosConvenios.documentosConvenios') }}'+'/'+dataTable.PK_CVNO_Convenio;

            $(".content-ajax").load(route_edit);
        });

    });

</script>
@endpush
