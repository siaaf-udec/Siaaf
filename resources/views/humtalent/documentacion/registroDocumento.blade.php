<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de documentos'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
            ],
        ])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                {!! Form::open (['id'=>'form_document_create', 'url'=> ['/forms'], 'role'=>"form"]) !!}
                {!! Field:: text('DCMTP_Nombre_Documento',null,['label'=>'Nombre Del Documento:','class'=> 'form-control','id'=>'name', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                            ['help'=>'Digite el nombre del Documento.','icon'=>' fa fa-credit-card']) !!}

                {!! Field::select('DCMTP_Tipo_Documento',
                        ['EPS' => 'EPS', 'Caja de compensación' => 'Caja de compensación'],
                        null,
                        [ 'label' => 'Seleccionar el tipo de documento']) !!}
                <div class="form-actions">
                    <div class="row">
                        <div class=" col-md-offset-4">
                            <a href="javascript:;" class="btn btn-outline red button-cancel"><i
                                        class="fa fa-angle-left"></i>
                                Cancelar
                            </a>
                            {!! Form::submit('Registrar',['class'=>'btn blue','btn-icon remove']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
</div>
@endcomponent


<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

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

        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

        var createDoc = function () {
            return {
                init: function () {
                    var route = '{{ route('talento.humano.document.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('DCMTP_Nombre_Documento', $('input:text[name="DCMTP_Nombre_Documento"]').val());
                    formData.append('DCMTP_Tipo_Documento', $('select[name="DCMTP_Tipo_Documento"]').val());
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
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_document_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('talento.humano.document.index.ajax') }}';
                                $(".content-ajax").load(route);
                                console.log(request);
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
        var form = $('#form_document_create');
        var formRules = {
            DCMTP_Nombre_Documento: {required: true},
            DCMTP_Tipo_Documento: {required: true},
        };
        FormValidationMd.init(form, formRules, false, createDoc());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.document.index.ajax') }}';
            $(".content-ajax").load(route);
        });
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.document.index.ajax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>