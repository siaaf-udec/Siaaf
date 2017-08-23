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

    @routes {{-- https://github.com/tightenco/ziggy --}}

    {{-- BEGIN THEME LAYOUT STYLES --}}
    <link href="{{ asset('assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/layouts/layout2/css/custom.css') }}" rel="stylesheet" type="text/css" />
    {{-- END THEME LAYOUT STYLES --}}
</head>
{{-- END HEAD --}}
{{-- BEGIN BODY --}}
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md page-boxed page-sidebar-fixed">
    {{-- BEGIN HEADER --}}
        @include('material.partials.header')
    {{-- END HEADER --}}
    {{-- BEGIN HEADER & CONTENT DIVIDER --}}
        <div class="clearfix"> </div>
    {{-- END HEADER & CONTENT DIVIDER --}}
        <div class="container">
            {{-- BEGIN PAGE CONTAINER --}}
            <div class="page-container">
                {{-- BEGIN SIDEBAR --}}
                @include('material.partials.sidebar')
                {{-- END SIDEBAR --}}
                {{-- BEGIN CONTENT --}}
                <div class="page-content-wrapper">
                    {{-- BEGIN CONTENT BODY --}}
                    <div class="page-content">
                        {{-- BEGIN PAGE HEADER --}}
                        {{-- BEGIN THEME PANEL --}}
                        {{--@ include('material.partials.theme-panel')--}}
                        {{-- END THEME PANEL --}}
                        {{-- BEGIN PAGE TITLE & DESCRIPTION --}}
                        <h1 class="page-title"> @yield('page-title')
                            <small>@yield('page-description')</small>
                        </h1>
                        {{-- END PAGE TITLE & DESCRIPTION --}}
                        {{-- BEGIN BREADCRUMB --}}
                        @include('material.partials.breadcrumb')
                        {{-- END BREADCRUMB --}}
                        {{-- END PAGE HEADER --}}
                        {{-- BEGIN CUSTOM CONTENT --}}
                        <div class="row content-ajax" id="sortable_portlets">
                            @yield('content')
                        </div>
                        {{-- END CUSTOM CONTENT --}}
                    </div>
                    {{-- BEGIN CONTENT BODY --}}
                </div>
                {{-- END CONTENT --}}
                {{-- BEGIN QUICK SIDEBAR --}}
                @include('material.partials.quick-sidebar')
                {{-- END QUICK SIDEBAR --}}
            </div>
            {{-- END PAGE CONTAINER --}}
            {{-- BEGIN FOOTER --}}
            @include('material.partials.footer')
            {{-- END FOOTER --}}
        </div>
    {{-- BEGIN SCRIPTS --}}
        @include('material.partials.scripts')
    {{-- END SCRIPTS --}}
    {{-- BEGIN CUSTOM FUNCTIONS --}}
        @stack('functions')
    {{-- END CUSTOM FUNCTIONS --}}
</body>
{{-- END BODY --}}
</html>