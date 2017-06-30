@extends('material.layouts.dashboard')

@section('page-title')
    <b class="page-title">Consulta de empleados:<small> Personal docente y administrativo</small></b>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="portlet portlet-sortable light bordered portlet-form">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class=" icon-book-open font-green"></i>
                    <span class="caption-subject bold uppercase"> Consultar Empleados :  </span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="clearfix"> </div>
                {!! Form::open (['method'=>'POST', 'url'=> ['humtalent/empleadolist'],'class'=>'form-horizontal', 'role'=>'form']) !!}
                {{ csrf_field() }}
                <div class="form-actions">
                    <div class="row">
                        <div class=" col-md-offset-2">
                            {!! Form::submit('Listar',['class' => 'btn blue']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                {!! link_to_route('humtalent.empleadolist',$title='Consultar', $atributes=  ['class' => 'btn blue']) !!}
            </div>
        </div>
    </div>
    </div>

@endsection
