@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Anteproyectos')


@section('page-title', 'Anteproyectos')


@section('page-description', 'Breve descripción de la página')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet'])

    <a href="{{ route('min.index') }}">Registrar</a>



    @endcomponent
@endsection



@push('plugins')
    <script src="{{-- {{ asset('ruta/del/archivo/js') }} --}}" type="text/javascript"></script>
@endpush

@push('functions')

@endpush