<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Registrar Pregunta y Respuesta'])
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
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['id' => 'form_register', 'class' => 'form-horizontal', 'url' => '/forms']) !!}
                <div class="form-group">
                    <div class="col-md-6 col-lg-offset-3 text-left">
                        {!! Field::textarea('pregunta', old('pregunta'), ['required', 'max' => 500, 'min' => '3','label' => 'Pregunta', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-sort-numeric-asc', 'help' => 'Ingrese la Pregunta.','size' => '30']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-lg-offset-3 text-left">
                        {!! Field::textarea('respuesta', old('respuesta'), ['required', 'max' => 500, 'min' => '3','label' => 'Respuesta', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-sort-numeric-asc', 'help' => 'Ingrese la Respuesta.']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-lg-offset-3 text-center">
                        <a href="javascript:;"
                           class="btn btn-outline red button-cancel"><i
                                    class="fa fa-angle-left"></i>
                            Cancelar
                        </a>

                        {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    @endcomponent
</div>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        var $form = $('#form_register');

        var form_rules = {
            pregunta: {required: true,maxlength: 500},
            respuesta: {required: true,maxlength: 500}

        };
        var messages = {};
        var register = function () {
            return {
                init: function () {
                    var route = '{{ route('adminRegist.help.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('pregunta', $('textarea[name="pregunta"]').val());
                    formData.append('respuesta', $('textarea[name="respuesta"]').val());

                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')                                },
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
                                $('#form_register')[0].reset(); //Limpiar formulario
                                UIToastr.init(xhr, response.title, response.message);
                                var route = '{{ route('adminRegist.help.index.ajax') }}';
                                $(".content-ajax").load(route);

                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        }
                    });
                }
            }
        };

        FormValidationMd.init($form, form_rules, messages, register());
        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('adminRegist.help.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>