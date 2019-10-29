<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>UDEC - SIGDEP REPORTES</title>
    <style type="text/css">
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        body {
            position: relative;
            width: 100%;
            height: 23cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #company {
            float: right;
            text-align: right;
        }

        .grid-1 {
            padding-top: 40px;
            display: grid;
            width: 100%;
            max-width: 750px;
            margin: 0 auto;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .grid-1 div {
            color: white;
            font-size: 20px;
            padding: 20px;
        }

        .item-1 {
            grid-column: 1;

        }

        .item-2 {
            grid-column: 2;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }


        #invoice h1 {
            color: #d5ca3d;
            font-size: 1.8em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        @media print {
            .noPrint {
                display: none;
                cursor: pointer
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table th,
        table td {
            padding: 9px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: left;
        }

        table td h3 {
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #05380D;
            text-align: center;
        }

        table .desc {
            text-align: left;
            font-size: 1.1em;


        }

        table .unit {
            background: #DDDDDD;
        }

        table .qty {}

        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.1em;
        }

        table tbody tr:last-child td {
            border: 1px solid #FFFFFF;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table thead tr {
            page-break-inside: avoid;
        }

        table tbody tr {
            page-break-inside: avoid;
        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 1.5em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #d5ca3d;
        }

        #notices .notice {
            font-size: 1.2em;
        }

        footer {
            color: #777777;
            width: 710px;
            height: 30px;
            position: fixed;
            margin: 0 auto;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            /* padding: 8px 0; */
            text-align: center;
        }
    </style>
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
    <h3 >SIAAF - Sistema de Información para el Apoyo Administrativo UdeC Facatativá </h3>
</footer> -->

</html>