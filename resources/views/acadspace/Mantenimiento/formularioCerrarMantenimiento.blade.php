<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Cerrar mantenimiento'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                        {!! Form::open(['id'=>'form-cate','url' => '/forms']) !!}
                        <div class="form-wizard">
                            {!! Field:: textarea('MANT_Solucion',null,['name'=>'MANT_Solucion','label'=>'Digite los errores encontrados en el equipo y la solucion', 
                            'class'=> 'form-control', 'autofocus']
                            ,['help' => 'Una breve descripción de que se le hizo al equipo y los errores encontrados','icon'=>'fa fa-barcode'] ) !!}
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('ACAD_CERRAR_MANT')
                                {{ Form::submit('Guardar', ['class' => 'btn blue']) }}
                                @endpermission
                                {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                            </div>
                        {!! Form::close() !!}
                            <input type="text" class="hidden "id="male" value=>
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
                            var route = '{{ route('espacios.academicos.mantenimiento.cerrarMantenimiento')}}';
                            var type = 'POST';
                            var async = async || false;
    
                            var formData = new FormData();
                            formData.append('MANT_Id', {{$id}});
                            formData.append('MANT_Descripcion_Errores', $('textarea[name="MANT_Solucion"]').val());
    
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
                MANT_Solucion: {required: true, minlength: 30, maxlength: 4000}
            };
            FormValidationMd.init(form_edit, rules_edit, false, createPermissions());
        });
    </script>