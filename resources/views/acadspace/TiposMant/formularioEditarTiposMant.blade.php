<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Modificar el Tipo de Mantenimiento'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="form-body">
                    {!! Form::open(['id'=>'form-tipo','url' => '/forms']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('MAN_Nombre',$tiposMant->MAN_Nombre,['label'=>'Digite el nuevo nombre del tipo de mantenimiento', 
                        'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off','required','pattern'=> '[A-Za-zñÑÁáéÉÍíóÓúÚ0-9]+','title'=>'En este campo solo se admiten letras y números, sin espacios']
                        ,['help' => 'Modifique el nombre como desee','icon'=>'fa fa-wrench'] ) !!}
                        {!! Field:: textarea('MAN_Descripcion',$tiposMant->MAN_Descripcion,
                        ['label'=>'Digite la nueva descripción del tipo:','class'=> 'form-control', 'rows'=>'3', 'autofocus','autocomplete'=>'off','pattern'=> '[A-Za-zñÑÁáéÉÍíóÓúÚ 0-9]+','title'=>'En este campo solo se admiten letras y números, con espacios'],
                        ['help' => 'Modifique la descripción','icon'=>'fa fa-desktop'] ) !!}                        
                    <div class="row">
                        <div class="col-md-12 col-md-offset-0">
                            @permission('ACAD_EDITAR_TIPMANT')
                            {{ Form::submit('Editar', ['class' => 'btn blue']) }}
                            @endpermission
                            {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                        </div>
                    {!! Form::close() !!}
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
    jQuery(document).ready(function () {
        $('.atras').on('click', function (e) {
            e.preventDefault();
            location.reload();
        });
        var createPermissions = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.tiposmant.modificarTipo',[$tiposMant->PK_MAN_Id_Tipo]) }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('MAN_Nombre', $('input:text[name="MAN_Nombre"]').val());
                        formData.append('MAN_Descripcion', $('textarea[name="MAN_Descripcion"]').val());
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
                                    UIToastr.init(xhr, response.title, response.message);
                                    location.reload();
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
        var form_edit = $('#form-tipo');
        var rules_edit = {
            MAN_Nombre: {
                required: true, 
                minlength: 1,
                maxlength: 20
            },
            MAN_Descripcion: {
                required: true, 
                minlength: 20,
                maxlength: 400
            }
        };
        FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
    });
</script>