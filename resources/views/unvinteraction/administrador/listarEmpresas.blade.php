 @extends('material.layouts.dashboard') @push('styles')
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
    @section('title', '| Lista de Empresas')
        @section('page-title', 'Lista de Empresas') 
            @section('page-description', 'Empresas registradas') 
                @section('content')
                    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR EMPRESAS'])
                        <div class="col-md-12">
                            <div class="actions">
                                <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="clearfix"> </div><br><br>
                            <div class="col-md-12">
                                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Empresas'])
                                    @slot('columns', [
                                        '#' => ['style' => 'width:20px;'],
                                        'documento',
                                        'Nombre',
                                        'Razonsocial',
                                        'Telefono',
                                        'Direccion',
                                        'Acciones' => ['style' => 'width:160px;']
                                    ])
                                @endcomponent
                            </div>
</div>
<!-- Modal agregar empresa -->
<div class="col-md-12">
    <!-- Modal -->
    <div class="modal fade" id="empresa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Empresa']) !!}
                <div class="form-wizard">
                    <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR EMPRESA</h1>
                    </div>
                    <div class="modal-body">
                        {!! Field:: text('PK_EMPS_Empresa',null,['label'=>'Identificacion de la empresa','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'], ['help' => 'Digitar el nunemero de indentificacion de la empresa.','icon'=>'fa fa-credit-card']) !!}
                        
                        {!! Field:: text('EMPS_Nombre_Empresa',null,['label'=>'Nombre de la empresa', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'], ['help' => 'Digitar el ombre de la empresa','icon'=>'fa fa-user'] ) !!}
                        
                        {!! Field:: text('EMPS_Razon_Social',null,['label'=>'Razon saocial', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'], ['help' => 'digitar la razon social de la empresa','icon'=>'fa fa-user'] ) !!}
                        
                        {!! Field:: tel('EMPS_Telefono',null,['label'=>'Telefono', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'], ['help' => 'Digitar el numero de telefono de la empresa','icon'=>'fa fa-phone'] ) !!}
                        
                        {!! Field:: text('EMPS_Direccion',null,['label'=>'Direccion de la empresa', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'], ['help' => 'digitar la direcion de la empresa','icon'=>'fa fa-tree'] ) !!}

                    </div>

                    <div class="modal-footer">
                        {!! Form::submit('Agregar', ['class' => 'btn blue']) !!} {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>



        @endcomponent
    @endsection 
@push('plugins')
<!-- Datatables Plugins -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<!-- Validation Plugins -->
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- Utoastr Plugins -->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script>
    jQuery(document).ready(function() {
        
        $("#archivo3").on('click', function(e) {
            e.preventDefault();
            $('#empresa').modal('toggle');
        });
        var table, url, columns;
        table = $('#Listar_Empresas');
        url = "{{ route('listarEmpresas.listarEmpresas') }}";
        columns = [
            {
                    data: 'DT_Row_Index'
                },
                {
                    data: 'PK_EMPS_Empresa',
                    "visible": true,
                    name: "documento"
                },
                {
                    data: 'EMPS_Nombre_Empresa',
                    searchable: true
                },
                {
                    data: 'EMPS_Razon_Social',
                    searchable: true
                },
                {
                    data: 'EMPS_Telefono',
                    searchable: true
                },
                {
                    data: 'EMPS_Direccion',
                    searchable: true
                },
                {data: 'action',
                    className: '',
                    searchable: false,
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    exportable: false,
                    printable: false,
                    defaultContent: '<a href="#" id="editar" class="btn btn-simple btn-warning btn-icon editar" title="Editar Empresa"><i class="icon-pencil"></i></a>'


                }
        ];
        dataTableServer.init(table, url, columns);
        
        table = table.DataTable();
        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/editarEmpresa/' + dataTable.PK_EMPS_Empresa;
            $(".content-ajax").load(route_edit);
        });
        $('.portlet-form').attr("id", "form_wizard_1");
        var rules = {
            PK_EMPS_Empresa:    {required: true,number: true},
            EMPS_Nombre_Empresa:{required: true},
            EMPS_Razon_Social:  {required: true},
            EMPS_Telefono:      {required: true},
            EMPS_Direccion:     {required: true}
            
        };        
        var form = $('#form-Agregar-Empresa');
        var wizard = $('#form_wizard_1');
        var crearConvenio = function() {
            return {
                init: function() {
                    var route = '{{ route('registroEmpresa.registroEmpresa') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('PK_EMPS_Empresa', $('#PK_EMPS_Empresa').val());
                    formData.append('EMPS_Nombre_Empresa', $('#EMPS_Nombre_Empresa').val());
                    formData.append('EMPS_Razon_Social', $('#EMPS_Razon_Social').val());
                    formData.append('EMPS_Telefono', $('#EMPS_Telefono').val());
                    formData.append('EMPS_Direccion', $('#EMPS_Direccion').val());
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,


                        success: function(response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                $('#empresa').modal('hide');
                                table.ajax.reload();
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var messages = {};

        FormValidationMd.init(form, rules, messages, crearConvenio());


    });

</script>
@endpush
