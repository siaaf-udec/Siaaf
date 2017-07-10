@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')

@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase">Recepción de Documentos </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix"> </div><br><br><br>
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open (['method'=>'POST', 'route'=> ['talento.humano.radicarDocumentos'], 'role'=>"form"]) !!}
                        {{ csrf_field() }}
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example-table-ajax">
                                <thead>
                                <th>Número de Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Rol</th>
                                <th>Área o Programa</th>
                                </thead>
                                @foreach($empleados as $empleado)
                                    <tbody>
                                    <td>{{$empleado->PK_PRSN_Cedula}}</td>
                                    <td>{{$empleado->PRSN_Nombres}}</td>
                                    <td>{{$empleado->PRSN_Apellidos}}</td>
                                    <td>{{$empleado->PRSN_Rol}}</td>
                                    <td>{{$empleado->PRSN_Area}}</td>
                                    </tbody>
                                @endforeach
                            </table>
                            {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula) !!}

                            {!!  Field::checkboxes('FK_Personal_Documento',$docs,$seleccion,['list', 'label'=>'Seleccione si fue entregado el Documento']) !!}

                         {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection