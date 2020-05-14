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
    <div id="head">
        <h3>SIGDEP - Sistema de Informacion para la Gestion de Desarrollo de Proyectos</h3>
        <h4 class="date">Fecha del reporte: {{$date}} {{$time}}</h4>
    </div>
    <hr>
    <h2 class="name">Reporte de la Etapa de Inicio</h2>
    <div class="col-md-12">
        <h3>Informacion del proyecto</h3>
        <div class="col-md-6" style="padding: 10px; float: left; width: 45%; text-align: justify;">
            <div class="form-group form-md-line-input">
                <label>Nombre del proyecto: {{$infoProyecto->CP_Nombre_Proyecto}}</label>
            </div>
            <div class="form-group form-md-line-input">
                <label>Duracion: {{$infoProyecto->CP_Duracion.' mes(es)'}}</label>
            </div>
        </div>
        <div class="col-md-6" style="padding: 10px; float: right; width: 45%; text-align: justify;">
            <div class="form-group form-md-line-input">
                <label>Fecha: {{$infoProyecto->CP_Fecha_Inicio.' a '. $infoProyecto->CP_Fecha_Final}}</label>
            </div>
            <div class="form-group form-md-line-input">
                <label>Entidades: {{$infoProyecto->CP_Entidades}}</label>
            </div>
        </div>
    </div>
    <br><br><br>
    <div class="col-md-12">
        <h3>Objetivos</h3>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no" style="width: 30px;">#</th>
                    <th class="unit"><b>Objetivo</b></th>
                    <th class="unit"><b>Tipo</b></th>
                </tr>
            </thead>
            @foreach($objetivos as $objetivo)
            <tbody>
                <tr>
                    <td class="no">{{$cont++}}</td>
                    <td class="unit">{{$objetivo->CO_Objetivo}}</td>
                    <td class="desc">{{$objetivo->Tipo}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <h3>Informacion del equipo scrum</h3>
        <div class="col-md-6" style="padding: 10px; float: left; width: 45%; text-align: justify;">
            <div class="form-group form-md-line-input">
                <label>Scrum Master: {{$infoEquipo[0]->CE_Nombre_Persona}}</label>
            </div>
            <div class="form-group form-md-line-input">
                <label>Product Owner: {{$infoEquipo[1]->CE_Nombre_Persona}}</label>
            </div>
            <h4>Integrantes</h4>
            <div class="form-group form-md-line-input">
                <label>Lider del equipo: {{$infoEquipo[3]->CE_Nombre_Persona}}</label>
            </div>
            @foreach($integrantes as $integrante)
            <div class="form-group form-md-line-input">
                <label>Integrante: {{$integrante->CE_Nombre_Persona}}</label>
            </div>
            @endforeach
        </div>
        <div class="col-md-6" style="padding: 10px; float: right; width: 45%; text-align: justify;">
            <div class="form-group form-md-line-input">
                <label>Stakeholder: {{$infoEquipo[2]->CE_Nombre_Persona}}</label>
            </div>
        </div>
    </div>
</body>
<!-- <footer> 
    <h3 >SIAAF - Sistema de Información para el Apoyo Administrativo UdeC Facatativá </h3>
</footer> -->

</html>