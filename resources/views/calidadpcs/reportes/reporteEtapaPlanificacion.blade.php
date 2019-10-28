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
                <h2 class="name">Reporte de la Etapa de Planificacion</h2>
            </div>
            <div id="invoice">
                <div><a class="noPrint" href="{{ route('calidadpcs.reportesCalidad.descargaReporteEtapaUno') }}/{{$infoProyecto->PK_CP_Id_Proyecto}}">
                        <i class="fa fa-download">
                        </i>Descargar reporte
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h3>Alcance</h3>
            <p>{{$alcance->CPPD_Alcance}}</p>
        </div>
        <div class="col-md-12">
            <h3>Tabla Requerimientos</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">#</th>
                        <th class="unit"><b>Requerimiento</b></th>
                    </tr>
                </thead>
                @foreach($requerimientos as $requerimiento)
                <tbody>
                    <tr>
                        <td class="no" style="width: 30px;">{{$cont++}}</td>
                        <td class="unit">{{$requerimiento->CPR_Nombre_Requerimiento}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla Cronograma</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Nombre sprint</b></th>
                        <th class="unit"><b>Requerimientos</b></th>
                        <th class="unit"><b>Encargados</b></th>
                        <th class="unit"><b>Duracion</b></th>
                        <th class="unit"><b>Entregable</b></th>
                    </tr>
                </thead>
                @foreach($cronograma as $crono)
                <tbody>
                    <tr>
                        <td class="no" style="width: 30px;">{{$cont_2++}}</td>
                        <td class="unit">{{$crono->CPC_Nombre_Sprint}}</td>
                        <td class="unit">{{$crono->Requerimientos}}</td>
                        <td class="unit">{{$crono->Integrantes}}</td>
                        <td class="unit">{{$crono->CPC_Duracion.' semana(s)'}}</td>
                        <td class="unit">{{$crono->CPC_Entregable}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla Costos</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Formula</b></th>
                        <th class="unit"><b>Valor</b></th>
                    </tr>
                </thead>
                @foreach($costos as $costo)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_3++}}</td>
                        <td class="unit">{{$costo->Formula}}</td>
                        <td class="unit">{{$costo->CPC_Valor}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla Recursos</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Nombre</b></th>
                        <th class="unit"><b>Funcion</b></th>
                    </tr>
                </thead>
                @foreach($recursos as $recurso)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_4++}}</td>
                        <td class="unit">{{$recurso->Nombre}}</td>
                        <td class="unit">{{$recurso->CPGR_Funcion}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla Reuniones</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Interesado</b></th>
                        <th class="unit"><b>Lugar</b></th>
                        <th class="unit"><b>Fecha</b></th>
                    </tr>
                </thead>
                @foreach($reuniones as $reunion)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_5++}}</td>
                        <td class="unit">{{$reunion->CPGC_Interesado}}</td>
                        <td class="unit">{{$reunion->CPGC_Lugar}}</td>
                        <td class="unit">{{$reunion->CPGC_Fecha}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla Riesgos</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Interesado</b></th>
                        <th class="unit"><b>Lugar</b></th>
                        <th class="unit"><b>Fecha</b></th>
                        <th class="unit"><b>Accion</b></th>
                    </tr>
                </thead>
                @foreach($riesgos as $riesgo)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_6++}}</td>
                        <td class="unit">{{$riesgo->CPGR_Riesgo}}</td>
                        <td class="unit">{{$riesgo->CPGR_Caracteristicas}}</td>
                        <td class="unit">{{$riesgo->CPGR_Importancia}}</td>
                        <td class="unit">{{$riesgo->CPGR_Accion}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla Adquisiciones</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Adquisicion</b></th>
                        <th class="unit"><b>Costo</b></th>
                        <th class="unit"><b>Duracion</b></th>
                    </tr>
                </thead>
                @foreach($adquisiciones as $adquisicion)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_7++}}</td>
                        <td class="unit">{{$adquisicion->CPGA_Adquisicion}}</td>
                        <td class="unit">{{'$ '.$adquisicion->CPGA_Costo}}</td>
                        <td class="unit">{{$adquisicion->CPGA_Duracion}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
       <br>
       <br>
       <br>
    </main>
</body>
<!-- <footer>
    <div class="col-md-12" id="thanks" align="center">{{ env('APP_NAME') }} - {{ config('app.description') }}</div>
</footer> -->

</html>