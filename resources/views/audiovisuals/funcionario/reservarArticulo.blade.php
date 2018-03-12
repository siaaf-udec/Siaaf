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

    <!-- STYLES MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Styles DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <!-- STYLES SELECT -->
    <link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css"/>
    {{--DATEPICKER--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Styles TOASTR  -->
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Styles SWEETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
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
@section('title', '| Reservar Articulos')

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
@section('page-title', 'Reservar Articulo')
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
    <div class="col-md-12">
    {{-- BEGIN HTML MODAL CREATE --}}
    <!-- static -->
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="static" tabindex="-1">
            <div class="modal-header modal-header-success">
                <h3 class="modal-title">
                    <i class="glyphicon glyphicon-user">
                    </i>
                    Seleccionar Programa
                </h3>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'from_programa', 'class' => '', 'url' => '/forms']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            {!! Field::select('Seleccione Programa',$programas,
                                ['name' => 'FK_FUNCIONARIO_Programa'])
                            !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        {{-- END HTML MODAL CREATE--}}
    </div>
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Administradores'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        <a class="btn btn-outline dark create" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Nueva Reserva
                        </a>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="clearfix">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'res-table-ajax'])
                        @slot('columns', [
                            '# Reservas' => ['style' => 'width:20px;'],
                            'Fecha Inicio',
                            'Fecha Fin',
                            'Acciones' => ['style' => 'width:90px;']
                        ])
                    @endcomponent
                </div>
            </div>
            @endcomponent
            </br>
            </br>
            </br>
            </br>
    </div>
    {{-- END HTML SAMPLE --}}
@endsection
@push('plugins')
    <!-- SCRIPT DATEPICKER -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT SELECT -->
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
    </script>
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
    <!-- SCRIPT PWSTRENGTH -->
    <script src="{{ asset('assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
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
    <script>

        jQuery(document).ready(function() {
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
            var ComponentsBootstrapMaxlength = function () {
                var handleBootstrapMaxlength = function() {
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
            var abrirModal = JSON.stringify({{$numero}});
            //sino se encuentran registros abrir el modal para registrar
            if( abrirModal == 0 ){
                $('#static').modal('toggle');
            }
            ComponentsSelect2.init();
            ComponentsBootstrapMaxlength.init();
            var $seleccione_un_tipoArticulo = $('select[name="PRT_FK_Articulos_id"]');
            //DATATABLE
            var table, url, columns;
            table = $('#res-table-ajax');
            url = "{{ route('funcionarioReservas.dataArticulo') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'PRT_Fecha_Inicio', name: 'FechaInicio'},
                {data: 'PRT_Fecha_Fin', name: 'FechaFin'},
                {
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a>',
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
            /* abre modal con el formulario para registrar la reserva*/
            $( ".create" ).on('click', function (e) {
                e.preventDefault();
                var routeAjax = '{{route('opcionReservaArticuloAjax')}}';
                $(".content-ajax").load(routeAjax);
            });
            //inicio de registrar funcionario audivisuales con programa
            var createPrograma = function () {
                return{
                    init: function () {
                        var route = '{{ route('crearFuncionarioPrograma.storePrograma') }}';
                        var type = 'POST';
                        var async = async || false;
                        var formData = new FormData();
                        formData.append('FK_FUNCIONARIO_Programa', $('select[name="FK_FUNCIONARIO_Programa"]').val());
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

                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    $('#static').modal('hide');
                                    $('#from_programa')[0].reset();
                                    UIToastr.init(xhr , response.title , response.message  );
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
            var form_create = $('#from_programa');
            var rules_create = {
                FK_FUNCIONARIO_Programa:{required: true}
            };
            FormValidationMd.init(form_create,rules_create,false,createPrograma());

        });
    </script>
@endpush
