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
                <h2 class="name">Reporte de la Etapa de Ejecucion</h2>
            </div>
        </div>
        <div class="col-md-12">
            <h3>Metodologia de trabajo</h3>
            <p>{{$Metodologia->CPPD_Metodologia}}</p>
        </div>
        <div class="col-md-12">
            <h3>Buenas practicas</h3>
            <p>{{$Aseguramiento->CPA_Aseguramiento}}</p>
        </div>
        
        <div class="col-md-12">
            <h3>Tabla carga horaria</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no">#</th>
                        <th class="unit"><b>Nombre</b></th>
                        <th class="unit"><b>Tiempo</b></th>
                    </tr>
                </thead>
                @foreach($horas as $hora)
                <tbody>
                    <tr>
                        <td class="no" style="width: 30px;">{{$cont++}}</td>
                        <td class="unit">{{$hora->CE_Nombre_Persona}}</td>
                        <td class="unit">{{$hora->CE_Horas_Trabajadas . ' horas'}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        <div class="col-md-12">
            <h3>Gestion Comunicaciones</h3>
            <p>{{'Medio: '.$comunicacion->CPC_Medio}}</p>
            <p>{{'Especificaciones: '.$comunicacion->CPC_Redaccion}}</p>
        </div>
       
        <div class="col-md-12">
            <h3>Tabla Adquisiciones</h3>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="no" style="width: 30px;">#</th>
                        <th class="unit"><b>Adquisicion</b></th>
                        <th class="unit"><b>Proveedor</b></th>
                        <th class="unit"><b>Tipo de contrato</b></th>
                    </tr>
                </thead>
                @foreach($adquisiciones as $adquisicion)
                <tbody>
                    <tr>
                        <td class="no">{{$cont_2++}}</td>
                        <td class="unit">{{$adquisicion->CPGA_Adquisicion}}</td>
                        <td class="unit">{{$adquisicion->CPGA_Proveedor}}</td>
                        <td class="unit">{{$adquisicion->CPGA_Tipo_Contrato}}</td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <h3>Participacion Interesados</h3>
            <p>{{'Necesidades: '.$participacion->CPI_Necesidades}}</p>
            <p>{{'Expectativas: '.$participacion->CPI_Expectativas}}</p>
        </div>
          
       <br>
       <br>
       <br>
    </main>
</body>

</html>