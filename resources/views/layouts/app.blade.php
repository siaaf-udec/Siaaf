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
        <meta content="{{ csrf_token() }}" name="csrf-token"/>

        @include('material.partials.head')

    </head>
    {{-- END HEAD --}}
    {{-- BEGIN BODY --}}
    <body class=" login">
        @yield('content')
        {{-- BEGIN SCRIPTS --}}
        @include('material.partials.scripts')
        {{-- END SCRIPTS --}}
        {{-- BEGIN CUSTOM FUNCTIONS --}}
        @stack('functions')
        {{-- END CUSTOM FUNCTIONS --}}
    </body>
    {{-- END BODY --}}
</html>