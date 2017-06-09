@extends('material.layouts.dashboard')

@push('styles')
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />


<link href="{{ asset('assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet" type="text/css" />

<!-- Editor -->
<link href="{{ asset('assets/global/plugins/codemirror/lib/codemirror.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/codemirror/theme/material.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('title', '| Formularios')

@section('page-title', 'Formularios')

@section('page-description', 'Ejemplo de Formularios que se van a usar.')

@section('content')
    <div class="col-md-12">
        {{-- BEGIN COMPONENTS SAMPLE --}}
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formularios'])
            @slot('actions', [

                'link_upload' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-cloud-upload',
                ],
                'link_wrench' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-trash',
                ],

            ])
            {!! Form::open(['id' => 'form_material', 'class' => '', 'url' => '/forms']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4><strong>Modo de uso:</strong></h4>
                        <p>Los tipos de inputs y su método de creación:</p>
                        <ul>
                            <li>Text: <pre>{<span>!!</span> Field::text('name', 'value', $attributes, $extra) <span>!!</span>}</pre></li>
                            <li>Hidden: <pre>{<span>!!</span> Field::hidden('name', 'value', $attributes, $extra) <span>!!</span>}</pre></li>
                            <li>E-mail: <pre>{<span>!!</span> Field::email('name', 'value', $attributes, $extra) <span>!!</span>}</pre></li>
                            <li>Password: <pre>{<span>!!</span> Field::password('name', 'value', $attributes, $extra) <span>!!</span>}</pre></li>
                            <li>Url: <pre>{<span>!!</span> Field::url('name', 'value', $attributes, $extra) <span>!!</span>}</pre></li>
                            <li>Tel: <pre>{<span>!!</span> Field::tel('name', 'value', $attributes, $extra) <span>!!</span>}</pre></li>
                            <li>Date: <pre>{<span>!!</span> Field::date('name', 'value', $attributes, $extra) <span>!!</span>}</pre></li>
                            <li>File: <pre>{<span>!!</span>  Field::file('name') !!}</pre></li>
                            <li>Checkbox: <pre>{<span>!!</span>  Field::checkbox('name', 'value', $attributes) !!}</pre></li>
                            <hr>
                            <h4><strong>Otros:</strong></h4>
                            <li>Rango de Fechas</li>
                            <li>Fecha y Hora</li>
                            <li>Hora</li>
                            <li>Grupo de Checkboxes</li>
                            <li>Grupo de Radios</li>
                            <li>Image Upload</li>
                            <li>Etiquetas</li>
                            <li>Color</li>
                            <li>TouchSpin</li>
                            <li>Sliders</li>
                            <li>Dropzone</li>
                        </ul>
                        <p>Reciben como parámetros nombre del campo, valor del campo (puede ser nulo), atributos HTML como "label" para asignarle un nombre visible al input, "class, required, autocomplete, maxlength, entre otros"; y un arreglo extra que recibe texto de ayuda e ícono.</p>
                        <textarea id="code_editor_1">$attributes = ['label' => 'Texto para el Label', 'required' => 'required', 'maxlength' => '15'];</textarea>
                        <textarea id="code_editor_2">$extra = ['help' => 'Texto de ayuda', 'icon' => 'fa fa-user'];</textarea>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text(
                            'name',
                            ['label' => 'Texto para el Label', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                            ['help' => 'Texto de ayuda', 'icon' => 'fa fa-user']) !!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::email(
                            'email',
                            ['required', 'auto' => 'off', 'max' => '50'],
                            ['help' => 'Digita un email', 'icon' => 'fa fa-envelope-open']) !!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::password(
                            'password',
                            ['required', 'max' => '20'],
                            ['help' => 'Digita una contraseña.', 'icon' => 'fa fa-key']) !!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::url(
                            'url',
                            ['required', 'auto' => 'off', 'max' => '255'],
                            ['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-link']) !!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::tel(
                            'phone',
                            ['required', 'auto' => 'off', 'max' => '10'],
                            ['help' => 'Digita un número de teléfono.', 'icon' => 'fa fa-phone']) !!}
                        {!! Field::tel(
                            'mobile',
                            ['required', 'auto' => 'off', 'max' => '10'],
                            ['help' => 'Digita un número de celular.', 'icon' => 'fa fa-mobile']) !!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::textarea(
                            'memo',
                            ['label' => 'Mensaje', 'required', 'auto' => 'off', 'max' => '255', "rows" => '3'],
                            ['help' => 'Escribe un mensaje.', 'icon' => 'fa fa-quote-right']) !!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text(
                            'date_range',
                            ['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
                            ['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar']) !!}
                    </div>
                    <div class="col-md-12">
                        <div class="panel-group accordion" id="date-range">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_1"> Método de Creación </a>
                                    </h4>
                                </div>
                                <div id="collapse_3_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <pre>{<span>!!</span> Field::text(
    'date_range',
    ['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
    ['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}</pre>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_2"> Requisitos </a>
                                    </h4>
                                </div>
                                <div id="collapse_3_2" class="panel-collapse collapse">
                                    <div class="panel-body" style="height:200px; overflow-y:auto;">
                                        <p>CSS:</p>
                                        <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                        <p>JS:</p>
                                        <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/moment.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>script<span>></span>
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_3"> Método de Iniciación JS </a>
                                    </h4>
                                </div>
                                <div id="collapse_3_3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="m-heading-1 border-red m-bordered">
                                            <h3>Bootstrap Date Range Picker</h3>
                                            <p> Para más información <a href="http://www.daterangepicker.com" target="_blank">documentación oficial</a>.</p>
                                        </div>
                                        <textarea id="date-range-editor">
    var ComponentsDateTimePickers = function () {

            var handleDateRangePickers = function () {
                if (!jQuery().daterangepicker) {
                    return;
                }
                $('.range-date-time-picker').daterangepicker({
                        opens: (App.isRTL() ? 'left' : 'right'),
                        startDate: moment().subtract('days', 29),
                        endDate: moment(),
                        //minDate: '01/01/2012',
                        //maxDate: '12/31/2014 ',
                        dateLimit: {
                            days: 60
                        },
                        showDropdowns: true,
                        showWeekNumbers: true,
                        timePicker: false,
                        timePickerIncrement: 1,
                        timePicker12Hour: true,
                        ranges: {
                            'Hoy': [moment(), moment()],
                            'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
                            'Últimos 7 Días': [moment().subtract('days', 6), moment()],
                            'Últimos 30 Días': [moment().subtract('days', 29), moment()],
                            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                            'Mes Anterior': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                        },
                        buttonClasses: ['btn'],
                        applyClass: 'green',
                        cancelClass: 'red',
                        format: 'yyyy-mm-dd',
                        separator: ' a ',
                        locale: {
                            applyLabel: '<i class="fa fa-check"></i>',
                            cancelLabel: '<i class="fa fa-times"></i>',
                            fromLabel: 'Desde',
                            toLabel: 'A',
                            customRangeLabel: 'Rango Personalizado',
                            daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                            firstDay: 1
                        }
                    },
                    function (start, end) {
                        $('.range-date-time-picker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    }
                );

                $('.range-date-time-picker span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            }

            return {
                init: function () {
                    handleDateRangePickers();
                }
            };

        }();

    jQuery(document).ready(function() {
        ComponentsDateTimePickers.init();
    });
</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::date(
                            'date',
                            ['required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                            ['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'date-selector'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'date-selector', 'title' => 'Método de Creación', 'link' => 'date_picker_1'])
                                @slot('body')
                                    <pre>
{<span>!!</span> Field::date(
    'date',
    ['required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
    ['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) <span>!!</span>}
</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'date-selector', 'title' => 'Requisitos', 'link' => 'date_picker_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/moment.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>script<span>></span>
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'date-selector', 'title' => 'Método de Inicialización JS', 'link' => 'date_picker_3'])
                                @slot('body')
                                    <div class="m-heading-1 border-green m-bordered">
                                        <h3>Bootstrap DatePicker</h3>
                                        <p> Bootstrap DatePicker
                                            <a href="https://bootstrap-datepicker.readthedocs.org/en/stable/" target="_blank">Documentación Oficial</a>. </p>
                                    </div>
                                    <textarea id="date-editor">
    var ComponentsDateTimePickers = function () {
            var handleDatePickers = function () {
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        rtl: App.isRTL(),
                        orientation: "left",
                        autoclose: true,
                        regional: 'es',
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'yyyy-mm-dd',
                        firstDay: 1,
                        showMonthAfterYear: false,
                        yearSuffix: ''
                    });
                }
            }

            return {
                init: function () {
                    handleDatePickers();
                }
            };
        }();
        jQuery(document).ready(function() {
            ComponentsDateTimePickers.init();
        });
</textarea>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::checkboxes('tags',
                            ['php' => 'PHP', 'python' => 'Python', 'js' => 'JS', 'ruby' => 'Ruby on Rails'],
                            ['php', 'js'], ['inline', 'label' => 'Selecciona un Lenguaje de Proramación']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'checkboxes'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'checkboxes', 'title' => 'Método de Creación', 'link' => 'check_1'])
                                @slot('body')
                                    <p>El atributo <pre class="mt-code">inline</pre> se puede cambiar por <pre class="mt-code">list</pre> según se requiera.</p>
                                    <pre>
{<span>!!</span> Field::checkboxes('name',
                            $options,
                            $checked, ['<pre class="mt-code">inline</pre>', 'label' => 'Texto para el label']) !!}
</pre>
                                    <pre>
{<span>!!</span> Field::checkboxes('tags',
                            ['php' => 'PHP', 'python' => 'Python', 'js' => 'JS', 'ruby' => 'Ruby on Rails'],
                            ['php', 'js'], ['inline', 'label' => 'Selecciona un Lenguaje de Proramación']) !!}
</pre>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::radios('radios',
                            ['a' => 'Activo', 'i' => 'Inactivo'],
                            'i',
                            ['list', 'label' => 'Marca una opción']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'radios'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'radios', 'title' => 'Método de Creación', 'link' => 'radios_1'])
                                @slot('body')
                                    <p>El atributo <pre class="mt-code">inline</pre> se puede cambiar por <pre class="mt-code">list</pre> según se requiera.</p>
                                    <pre>
{<span>!!</span> Field::radios('name',
                            $options,
                            $selected, ['<pre class="mt-code">inline</pre>', 'label' => 'Texto para el label']) !!}
</pre>
                                    <pre>
{<span>!!</span> Field::radios('radios',
                            ['a' => 'Activo', 'i' => 'Inactivo'],
                            'i',
                            ['list', 'label' => 'Marca una opción']) !!}
</pre>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text(
                            'time',
                            ['class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
                            ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'time-selector'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'time-selector', 'title' => 'Método de Creación', 'link' => 'time_picker_1'])
                                @slot('body')
                                    <pre>
{<span>!!</span> Field::text(
    'time',
    ['class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
    ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}
</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'time-selector', 'title' => 'Requisitos', 'link' => 'time_picker_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/moment.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>script<span>></span>
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'time-selector', 'title' => 'Método de Inicialización JS', 'link' => 'time_picker_3'])
                                @slot('body')
                                    <div class="m-heading-1 border-green m-bordered">
                                        <h3>Bootstrap TimePicker</h3>
                                        <p> Bootstrap TimePicker
                                            <a href="http://jdewit.github.io/bootstrap-timepicker/" target="_blank">Documentación Oficial</a>. </p>
                                    </div>
                                    <textarea id="time-editor">
    var ComponentsDateTimePickers = function () {
        var handleTimePickers = function () {

                if (jQuery().timepicker) {

                    $('.timepicker-no-seconds').timepicker({
                        autoclose: true,
                        minuteStep: 5,
                    });

                }
            }

            return {
                init: function () {
                    handleTimePickers();
                }
            };
        }();
        jQuery(document).ready(function() {
            ComponentsDateTimePickers.init();
        });
</textarea>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text(
                            'date_time',
                            ['class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                            ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'date-time-selector'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'date-time-selector', 'title' => 'Método de Creación', 'link' => 'date_time_picker_1'])
                                @slot('body')
                                    <pre>
{<span>!!</span> Field::text(
        'date_time',
        ['class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
        ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar']) !!}
</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'date-time-selector', 'title' => 'Requisitos', 'link' => 'date_time_picker_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/moment.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>script<span>></span>
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'date-time-selector', 'title' => 'Método de Inicialización JS', 'link' => 'date_time_picker_3'])
                                @slot('body')
                                    <div class="m-heading-1 border-green m-bordered">
                                        <h3>Bootstrap DateTimePicker</h3>
                                        <p> Bootstrap DateTimePicker
                                            <a href="http://www.malot.fr/bootstrap-datetimepicker/index.php" target="_blank">Documentación Oficial</a>. </p>
                                    </div>
                                    <textarea id="date-time-editor">
    var ComponentsDateTimePickers = function () {
        var handleDatetimePicker = function () {

                if (!jQuery().datetimepicker) {
                    return;
                }

                $(".date-time-picker").datetimepicker({
                    autoclose: true,
                    isRTL: App.isRTL(),
                    format: "dd MM yyyy - hh:ii",
                    fontAwesome: true,
                    pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
                });
            }

            return {
                init: function () {
                    handleDatetimePicker();
                }
            };
        }();
        jQuery(document).ready(function() {
            ComponentsDateTimePickers.init();
        });
</textarea>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text(
                            'tags',
                            'Amsterdam,Washington,Sydney,Beijing,Cairo',
                            ['class' => 'input-large', 'data-role' => 'tagsinput', 'required', 'auto' => 'off']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'tags_inputs'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'tags_inputs', 'title' => 'Método de Creación', 'link' => 'tagg_1'])
                                @slot('body')
                                    <pre>
{<span>!!</span> Field::text(
        'tags',
        'Amsterdam,Washington,Sydney,Beijing,Cairo',
        ['class' => 'input-large', 'data-role' => 'tagsinput', 'required', 'auto' => 'off'],
        ['help' => 'Selecciona la hora.', 'icon' => '']) !!}
</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'tags_inputs', 'title' => 'Requisitos', 'link' => 'tagg_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::file('image') !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'file_inputs'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'file_inputs', 'title' => 'Método de Creación', 'link' => 'file_1'])
                                @slot('body')
                                    <pre>{<span>!!</span> Field::file('name') !!}</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'file_inputs', 'title' => 'Requisitos', 'link' => 'file_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text(
                            'color',
                            '#14609E',
                            ['class' => 'color-picker', 'data-control' => 'whell', 'required', 'auto' => 'off', 'tpl' => 'themes/bootstrap/fields/extra'],
                            ['help' => 'Selecciona un color.', 'icon' => '']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'color-selector'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'color-selector', 'title' => 'Método de Creación', 'link' => 'color_picker_1'])
                                @slot('body')
                                    <pre>
{<span>!!</span> Field::text(
        'color',
        '#14609E',
        ['class' => 'color-picker', 'data-control' => 'whell', 'required', 'auto' => 'off', 'tpl' => 'themes/bootstrap/fields/color'],
        ['help' => 'Selecciona un color.']) !!}
</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'color-selector', 'title' => 'Requisitos', 'link' => 'color_picker_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>script<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'date-time-selector', 'title' => 'Método de Inicialización JS', 'link' => 'color_picker_3'])
                                @slot('body')
                                    <div class="m-heading-1 border-green m-bordered">
                                        <h3>Bootstrap Color Picker</h3>
                                        <p> Bootstrap Color Picker
                                            <a href="http://labs.abeautifulsite.net/jquery-minicolors/" target="_blank">Documentación Oficial</a>. </p>
                                    </div>
                                    <textarea id="color-editor">
    var ComponentsColorPickers = function() {

        var handleMiniColors = function() {
            $('.color-picker').each(function() {

                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'uppercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom left',
                    change: function(hex, opacity) {
                        if (!hex) return;
                        if (opacity) hex += ', ' + opacity;
                        if (typeof console === 'object') {
                            console.log(hex);
                        }
                    },
                    theme: 'bootstrap'
                });

            });
        }

        return {
            //main function to initiate the module
            init: function() {
                handleMiniColors();
            }
        };

    }();

    jQuery(document).ready(function() {
        ComponentsColorPickers.init();
    });
</textarea>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::select('sizes', ['L' => 'Large', 'S' => 'Small'],
                                            null,
                                            [ 'label' => 'Seleccionar una talla']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'select_inputs'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'select_inputs', 'title' => 'Método de Creación', 'link' => 'select_1'])
                                @slot('body')
                                    <pre>
{<span>!!</span> Field::select('name',
                                $options,
                                $selected,
                                [ 'label' => 'Texto']) !!}
</pre>
                                    <pre>
{<span>!!</span> Field::select('sizes',
                                ['L' => 'Large', 'S' => 'Small'],
                                null,
                                [ 'label' => 'Seleccionar una talla']) !!}
</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'select_inputs', 'title' => 'Requisitos', 'link' => 'select_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/select2/css/select2.min.css') <span>}</span>}" rel="stylesheet" type="text/css" />
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') <span>}</span>}" rel="stylesheet" type="text/css" />
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/select2material/css/pmd-select2.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/select2/js/select2.full.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                                @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'date-time-selector', 'title' => 'Método de Inicialización JS', 'link' => 'select_3'])
                                    @slot('body')
                                        <div class="m-heading-1 border-green m-bordered">
                                            <h3>Bootstrap Select2</h3>
                                            <p> Bootstrap Select2
                                                <a href="https://select2.github.io/examples.html" target="_blank">Documentación Oficial</a>. </p>
                                        </div>
                                        <textarea id="select2-editor">
    var ComponentsSelect2 = function() {

        var handleSelect = function() {

            $.fn.select2.defaults.set("theme", "bootstrap");

            $(".pmd-select2").select2({
                width: null,
                placeholder: "Selecccionar",
            });

        }

        return {
            init: function() {
                handleSelect();
            }
        };

    }();

    jQuery(document).ready(function() {
        ComponentsSelect2.init();
    });
</textarea>
                                    @endslot
                                @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text('touch', '0', ['class' => 'touchspin', 'tpl' => 'themes/bootstrap/fields/extra'], ['help' => 'Rango']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'touch_inputs'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'touch_inputs', 'title' => 'Método de Creación', 'link' => 'touch_1'])
                                @slot('body')
                                    <pre>
{<span>!!</span> Field::select('name',
                                $options,
                                $selected,
                                [ 'label' => 'Texto']) !!}
</pre>
                                    <pre>
{<span>!!</span> Field::select('sizes',
                                ['L' => 'Large', 'S' => 'Small'],
                                null,
                                [ 'label' => 'Seleccionar una talla']) !!}
</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'touch_inputs', 'title' => 'Requisitos', 'link' => 'touch_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/fuelux/js/spinner.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'touch-selector', 'title' => 'Método de Inicialización JS', 'link' => 'touch_3'])
                                @slot('body')
                                    <div class="m-heading-1 border-green m-bordered">
                                        <h3>Bootstrap TouchSpin</h3>
                                        <p> Bootstrap TouchSpin
                                            <a href="http://www.virtuosoft.eu/code/bootstrap-touchspin/" target="_blank">Documentación Oficial</a>. </p>
                                    </div>
                                    <textarea id="touch-editor">
    var ComponentsBootstrapTouchSpin = function() {

        var handleTouchSpin = function() {

            $(".touchspin").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
            });
        }

        return {
            //main function to initiate the module
            init: function() {
                handleTouchSpin();
            }
        };

    }();

    jQuery(document).ready(function() {
        ComponentsBootstrapTouchSpin.init();
    });
</textarea>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text('ion_range', ['class' => 'ion-range', 'label' => 'Sliders']) !!}
                    </div>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'slide_inputs'])
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'slide_inputs', 'title' => 'Método de Creación', 'link' => 'slide_1'])
                                @slot('body')
                                    <pre>{<span>!!</span> Field::text('name', ['class' => 'ion-range', 'label' => 'Texto']) !!}</pre>
                                    <pre>{<span>!!</span> Field::text('ion_range', ['class' => 'ion-range', 'label' => 'Sliders']) !!}</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'slide_inputs', 'title' => 'Requisitos', 'link' => 'slide_2'])
                                @slot('body')
                                    <p>CSS:</p>
                                    <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.css') <span>}</span>}" rel="stylesheet" type="text/css" />
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                    <p>JS:</p>
                                    <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                                @endslot
                            @endcomponent
                            @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'slide-inputs', 'title' => 'Método de Inicialización JS', 'link' => 'slide_3'])
                                @slot('body')
                                    <div class="m-heading-1 border-green m-bordered">
                                        <h3>Bootstrap Slider</h3>
                                        <p> Bootstrap Slider
                                            <a href="https://github.com/IonDen/ion.rangeSlider" target="_blank">Documentación Oficial</a>. </p>
                                    </div>
                                    <textarea id="slider-editor">
    var ComponentsIonSliders = function() {

        var handleIon = function() {

            $(".ion-range").ionRangeSlider({
                type: "double",
                grid: true,
                min: 0,
                max: 1000,
                from: 200,
                to: 800,
                prefix: "$"
            });

        }

        return {
            //main function to initiate the module
            init: function() {
                handleIon();
            }

        };

    }();

    jQuery(document).ready(function() {
        ComponentsIonSliders.init();
    });
</textarea>
                                @endslot
                            @endcomponent
                        @endcomponent
                    </div>
                </div>
                <hr>
                {!! Field::checkbox('accept', '1', ['label' => 'Términos y Condiciones.']) !!}
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12">
                        {{ Form::submit('Enviar', ['class' => 'btn green']) }}
                        {{ Form::button('Cancelar', ['class' => 'btn red']) }}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <hr>
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['id' => 'my-dropzone', 'class' => 'dropzone dropzone-file-area', 'url' => '/forms']) !!}
                    <h3 class="sbold">Arrastra o da click aquí para cargar archivos</h3>
                    <p> This is just a demo dropzone. Selected files are not actually uploaded. </p>
                    {!! Form::close() !!}
                </div>
                <hr>
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.features.accordion.accordion', ['id' => 'dropzone_inputs'])
                        @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'dropzone_inputs', 'title' => 'Método de Creación', 'link' => 'dropzone_1'])
                            @slot('body')
<pre>{<span>!!</span> Form::open(['id' => 'my-dropzone', 'class' => 'dropzone dropzone-file-area', 'url' => '/forms']) !!}
        <span><</span>h3 class="sbold">Arrastra o da click aquí para cargar archivos<span><</span>/h3>
        <span><</span>p> This is just a demo dropzone. Selected files are not actually uploaded. <span><</span>/p>
    {<span>!!</span> Form::close() !!}
</pre>
                            @endslot
                        @endcomponent
                        @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'dropzone_inputs', 'title' => 'Requisitos', 'link' => 'dropzone_2'])
                            @slot('body')
                                <p>CSS:</p>
                                <pre><span>@</span>push('styles')
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/dropzone/dropzone.min.css') <span>}</span>}" rel="stylesheet" type="text/css" />
    <span><</span>link href="<span>{</span>{ asset('assets/global/plugins/dropzone/basic.min.css') <span>}</span>}" rel="stylesheet" type="text/css" />
<span>@</span>endpush</pre>
                                <p>JS:</p>
                                <pre>@</span>push('plugins')
    <span><</span>script src="<span>{</span>{ asset('assets/pages/scripts/form-dropzone.min.js') <span>}</span>}" type="text/javascript"><<span>/</span>scripts<span>></span>
<span>@</span>endpush</pre>
                            @endslot
                        @endcomponent
                        @component('themes.bootstrap.elements.features.accordion.panel', ['id' => 'dropzone-inputs', 'title' => 'Método de Inicialización JS', 'link' => 'dropzone_3'])
                            @slot('body')
                                <div class="m-heading-1 border-green m-bordered">
                                    <h3>Dropzone</h3>
                                    <p> Dropzone
                                        <a href="http://www.dropzonejs.com/" target="_blank">Documentación Oficial</a>. </p>
                                </div>
                                <textarea id="dropzone-editor">
    var FormDropzone = function () {


        return {
            //main function to initiate the module
            init: function () {

                Dropzone.options.myDropzone = {
                    dictDefaultMessage: "",
                    init: function() {
                        this.on("addedfile", function(file) {
                            // Create the remove button
                            var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>Remove</a>");

                            // Capture the Dropzone instance as closure.
                            var _this = this;

                            // Listen to the click event
                            removeButton.addEventListener("click", function(e) {
                              // Make sure the button click doesn't submit the form:
                              e.preventDefault();
                              e.stopPropagation();

                              // Remove the file preview.
                              _this.removeFile(file);
                              // If you want to the delete the file on the server as well,
                              // you can do the AJAX request here.
                            });

                            // Add the button to the file preview element.
                            file.previewElement.appendChild(removeButton);
                        });
                    }
                }
            }
        };
    }();

    jQuery(document).ready(function() {
       FormDropzone.init();
    });
</textarea>
                            @endslot
                        @endcomponent
                    @endcomponent
                </div>
            </div>
        @endcomponent
        {{-- END COMPONENTS SAMPLE --}}
    </div>
@endsection

@push('plugins')
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/fuelux/js/spinner.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>

<!-- Editor -->

<script src="{{ asset('assets/global/plugins/codemirror/lib/codemirror.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/codemirror/addon/edit/closebrackets.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/codemirror/mode/javascript/javascript.js') }}" type="text/javascript"></script>

@endpush

@push('functions')
<script type="text/javascript">
    var ComponentsDateTimePickers = function () {

        var handleDateRangePickers = function () {
            if (!jQuery().daterangepicker) {
                return;
            }
            $('.range-date-time-picker').daterangepicker({
                    opens: (App.isRTL() ? 'left' : 'right'),
                    startDate: moment().subtract('days', 29),
                    endDate: moment(),
                    //minDate: '01/01/2012',
                    //maxDate: '12/31/2014 ',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Hoy': [moment(), moment()],
                        'Ayer': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Últimos 7 Días': [moment().subtract('days', 6), moment()],
                        'Últimos 30 Días': [moment().subtract('days', 29), moment()],
                        'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        'Mes Anterior': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    buttonClasses: ['btn'],
                    applyClass: 'green',
                    cancelClass: 'red',
                    format: 'yyyy-mm-dd',
                    separator: ' a ',
                    locale: {
                        applyLabel: '<i class="fa fa-check"></i>',
                        cancelLabel: '<i class="fa fa-times"></i>',
                        fromLabel: 'Desde',
                        toLabel: 'A',
                        customRangeLabel: 'Rango Personalizado',
                        daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        firstDay: 1
                    }
                },
                function (start, end) {
                    $('.range-date-time-picker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );
            //Set the initial state of the picker label
            $('.range-date-time-picker span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        }

        var handleDatePickers = function () {
            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    autoclose: true,
                    regional: 'es',
                    closeText: 'Cerrar',
                    prevText: '<Ant',
                    nextText: 'Sig>',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                    weekHeader: 'Sm',
                    dateFormat: 'yyyy-mm-dd',
                    firstDay: 1,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                });
            }
        }

        var handleTimePickers = function () {

            if (jQuery().timepicker) {

                $('.timepicker-no-seconds').timepicker({
                    autoclose: true,
                    minuteStep: 5,
                });

                // handle input group button click
                $('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
                    e.preventDefault();
                    $(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
                });

                // Workaround to fix timepicker position on window scroll
                $( document ).scroll(function(){
                    $('#form_modal4 .timepicker-default, #form_modal4 .timepicker-no-seconds, #form_modal4 .timepicker-24').timepicker('place'); //#modal is the id of the modal
                });
            }
        }

        var handleDatetimePicker = function () {

            if (!jQuery().datetimepicker) {
                return;
            }

            $(".date-time-picker").datetimepicker({
                autoclose: true,
                isRTL: App.isRTL(),
                format: "dd MM yyyy - hh:ii",
                fontAwesome: true,
                pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                handleTimePickers();
                handleDatePickers();
                handleDatetimePicker();
                handleDateRangePickers();
            }
        };

    }();

    var ComponentsSelect2 = function() {

        var handleSelect = function() {

            $.fn.select2.defaults.set("theme", "bootstrap");

            $(".pmd-select2").select2({
                width: null,
                placeholder: "Selecccionar",
            });

        }

        return {
            init: function() {
                handleSelect();
            }
        };

    }();

    var ComponentsColorPickers = function() {

        var handleMiniColors = function() {
            $('.color-picker').each(function() {

                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'uppercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom left',
                    change: function(hex, opacity) {
                        if (!hex) return;
                        if (opacity) hex += ', ' + opacity;
                        if (typeof console === 'object') {
                            console.log(hex);
                        }
                    },
                    theme: 'bootstrap'
                });

            });
        }

        return {
            //main function to initiate the module
            init: function() {
                handleMiniColors();
            }
        };

    }();

    var ComponentsBootstrapTouchSpin = function() {

        var handleTouchSpin = function() {

            $(".touchspin").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
            });
        }

        return {
            //main function to initiate the module
            init: function() {
                handleTouchSpin();
            }
        };

    }();

    var ComponentsBootstrapMaxlength = function () {

        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                limitReachedClass: "label label-danger",
                alwaysShow: true
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };

    }();

    var ComponentsIonSliders = function() {

        var handleIon = function() {

            $(".ion-range").ionRangeSlider({
                type: "double",
                grid: true,
                min: 0,
                max: 1000,
                from: 200,
                to: 800,
                prefix: "$"
            });

        }

        return {
            //main function to initiate the module
            init: function() {
                handleIon();
            }

        };

    }();

    var ComponentsCodeEditors = function () {
                @for($i = 1; $i < 3; $i++)
        var handleCodeEditor{{$i}} = function () {
                var myTextArea = document.getElementById('code_editor_{{$i}}');
                var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                    lineNumbers: true,
                    matchBrackets: true,
                    styleActiveLine: true,
                    theme:"material",
                    mode: "javascript",
                    readOnly: true
                });
            };
                @endfor

        var handleDateRange = function () {
                var myTextArea = document.getElementById('date-range-editor');
                var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                    lineNumbers: true,
                    matchBrackets: true,
                    styleActiveLine: true,
                    theme:"material",
                    mode: "javascript",
                    readOnly: true
                });
            };
        var handleDate = function () {
            var myTextArea = document.getElementById('date-editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: "javascript",
                readOnly: true
            });
        };
        var handleTime = function () {
            var myTextArea = document.getElementById('time-editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: "javascript",
                readOnly: true
            });
        };
        var handleDateTime = function () {
            var myTextArea = document.getElementById('date-time-editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: "javascript",
                readOnly: true
            });
        };
        var handleColor = function () {
            var myTextArea = document.getElementById('color-editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: "javascript",
                readOnly: true
            });
        };
        var handleSelect = function () {
            var myTextArea = document.getElementById('select2-editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: "javascript",
                readOnly: true
            });
        };
        var handleTouch = function () {
            var myTextArea = document.getElementById('touch-editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: "javascript",
                readOnly: true
            });
        };
        var handleSlider = function () {
            var myTextArea = document.getElementById('slider-editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: "javascript",
                readOnly: true
            });
        };
        var handleDrop = function () {
            var myTextArea = document.getElementById('dropzone-editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: "javascript",
                readOnly: true
            });
        };

        return {
            init: function () {
                @for($i = 1; $i < 3; $i++)
                handleCodeEditor{{$i}}();
                @endfor
                handleDateRange();
                handleDateTime();
                handleDate();
                handleTime();
                handleColor();
                handleSelect();
                handleTouch();
                handleSlider();
                handleDrop();
            }
        };

    }();

    jQuery(document).ready(function() {
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        ComponentsColorPickers.init();
        ComponentsBootstrapTouchSpin.init();
        ComponentsBootstrapMaxlength.init();
        ComponentsCodeEditors.init();
        ComponentsIonSliders.init();
    });
</script>
@endpush