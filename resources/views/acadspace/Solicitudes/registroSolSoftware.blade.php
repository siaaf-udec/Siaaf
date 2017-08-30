@extends('material.layouts.dashboard')

@section('page-title', 'Registro de solicitud:')


@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de solicitud'])

            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['method'=>'POST', 'route'=> ['espacios.academicos.soft.store']]) !!}

                    <div class="form-body">

                        {!! Field:: text('nombre_soft',null,['label'=>'Nombre Software:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita el nombre','icon'=>'fa fa-desktop'] ) !!}


                        {!! Field:: text('version',null,['label'=>'Version','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita la version.','icon'=>'fa fa-desktop']) !!}

                        {!! Field:: text('licencias',null,['label'=>'Cantidad de licencias','class'=> 'form-control', 'autofocus', 'maxlength'=>'2','autocomplete'=>'off'],
                                                                                 ['help' => 'Digita cantidad de licencias necesarias.','icon'=>'fa fa-user']) !!}

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                                    {{ Form::reset('Cancelar', ['class' => 'btn btn-danger']) }}

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

@push('plugins')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script type="text/javascript">
    jQuery(document).ready(function() {
        FormValidationMd.init();
        ComponentsBootstrapMaxlength.init();
    });

</script>
@endpush