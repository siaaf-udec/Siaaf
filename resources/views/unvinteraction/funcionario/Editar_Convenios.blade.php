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
                           {!! Form::model ($convenio, ['method'=>'PATCH', 'route'=> ['Mod_Convenios.update', $convenio->PK_Convenios], 'role'=>"form"]) !!}
                        {{ csrf_field() }}
                    
                           
                            {!! Field:: text('PK_Convenios',null,['label'=>'id del convenio','disabled'=>'disabled','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off',],['help' => 'Digita el nunemero de indentificacion del convenio.','icon'=>'fa fa-credit-card']) !!}

                            {!! Field:: text('Nombre',['label'=>'nombre del convenio', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Nombre de convenio','icon'=>'fa fa-line-chart'] ) !!}
                        
                            {!! Field::date('Fecha_Inicio',['label'=>'Fecha Inicio','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                        
                            {!! Field::date('Fecha_Fin',['label'=>'Fecha Final','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                        <div class="form-group">
                                                <label>Estado</label>
                                                <select class="form-control" name="FK_TBL_Estado">
                                                    @if($opciond)
                                                    @foreach($opciond as $row)
                                                    <option value="{{ $row->PK_Estado }}">{{ $row->Estado }}</option>
                                                    @endforeach
                                                    @endif
                                                    
                                                </select>
                                            </div>
                        <div class="form-group">
                                                <label>Sede</label>
                                                <select class="form-control" name="FK_TBL_Sede">
                                                    @if($opcion)
                                                    @foreach($opcion as $row)
                                                    <option value="{{ $row->PK_Sede }}">{{ $row->Sede }}</option>
                                                    @endforeach
                                                    @endif
                                                    
                                                </select>
                                            </div>
                      
                            <div class="form-actions">
                              <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                                    {!! Form::close() !!}
                                    {{ Form::reset('Cancelar', ['class' => 'btn btn-danger']) }}

                                </div>
                            </div>
                        </div>
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