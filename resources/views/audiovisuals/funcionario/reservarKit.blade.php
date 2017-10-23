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

 <!--DATATIME -->
 <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Styles DATATABLE  -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- STYLES SELECT -->
<link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css"/>
<!-- STYLES MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
<!-- STYLES TOAST-->
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
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
@section('title', '| Gestion Reservas')

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
@section('page-title', 'Gestion Reservas')
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

@section('page-description', 'Solicita y Cancela una reserva')

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
    {{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Reservas Realizadas'])
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
                                Nueva Reserva
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <br>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'fun-table-ajax'])
                            @slot('columns', [
                                '#' => ['style' => 'width:20px;'],
                                'Nombre Kit',
                                'Fecha Inicio',
                                'Fecha Fin',
                                'Verificar Kit',
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
                            <div class="modal fade" data-width="680" id="modal-create-reserva" tabindex="-1">
                                <div class="modal-header modal-header-success">
                                    <button aria-hidden="false" class="close" data-dismiss="modal" type="button">
                                    </button>
                                    <h2 class="modal-title">
                                        <i class="glyphicon glyphicon-tv">
                                        </i>
                                        Reservar Kit
                                    </h2>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['id' => 'from_kit_create', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                {!! Field::select('PRT_FK_Kits_id',
                                                    null,
                                                    ['label' => 'Seleccione un Kit'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::textarea('PRT_Informacion_Kit',
                                                                ['label' => 'Descripción', 'required', 'auto' => 'off', 'max' => '255', "rows" => '6','disabled'],
                                                                ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right'])
                                                !!}
                                            </p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>
                                                        {!! Field::text(
                                                            'PRT_Fecha_Inicio',
                                                            ['label'=>'Fecha Recibir Reserva','class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                                            ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])
                                                        !!}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" >
                                                    {!! Field::select('numDias',
                                                        null,
                                                        ['label' => 'Seleccione numero de dias'])
                                                    !!}
                                                </div>
                                                <div class="col-md-6" >
                                                    {!! Field::select('numHoras',
                                                         null,
                                                         ['label' => 'Seleccione numero de Horas'])
                                                     !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
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
    <!-- TIEMPOS DATETIME -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT DATETIME -->
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
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
<!-- SCRIPT SELECT -->
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Maxlength -->
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
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
<script type="text/javascript">
    var numReserva = JSON.stringify({{$validaciones[1]['VAL_PRE_Valor']}});//nUMrESERVAS
    var numHoras = JSON.stringify({{$validaciones[4]['VAL_PRE_Valor']}});//numHoras
    var numDias = JSON.stringify({{$validaciones[5]['VAL_PRE_Valor']}});//numDias
    var numhorasCancelar = JSON.stringify({{$validaciones[7]['VAL_PRE_Valor']}});
    var numDiasHabiles = parseInt(JSON.stringify({{$validaciones[12]['VAL_PRE_Valor']}}));//
    //console.log(numDiasHabiles);
    $( document ).scroll(function(){
        $('#modal-create-reserva .timepicker').datetimepicker('place'); //#modal is the id of the modal
    });
    var ComponentsDateTimePickers = function () {
        var handleDatetimePicker = function () {
            if (!jQuery().datetimepicker) {
                return;
            }
            //var tres=3;
            var fecha = new Date();
            fecha.setDate( fecha.getDate() + 1 );
            var fecha2 = new Date();
            fecha2.setDate( fecha2.getDate() + numDiasHabiles );

            $(".date-time-picker").datetimepicker({
                autoclose: true,
                isRTL: App.isRTL(),
                format:"yyyy-mm-dd hh:ii",//FORMATO DE FECHA NUMERICO
                //format: "dd MM yyyy - hh:ii",//FORMATO DE FECHA EN TEXTO
                fontAwesome: true,
                //todayBtn: true,//BOTON DE HOY
                //startDate: new Date(),//EMPIEZE DESDE LA FECHA ACTUAL
                startDate: fecha,//Fecha Actual pero sin la hora
                endDate: fecha2,//Fecha Actual + 5 dias
                showMeridian: true, // HORA EN 24 HORAS
                pickerPosition: (App.isRTL() ? "bottom-left" : "bottom-right"),
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
    var abrirModal = JSON.stringify({{$numero}});
    //sino se encuentran registros abrir el modal para registrar
    if( abrirModal == 0 ){
        //console.log('abrir modal');
        $('#static').modal('toggle');
    }
    for(i=0;i<=numDias;i++){
        var nombreDia;
        if( i == 0 )
            $('select[name="numDias"]').append(new Option('Ninguno',0));
        if( i == 1 ){
            nombreDia=' dia';
            $('select[name="numDias"]').append(new Option(i+nombreDia,i));
        }
        if( i != 0 && i != 1){
            nombreDia=' dias';
            $('select[name="numDias"]').append(new Option(i+nombreDia,i));
        }


    }
    for(i=1;i<=numHoras;i++){
        var nombreHoras;
        if(i==1){
            nombreHoras=' hora';
        }else{
            nombreHoras=' horas';
        }
        $('select[name="numHoras"]').append(new Option(i+nombreHoras,i));
    }
    $('select[name="numDias"]').val([]);
    $('select[name="numHoras"]').val([]);
    jQuery(document).ready(function() {
        var $seleccione_un_tipoArticulo = $('select[name="PRT_FK_Kits_id"]');
        var $text_area_kits = $('#PRT_Informacion_Kit');
        ComponentsDateTimePickers.init();
        ComponentsSelect2.init();
        ComponentsBootstrapMaxlength.init();
        //DATATABLE
        var table, url, columns;
        table = $('#fun-table-ajax');
        url = "{{ route('funcionarioReservas.dataKit') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'consulta_kit_articulo.KIT_Nombre', name: 'Nombre' },
            {data: 'PRT_Fecha_Inicio', name: 'Fecha Inicio'},
            {data: 'PRT_Fecha_Fin', name: 'Fecha Fin'},
            {data: 'PRT_FK_Estado', name: 'Verificar Kit'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a>',
                data:'action',
                name:'action',
                title:'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-right',
                render: null,
                responsivePriority:2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            ////////cancelar
        });
        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-create-reserva').modal('toggle');
            $seleccione_un_tipoArticulo.empty().append('whatever');
            var routeTipoArticulosDisponibles = '{{route('cargar.kitsDisponibles.select') }}';
            $.ajax({
                url: routeTipoArticulosDisponibles,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');

                        $(response.data).each(function (key, value) {
                            $seleccione_un_tipoArticulo.append(new Option(value.KIT_Nombre, value.id));
                        });
                    }
                }
            });

        });
        /*Carga todos los articulos del kit*/
        var kit;
        $seleccione_un_tipoArticulo.on('change', function () {
            kit = $(this).val();
            var routeArticulos = '{{ route('listarArticulosKit') }}' +'/' + kit ;
            $text_area_kits.empty();
            if(kit!=1){
                $.ajax({
                    url: routeArticulos,
                    type: 'GET',
                    beforeSend: function () {
                        App.blockUI({target: '.portlet-form', animate: true});
                    },
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            App.unblockUI('.portlet-form');
                            console.log(response.data);
                            $(response.data).each(function (key,value) {
                                $text_area_kits.append(value.consulta_tipo_articulo.TPART_Nombre);
                                $text_area_kits.append('\n');
                            });

                        }
                    }
                });
            }else{
                $text_area_kits.empty();
            }

        });


        //inicio de registrar funcionario audivisuales con programa
        /*Registrar Reserva kit*/
        var createKit = function () {
            return{
                init: function () {
                    var route = '{{ route('reservaKit.store') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('PRT_FK_Kits_id', $('select[name="PRT_FK_Kits_id"]').val());
                    console.log('este es el valor del select');
                    console.log($('select[name="PRT_FK_Kits_id"]').val())
                    formData.append('PRT_Fecha_Inicio', $('#PRT_Fecha_Inicio').val());
                    formData.append('numDias', $('select[name="numDias"]').val());
                    formData.append('numHoras', $('select[name="numHoras"]').val());
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
                                $('#modal-create-reserva').modal('hide');
                                $('#from_kit_create')[0].reset(); //Limpia formulario
                                table.ajax.reload();
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

        var form_create_kit = $('#from_kit_create');
        var rules_create_kit = {
            PRT_FK_Kits_id:{required: true},
            //validaciones campos fechas
            PRT_Fecha_Inicio:{required: true},
            //PRT_Fecha_Fin:{ required: true},

        };
        FormValidationMd.init(form_create_kit,rules_create_kit,false,createKit());

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
                    console.log( $('select[name="FK_FUNCIONARIO_Programa"]').val());
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
                                //location.reload();
                                //$('.mt-repeater').empty();
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
