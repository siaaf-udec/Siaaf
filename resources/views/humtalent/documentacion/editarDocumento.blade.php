@extends('material.layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Documento</div>
                    <div class="panel-body">
                        {!! Form::model ($documento, ['method'=>'PUT', 'route'=> ['Document.update', $documento->PK_DCMTP_Id_Documento],'class'=>"form-horizontal", 'role'=>"form"]) !!}
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre Del Documento</label>
                            <div class="col-md-6">
                                {!! Form:: text('DCMTP_Nombre_Documento',null,['class'=> 'form-control'],'required', 'autofocus') !!}
                            </div>
                        </div>
                        {!! Form::submit('Editar',['class'=>'btn blue','btn-icon remove']) !!}
                        {!! Form::close() !!}
                        {!! Form::open ( ['method'=>'DELETE', 'route'=> ['Document.destroy', $documento->PK_DCMTP_Id_Documento],'class'=>"form-horizontal", 'role'=>"form"])  !!}
                        {{ csrf_field() }}
                        {!! Form::submit('Eliminar',['class'=>'btn red','btn-icon remove']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection