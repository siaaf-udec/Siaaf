{{--
|--------------------------------------------------------------------------
| Extends
|--------------------------------------------------------------------------
|
| Hereda los estilos y srcipts de la de la plantilla original.
| Es la base para todas las páginas que se deseen crear.
|
--}}
@extends('material.layouts.dashboard')

{{--
|--------------------------------------------------------------------------
| Styles
|--------------------------------------------------------------------------
|
| Inyecta CSS requerido ya sea por un JS o para un elemento específico
|
| @push('styles')
|
| @endpush
--}}
@push('styles')
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
@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta
<title>
</title>
de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '| Gestion Kit')

{{--
|--------------------------------------------------------------------------
| Page Title
|--------------------------------------------------------------------------
|
| Inyecta el título a la sección del contenido de página.
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-title', $miVariable)
| @section('page-title', 'Título')
|
|
--}}
@section('page-title', 'Gestion kits')
{{--
|--------------------------------------------------------------------------
| Page Description
|--------------------------------------------------------------------------
|
| Inyecta una breve descripción a la sección del contenido de página.
| Recibe texto o variables de los controladores o se puede dejar sin datos
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-description', $miVariable)
| @section('page-description', 'Título')
--}}

@section('page-description', '')

{{--
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
|
| Inyecta el contenido HTML que se usará en la página
|
| @section('content')
|
| @endsection
--}}
@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    {{-- BEGIN HTML MODAL CREATE --}}
    <div class="row">
        <div class="col-md-12">
        {{-- BEGIN HTML MODAL CREATE --}}
        <!-- responsive -->
            <div class="modal fade" data-width="760" id="modal-info-kit" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h2 class="modal-title">
                        <i class="glyphicon glyphicon-user">
                        </i>
                        Detalles Kit
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'from_info_kit', 'class' => '', 'url' => '/forms']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {!! Field::text('KIT_Nombre',
                               ['label' => 'Nombre Kit', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                               ['help' => 'Nombre del Kit', 'icon' => 'fa fa-user'])
                            !!}
                            {!! Field::select('KIT_FK_Tiempo',
                                 [
                                    4 => 'Asignado',
                                    3 => 'Libre'
                                 ],
                                ['label' => 'Tipo Tiempo'])
                            !!}
                        </div>
                        <div class="col-md-6">
                            {!! Field::text('KIT_Codigo',
                                ['label' => 'Codigo', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                                ['help' => 'Codigo Del Kit', 'icon' => 'fa fa-user'])
                            !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('MODIFICAR', ['class' => 'btn blue']) !!}
                    {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
            {{-- END HTML MODAL CREATE--}}
        </div>
    </div>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Kits'])
            <br>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a class="btn btn-outline dark createKit" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Nuevo Kit
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'kit-table-ajax'])
                    @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'Nombre',
                        'Codigo',
                        'Acciones' => ['style' => 'width:160px;']
                    ])
                @endcomponent
            </div>
            <div class="clearfix"></div>
        @endcomponent
    </div>

    {{-- END HTML SAMPLE --}}
@endsection

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts necesarios para usar plugins
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}

@push('plugins')
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

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts para inicializar componentes Javascript como
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}
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
        var idEditarKit;
        var ComponentsSelect2 = function () {
            return {
                init: function () {
                    /*Configuracion de Select*/
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
                //main function to initiate the module
                init: function () {
                    handleBootstrapMaxlength();
                }
            };
        }();
        $(document).ready(function () {
            ComponentsBootstrapMaxlength.init();
            ComponentsSelect2.init();
            table = $('#kit-table-ajax');
            {{--url = "{{ route('listarArticulo.data') }}";--}}
            url ="{{ route('listarKit.data') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'KIT_Nombre' , name: 'Nombre'},
                {data: 'KIT_Codigo' , name: 'Codigo'},
                {
                    defaultContent:
                    '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>' +
                    '<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>'+
                    '<a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>',
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
            $( ".createKit" ).on('click', function (e) {
                e.preventDefault();
                var routeAjax = '{{route('audiovisuales.articulo.formRepeatKitAjax')}}';
                $(".content-ajax").load(routeAjax);
            });
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                console.log(dataTable);
                if(dataTable.KIT_FK_Estado_id!=5){
                    $('#KIT_Codigo').attr('disabled','disabled');
                }else{
                    $('#KIT_Codigo').removeAttr('disabled');
                }
                $('#KIT_Nombre').val(dataTable.KIT_Nombre);
                $('#KIT_Codigo').val(dataTable.KIT_Codigo);
                idEditarKit=dataTable.id;
                $('#modal-info-kit').modal('toggle');
            });
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                console.log(dataTable);
                if(dataTable.KIT_FK_Estado_id == 1){
                    swal(
                        {
                            title: "Este kit no ha realizado solicitudes.",
                            text: "Los articulos quedaran sin pertenecer a un kit , y podrán ser asignados a otro kit ?",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Continuar",
                            cancelButtonText: "Cancelar",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        },
                        function(isConfirm){
                            if (isConfirm) {
                                var rutaRemoverArticuloKit =
                                    '{{ route('EliminarKit') }}'+ '/'+ dataTable.id;
                                console.log('este es el codigo del kit a eliminar'+dataTable.id);
                                $.ajax({
                                    url: rutaRemoverArticuloKit,
                                    type: 'GET',
                                    beforeSend: function () {
                                        App.blockUI({target: '.portlet-form', animate: true});
                                    },
                                    success: function (response, xhr, request) {
                                        if (request.status === 200 && xhr === 'success') {
                                            App.unblockUI('.portlet-form');
                                            UIToastr.init(xhr , response.title , response.message  );
                                            table.ajax.reload();
                                        }
                                    }
                                });
                            }
                        }
                    );
                }else{
                    swal(
                        {
                            title: "Este kit  ha relaziado solicitudes, el codigo podrá ser reasignado en otro articulo o Kit.",
                            text: "Los articulos quedaran sin pertenecer a un kit , y podrán ser asignados a otro kit ?",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Continuar",
                            cancelButtonText: "Cancelar",
                            closeOnConfirm: false,
                            closeOnCancel: true
                        },
                        function(isConfirm){
                            if (isConfirm) {
                                var rutaRemoverArticuloKit =
                                    '{{ route('EliminarKitSoftdelete') }}'+ '/'+ dataTable.id;
                                $.ajax({
                                    url: rutaRemoverArticuloKit,
                                    type: 'GET',
                                    beforeSend: function () {
                                        App.blockUI({target: '.portlet-form', animate: true});
                                    },
                                    success: function (response, xhr, request) {
                                        if (request.status === 200 && xhr === 'success') {
                                            App.unblockUI('.portlet-form');
                                            UIToastr.init(xhr , response.title , response.message  );
                                            table.ajax.reload();
                                        }
                                    }
                                });
                            }
                        }
                    );
                }
            });
            table.on('click', '.create', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var routeAjax = '{{route('audiovisuales.articulo.articuloskitAjax')}}'+'/'+dataTable.id;
                $(".content-ajax").load(routeAjax);

            });
            var modificarKit = function () {
                return{
                    init: function () {
                        var route = '{{ route('kitModificar') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('id',parseInt(idEditarKit));
                        formData.append('KIT_Nombre', $('input:text[name="KIT_Nombre"]').val());
                        formData.append('KIT_FK_Tiempo', parseInt($('select[name="KIT_FK_Tiempo"]').val()));
                        formData.append('KIT_Codigo', parseInt($('input:text[name="KIT_Codigo"]').val()));
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
                                    $('#modal-info-kit').modal('hide');
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
            var form_create = $('#from_info_kit');
            var rules_kit_modificar ={

                KIT_Nombre: {
                    minlength: 3,
                    required: true,
                    remote: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: "{{ route('kit.validar') }}",
                        type: "post"
                    }
                }
            };
            var messagesKit = {
                KIT_Nombre: {
                    remote: 'El Kit ya Existe.'
                }
            };
            FormValidationMd.init(form_create,rules_kit_modificar,messagesKit,modificarKit());
        })
    </script>
@endpush
