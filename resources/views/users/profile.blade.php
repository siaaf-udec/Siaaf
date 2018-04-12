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
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/pages/css/profile.min.css')}}" rel="stylesheet" type="text/css"/>

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
@section('title', '| Dashboard')

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
@section('page-title', 'Dashboard')
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

@section('page-description', 'Breve descripción de la página')

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
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Perfil'])
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
                    <!-- BEGIN PROFILE SIDEBAR -->
                    <div class="profile-sidebar">
                        <!-- PORTLET MAIN -->
                        <div class="portlet light profile-sidebar-portlet ">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="{{$img}}" class="img-responsive" alt="">
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name"> {{ $user->name }} </div>
                                <div class="profile-usertitle-job"> Developer</div>
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                                <button type="button" class="btn btn-circle red btn-sm">Message</button>
                            </div>
                            <!-- END SIDEBAR BUTTONS -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav">
                                    <li>
                                        <a href="page_user_profile_1.html">
                                            <i class="icon-home"></i> Overview </a>
                                    </li>
                                    <li class="active">
                                        <a href="page_user_profile_1_account.html">
                                            <i class="icon-settings"></i> Account Settings </a>
                                    </li>
                                    <li>
                                        <a href="page_user_profile_1_help.html">
                                            <i class="icon-info"></i> Help </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END MENU -->
                        </div>
                        <!-- END PORTLET MAIN -->
                        <!-- PORTLET MAIN -->

                        <!-- END PORTLET MAIN -->
                    </div>
                    <!-- END BEGIN PROFILE SIDEBAR -->
                    <!-- BEGIN PROFILE CONTENT -->
                    <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet light ">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">Perfil de Usuario</span>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab">Datos Personales</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab">Foto de Perfil</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab">Cambio de Contraseña</a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <!-- PERSONAL INFO TAB -->
                                            <div class="tab-pane active" id="tab_1_1">
                                                {!! Form::open(['id' => 'from_personal_info', 'class' => '', 'url' => '/forms']) !!}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        {!! Field::text(
                                                                'name', $user->name,
                                                                ['label' => 'Nombre', 'auto' => 'off'],
                                                                ['help' => 'Digite su Nombre']) !!}
                                                        {!! Field::date(
                                                                'date_birthday', $user->date_birthday,
                                                                ['label' => 'Fecha de Nacimiento', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                                ['help' => 'Digite su fecha de nacimiento', 'icon' => 'fa fa-calendar']) !!}
                                                        {!! Field::select(
                                                                'identity_type',
                                                                ['T.I' => 'T.I', 'C.C' => 'C.C'],null,
                                                                [ 'label' => 'Tipo de identificación']) !!}
                                                        {!! Field::date(
                                                                'identity_expe', $user->identity_expe,
                                                                ['label' => 'Fecha de Expedición', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                                ['help' => 'Digite su fecha de expedición', 'icon' => 'fa fa-calendar']) !!}
                                                        {!! Field::email(
                                                                'email', $user->email,
                                                                ['label' => 'Correo Electronico', 'auto' => 'off'],
                                                                ['help' => 'Digite su correo electronico']) !!}
                                                    </div>
                                                    <div class="col-md-6">
                                                        {!! Field::text(
                                                                 'lastname', $user->lastname,
                                                                ['label' => 'Apellido', 'auto' => 'off'],
                                                                ['help' => 'Digite su Apellido']) !!}
                                                        {!! Field::select(
                                                                'sexo',
                                                                ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'],null,
                                                                [ 'label' => 'Sexo']) !!}
                                                        {!! Field::text(
                                                                'identity_no', $user->identity_no,
                                                                ['label' => 'Numero de Identificación', 'auto' => 'off'],
                                                                ['help' => 'Numero de Identificación']) !!}
                                                        {!! Field::text(
                                                                'identity_expe_place', $user->identity_expe_place,
                                                                ['label' => 'Lugar de expedición', 'auto' => 'off'],
                                                                ['help' => 'Lugar de expedición']) !!}
                                                        {!! Field::text(
                                                                'phone', $user->phone,
                                                                ['label' => 'Numero Telefonico', 'auto' => 'off'],
                                                                ['help' => 'Digite su numero telefonico']) !!}
                                                    </div>
                                                </div>
                                                <div class="margiv-top-10">
                                                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                                    {!! Form::button('Cancelar', ['class' => 'btn red']) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                            <!-- END PERSONAL INFO TAB -->
                                            <!-- CHANGE AVATAR TAB -->
                                            <div class="tab-pane" id="tab_1_2">
                                                <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                    terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                    skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                    eiusmod. </p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {!!  Field::file('image_profile') !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END CHANGE AVATAR TAB -->
                                            <!-- CHANGE PASSWORD TAB -->
                                            <div class="tab-pane" id="tab_1_3">
                                                <div class="row">
                                                    {!! Form::open(['id' => 'from_password', 'class' => '', 'url' => '/forms']) !!}
                                                    <div class="col-md-6">
                                                        {!! Field::password(
                                                                'password_update',
                                                                ['label' => 'Contraseña'],
                                                                ['help' => 'Digite su contreaseña.']) !!}
                                                        {!! Field::password(
                                                                'password_update_new',
                                                                ['label' => 'Nueva Contraseña', 'disabled'],
                                                                ['help' => 'Digite su nueva contreaseña.']) !!}
                                                        {!! Field::password(
                                                                'password_update_verify',
                                                                ['label' => 'Nueva Contraseña' , 'disabled'],
                                                                ['help' => 'Digite su nueva contreaseña.']) !!}
                                                        {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                            <!-- END CHANGE PASSWORD TAB -->
                                            <!-- PRIVACY SETTINGS TAB -->
                                            <div class="tab-pane" id="tab_1_4">
                                                <form action="#">
                                                    <table class="table table-light table-hover">
                                                        <tr>
                                                            <td> Anim pariatur cliche reprehenderit, enim eiusmod high
                                                                life accusamus..
                                                            </td>
                                                            <td>
                                                                <div class="mt-radio-inline">
                                                                    <label class="mt-radio">
                                                                        <input type="radio" name="optionsRadios1"
                                                                               value="option1"/> Yes
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio">
                                                                        <input type="radio" name="optionsRadios1"
                                                                               value="option2" checked/> No
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Enim eiusmod high life accusamus terry richardson ad
                                                                squid wolf moon
                                                            </td>
                                                            <td>
                                                                <div class="mt-radio-inline">
                                                                    <label class="mt-radio">
                                                                        <input type="radio" name="optionsRadios11"
                                                                               value="option1"/> Yes
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio">
                                                                        <input type="radio" name="optionsRadios11"
                                                                               value="option2" checked/> No
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Enim eiusmod high life accusamus terry richardson ad
                                                                squid wolf moon
                                                            </td>
                                                            <td>
                                                                <div class="mt-radio-inline">
                                                                    <label class="mt-radio">
                                                                        <input type="radio" name="optionsRadios21"
                                                                               value="option1"/> Yes
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio">
                                                                        <input type="radio" name="optionsRadios21"
                                                                               value="option2" checked/> No
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Enim eiusmod high life accusamus terry richardson ad
                                                                squid wolf moon
                                                            </td>
                                                            <td>
                                                                <div class="mt-radio-inline">
                                                                    <label class="mt-radio">
                                                                        <input type="radio" name="optionsRadios31"
                                                                               value="option1"/> Yes
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-radio">
                                                                        <input type="radio" name="optionsRadios31"
                                                                               value="option2" checked/> No
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <!--end profile-settings-->
                                                    <div class="margin-top-10">
                                                        <a href="javascript:;" class="btn red"> Save Changes </a>
                                                        <a href="javascript:;" class="btn default"> Cancel </a>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END PRIVACY SETTINGS TAB -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE CONTENT -->
                </div>
            </div>
        @endcomponent

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
    <script src="{{-- {{ asset('ruta/del/archivo/js') }} --}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript"></script>


    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
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
    <script src="{{ asset('assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).on("ready", function (e) {
            /*$( "#from_personal_info" ).on( "submit", function(e) {
                e.preventDefault();
            });*/
            let $userId = "{{Auth::id()}}";

            let updateProfile = function () {
                    return {
                        init: function () {
                            var route = "{{ route('users.profile.update', ['id' => Auth::id()]) }}";
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id', '{{$user->id}}');
                            formData.append('name', $('input:text[name="name"]').val());
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
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
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
                },
                form = $('#from_personal_info'),
                rules = {
                    name: {minlength: 5, required: true},
                };
            FormValidationMd.init(form, rules, false, updateProfile());

            let updatePassword = function () {
                    return {
                        init: function () {
                            var route = "{{ route('users.profile.updatePassword', ['id' => Auth::id()]) }}";
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('id', '{{$user->id}}');
                            formData.append('password', $('input[name="password_update_new"]').val());
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
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
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
                },
                from_password = $('#from_password'),
                rules_password = {
                    password_update: {
                        minlength: 4, remote: {
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            url: '{{ route('users.check.password') }}',
                            type: 'POST',
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    let password_new = $('input[name="password_update_new"]'),
                                        password_new_verify = $('input[name="password_update_verify"]');
                                    if (response === true) {
                                        password_new.prop("disabled", false);
                                        password_new_verify.prop("disabled", false);
                                    } else {
                                        password_new.prop("disabled", true);
                                        password_new_verify.prop("disabled", true);
                                    }
                                }
                            },
                        }
                    },
                };
            FormValidationMd.init(from_password, rules_password, false, updatePassword());

            /*Carga la foto*/
            $('#file_image').attr("src", "{{$img}}");

            /*Sube imagen automaticamente*/
            $(function () {
                $("#image_profile").on("change", function () {
                    let formData = new FormData(),
                        route = "{{ route('users.profile.update.avatar', ['id' => Auth::id()]) }}",
                        type = 'POST',
                        FileImage = document.getElementById("image_profile");

                    var async = async || false;

                    formData.append("id", $userId);
                    formData.append('image_profile', FileImage.files[0]);
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
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                });
            });

        });
    </script>
@endpush