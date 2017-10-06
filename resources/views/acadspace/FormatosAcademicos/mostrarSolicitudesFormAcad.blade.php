@extends('material.layouts.dashboard')

@push('styles')
    <!-- MODAL -->
    {{--Estilos a usar en el formulario--}}
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
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Formatos Academicos'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                {{--COlumnas añadidas a la tabla--}}
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                    @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id_documento',
                    'Formato Academico',
                    'Fecha',
                    'Secretaria',
                    'Acciones' => ['style' => 'width:150px;']
                    ])
                @endcomponent
            </div>
            <div class="clearfix">
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

    <!-- SCRIPT DATATABLE -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT MODAL -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Personalizadas -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>
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
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <script>

        /*PINTAR TABLA*/
        $(document).ready(function () {
            var table, url, columns;
            //Define que tabla cargara los datos
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.formacad.datalistSol') }}";//url para cargar datos
            columns = [
                //Carga los datos que ha traido el control
                {data: 'DT_Row_Index'},
                {data: 'PK_FAC_id_solicitud', name: 'id_documento', "visible": false},
                {data: 'FAC_titulo_doc', name: 'Formato Academico'},
                {data: 'created_at', name: 'Fecha'},
                {
                    data: function (data, type, dataToSet) {
                        return data.name + " " + data.lastname;
                    }, name: 'Secretaria'
                },
                {
                    //Botones de acciones(editar estado, descargar)
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-icon download"><i class="icon-cloud-download"></i></a>',
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
            //table = table.DataTable();
            table = table.DataTable();
            //Funcion para descargar el archivo
            table.on('click', '.download', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                $.ajax({}).done(function () {
                    window.location.href = '{{ route('espacios.academicos.descargarArchivo') }}' + '/' + dataTable.PK_FAC_id_solicitud;
                });
            });
            //Funcion para cambiar estado a editado el archivo
            table.on('click', '.edit', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();

                var route = '{{ route('espacios.academicos.formacad.edit') }}' + '/' + dataTable.PK_FAC_id_solicitud;
                var type = 'GET';
                var async = async || false;

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
                });


            });
        });


    </script>
@endpush