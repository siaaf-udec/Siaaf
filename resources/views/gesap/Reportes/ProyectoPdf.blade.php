<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>UDEC - GESAP(REPORTES)</title>
	<style type="text/css">
  @font-face {
    font-family: 'Anton';
    font-style: normal;
    font-weight: 400;
  }
	body{font-family:Arial, Helvetica, sans-serif; color:#333; background:#fff; margin-left:auto; margin-right:auto; max-width:210mm; max-height:297mm;}
	.clear{clear:both;}
	.blue{color:#045A16;}

	h1,
	h2{color:#045A16; margin-bottom:0; font-weight: normal;}
	p{margin-top:0;}
    

	/*Head*/
	#head{text-align:left; margin-bottom:5em;}
	#head img{margin:1em 0; width:7cm;}
	#head .line{font-size:1em; font-style: italic; color:#999;}

	/*Features*/
	h1.features{text-align: center; border-bottom:1px solid #ccc; font-family:Anton, sans-serif; text-transform: uppercase;}
	.feature{float:center; width:100%;}
	.feature h2{font-size:1.1em; text-transform: uppercase;}
    .feature p{color:#555;}
	.feature:nth-child(even){float:right;}
    .final{text-align: center; border-bottom:1px solid #ccc; font-family:Anton, sans-serif; text-transform: uppercase;}
     /* table */

     table { font-size: 75%; table-layout: fixed; width: 100%; }
     table { border-collapse: separate; border-spacing: 2px; }
     th, td { border-width: 3px; padding: 1em; position: relative; text-align: center; }
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
 
        <p class="line">Plataforma Web Para La Gestión De Proyectos y Proyectos De Grado (GESAP)</p>
        <p class="line">Calle 14 con Avenida 15</p>
        <p class="line">Universidad de Cundinamarca - Ext. Facatativá</p>
        <p class="line">(+57 1) 892 0706 | 892 0707 </p>
        <p class="line">unicundi@ucundinamarca.edu.co </p>
        <p class="line">Fecha : {{$fecha}} </p>
      @if($n == 1)
        <a href="{{ route('AnteproyectosGesap.ReporteProyecto') }}/{{$proyecto->FK_NPRY_IdMctr008}}/ 2">Descargar</a>
      @endif
 			
	</div>

    <div id="features">

    <h1 class="features" >{{$title}}</h1>
   
    <table class="meta">
          <tr>
            <th><span contenteditable>Fecha De Radicacón</span></th>
            <td><span contenteditable>{{$proyecto->PYT_Fecha_Radicacion}}</span></td>
          </tr>
          <tr>
            <th><span contenteditable>Estado Del Proyecto</span></th>
            <td><span contenteditable>{{$proyecto->Estado}}</span></td>
          </tr>
          <tr>
            <th><span contenteditable>Duración</span></th>
            <td><span contenteditable>{{$proyecto->Duracion}}</span></td>
          </tr>
          <tr>
            <th><span contenteditable>Semillero</span></th>
            <td><span contenteditable>{{$proyecto->Semillero}}</span></td>
          </tr>
        </table>

    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Proyecto</b></th>
            <th class="line"><b>Descripción</b></th>
            <th class="line"><b>Palabras Clave</b></th>
            <th class="line"><b>Director</b></th>
           
        </tr>
        </thead>
      
            <tbody>
            <tr>
                <td class="line">{{$proyecto->Titulo}}</td>
                <td class="line">{{$proyecto->Descripcion}}</td>
                <td class="line">{{$proyecto->Palabras}}</td>
                <td class="line">{{$proyecto->Director}}</td>
              
            </tr>
            </tbody>

    </table>
    <h1 class="features">Usuarios Asignados</h1>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Desarrollador N°1</b></th>
            <th class="line"><b>Desarrollador N°2</b></th>
            <th class="line"><b>Jurado N°1</b></th>
            <th class="line"><b>Jurado N°2</b></th>
           
        </tr>
        </thead>
      
            <tbody>
            <tr>
                <td class="line">{{$desarrollador1}}</td>
                <td class="line">{{$desarrollador2}}</td>
                <td class="line">{{$jurado1}}</td>
                <td class="line">{{$jurado2}}</td>
              
            </tr>
            </tbody>

    </table>
    <h1 class="features">Decisión Jurados</h1>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Jurado </b></th>
            <th class="line"><b>Comentarios</b></th>
            <th class="line"><b>Decisión</b></th>
           
        </tr>
        </thead>
        @foreach($jurados as $jurado)
            <tbody>
            <tr>
                <td class="line">{{$jurado->Jurado}}</td>
                <td class="line">{{$jurado->Des}}</td>
                <td class="line">{{$jurado->Estado}}</td>
                
            </tr>
        @endforeach
            </tbody>

    </table>
    <h1 class="features">Interacción De los estudiantes para con el Proyecto</h1>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Desarrollador N°1 </b></th>
            <th class="line"><b>%</b></th>
            <th class="line"><b>Desarrollador N°2 </b></th>
            <th class="line"><b>%</b></th>
           
        </tr>
        </thead>
     
            <tbody>
            <tr>
                <td class="line">{{$desarrollador1}}</td>
                <td class="line">{{$interaccionest1}}</td>
                <td class="line">{{$desarrollador2}}</td>
                <td class="line">{{$interaccionest2}}</td>
                
            </tr>
        
            </tbody>

    </table>
</body>
<footer>
<div id="head">
		<div id="features"> 
        <h2 class="final">SIAAF - Sistema de Información para el Apoyo Administrativo UdeC Facatativá </h2>
        </div>
 		
	</div>
</footer>
</html>
