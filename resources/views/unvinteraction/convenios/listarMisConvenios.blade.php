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

@section('title', '| Lista de mis Convenios')


@section('page-title', 'Lista de mis Convenios')

@section('page-description', 'Convenios registrados')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR MIS CONVENIOS'])

 <br><br>
    <div class="row">
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Convenios'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'ID',
                    'Nombre',
                    'Fecha de inicio',
                    'Fescha finalizacion',
                    'Estado',
                    'Sede',       
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    @endcomponent
@endsection



@push('plugins')
<!-- Datatables Plugins -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
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

@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
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
                allowClear: true,
            });
        }
        return {
            init: function() {
                handleSelect();
            }
        };

    }();
jQuery(document).ready(function () {
    App.unblockUI('.portlet-form');
    var table, url, columns;
            table = $('#Listar_Convenios');
            url = "{{ route('listarMisConvenios.listarMisConvenios') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'convenios_participante.PK_CVNO_Convenio', "visible": true, name:"convenios_participante.PK_CVNO_Convenio" },
                {data: 'convenios_participante.CVNO_Nombre', searchable: true, name:"convenios_participante.CVNO_Nombre"},
                {data: 'convenios_participante.CVNO_Fecha_Inicio', searchable: true, name:"convenios_participante.CVNO_Fecha_Inicio"},
                {data: 'convenios_participante.CVNO_Fecha_Fin',searchable: true, name:"convenios_participante.CVNO_Fecha_Fin"},
                {data: 'convenios_participante.convenio_estados.ETAD_Estado', searchable: true, name:"convenios_participante.convenio_estados.ETAD_Estado"},
                {data: 'convenios_participante.convenio_sedes.SEDE_Sede',searchable: true, name:"convenios_participante.convenio_sedes.SEDE_Sede"},
                {data: 'action',
                 name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2,
                defaultContent: '<a href="#" title="Documentos e informacion del Convenio" class="btn btn-simple btn-success btn-icon editar2"><i class="icon-notebook"></i></a>'
                }
        ];
        dataTableServer.init(table, url, columns);
   
    table = table.DataTable();
    table.on('click', '.editar2', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('documentosConvenios.documentosConvenios') }}'+'/'+dataTable.convenios_participante.PK_CVNO_Convenio+'/'+dataTable.convenios_participante.convenio_estado.PK_ETAD_Estado;
            $(".content-ajax").load(route_edit);
        });
   
    
});
</script>
@endpush