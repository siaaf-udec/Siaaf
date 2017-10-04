<<<<<<< Updated upstream
@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- toastr Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
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
                        <a href="{{ route('talento.humano.empleado.index') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte con información de la documentación radicada por cada empleado.">
                            <i class="fa fa-check-square"></i>
                            <div> Documentación </div>

                        </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    </div><br>

                    <div class="m-heading-1 border-green m-bordered"><p><b>INFORMACIÓN GENERAL DE LOS PERMISOS QUE TIENEN LOS EMPLEADOS:</b></p><br>
                        <a href="{{ route('talento.humano.permisos.listaEmpleados') }}" class="icon-btn" data-toggle="tooltip" data-placement="bottom" title="Reporte con información de los permisos de cada empleado como fecha, descripción y número de permisos.">
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
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')

    <script type="text/javascript">
        jQuery(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endpush
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media="all" />
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- BEGIN FAVICONS --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/favicons') }}/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/favicons') }}/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicons') }}/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/favicons') }}/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicons') }}/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/favicons') }}/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicons') }}/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('assets/favicons') }}/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicons') }}/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    {{-- ENDS FAVICONS --}}
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{ asset('css/logo.png') }}">
    </div>
    <div id="company">
        <h2 class="name">{{ env('APP_NAME') }}</h2>
        <div> Calle 14 con Avenida 15 <i class="fa fa-map-signs"></i></div>
        <div>Universidad de Cundinamarca - Ext. Facatativá <i class="fa fa-map-marker" aria-hidden="true"></i></div>
        <div> (+57 1) 892 0706 | 892 0707 <i class="fa fa-phone"></i> </div>
        <div><a href="mailto:unicundi@ucundinamarca.edu.co ">unicundi@ucundinamarca.edu.co</a> <i class="fa fa-at"></i> </div>
    </div>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">FUNCIONARIO DE RECURSOS HUMANOS:</div>
            <h2 class="name">{{ (isset( auth()->user()->full_name )) ? auth()->user()->full_name : 'Funcionario Recursos Humanos' }}</h2>
            <div class="address">{{ (isset( auth()->user()->address )) ? auth()->user()->address : 'Calle 14 con Avenida 15' }}</div>
            <div class="email"><a href="mailto:{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'john@example.com' }}">{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'unicundi@ucundinamarca.edu.co' }}</a></div>
        </div>

    </div>


    <h3>Asunto: </h3>
    <h3>Mensaje: </h3>

    <br><br>
    <div id="thanks" align="center">{{ env('APP_NAME') }} - {{ config('app.description') }}</div>

</main>

</body>

</html>
>>>>>>> Stashed changes
