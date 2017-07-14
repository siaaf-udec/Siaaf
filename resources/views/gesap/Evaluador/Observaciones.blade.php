@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Dashboard')

@section('page-title', 'Dashboard')

@section('page-description', 'Breve descripción de la página')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Observaciones'])

{!! Form::open(['route' => 'min.store', 'method' => 'post', 'novalidate','enctype'=>'multipart/form-data','id'=>'form-register-min']) !!}
                    

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
            <div class="form-group form-md-line-input">
            <div class="input-icon">
                {{ Form::textarea('observacion', null, 
                ['required', 'auto' => 'off','size' => '40x5','class'=>'form-control'],
                [ 'icon' => 'fa fa-user']) }}
                <label for="title" class="control-label">Observaciones</label>
                <span class="help-block"> Ingrese el titulo del proyecto </span>
                <i class=" fa fa-user "></i>
            </div>
            </div>
            
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6" id="file">
            <div class="form-md-line-input" style="margin: 0 0 35px;">
                <div class="fileinput-new input-icon" data-provides="fileinput">    
                        <label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Requerimientos</label>
                    <div class="input-group input-large">
                        <div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                            <i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                            <span class="fileinput-filename"> </span>
                        </div>
                        <span class="input-group-addon btn default btn-file">
                        <span class="fileinput-new"> Select file </span>
                        <span class="fileinput-exists"> Change </span>
                        <input type="file" name="Min" class="" required> </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-xs-12 col-md-8 col-lg-6" id="file">
            <div class="form-md-line-input" style="margin: 0 0 35px;">
                <div class="fileinput-new input-icon" data-provides="fileinput">    
                        <label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Min</label>
                    <div class="input-group input-large">
                        <div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                            <i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                            <span class="fileinput-filename"> </span>
                        </div>
                        <span class="input-group-addon btn default btn-file">
                        <span class="fileinput-new"> Select file </span>
                        <span class="fileinput-exists"> Change </span>
                        <input type="file" name="Min" class="" required> </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
            </div> 
        </div>
        
        
        
        <div class="col-xs-12 col-md-12 col-lg-12">
            {{ Form::reset('Reset', ['class' => 'btn yellow-gold','style'=>'float:right;margin-left:1rem']) }}
            {{ Form::submit('Guardar', ['class' => 'btn green','style'=>'float:right']) }}
        </div>
        
        </div>
        {!! Form::close() !!}


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