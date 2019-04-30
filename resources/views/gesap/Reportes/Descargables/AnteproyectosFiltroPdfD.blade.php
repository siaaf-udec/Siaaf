<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>UDEC - GESAP(REPORTES)</title>
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
        <h1 class="features">REPORTE GENERADO POR</h1>
 
        <p class="line">Plataforma Web Para La Gestión De Anteproyectos y Proyectos De Grado (GESAP)</p>
        <p class="line">Calle 14 con Avenida 15</p>
        <p class="line">Universidad de Cundinamarca - Ext. Facatativá</p>
        <p class="line">(+57 1) 892 0706 | 892 0707 </p>
        <p class="line">unicundi@ucundinamarca.edu.co </p>
        <p class="line">Fecha : {{$fecha}} </p>
	</div>

    <div id="features">
    <h1 class="features" >{{$title}}</h1>
       <br><br>
    
  
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Anteproyecto</b></th>
            <th class="line"><b>Descripción</b></th>
            <th class="line"><b>Pre-Director</b></th>
            <th class="line"><b>Estudiantes</b></th>
            <th class="line"><b>Fecha De Radicación</b></th>
            <th class="line"><b>Estado</b></th>
            <th class="line"><b>Estado Act/inact</b></th>
           
        </tr>
        </thead>
        @foreach($anteproyectos as $anteproyecto)
            <tbody>
            <tr>
                <td class="line">{{$anteproyecto->NPRY_Titulo}}</td>
                <td class="line">{{$anteproyecto->NPRY_Descripcion}}</td>
                <td class="line">{{$anteproyecto->Director}}</td>
                <td class="line">{{$anteproyecto->Desarrolladores}}</td>
                <td class="line">{{$anteproyecto->NPRY_FCH_Radicacion}}</td>
                <td class="line">{{$anteproyecto->Estado}}</td>
                <td class="line">{{$anteproyecto->EstadoAnteAI}}</td>

              
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
