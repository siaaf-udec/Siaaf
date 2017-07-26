@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
    <link href="{{-- asset('assets/global/plugins/datatables/datatables.min.css') --}}"  rel="stylesheet" type="text/css" />
    <link href="{{-- asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') --}}"  rel="stylesheet" type="text/css" />


@endpush

@section('title', '| Dashboard')


@section('page-title', 'MENU PRINCIPAL')


@section('page-description', 'Breve descripción de la página')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'MENU FUNCIONARIO'])
        <button class="btn blue btn-block btn-outline " onclick=" location.href='http://localhost/siaaf/public/index.php/interaccion-universitaria/Listar_Usuarios' " >Usuarios</button>
        <button class="btn blue btn-block btn-outline " onclick=" location.href='http://localhost/siaaf/public/index.php/interaccion-universitaria/Listar_Convenios' ">Convenios</button>
        
       
    @endcomponent
@endsection



@push('plugins')
    <script src="{{-- {{ asset('ruta/del/archivo/js') }} --}}" type="text/javascript"></script>
    <script src="{{-- {{ asset('assets/global/scripts/datatable.js') }} --}}"  type="text/javascript"></script>
    <script src="{{-- {{ asset('assets/global/plugins/datatables/datatables.min.js') }} --}}"  type="text/javascript"></script>
    <script src="{{-- {{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }} --}}"  type="text/javascript"></script>

@endpush

@push('functions')
<script>

</script>
@endpush