@permission('auxapoyo')
@extends('material.layouts.dashboard')

@push('styles')
    <!--sweet alert-->
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Solicitudes'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            {!! Field::select('laboratorioSeleccionado',
                                                        ['Aulas de computo' => 'Aulas de computo',
                                                        'Ciencias agropecuarias y ambientales' => 'Ciencias agropecuarias y ambientales',
                                                        'Laboratorio psicologia' => 'Laboratorio psicologia'],
                                                        null,
                                                        [ 'label' => 'Espacio academico:']) !!}
            <br>
            <br>
            <br>

            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                    @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Nucleo tematico',
                    'Sala',
                    'Practica',
                    ' ' => ['style' => 'width:20px;'],
                    'Acciones'
                    ])
                @endcomponent
            </div>
            <div class="clearfix">
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
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT DATATABLE -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>

    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript">
    </script>

    <!-- SCRIPT MENSAJES TOAST-->
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
    <!--HANDLEBAR-->
    <script src="{{ asset('assets/main/acadspace/js/handlebars.js') }}"></script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <!-- Informacion que muestra al desplegar -->
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td>Fecha de creacion:</td>
                <td>@{{created_at}}</td>
            </tr>
            <tr>
                <td>Docente solicitante:</td>
                <td>@{{user.name}} @{{user.lastname}}</td>
            </tr>
            <tr>
                <td>Solicito para:</td>
                <td>@{{SOL_dias}}</td>
            </tr>
            <tr>
                <td>Hora inicio: @{{SOL_hora_inicio}}</td>
                <td>Hora fin: @{{SOL_hora_fin}}</td>
            </tr>
            <tr>
                <td>Software:</td>
                <td>@{{SOL_software}}</td>
            </tr>
        </table>
    </script>
    <script>

        /*PINTAR TABLA*/
        $(document).ready(function () {
            $("#laboratorioSeleccionado").append("<option  style='display:none' value='' selected>Seleccione..</option>");

            //capturar el template para desplegar la informacion
            var template = Handlebars.compile($("#details-template").html());

            var table, url, columns;
            var select = "vacio";
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.evalsol.mostrarFinalizados') }}" + '/' + select;
            columns = [

                {data: 'DT_Row_Index'},
                {data: 'SOL_nucleo_tematico', name: 'Nucleo tematico'},
                {data: 'FK_SOL_id_sala', name: 'Sala'},
                {data: 'tipo_prac', name: 'Practica'},
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": '<a href="javascript:;" class="btn btn-simple btn-info" data-toggle="confirmation"><i class="glyphicon glyphicon-zoom-in"></i></a>'
                },
                {
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a>',
                    data: 'action',
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    searchable: false,
                    exportable: false,
                    printable: false,
                    className: 'text-right',
                    render: null,
                    responsivePriority: 2
                }
            ];
            dataTableServer.init(table, url, columns);

            //RECARGAR DATATABLE CON BASE AL EVENTO DEL SELECT
            $("#laboratorioSeleccionado").change(function (event) {

                table = $('#art-table-ajax');
                var select = $('#laboratorioSeleccionado option:selected').val();
                table.dataTable().fnDestroy();
                url = "{{ route('espacios.academicos.evalsol.mostrarFinalizados' ) }}" + '/' + select;
                dataTableServer.init(table, url, columns);
                table = table.DataTable();

                /*Cargar select de aulas*/
                $.get("cargarSalas/" + event.target.value + "", function (response) {
                    $("#aula").empty();
                    for (i = 0; i < response.length; i++) {
                        $("#aula").append("<option value='" + response[i].SAL_nombre_sala + "'>" + response[i].SAL_nombre_sala + "</option>")
                    }
                })

            });

            /*Inicio detalles desplegables*/
            $('#art-table-ajax tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child(template(row.data())).show();
                    tr.addClass('shown');
                }
            });
            /*Fin detalles de solicitud*/

            /*ELIMINAR REGISTROS*/
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ route('espacios.academicos.evalsol.destroy') }}' + '/' + dataTable.PK_SOL_id_solicitud;
                var type = 'DELETE';
                var async = async || false;
                swal({
                    title: "¿Esta seguro?",
                    text: "¿Esta seguro que desea finalizar el proceso de esta solicitud?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonText: "Si, finalizar",
                    confirmButtonColor: "#ec6c62",
                    confirmButtonClass: "btn blue",
                    cancelButtonText: "Cancelar",
                    cancelButtonClass: "btn red",
                }, function () {

                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        type: type,
                        contentType: false,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    })
                    .done(function (data) {
                        swal("Eliminado", "La solicitud se ha eliminado correctamente", "success");
                    })
                        .error(function (data) {
                            swal("Oops", "Ha ocurrido un error", "error");
                        });
                });


            });


        });


    </script>
@endpush
@endpermission