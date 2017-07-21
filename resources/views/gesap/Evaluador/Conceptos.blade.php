@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Dashboard')

@section('page-title', 'Dashboard')

@section('page-description', 'Breve descripción de la página')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Concepto Final'])

<div class="row">
        <div class="col-md-12" style="z-index: 1;">
            <div class="btn-group">
                <a href="{{ route('anteproyecto.index.listjurado') }}">
                    <button id="sample_editable_1_new" class="btn green" > 
                        <i class="fa fa-list"></i>Listar
                    </button>
                </a> 
            </div>
        </div>
    @foreach ($anteproyectos as $anteproyecto)
    {!! Form::open(['route' => 'min.store', 'method' => 'post', 'novalidate','enctype'=>'multipart/form-data','id'=>'form-register-min']) !!}
        {!! Field::hidden('PK_anteproyecto', $anteproyecto->PK_NPRY_idMinr008) !!}
            
            <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
                <div class="form-group">
                    <label class="control-label col-md-2" style="font-size: 14px;color: #888;padding:0px">Anteproyecto:</label>
                    <div class="col-md-10">
                        <p class="" data-display="username"> {{$anteproyecto->NPRY_Titulo}} </p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
                <div class="form-group form-md-line-input">
                    <div class="input-icon">
                        {{ Form::textarea('Observacion Final', null, 
                        ['required', 'auto' => 'off','size' => '40x5','class'=>'form-control'],
                        [ 'icon' => 'fa fa-user']) }}
                        <label for="title" class="control-label">Concepto</label>
                        <span class="help-block"> Ingrese el titulo del proyecto </span>
                        <i class=" fa fa-user "></i>
                    </div>
                </div>
            </div>
        <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
            <h3 class="center">Concepto Final</h3>
        </div>
        <div class="col-xs-12 col-md-12 col-lg-6 col-md-offset-3">
            {!! Field::select('concepto',["1"=>"Aprobado","2"=>"Aplazado","3"=>"Reprobado"],null) !!}
        </div>
        
        <div class="col-xs-12 col-md-12 col-lg-12">
            {{ Form::reset('Reset', ['class' => 'btn yellow-gold','style'=>'float:right;margin-left:1rem']) }}
            {{ Form::submit('Guardar', ['class' => 'btn green','style'=>'float:right']) }}
        </div>
        
        
        {!! Form::close() !!}
    @endforeach
</div>
    @endcomponent
@endsection



@push('plugins')
    <script src="{{asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

@endpush

@push('functions')
<script type="text/javascript">
        jQuery(document).ready(function() {

        });

</script>

@endpush