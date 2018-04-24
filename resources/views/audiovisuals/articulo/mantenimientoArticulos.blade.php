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
            <br>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission("AUDI_REQUEST_MAINTENANCE_VIEW")
                        <a class="btn btn-outline dark requestMaintenance" data-toggle="modal">
                            <i class="fa fa-wrench">
                            </i>
                            Mantenimiento Artículos
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
            ComponentsBootstrapMaxlength.init();
            ComponentsSelect2.init();
            table = $('#mtn-table-ajax');
            url = "{{ route('listarMantenimientos.data') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'consulta_articulos.consulta_tipo_articulo.TPART_Nombre', name: 'Tipo'},
                {data: 'consulta_articulos.ART_Codigo', name: 'Codigo'},
                {data: 'consulta_articulos.consulta_tipo_articulo.TPART_HorasMantenimiento', name: 'HorasMantenimiento'},
                {data: 'horasUso', name: 'Kit'},
                {
                    defaultContent: '@permission("AUDI_MAINTENANCE_CREATE")<a title="Solicitar Mantenimiento" href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>@endpermission' ,

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
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var formData = new FormData();
                var mensaje ;
                var tipo;
                formData.append('id', dataTable.id);
                if(dataTable.FK_ART_Estado_id == 1){
                    mensaje = 'Este artículo no ha realizado ninguna solicitud,'+
                        ' ¿Desea elminar este artículo?';
                    tipo = 'warning';
                    formData.append('softdelete', false);
                }else{
                    mensaje = 'Este artículo sera eliminado y el codigo podrá ser '+
                        'reutlizado.';
                    tipo = 'info';
                    formData.append('softdelete', true);
                }
                swal({
                        title: "Esta seguro?",
                        text: mensaje,
                        type: tipo,
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Continuar",
                        cancelButtonText: "Cancelar",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var route_elimarArticulo = '{{route('elimarArticulo') }}';
                            var async = async || false;
                            $.ajax({
                                url: route_elimarArticulo,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                cache: false,
                                processData: false,
                                async: async,
                                type: 'POST',
                                contentType: false,
                                data: formData,
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        table.ajax.reload();
                                        App.unblockUI('.portlet-form');
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                    }
                                }
                            });
                        }
                    }
                );
            });
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                idEditarArticulo = parseInt(dataTable.id);
                if(dataTable.consulta_estado_articulo.EST_Descripcion != 'Creado'){
                    $('select[name="ART_Tipo_edit"]').prop('disabled', 'disabled');
                }else{
                    $('select[name="ART_Tipo_edit"]').removeAttr("disabled");
                }
                $('select[name="FK_ART_Kit_id_edit"]').empty();
                $('select[name="ART_Tipo_edit"]').empty();
                $('#ART_Descripcion_edit').val(dataTable.ART_Descripcion);
                $('#FK_ART_Estado_id_edit').val(dataTable.consulta_estado_articulo.EST_Descripcion);
                $('#ART_Codigo_edit').val(dataTable.ART_Codigo);
                $('#modal-edit-art').modal('toggle');
                var route_cargar_kits = '{{route('cargar.kits.select') }}';
                $.ajax({
                    url: route_cargar_kits,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            $(response.data).each(function (key, value) {
                                $('select[name="FK_ART_Kit_id_edit"]').append(new Option(value.KIT_Nombre, value.id));
                            });
                            $('select[name="FK_ART_Kit_id_edit"]').val(parseInt(dataTable.FK_ART_Kit_id));
                            App.unblockUI('.portlet-form');
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'error') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
                var route_cargar_tipo = '{{route('cargar.tipoArticulos.selectArtciulo') }}';
                $.ajax({
                    url: route_cargar_tipo,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {

                            $(response.data).each(function (key, value) {
                                $('select[name="ART_Tipo_edit"]').append(new Option(value.TPART_Nombre, value.id));
                            });
                            $('select[name="ART_Tipo_edit"]').val(parseInt(dataTable.FK_ART_Tipo_id));
                            App.unblockUI('.portlet-form');
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'error') {
                            UIToastr.init(xhr, response.title, response.message);
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
            });

            $('.requestMaintenance').on('click',function(e){
                e.preventDefault();
                var route = '{{ route('audiovisuales.gestionMantenimientoAjax') }}';
                $(".content-ajax").load(route);
            })

        });
    </script>
@endpush
