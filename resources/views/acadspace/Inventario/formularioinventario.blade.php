@permission('ACAD_INCIDENTES')
@extends('material.layouts.dashboard')

@push('styles')
    {{--Select2--}}
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- MODAL -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>
    <!-- DATATABLE  -->
    <link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    {{--toast--}}
 {{--  <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>--}}
    {{--JQuery datatable and row details--}}
    <link href="{{ asset('assets/main/acadspace/css/rowdetails.css') }}" rel="stylesheet" type="text/css"/>
@endpush


@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-info', 'title' => 'Registrar Articulo'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission('ACAD_REGISTRAR_INCIDENTE')
                        <a class="btn btn-simple btn-success btn-icon create" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Registrar Articulo
                        </a>
                        @endpermission
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                @permission('ACAD_CONSULTAR_INCIDENTE')
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax', 'class' => 'table table-striped table-bordered table-hover dt-responsive'])
                    @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'id_articulo',
                    'Codigo',
                    'Procedencia',
                    'Categoria',
                    'Hoja de vida',
                    'Acciones' => ['style' => 'width:150px;']
                    ])
                @endcomponent
                @endpermission
            </div>
            <div class="clearfix">
            </div>
            <div class="row">
                <div class="col-md-12">
                {{-- BEGIN HTML MODAL CREATE --}}
                <!-- responsive -->
                {{--    <div class="modal fade" data-width="760" id="modal-create-soft" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-tv">
                                </i>
                                Registrar articulo.
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'form_soft', 'class' => '', 'url'=>'/forms']) !!}
                            <div class="row">
                                <div class="col-md-12">

                                    {!! Field:: text('id_persona',null,
                                    ['label'=>'Codigo o serial del articulo:','class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                    ['help' => 'Escriba el codigo o serial asociado al articulo que pretende registrar','icon'=>'fa fa-barcode'] ) !!}

                                    {!! Field::select('Categoria del articulo:',$espacios,
                                        ['id' => 'espacios', 'name' => 'espacios'])
                                        !!}

                                    {!! Field:: textarea('Descripcion del articulo:',null,
                                         ['label'=>'Descripción articulo:','class'=> 'form-control', 'rows'=>'3','maxlength'=>'450', 'autofocus','autocomplete'=>'off'],
                                         ['help' => 'Digite la descripción del articulo','icon'=>'fa fa-desktop'] ) !!}
                                    <div><h3 class="block">Subir imagenes del articulo</h3><h6>10 archivos maximos por carga</h6></div>
                                    <div class="form-group">
                                        <div class="dropzone dropzone-file-area data-dz-size"
                                             id="my_dropzone">
                                            <h3 class="sbold">Arrastra o da click aquí para cargar las imagenes</h3>
                                            <p> Solo se admiten formatos JPEG - JPG - PNG  </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            @permission('ACAD_REGISTRAR_FORMATOS')
                            {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                            @endpermission
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    {{-- END HTML MODAL CREATE--}}
                </div> 
                {{-- END HTML MODAL CREATE--}}
            </div>
        @endcomponent
    </div>
    {{-- END HTML SAMPLE --}}
@endsection


@push('plugins')
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    {{--Selects--}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT DATATABLE -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/table-datatables-responsive.min.js') }}"
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
    <!-- DROPZONE-->
    <script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
    
    <!-- SCRIPT MENSAJES TOAST-->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
@endpush


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
    {{--Dropzone--}}
    <script src="{{ asset('assets/main/scripts/dropzone.js') }}" type="text/javascript"></script>
    {{--ROW DETAILS DESPLEGABLE--}}
   {{-- <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td>Descripcion:</td>
                <td>@{{INC_Descripcion}}</td>
            </tr>
            <tr>
                <td>Fecha:</td>
                <td>@{{created_at}}</td>
            </tr>
        </table>
    </script>--}}
    <script>
        $(document).ready(function () {
            //inicializar select
            var table, url, columns;
            //Define que tabla cargara los datos
            table = $('#art-table-ajax');
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });
            
            var method = function () {
                return {
                    init: function () {
                        return valores = {
                            'titulo': $('input[name="titulo"]').val(),
                            'descripcion': $('textarea[name="descripcion"]').val(),
                            'email': $('input[name="email"]').val()
                        }
                    }
                };
            };
            var type_crud = 'CREATE',
                route_store = route('espacios.academicos.formacad.store'),
                formatfile = 'image/*,.jpeg,.jpg,.png,.JPEG,.JPG,.PNG',
                numfile = 10;
            FormDropzone.init(route_store, formatfile, numfile, method(), type_crud);
            url = "{{ route('espacios.academicos.elementos.data') }}"; //url para cargar datos
            columns = [
                //Carga los datos que ha traido el control
                {data: 'DT_Row_Index'},
                {data: 'pk_id_articulo', name: 'id_articulo', "visible": false},
                {data: 'codigo_articulo', name: 'Codigo'},
                {data: 'procedencia.tipo_procedencia', name: 'Procedencia'},
                {data: 'categoria.nombre_categoria', name: 'Categoria'},
                {data: 'hojavida', name: 'Hoja de vida'},
                {
                     //Boton para descargar el archivo
                    defaultContent: ' @permission('ACAD_DESCARGAR_FORMATO') <a href="javascript:;" class="btn btn-simple btn-icon download"><i class="icon-cloud-download"></i></a> @endpermission' +
                    '@permission('ACAD_ELIMINAR_SOL_FORMATO')  <a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a> @endpermission',
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
            table = table.DataTable();

            /*ELIMINAR REGISTROS*/
            table.on('click', '.remove', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ route('espacios.academicos.incidente.destroy') }}' + '/' + dataTable.PK_INC_Id_Incidente;
                var type = 'DELETE';
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
                        if (request.status === 422 && xhr === 'error') {
                            UIToastr.init(xhr, response.title, response.message);
                        }
                    }
                });


            });

            /*Inicio detalles desplegables*/
            $('#art-table-ajax tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                if (row.child.isShown()) {
                    // This row is already open - close it
                    tr.removeClass('details');
                    row.child.hide();
                } else {
                    // Open this row
                    tr.addClass('details');
                    row.child(template(row.data())).show();
                }
            });
            /*Fin detalles de solicitud*/

            /*ABRIR MODAL*/
            $(".create").on('click', function (e) {
                e.preventDefault();
                $('#modal-create-soft').modal('toggle');
            });
            /*CREAR INCIDENTE CON VALIDACIONES*/
            var createPermissions = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.incidente.regisIncidente') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('FK_INC_Id_User', $('input:text[name="id_persona"]').val());
                        formData.append('INC_Nombre_Espacio', $('select[name="espacios"]').val());
                        formData.append('INC_Descripcion', $('textarea[name="descripcion"]').val());

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
                                    table.ajax.reload();
                                    $("#espacios").val('').trigger('change');
                                    $('#modal-create-soft').modal('hide');
                                    $('#form_soft')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    }
                }
            };

            var form_edit = $('#form_soft');
            var rules_edit = {
                id_persona: {minlength: 8, required: true, number: true},
                descripcion: {required: true, minlength: 5, maxlength: 200},
                espacios: {required: true}
            };
            FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
        });

    </script>
@endpush
@endpermission