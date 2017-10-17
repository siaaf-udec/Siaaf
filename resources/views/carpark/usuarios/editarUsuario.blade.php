<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualización de datos de los usuarios'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$infoUsuario], ['id'=>'form_update_usuario', 'url' => '/forms'])  !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                @permission('ADMIN_CARPARK')<a href="javascript:;"><img
                                            src="{{ asset(Storage::url($infoUsuario['CU_UrlFoto'])) }}"
                                            class="img-circle UpdateFotoPerfil" id="FotoPerfil" height="250" width="250"
                                            data-toggle="modal"></a> @endpermission
                                <br>
                            </div>

                            {!! Field:: text('PK_CU_Codigo',$infoUsuario['PK_CU_Codigo'],['label'=>'Código interno:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CU_Cedula',$infoUsuario['CU_Cedula'],['label'=>'Cedula de ciudadanía:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número cedula del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                            {!! Field:: text('CU_Nombre1',$infoUsuario['CU_Nombre1'],['label'=>'Primer Nombre','class'=> 'form-control', 'autofocus', 'maxlength'=>'50','autocomplete'=>'off'],
                                                             ['help' => 'Digite el primer nombre del usuario.','icon'=>'fa fa-user']) !!}

                            {!! Field:: text('CU_Nombre2',$infoUsuario['CU_Nombre2'],['label'=>'Segundo Nombre:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el segundo nombre del usuario.','icon'=>'fa fa-user'] ) !!}

                        </div>
                        <div class="col-md-6">

                            {!! Field:: text('CU_Apellido1',$infoUsuario['CU_Apellido1'],['label'=>'Primer Apellido:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!}

                            {!! Field:: text('CU_Apellido2',$infoUsuario['CU_Apellido2'],['label'=>'Segundo Apellido:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el primer apellido del usuario.','icon'=>'fa fa-user'] ) !!}

                            {!! Field:: text('CU_Telefono',$infoUsuario['CU_Telefono'],['label'=>'Teléfono:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número de teléfono del usuario.','icon'=>'fa fa-phone'] ) !!}

                            {!! Field:: email('CU_Correo',$infoUsuario['CU_Correo'],['label'=>'Correo electrónico:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'90','autocomplete'=>'off'],
                                                             ['help' => 'Digite un correo electronico válido.','icon'=>'fa fa-envelope-open '] ) !!}

                            {!! Field:: text('CU_Direccion',$infoUsuario['CU_Direccion'],['label'=>'Dirección:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'70','autocomplete'=>'off'],
                                                             ['help' => 'Digite la dirección del usuario.','icon'=>'fa fa-building-o'] ) !!}

                            {!! Field::select('FK_CU_IdDependencia', null,['name' => 'SelectDependencia','label'=>'Dependencia:']) !!}

                            {!! Field::select('FK_CU_IdEstado',null,['name' => 'SelectEstado','label'=>'Estado del Usuario: ']) !!}
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                @permission('ADMIN_CARPARK')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission
                                @permission('ADMIN_CARPARK'){{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endcomponent


<!-- Modal Update Foto -->
    <div class="clearfix"></div>
    <div class="modal fade" id="modal-update-FotoPerfil" tabindex="-1">
        <div class="modal-header modal-header-success">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button"></button>
            <h2 class="modal-title">
                <i class="glyphicon glyphicon-user"></i>
                Editar Foto De Perfil Del Usuario
            </h2>
        </div>
        <div class="modal-body ">
            {!! Form::model ($infoUsuario, ['id'=>'form_update_FotoUsuario', 'url' => '/forms'])  !!}
            <div class="row">
                <div class="col-md-12 col-md-offset-3">
                    <p>
                        {!! Field::file('CU_UrlFotoM') !!}
                    </p>
                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    {{ Form::submit('Guardar Cambios', ['class' => 'btn blue']) }}
                </div>
            </div>
        </div>
        <div class="modal-footer">

            {!! Form::close() !!}
        </div>

    </div>

    <!-- Fin Modal Update Foto -->


</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"
        type="text/javascript"></scripts>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <
    script
    src = "{{ asset('assets/main/scripts/form-validation-md.js') }}"
    type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        /* Configuración del Select cargado de la BD */

        var $widget_select_SelectDependencia = $('select[name="SelectDependencia"]');

        var valorSelected =
            <?php echo $infoUsuario['FK_CU_IdDependencia']; ?>

        var route_Dependencia = '{{ route('parqueadero.usuariosCarpark.listDependencias') }}';
        $.get(route_Dependencia, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_SelectDependencia.append(new Option(value.CD_Dependencia, value.PK_CD_IdDependencia));
            });
            $widget_select_SelectDependencia.val();
            $('#FK_CU_IdDependencia').val(valorSelected);
        });

        var $widget_select_SelectEstado = $('select[name="SelectEstado"]');

        var valorSelectedEstado =
            <?php echo $infoUsuario['FK_CU_IdEstado']; ?>

        var route_Estado = '{{ route('parqueadero.usuariosCarpark.listEstados') }}';
        $.get(route_Estado, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_SelectEstado.append(new Option(value.CE_Estados, value.PK_CE_IdEstados));
            });
            $widget_select_SelectEstado.val([]);
            $('#FK_CU_IdEstado').val(valorSelectedEstado);
        });


        /*Configuracion de Select*/

        ///////////////////////
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Seleccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });


        //////////////////////FUNCION DE EDITAR//////////////////////////////////////

        var editarUsers = function () {
            return {
                init: function () {
                    var route = '{{ route('parqueadero.usuariosCarpark.update') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();

                    formData.append('PK_CU_Codigo', $('input:text[name="PK_CU_Codigo"]').val());
                    formData.append('CU_Cedula', $('input:text[name="CU_Cedula"]').val());
                    formData.append('CU_Nombre1', $('input:text[name="CU_Nombre1"]').val());
                    formData.append('CU_Nombre2', $('input:text[name="CU_Nombre2"]').val());
                    formData.append('CU_Apellido1', $('input:text[name="CU_Apellido1"]').val());
                    formData.append('CU_Apellido2', $('input:text[name="CU_Apellido2"]').val());
                    formData.append('CU_Telefono', $('input:text[name="CU_Telefono"]').val());
                    formData.append('CU_Correo', $('input[name="CU_Correo"]').val());
                    formData.append('CU_Direccion', $('input:text[name="CU_Direccion"]').val());
                    formData.append('FK_CU_IdEstado', $('select[name="SelectEstado"]').val());
                    formData.append('FK_CU_IdDependencia', $('select[name="SelectDependencia"]').val());

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
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_update_usuario')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form = $('#form_update_usuario');
        var formRules = {
            CU_Cedula: {minlength: 8, maxlength: 10, required: true, number: true},
            PK_CU_Codigo: {required: true, minlength: 9, maxlength: 9, number: true},
            CU_Nombre1: {required: true},
            CU_Apellido1: {required: true},
            CU_Correo: {required: true, email: true},
            CU_Direccion: {required: true},
            FK_CU_IdDependencia: {required: true},
            FK_CU_IdEstado: {required: true},
        };
        FormValidationMd.init(form, formRules, false, editarUsers());

        /////////////////////FIN FUNCION EDITAR ////////////////////////////////////////////

        /////////////////////Función Editar Foto Perfil ///////////////////////////////////


        var EditarFotoUsuario = function () {
            return {
                init: function () {
                    var codigo = <?php echo $infoUsuario['PK_CU_Codigo'];?>
                    //var route = '{{ route('parqueadero.usuariosCarpark.updateFotoUsuario') }}'+'/'+codigo;
                    var route = '{{ route('parqueadero.usuariosCarpark.updateFotoUsuario') }}';
                    route = route.concat("/", codigo);
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();

                    var File = document.getElementById("CU_UrlFotoM");

                    formData.append('CU_UrlFoto', File.files[0]);

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
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#modal-update-FotoPerfil').modal('hide');
                                $('#form_update_FotoUsuario')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var formFoto = $('#form_update_FotoUsuario');
        var formFotoRules = {
            CU_UrlFotoM: {required: true},
        };
        FormValidationMd.init(formFoto, formFotoRules, false, EditarFotoUsuario());

        /////////////////////Fin Función Editar Foto Perfil////////////////////////////////


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });


        //////////// Editar la foto de perfil //////////////////////

        $(".UpdateFotoPerfil").on('click', function (e) {
            e.preventDefault();
            $('#modal-update-FotoPerfil').modal('toggle');

        });

        ////////////Fin Editar Foto Perfil ////////////////////////

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('parqueadero.usuariosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });


    });

</script>
