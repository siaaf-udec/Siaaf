<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Registrar Ingreso'])
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
                    <div class="col-md-4 col-lg-offset-3 text-left">
                        {!! Field::text('number_document', old('number_document'), ['label' => 'Numero de Documento', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-sort-numeric-asc', 'help' => 'Ingrese el Numero.']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-lg-offset-3 text-left">
                        {!! Field::select(
                        'macro_process',
                        ['1' => 'Estratégico'],null,
                        ['label' => 'MacroProceso' , 'autofocus', 'auto' => 'off']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-lg-offset-3 text-left">
                        {!! Field::select(
                        'process',
                        ['1' => 'Planeación Institucional'],null,
                        ['label' => 'Proceso' , 'autofocus', 'auto' => 'off']) !!}
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
            number_document: {
                minlength: 5, number: true, maxlength: 13, required: true
            },
            macro_process: {required: true},
            process: {maxlength: 25, required: true}

        };
        var messages = {
            number_document: {
                remote: "El número de documento ya ha sido registrado."
            }
        };

        var register = function () {
            return {
                init: function () {
                    var route = '{{ route('administrative.user.registerEntry') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('number_document', $('input[name="number_document"]').val());
                    formData.append('process', $('select[name="process"]').val());

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
                                if(response.title === 'false')
                                {
                                    UIToastr.init('error', '¡Lo sentimos!', 'El usuario no se encuentra registrado.');
                                    App.unblockUI('.portlet-form');
                                }else {
                                    $('#form_register')[0].reset(); //Limpiar formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('administrative.user.index.ajax') }}';
                                    $(".content-ajax").load(route);
                                }

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
        /*Configuracion de Select*/
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('administrative.user.index.ajax') }}';
            $(".content-ajax").load(route);
        });
    });

</script>