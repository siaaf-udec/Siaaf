<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de creacion de nuevas actividades'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            {!! Form::open (['id'=>'form_create_mct_activity', 'url'=>'/forms']) !!}
                <div class="form-body">
                    <div class="row">
                            <div class="col-md-6">

                               {!! Field:: text('MCT_Actividad',null,['label'=>'NOMBRE ACTIVIDAD:','class'=> 'form-control', 'autofocus', 'maxlength'=>'100','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                                {!! Field:: text('MCT_Descripcion',null,['label'=>'DESCRIPCION:', 'class'=> 'form-control', 'autofocus','maxlength'=>'350','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                                </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                @permission('GESAP_CREATE_USER')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('GESAP_CREATE_USER'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                     <br>
                     {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endcomponent


<!-- Modal Update Foto -->
   
    <div class="modal-footer">

{!! Form::close() !!}
</div>



</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {

        var crearante = function(){
           return{
               init : function (){
                    var formData = new FormData();
                    var route = '{{ route('AnteproyectosGesap.createmct') }}';
                    var async = async || false;

                    formData.append('MCT_Actividad', $('input:text[name="MCT_Actividad"]').val());
                    formData.append('MCT_Descripcion', $('input:text[name="MCT_Descripcion"]').val());
                   
                    $.ajax({
                        url: route,
                        type: 'POST',
                        data: formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: async || false,
                        success: function (response, xhr, request) {
                                        console.log(response);
                                        if (request.status === 200 && xhr === 'success') {
                                            if (response.data == 422) {
                                                xhr = "warning"
                                                UIToastr.init(xhr, response.title, response.message);
                                                App.unblockUI('.portlet-form');
                                                var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
                                                location.href="{{route('AnteproyectosGesap.index')}}";
                                            
                                            } else {
                                                $('#form_create_mct_activity')[0].reset(); 
                                                UIToastr.init(xhr, response.title, response.message);
                                                App.unblockUI('.portlet-form');
                                                var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
                                                location.href="{{route('AnteproyectosGesap.index')}}";
                                                
                                                }
                                        }
                        },
                        error: function (response, xhr, request) {
                                        if (request.status === 422 && xhr === 'error') {
                                            UIToastr.init(xhr, response.title, response.message);
                                        }
                        }
                                            
                    })

               }
           }
       }
       var form = $('#form_create_mct_activity');
        var formRules = {
            MCT_Actividad: {minlength: 8, maxlength: 100, required: true,},
            MCT_Descripcion: {minlength: 30, maxlength: 350, required: true,},
           
        };

        var formMessage = {
            
        };

        FormValidationMd.init(form, formRules, formMessage, crearante());



        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.mct') }}';
           // location.href="{{route('AnteproyectosGesap.index')}}";
            $(".content-ajax").load(route);
        });
       
    });
</script>

