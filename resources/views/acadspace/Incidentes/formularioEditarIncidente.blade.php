<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Modificar el Incidente'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="form-body">
                    {!! Form::open(['id'=>'form-tipo','url' => '/forms']) !!}
                    <div class="col-md-12">

                        {!! Field:: text('id_persona',$obtIncidentes->FK_INC_Id_User,
                        ['label'=>'Identificacion:','class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                        ['help' => 'Digite el código o identificación de la persona implicada','icon'=>'fa fa-user'] ) !!}

                        {!! Field:: select('Codigo articulo:',$articulos,
                        ['id' => 'articulos', 'name' => 'articulos'])
                        !!}

                        {!! Field::select('Espacio académico:',$espacios,
                            ['id' => 'espacios', 'name' => 'espacios'])
                            !!}

                        {!! Field:: textarea('descripcion',$obtIncidentes->INC_Descripcion,
                             ['label'=>'Descripción Incidente:','class'=> 'form-control', 'rows'=>'3', 'autofocus','autocomplete'=>'off'],
                             ['help' => 'Digite la descripción','icon'=>'fa fa-desktop'] ) !!}
                    </div>
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
        $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Seleccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
         });
        
        $('#articulos').val({{$obtIncidentes->FK_INC_Id_Articulo}});
        $('#espacios').val({{$obtIncidentes->FK_INC_Id_Espacio}});
        var createPermissions = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.incidente.modificarIncidente',$obtIncidentes->PK_INC_Id_Incidente) }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('FK_INC_Id_User', $('input:text[name="id_persona"]').val());
                        formData.append('FK_INC_Id_Articulo', $('select[name="articulos"]').val());
                        formData.append('FK_INC_Id_Espacio', $('select[name="espacios"]').val());
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
            id_persona: {
                required: true, 
                minlength: 6,
                maxlength: 12
            },
            articulos: {
                required: true
            },
            espacios: {
                required: true
            },
            descripcion: {
                required: true, 
                minlength: 20,
                maxlength: 200
            }
        };
        FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
    });
</script>