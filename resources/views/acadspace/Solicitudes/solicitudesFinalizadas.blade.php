@permission('ACAD_GESTION_SOLICITUDES')
@extends('material.layouts.dashboard')

@push('styles')
    {{--Select2--}}
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
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
    {{--JQuery datatable and row details--}}
    <link href="{{ asset('assets/main/acadspace/css/rowdetails.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-like', 'title' => 'Solicitudes con proceso finalizado'])
            <div class="clearfix">
            </div>
            <br>
            <br>

            {!! Field::select('Espacio académico:',$espacios,
                                        ['id' => 'laboratorioSeleccionado', 'name' => 'laboratorioSeleccionado'])
                                        !!}

            <br>
            <br>
            <br>

            <div class="col-md-12">
                @permission('ACAD_CONSULTAR_SOLICITUDES')
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                    @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    ' ' => ['style' => 'width:20px;'],
                    'Núcleo temático',
                    'Sala',
                    'Práctica',
                    'Acciones'
                    ])
                @endcomponent
                @endpermission
            </div>
            <div class="clearfix">
            </div>
        @endcomponent
    </div>
    {{-- END HTML SAMPLE --}}
@endsection

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

{@push('functions')
    {{--Selects--}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
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
                <td>Fecha de creación:</td>
                <td>@{{created_at}}</td>
            </tr>
            <tr>
                <td>Docente solicitante:</td>
                <td>@{{user.name}} @{{user.lastname}}</td>
            </tr>
            <tr>
                <td>Solicito para:</td>
                <td>@{{SOL_Dias}} @{{SOL_fecha_inicial}}</td>
            </tr>
            <tr>
                <td>Hora inicio: @{{SOL_Hora_Inicio}}</td>
                <td>Hora fin: @{{SOL_Hora_Fin}}</td>
            </tr>
            <tr>
                <td>Software:</td>
                <td>@{{software.SOF_Nombre_Soft}}</td>
            </tr>
        </table>
    </script>
    <script>

        /*PINTAR TABLA*/
        $(document).ready(function () {
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });
            //capturar el template para desplegar la informacion
            var template = Handlebars.compile($("#details-template").html());

            var table, url, columns;
            var select = "vacio";
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.evalsol.mostrarFinalizados') }}" + '/' + select;
            columns = [

                {data: 'DT_Row_Index', "visible": false},
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {data: 'SOL_Nucleo_Tematico', name: 'Núcleo temático'},
                {data: 'aula.SAL_Nombre_Sala', name: 'Sala'},
                {data: 'tipo_prac', name: 'Práctica'},
                {
                    defaultContent: '@permission('ACAD_ELIMINAR_SOLICITUDES') <a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a> @endpermission',
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
                        $("#aula").append("<option value='" + response[i].SAL_Nombre_Sala + "'>" + response[i].SAL_Nombre_Sala + "</option>")
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
                    tr.removeClass('details');
                }
                else {
                    // Open this row
                    row.child(template(row.data())).show();
                    tr.addClass('details');
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
                            if (request.status === 422 && xhr === 'error') {
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