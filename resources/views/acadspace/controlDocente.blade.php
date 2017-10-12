@permission('docentes')
@extends('material.layouts.dashboard')

@section('page-title', 'Control Docente:')
@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de asistencia docentes'])

            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open(['id' => 'form_sol_create', 'class' => '', 'url'=>'/forms']) !!}

                    <div class="form-body">

                        {!! Field::radios('DOC_tipo_practica',['1'=>'Practica Libre', '2'=>'Practica Grupal'], ['list', 'label'=>'Tipo de practica', 'icon'=>'fa fa-user']) !!}

                        {!! Field:: text('codigo',null,['label'=>'Codigo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                         ['help' => 'Digita el codigo o identificacion','icon'=>'fa fa-desktop'] ) !!}

                        {!! Field::select('Seleccione sala entre los dispobiles actualmente:',$aulas,
                                    ['name' => 'SOL_sala'])!!}

                        {!! Field::text('SOL_cant_estudiantes',null,['label'=>'Cantidad de estudiantes:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                ['icon'=>'fa fa-group'] ) !!}

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
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
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">    </script>
<!-- Estandar Mensajes -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">    </script>
<!-- Estandar Datatable -->
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">   </script>
<script>

    jQuery(document).ready(function() {
        /*VALIDACIONES*/
        var form = $('#form_sol_create');
        var rules = {
            SOL_grupo: {minlength: 1, required: true, number: true}
        };
        var messages = {
            SOL_ReqGuia: {
                remote: "hOLA PRUEBA MENSAJE VAL."
            }
        };
        var wizard = $('#form_wizard_1');
        /*Crear Solicitud*/
        var createUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('espacios.academicos.docente.regisAsistenciaDoc') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    //formData.append('DOC_tipo_practica', $('select[name="DOC_tipo_practica"]').val());
                    formData.append('DOC_tipo_practica', $('input[name="DOC_tipo_practica"]:checked').val());
                    formData.append('FK_DOC_id_docente', $('input:text[name="codigo"]').val());
                    formData.append('DOC_sala', $('select[name="SOL_sala"]').val());
                    formData.append('SOL_cant_estudiantes', $('input:text[name="SOL_cant_estudiantes"]').val());

                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_sol_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form_edit = $('#form_sol_create');
        var rules_edit = {
            DOC_tipo_practica: {required: true},
            codigo: {required: true, minlength: 3, maxlength: 20},
            SOL_sala: {required: true},
            SOL_cant_estudiantes: {required: true, number: true}
        };
        FormValidationMd.init(form_edit, rules_edit, false, createUsers());

    });

</script>
@endpush
@endpermission