@extends('material.layouts.dashboard')

@section('page-title', 'Registro de solicitud de Formatos Academicos:')

@section('content')
    <div class="col-md-12">
    {!! Form::open (['route'=> ['espacios.academicos.formacad.store'], 'method'=>'POST', 'files' => true]) !!}
        <div class="col-md-7 col-md-offset-2">
    {!! Field:: text('txt_nombre',null,['label'=>'Nombre Archivo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['help' => 'Digita el archivo','icon'=>'fa fa-desktop'] ) !!}


    {!! Field:: text('txt_descripcion',null,['label'=>'Descripcion','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                     ['help' => 'Digita la descripcion.','icon'=>'fa fa-user']) !!}


    {!!Form::label('l_archivo','Archivo:') !!}
    {!!Form::file('path')!!}
        </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                        {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                        {{ Form::reset('Cancelar', ['class' => 'btn btn-danger']) }}

                    </div>
                </div>
            </div>

    {!! Form::close() !!}
    </div>
@endsection
