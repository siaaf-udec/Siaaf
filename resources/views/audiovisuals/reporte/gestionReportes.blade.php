@extends('material.layouts.dashboard')

@push('styles')
    <!-- STYLES SELECT2 -->
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- STYLES MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- Styles SWEETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    <!-- toastr Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('title', '| Reportes PDF')

@section('page-title', 'Reportes para el módulo de Audiovisuales')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Reportes:'])
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                    <div class="m-heading-1 border-green m-bordered"><p><b>INFORMACIÓN USO DE ELEMENTOS:</b></p><br>
                        <a href="{{ route('audiovisuales.pdfTiempoUso') }}" target=”_blank” class="icon-btn"
                           data-toggle="tooltip" data-placement="bottom"
                           title="Reporte con información de tiempo de uso de cada articulo como tipo articulo, descripcion, tiempo de uso.">
                            <i class="fa fa-hourglass-end"></i>
                            <div> TIEMPO DE USO</div>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="icon-btn uso-carreras"
                           data-toggle="tooltip" data-placement="bottom"
                           title="Reporte con información de la demanda de los articulos por año y mes.">
                            <i class="fa fa-institution"></i>
                            <div> Cantidad / Articulo</div>
                        </a>&nbsp;&nbsp;
                    </div>
                    <br>
                    <div class="m-heading-1 border-green m-bordered"><p><b>INFORMACIÓN GENERAL DE PRESTAMOS POR PROGRAMA
                                ACADEMICO:</b></p><br>
                        <a class="icon-btn prestamo-carreras" data-toggle="tooltip"
                           data-placement="bottom"
                           title="Reporte con información de los prestamos realizados a los diferentes programas academicos por año.">
                            <i class="fa fa-institution"></i>
                            <div> Prestamos / Carreras</div>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    </div>
                    <br>
                    <div class="m-heading-1 border-green m-bordered"><p><b>INFORMACIÓN DE PRESTAMOS POR CADA
                                FUNCIONARIO:</b></p><br>
                        <a class="icon-btn funcionario"
                           data-toggle="tooltip" data-placement="bottom"
                           title="Reporte con información de prestamos por funcionario mensual.">
                            <i class="fa fa-child"></i>
                            <div> Funcionario</div>

                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>

        @endcomponent
    </div>
@endsection
@push('plugins')
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.quicksearch.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>
    <!-- SCRIPT MODAL -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPTS SELECT -->
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

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
        var ComponentsSelect2 = function () {

            var handleSelect = function () {

                $.fn.select2.defaults.set("theme", "bootstrap");
                var placeholder = "<i class='fa fa-search'></i>  " + "Seleccionar";
                $(".pmd-select2").select2({
                    placeholder: placeholder,
                    allowClear: true,
                    width: 'auto',
                    escapeMarkup: function (m) {
                        return m;
                    }
                });

            }

            return {
                init: function () {
                    handleSelect();
                }
            };

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
        jQuery(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            ComponentsBootstrapMaxlength.init();
            ComponentsSelect2.init();
            $(".uso-carreras").on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('audiovisuales.pdfCarreras') }}';
                $.get(route, function(){
                    location.href = route;
                });
            });
            $(".prestamo-carreras").on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('audiovisuales.pdfCarrerasPrestamos.solicitados') }}';
                $.get(route, function(){
                    location.href = route;
                });
                //$('#modal-reporte-prestamos-carreras').modal('toggle');
            });
            $(".funcionario").on('click', function (e) {
                e.preventDefault();
                $('#modal-reporte-funcionario').modal('toggle');
            });

        });
    </script>
@endpush