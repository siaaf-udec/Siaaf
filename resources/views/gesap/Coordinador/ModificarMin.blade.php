@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-plus', 'title' => 'Registrar Anteproyecto'])
    <div class="row">
        <div class="col-md-6" style="z-index: 1;">
            <div class="btn-group">
                <a href="javascript:;" class="btn btn-simple btn-success btn-icon button-back"><i class="fa fa-list"></i></a>
            </div>
        </div>
        @foreach ($anteproyecto as $anteproyecto)
        {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-modificar-min']) !!} 
            {!! Field::hidden('_method', 'PUT') !!}
            {!! Field::hidden('PK_radicacion', $anteproyecto->PK_RDCN_idRadicacion) !!}
            {!! Field::hidden('PK_proyecto', $anteproyecto->PK_NPRY_idMinr008) !!}
        
        
        
            <div class="form-wizard">
                <div class="form-body">
                    <ul class="nav nav-pills nav-justified steps">
                        <li>
                            <a href="#tab1" data-toggle="tab" class="step">
                                <span class="number"> 1 </span>
                                <span class="desc"><i class="fa fa-check"></i> Anteproyecto </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc"><i class="fa fa-check"></i> Estudiantes </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab" class="step">
                                <span class="number"> 3 </span>
                                <span class="desc"><i class="fa fa-check"></i> Tiempos </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab" class="step">
                                <span class="number"> 4 </span>
                                <span class="desc"><i class="fa fa-check"></i> Documentos </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab5" data-toggle="tab" class="step">
                                <span class="number"> 5 </span>
                                <span class="desc"><i class="fa fa-check"></i> Confirmar </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div class="tab-content">
                        <div class="alert alert-danger display-none">
                            <button class="close" data-dismiss="alert"></button> Errores.Por favor revisar nuevamente  
                        </div>
                        <div class="alert alert-success display-none">
                            <button class="close" data-dismiss="alert"></button> La asignacion ha sido satisfactoria    
                        </div>
                        <div class="tab-pane active" id="tab1">
                            <h3 class="block">Datos del Proyecto</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-lg-8 col-md-offset-2">
                                    <div class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {{ Form::textarea('title', $anteproyecto->NPRY_Titulo, 
                                                ['required', 'auto' => 'off','size' => '30x1','class'=>'form-control','id'=>'title'],
                                                [ 'icon' => 'fa fa-user']) 
                                            }}
                                            <label for="title" class="control-label">Titulo del proyecto</label>
                                            <span class="help-block"> Ingrese el titulo del proyecto </span>
                                            <i class=" fa fa-user "></i>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-xs-12 col-md-12 col-lg-12">
                                    {!! Field::text('Keywords',$anteproyecto->NPRY_Keywords,
                                        ['label' => 'Palabras Clave', 'max' => '300', 'min' => '2', 'required', 'auto' => 'off'],
                                        ['help' => 'Palabras Clave (max 5)', 'icon' => 'fa fa-user']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <h3 class="block">Estudiantes proponentes</h3>
                            <div class="row">
                                <div class="col-xs-12 col-md-8 col-lg-6">
                                    @if(isset($estudiante12[0]))
                                @foreach ($estudiante12 as $estu1)
                                    @if( strnatcasecmp ($estu1->NCRD_Cargo,"ESTUDIANTE 1")==0) 
                                        {!! Field::hidden('PK_estudiante1',  $estu1->PK_NCRD_idCargo ) !!}    
                                        {!! Field::select('estudiante1',$estudiantes,$estu1->Cedula,[ 'label' => ' Estudiante 1', 'required'])!!}
                                    @endif
                                @endforeach
                            @else
                                {!! Field::select('estudiante1',$estudiantes,null,[ 'label' => 'Estudiante 1', 'required'])!!}
                            @endif
                                </div>
                                <div class="col-xs-12 col-md-8 col-lg-6">
@if(isset($estudiante12[1]))
                                @foreach ($estudiante12 as $estu2)
                                    @if( strnatcasecmp($estu2->NCRD_Cargo,"ESTUDIANTE 2")==0) 
                                        {!! Field::hidden('PK_estudiante2', $estu2->PK_NCRD_idCargo) !!}
                                        {!!Field::select('estudiante2',array_replace(["0"=>"No aplica"],$estudiantes),$estu2->Cedula,[ 'label' => 'Estudiante 2', 'required']) !!}
                                    @endif
                                @endforeach
                            @else
                                {!!Field::select('estudiante2',array_replace(["0"=>"No aplica"],$estudiantes),0,[ 'label' => 'Estudiante 2', 'required']) !!}
                            @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <h3 class="block">Tiempos del Proyecto</h3>
                            <div class="row">
                                                        <div class="col-xs-12 col-md-4 col-lg-4">
                            {!! Field::text('duracion',$anteproyecto->NPRY_Duracion,
                                ['label' => 'Duracion del Proyecto', 'max' => '15', 'min' => '1', 'required', 'auto' => 'off'],
                                ['help' => 'Duracion del Proyecto', 'icon' => 'fa fa-user']) 
                            !!}
                        </div>
                        <div class="col-xs-12 col-md-4 col-lg-4">
                            {!! Field::date('FechaR',$anteproyecto->NPRY_FechaR,
                                ['label' => 'Fecha de Radicacion', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'required'],
                                ['help' => '', 'icon' => 'fa fa-calendar']) 
                            !!}
                        </div>
                        <div class="col-xs-12 col-md-4 col-lg-4">
                            {!! Field::date('FechaL',$anteproyecto->NPRY_FechaL,
                                ['label' => 'Fecha Limite', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d", 'required'],
                                ['help' => '', 'icon' => 'fa fa-calendar']) 
                            !!}
                        </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <h3 class="block">Documentos radicados</h3>
                                <div class="col-xs-12 col-md-12 col-lg-12" id="file">
                                <div class="form-md-line-input" style="margin: 0 0 35px;">
                                    <div class="fileinput-new input-icon" data-provides="fileinput">    
                                        <label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">MINr008 o E.A</label>
                                        <div class="input-group input-large">
                                            <div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                                            <?=$anteproyecto->RDCN_Min?>
                                                <span class="fileinput-filename"> </span>
                                            </div>
                                            <span class="input-group-addon btn default btn-file">
                                            <span class="fileinput-new"> Seleccionar Documento </span>
                                            <span class="fileinput-exists"> Cambiar </span>
                                            <input type="file" name="Min" class=""  id="Min"> </span>
                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Quitar </a>
                                        </div>
                                    </div>
                                </div> 
                                <hr>
                                <div class="form-md-line-input" style="margin: 0 0 35px;">
                                    <div class="fileinput-new input-icon" data-provides="fileinput">    
                                        <label for="estudiante1" class="control-label" style="    top: 0;font-size: 14px;color: #888;bottom: 0;pointer-events: none;">Requerimientos(Opcional)</label>
                                        <div class="input-group input-large">
                                            <div class=" form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists" style="left: 0;bottom: 0;color: #888;"></i>&nbsp;
                                                <?=$anteproyecto->RDCN_Requerimientos?>
                                                <span class="fileinput-filename"> </span>
                                            </div>
                                            <span class="input-group-addon btn default btn-file">
                                                <span class="fileinput-new"> Seleccionar Documento </span>
                                                <span class="fileinput-exists"> Cambiar </span>
                                                <input type="file" name="Requerimientos" class="" id="Requerimientos"> 
                                            </span>
                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Quitar </a>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                        </div>
                <div class="tab-pane" id="tab5">
                    <h3 class="block">Datos</h3>
                    <div class="form-group">
                        <label class="control-label col-md-3">Anteproyecto:</label>
                            <div class="col-md-4">
                                            <p class="form-control-static" data-display="title">  </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Director:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="Keywords"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Jurado 1:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="estudiante1"> </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Jurado 2:</label>
                                        <div class="col-md-4">
                                            <p class="form-control-static" data-display="estudiante2"> </p>
                                        </div>
                                    </div>
                                </div>
            </div>  
                </div>  
                <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <a href="javascript:;" class="btn default button-previous">
                            <i class="fa fa-angle-left"></i> Volver 
                        </a>
                        <a href="javascript:;" class="btn btn-outline green button-next"> 
                            Continuar<i class="fa fa-angle-right"></i>
                        </a>
                        {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                    </div>
        
    </div>
                    </div>
           </div>
        {!! Form::close() !!}
        @endforeach 
    </div>
@endcomponent   

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/main/scripts/form-wizard.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $('.portlet-form').attr("id","form_wizard_1");
    $('.select2-selection--single').addClass('form-control');    
    jQuery(document).ready(function() {
            
        var form = $('#form-modificar-min');

        /*Configuracion de input tipo fecha*/
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            regional: 'es',
            closeText: 'Cerrar',
            minDate : null,
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yyyy-mm-dd',
            showMonthAfterYear: false,
            yearSuffix: ''
        });

        /*Configuracion de Select*/
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });
        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });        
        
        var rules = {
                title:{required: true},
                estudiante1:{required: true},
                estudiante2:{required: true},
                Keywords:{required: true,minlength: 4},
                duracion:{required: true,minlength: 1,number: true},
                FechaR:{required: true},
                FechaL:{required: true},
                Min:{extension: "txt|pdf|doc|docx"},
                Requerimientos:{}
            };
            
        var wizard =  $('#form_wizard_1');
            
        var createProject = function () {
            return{
                init: function () {
                    var route = '{{ route('min.proyecto.update') }}';
                    
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    //formData.append('_method', $('input:hidden[name="_method"]').val());
                    formData.append('PK_radicacion', $('input:hidden[name="PK_radicacion"]').val());
                    formData.append('PK_proyecto',  $('input:hidden[name="PK_proyecto"]').val());
                    formData.append('PK_estudiante1',  $('input:hidden[name="PK_estudiante1"]').val());
                    formData.append('PK_estudiante2',  $('input:hidden[name="PK_estudiante2"]').val());
                    formData.append('title', $('#title').val());
                    formData.append('estudiante1', $('select[name="estudiante1"]').val());
                    formData.append('estudiante2', $('select[name="estudiante2"]').val());
                    formData.append('Keywords', $('input:text[name="Keywords"]').val());
                    formData.append('duracion', $('input:text[name="duracion"]').val());
                    formData.append('FechaR', $('#FechaR').val());
                    formData.append('FechaL', $('#FechaL').val());
                    
    
                    var FileReq =  document.getElementById("Min");
                    if ($('#Min').get(0).files.length === 0) {
                        formData.append('Min', "Vacio");  
                    }else{
                        formData.append('Min', FileReq.files[0]);    
                    };
                    
                    
                    
                    
                    var FileReq =  document.getElementById("Requerimientos");
                    if ($('#Requerimientos').get(0).files.length === 0) {
                        formData.append('Requerimientos', "Vacio");  
                    }else{
                        formData.append('Requerimientos', FileReq.files[0]);    
                    };
                    
                    

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                //$('#form-register-min')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('min.index.ajax') }}';
                                //window.location.href=route;
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };    
    
        var messages = {};
        
        FormWizard.init(wizard, form, rules, messages, createProject());
        $('.button-back').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('min.index.ajax') }}';
            $(".content-ajax").load(route);
        });    
    
            
        $('.button-back').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('min.index.ajax') }}';
            $(".content-ajax").load(route);
        });    
            
    });

</script>
