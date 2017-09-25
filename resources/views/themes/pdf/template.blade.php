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
        <img src="{{ asset('css/logo.png') }}">
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
            <div class="to">FACTURADO A:</div>
            <h2 class="name">{{ (isset( auth()->user()->full_name )) ? auth()->user()->full_name : 'John Doe' }}</h2>
            <div class="address">{{ (isset( auth()->user()->address )) ? auth()->user()->address : '796 Silver Harbour, TX 79273, US' }}</div>
            <div class="email"><a href="mailto:{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'john@example.com' }}">{{ (isset( auth()->user()->email )) ? auth()->user()->email : 'john@example.com' }}</a></div>
        </div>
        <div id="invoice">
            <h1>FACTURA 65487</h1>
            <div class="date">Fecha de Facturación: 01/06/2014</div>
            <div class="date">Fecha de Vencimiento: 30/06/2014</div>
        </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPCIÓN</th>
            <th class="unit">PRECIO UNITARIO</th>
            <th class="qty">CANTIDAD</th>
            <th class="total">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="no">01</td>
            <td class="desc"><h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity</td>
            <td class="unit">$40.00</td>
            <td class="qty">30</td>
            <td class="total">$1,200.00</td>
        </tr>
        <tr>
            <td class="no">02</td>
            <td class="desc"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
            <td class="unit">$40.00</td>
            <td class="qty">80</td>
            <td class="total">$3,200.00</td>
        </tr>
        <tr>
            <td class="no">03</td>
            <td class="desc"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
            <td class="unit">$40.00</td>
            <td class="qty">20</td>
            <td class="total">$800.00</td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>$5,200.00</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">IVA 25%</td>
            <td>$1,300.00</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td>$6,500.00</td>
        </tr>
        </tfoot>
    </table>
    <div id="thanks">{{ env('APP_NAME') }} - {{ config('app.description') }}</div>
    <div id="notices">
        <div>ADVERTENCIA:</div>
        <div class="notice">Se hará un recargo de 1.5% adicional después de 30 días.</div>
    </div>
</main>
<footer>
    Esta factura fue creada desde un computador y no es válida sin una firma y sello.
</footer>
</body>
</html>