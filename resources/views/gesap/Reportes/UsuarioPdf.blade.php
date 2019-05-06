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
	#head .line{font-size:1em; font-style: italic; color:#999;}

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
        <img src="{{ asset('css/LogoUDEC.png') }}">
        <h1 class="features">REPORTE GENERADO POR</h1>
 
        <p class="line">Plataforma Web Para La Gestión De Anteproyectos y Proyectos De Grado (GESAP)</p>
        <p class="line">Calle 14 con Avenida 15</p>
        <p class="line">Universidad de Cundinamarca - Ext. Facatativá</p>
        <p class="line">(+57 1) 892 0706 | 892 0707 </p>
        <p class="line">unicundi@ucundinamarca.edu.co </p>
        <p class="line">Fecha : {{$fecha}} </p>
          @if($n == 1)
          <a  href="{{ route('AnteproyectosGesap.reporteUsuario') }}/{{$usuario->PK_User_Codigo}}/2">Descargar</a>
 		
          @endif
        
 		
	</div>

    <div id="features">
    <h1 class="features" >{{$title}}</h1>
       <br><br>
    
    <table class="meta">
          <tr>
            <th><span contenteditable>Nombres</span></th>
            <td><span contenteditable>{{$usuario->User_Nombre1}}</span></td>
          </tr>
          <tr>
            <th><span contenteditable>Apellidos</span></th>
            <td><span contenteditable>{{$usuario->User_Apellido1}}</span></td>
           </tr>
          <tr>
            <th><span contenteditable>Rol</span></th>
            <td><span contenteditable>{{$usuario->Rol}}</span></td>
           </tr>
          <tr>
            <th><span contenteditable>Documento</span></th>
            <td><span contenteditable>{{$usuario->PK_User_Codigo}}</span></td>
           </tr>
           <tr>
            <th><span contenteditable>Correo</span></th>
            <td><span contenteditable>{{$usuario->User_Correo}}</span></td>
           </tr>
           <tr>
            <th><span contenteditable>Estado</span></th>
            <td><span contenteditable>{{$usuario->Estado}}</span></td>
           </tr>
          
    </table>

  @if($usuario->FK_User_IdRol == 1)
    <table border="0" cellspacing="0" cellpadding="0">
    </table>
    <h1 class="features" >Anteproyectos Registrados para este usuario</h1>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Anteproyecto</b></th>
            <th class="line"><b>Pre Director</b></th>
            <th class="line"><b>Estado</b></th>
            <th class="line"><b>Estado A/I</b></th>
        </tr>
        </thead>
        @foreach($desarrollador as $desarrollo)
            <tbody>
            <tr>
                <td class="line">{{$desarrollo->Ante}}</td>
                <td class="line">{{$desarrollo->AntePreDirec}}</td>
                <td class="line">{{$desarrollo->AnteEstado}}</td>
                <td class="line">{{$desarrollo->EstadoA}}</td>
              
            </tr>
            @endforeach
            </tbody>

    </table>
    <h1 class="features" >Proyectos Registrados para este usuario</h1>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Proyecto</b></th>
            <th class="line"><b>Director</b></th>
            <th class="line"><b>Estado</b></th>
            <th class="line"><b>Estado A/I</b></th>
        </tr>
        </thead>
        @foreach($desarrollador as $desarrollo)
            <tbody>
            <tr>
                <td class="line">{{$desarrollo->Proy}}</td>
                <td class="line">{{$desarrollo->Direc}}</td>
                <td class="line">{{$desarrollo->ProyEstado}}</td>
                <td class="line">{{$desarrollo->EstadoA}}</td>
              
            </tr>
            @endforeach
            </tbody>

    </table>
    @endif    
    @if($usuario->FK_User_IdRol == 2)
    <table border="0" cellspacing="0" cellpadding="0">
    </table>
    
    <h1 class="features" >Anteproyectos Asignados a este usuario(Director)</h1>
        <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Titulo</b></th>
            <th class="line"><b>Estado</b></th>
            <th class="line"><b>Desarrolladores</b></th>
            <th class="line"><b>Estado A/I</b></th>
        </tr>
        </thead>
        @foreach($director as $direc)
            <tbody>
            <tr>
                <td class="line">{{$direc->NPRY_Titulo}}</td>
                <td class="line">{{$direc->AnteEstado}}</td>
                <td class="line">{{$direc->AnteDesarrolladores}}</td>
                <td class="line">{{$direc->EstadoA}}</td>
              
            </tr>
        @endforeach
            </tbody>

    </table>
 <h1 class="features" >Proyectos Asignados a este usuario(Director)</h1>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Titulo</b></th>
            <th class="line"><b>Estado</b></th>
            <th class="line"><b>Desarrolladores</b></th>
            <th class="line"><b>Estado A/I</b></th>
        </tr>
        </thead>
        @foreach($Proydirector as $proydirec)
            <tbody>
            <tr>
                <td class="line">{{$proydirec->Titulo}}</td>
                <td class="line">{{$proydirec->EstadoProy}}</td>
                <td class="line">{{$proydirec->ProyDesarrolladores}}</td>
                <td class="line">{{$proydirec->EstadoA}}</td>
              
            </tr>
 
        @endforeach
            </tbody>

    </table>
    <h1 class="features" >Anteproyectos Asignados a este usuario(Jurado)</h1>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Titulo</b></th>
            <th class="line"><b>Estado Anteproyecto</b></th>
            <th class="line"><b>Desarrolladores</b></th>
            <th class="line"><b>Decisión Jurado</b></th>
            <th class="line"><b>Estado A/I</b></th>
        </tr>
        </thead>
        @foreach($juradosante as $juradosant)
            <tbody>
            <tr>
                <td class="line">{{$juradosant->Titulo}}</td>
                <td class="line">{{$juradosant->Estado}}</td>
                <td class="line">{{$juradosant->Desarrolladores}}</td>
                <td class="line">{{$juradosant->EstadoJur}}</td>
                <td class="line">{{$juradosant->EstadoA}}</td>
              
            </tr>
 
        @endforeach
            </tbody>

    </table>
    <h1 class="features" >Proyectos Asignados a este usuario(Jurado)</h1>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="line"><b>Titulo</b></th>
            <th class="line"><b>Estado Anteproyecto</b></th>
            <th class="line"><b>Desarrolladores</b></th>
            <th class="line"><b>Decisión Jurado</b></th>
            <th class="line"><b>Estado A/I</b></th>
        </tr>
        </thead>
        @foreach($juradosproy as $juradospro)
            <tbody>
            <tr>
                <td class="line">{{$juradospro->Titulo}}</td>
                <td class="line">{{$juradospro->Estado}}</td>
                <td class="line">{{$juradospro->Desarrolladores}}</td>
                <td class="line">{{$juradospro->EstadoJur}}</td>
                <td class="line">{{$juradospro->EstadoA}}</td>
              
            </tr>
 
        @endforeach
            </tbody>

    </table>

    @endif
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
