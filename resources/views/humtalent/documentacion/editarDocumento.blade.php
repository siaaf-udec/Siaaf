@extends('material.layouts.dashboard')
@section('page-title', 'Documento Registrado:')
@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase"> Datos del Empleado  </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix"> </div>
                        {!! Form::model ($documento, ['method'=>'PUT', 'route'=> ['talento.humano.document.update', $documento->PK_DCMTP_Id_Documento],'class'=>"form-horizontal", 'role'=>"form"]) !!}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-7 col-md-offset-2">
                                <div  class="form-group form-md-line-input">
                                    <div class="input-icon">
                                        {!! Form:: text('DCMTP_Nombre_Documento',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                        <label for="cajaC" class="control-label">Nombre Del Documento:</label>
                                        <span class="help-block"> Digita el nombre nel documento </span>
                                        <i class=" fa fa-list-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                             {!! Form::submit('Editar',['class'=>'btn blue','btn-icon remove']) !!}
                        {!! Form::close() !!}
                        {!! Form::open ( ['method'=>'DELETE', 'route'=> ['talento.humano.document.destroy', $documento->PK_DCMTP_Id_Documento],'class'=>"form-horizontal", 'role'=>"form"])  !!}
                            {{ csrf_field() }}
                            <div class="col-md-50 col-md-offset-6">
                                {!! Form::submit('Eliminar',['class'=>'btn red','btn-icon remove']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection