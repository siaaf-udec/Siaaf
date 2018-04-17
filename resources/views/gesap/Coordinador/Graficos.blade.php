@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/layouts/layout2/css/themes/blue.min.css')}}" rel="stylesheet" type="text/css"
          id="style_color"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
@endpush

@section('title', '| Dashboard')

@section('page-title', 'REPORTES POR GRAFICOS')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a target="_blank" href="{{route('report.all.project')}}">
                    <div class="dashboard-stat2 ">
                        <div class="display">
                            <div class="number">
                                <div class="icon">
                                    <i class="icon-book-open"></i>
                                </div>
                                <h3 class="font-green-sharp">
                                    <span data-counter="counterup" data-value="{{$anteproyectos}}">0</span>
                                    <small class="font-green-sharp"></small>
                                </h3>
                                <small>ANTEPROYECTOS REGISTRADOS</small>
                            </div>
                        </div>
                        <div class="progress-info">
                            <div class="progress">
                            <span style="width: 100%;" class="progress-bar progress-bar-success green-sharp">
                                <span class="sr-only">100% Registros</span>
                            </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <div class="icon">
                                <i class="icon-dislike"></i>
                            </div>
                            <h3 class="font-red-haze">
                                <span data-counter="counterup" data-value="{{$anteproyectosR}}">0</span>
                            </h3>
                            <small>PROYECTOS RECHAZADOS</small>
                        </div>

                    </div>
                    <div class="progress-info">
                        <div class="progress">
                        <span style="width: {{$anteproyectosRP}}%;" class="progress-bar progress-bar-success red-haze">
                            <span class="sr-only">{{$anteproyectosRP}}% change</span>
                        </span>
                        </div>
                        <div class="status">
                            <div class="status-title"> RECHAZADO</div>
                            <div class="status-number"> {{$anteproyectosRP}}%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <div class="icon">
                                <i class="icon-like"></i>
                            </div>
                            <h3 class="font-blue-sharp">
                                <span data-counter="counterup" data-value="{{$proyectos}}"></span>
                            </h3>
                            <small>PROYECTOS APROBADOS</small>
                        </div>

                    </div>
                    <div class="progress-info">
                        <div class="progress">
                        <span style="width: {{$proyectosP}}%;" class="progress-bar progress-bar-success blue-sharp">
                            <span class="sr-only">{{$proyectosP}}%</span>
                        </span>
                        </div>
                        <div class="status">
                            <div class="status-title"> Aprobado</div>
                            <div class="status-number"> {{$proyectosP}}%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <div class="icon">
                                <i class="icon-check"></i>
                            </div>
                            <h3 class="font-purple-soft">
                                <span data-counter="counterup" data-value="{{$proyectosT}}"></span>
                            </h3>
                            <small>PROYECTOS TERMINADOS</small>
                        </div>

                    </div>
                    <div class="progress-info">
                        <div class="progress">
                        <span style="width: {{$proyectosTP}}%;" class="progress-bar progress-bar-success purple-soft">
                            <span class="sr-only">{{$proyectosTP}}% change</span>
                        </span>
                        </div>
                        <div class="status">
                            <div class="status-title"> Terminados</div>
                            <div class="status-number"> {{$proyectosTP}}%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-12 col-sm-12">
                @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-bar-chart', 'title' => 'Estado de Anteproyectos'])
                    <div id="anteproyecto-state" class="CSSAnimationChart"></div>
                @endcomponent
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-bar-chart', 'title' => 'Estado de Proyectos'])
                    <div id="proyecto-state" class="CSSAnimationChart"></div>
                @endcomponent
            </div>

            <div class="col-lg-12 col-xs-12 col-sm-12">
                @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-bar-chart', 'title' => 'proyectos por jurados'])
                    <div id="jurado-state" class="CSSAnimationChart"></div>
                @endcomponent
            </div>

            <div class="col-lg-12 col-xs-12 col-sm-12">
                @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-bar-chart', 'title' => 'proyectos por directores'])
                    <div id="director-state" class="CSSAnimationChart"></div>
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@push('plugins')


    <script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
    <script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
    <script src="{{asset('assets/global/plugins/ie8.fix.min.js')}}"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"
            type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/main/gesap/js/jquery.counterup.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/horizontal-timeline/horizontal-timeline.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="{{asset('assets/layouts/layout2/scripts/layout.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/layouts/layout2/scripts/demo.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function () {
            $('#clickmewow').click(function () {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
@endpush

@push('functions')
    <script>

        $(function () {
            function requestData(route, chart) {
                $.ajax({
                    type: "GET",
                    url: route,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            var graficas = response.data;
                            chart.setData(JSON.parse(graficas));
                            App.unblockUI('.portlet-form');
                        }
                    }
                });
            }

            var anteproyecto = Morris.Bar({
                element: 'anteproyecto-state',
                data: [0, 0],
                xkey: 'Estado',
                ykeys: ['value'],
                labels: ['# '],
                barColors: function (row, series, type) {
                    if (row.x % 2 == 0)
                        return '#32c5d2';
                    else
                        return '#0e3d38';
                }
            });
            requestData("{{route('data.chart.preliminary')}}", anteproyecto);

            var proyecto = Morris.Bar({
                element: 'proyecto-state',
                data: [0, 0],
                xkey: 'Estado',
                ykeys: ['value'],
                labels: ['#'],
                barColors: function (row, series, type) {
                    if (row.x % 2 == 0)
                        return '#32c5d2';
                    else
                        return '#0e3d38';
                }
            });
            requestData("{{route('data.chart.project')}}", proyecto);

            var jurados = Morris.Bar({
                element: 'jurado-state',
                data: [0, 0],
                xkey: 'Estado',//nombre
                ykeys: ['value'],
                labels: ['#'],
                barColors: function (row, series, type) {
                    if (row.x % 2 == 0)
                        return '#9CC4E4';
                    else
                        return '#F26C4F';
                }
            });
            requestData("{{route('data.chart.jury')}}", jurados);

            var directores = Morris.Bar({
                element: 'director-state',
                data: [0, 0],
                xkey: 'Estado',//Nombre
                ykeys: ['value'],
                labels: ['#'],
                barColors: function (row, series, type) {
                    if (row.x % 2 == 0)
                        return '#9CC4E4';
                    else
                        return '#F26C4F';
                }
            });
            requestData("{{route('data.chart.director')}}", directores);
        });
    </script>
@endpush