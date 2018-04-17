
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Reservas'])<br>
        <br>
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['id' => 'form_identificacion', 'class' => '', 'url' => '/forms']) !!}
                    <div class="col-md-5">

                            {!! Field::text('id_funcionario',
                            ['label' => 'Ingrese Identificacion:'],
                            ['help' => 'Digite Numero de identificación valido', 'icon' => 'fa fa-credit-card'])
                            !!}
                    </div>
                    <br>
                    <div class="col-md-3">
                            {!! Form::submit('Ingresar', ['class' => 'btn blue' ,'id'=>'btn_ingresar_identificacion']) !!}

                    </div>
                {!! Form::close() !!}
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" data-width="760" id="modal-info-funcionario" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-user">
                                </i>
                                Informacion Funcionario
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'from_info_funcionario', 'class' => '', 'url' => '/forms']) !!}

                                <div class="col-md-6">
                                    <p>
                                        {!! Field::text('FUCNIONARIO_Nombres',
                                        ['label' => 'Nombres:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'2'],
                                        ['help' => 'Ingrese Nombres', 'icon' => 'fa fa-user'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::email('FUCNIONARIO_Correo',
                                        ['label' => 'Correo Electronico:', 'max' => '40', 'min' => '10', 'required', 'auto' => 'off','tabindex'=>'5'],
                                        ['help' => 'Ingrese Email', 'icon' => ' fa fa-envelope-open'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::tel('FUCNIONARIO_Telefono',
                                        ['label' => 'Telefono:','required', 'auto' => 'off', 'max' => '10','tabindex'=>'6'],
                                        ['help' => 'Digita un número de teléfono.', 'icon' => 'fa fa-phone'])
                                        !!}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::text('FUCNIONARIO_Apellidos',
                                        ['label' => 'Apellidos:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'3'],
                                        ['help' => 'Ingrese Apellidos', 'icon' => 'fa fa-user'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::select('FK_FUNCIONARIO_Programa',
                                            $carrerasUdec,
                                           ['label' => 'seleccione un programa'])
                                       !!}
                                    </p>
                                    <div class="modal-footer">
                                        {!! Form::submit('INGRESAR PRESTAMO', ['class' => 'btn blue']) !!}
                                        {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                    </div>
                                </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endcomponent
        <div class="clearfix"></div>
    </div>
    <script type="text/javascript">
        var FormSelect2 = function () {
            return {
                init: function () {
                    $.fn.select2.defaults.set("theme", "bootstrap");
                    $(".pmd-select2").select2({
                        placeholder: "Selecccionar",
                        allowClear: true,
                        width: 'auto',
                        escapeMarkup: function (m) {
                            return m;
                        }
                    });
                }
            }
        }();
        var guardarPrograma=false,idFuncionarioD=null;
        jQuery(document).ready(function () {
            ComponentsSelect2.init();
            var createPrograma = function () {
                return{
                    init: function () {
                        if( guardarPrograma == true ){
                            var route = '{{route('crearFuncionarioAdmin.storePrograma')}}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('FK_FUNCIONARIO_Programa', $('select[name="FK_FUNCIONARIO_Programa"]').val());
                            formData.append('idFuncionario', idFuncionarioD);
                            $.ajax({
                                url: route,
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                cache: false,
                                type: type,
                                contentType: false,
                                data: formData,
                                processData: false,
                                async: async,
                                beforeSend: function () {},
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        $('#modal-info-funcionario').modal('hide');
                                        $('#from_info_funcionario')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr , response.title , response.message  );
                                        var routeAjax = '{{route('opcionPrestamoAjax')}}';
                                        $(".content-ajax").load(routeAjax);
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 &&  xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                        else{
                            $('#modal-info-funcionario').modal('hide');
                            var routeAjax = '{{route('opcionPrestamoAjax')}}';
                            $(".content-ajax").load(routeAjax);
                        }
                    }
                }
            };
            var form_create = $('#from_info_funcionario');
            var rules_create = {
                FK_FUNCIONARIO_Programa:{required: true}
            };
            FormValidationMd.init(form_create,rules_create,false,createPrograma());
            var createIngreso = function () {
                return{
                    init: function () {
                        guardarPrograma=false;
                        var route = '{{ route('opcionPrestamoAjax') }}';
                        idFuncionarioD = $('#id_funcionario').val();
                        var  route_edit = '{{route('validarInformacionFuncionario')}}'+ '/'+ idFuncionarioD;
                        $.get( route_edit, function( info ) {
                            var datas = info.data;
                            idFuncionarioD=datas.id;
                            if(datas.audiovisual!=null){
                                if(datas.numeroPrestamos){
                                    swal(
                                        'Oops...',
                                        'Lo sentimos el usuario solo puede realizar un maximo de '+datas.numeroPrestamosMaximos+' prestamos!',
                                        'error'
                                    )
                                }else{
                                    $('#FK_FUNCIONARIO_Programa').empty();
                                    $('#FK_FUNCIONARIO_Programa').attr('disabled',true);
                                    $('#FK_FUNCIONARIO_Programa').append(new Option(datas.programa,datas.id_programa));
                                    $('input:text[name="FUCNIONARIO_Nombres"]').val(datas.name);
                                    $('#FUCNIONARIO_Correo').val(datas.email);
                                    $('input:text[name="FUCNIONARIO_Apellidos"]').val(datas.lastname);
                                    $('#FUCNIONARIO_Telefono').val(datas.phone);
                                    $('#modal-info-funcionario').modal('toggle');
                                }
                            }
                            else{
                                $('#FK_FUNCIONARIO_Programa').empty();
                                $('#FK_FUNCIONARIO_Programa').attr('disabled',false);
                                var listarProgramas= '{{ route('listarProgramas') }}';
                                $.ajax({
                                    url: listarProgramas,
                                    type: 'GET',
                                    beforeSend: function () {
                                        App.blockUI({target: '.portlet-form', animate: true});
                                    },
                                    success: function (response, xhr, request) {
                                        if (request.status === 200 && xhr === 'success') {
                                            App.unblockUI('.portlet-form');
                                            $(response.data).each(function (key,value) {
                                                $('#FK_FUNCIONARIO_Programa').append(new Option(value.PRO_Nombre,value.id));
                                            });
                                            $('#FK_FUNCIONARIO_Programa').val([])
                                        }
                                    }
                                });
                                guardarPrograma=true;//funcionario no tiene asignado un programa
                                $('input:text[name="FUCNIONARIO_Nombres"]').val(datas.name);
                                $('#FUCNIONARIO_Correo').val(datas.email);
                                $('input:text[name="FUCNIONARIO_Apellidos"]').val(datas.lastname);
                                $('#FUCNIONARIO_Telefono').val(datas.phone);
                                $('#modal-info-funcionario').modal('toggle');
                            }
                        });
                    }
                }
            };
            $.ajaxSetup({
                headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
            });
            var from_identificacion = $('#form_identificacion');
            var rules_identificacion = {
                id_funcionario: {
                    required: true,
                    remote: {
                        url: "{{ route('identificacion.validar') }}",
                        type: "post"
                    }
                }
            };
            var messages= {
                id_funcionario: {
                    remote: 'El funcionario no existe'
                },
            };
            FormValidationMd.init(from_identificacion,rules_identificacion,messages,createIngreso());
            $("#form_identificacion").validate({
                onkeyup: false //turn off auto validate while typing-pausa  validacion despues de escribir
            });
        });
    </script>


