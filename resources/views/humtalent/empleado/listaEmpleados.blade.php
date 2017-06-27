@extends('material.layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista Empleados</div>
                    <div class="panel-body">

                            <table class="table">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                </thead>
                                @foreach($empleados as $empleado)
                                <tbody>
                                    <td>{{$empleado->PRSN_Nombres}}</td>
                                    <td>{{$empleado->PRSN_Correo}}</td>
                                    <td>{!! link_to_route('rrhh.edit',$title='Consultar', $parameters=$empleado->PK_PRSN_Cedula,
                                                         $atributes=  ['class' => 'btn blue']) !!}</td>
                                </tbody>
                                @endforeach
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection