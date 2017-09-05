@extends('material.layouts.dashboard')
d
@section('page-title', 'Registro de personal:')
@push('styles')
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print' type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins-md.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/css/components-md.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/css/components.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Registro de empleados mediante archivo excel:'])

    @endcomponent
@endsection
@push('plugins')

<script src="{{ asset('assets/global/plugins/fullcalendar/lib/moment.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fullcalendar/lang-all.js') }}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>

<script src="{{asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

@endpush
@push('functions')

<script>
    jQuery(document).ready(function() {
        @if(Session::has('message'))
        var type = "{{Session::get('alert-type','info')}}"
        switch (type) {
            case 'success':
                toastr.options.closeButton = true;
                toastr.success("{{Session::get('message')}}", 'Registro exitoso:');
                break;
        }
    });
    @endif
</script>
@endpush
