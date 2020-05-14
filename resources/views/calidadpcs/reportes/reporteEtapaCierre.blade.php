<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/styleTalentoHumano.css') }}" media="all" />
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
        <!-- <div id="logo">
        <img src="{{ asset('css/LogoUDEC.png') }}">
    </div> -->
        <h2>SIGDEP - Sistema de Informacion para la Gestion de Desarrollo de Proyectos</h2>
        <div class="date">Fecha del reporte: {{$date}} {{$time}}</div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <h2 class="name">Reporte de la Etapa de Cierre</h2>
            </div>
            <div id="invoice">
                <div><a class="noPrint" href="{{ route('calidadpcs.reportesCalidad.descargaReporteEtapaCierre') }}/{{$infoProyecto->PK_CP_Id_Proyecto}}">
                        <i class="fa fa-download">
                        </i>Descargar reporte
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h3>Informacion del proyecto</h3>
            <div class="col-md-6" style="padding: 10px; float: left; width: 45%; text-align: justify;">
                <div class="form-group form-md-line-input">
                    <label>Nombre del proyecto: {{$infoProyecto->CP_Nombre_Proyecto}}</label>
                </div>
            </div>
            <div class="col-md-6" style="padding: 10px; float: right; width: 45%; text-align: justify;">
                <div class="form-group form-md-line-input">
                    <label>Fecha: {{$infoProyecto->CP_Fecha_Inicio.' a '. $infoProyecto->CP_Fecha_Final}}</label>
                </div>
            </div>
        </div>
        <br><br><br>
        <div class="col-md-12">
            <h3>Tabla de aprobacion</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Nombre</b></th>
                        <th class="unit"><b>Rol</b></th>
                        <th class="unit"><b>Estado</b></th>
                    </tr>
                </thead>
                @foreach($integrantes as $integrante)
                <tbody>
                    <tr>
                        <td class="no">{{$cont++}}</td>
                        <td class="unit">{{$integrante->CE_Nombre_Persona}}</td>
                        <td class="desc">{{$integrante->Rol}}</td>
                        <td class="desc">{{$integrante->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
<!-- <footer>
    <div class="col-md-12" id="thanks" align="center">{{ env('APP_NAME') }} - {{ config('app.description') }}</div>
</footer> -->

</html>