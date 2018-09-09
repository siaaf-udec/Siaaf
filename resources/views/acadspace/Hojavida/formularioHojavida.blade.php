<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Agregar Hoja de vida'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="form-body">
                       
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-hojavida']) !!}
                    <div class="form">
                        {!! Field:: text('HOJ_Modelo_Equipo',null,['label'=>'Modelo del equipo', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off','required'],['help' => 'Ingrese el modelo del equipo','icon'=>'fa fa-barcode'] ) !!}
                    
                        {!! Field:: text('HOJ_Procesador',null,['label'=>'Procesador','required', 'auto' => 'off'],['help' => 'Ingrese el procesador del equipo', 'icon' => 'fa fa-microchip']) !!}
                    
                        {!! Field:: number('HOJ_Memoria_Ram', null,['label'=>'Memoria RAM','min' => '0','max' => '128','required', 'auto' => 'off'],['help' => 'Ingrese el numero en GBs de memoria RAM del equipo', 'icon' => 'fas fa-microchip']) !!}
                        
                        {!! Field:: number('HOJ_Disco_Duro',null,['label'=>'Disco duro','required', 'auto' => 'off'],['help' => 'Ingrese el numero en gigas del disco duro del equipo', 'icon' => 'fas fa-discord']) !!}
                    
                        {!! Field:: select('HOJ_Mouse',['0'=>'Si', '1'=>'No'],['name'=>'HOJ_Mouse','label'=>'Mouse','required'],['help'=>'Indique si el equipo tiene mouse', 'icon' => 'fa fa-mouse-pointer']) !!}

                        {!! Field:: select('HOJ_Teclado',['0'=>'Si', '1'=>'No'],['name'=>'HOJ_Teclado','label'=>'Teclado','required'],['help'=>'Indique si el equipo tiene teclado', 'icon' => 'fa fa-compact-disc']) !!}

                        {!! Field:: text('HOJ_Sistema_Operativo', null ,['label'=>'Sistema operativo','required','auto'=>'off'],['help'=>'Ingrese sobre que sistema operativo trabaja el equipo','icon'=>'fa fa-microsoft']) !!}

                        {!! Field:: text('HOJ_Antivirus', null ,['label'=>'Antivirus','required','auto'=>'off'],['help'=>'Ingrese el antivirus del equipo','icon'=>'fa fa-hands-helping']) !!}

                        {!! Field:: text('HOJ_Garantia', null ,['label'=>'Garantia','required','auto'=>'off'],['help'=>'Ingrese el numero de mese que tiene de garantia el equipo','icon'=>'fa fa-clock']) !!}

                        {!! Field:: select('Marca:',$marcas, ['id' => 'MAR_Nombre','name' => 'MAR_Nombre']) !!}

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
<script>
    jQuery(document).ready(function () {

        $('.atras').on('click', function (e) {
            e.preventDefault();
            location.reload();
        });

        $('#HOJ_Mouse').show();
        $('#HOJ_Teclado').show();
        $('#MAR_Nombre').show();

        var createPermissions = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.hojavida.regisHojavida') }}';
                        var type = 'POST';
                        var async = async || false;
                        var formData = new FormData();

                        formData.append('FK_ART_Id_Hojavida', $id_articulo);
                        formData.append('HOJ_Modelo_Equipo', $('input:text[name="HOJ_Modelo_Equipo"]').val());
                        formData.append('HOJ_Procesador', $('input:text[name="HOJ_Procesador"]').val());
                        formData.append('HOJ_Memoria_Ram', $('input:number[name="HOJ_Memoria_Ram"]').val());
                        formData.append('HOJ_Disco_Duro', $('input:number[name="HOJ_Disco_Duro"]').val());
                        formData.append('HOJ_Mouse', $('input:select[name="HOJ_Mouse"]').val());
                        formData.append('HOJ_Teclado', $('input:select[name="HOJ_Teclado"]').val());
                        formData.append('HOJ_Sistema_Operativo', $('input:text[name="HOJ_Sistema_Operativo"]').val());
                        formData.append('HOJ_Antivirus', $('input:text[name="HOJ_Antivirus"]').val());
                        formData.append('HOJ_Garantia', $('input:text[name="HOJ_Garantia"]').val());
                        formData.append('MAR_Nombre', $('input:select[name="MAR_Nombre"]').val());
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
        var form_edit = $('#form-hojavida');
        var rules_edit = {
            HOJ_Modelo_Equipo: {
                required: true,
                minlength: 1,
                maxlength: 20
            },
            HOJ_Procesador:{
                required: true,
                minlength: 1,
                maxlength: 50
            },
            HOJ_Memoria_Ram:{
                required:true,
                min:1,
                max:128
            },
            HOJ_Disco_Duro:{
                required:true,
                min:20,
                max:10000
            },
            HOJ_Sistema_Operativo:{
                required:true,
                minlength:1,
                maxlength:40
            },

        };
        FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
    });
</script>
