@extends('material.layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista Documentos Requeridos</div>
                    <div class="panel-body">

                        <table class="table">
                            <thead>
                            <th>Documento</th>
                            <th>Acción</th>
                            </thead>
                            @foreach($documentos as $documento)
                                <tbody>
                                <td>{{$documento->DCMTP_Nombre_Documento}}</td>
                                <td>{!! link_to_route('Document.edit',$title='Consultar', $parameters=$documento->PK_DCMTP_Id_Documento,
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