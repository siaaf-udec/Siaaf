@extends('material.layouts.dashboard')
@section('page-title', 'Registro de Documentos Requeridos:')
@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase"> Formulario de registro de documentos:  </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix"> </div>
                    {!! Form::open (['method'=>'POST', 'route'=> ['talento.humano.document.store'], 'role'=>"form"]) !!}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-7 col-md-offset-2">
                            <div  class="form-group form-md-line-input">
                                <div class="input-icon">
                                    {!! Field:: text('DCMTP_Nombre_Documento',null,['label'=>'Nombre Del Documento:','class'=> 'form-control','id'=>'name','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                        ['icon'=>' fa fa-credit-card']) !!}
                                    <span class="help-block"> Digita el nombre del Documento. </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class=" col-md-offset-4">
                                 {!! Form::submit('Registrar',['class'=>'btn blue','btn-icon remove']) !!}
                                {!! Form::reset('Cancelar', ['class' => 'btn btn-danger']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
             </div>
        </div>
    </div>
@endsection