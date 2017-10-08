@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('title', '| Información del parqueadero')

@section('page-title', 'Listado de historiales del parqueadero:')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Historiales del parqueadero:'])
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">                        
                        <a href="javascript:;" class="btn btn-simple btn-success btn-icon reports"  title="Reporte" ><i class="glyphicon glyphicon-list-alt"></i>Reporte Historico</a>                        
                        
                        <br>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaHistoriales'])
                        @slot('columns', [
                            '#',
                            'Nombre Usuario',
                            'Código Usuario',
                            'Placa',                            
                            'Fecha/Hora Entrada',
                            'Fecha/Hora Salida'
                        ])
                    @endcomponent
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

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.quicksearch.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

jQuery(document).ready(function () {

        var table, url,columns;
        table = $('#listaHistoriales');
        url = "{{ route('parqueadero.dependenciasCarpark.tablaHistoriales')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'CH_NombresUser', name: 'Nombre Usuario'},   
            {data: 'CH_CodigoUser', name: 'Código Usuario'},   
            {data: 'CH_Placa', name: 'Placa'},   
            {data: 'CH_FHentrada', name: 'Fecha/Hora Entrada'},
            {data: 'CH_FHsalida', name: 'Fecha/Hora Salida'}
        ];
        dataTableServer.init(table, url, columns);            

         $( ".reports" ).on('click', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            $.ajax({
            }).done(function(){
                window.open('{{ route('parqueadero.reportesCarpark.ReporteHistorico') }}', '_blank');
            });
        });                
        
        
    });
</script>
@endpush