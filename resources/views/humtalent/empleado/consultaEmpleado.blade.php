@extends('material.layouts.dashboard')
@section('page-title', 'Buscar Empleado')
@section('content')
    <div class="col-md-12">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de busqueda:'])

                <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                        {!! Form::open (['method'=>'POST', 'route'=> ['talento.humano.buscarCedula'], 'role'=>"form"]) !!}
                        <div class="form-body">
                                {!! Field:: text('PK_PRSN_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control','id'=>'cedula','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['help' => 'Digita el numero de cedula.','icon'=>'fa fa-credit-card'] ) !!}

                        <div class="form-actions">
                            <div class="row">
                                <div class=" col-md-offset-4">
                                    {!! Form::submit('Buscar',['class'=>'btn blue','btn-icon remove']) !!}
                                    {!! Form::reset('Cancelar', ['class' => 'btn btn-danger']) !!}
                                </div>
                            </div>
                        </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endcomponent
        </div>
@endsection
