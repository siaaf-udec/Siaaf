@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Dashboard')


@section('page-title', 'Dashboard')


@section('page-description', 'Breve descripción de la página')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet'])

    <a href="{{ route('min.create') }}">Registrar</a>
        @if($data)
            <table>
                <thead>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{$row->NPRY_Titulo}}</td>
                        <td>{{$row->NPRY_Keywords}}</td>
                        <td>{{$row->NPRY_Duracion}}</td>
                    </tr>
                @endforeach
                </tbody>





            </table>
        @endif



    @endcomponent
@endsection



@push('plugins')
    <script src="{{-- {{ asset('ruta/del/archivo/js') }} --}}" type="text/javascript"></script>
@endpush

@push('functions')

@endpush