{{--
|--------------------------------------------------------------------------
| Extends
|--------------------------------------------------------------------------
|
| Hereda los estilos y srcipts de la de la plantilla original.
| Es la base para todas las páginas que se deseen crear.
|
--}}
@extends('layouts.app')

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
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('assets/pages/css/login-5.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
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
@section('title', '| Login')

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
    <!-- BEGIN : LOGIN PAGE 5-1 -->
    <div class="user-login-5">
        <div class="row bs-reset">
            <div class="col-md-6 bs-reset mt-login-5-bsfix">
                <div class="login-bg" style="background-image:url({{ asset('assets/pages/img/login/N1.jpeg') }})">
                    <img class="login-logo" src="{{ asset('assets/pages/img/login/siaaf.png') }}"/></div>
            </div>
            <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                <div class="login-content">
                    <h1>{{ $title or config('app.name') }}</h1>
                    <p> {{ $description or config('app.description') }} </p>
                    {!! Form::open(['role' => 'form', 'id' => 'form-login', 'novalidate', 'method' => 'POST', 'url' => route('login')]) !!}
                    @if (Auth::guest())
                        <div class="form-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    {!! Field::email('email', old('email'), ['required', 'max' => 60, 'label' => 'Correo', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-envelope-o', 'help' => 'Digita un correo.']) !!}
                                </div>
                                <div class="col-xs-6">
                                    {!! Field::password('password', ['required', 'label' => 'Contraseña'], ['icon' => 'fa fa-key', 'help' => 'Digita la contreaseña.']) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="rem-password">
                                {!! Field::checkbox('remember', old('remember'), ['label' => 'Recordarme', old('remember') ? 'checked' : '']) !!}
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            {{ Form::submit('Ingresar', ['class' => 'btn green']) }}
                        </div>
                        <div class="col-sm-12 text-right">
                            <div class="forgot-password">
                                <a href="javascript:;" id="forget-password" class="forget-password">
                                    ¿Se te olvidó tu contraseña?</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                <!-- END : LOGIN PAGE 5-1 -->

                    <!-- BEGIN FORGOT PASSWORD FORM -->
                    {!! Form::open(['role' => 'form', 'id' => 'form-forget', 'class' => 'forget-form', 'novalidate', 'method' => 'POST', 'url' => route('login')]) !!}
                    <h3 class="font-green">¿Se te olvidó tu contraseña ?</h3>
                    <p>Introduzca su dirección de correo electrónico a continuación para restablecer su contraseña. </p>
                    {!! Field::email('email-forget', old('email'), ['required', 'max' => 60, 'label' => 'Correo', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-envelope-o', 'help' => 'Digita un correo.']) !!}
                    <div class="form-actions">
                        {{ Form::button('Cancelar', ['id' => 'back-btn', 'class' => 'btn green btn-outline']) }}
                        {{ Form::submit('Enviar', ['class' => 'btn btn-success uppercase pull-right']) }}
                    </div>
                {!! Form::close() !!}
                <!-- END FORGOT PASSWORD FORM -->
                </div>
                <div class="login-footer">
                    <div class="row bs-reset">
                        <div class="col-xs-5 bs-reset">
                            <ul class="login-social">
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="icon-social-dribbble"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-7 bs-reset">
                            <div class="login-copyright text-right">
                                <p>Copyright © {{ $footer or config('app.author') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/backstretch/jquery.backstretch.min.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/pages/scripts/login-5.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>

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
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    @if($errors->has('read'))
        <script type="text/javascript">
            UIToastr.init('error', '{{$errors->first('read')}}', '');
        </script>
    @endif
    <script type="text/javascript">
        var rules = {
            email: {email: true, required: true},
        };
        var messages = {};
        var form = $('#form-forget');
        jQuery(document).ready(function () {
            FormValidationMd.init(form, rules, messages);
        });
    </script>
@endpush