@extends('material.layouts.dashboard')

@section('page-title', 'Registro de personal:')
@push('styles')
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Registro de empleados mediante archivo excel:'])
        <div class="row">
            <div class="col-md-7 col-md-offset-1">
                <div class="m-heading-1 border-green m-bordered">
                    <p> <strong>Instrucciones para subir un archivo:</strong><br>
                        <br><strong>1.)</strong> El archivo debe contener los mismos campos que el formulario de registro.<br>
                        <br><strong>2.)</strong> La primer fila debe contener los nombres de cada columna.<br>
                        <br><strong>3.)</strong> No afecta si los nombres de las columnas estan en mayúscula o minúscula.<br>
                        <br><strong>4.)</strong> Los nombres de las columnas deben ser nombrados de la siguiente manera:<br>
                        <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cedula</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombres</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apellidos</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefono</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Correo</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direccion</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ciudad</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salario</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eps</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fpensiones</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Area</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cajacompensacion</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estado</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rol</strong>
                        <br><strong>5.)</strong> No es necesario que las columnas sigan el orden mostrado.<br>
                        <br><strong>6.)</strong> Las columnas Dirección, Eps, Fpensiones y Cajacompensacion pueden estar vacías las demas deben tener información.<br>
                        <br><strong>7.)</strong> El archivo debe tener extensión .xlsx .xls o .csv .<br></p>
                </div>

                @permission('TAL_CREATE_EMP')
                {!! Form::open (['id'=>'form_file', 'url'=> ['/forms'], 'files' => true]) !!}
                    <br><br><br>
                    <div class="fileinput fileinput-new" data-provides="fileinput"  >
                        <div class="input-group input-large" >
                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput" >
                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                <span class="fileinput-filename"> </span>
                            </div>
                            <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new">seleccionar </span>
                                                                    <span class="fileinput-exists"> Cambiar </span>
                                                                    <input type="file"  name="import_file" id="import_file"> </span>
                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
                        </div>
                    </div>
                    <br><br>
                    {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                    {!! Form::close() !!}
                @endpermission
            </div>
        </div>
    @endcomponent
    </div>
@endsection
@push('plugins')
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
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function() {

        var createUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('talento.humano.empleado.importUsers') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    var File =  document.getElementById("import_file");
                    formData.append('import_file', File.files[0]);

                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: true,
                        beforeSend: function () {
                            $.blockUI(
                                { message:'Registrando empleados...',
                                    css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                            } });
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_file')[0].reset(); //Limpia formulario
                                if(response.title === "Ocurrió un problema") {
                                    UIToastr.init('error', response.title, response.message);
                                    App.unblockUI();
                                }else{
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI();
                                }
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
        var form = $('#form_file');
        var formRules = {
            import_file: {
                required: true,
                extension: "xls|csv|xlsx"
            }
        };
        var message = 'Extension del archivo debe ser .xls o .csv' ;
        FormValidationMd.init(form, formRules, message, createUsers());
    });
</script>
@endpush
