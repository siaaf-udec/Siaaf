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
        <div> (+57 1) 892 0706 | 892 0707 <i class="fa fa-phone"></i> </div>
        <div><a href="mailto:unicundi@ucundinamarca.edu.co ">unicundi@ucundinamarca.edu.co</a> <i class="fa fa-at"></i> </div>
    </div>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <div class="to">Generado por:</div>
            <h2 class="name">{{ (isset( auth()->user()->full_name )) ? auth()->user()->full_name : 'Universidad de Cundinamarca' }}</h2>
            <div class="address">Teléfono: {{ (isset( auth()->user()->phone )) ? auth()->user()->phone : '(+57 1) 892 0706 | 892 0707' }}</div>
            <div class="email">E-mail: <a href="mailto:{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'unicundi@ucundinamarca.edu.co' }}">{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'unicundi@ucundinamarca.edu.co' }}</a></div>
        </div>
        <div id="invoice">
            <h1>REPORTE DE CHEQUES</h1>
            <div class="date">Fecha Inicial: {{ $start }}</div>
            <div class="date">Fecha Final: {{ $end }}</div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">#</th>
            <th class="desc">PAGAR A</th>
            <th class="unit">ESTADO</th>
            <th class="qty">FECHA ENTREGA</th>
            <th class="total">TOTAL</th>
        </tr>
        </thead>
        <tbody>
            @php  $delivered = 0; @endphp
            @php  $undelivered = 0; @endphp
            @forelse($data['data'] as $key => $datum)
                @php
                    if ( $datum['status'] == \App\Container\Financial\src\Check::DELIVERED ) {
                        $delivered++;
                    } else {
                        $undelivered++;
                    }
                @endphp
                <tr>
                    <td class="no">{{ $key + 1 }}</td>
                    <td class="desc">
                        <h3>Cheque {{ $datum['check'] }}</h3>
                        {{ $datum['pay_to'] }}
                    </td>
                    <td class="unit">{{ $datum['status_name'] }}</td>
                    <td class="qty">{{ $datum['delivered_at'] }}</td>
                    <td class="total">1</td>
                </tr>
                @empty
                <tr>
                    <td class="no">01</td>
                    <td class="desc">
                        <h3>{{ __('financial.generic.empty')  }}</h3>
                        {{ __('financial.generic.empty')  }}
                    </td>
                    <td class="unit">{{ __('financial.generic.empty')  }}</td>
                    <td class="qty">{{  __('financial.generic.empty') }}</td>
                    <td class="total">0</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">Entregados</td>
            <td>{{ isset( $delivered ) ? $delivered : 0 }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">Por entregar</td>
            <td>{{ isset( $undelivered ) ? $undelivered : 0 }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">Total</td>
            <td>{{ isset( $delivered, $undelivered ) ? ($delivered + $undelivered) : 0 }}</td>
        </tr>
        </tfoot>
    </table>
    <div id="thanks">{{ env('APP_NAME') }} - {{ config('app.description') }}</div>
    <div id="notices">
        <div>Información:</div>
        <div class="notice">El reporte de cheques puede ser comparado en la plataforma.</div>
    </div>
</main>
<footer>
    Esta reporte fue creado desde un computador y no es válida sin una firma y sello.
</footer>
</body>
</html>