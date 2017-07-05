@extends('material.layouts.dashboard')
@section('page-title', 'Lista de Documentos Requeridos:')

@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase"> Lista de Empleados Registrados</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix"> </div><br><br><br>
                <div class="row">
                    <div class="col-md-12">

                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example-table-ajax">
                            <thead>
                            <th>Documento</th>
                            <th>Acción</th>
                            </thead>
                            @foreach($documentos as $documento)
                                <tbody>
                                <td>{{$documento->DCMTP_Nombre_Documento}}</td>
                                <td>{!! link_to_route('talento.humano.document.edit',$title='Consultar', $parameters=$documento->PK_DCMTP_Id_Documento,
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