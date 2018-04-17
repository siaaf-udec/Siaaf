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

@section('title', '| Gestion Artículo')

@section('page-title', 'Gestión Artículo')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestión Artículos'])
            <br>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a class="btn btn-outline dark createArticulo" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Nuevo Artículo
                        </a>
                        <a class="btn btn-outline dark createTipo" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Nuevo Tipo de Artículo
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                    @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'Tipo',
                        'Descripción',
                        'Codigo',
                        'Kit',
                        'Estado',
                        'Acciones' => ['style' => 'width:100px;']
                    ])
                @endcomponent
            </div>
            <div class="clearfix">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" data-width="760" id="modal-create-art" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-tv">
                                </i>
                                Registrar Artículo
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'from_art_create', 'class' => '', 'url' => '/forms']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::select('Seleccione un Tipo de Artículo',
                                        null,
                                        ['name' => 'FK_ART_Tipo_id'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::textarea('ART_Descripcion',
                                                        ['label' => 'Descripción', 'required', 'auto' => 'off', 'max' => '255', "rows" => '6'],
                                                        ['help' => 'Escribe una descripción de Artículo.', 'icon' => 'fa fa-quote-right'])
                                        !!}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::select('Seleccione un Kit al que pertecene',
                                       null,
                                       ['name' => 'FK_ART_Kit_id'])
                                       !!}
                                    </p>
                                    <p>
                                        {!! Field::text('FK_ART_Estado_id','Disponible',
                                        ['label' => 'Estado:','disabled'],
                                        ['help' => 'Ingrese Estado "Activo","Inactivo"', 'icon' => 'fa fa-ban'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::text('ART_Codigo',
                                        ['label' => 'Ingrese Codigo:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'3'],
                                        ['help' => 'Ingrese Codigo articulo', 'icon' => 'fa fa-tv'])
                                        !!}
                                    </p>
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
                <div class="col-md-12">
                    <div class="modal fade" data-width="760" id="modal-edit-art" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-user">
                                </i>
                                Editar Artículo
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'from_art_update', 'class' => '', 'url' => '/forms']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::select('Seleccione un Kit al que pertecene',
                                            null,
                                            ['name' => 'ART_Tipo_edit'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::textarea('ART_Descripcion_edit',
                                                        ['label' => 'Descripción', 'required', 'auto' => 'off', 'max' => '255', "rows" => '6'],
                                                        ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right']) !!}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::select('Seleccione un Kit al que pertecene',
                                            null,
                                            ['name' => 'FK_ART_Kit_id_edit'])
                                       !!}
                                    </p>
                                    <p>
                                        {!! Field::text('FK_ART_Estado_id_edit','Disponible',
                                           ['label' => 'Estado:','disabled'],
                                           ['help' => 'Ingrese Estado "Activo","Inactivo"', 'icon' => 'fa fa-ban'])
                                           !!}
                                    </p>
                                    <p>
                                        {!! Field::text('ART_Codigo_edit',
                                        ['label' => 'Ingrese Codigo:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'3'],
                                        ['help' => 'Ingrese Codigo articulo', 'icon' => 'fa fa-tv'])
                                        !!}
                                    </p>
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
        var idEditarArticulo;
        var $seleccione_un_kit = $('select[name="FK_ART_Kit_id"]'),
            $seleccione_un_tipoArticulo = $('select[name="FK_ART_Tipo_id"]');
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
            table = $('#art-table-ajax');
            url = "{{ route('listarArticulo.data') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'consulta_tipo_articulo.TPART_Nombre', name: 'Tipo'},
                {data: 'ART_Descripcion', name: 'Descripción'},
                {data: 'ART_Codigo', name: 'Codigo'},
                {data: 'consulta_kit_articulo.KIT_Nombre', name: 'Kit'},
                {data: 'consulta_estado_articulo.EST_Descripcion', name: 'Estado'},
                {
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>' +
                                    '<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
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
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        table.ajax.reload();
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
                            App.unblockUI('.portlet-form');
                            $(response.data).each(function (key, value) {
                                $('select[name="FK_ART_Kit_id_edit"]').append(new Option(value.KIT_Nombre, value.id));
                            });
                            $('select[name="FK_ART_Kit_id_edit"]').val(parseInt(dataTable.FK_ART_Kit_id));
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
                            App.unblockUI('.portlet-form');
                            $(response.data).each(function (key, value) {
                                $('select[name="ART_Tipo_edit"]').append(new Option(value.TPART_Nombre, value.id));
                            });
                            $('select[name="ART_Tipo_edit"]').val(parseInt(dataTable.FK_ART_Tipo_id));
                        }
                    }
                });
            });
            $(".createArticulo").on('click', function (e) {
                e.preventDefault();
                $seleccione_un_kit.empty().append('whatever');
                var route_cargar_kits = '{{route('cargar.kits.select') }}';
                $.ajax({
                    url: route_cargar_kits,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            $(response.data).each(function (key, value) {
                                $seleccione_un_kit.append(new Option(value.KIT_Nombre, value.id));
                            });
                            $seleccione_un_kit.val([]);
                        }
                    }
                });
                $seleccione_un_tipoArticulo.empty().append('whatever');
                var route_cargar_kitss = '{{route('cargar.tipoArticulos.selectArtciulo') }}';
                $.ajax({
                    url: route_cargar_kitss,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            if( _.size(response.data)==0){
                                swal("No hay Tipos de Artículos!", "Debe Crear un Tipo!", "warning");

                            }else{
                                $('#modal-create-art').modal('toggle');
                            }
                            $(response.data).each(function (key, value) {
                                $seleccione_un_tipoArticulo.append(new Option(value.TPART_Nombre, value.id));
                            });
                            $seleccione_un_tipoArticulo.val([]);
                        }
                    }
                });
            });
            var createArticulo = function () {
                return {
                    init: function () {
                        var route = '{{ route('articulo.store') }}';
                        var type = 'POST';
                        var async = async || false;
                        var formData = new FormData();
                        formData.append('FK_ART_Tipo_id', $('select[name="FK_ART_Tipo_id"]').val());
                        formData.append('ART_Descripcion', $('#ART_Descripcion').val());
                        formData.append('FK_ART_Kit_id', $('select[name="FK_ART_Kit_id"]').val());
                        formData.append('ART_Codigo', $('input:text[name="ART_Codigo"]').val());
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
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    $('#modal-create-art').modal('hide');
                                    $('#from_art_create')[0].reset();
                                    table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    }
                }
            };
            var from_art_create = $('#from_art_create');
            var rules_arti_create = {
                FK_ART_Kit_id :{ required: true},
                FK_ART_Tipo_id :{ required: true},
                ART_Descripcion:{minlength: 3, required: true},
                FK_ART_Estado_id:{ required: true},
                ART_Codigo:{minlength: 3, required: true},
            };
            FormValidationMd.init(from_art_create, rules_arti_create, false, createArticulo());
            var modificarArticulo = function () {
                return{
                    init: function () {
                        var route = '{{ route('articuloModificar') }}';
                        var type = 'POST';
                        var async = async || false;
                        var formData = new FormData();
                        formData.append('id',idEditarArticulo);
                        formData.append('FK_ART_Tipo_id', $('select[name="ART_Tipo_edit"]').val());
                        formData.append('ART_Descripcion', $('#ART_Descripcion_edit').val());
                        formData.append('FK_ART_Kit_id', $('select[name="FK_ART_Kit_id_edit"]').val());
                        formData.append('ART_Codigo', parseInt($('input:text[name="ART_Codigo_edit"]').val()));

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

                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    $('#modal-edit-art').modal('hide');
                                    $("#from_art_update")[0].reset();
                                    UIToastr.init(xhr , response.title , response.message  );
                                    table.ajax.reload();
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 &&  xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    }
                }
            };
            var from_art_edit = $('#from_art_update');
            var rules_arti_edit = {
                FK_ART_Kit_id_edit :{ required: true},
                ART_Tipo_edit :{ required: true},
                ART_Descripcion_edit:{minlength: 3, required: true},
                FK_ART_Estado_id_edit:{ required: true},
                ART_Codigo_edit:{minlength: 3, required: true},
            };
            FormValidationMd.init(from_art_edit,rules_arti_edit,false,modificarArticulo());
            $('.createTipo').on('click',function(e){
                e.preventDefault();
                var route = '{{ route('audiovisuales.gestionTipoArticuloAjax') }}';
                $(".content-ajax").load(route);
            })
        });
    </script>
@endpush
