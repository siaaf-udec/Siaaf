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
<!-- Styles DATATABLE  -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- Styles SWEETALERT  -->
<link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css"/>
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
@section('title', '| Gestion Articulo')

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
@section('page-title', 'Gestion Articulo')
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
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Articulos'])
    <div class="clearfix">
    </div>
    <br>
        <br>
            <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="actions">
                            <a class="btn btn-outline dark create" data-toggle="modal">
                                <i class="fa fa-plus">
                                </i>
                                Nuevo Ariculo
                            </a>
                            <a class="btn btn-outline dark createTipo" data-toggle="modal">
                                <i class="fa fa-plus">
                                </i>
                                Nuevo Tipo de Ariculo
                            </a>
                            <a class="btn btn-outline dark createKit" data-toggle="modal">
                                <i class="fa fa-plus">
                                </i>
                                Nuevo Kit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <br>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                            @slot('columns', [
                                '#' => ['style' => 'width:20px;'],
                                'Tipo',
                                'Nombre',
                                'Kit',
                                'Estado',
                                'Acciones' => ['style' => 'width:90px;']
                            ])
                        @endcomponent
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{-- BEGIN HTML MODAL CREATE --}}
                            <!-- responsive -->
                            <div class="modal fade" data-width="760" id="modal-create-art" tabindex="-1">
                                <div class="modal-header modal-header-success">
                                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    </button>
                                    <h2 class="modal-title">
                                        <i class="glyphicon glyphicon-tv">
                                        </i>
                                        Registrar Articulo
                                    </h2>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['id' => 'from_art_create', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>
                                                {!! Field::select('Seleccione un Tipo de Articulo',
                                                $programas,
                                                ['name' => 'FK_ART_Tipo_id'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::textarea('ART_Descripcion',
                                                                ['label' => 'Descripción', 'required', 'auto' => 'off', 'max' => '255', "rows" => '3'],
                                                                ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right']) !!}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>
                                                {!! Field::select('Seleccione un Kit al que pertecene',
                                               $kit,
                                               ['name' => 'KIT_Nombre'])
                                               !!}
                                            </p>
                                            <p>

                                                    {{$tipo}}



                                            </p>
                                            <p>
                                                {!! Field::select('FK_ART_Estado_id',
                                                ['1' => 'Bueno', '2' => 'Reparación'],null,
                                                ['label' => 'Seleccionar Estado', 'disabled'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::select('FK_ART_Estado_id',
                                                (['0' => 'Select test'] + $estado), null,

                                               ['label' => 'Seleccionar Estado','disabled'])
                                               !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                 {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                            {{-- END HTML MODAL CREATE--}}
                        </div>
                        <div class="col-md-12">
                            {{-- BEGIN HTML MODAL CREATE --}}
                            <!-- responsive -->
                            <div class="modal fade" data-width="680" id="modal-create-tipo" tabindex="-1">
                                <div class="modal-header modal-header-success">
                                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    </button>
                                    <h2 class="modal-title">
                                        <i class="glyphicon glyphicon-tv">
                                        </i>
                                        Registrar Tipo De articulo
                                    </h2>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['id' => 'from_art_tipo_create', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                {!! Field::text('TPART_Nombre',
                                                ['label' => 'Tipo Articulo:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'1'],
                                                ['help' => 'Ingrese Tipo articulo ejemplo: Computador, Cable', 'icon' => 'fa fa-info'])
                                                !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                 {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                            {{-- END HTML MODAL CREATE--}}
                        </div>
                        <div class="col-md-12">
                            {{-- BEGIN HTML MODAL CREATE --}}
                            <!-- responsive -->
                            <div class="modal fade" data-width="680" id="modal-create-kit" tabindex="-1">
                                <div class="modal-header modal-header-success">
                                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    </button>
                                    <h2 class="modal-title">
                                        <i class="glyphicon glyphicon-tv">
                                        </i>
                                        Registrar Kit
                                    </h2>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['id' => 'from_kit_create', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                {!! Field::text('KIT_Nombre',
                                                ['label' => 'Nombre Kit:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'1'],
                                                ['help' => 'Ingrese nombre del Kit', 'icon' => 'fa fa-info'])
                                                !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                 {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                            {{-- END HTML MODAL CREATE--}}
                        </div>
                    </div>
                    @endcomponent
                </br>
            </br>
        </br>
    </br>
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
<!-- SCRIPT SELECT -->
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT DATATABLE -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript">
</script>
<!-- SCRIPT MODAL -->
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
</script>
<!-- SCRIPT PWSTRENGTH -->
<script src="{{ asset('assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Maxlength -->
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Confirmacion Sweetalert -->
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
</script>
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
    var ComponentsSelect2 = function() {

        var handleSelect = function() {

            $.fn.select2.defaults.set("theme", "bootstrap");
            var placeholder = "&nbsp;<i class='fa fa-search'></i>  " + "Seleccionar";
            var placeholderEstado = "&nbsp;&nbsp;Bueno";
            $(".pmd-select2").select2({
                width: null,
                placeholder: placeholder,
                escapeMarkup: function(m) {
                   return m;
                }
            });
            $("#FK_ART_Estado_id").select2({
                width: null,
                placeholder: placeholderEstado,
                value: 1,
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
    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                alwaysShow: true,
                appendToParent: true
            });

        }
        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };
    }();
    $(document).ready(function()
        {
            ComponentsSelect2.init();
            ComponentsBootstrapMaxlength.init();

            $( ".create" ).on('click', function (e) {
            e.preventDefault();           
            $('#modal-create-art').modal('toggle');
            });
            $( ".createTipo" ).on('click', function (e) {
                e.preventDefault();           
                $('#modal-create-tipo').modal('toggle');
                
               
            });
            $( ".createKit" ).on('click', function (e) {
                e.preventDefault();           
                $('#modal-create-kit').modal('toggle');
                
               
            });
            var createTipoArticulo = function () {
                return{
                    init: function () {
                        var route = '{{ route('tipoArticulos.store') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('TPART_Nombre', $('input:text[name="TPART_Nombre"]').val());
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
                                    
                                    $('#modal-create-tipo').modal('hide');
                                    $('#from_art_tipo_create')[0].reset(); //Limpia formulario                                   
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
            //var id_edit = $('input[name="TPART_Nombre"]').val();
            
            $.ajaxSetup({
                headers:
                {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }
            });
            var form_art_tipo_create = $('#from_art_tipo_create');
            var rules_art_tipo_create = {
                TPART_Nombre:{minlength: 3, required: true,
                                remote: {
                                    url: "{{ route('tipoArticulo.validar') }}",
                                    type: "post"
                                }
                            },
                
             };

            var messages= {
                TPART_Nombre: {
                    remote: 'El Tipo de Articulo ya esta en uso.'
                },
            };
            // var mensajes= {
            //     TPART_Nombre:{remote:'Tipo articulo ya existe'},
                
            //  };
            FormValidationMd.init(form_art_tipo_create,rules_art_tipo_create,messages,createTipoArticulo());
            
            $("#from_art_tipo_create").validate({
               onkeyup: false //turn off auto validate whilst typing
<<<<<<< Updated upstream
            }); 
            
=======
            });
            var createKit = function () {
                return{
                    init: function () {
                        var route = '{{ route('kit.store') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('KIT_Nombre', $('input:text[name="KIT_Nombre"]').val());
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

                                    $('#modal-create-kit').modal('hide');
                                    $('#from_kit_create')[0].reset(); //Limpia formulario
                                    location.reload();
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
            $.ajaxSetup({
                headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
            });
            var form_kit_create = $('#from_kit_create');
            var rules_kit_create = {
                KIT_Nombre:{minlength: 3, required: true,
                    remote: {
                        url: "{{ route('kit.validar') }}",
                        type: "post"
                    }
                },

            };

            var messagesKit= {
                KIT_Nombre: {
                    remote: 'El Kit ya Existe.'
                },
            };

            FormValidationMd.init(form_kit_create,rules_kit_create,messagesKit,createKit());

            $("#from_kit_create").validate({
                onkeyup: false //turn off auto validate whilst typing
            });

            var createArticulo = function () {
                return{
                    init: function () {
                        var route = '{{ route('articulo.store') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();

                        formData.append('FK_ART_Tipo_id', $('select[name="FK_ART_Tipo_id"]').val());
                        formData.append('TPART_Nombre', $('select[name="TPART_Nombre"]').val());
                        formData.append('ART_Descripcion',  $('#ART_Descripcion').val());
                        formData.append('FK_ART_Kit_id', $('select[name="FK_ART_Kit_id"]').val());
                        formData.append('ART_Codigo', $('input:text[name="ART_Codigo"]').val());
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

                                    $('#modal-create-art').modal('hide');
                                    $('#from_art_create')[0].reset(); //Limpia formulario
                                    location.reload();
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
            $.ajaxSetup({
                headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
            });
            var from_art_create = $('#from_art_create');
            var rules_arti_create = {
                TPART_Nombre:{ required: true},
                ART_Descripcion:{minlength: 3, required: true},
                KIT_Nombre:{ required: true},
                FK_ART_Estado_id:{ required: true},
                ART_Codigo:{minlength: 3, required: true},


            };


            FormValidationMd.init(from_art_create,rules_arti_create,false,createArticulo());

            $("#from_art_create").validate({
                onkeyup: false //turn off auto validate whilst typing
            });

>>>>>>> Stashed changes

        })
</script>
@endpush
