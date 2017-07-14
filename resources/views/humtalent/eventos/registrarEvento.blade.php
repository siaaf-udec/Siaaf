@extends('material.layouts.dashboard')
@push('styles')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title','Creación de eventos:')


@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de eventos: '])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    {!! Form::open (['id'=>'form_eventos','method'=>'POST', 'route'=> ['talento.humano.evento.store']]) !!}
                    {!! Field::textarea(
                            'EVNT_Descripcion',
                            ['label' => 'Descripción del evento:', 'required', 'auto' => 'off', 'max' => '300', "rows" => '4'],
                            ['help' => 'Escribe una descripción.', 'icon' => 'fa fa-quote-right']) !!}
                    {!! Field::date(
                            'EVNT_Fecha',
                            ['label' => 'Fecha del evento:','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                            ['help' => 'Digita la fecha de realización del evento.', 'icon' => 'fa fa-calendar']) !!}
                    {!! Field::text(
                            'EVNT_Hora',
                            ['label'=>'Hora:','class' => 'timepicker timepicker-no-seconds', 'data-date-format' => "hh/mm-", 'data-date-start-date' => "+0d", 'required', 'auto' => 'off'],
                            ['help' => 'Selecciona la hora.', 'icon' => 'fa fa-clock-o']) !!}

                    <br><br><br><br>
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'], ['class'=>'display'])
                        @slot('columns', [
                            '#',
                            'Nombres',
                            'Apellidos',
                            'Cédula',
                            'Email',
                            'Rol ',
                            'Área',
                            'Acciones'
                        ])
                    @endcomponent


                    <div class="form-actions">
                        <div class="row">
                            <div class=" col-md-offset-4">
                                {!! Form::submit('Registrar',['class' => 'btn blue']) !!}
                                {!! Form::reset('Cancelar', ['class' => 'btn btn-danger']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                    <button id="button">Ver</button>
                </div>
            </div>
    </div>
    @endcomponent

@endsection
@push('plugins')
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
<script>
            @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'success':
            toastr.options.closeButton = true;
            toastr.success("{{Session::get('message')}}",'Creación de evento exitoso:');
            break;
    }
    @endif
jQuery(document).ready(function () {

        var  url;
       // table = $('#lista-empleados');
        url = "{{ route('talento.humano.tablaEmpleados')}}";
        $.fn.dataTable.ext.errMode = 'throw';
        /*/para que no le salga errores al funcionario*/


        var table=$('#lista-empleados').DataTable({

            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todo"]
            ],
            responsive: true,
            colReorder: false,
            processing: true,
            serverSide: false,
           // select: {style: 'multi'
            // },
            ajax: url,
            language: {
                "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            columns: [

                {data: 'DT_Row_Index'},
                {data: 'PRSN_Nombres', name: 'Nombres'},
                {data: 'PRSN_Apellidos', name: 'Apellidos'},
                {data: 'PK_PRSN_Cedula', name: 'Cédula'},
                {data: 'PRSN_Correo', name: 'Correo Electronico'},
                {data: 'PRSN_Rol', name: 'Rol'},
                {data: 'PRSN_Area', name: 'Área'},
    //'<a href="javascript:;" " class="btn blue"><i class="fa fa-check"></i></a>',

                {
                    data: "PK_PRSN_Cedula",
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    searchable: false,
                    exportable: false,
                    printable: false,
                    className: '',
                    render: function (data, type, full, meta) {
                        return '<a href="javascript:;" " class="btn blue"><i class="fa fa-check"></i></a>';
                    },
                    responsivePriority: 2
                }
            ],
            buttons: [
                {
                    extend: 'colvis',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis',
                    text: '<i class="fa fa-bars"></i>'
                },
                {
                    text: '<i class="fa fa-refresh"></i>',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
                    action: function (e, dt, node, config) {
                        dt.ajax.reload();
                    }
                }

            ],
            pageLength: 10,
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        });
        $('#lista-empleados tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');

        } );
        $('#button').click( function () {
            var data = table.row('.selected').data();
            alert( 'You clicked on :  '+data['PK_PRSN_Cedula']);
        } );


        var handleTooltips = function () {
            $('.t-print').attr({'data-container': "body", 'data-placement': "top", 'data-original-title': "Imprimir"});
            $('.t-copy').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Copiar al portapales"
            });
            $('.t-pdf').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Exportar a PDF"
            });
            $('.t-excel').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Exportar a EXCEL"
            });
            $('.t-csv').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Exportar a CSV"
            });
            $('.t-colvis').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Mostrar/Ocultar Columnas"
            });
            $('.t-refresh').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Recargar"
            });

            $('.tooltips').tooltip();
        }

        jQuery(document).ready(function () {
            handleTooltips();
        })
    });
</script>
@endpush
@push('functions')
<script>
    var ComponentsDateTimePickers = function () {
        var handleTimePickers = function () {

            if (jQuery().timepicker) {

                $('.timepicker-no-seconds').timepicker({
                    autoclose: true,
                    format: 'HH:mm',
                    minuteStep: 1,
                    //defaultTime: 'current',
                    //showMeridian: false,
                });

            }
        }

        return {
            init: function () {
                handleTimePickers();
            }
        };
    }();
    var FormValidationMd = function() {


        var handleValidation = function() {

            var form1 = $('#form_eventos');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: true,
                ignore: "",
                rules: {
                    EVNT_Descripcion: {

                        required: true
                    },
                    EVNT_Fecha: {
                        required: true,

                    },
                    EVNT_Hora: {
                        passwordStr: true,
                        required: true,
                    },


                },
                messages:{
                    EVNT_Descripcion: {

                        required: "Debes ingresar la descripci'on del evento"
                    },
                    EVNT_Fecha: {
                        required: "Debes ingresar cuando se realizara el evento"

                    },
                    EVNT_Hora: {

                        required: "Debes ingresar la hora del evento"
                    },

                },

                invalidHandler: function(event, validator) {
                    success1.hide();
                    error1.show();
                    toastr.options.closeButton = true;
                    toastr.options.showDuration= 1000;
                    toastr.options.hideDuration= 1000;
                    toastr.error('Debes corregir algunos campos','Registro fallido:')
                    App.scrollTo(error1, -200);
                },

                errorPlacement: function(error, element) {
                    if (element.is(':checkbox')) {
                        error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                    } else if (element.is(':radio')) {
                        error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                    } else {
                        error.insertAfter(element);
                    }
                },

                highlight: function(element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error');
                },

                unhighlight: function(element) {
                    $(element)
                        .closest('.form-group').removeClass('has-error');
                },

                success: function(label) {
                    label
                        .closest('.form-group').removeClass('has-error');
                },

                submitHandler: function(form1) {
                    success1.show();
                    error1.hide();
                    toastr.options.closeButton = true;
                    toastr.options.showDuration= 1000;
                    toastr.options.hideDuration= 1000;
                    toastr.success('Información del funcionario almacenada correctamente','Registro exitoso:')
                    form1.submit();
                }
            });
        }

        return {
            init: function() {
                handleValidation();
            }
        };
    }();
    var ComponentsBootstrapMaxlength = function () {

        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                limitReachedClass: "label label-danger",
                alwaysShow: true
            });
        };

        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };

    }();
    jQuery(document).ready(function() {
        FormValidationMd.init();
        ComponentsBootstrapMaxlength.init();
        ComponentsDateTimePickers.init();
    });

</script>
@endpush