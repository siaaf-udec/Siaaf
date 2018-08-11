@permission('ACAD_SOFTWARE')
@extends('material.layouts.dashboard')

@push('styles')
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
    {{--Row details --}}
    <link href="{{ asset('assets/main/acadspace/css/rowdetails.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'glyphicon glyphicon-th', 'title' => 'Gestión Software'])
            <div class="clearfix">
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="actions">
                        @permission('ACAD_REGISTRAR_SOFTWARE')
                        <a class="btn btn-success btn-icon create" data-toggle="modal">
                            <i class="fa fa-plus">
                            </i>
                            Registrar
                        </a>
                        @endpermission
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
            <br>
            <div class="col-md-12">
                @permission('ACAD_CONSULTAR_SOFTWARE')
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
                    @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Nombre',
                    'Versión',
                    'Licencias',
                    'Acciones' => ['style' => 'width:45px;']
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
                    <div class="modal fade" data-width="760" id="modal-create-soft" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-tv">
                                </i>
                                Registrar Software
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'form_soft', 'class' => '', 'url'=>'/forms']) !!}
                            <div class="row">
                                <div class="col-md-12">

                                    {!! Field:: text('nombre_soft',null,
                                    ['label'=>'Nombre Software:','class'=> 'form-control', 'autofocus', 'maxlength'=>'30','autocomplete'=>'off'],
                                    ['help' => 'Digite el nombre','icon'=>'fa fa-desktop'] ) !!}


                                    {!! Field:: text('version',null,
                                    ['label'=>'Versión','class'=> 'form-control', 'autofocus', 'maxlength'=>'20','autocomplete'=>'off'],
                                    ['help' => 'Digite la versión.','icon'=>'fa fa-desktop']) !!}

                                    {!! Field:: text('licencias',null,
                                    ['label'=>'Cantidad de licencias','class'=> 'form-control', 'autofocus', 'maxlength'=>'2','autocomplete'=>'off'],
                                    ['help' => 'Digite cantidad de licencias disponibles.','icon'=>'fa fa-user']) !!}

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            @permission('ACAD_REGISTRAR_SOFTWARE')
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
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

@push('functions')
    {{--Validation--}}
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

            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.soft.data') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'SOF_Nombre_Soft', name: 'Nombre'},
                {data: 'SOF_Version', name: 'Versión'},
                {data: 'SOF_Licencias', name: 'Licencias'},
                {
                    defaultContent: ' @permission('ACAD_ELIMINAR_SOFTWARE') <a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a> @endpermission',
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
                var route = '{{ route('espacios.academicos.soft.destroy') }}' + '/' + dataTable.PK_SOF_Id;
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
                            if (response.title == "¡Bien hecho!") {
                                UIToastr.init(xhr, response.title, response.message);
                                table.ajax.reload();
                            } else {
                                UIToastr.init('error', response.title, response.message);
                            }
                        }
                    },
                    error: function (response, xhr, request) {
                        if (request.status === 422 && xhr === 'error') {
                            UIToastr.init(xhr, response.title, response.message);
                        }
                    }
                })

            });


            /*ABRIR MODAL*/
            $(".create").on('click', function (e) {
                e.preventDefault();
                $('#modal-create-soft').modal('toggle');
            });
            /*CREAR SOFTWARE CON VALIDACIONES*/
            var createPermissions = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.soft.regsoft') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('SOF_Nombre_Soft', $('input:text[name="nombre_soft"]').val());
                        formData.append('SOF_Version', $('input:text[name="version"]').val());
                        formData.append('SOF_Licencias', $('input:text[name="licencias"]').val());

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
                nombre_soft: {minlength: 3, required: true},
                version: {minlength: 1, required: true},
                licencias: {number: true, required: true, range: [1, 99]}
            };
            FormValidationMd.init(form_edit, rules_edit, false, createPermissions());


        });

    </script>
@endpush
@endpermission
