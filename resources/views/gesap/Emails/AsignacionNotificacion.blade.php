
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
	<style type="text/css">

  @font-face {
    font-family: 'Arial';
    font-style: Arial;
    font-weight: 400;
  
  }

	body{font-family:Arial; color:#333; background:#fff; margin-left:auto; margin-right:auto; max-width:210mm; max-height:297mm;}

	/*Common*/
	.clear{clear:both;}
	.blue{color:#0099CC;}

	h1{color:#037A25; margin-bottom:0; font-weight: Arial;}
	h2{color:#000000; margin-bottom:0; font-weight: Arial;}
	p{margin-top:0;}


	/*Head*/
	#head{text-align:center; margin-bottom:5em;}
	#head img{margin:1em 0; width:7cm;}
	#head .line{font-size:1.4em; font-style: Arial; color:#999;}

	/*Features*/
	h1.features{text-align: center; border-bottom:1px solid #ccc; font-family:Arial; text-transform: uppercase;}
	.feature{float:left; width:45%;}
	.feature h2{font-size:1.1em; text-transform: uppercase;}
	.feature p{color:#555;}
	.feature:nth-child(even){float:right;}



	</style>
</head>
<body>

	<div id="head">
        <img src="{{ asset('css/LogoUDEC.png') }}">
      <!--  <h1 class="features">PLATAFORMA WEB PARA LA GESTIÓN DE ANTEPROYECTOS Y PROYECTOS DE GRADO PARA EL PROGRAMA DE ING DE SISTEMAS</h1> -->
    </div>



	<h1 class="features">NOTIFICACIÓN (GESAP)</h1>
    <h2>Se le informa que fue asignado como Desarrollador del Anteproyecto :</h2>
    <h1> {{$Ante}}</h1>
    <h2> Ya puede subir sus adelantos del MCT.! </h2>
		<h2> Recuerde que puede verificar esta información en el siguiente </h2>
		<a href=" https://cit-udec.com/login">
		LINK </a>	
</body>
</html>

