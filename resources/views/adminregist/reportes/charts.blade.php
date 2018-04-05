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

    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráfico por Fechas'])
        <div class="row">
            <div class="col-md-12">
                <div id="chartFecha" style="height:400px;"></div>
            </div>
        </div>

    @endcomponent


    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráficos por Novedades'])
        <div class="row">
            <div class="col-md-12">
                <div id="chartNovedad" class="chart" style="height:400px;"></div>
                <div class="well margin-top-20">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="text-left">Radio superior:</label>
                            <input class="chart_5_chart_input" data-property="topRadius" type="range" min="0" max="1.5"
                                   value="1" step="0.01"/></div>
                        <div class="col-sm-3">
                            <label class="text-left">Angulo:</label>
                            <input class="chart_5_chart_input" data-property="angle" type="range" min="0" max="89"
                                   value="30" step="1"/></div>
                        <div class="col-sm-3">
                            <label class="text-left">Profundidad:</label>
                            <input class="chart_5_chart_input" data-property="depth3D" type="range" min="1" max="120"
                                   value="40" step="1"/></div>
                    </div>
                </div>
            </div>
        </div>

    @endcomponent

    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráficos por Sedes'])
        <div class="row">
            <div class="col-md-12">
                <div id="chartSede" class="chart" style="height:400px;"></div>
                <div class="well margin-top-20">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="text-left">Radio superior:</label>
                            <input class="chart_6_chart_input" data-property="topRadius" type="range" min="0" max="1.5"
                                   value="1" step="0.01"/></div>
                        <div class="col-sm-3">
                            <label class="text-left">Angulo:</label>
                            <input class="chart_6_chart_input" data-property="angle" type="range" min="0" max="89"
                                   value="30" step="1"/></div>
                        <div class="col-sm-3">
                            <label class="text-left">Profundidad:</label>
                            <input class="chart_6_chart_input" data-property="depth3D" type="range" min="1" max="120"
                                   value="40" step="1"/></div>
                    </div>
                </div>
            </div>
        </div>

    @endcomponent

    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Gráficos por Tipo de Usuario'])
        <div class="row">
            <div class="col-md-12">
                <div id="chartTypeUser" class="chart" style="height:400px;"></div>
                <div class="well margin-top-20">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="text-left">Radio superior:</label>
                            <input class="chart_7_chart_input" data-property="topRadius" type="range" min="0" max="1.5"
                                   value="1" step="0.01"/></div>
                        <div class="col-sm-3">
                            <label class="text-left">Angulo:</label>
                            <input class="chart_7_chart_input" data-property="angle" type="range" min="0" max="89"
                                   value="30" step="1"/></div>
                        <div class="col-sm-3">
                            <label class="text-left">Profundidad:</label>
                            <input class="chart_7_chart_input" data-property="depth3D" type="range" min="1" max="120"
                                   value="40" step="1"/></div>
                    </div>
                </div>
            </div>
        </div>

    @endcomponent


@endsection

@push('plugins')
    {{--Amcharts--}}
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/amcharts.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/amcharts/amstockcharts/serial.js') }}"
            type="text/javascript"></script>
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


            /*
            var chartData = generateChartData();

            function generateChartData() {
                var chartData = [];
                var firstDate = new Date(2012, 0, 1);
                firstDate.setDate(firstDate.getDate() - 500);

                for (var i = 0; i < 500; i++) {
                    var newDate = new Date(firstDate);
                    newDate.setDate(newDate.getDate() + i);

                    var value = Math.round(Math.random() * (40 + i)) + 100 + i;

                    chartData.push({
                        date: newDate,
                        value: value
                    });
                }
                return chartData;
            }

            console.log(chartData);

            var chartFecha = AmCharts.makeChart("chartFecha", {

                type: "stock",
                "theme": "patterns",
                "language": "es",

                dataSets: [{
                    color: "#b0de09",
                    fieldMappings: [{
                        fromField: "value",
                        toField: "value"
                    }],
                    dataProvider: chartData,
                    categoryField: "date"
                }],

                panels: [{
                    showCategoryAxis: true,
                    title: "Value",
                    eraseAll: false,

                    stockGraphs: [{
                        id: "g1",
                        valueField: "value",
                        useDataSetColors: false
                    }],


                    stockLegend: {
                        valueTextRegular: " ",
                        markerType: "none"
                    },

                }],

                chartScrollbarSettings: {
                    graph: "g1"
                },
                chartCursorSettings: {
                    valueBalloonsEnabled: true
                },
                periodSelector: {
                    position: "bottom",
                    periods: [{
                        period: "DD",
                        count: 10,
                        label: "10 dias"
                    }, {
                        period: "MM",
                        count: 1,
                        label: "1 mes"
                    }, {
                        period: "YYYY",
                        count: 1,
                        label: "1 año"
                    }, {
                        period: "YTD",
                        label: "YTD"
                    }, {
                        period: "MAX",
                        label: "MAX"
                    }]
                },
                export: {
                    enabled: true
                }
            });*/

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
                        "novedad": "{{$info->nombre_novedad}}",
                        "registro": {{$info->num_novedad}},
                        "color": "#FF{{$info->id}}F{{$info->id}}"
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
        });
    </script>
@endpush