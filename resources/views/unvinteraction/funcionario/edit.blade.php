@extends('material.layouts.dashboard')


@push('styles')
<link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
@endpush



@section('title', '| Dashboard')


@section('page-title', 'Dashboard')


@section('page-description', 'Breve descripción de la página')


@section('content')
   
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION  DEL CONVENIO'])

            
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                            {!! Form::open (['method'=>'POST', 'route'=> ['Registro_Convenio.store/{{ $convenio->id }}'], 'role'=>"form"]) !!}
                    
                           
                            {!! Field:: text('PK_Convenios',null,['label'=>'id del convenio','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off',],['help' => 'Digita el nunemero de indentificacion del convenio.','icon'=>'fa fa-credit-card']) !!}

                            {!! Field:: text('Nombre',['value'=>'{{ $convenio->Nombre}}','label'=>'nombre del convenio', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Nombre de convenio','icon'=>'fa fa-line-chart'] ) !!}
                        
                            {!! Field::date('Fecha_Inicio',['label'=>'Fecha Inicio','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                        
                            {!! Field::date('Fecha_Fin',['label'=>'Fecha Final','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                        
                      
                            {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                             
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        @endcomponent
    </div>

@endsection



@push('plugins')
<script src="{{-- {{ asset('ruta/del/archivo/js') }} --}}" type="text/javascript"></script>
@endpush


@push('functions')
{{--
    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>
--}}
@endpush