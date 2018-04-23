
@extends('material.layouts.dashboard')
@push('styles')
    <!--DATATIME -->
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Styles DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
  <!-- STYLES TOAST-->
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('title', '| Gestion Reservas')
@section('page-title', 'Gestion Reservas')
@section('page-description', 'Solicita y Cancela una reserva')
@section('content')
    <div class="clearfix"></div>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Reservas Realizadas'])
            <div class="clearfix">
            </div>
            <br><br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'usuarios-table'])
                    @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'id',
                        'PRT_Num_Orden',
                        'Funcionario',
                        'Administrador Entrega',
                        'Administrador Recibe',
                        'Observacion Entrega',
                        'Observacion Recibe',
                        'Fecha Entrega',
                        'Fecha Recibe'
                    ])
                @endcomponent
            </div>
            <div class="clearfix"></div>
        @endcomponent
    </div>
    </br>
@endsection
@push('plugins')
    <!-- TIEMPOS DATETIME -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT DATETIME -->
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT DATATABLE -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT MODAL -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT SELECT -->
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Personalizadas -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT MENSAJES TOAST-->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript">
    </script>
@endpush
@push('functions')
    <!-- Estandar Validacion -->
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">
    </script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            App.unblockUI('.portlet-form');
            var idFuncionario;
            var table, url, columns;
            table = $('#usuarios-table');
            url = "{{ route('listarFuncionariosSolicitudesFinalizadas.dataTable') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'id', "visible": false },
                {data: 'PRT_Num_Orden', "visible": true },
                {data: function(data){
                    return data.consulta_usuario_audiovisuales.user.name +" "
                        +data.consulta_usuario_audiovisuales.user.lastname;
                },name:'Funcionario'},
                {data: function(data){
                    return data.conultar_administrador_entrega.name +" "
                        +data.conultar_administrador_entrega.lastname;
                },name:'Administrador Entrega'},
                {data: function(data){
                    return data.conultar_administrador_recibe.name +" "
                        +data.conultar_administrador_recibe.lastname;
                },name:'Administrador Recibe'},
                {data: 'PRT_Observacion_Entrega', name: 'Observacion Entrega'},
                {data: 'PRT_Observacion_Recibe', name: 'Observacion Recibe'},
                {data: 'PRT_Fecha_Inicio', name: 'Fecha Entrega'},
                {data: 'PRT_Fecha_Fin', name: 'Fecha Recibe'}
            ];
            dataTableServer.init(table, url, columns);
            table = table.DataTable();
        });
    </script>
@endpush
