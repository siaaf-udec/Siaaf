@extends('material.layouts.dashboard')

@push('styles')

    <!-- DROPZONE -->
    <link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css"/>
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
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formatos Academicos'])
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
                            Registrar
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
                    'id_documento',
                    'Formato Academico',
                    'Fecha',
                    'Estado',
                    'Acciones' => ['style' => 'width:45px;']

                    ])
                @endcomponent
            </div>
            <div class="clearfix">
            </div>
            <div class="row">
                <div class="col-md-12">
                {{-- BEGIN HTML MODAL CREATE --}}
                    <div class="modal fade" data-width="760" id="modal-create-soft" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="fa fa-file-pdf-o">
                                </i>
                                Registrar formato academico
                            </h2>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                    {!! Form::open(['id' => 'my-dropzone', 'class' => 'dropzone dropzone-file-area', 'url' => '/forms']) !!}
                                    <h3 class="sbold">Arrastra o da click aquí para cargar archivos</h3>
                                    <p> This is just a demo dropzone. Selected files are not actually uploaded. </p>
                                    {!! Form::close() !!}
                                    {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        @endcomponent
    </div>
    {{-- END HTML SAMPLE --}}
@endsection


@push('plugins')

    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT MODAL -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Personalizadas -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
    <!-- DROPZONE-->
    <script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT MENSAJES TOAST-->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/main/acadspace/js/dropzoneAcadspace.js') }}" type="text/javascript"></script>
    <script>

        $(document).ready(function () {

            var x = function () {
                return {
                    init: function() {
                        $('#modal-create-soft').modal('hide');
                        table.ajax.reload();
                    }
                };
            };

            var route = '{{route('espacios.academicos.formacad.store')}}';
            var formatfile = ".pdf,.PDF";
            var numfile = 1;
            FormDropzone.init(route, formatfile, numfile, x());

            /*cargar tabla*/
            var table, url, columns;
            //Define que tabla cargara los datos
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.formacad.data') }}"; //url para cargar datos
            columns = [
                //Carga los datos que ha traido el control
                {data: 'DT_Row_Index'},
                {data: 'PK_FAC_Id_Formato', name: 'id_documento', "visible": false},
                {data: 'FAC_Titulo_Doc', name: 'Formato Academico'},
                {data: 'created_at', name: 'Fecha'},
                {data: 'estado', name: 'Estado'},
                {
                    //Boton para descargar el archivo
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-icon download"><i class="icon-cloud-download"></i></a>',
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
                    window.location.href = '{{ route('espacios.academicos.descargarArchivo') }}' + '/' + dataTable.PK_FAC_Id_Formato;
                });
            });

            /*ABRIR MODAL*/
            $(".create").on('click', function (e) {
                e.preventDefault();
                $('#modal-create-soft').modal('toggle');
            });
            
        });

    </script>
@endpush
