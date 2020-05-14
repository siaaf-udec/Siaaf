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
                <h2 class="name">Reporte de la Etapa de Monitoreo y Control</h2>
            </div>
            <div id="invoice">
                <div><a class="noPrint" href="{{ route('calidadpcs.reportesCalidad.descargaReporteEtapaMonitoreo') }}/{{$infoProyecto->PK_CP_Id_Proyecto}}">
                        <i class="fa fa-download">
                        </i>Descargar reporte
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h3>Tabla control de objetivos</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Objetivo</b></th>
                        <th class="unit"><b>Tipo</b></th>
                        <th class="unit"><b>Estado</b></th>
                    </tr>
                </thead>
                @foreach($objetivos as $objetivo)
                <tbody>
                    <tr>
                        <td class="no">{{$cont++}}</td>
                        <td class="unit">{{$objetivo->CO_Objetivo}}</td>
                        <td class="desc">{{$objetivo->Tipo}}</td>
                        <td class="desc">{{$objetivo->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla control de requerimientos</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Requerimientos</b></th>
                        <th class="unit"><b>Estado</b></th>
                    </tr>
                </thead>
                @foreach($requerimientos as $requerimiento)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_2++}}</td>
                        <td class="unit">{{$requerimiento->CPR_Nombre_Requerimiento}}</td>
                        <td class="desc">{{$requerimiento->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla control de cronograma</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Sprint</b></th>
                        <th class="unit"><b>Requerimientos</b></th>
                        <th class="unit"><b>Duracion</b></th>
                        <th class="unit"><b>Fecha Entrega</b></th>
                        <th class="unit"><b>Estado</b></th>
                    </tr>
                </thead>
                @foreach($cronograma as $crono)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_3++}}</td>
                        <td class="unit">{{$crono->CPC_Nombre_Sprint}}</td>
                        <td class="unit">{{$crono->Requerimientos}}</td>
                        <td class="unit">{{$crono->CPC_Duracion.' semana(s)'}}</td>
                        <td class="unit">{{$crono->CPC_Fecha_Fin_Sprint}}</td>
                        <td class="desc">{{$crono->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla control de costos</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Costo</b></th>
                        <th class="unit"><b>Valor</b></th>
                        <th class="unit"><b>Estado</b></th>
                    </tr>
                </thead>
                @foreach($costos as $costo)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_4++}}</td>
                        <td class="unit">{{$costo->Formula}}</td>
                        <td class="unit">{{$costo->CPC_Valor}}</td>
                        <td class="desc">{{$costo->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h3 align="right">Costo total: ${{$costos->valor}} </h3>
        </div>
        <div class="col-md-12">
            <h3>Control de la calidad</h3>
            <p>{{'Desempeño: '.$desempeño->desempeño}}</p>
            <p>{{'Recomendaciones: '.$desempeño->CPA_Recomendaciones}}</p>
        </div>
        <div class="col-md-12">
            <h3>Tabla control de las comunicaciones</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Interesado</b></th>
                        <th class="unit"><b>Lugar</b></th>
                        <th class="unit"><b>Fecha</b></th>
                        <th class="unit"><b>Estado</b></th>
                    </tr>
                </thead>
                @foreach($reuniones as $reunion)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_5++}}</td>
                        <td class="unit">{{$reunion->CPGC_Interesado}}</td>
                        <td class="unit">{{$reunion->CPGC_Lugar}}</td>
                        <td class="unit">{{$reunion->CPGC_Fecha}}</td>
                        <td class="desc">{{$reunion->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla control de riesgos</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Riesgo</b></th>
                        <th class="unit"><b>Estado</b></th>
                    </tr>
                </thead>
                @foreach($riesgos as $riesgo)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_6++}}</td>
                        <td class="unit">{{$riesgo->CPGR_Riesgo}}</td>
                        <td class="desc">{{$riesgo->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Tabla control de adquisiciones</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Adquisicion</b></th>
                        <th class="unit"><b>Estado</b></th>
                    </tr>
                </thead>
                @foreach($adquisiciones as $adquisicion)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_7++}}</td>
                        <td class="unit">{{$adquisicion->CPGA_Adquisicion}}</td>
                        <td class="desc">{{$adquisicion->estado}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Control de la participacion de los interesados</h3>
            <p>{{'Participacion: '.$participacion->participacion}}</p>
            <p>{{'Observaciones: '.$participacion->CPI_Observaciones}}</p>
        </div>
        <br><br>
    </main>
</body>

</html>