<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario Reportes Anteproyectos'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
                             ],
         ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::open (['id'=>'form_crear_reporte', 'url'=>'/forms']) !!}
          
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <span class="label label-primary">Reporte Por Fechas</span>
                                <br><br>
                                <br><br> 
                                {!! Field::date('FCH_Inicial',null,['label'=>'Fecha Inicial:'],
                                                                ['help' => '','icon'=>'fa fa-calendar']) !!}
                                {!! Field::date('FCH_Final',null,['label'=>'Fecha Final:','icon'=>'fa fa-calendar'],
                                                                ['help' => '','icon'=>'fa fa-calendar']) !!}
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-3">
                                @permission('GESAP_ADMIN_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline yellow button-rFecha"><i
                                            class="fa fa-angle-center"></i>
                                    Generar Reporte
                                </a>@endpermission
                            </div>
                        </div>
                    </div>
                            <br><br>
                                <br><br>
                                <span class="label label-primary">Reporte Por Palabras Clave</span>
                                <br><br>
                                {!! Field:: text('Palabras_Clave',null,['label'=>'Palabra :','class'=> 'form-control', 'autofocus', 'maxlength'=>'30','autocomplete'=>'off'],
                                                             ['help' => 'Digite la palabra con la cual desea hacer la búsqueda.','icon'=>'fa fa-book']) !!}
                        <br><br>
                        <br><br>
                    
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-3">
                                @permission('GESAP_ADMIN_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline yellow button-rPalabrasClave"><i
                                            class="fa fa-angle-center"></i>
                                    Generar Reporte
                                </a>@endpermission
                            </div>
                        </div>
                    </div>
                                </div>
                               <div class="form-group divcode">
                            </div>
                        <br><br>
                    </div>
                    <div class="col-md-6">
                        <span class="label label-primary">Reportes Por Estado</span>
                        <br><br>
                        <br><br>
                        {!! Field::select('FK_Estado',['1'=>'EN ESPERA', '2'=>'ASIGNADO','3'=>'RADICADO','4'=>'APROBADO','5'=>'REPROBADO','6'=>'APLAZADO','7'=>'CANCELADO'],null,['label'=>'ESTADO : ']) !!}
                        <br><br>
                        <br><br>
                    
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-3">
                                @permission('GESAP_ADMIN_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline yellow button-rEstado"><i
                                            class="fa fa-angle-center"></i>
                                    Generar Reporte
                                </a>@endpermission
                            </div>
                        </div>
                    </div>
                        <br><br>
                        <br><br>
                        <span class="label label-primary">Reporte Por Estado+Profesor</span>
                        <br><br>
                        {!! Field::select('FK_NPRY_Pre_Director', null,['name' => 'SelectPre_Director','label'=>'PROFESOR: ']) !!}
                        {!! Field::select('Estado_Ante',['1'=>'ACTIVO', '2'=>'INACTIVO'],null,['label'=>'ESTADO : ']) !!}
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-3">
                                @permission('GESAP_ADMIN_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline yellow button-rProfesor"><i
                                            class="fa fa-angle-center"></i>
                                    Generar Reporte
                                </a>@endpermission
                            </div>
                        </div>
                    </div>
                        
                        </div>
                    </div>
                    <br>
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endcomponent
</div>
<!-- file script -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
    
        var $widget_select_Pre_Director = $('select[name="SelectPre_Director"]');

        var route_Pre_Director = '{{ route('AnteproyectoGesap.listarpredirector') }}';
        $.get(route_Pre_Director, function (response, status) {
        $(response.data).each(function (key, value) {
            $widget_select_Pre_Director.append(new Option(value.User_Nombre1, value.PK_User_Codigo ));
        });
        $widget_select_Pre_Director.val([]);
        $('#FK_NPRY_Pre_Director').val();
        });
        
        
           /*Configuracion de Select*/
           $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Seleccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

        var crearRepo = function(){
           return{
               init : function (){
                    var formData = new FormData();
                    var route = '{{ route('AnteproyectosGesap.ReportesEspAnteproyecto') }}';
                    var async = async || false;

                    formData.append('FCH_Inicial', $('select[name="FCH_Inicial"]').val());
                    formData.append('FCH_Final', $('select[name="FCH_Final"]').val());
                    formData.append('Palabras_Clave', $('input:text[name="Palabras_Clave"]').val());
                    formData.append('FK_Estado', $('select[name="FK_Estado"]').val());
                    formData.append('FK_NPRY_Pre_Director', $('select[name="FK_NPRY_Pre_Director"]').val());
                    formData.append('Estado_Ante', $('select[name="Estado_Ante"]').val());
                    
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
                                                $('#form_crear_reporte')[0].reset(); 
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
       var form = $('#form_crear_reporte');
        
       FormValidationMd.init(form, false, false, crearRepo());

        $('.button-rEstado').on('click', function (e) {
            e.preventDefault();
            $id =  $('select[name="FK_Estado"]').val();
            if($id == "" || $id == "undefined"){
                $id = 0;
            }
            $.ajax({}).done(function () {
                window.open('{{ route('AnteproyectosGesap.ReportesEspAnteproyecto') }}' + '/'+ $id);
            });
        });

        $('.button-rFecha').on('click', function (e) {
            e.preventDefault();
            $id =  $('#FCH_Inicial').val();
            $id2 = $('#FCH_Final').val();
            if($id == "" || $id == "undefined"){
                $id = "2000-01-01";
            }
            if($id2 == "" || $id2 == "undefined"){
                $id2 = "2100-01-01";
            }
           
            $.ajax({}).done(function () {
                window.open('{{ route('AnteproyectosGesap.ReportesEspAnteproyectoF') }}' + '/'+ $id + '/' + $id2 );
            });
        });

        
        $('.button-rPalabrasClave').on('click', function (e) {
            e.preventDefault();
            $id =  $('input:text[name="Palabras_Clave"]').val();
            if($id == "" || $id == "undefined"){
                $id = "asdfghkl";
            }
            $.ajax({}).done(function () {
                window.open('{{ route('AnteproyectosGesap.ReportesEspAnteproyectoPC') }}' + '/'+ $id );
            });
        });

        
        $('.button-rProfesor').on('click', function (e) {
            e.preventDefault();
            $id =  $('#FK_NPRY_Pre_Director').val();
            $id2 =  $('select[name="Estado_Ante"]').val();
            if($id == "" || $id == "undefined"){
                $id = 1;
            }
            if($id2 == "" || $id2 == "undefined"){
                $id2 = 0;
            }
           
            $.ajax({}).done(function () {
                window.open('{{ route('AnteproyectosGesap.ReportesEspAnteproyectoPE') }}' + '/'+ $id+'/'+$id2 );
            });
        });
        

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });
        });

</script>
