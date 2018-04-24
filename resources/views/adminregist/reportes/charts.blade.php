@extends('material.layouts.dashboard')
@section('page-title', 'Gráficos:')
@push('styles')
    {{--Amcharts--}}
    <link href="{{ asset('assets/global/plugins/amcharts/amstockcharts/style.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/amcharts/amstockcharts/plugins/export/export.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable-line boxless tabbable-reversed">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab_0" data-toggle="tab"> Fechas </a>
                    </li>
                    <li>
                        <a href="#tab_1" data-toggle="tab"> Novedades </a>
                    </li>
                    <li>
                        <a href="#tab_2" data-toggle="tab"> Sedes o Extensión </a>
                    </li>
                    <li>
                        <a href="#tab_3" data-toggle="tab"> Tipo de Usuario </a>
                    </li>
                    <li>
                        <a href="#tab_4" data-toggle="tab"> Gráficos Generales </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_0">
                        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráfico por Fechas'])
                            <div id="chartFecha" style="height:400px;"></div>
                        @endcomponent
                    </div>

                    <div class="tab-pane" id="tab_1">
                        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráficos por Novedades'])
                            <div id="chartNovedad" class="chart" style="height:400px;"></div>
                            <div class="well margin-top-20">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="text-left">Radio superior:</label>
                                        <input class="chart_5_chart_input" data-property="topRadius"
                                               type="range"
                                               min="0" max="1.5"
                                               value="1" step="0.01"/></div>
                                    <div class="col-sm-3">
                                        <label class="text-left">Angulo:</label>
                                        <input class="chart_5_chart_input" data-property="angle" type="range"
                                               min="0"
                                               max="89"
                                               value="30" step="1"/></div>
                                    <div class="col-sm-3">
                                        <label class="text-left">Profundidad:</label>
                                        <input class="chart_5_chart_input" data-property="depth3D" type="range"
                                               min="1"
                                               max="120"
                                               value="40" step="1"/></div>
                                </div>
                            </div>
                        @endcomponent
                    </div>
                    <div class="tab-pane" id="tab_2">
                        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráficos por Sedes o Extensión'])
                            <div id="chartSede" class="chart" style="height:400px;"></div>
                            <div class="well margin-top-20">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="text-left">Radio superior:</label>
                                        <input class="chart_6_chart_input" data-property="topRadius"
                                               type="range"
                                               min="0" max="1.5"
                                               value="1" step="0.01"/></div>
                                    <div class="col-sm-3">
                                        <label class="text-left">Angulo:</label>
                                        <input class="chart_6_chart_input" data-property="angle" type="range"
                                               min="0"
                                               max="89"
                                               value="30" step="1"/></div>
                                    <div class="col-sm-3">
                                        <label class="text-left">Profundidad:</label>
                                        <input class="chart_6_chart_input" data-property="depth3D" type="range"
                                               min="1"
                                               max="120"
                                               value="40" step="1"/></div>
                                </div>
                            </div>
                        @endcomponent
                    </div>
                    <div class="tab-pane" id="tab_3">
                        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráficos por Tipo de Usuario'])
                            <div id="chartTypeUser" class="chart" style="height:400px;"></div>
                            <div class="well margin-top-20">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label class="text-left">Radio superior:</label>
                                        <input class="chart_7_chart_input" data-property="topRadius"
                                               type="range"
                                               min="0" max="1.5"
                                               value="1" step="0.01"/></div>
                                    <div class="col-sm-3">
                                        <label class="text-left">Angulo:</label>
                                        <input class="chart_7_chart_input" data-property="angle" type="range"
                                               min="0"
                                               max="89"
                                               value="30" step="1"/></div>
                                    <div class="col-sm-3">
                                        <label class="text-left">Profundidad:</label>
                                        <input class="chart_7_chart_input" data-property="depth3D" type="range"
                                               min="1"
                                               max="120"
                                               value="40" step="1"/></div>
                                </div>
                            </div>
                        @endcomponent
                    </div>
                    <div class="tab-pane" id="tab_4">
                    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráficos Generales'])
                        <!-- BEGIN ROW -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Sedes o Extensión</span>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="fullscreen"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="chart_general_sedes" class="chart" style="height: 400px;"></div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                                <div class="col-md-6">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Tipos de Usuario</span>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="fullscreen"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="chart_general_user" class="chart" style="height: 400px;"></div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                                <div>
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Novedades</span>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="fullscreen"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="chart_general_novedades" class="chart"
                                                 style="height: 400px;"></div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>
                            <!-- END ROW -->
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugins')
    {{--Amcharts--}}
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/amcharts.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/serial.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/amstock.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/lang/es.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/themes/patterns.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/themes/light.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/plugins/export/export.min.js') }}"
            type="text/javascript"></script>
@endpush

@push('functions')
    <script>
        $(document).ready(function () {
            var chartFecha = AmCharts.makeChart("chartFecha", {
                "type": "serial",
                "theme": "light",

                "fontFamily": 'Open Sans',
                "color": '#888888',

                "dataProvider": [
                        @foreach($date as $info => $valor)
                    {
                        "date": "{{$info}}",
                        "duration": {{$valor}},
                        "lineColor": "#b7e021"
                    },
                    @endforeach],
                "balloon": {
                    "cornerRadius": 6
                },
                "graphs": [{
                    "bullet": "square",
                    "bulletBorderAlpha": 1,
                    "bulletBorderThickness": 1,
                    "fillAlphas": 0.3,
                    "fillColorsField": "lineColor",
                    "legendValueText": "[[value]]",
                    "lineColorField": "lineColor",
                    "title": "duration",
                    "valueField": "duration"
                }],
                "chartScrollbar": {
                    "oppositeAxis": false,
                    "dragIcon": "dragIconRectSmallBlack"
                },
                "chartCursor": {
                    "categoryBalloonDateFormat": "YYYY MMM DD",
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "dataDateFormat": "YYYY-MM-DD",
                "categoryField": "date",
                "categoryAxis": {
                    "dateFormats": [{
                        "period": "DD",
                        "format": "DD"
                    }, {
                        "period": "WW",
                        "format": "MMM DD"
                    }, {
                        "period": "MM",
                        "format": "MMM"
                    }, {
                        "period": "YYYY",
                        "format": "YYYY"
                    }],
                    "parseDates": true,
                    "autoGridCount": false,
                    "axisColor": "#555555",
                    "gridAlpha": 0,
                    "gridCount": 50
                },
                "export": {
                    "enabled": true
                }
            });

            $('#chartFecha').closest('.portlet').find('.fullscreen').click(function () {
                chartFecha.invalidateSize();
            });

            var chartNovedad = AmCharts.makeChart("chartNovedad", {
                "theme": "light",
                "type": "serial",
                "startDuration": 2,
                "language": "es",
                "fontFamily": 'Open Sans',

                "color": '#888',
                "export": {
                    "enabled": true
                },
                "dataProvider": [
                        @foreach($novedades as $info)
                    {
                        "novedad": "{{$info->NOV_NombreNovedad}}",
                        "registro": {{$info->num_novedad}},
                        "color": "#b7e021"
                    },
                    @endforeach
                ],
                "valueAxes": [{
                    "position": "left",
                    "axisAlpha": 0,
                    "gridAlpha": 0
                }],
                "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "colorField": "color",
                    "fillAlphas": 0.85,
                    "lineAlpha": 0.1,
                    "type": "column",
                    "topRadius": 1,
                    "valueField": "registro"
                }],
                "depth3D": 40,
                "angle": 30,
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "novedad",
                "categoryAxis": {
                    "labelRotation": 90,
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "gridAlpha": 0

                },
                "exportConfig": {
                    "menuTop": "20px",
                    "menuRight": "20px",
                    "menuItems": [{
                        "icon": '/lib/3/images/export.png',
                        "format": 'png'
                    }]
                }
            });
            jQuery('.chart_5_chart_input').off().on('input change', function () {
                var property = jQuery(this).data('property');
                var target = chartNovedad;
                chartNovedad.startDuration = 0;

                if (property == 'topRadius') {
                    target = chartNovedad.graphs[0];
                }

                target[property] = this.value;
                chartNovedad.validateNow();
            });

            $('#chartNovedad').closest('.portlet').find('.fullscreen').click(function () {
                chartNovedad.invalidateSize();
            });
            var chartSede = AmCharts.makeChart("chartSede", {
                "theme": "light",
                "type": "serial",
                "startDuration": 2,
                "language": "es",
                "fontFamily": 'Open Sans',

                "color": '#888',
                "export": {
                    "enabled": true
                },
                "dataProvider": [
                        @foreach($place as $info => $valor)
                    {
                        "place": "{{$info}}",
                        "valor": {{$valor}},
                        "color": "#65b6dc"
                    },
                    @endforeach
                ],
                "valueAxes": [{
                    "position": "left",
                    "axisAlpha": 0,
                    "gridAlpha": 0
                }],
                "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "colorField": "color",
                    "fillAlphas": 0.85,
                    "lineAlpha": 0.1,
                    "type": "column",
                    "topRadius": 1,
                    "valueField": "valor"
                }],
                "depth3D": 40,
                "angle": 30,
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "place",
                "categoryAxis": {
                    "labelRotation": 90,
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "gridAlpha": 0

                },
                "exportConfig": {
                    "menuTop": "20px",
                    "menuRight": "20px",
                    "menuItems": [{
                        "icon": '/lib/3/images/export.png',
                        "format": 'png'
                    }]
                }
            });
            jQuery('.chart_6_chart_input').off().on('input change', function () {
                var property = jQuery(this).data('property');
                var target = chartSede;
                chartSede.startDuration = 0;

                if (property == 'topRadius') {
                    target = chartSede.graphs[0];
                }

                target[property] = this.value;
                chartSede.validateNow();
            });

            $('#chartSede').closest('.portlet').find('.fullscreen').click(function () {
                chartSede.invalidateSize();
            });

            var chartTypeUser = AmCharts.makeChart("chartTypeUser", {
                "theme": "light",
                "type": "serial",
                "startDuration": 2,
                "language": "es",
                "fontFamily": 'Open Sans',

                "color": '#888',
                "export": {
                    "enabled": true
                },
                "dataProvider": [
                        @foreach($typeUser as $info => $valor)
                    {
                        "type": "{{$info}}",
                        "valor": {{$valor}},
                        "color": "#D35400"
                    },
                    @endforeach
                ],
                "valueAxes": [{
                    "position": "left",
                    "axisAlpha": 0,
                    "gridAlpha": 0
                }],
                "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "colorField": "color",
                    "fillAlphas": 0.85,
                    "lineAlpha": 0.1,
                    "type": "column",
                    "topRadius": 1,
                    "valueField": "valor"
                }],
                "depth3D": 40,
                "angle": 30,
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "type",
                "categoryAxis": {
                    "labelRotation": 90,
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "gridAlpha": 0

                },
                "exportConfig": {
                    "menuTop": "20px",
                    "menuRight": "20px",
                    "menuItems": [{
                        "icon": '/lib/3/images/export.png',
                        "format": 'png'
                    }]
                }
            });
            jQuery('.chart_7_chart_input').off().on('input change', function () {
                var property = jQuery(this).data('property');
                var target = chartTypeUser;
                chartTypeUser.startDuration = 0;

                if (property == 'topRadius') {
                    target = chartTypeUser.graphs[0];
                }

                target[property] = this.value;
                chartTypeUser.validateNow();
            });

            $('#chartTypeUser').closest('.portlet').find('.fullscreen').click(function () {
                chartTypeUser.invalidateSize();
            });

            var chartGeneralUser = AmCharts.makeChart("chart_general_user", {
                "type": "pie",
                "theme": "light",

                "fontFamily": 'Open Sans',

                "color": '#888',

                "dataProvider": [
                        @foreach($typeUser as $info => $valor)
                    {
                        "type": "{{$info}}",
                        "valor": {{$valor}},
                    },
                    @endforeach
                ],
                "outlineAlpha": 0.4,
                "depth3D": 15,
                "valueField": "valor",
                "titleField": "type",
                "angle": 30,
                "export": {
                    "enabled": true
                }
            });

            $('#chart_general_user').closest('.portlet').find('.fullscreen').click(function () {
                chartGeneralUser.invalidateSize();
            });

            var chartGeneralNovedades = AmCharts.makeChart("chart_general_novedades", {
                "type": "pie",
                "theme": "light",

                "fontFamily": 'Open Sans',

                "color": '#888',

                "dataProvider": [
                        @foreach($novedades as $info)
                    {
                        "novedad": "{{$info->NOV_NombreNovedad}}",
                        "registro": {{$info->num_novedad}}
                    },
                    @endforeach
                ],
                "outlineAlpha": 0.4,
                "depth3D": 15,
                "valueField": "registro",
                "titleField": "novedad",
                "angle": 30,
                "export": {
                    "enabled": true
                }
            });

            $('#chart_general_novedades').closest('.portlet').find('.fullscreen').click(function () {
                chartGeneralNovedades.invalidateSize();
            });

            var chartGeneralSedes = AmCharts.makeChart("chart_general_sedes", {
                "type": "pie",
                "theme": "light",

                "fontFamily": 'Open Sans',

                "color": '#888',

                "dataProvider": [
                        @foreach($place as $info => $valor)
                    {
                        "place": "{{$info}}",
                        "valor": {{$valor}}
                    },
                    @endforeach
                ],
                "outlineAlpha": 0.4,
                "depth3D": 15,
                "valueField": "valor",
                "titleField": "place",
                "angle": 30,
                "export": {
                    "enabled": true
                }
            });

            $('#chart_general_sedes').closest('.portlet').find('.fullscreen').click(function () {
                chartGeneralSedes.invalidateSize();
            });
        });
    </script>
@endpush