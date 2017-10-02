<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media="all" />
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
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/favicons') }}/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicons') }}/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicons') }}/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicons') }}/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('assets/favicons') }}/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicons') }}/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    {{-- ENDS FAVICONS --}}
    <style>

thead{display: table-header-group;}
tfoot {display: table-row-group;}
tr {page-break-inside: avoid;}
</style>
    
    
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{ asset('css/logo.png') }}">
    </div>
    <div id="company">
        <h2 class="name">GESAP</h2>
        <div> Calle 14 con Avenida 15 <i class="fa fa-map-signs"></i></div>
        <div>Universidad de Cundinamarca - Ext. Facatativá <i class="fa fa-map-marker" aria-hidden="true"></i></div>
        <div> (+57 1) 892 0706 | 892 0707 <i class="fa fa-phone"></i> </div>
        <div><a href="mailto:unicundi@ucundinamarca.edu.co ">unicundi@ucundinamarca.edu.co</a> <i class="fa fa-at"></i> </div>
    </div>
    </div>
</header>
<main>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">#</th>
            <th class="desc">TITULO</th>
            <th class="unit">AUTORES</th>
            <th class="qty">PALABRAS CLAVE</th>
        </tr>
        </thead>
        <tbody>
         <?php $index=1; ?>
        @foreach ($proyectos as $anteproyecto)   
            <tr>
            <td class="no">{{$index}}</td>
            <td class="desc"><h3>{{ $anteproyecto->NPRY_Titulo }}</h3></td>
            <td class="desc">
                Director:
                <br>
                @if($anteproyecto->Director=="NO ASIGNADO")
                    ---
                @else
                    {{ $anteproyecto->Director }}
                @endif
                <br>    
                Estudiantes:
                @if($anteproyecto->estudiante1=="NO ASIGNADO")
                    ---
                @else
                    {{ $anteproyecto->estudiante1 }}
                @endif
                <br> 
                @if($anteproyecto->estudiante2=="NO ASIGNADO")
                @else
                    {{ $anteproyecto->estudiante2 }}
                @endif
                
                
                
                
                
                <br>    
                
            </td>
            <td class="qty">{{ $anteproyecto->NPRY_Keywords }}</td>
            </tr>
            <?php $index++; ?>
        @endforeach
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    <div id="thanks">{{ env('APP_NAME') }} - {{ config('app.description') }}</div>
    <div id="notices">
        <div>ADVERTENCIA:</div>
        <div class="notice">Se hará un recargo de 1.5% adicional después de 30 días.</div>
    </div>
</main>
</body>


     


</html>