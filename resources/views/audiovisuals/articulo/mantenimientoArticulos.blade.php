@extends('material.layouts.dashboard')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- STYLES MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/pluginsbootstrap-editable/bootstrap-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css') }}" rel="stylesheet" type="text/css"/>
    <!-- STYLES SELECT -->
    <link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- STYLES MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- Styles DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Styles SWEETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Mantenimiento Artículos')

@section('page-title', 'Mantenimiento Artículo')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Historial Artículos'])
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" data-width="760" id="modal-mantenimiento-art" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-cog">
                                </i>
                                Registrar Observacion Solicitud Mantenimiento
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'from_mantenimiento_create', 'class' => '', 'url' => '/forms']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        {!! Field::text('TMT_Observacion_Realiza',
                                        ['label' => 'Observacion mantenimiento:', 'required','max' => '255'],
                                        ['help' => 'Ingrese una Observacion para el mantenimiento', 'icon' => 'fa fa-heartbeat'])
                                        !!}
                                    </p>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12" align="center">
                                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission("AUDI_REQUEST_MAINTENANCE_VIEW")
                        <a class="btn btn-outline dark requestMaintenance" data-toggle="modal">
                            <i class="fa fa-wrench">
                            </i>
                            Artículos en Mantenimiento
                        </a>
                        @endpermission
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'mtn-table-ajax'])
                        @slot('columns', [
                            '#' => ['style' => 'width:20px;'],
                            'Nombre',
                            'Codigo',
                            'Horas Mantenimiento Preventivo',
                            'Mantenimientos Realizados',
                            'Horas Total Uso',
                            'Acciones' => ['style' => 'width:100px;']
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>
@endsection
@push('plugins')
    <script src="{{-- {{ asset('ruta/del/archivo/js') }} --}}" type="text/javascript"></script>
    <!-- SCRIPT DATATABLE -->
    <script src="{{ asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.mockjax.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT SELECT -->
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT DATATABLE -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT MODAL -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT PWSTRENGTH -->
    <script src="{{ asset('assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Personalizadas -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript">
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
    <script>
        var table, url, columns;
        var idArticulo,tipoArticuloNombre;
        var ComponentsSelect2 = function () {
            return {
                init: function () {
                    $.fn.select2.defaults.set("theme", "bootstrap");
                    $(".pmd-select2").select2({
                        placeholder: "Selecccionar",
                        allowClear: true,
                        width: 'auto',
                        escapeMarkup: function (m) {
                            return m;
                        }
                    });
                }
            }
        }();
        var ComponentsBootstrapMaxlength = function () {
            var handleBootstrapMaxlength = function () {
                $("input[maxlength], textarea[maxlength]").maxlength({
                    alwaysShow: true,
                    appendToParent: true
                });
            }
            return {
                init: function () {
                    handleBootstrapMaxlength();
                }
            };
        }();
        $(document).ready(function () {
            App.unblockUI('.portlet-form');
            ComponentsBootstrapMaxlength.init();
            ComponentsSelect2.init();
            table = $('#mtn-table-ajax');
            url = "{{ route('listarMantenimientos.data') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'consulta_articulos.consulta_tipo_articulo.TPART_Nombre', name: 'Tipo'},
                {data: 'consulta_articulos.ART_Codigo', name: 'Codigo'},
                {data: 'consulta_articulos.consulta_tipo_articulo.TPART_HorasMantenimiento', name: 'HorasMantenimiento'},
                {data: 'consulta_articulos.ART_Cantidad_Mantenimiento', name: 'consulta_articulos.ART_Cantidad_Mantenimiento'},
                {data: 'horasUso', name: 'Kit'},
                {
                    defaultContent: '@permission("AUDI_MAINTENANCE_CREATE")<a title="Solicitar Mantenimiento" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="glyphicon glyphicon-send"></i></a>@endpermission' ,

                    data: 'action',
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    searchable: false,
                    exportable: false,
                    printable: false,
                    className: 'text-right',
                    render: null,
                    responsivePriority: 2
                }
            ];
            dataTableServer.init(table, url, columns);
            table = table.DataTable();
            table.on('click', '.create', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                console.log(dataTable);
                idArticulo = dataTable.consulta_articulos.id;
                tipoArticuloNombre = dataTable.consulta_articulos.consulta_tipo_articulo.TPART_Nombre;
                //console.log('nombre-'+tipoArticuloNombre );
                $('#modal-mantenimiento-art').modal('toggle');
            });
            var createMantenimiento = function () {
                return {
                    init: function () {
                        var route = '{{ route('registrar.mantenimiento') }}';
                        var type = 'POST';
                        var async = async || false;
                        var formData = new FormData();
                        //console.log('envio nombre'+tipoArticuloNombre);
                        formData.append('TMT_Tipo_Articulo',tipoArticuloNombre);
                        formData.append('TMT_FK_Id_Articulo',idArticulo);
                        formData.append('TMT_Observacion_Realiza', $('#TMT_Observacion_Realiza').val());
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                                    $('#modal-mantenimiento-art').modal('hide');
                                    $('#from_mantenimiento_create')[0].reset();
                                    table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            }
                        });
                    }
                }
            };
            var from_mantenimiento_create = $('#from_mantenimiento_create');
            var rules_mantenimiento_create = {
                TMT_Observacion_Realiza :{ required: true},
            };
            FormValidationMd.init(from_mantenimiento_create, rules_mantenimiento_create, false, createMantenimiento());
            $('.requestMaintenance').on('click',function(e){
                e.preventDefault();
                var route = '{{ route('audiovisuales.gestionMantenimientoAjax') }}';
                $(".content-ajax").load(route);
            })
        });
    </script>
@endpush
