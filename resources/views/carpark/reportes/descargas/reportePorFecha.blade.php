


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>UDEC - PARQUEADERO V2(REPORTES)</title>
    <style type="text/css">

    /*Embeaded font :-)*/
  @font-face {
    font-family: 'Arial';
    font-style: normal;
    font-weight: 400;
 
  }


    body{font-family:Arial; color:#333; background:#fff; margin-left:auto; margin-right:auto; max-width:210mm; max-height:297mm;}

    /*Common*/
    .clear{clear:both;}
    .blue{color:#045A16;}

    h1,
    h2{color:#045A16; margin-bottom:0; font-weight: normal;}
    p{margin-top:0;}
    

    /*Head*/
    #head{text-align:left; margin-bottom:5em;}
    #head img{margin:1em 0; width:7cm;}
    #head .line{font-size:1em; font-style: Arial; color:#999;}

    /*Features*/
    h1.features{text-align: center; border-bottom:1px solid #ccc; font-family:Arial; text-transform: uppercase;}
    .feature{float:center; width:100%;}
    .feature h2{font-size:1.1em; text-transform: uppercase;}
    .feature p{color:#555;}
    .feature:nth-child(even){float:right;}
    .final{text-align: center; border-bottom:1px solid #ccc; font-family:Arial; text-transform: uppercase;}
     /* table */

     table { font-size: 75%; table-layout: fixed; width: 100%; }
     table { border-collapse: separate; border-spacing: 2px; }
     th, td { border-width: 3px; padding: 1em; position: relative; text-align: left; }
     th, td { border-radius: 0.5em; border-style: solid; }
     th { background: #EEE; border-color: #BBB; }
     td { border-color: #DDD; }
      /* table meta & balance */

      table.meta, table.balance { float: left; width: 36%; }
      table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

      /* table meta */

      table.meta th { width: 40%; }
      table.meta td { width: 60%; }



    </style>
</head>
<body>
    <div id="head">
        <!-- Embeaded image :-) --> 
       <img src="{{ base_path('public/css/LogoUDEC.png')}}">
        <h1 class="features">REPORTE GENEREADO POR</h1>
 
        <p class="line">Parqueadero Universidad De Cundinamarca Extensión Facatativá</p>
        <p class="line">Calle 14 con Avenida 15</p>
        <p class="line">Universidad de Cundinamarca - Ext. Facatativá</p>
        <p class="line">(+57 1) 892 0706 | 892 0707 </p>
        <p class="line">unicundi@ucundinamarca.edu.co </p>
        <p class="line">Fecha generacion : {{$date}} </p>
        <p class="line">Hora generacion : {{$time}} </p>
    </div>

    <div id="features">
   
       <br><br>
    <div id="details" class="clearfix">
        <div id="client">
            <h2 class="name">Historial Del {{date('d-m-Y', strtotime($FechaMinDescarga))}} al {{date('d-m-Y', strtotime($FechaMaxDescarga))}}</h2>
            <div class="to">REPORTE GENERADO POR:</div>
            <h2 class="name">Parqueadero Universidad De Cundinamarca Extensión Facatativá</h2>
            <div class="address">Calle 14 con Avenida 15</div>
            <div class="email"><a href="#">correoFalso123@mail.com</a></div>
        </div>
        <div id="invoice">
            <h1>DATOS DE CONTACTO:</h1>            
            <div class="date">Fecha del reporte: {{$date}}</div>
            <div class="date">Hora del reporte: {{$time}}</div>
            <div><a class="noPrint"
                    href="{{ route('parqueadero.reportesCarpark.DescargarfiltradoFecha') }}/{{$FechaMinDescarga}}/{{$FechaMaxDescarga}}">
                    <i class="fa fa-download">
                    </i>Descargar reporte
                </a>
            </div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">#</th>
            <th class="unit"><b>Documento Usuario</b></th>
            <th class="unit"><b>Nombre</b></th>
            <th class="unit"><b>Placa</b></th>
            <th class="unit"><b>Código Vehículo</b></th>
            <th class="unit"><b>Fecha y Hora Entrada</b></th>
            <th class="unit"><b>Fecha y Hora Salida</b></th>

        </tr>
        </thead>
        @foreach($infoHistoriales as $infoHistorial)
            <tbody>
            <tr>
                <td class="no">{{$cont++}}</td>
                <td class="unit">{{$infoHistorial->CH_CodigoUser}}</td>
                <td class="desc">{{$infoHistorial->CH_NombresUser}}</td>
                <td class="unit">{{$infoHistorial->CH_Placa}}</td>
                <td class="desc">{{$infoHistorial->CH_CodigoMoto}}</td>
                <td class="unit">{{$infoHistorial->CH_FHentrada}}</td>
                <td class="desc">{{$infoHistorial->CH_FHsalida}}</td>

            </tr>
            @endforeach
            </tbody>

    </table>
  

    </div>


</body>
<footer>
<div id="head">
        <div id="features"> 
        <h2 class="final">SIAAF - Sistema de Información para el Apoyo Administrativo UdeC Facatativá </h2>
        </div>
        
    </div>
</footer>
</html>