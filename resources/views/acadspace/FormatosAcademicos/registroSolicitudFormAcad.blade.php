{{--@permission('secret')--}}

{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Enviar Formato'])
        @slot('actions', [

        'link_upload' => [
        'link' => '',
        'icon' => 'icon-cloud-upload',
        ],
        'link_wrench' => [
        'link' => '',
        'icon' => 'icon-wrench',
        ],
        'link_trash' => [
        'link' => '',
        'icon' => 'icon-trash',
        ],

        ])
        {{--Estilos a usar--}}
        <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
              rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css"/>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light " id="form_wizard_1">
                    <div class="portlet-body form">
                        {{--Formulario y campos necesarios--}}
                        {!! Form::open(['id' => 'form_sol_create', 'class' => '', 'url' => 'espacios-academicos/formacad/store']) !!}
                        <div class="form-body">
                            <div class="col-md-10 col-md-offset-1">

                                {!! Field:: text('txt_nombre',null,['label'=>'Nombre Archivo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                                         ['help' => 'Digita el archivo','icon'=>'fa fa-desktop'] ) !!}

                                {!! Field:: text('txt_descripcion',null,['label'=>'Descripcion','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                                 ['help' => 'Digita la descripcion.','icon'=>'fa fa-user']) !!}

                                {!! Field:: text('txt_email',null,['label'=>'Correo destinatario','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                ['help' => 'Ingrese el correo.','icon'=>'fa fa-user']) !!}

                                {!!  Field::file('path') !!}
                                {{--{!! Field:: file('path',null,['label'=>'Archivo a enviar','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                ['help' => 'El archivo debe ser pdf.','icon'=>'fa fa-user']) !!}--}}
                            </div>
                            {{--<div class="col-md-12">
                                {!! Form::open(['id' => 'my-dropzone', 'class' => 'dropzone dropzone-file-area', 'url' => '/forms']) !!}
                                    <h3 class="sbold">Arrastra o da click aquí para cargar archivos</h3>
                                    <p> This is just a demo dropzone. Selected files are not actually uploaded. </p>
                                {!! Form::close() !!}
                            </div>--}}
                            <div class="form-actions">
                                <div class="rozw">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="javascript:;" class="btn btn-outline red button-cancel">
                                            Cancelar
                                        </a>
                                        {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
</div>
{{-- END HTML SAMPLE --}}



<!--//mensaje validacion-->
<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/main/scripts/form-wizard.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/dropzone.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        /*VALIDACIONES*/
        var form = $('#form_sol_create');
        //Reglas para validar formulario
        var rules = {
            txt_nombre: {minlength: 1, required: true},
            txt_descripcion: {minlength: 1, required: true},
            txt_email: {email: true},
            path: {required: true}
        };
        //mensajes de validacion
        var messages = {
            txt_nombre: {
                remote: "Asigne nombre a formato."
            },
            txt_descripcion: {
                remote: "Descripcion del formato academico."
            },
            txt_email: {
                remote: "Digite un correo valido."
            },
            path: {
                remote: "El archivo debe ser pdf."
            }

        };
        var wizard = $('#form_wizard_1');
        /*Crear Solicitud*/

        var createUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('espacios.academicos.formacad.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    //obtener valor
                    var formData = new FormData();
                    formData.append('nombre', $('input:text[name="txt_nombre"]').val());
                    formData.append('descripcion', $('input:text[name="txt_descripcion"]').val());
                    formData.append('correo', $('input:text[name="txt_email"]').val());

                    var FileImage = document.getElementById("path");
                    formData.append('path', FileImage.files[0]);

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
                                var route = '{{ route('espacios.academicos.formacad.indexajax') }}';
                                $(".content-ajax").load(route);
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
            txt_nombre: {minlength: 1, required: true},
            txt_descripcion: {minlength: 1, required: true},
            txt_email: {email: true},
            path: {required: true}
        };
        FormValidationMd.init(form_edit, rules_edit, false, createUsers());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('espacios.academicos.formacad.indexajax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>
{{--@endpermission--}}

