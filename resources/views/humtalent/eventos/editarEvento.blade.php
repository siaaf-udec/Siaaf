    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de eventos: '])
            <div class="col-md-6">
                <div class="btn-group">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon back">
                        <i class="fa fa-arrow-circle-left"></i>Volver
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::model ($evento,['id'=>'form_event_update','url'=> ['/forms'],'role'=>"form"]) !!}

                    {!! Field::hidden('PK_EVNT_IdEvento',$evento->PK_EVNT_IdEvento) !!}

                    {!! Field::textarea(
                            'EVNT_Descripcion',
                            ['label' => 'Descripción del evento:', 'required', 'auto' => 'off', 'max' => '300', "rows" => '4'],
                            ['help' => 'Escribe una descripción.', 'icon' => 'fa fa-quote-right']) !!}
                    {!! Field::date(
                           'EVNT_Fecha_Inicio',
                           ['label' => 'Fecha de inicio del evento:','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                           ['help' => 'Digite la fecha de inicio de la realización del evento.', 'icon' => 'fa fa-calendar']) !!}
                    {!! Field::date(
                            'EVNT_Fecha_Fin',
                            ['label' => 'Fecha de finalización del evento:','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                            ['help' => 'Digite la fecha de finalización del evento.', 'icon' => 'fa fa-calendar']) !!}
                    {!! Field::text(
                            'EVNT_Hora',
                            ['label'=>'Hora:','class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "hh/mm-", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
                            ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}
                    {!! Field::date(
                            'EVNT_Fecha_Notificacion',
                            ['label' => 'Fecha de notificación :','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                            ['help' => 'Digite la fecha de notificación del evento .', 'icon' => 'fa fa-calendar']) !!}

                    <div class="form-actions">
                        <div class="row">
                            <div class=" col-md-offset-4">
                                {!! Form::submit('Editar',['class' => 'btn blue']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
    </div>
    @endcomponent

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        var updateEvent = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.evento.update') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('EVNT_Descripcion', $('[name="EVNT_Descripcion"]').val());
                    formData.append('EVNT_Fecha_Inicio', $('[name="EVNT_Fecha_Inicio"]').val());
                    formData.append('EVNT_Fecha_Fin', $('[name="EVNT_Fecha_Fin"]').val());
                    formData.append('EVNT_Hora', $('input:text[name="EVNT_Hora"]').val());
                    formData.append('EVNT_Fecha_Notificacion', $('[name="EVNT_Fecha_Notificacion"]').val());
                    formData.append('PK_EVNT_IdEvento', $('[name="PK_EVNT_IdEvento"]').val());
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
                                $('#form_event_update')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('talento.humano.evento.index.ajax') }}';
                                $(".content-ajax").load(route);
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
        var form = $('#form_event_update');
        var formRules = {
            EVNT_Descripcion: {required: true},
            EVNT_Fecha_Inicio: {required: true},
            EVNT_Fecha_Fin: {required: true},
            EVNT_Hora: {required: true},
            EVNT_Fecha_Notificacion: {required: true},
        };
        FormValidationMd.init(form,formRules,false,updateEvent());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.evento.index.ajax') }}';
            $(".content-ajax").load(route);
        });

        $( ".back" ).on('click', function (e) {
            //e.preventDefault();
            var route = '{{ route('talento.humano.evento.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });


</script>
