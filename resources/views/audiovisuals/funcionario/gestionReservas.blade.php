{{--
|--------------------------------------------------------------------------
| Extends
|--------------------------------------------------------------------------
|
| Hereda los estilos y srcipts de la de la plantilla original.
| Es la base para todas las páginas que se deseen crear.
|
--}}
@extends('material.layouts.dashboard')

{{--
|--------------------------------------------------------------------------
| Styles
|--------------------------------------------------------------------------
|
| Inyecta CSS requerido ya sea por un JS o para un elemento específico
|
| @push('styles')
|
| @endpush
--}}
@push('styles')
<!-- STYLES SELECT -->
<link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css"/>
<!-- STYLES MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta
<title>
</title>
de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '| Gestion Reservas')

{{--
|--------------------------------------------------------------------------
| Page Title
|--------------------------------------------------------------------------
|
| Inyecta el título a la sección del contenido de página.
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-title', $miVariable)
| @section('page-title', 'Título')
|
|
--}}
@section('page-title', 'Gestion Reservas')
{{--
|--------------------------------------------------------------------------
| Page Description
|--------------------------------------------------------------------------
|
| Inyecta una breve descripción a la sección del contenido de página.
| Recibe texto o variables de los controladores o se puede dejar sin datos
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-description', $miVariable)
| @section('page-description', 'Título')
--}}

@section('page-description', 'Solicita y Cancela una reserva')

{{--
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
|
| Inyecta el contenido HTML que se usará en la página
|
| @section('content')
|
| @endsection
--}}
@section('content')
    {{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    {{-- BEGIN HTML MODAL CREATE --}}
    <!-- static -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="static" tabindex="-1">
        <div class="modal-header modal-header-success">
            <h3 class="modal-title">
                <i class="glyphicon glyphicon-user">
                </i>
                Seleccionar Programa
            </h3>
        </div>
        <div class="modal-body">
            {!! Form::open(['id' => 'from_programa', 'class' => '', 'url' => '/forms']) !!}
            <div class="row">
                <div class="col-md-12">
                    <p>
                        {!! Field::select('Seleccione Programa',$programas,    
                        ['name' => 'FK_FUNCIONARIO_Programa'])
                        !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    {{-- END HTML MODAL CREATE--}}
</div>
{{-- END HTML SAMPLE --}}
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
<!-- SCRIPT MODAL -->
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
</script>
<!-- SCRIPT SELECT -->
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Maxlength -->
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Personalizadas -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript">
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
<!-- Estandar Validacion -->
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {    
        ComponentsSelect2.init();
        
        //consulta si el programa esta seleccionado o esta vacio    
        $('#static').modal('toggle');

        var createPrograma = function () {
            return{
                init: function () {
                    //aqui toca guardar eso con auth id
                    var route = '{{ route('funcionario.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    //formData.append('id', $('select[name="FK_FUNCIONARIO_Programa"]').val());
                    formData.append('FK_FUNCIONARIO_Programa', $('select[name="FK_FUNCIONARIO_Programa"]').val());
                    
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

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                $('#modal-create-funcionario').modal('hide');
                                $('#from_funcionario_create')[0].reset(); //Limpia formulario
                                $(":password").pwstrength("forceUpdate");
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

        var form_create = $('#from_programa');
        var rules_create = {
          
            FK_FUNCIONARIO_Programa:{required: true}
        };
        FormValidationMd.init(form_create,rules_create,false,createPrograma());


    });
    
    var ComponentsSelect2 = function() {

        var handleSelect = function() {

            $.fn.select2.defaults.set("theme", "bootstrap");
            var placeholder = "<i class='fa fa-search'></i>  " + "Seleccionar";
            $(".pmd-select2").select2({
                width: null,
                placeholder: placeholder,
                escapeMarkup: function(m) { 
                   return m; 
                }
            });

        }

        return {
            init: function() {
                handleSelect();
            }
        };

    }();
</script>
@endpush
