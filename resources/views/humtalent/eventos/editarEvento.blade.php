    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de edición de eventos: '])
            @slot('actions', [
                   'link_cancel' => [
                   'link' => '',
                   'icon' => 'fa fa-arrow-left',
                  ],
           ])
            <br><br>
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
                           ['label' => 'Fecha de inicio del evento:','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd"],
                           ['help' => 'Digite la fecha de inicio de la realización del evento.', 'icon' => 'fa fa-calendar']) !!}
                    {!! Field::date(
                            'EVNT_Fecha_Fin',
                            ['label' => 'Fecha de finalización del evento:','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd"],
                            ['help' => 'Digite la fecha de finalización del evento.', 'icon' => 'fa fa-calendar']) !!}
                    {!! Field::text(
                            'EVNT_Hora',
                            ['label'=>'Hora:','class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "hh/mm-", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
                            ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}
                    {!! Field::date(
                            'EVNT_Fecha_Notificacion',
                            ['label' => 'Fecha de notificación :','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd"],
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
<!-- DatatePicker, validation y Toastr Scripts -->
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

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
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        if (jQuery().timepicker)
        {
            $('.timepicker-no-seconds').timepicker({
                autoclose: true,
                minuteStep: 5,
            });
            $('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
                e.preventDefault();
                $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
            });
            $( document ).scroll(function(){
                $('#form_modal4 .timepicker-default, #form_modal4 .timepicker-no-seconds, #form_modal4 .timepicker-24').timepicker('place'); //#modal is the id of the modal
            });
        }
        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                todayHighlight: true,
                autoclose: true,
                language: "es",
            });
            $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
        }
        $( document ).scroll(function(){
            $('#form_modal2 .date-picker').datepicker('place'); //#modal is the id of the modal
        });
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#!();áéíóúñüàè]+$/i.test(value);
        });
        var form = $('#form_event_update');
        var formRules = {
            EVNT_Descripcion: {required: true, letters:true},
            EVNT_Fecha_Inicio: {required: true},
            EVNT_Fecha_Fin: {required: true},
            EVNT_Hora: {required: true},
            EVNT_Fecha_Notificacion: {required: true},
        };
        var formMessage = {
            EVNT_Descripcion: {letters: 'Existen caracteres que no están permitidos'},
        };
        FormValidationMd.init(form,formRules,formMessage,updateEvent());

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
        $( "#link_cancel" ).on('click', function () {
            var route = '{{ route('talento.humano.evento.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });


</script>
