<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Modificar Categoría'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="form-body">
                    {!! Form::open(['id'=>'form-cate','url' => '/forms']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('CAT_Nombre',$categoria->CAT_Nombre,['label'=>'Digite el nuevo nombre de la categoría', 
                        'class'=> 'form-control', 'autofocus', 'maxlength'=>'35','autocomplete'=>'off','required', 'pattern'=> '[A-Za-zñÑÁáéÉÍíóÓúÚ 0-9]+','title'=>'En este campo solo se admiten letras y números, con espacios']
                        ,['help' => 'Modifique el nombre como desee','icon'=>'fa fa-sitemap'] ) !!}
                    <div class="row">
                        <div class="col-md-12 col-md-offset-0">
                            @permission('ACAD_EDITAR_CATEGORIA')
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
                        var route = '{{ route('espacios.academicos.categoria.modificarCategoria',[$categoria->PK_CAT_Id_Categoria]) }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('CAT_Nombre', $('input:text[name="CAT_Nombre"]').val());

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
        var form_edit = $('#form-cate');
        var rules_edit = {
            CAT_Nombre: {required: true, minlength: 1, maxlength: 20}
        };
        FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
    });
</script>