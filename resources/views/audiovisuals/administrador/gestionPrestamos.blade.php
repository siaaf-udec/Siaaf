@extends('material.layouts.dashboard')
@push('styles')
    <!--DATATIME -->
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Styles DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- STYLES SELECT -->
    <link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css"/>
    <!-- STYLES MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
    <!-- STYLES TOAST-->
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- STYLES ICHECK-->
    <link href="{{asset('assets/global/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css"/>

@endpush
@section('title', '| Solicitudes Prestamo-Reservas')
@section('page-title', 'Solicitudes Prestamos-Reservas')
@section('page-description', 'Consulta y Finaliza prestamos-reservas')
@section('content')
    <div class="clearfix"></div>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Solicitudes prestamos realizadas'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>
            <div class="row">

                <div class="col-md-12">
                    @permission('AUDI_REQUESTS_VIEW_RESERVATION')
                    <div class="actions">
                        <a class="btn btn-outline dark reservaAjax" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Reservas
                        </a>
                    </div>
                    @endpermission
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'usuarios-table'])
                    @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'id',
                        'PRT_Num_Orden',
                        'Nombres',
                        'Correo Electronico',
                        'Tipo Identificacion',
                        'Numero',
                        'Acciones' => ['style' => 'width:90px;']
                    ])
                @endcomponent
            </div>
            <div class="clearfix"></div>
        @endcomponent
    </div>
    </br>
@endsection
@push('plugins')
    <script src="{{ asset('assets/global/plugins/icheck/icheck.js') }}" type="text/javascript"></script>
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
   <script src="{{ asset('assets/global/plugins/icheck/icheck.js') }}" type="text/javascript"></script>
@endpush
@push('functions')

    <script src="{{ asset('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>

    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
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
        var ComponentsSelect2 = function() {
            var handleSelect = function() {
                $.fn.select2.defaults.set("theme", "bootstrap");
                var placeholder = "<i class='fa fa-search'></i>  " + "Seleccionar";
                $(".pmd-select2").select2({
                    width: null,
                    placeholder: placeholder,
                    escapeMarkup: function(m) {
                        return m;
                    }
                });
            }
            return {
                init: function() {
                    handleSelect();
                }
            };
        }();
        var handleiCheck = function() {

        };

        jQuery(document).ready(function () {
            App.unblockUI('.portlet-form');
            handleiCheck();
            ComponentsSelect2.init();
            var idFuncionario;
            var table, url, columns;
            table = $('#usuarios-table');
            url = "{{ route('listarFuncionarios.dataTable') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'id', "visible": false },
                {data: 'PRT_Num_Orden', "visible": false },
                {data: function(data){
                    return data.consulta_usuario_audiovisuales.user.name +" "
                        +data.consulta_usuario_audiovisuales.user.lastname;
                },name:'PRT_Fecha_Inicio'},
                {data: 'consulta_usuario_audiovisuales.user.email', name: 'consulta_usuario_audiovisuales.user.email'},
                {data: 'consulta_usuario_audiovisuales.user.identity_type', name: 'consulta_usuario_audiovisuales.user.identity_type'},
                {data: 'consulta_usuario_audiovisuales.user.identity_no', name: 'consulta_usuario_audiovisuales.user.identity_no'},
                {
                    defaultContent: '@permission("AUDI_REQUESTS_VIEW_LENDING")<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit">Finalizar Prestamo</i></a>@endpermission',
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
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ route('audiovisuales.EntregasPrestamo.index') }}'+'/'+dataTable.PRT_Num_Orden;
                $(".content-ajax").load(route);
            });
            $( ".reservaAjax" ).on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('reserva.index') }}';
                $(".content-ajax").load(route);
            });
        });
    </script>
@endpush
