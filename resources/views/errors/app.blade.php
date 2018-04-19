<!DOCTYPE html>
<!--[if IE 8]> <html lang="{{ config('app.locale') }}" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="{{ config('app.locale') }}" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="{{ config('app.locale') }}"> <!--<![endif]-->
{{-- BEGIN HEAD --}}
    <head>
        <meta charset="utf-8"/>
        <title>{{ config( 'app.name' ) }} @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="{{ config( 'app.description' ) }}" name="description"/>
        <meta content="{{ config( 'app.author', 'Siaaf' ) }}" name="author"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('material.partials.head')

        {{-- BEGIN THEME LAYOUT STYLES --}}
        <link href="{{ asset('assets/pages/css/error.min.css') }}" rel="stylesheet" type="text/css" />
        {{-- END THEME LAYOUT STYLES --}}
    </head>
    <!-- END HEAD -->

    <body class=" page-500-full-page">

        @yield('content')

        {{-- BEGIN SCRIPTS --}}
        @include('material.partials.scripts')
        {{-- END SCRIPTS --}}
    </body>

</html>