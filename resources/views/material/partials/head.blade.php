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
{{-- BEGIN GLOBAL MANDATORY STYLES --}}
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
{{-- END GLOBAL MANDATORY STYLES --}}
{{-- BEGIN PAGE LEVEL PLUGINS --}}
@stack('styles')
{{-- END PAGE LEVEL PLUGINS --}}
{{-- BEGIN THEME GLOBAL STYLES --}}
<link href="{{ asset('assets/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
<link href="{{ asset('assets/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
{{-- END THEME GLOBAL STYLES --}}

<link rel="shortcut icon" href="favicon.ico" />