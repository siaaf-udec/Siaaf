
@extends('material.layouts.dashboard')

@push('styles')
<link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Registro software')


@section('content')
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de software'])

    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            {!! Form::open (['id'=>'form_soft', 'url' => '/espacios-academicos/soft/create']) !!}
            <div class="form-body">

                {!! Field:: text('nombre_soft',null,
                ['label'=>'Nombre Software:','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                ['help' => 'Digita el nombre','icon'=>'fa fa-desktop'] ) !!}


                {!! Field:: text('version',null,
                ['label'=>'Version','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                ['help' => 'Digita la version.','icon'=>'fa fa-desktop']) !!}

                {!! Field:: text('licencias',null,
                ['label'=>'Cantidad de licencias','class'=> 'form-control', 'autofocus', 'maxlength'=>'2','autocomplete'=>'off'],
                ['help' => 'Digita cantidad de licencias disponibles.','icon'=>'fa fa-user']) !!}

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

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts necesarios para usar plugins
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}

@push('plugins')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
@endpush

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts para inicializar componentes Javascript como
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}
@push('functions')
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>

<script type="text/javascript">

    var createPermissions = function () {
        return {
            init: function () {
                var route = '{{ route('espacios.academicos.soft.store') }}';
                var type = 'POST';
                var async = async || true;

                var formData = new FormData();
                formData.append('nombre_soft', $('input:text[name="nombre_soft"]').val());
                formData.append('version', $('input:text[name="version"]').val());
                formData.append('licencias', $('input:text[name="licencias"]').val());

                $.ajax({
                    url: route,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    cache: false,
                    type: type,
                    contentType: false,
                    data: formData,
                    processData: false,
                    async: async,
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {

                            $('#form_soft')[0].reset(); //Limpia formulario

                            UIToastr.init(xhr , response.title , response.message  );
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 &&  xhr === 'success') {
                            UIToastr.init(xhr, response.title, response.message);
                        }
                    }
                });
            }
        }
    };

    var form_create = $('#form_soft');
    var rules_create = {
        nombre_soft: { minlength: 3, required: true },
        version: {minlength: 1, required: true},
        licencias: {number:true, required: true}
    };
    FormValidationMd.init(form_create,rules_create,false,createPermissions());
</script>
@endpush
@endpermission