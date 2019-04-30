<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de actualizacion de fechas limite para radicación del Proyecto'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            {!! Form::open (['id'=>'form_create_limit', 'url'=>'/forms']) !!}
                <div class="form-body">
                    <div class="row">
                            <div class="col-md-6">

                               {!! Field::date('FCH_Radicacion_principal',null,['label'=>'Primer Fecha De Radicación:'],
                                                                ['help' => 'Digite la segunda fecha de radicacion de este semestre','icon'=>'fa fa-calendar']) !!}
                               {!! Field::date('FCH_Radicacion_secundaria',null,['label'=>'Segunda Fecha De Radicación:'],
                                                                ['help' => 'Digite la primera fecha de radicacion del proximo este semestre','icon'=>'fa fa-calendar']) !!}



                                </div>
                    </div>
                   
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                @permission('GESAP_ADMIN_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('GESAP_ADMIN_ADD_USER'){{ Form::submit('Cambiar', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                        
                    </div>
                    <h4>Proximas Fechas De Radicación de anteproyectos de grado.</h4>
                   <br><br>
                   <br><br>
                   @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listafechas'])
                        @slot('columns', [
                            '#',
                            'Fecha radicacion'
                        ])
                    @endcomponent
                   
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
        table = $('#listafechas');
                
        url = '{{ route('Proyectos.listfechasProyecto') }}';
    
        columns = [
            {data: 'Radicacion', name: 'Radicacion'},
            {data: 'FCH_Radicacion', name: 'FCH_Radicacion'}
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        

        

        var crearfecha = function(){
           return{
               init : function (){
                    var formData = new FormData();
                    var route = '{{ route('Proyectos.storefechasProyecto') }}';
                    var async = async || false;

                    formData.append('FCH_Radicacion_principal', $('[name="FCH_Radicacion_principal"]').val());
                    formData.append('FCH_Radicacion_secundaria', $('[name="FCH_Radicacion_secundaria"]').val());
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
                                            
                                            } else {
                                                $('#form_create_limit')[0].reset(); 
                                                UIToastr.init(xhr, response.title, response.message);
                                                App.unblockUI('.portlet-form');
                                            
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
        var form = $('#form_create_limit');

        var formRules = {
            FCH_Radicacion_principal: {required: true,},
            FCH_Radicacion_secundaria: {required: true,},
          
        };

     

        FormValidationMd.init(form, formRules, false, crearfecha());



        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('Proyecto.Libro') }}';

           // location.href="{{route('AnteproyectosGesap.index')}}";
            $(".content-ajax").load(route);
        });
       
    });
</script>

