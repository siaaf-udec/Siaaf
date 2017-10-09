@extends('material.layouts.dashboard')

@section('page-title', 'Mensajes')
@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{ asset('assets/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{ asset('assets/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('assets/apps/css/inbox.min.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="{{ asset('assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/layouts/layout2/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('content')
    <div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Envío de mensajes'])

    {!! Form::open(['id' => 'form_email', 'url'=> ['/forms'], 'enctype'=>'multipart/form-data']) !!}
        <div class="inbox-form-group">
            <div class="controls">
                {!! Field:: text('Asunto',null,['label'=>'Asunto','class'=> 'form-control','id'=>'Asunto', 'autofocus','autocomplete'=>'off'] ) !!}
            </div>
        </div>
        <div class="inbox-form-group">
            {!! Field::textarea('Descripcion',null,
                                    ['id'=>'Descripcion','label' => 'Mensaje','auto' => 'off']) !!}
        </div>
        <div class="fileinput fileinput-new" data-provides="fileinput"  >
            <div class="input-group input-large" >
                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput" >
                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                    <span class="fileinput-filename"> </span>
                </div>
                <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new">Agregar archivos </span>
                                                                    <span class="fileinput-exists"> Cambiar </span>
                                                                    <input type="file"  name="file" multiple id="import_file"> </span>
                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
            </div>
        </div>
        <br>
        <label> Solo archivos con extensión pdf,csv, xlsx, docx, doc.<br> Tamaño máximo: 10 MB</label>
        <br><br><br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-users"></i>Buscar destinatarios</a>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modal-to" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                        <h1><i class="glyphicon glyphicon-thumbs-up"></i>Destinatarios:</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Personal registrado:'])
                                    <div class="row ">
                                        <div class="col-md-12">

                                            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'])
                                                @slot('columns', [
                                                    '#',
                                                    'Cédula',
                                                    'Nombres',
                                                    'Apellidos',
                                                    'Rol ',
                                                    'Area',
                                                    'Email'
                                                ])
                                            @endcomponent


                                        </div>
                                    </div>
                                @endcomponent
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="inbox-compose-btn">
                            {!! Form::submit('Enviar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    @endcomponent
    </div>
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

@endpush
@push('functions')
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function () {

        var table, url,columns;
        table = $('#lista-empleados');
        url = "{{ route('talento.humano.tablaEmpleados')}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PK_PRSN_Cedula', name: 'Cedula'},
            {data: 'PRSN_Nombres', name: 'Nombres'},
            {data: 'PRSN_Apellidos', name: 'Apellidos'},
            {data: 'PRSN_Rol', name: 'Rol'},
            {data: 'PRSN_Area', name: 'Area'},
            {data: 'PRSN_Correo', name: 'Email'},



        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        $('#modal-to').on('shown.bs.modal', function() {
            //Seleccionamos la tabla del modal
            var dataTable= $('#lista-empleados').DataTable();
            //Se recalculan las columnas
            dataTable.columns.adjust();

        });

        var destinos;
        $('#lista-empleados tbody').on( 'click', 'tr', function () {

            $(this).toggleClass('selected');

        } );


        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-to').modal('toggle');
        });

        var email =  function () {
            return{
                init: function () {
                    destinos =Array.from(table.rows('.selected' ).data());
                    if(destinos.length > 0) {
                        var correos = "";
                        var i = 0;
                        for (i = 0; i < destinos.length; i++) {
                            correos = correos + destinos[i].PRSN_Correo + ';';
                        }
                        var route = '{{ route('talento.humano.empleado.enviarEmail') }}';
                        var type = 'POST';
                        var async = async || false;
                        var File = document.getElementById("import_file");

                        var formData = new FormData();
                        formData.append('Asunto', $('#Asunto').val());
                        formData.append('Descripcion', $('#Descripcion').val());
                        formData.append('Destinatarios', correos);
                        formData.append('import_file', File.files[0]);
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
                            success: function (response, xhr, request) { //
                                if (request.status === 200 && xhr === 'success') {
                                    table.ajax.reload();
                                    $('#modal-to').modal('hide');
                                    $('#form_email')[0].reset();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                                //console.log(file);
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }

                        });
                    }
                    else
                    {
                        $('#modal-to').modal('hide');
                        UIToastr.init('error' , "Error" , "!Debe seleccionar al menos un destinatario" );
                    }
                }
            }
        };
        var form = $('#form_email');
        var formRules = {
            Asunto: { required: true},
            file: {extension: "pdf|csv|xlsx|docx|doc"}
        };

        FormValidationMd.init(form,formRules,false,email());
    });
</script>
@endpush