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
@endpush

@section('title', '| Reportes PDF')

@section('page-title', 'Reportes para el módulo de talento humano :')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Reportes:'])
            <div class="row">
                <div class="col-md-9 col-md-offset-1">
                    <div class="m-heading-1 border-green m-bordered"><p><b>INFORMACIÓN GENERAL DE LOS EMPLEADOS REGISTRADOS:</b></p><br>

                        <a href="{{ route('talento.humano.empleado.pdfContacto') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte con información de contacto de los empleados como nombres, apellidos, cédula, teléfono y correo electrónico.">
                            <i class="fa fa-group"></i>
                            <div> Contacto</div>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                        <a href="{{ route('talento.humano.empleado.pdfDireccion') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte con información de contacto de los empleados como cédula, nombres, apellidos, dirección y ciudad.">
                            <i class="fa fa-map-marker"></i>
                            <div> Dirección </div>
                        </a>&nbsp;&nbsp;
                        <a href="{{ route('talento.humano.empleado.pdfSalario1') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte que contiene información como cédula, nombres, apellidos, salario, área y rol, dicho reporte se encuentra organizado por programa.">
                            <i class="fa fa-dollar"></i>
                            <div> Salario / Área  </div>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('talento.humano.empleado.pdfSalario2') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte que contiene información como cédula, nombres, apellidos, salario, área y rol, dicho reporte se encuentra organizado por rol.">
                            <i class="fa fa-dollar"></i>
                            <div> Salario / rol </div>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('talento.humano.empleado.pdfAfiliaciones') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte que contiene información como cédula, nombres, apellidos, EPS, Fondo de pensiones y caja de compensación.">
                            <i class="fa fa-hospital-o"></i>
                            <div> Afiliaciones </div>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('talento.humano.empleado.pdfEstado') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte que contiene información como cédula, nombres, apellidos y el estado que indica si el empleado es nuevo, antiguo o reitrado.">
                            <i class="fa fa-check-square-o"></i>
                            <div> Estado </div>
                        </a>
                    </div><br>

                    <div class="m-heading-1 border-green m-bordered"><p><b>INFORMACIÓN DE LA DOCUMENTACIÓN FALTANTE POR CADA EMPLEADO:</b></p><br>
                        <a href="{{ route('talento.humano.document.pdfConsolidado') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte con información de todos los empleados del estado de su documentación (Sin documentación, documentación incompleta, documentación completa y afiliado).">
                            <i class="fa fa-file-o"></i>
                            <div> Consolidado </div>

                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="javascript:;" class="icon-btn documentReport" data-toggle="tooltip" data-placement="bottom" title="Reporte con información de la documentación radicada por cada empleado.">
                            <i class="fa fa-check-square"></i>
                            <div> Documentación </div>

                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    </div><br>

                    <div class="m-heading-1 border-green m-bordered"><p><b>INFORMACIÓN GENERAL DE LOS PERMISOS QUE TIENEN LOS EMPLEADOS:</b></p><br>
                        <a href="javascript:;" class="icon-btn permisoReport" data-toggle="tooltip" data-placement="bottom" title="Reporte con información de los permisos de cada empleado como fecha, descripción y número de permisos.">
                            <i class="fa fa-group"></i>
                            <div> Permisos/persona </div>

                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    </div><br>
                </div>
            </div>
        @endcomponent
    </div>
@endsection

@push('plugins')
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
        jQuery(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $( ".documentReport" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.empleado.index.ajax') }}';
            $(".content-ajax").load(route);
        });
        $( ".permisoReport" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.permisos.listaEmpleados.ajax') }}';
            $(".content-ajax").load(route);
        });
    </script>
@endpush