@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('title', '| Dashboard')

@section('page-title', 'Dashboard')

@section('page-description', 'Breve descripción de la página')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet'])

    
    @endcomponent
@endsection



@push('plugins')
    <script src="{{asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script type="text/javascript">
        jQuery(document).ready(function() {

        });

</script>

@endpush