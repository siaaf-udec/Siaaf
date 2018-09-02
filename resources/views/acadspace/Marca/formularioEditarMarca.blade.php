<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Modificar Marca'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="form-body">
                       
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-marca']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('MAR_Nombre',$marca->MAR_Nombre
                        ,['label'=>'Digite el nuevo nombre de la marca', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off','required']
                        ,['help' => 'Modifique el nombre como desee','icon'=>'fa fa-barcode'] ) !!}

                    <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                {{ Form::submit('Editar', ['class' => 'btn blue']) }}
                                 {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                              </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
</div>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        var createPermissions = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.marca.modificarMarca',[$marca->PK_MAR_Id_Marca]) }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('CAT_Nombre', $('input:text[name="nombre_marca"]').val());

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
                                    $('#form_marca')[0].reset(); //Limpia formulario
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
        var form_edit = $('#form_marca');
        var rules_edit = {
            MAR_Nombre: {required: true, minlength: 1, maxlength: 20}
        };
        FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
    });

</script>
