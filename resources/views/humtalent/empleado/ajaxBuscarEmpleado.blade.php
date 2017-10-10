<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Busqueda del empleado para radicar documentación'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                {!! Form::open(['id' => 'from_users_browse', 'class' => '', 'url' => '/forms']) !!}
                {!! Field:: text('PK_PRSN_Cedula',null,['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control','id'=>'cedula','required', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                 ['help'=>'Digite el número de cedula.','icon'=>'fa fa-credit-card'] ) !!}

                {!! Field::select('tipoRadicacion',
                            ['EPS' => 'EPS', 'Caja de compensación' => 'Caja de compensación'],
                            'EPS',
                            [ 'label' => 'Seleccionar el tipo de radicación']) !!}

                <div class="form-actions">
                    <div class="row">
                        <div class=" col-md-offset-4">
                            {!! Form::submit('Buscar',['class' => 'btn blue']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endcomponent
</div>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        var browseUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('talento.humano.listarDocsRad') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('PK_PRSN_Cedula', $('input:text[name="PK_PRSN_Cedula"]').val());
                    formData.append('tipoRadicacion', $('[name="tipoRadicacion"]').val());

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

                        },
                        success: function (route) {

                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init('error', response.title, response.message);
                            }
                            else {
                                $(".content-ajax").html(route);
                            }

                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var formBrowse = $('#from_users_browse');
        var rulesBrowse = {
            PK_PRSN_Cedula: {minlength: 3, required: true}
        };
        FormValidationMd.init(formBrowse, rulesBrowse, false, browseUsers());
    });

</script>
