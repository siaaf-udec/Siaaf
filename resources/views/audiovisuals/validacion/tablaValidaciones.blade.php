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
<link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
<!-- STYLES MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/pluginsbootstrap-editable/bootstrap-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bselect2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>

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
@section('title', '| Tabla Validaciones')

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
@section('page-title', 'Gestion Validaciones')
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

        <!-- BEGIN CONTENT BODY -->
        <div class="col-md-12">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN THEME PANEL -->

            <!-- END THEME PANEL -->


            <!-- END PAGE HEADER-->
            <div class="m-heading-1 border-green m-bordered">
                <h3>X-editable</h3>
                <p> This library allows you to create editable elements on your page. It can be used with any engine (bootstrap, jquery-ui, jquery only) and includes both popup and inline modes. Please try out demo to see how it works. </p>
                <p> For more info please check out
                    <a class="btn red btn-outline" href="https://vitalets.github.io/x-editable/docs.html" target="_blank">the official documentation</a>
                </p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-checkbox-inline">
                        <label class="mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" id="autoopen">&nbsp;Auto-open next field
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" id="inline">&nbsp;Inline editing
                            <span></span>
                        </label>
                        <button id="enable" class="btn green">Enable / Disable</button>
                    </div>
                </div>
            </div>
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Editable Form</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="user" class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td style="width:15%"> Username </td>
                                    <td style="width:50%">
                                        <a href="javascript:;" id="username" data-type="text" data-pk="1" data-original-title="Enter username"> superuser </a>
                                    </td>
                                    <td style="width:35%">
                                        <span class="text-muted"> Simple text field </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> First name </td>
                                    <td>
                                        <a href="javascript:;" id="firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-original-title="Enter your firstname"> </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Required text field, originally empty </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Sex </td>
                                    <td>
                                        <a href="javascript:;" id="sex" data-type="select" data-pk="1" data-value="" data-original-title="Select sex"> </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Select, loaded from js array. Custom display </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Group </td>
                                    <td>
                                        <a href="javascript:;" id="group" data-type="select" data-pk="1" data-value="5" data-source="/groups" data-original-title="Select group"> Admin </a>
                                    </td>
                                    <td>
                                                    <span class="text-muted"> Select, loaded from server.
                                                        <strong>No buttons</strong> mode </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Status </td>
                                    <td>
                                        <a href="javascript:;" id="status" data-type="select" data-pk="1" data-value="0" data-source="/status" data-original-title="Select status"> Active </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Error when loading list items </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Plan vacation? </td>
                                    <td>
                                        <a href="javascript:;" id="vacation" data-type="date" data-viewformat="dd.mm.yyyy" data-pk="1" data-placement="right" data-original-title="When you want vacation to start?"> 25.02.2013 </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Datepicker </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Date of birth </td>
                                    <td>
                                        <a href="javascript:;" id="dob" data-type="combodate" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1" data-original-title="Select Date of birth">
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Date field (combodate) </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Setup event </td>
                                    <td>
                                        <a href="javascript:;" id="event" data-type="combodate" data-template="D MMM YYYY HH:mm" data-format="YYYY-MM-DD HH:mm" data-viewformat="MMM D, YYYY, HH:mm" data-pk="1" data-original-title="Setup event date and time">
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Datetime field (combodate) </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Meeting start </td>
                                    <td>
                                        <a href="javascript:;" id="meeting_start" data-type="datetime" data-pk="1" data-url="/post" data-placement="right" title="Set date & time"> 15/03/2013 12:45 </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Bootstrap datetime </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Comments </td>
                                    <td>
                                        <a href="javascript:;" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-original-title="Enter comments">awesome
                                            <br> user!</a>
                                    </td>
                                    <td>
                                                    <span class="text-muted"> Textarea. Buttons below. Submit by
                                                        <i>ctrl+enter</i>
                                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Type State </td>
                                    <td>
                                        <a href="javascript:;" id="state" data-type="typeahead" data-pk="1" data-placement="right" data-original-title="Start typing State.."> </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Bootstrap 2.x typeahead </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Fresh fruits </td>
                                    <td>
                                        <a href="javascript:;" id="fruits" data-type="checklist" data-value="2,3" data-original-title="Select fruits"> </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Checklist </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Tags </td>
                                    <td>
                                        <a href="javascript:;" id="tags" data-type="select2" data-pk="1" data-original-title="Enter tags"> html, javascript </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Select2 (tags mode) </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Country </td>
                                    <td>
                                        <a href="javascript:;" id="country" data-type="select2" data-pk="1" data-value="BS" data-original-title="Select country"> </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Select2 (dropdown mode) </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Address </td>
                                    <td>
                                        <a href="javascript:;" id="address" data-type="address" data-pk="1" data-original-title="Please, fill address"> </a>
                                    </td>
                                    <td>
                                        <span class="text-muted"> Your custom input, several fields </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td> Notes </td>
                                    <td>
                                        <div id="note" data-pk="1" data-type="wysihtml5" data-toggle="manual" data-original-title="Enter notes">
                                            <h3>WYSIWYG</h3> WYSIWYG means
                                            <i>What You See Is What You Get</i>.
                                            <br> But may also refer to:
                                            <ul>
                                                <li> WYSIWYG (album), a 2000 album by Chumbawamba </li>
                                                <li> "Whatcha See is Whatcha Get", a 1971 song by The Dramatics </li>
                                                <li> WYSIWYG Film Festival, an annual Christian film festival </li>
                                            </ul>
                                            <i>Source:</i>
                                            <a href="http://en.wikipedia.org/wiki/WYSIWYG_%28disambiguation%29"> wikipedia.org </a>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:;" id="pencil">
                                            <i class="fa fa-pencil"></i> [edit] </a>
                                        <br>
                                        <span class="text-muted"> Wysihtml5 (bootstrap only).
                                                        <br> Toggle by another element </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Console
                                <small>(all ajax requests here are emulated)</small>
                            </h3>
                            <div>
                                <textarea id="console" rows="8" style="width: 70%" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->

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
<!-- SCRIPT DATATABLE -->
<script src="{{ asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.mockjax.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>


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

    <script>
        $.fn.editable.defaults.mode = 'inline';
        $(document).ready(function() {
            $('#username').editable({
                type: 'text',
                title: 'Enter username',
                success: function(response, newValue) {
                    userModel.set('username', newValue); //update backbone model
                }
            });
        });
    </script>


@endpush