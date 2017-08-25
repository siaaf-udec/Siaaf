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
    {{--MODAL--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
    {{--DATEPICKER--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    {{--TOAST--}}
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>

@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta <title></title> de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '|Reserva Por Kit')

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
@section('page-title', 'Reserva Kit')
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

@section('page-description', '')

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
    {{-- Modal static registro programa--}}
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
   <div class="col-md-12">
       <div class="portlet box red">
           <div class="portlet-title">
               <div class="caption">
                   <i class="fa fa-gift"></i>Crear Reservas </div>
               <div class="tools">
                   <a href="javascript:;" class="collapse"> </a>
                   <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                   <a href="javascript:;" class="reload"> </a>
                   <a href="javascript:;" class="remove"> </a>
               </div>
           </div>
           <div class="portlet-body form">
               <div class="form-body">
                   <div class="form-group">

                       <div class="row">
                           {!! Form::open(['id' => 'from_reserva_articulo_create', 'class' => 'mt-repeater']) !!}

                               <h3 class="mt-repeater-title">Formulario Reserva Articulo</h3>
                               <br>
                               <br>
                               <div data-repeater-list="group">
                                   <div class="row">
                                   <div data-repeater-item class="mt-repeater-item">
                                       <!-- jQuery Repeater Container -->
                                       <div class="col-md-12">
                                           <div class="col-md-3">
                                               <div class="mt-repeater-input">
                                                   {!! Field::select('Seleccione un Tipo de Articulo',
                                                        $tipos,
                                                   ['name' => 'PRT_FK_Articulos_id'])
                                                   !!}
                                               </div>
                                           </div>
                                           <div class="col-md-3">
                                               <div class="mt-repeater-input">
                                                   {!! Field::text(
                                                      'PRT_Fecha_Inicio',
                                                      ['class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                                      ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])

                                                    !!}
                                               </div>
                                           </div>
                                           <div class="col-md-3">
                                               <div class="mt-repeater-input">
                                                   {!! Field::text(
                                                      'PRT_Fecha_Fin',
                                                      ['class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                                      ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])

                                                    !!}
                                               </div>
                                           </div>
                                           <div class="col-md-3">
                                               <div class="mt-repeater-input">
                                                   <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                       <i class="fa fa-close"></i> Cancelar</a>
                                               </div>
                                           </div>
                                       </div>
                                       <br><br><br><br>
                                   </div>
                               </div>

                               </div>
                               <div class="col-md-12">

                                       {!! Form::button('Reservar Otro Articulo', ['class' => 'btn btn-warning mt-repeater-add create', 'data-repeater-create']) !!}

                                       {!! Form::submit('Finalizar Reserva', ['class' => 'btn btn-success' ]) !!}

                               </div>
                           {!! Form::close() !!}
                       </div>
                   </div>
               </div>
           </div>
       </div>
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
    <!-- SCRIPT REPEATER -->
    <script src="{{ asset('assets/pages/scripts/form-repeater.min.js') }} " type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-repeater/jquery.repeater.js') }} " type="text/javascript"></script>
    <!-- SCRIPT DATEPICKER -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT Validacion Personalizadas -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT MENSAJES TOAST-->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Maxlength -->
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
    <!-- Estandar Validacion -->
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">
    </script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">
    </script>
    <script>
            var ComponentsDateTimePickers = function () {
                var handleDatetimePicker = function () {
                    if (!jQuery().datetimepicker) {
                        return;
                    }
                    $(".date-time-picker").datetimepicker({
                        autoclose: true,
                        isRTL: App.isRTL(),
                        format: "yyyy-mm-dd hh:ii",
                        fontAwesome: true,
                        pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
                    });
                }
                return {
                    //main function to initiate the module
                    init: function () {
                        handleDatetimePicker();
                    }
                };
            }();

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

            $(document).ready(function()
            {
                $( ".create" ).on('click', function (e) {
                    e.preventDefault();
                    ComponentsDateTimePickers.init();
                    ComponentsSelect2.init();
                });
                ComponentsDateTimePickers.init();
                ComponentsSelect2.init();
                //abre o cierra modal para que el funcionario se registre con el programa
                var abrirModal = JSON.stringify({{$numero}});
                //sino se encuentran registros abrir el modal para registrar
                if( abrirModal == 0 ){
                   $('#static').modal('toggle');
                }


                //funcionario solicita crear una reserva
                var createReserva = function () {
                    return{
                        init: function () {
                            var route = '{{ route('reservaArticulo.store') }}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            var info=$('.mt-repeater').repeaterVal();
                            info = JSON.stringify(info);
                            formData.append('info', info);
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
                               var from_res_create = $('#from_reserva_articulo_create');
                var rules_res_create = {
                    FK_ART_Tipo_id:{ required: true},
                    //validaciones campos fechas
                    Recibir_Reserva:{required: true},
                    Devolver_Reserva:{ required: true},



                };
                FormValidationMd.init(from_res_create,rules_res_create,false,createReserva());
                //fin solicitud reserva

                //inicio de registrar funcionario audivisuales con programa
                var createPrograma = function () {
                    return{
                        init: function () {
                            //aqui toca guardar eso con auth id
                            var route = '{{ route('crearFuncionarioPrograma.storePrograma') }}';
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
                                        //table.ajax.reload();
                                        $('#static').modal('hide');
                                        $('#from_programa')[0].reset(); //Limpia formulario
                                        //$(":password").pwstrength("forceUpdate");
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

        </script>

@endpush