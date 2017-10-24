<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/styleTalentoHumano.css') }}" media="all"/>
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
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
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicons') }}/android-icon-192x192.png">
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
        <img src="{{ asset('css/logoUDEC.png') }}">
    </div>
    <div id="company">
        <h2 class="name">{{ env('APP_NAME') }}</h2>
        <div> Calle 14 con Avenida 15 <i class="fa fa-map-signs"></i></div>
        <div>Universidad de Cundinamarca - Ext. Facatativá <i class="fa fa-map-marker" aria-hidden="true"></i></div>
        <div> (+57 1) 892 0706 | 892 0707 <i class="fa fa-phone"></i></div>
        <div><a href="mailto:unicundi@ucundinamarca.edu.co ">unicundi@ucundinamarca.edu.co</a> <i class="fa fa-at"></i>
        </div>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">

            <div class="to">REPORTE GENERADO POR:</div>
            <h2 class="name">{{ (isset( auth()->user()->full_name )) ? auth()->user()->full_name : 'Administrador Audiovisuales' }}</h2>
            <div class="address">{{ (isset( auth()->user()->address )) ? auth()->user()->address : 'Calle 14 con Avenida 15' }}</div>
            <div class="email"><a
                        href="mailto:{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'unicundi@ucundinamarca.edu.co' }}">{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'unicundi@ucundinamarca.edu.co' }}</a>
            </div>
        </div>
        <div id="invoice">
            <h1>DATOS DE CONTACTO:</h1>


            <div class="date">Total: {{$total}} Empleados</div>
            <div class="date">Fecha del reporte: {{$date}}</div>
            <div class="date">Hora del reporte: {{$time}}</div>
            <div><a class="noPrint enviar" href="#">
                    <i class="fa fa-download">
                    </i>Descargar reporte
                </a>
            </div>
        </div>
    </div>


    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


    <div id="thanks" align="center">{{ env('APP_NAME') }} - {{ config('app.description') }}</div>

</main>

</body>

</html>

<!-- SCRIPTS JQUERY -->
<script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<!-- END SCRIPTS JQUERY -->

<!-- SCRIPTS HIGHCHARTS -->
<script src="{{ asset('assets/global/plugins/highcharts/js/highcharts.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/highcharts/js/highcharts-3d.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/highcharts/js/highcharts-more.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/charts-highcharts.min.js') }} " type="text/javascript"></script>
<!-- END SCRIPTS HIGHCHARTS -->

<script>
    $(document).ready(function () {
        var carreras = JSON.parse('<?php echo json_encode($carreras) ?>');//Array
        var tipoArticulo = JSON.parse('<?php echo json_encode($tipoArticulo) ?>');//Array
        console.log(carreras);
        var chart = {
            type: 'column'
        };
        var title = {
            text: 'Reporte Uso Elementos {{$mes}} - {{$anio}} '
        };
        var subtitle = {
            text: 'Modulo Audiovisuales'
        };
        var xAxis = {
            categories: carreras,
            crosshair: true
        };
        var yAxis = {
            min: 0,
            title: {
                text: 'Cantidad Prestamos'
            }
        };
        var tooltip = {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        };
        var plotOptions = {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        };
        var credits = {
            enabled: false
        };

        var series= [{
            name: tipoArticulo[0],
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0]
        }, {
            name: tipoArticulo[1],
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5]
        }, {
            name: tipoArticulo[2],
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3]
        }, {
            name: tipoArticulo[3],
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3]
        }, {
            name: tipoArticulo[4],
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5]
        }];


        var json = {};
        json.chart = chart;
        json.title = title;
        json.subtitle = subtitle;
        json.tooltip = tooltip;
        json.xAxis = xAxis;
        json.yAxis = yAxis;
        json.series = series;
        json.plotOptions = plotOptions;
        json.credits = credits;
        $('#container').highcharts(json);
        $(".enviar").on('click', function (e) {

            var anio = JSON.stringify( {{$anio}} );
            var mes = JSON.stringify( {{$mes}} );//Variable
            console.log(anio);
            var route = '{{ route('audiovisuales.DownloadPdfCarreras') }}'+ '/'+ anio+'/'+mes;
            location.href =route;

        });

    })
</script>
