<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" media="all"/>
    <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
          type="text/css"/>
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

    <style>
        thead {
            display: table-header-group;
            text-align: center;
        !important
        }

        tfoot {
            display: table-row-group;
        }

        tr {
            page-break-inside: avoid;
        }

        table .no {
            font-size: 1em;
            padding: 5px;
            text-align: center;
        }

        table .unit {
            text-align: center;
            width: 25%;
        }

        table .desc {
            width: 40%;
        }

        table td.unit, table td.qty, table td.total {
            font-size: 1em;
        }

        table .qty {
            text-align: left;
            vertical-align: baseline;
        }

        footer {
            position: relative;
        }
    </style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{ asset('css/logoUDEC.png') }}">
    </div>
    <div id="company">
        <h2 class="name">{{ env('APP_NAME') }}</h2>
        <div> Calle 14 con Avenida 15 <i class="fa fa-map-signs"></i></div>
        <div>Universidad de Cundinamarca - Ext. Facatativá <i class="fa fa-map-marker" aria-hidden="true"></i></div>
        <div> (+57 1) 892 0706 | 892 0707 <i class="fa fa-phone"></i></div>
        <div><a href="mailto:unicundi@ucundinamarca.edu.co ">unicundi@ucundinamarca.edu.co</a> <i class="fa fa-at"></i>
        </div>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">REPORTE GENERADO POR:</div>
            <h2 class="name">{{ (isset( auth()->user()->full_name )) ? auth()->user()->full_name : 'Funcionario Recursos Humanos' }}</h2>
            <div class="address">{{ (isset( auth()->user()->address )) ? auth()->user()->address : 'Calle 14 con Avenida 15' }}</div>
            <div class="email"><a
                        href="mailto:{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'unicundi@ucundinamarca.edu.co' }}">{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'unicundi@ucundinamarca.edu.co' }}</a>
            </div>
        </div>
        <div id="invoice">
            <h1>DATOS DE {{$cargo}}:</h1>
            <div class="date">Nombre:{{$docente->full_name}}</div>
            <div class="date">Total de proyectos: {{sizeof($proyectos)}} proyectos</div>
            <div class="date">Fecha del reporte: {{$date}}</div>
            <div class="date">Hora del reporte: {{$time}}</div>
            <div>
                @if($cargo == "JURADO")
                    <a class="noPrint" href="{{ route('report.jury.project.download',['jury' => $docente->id]) }}">
                        @endif
                        @if($cargo == "DIRECTOR")
                            <a class="noPrint"
                               href="{{ route('report.director.project.download',['director' => $docente->id]) }}">
                                @endif
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
            <th class="">TITULO</th>
            <th class="unit">AUTORES</th>
            <th class="">PALABRAS CLAVE</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($proyectos[0]))
            @foreach ($proyectos as  $index => $anteproyecto)
                <tr>
                    <td class="no" rowspan="5">{{$index+1}}</td>
                    <td class="desc" rowspan="5"><h3>{{ $anteproyecto->anteproyecto->NPRY_Titulo }}</h3></td>
                    <td class="unit" rowspan="3">
                        @foreach ($anteproyecto->anteproyecto->director as  $director)
                            Director:
                            <br>
                            *{{$director->usuarios->full_name}}
                        @endforeach
                        <br>

                        @foreach ($anteproyecto->anteproyecto->estudiante1 as  $estudiante1)
                            Estudiantes:
                            <br>
                            *{{$estudiante1->usuarios->full_name}}
                        @endforeach
                        <br>
                        @foreach ($anteproyecto->anteproyecto->estudiante2 as  $estudiante2)
                            *{{$estudiante2->usuarios->full_name}}
                        @endforeach


                    </td>
                    <td class="qty" rowspan="4">
                        <?php $Keywords = explode(',', $anteproyecto->anteproyecto->NPRY_Keywords);?>
                        @foreach($Keywords as $element)
                            *{{$element}}<br>
                        @endforeach
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td class="qty" rowspan="2">
                        Jurados:
                        <br>
                        @foreach ($anteproyecto->anteproyecto->jurado1 as  $jurado1)
                            *{{$jurado1->usuarios->full_name}}
                        @endforeach
                        <br>
                        @foreach ($anteproyecto->anteproyecto->jurado2 as  $jurado2)
                            *{{$jurado2->usuarios->full_name}}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="unit">
                        Duración: {{ $anteproyecto->anteproyecto->NPRY_Duracion }} meses
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">
                    <center>SIN REGISTROS</center>
                </td>
            </tr>
        @endif
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
<footer>
    Pruebas
</footer>
</html>