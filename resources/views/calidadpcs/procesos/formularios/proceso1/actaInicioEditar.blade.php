<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Acta de inicio'])
        @slot('actions', [
              'link_cancel' => [
                  'link' => '',
                  'icon' => 'fa fa-arrow-left',
                               ],
               ])
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel-group accordion" id="date-range">
                    <!--Primer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_1"><strong>CMMI:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                Este espacio está dedicado al envio de correos informativos para los usuarios que aún tienen su vehículo dentro de las instalaciones sobre el cierre del parqueadero.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Segundo acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_2"><strong>SCRUM:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                    Roles Scrum que son necesarios para este proceso:<br><strong>Stakeholder: </strong>{{ $equipoScrum[2]['CE_Nombre_Persona'] }}<br><strong>Product Owner: </strong>{{ $equipoScrum[1]['CE_Nombre_Persona'] }}<br><strong>Scrum Master: </strong>{{ $equipoScrum[0]['CE_Nombre_Persona'] }}.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tercer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_3"><strong>PMBOK:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                Este espacio está dedicado al envio de correos informativos para los
                                usuarios que aún tienen su vehículo dentro de las instalaciones sobre el cierre del parqueadero.Este espacio está dedicado al envio de correos informativos para los
                                usuarios que aún tienen su vehículo dentro de las instalaciones sobre el cierre del parqueadero.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--div class="alert alert-info">
                       <h4><strong>CMMI:</strong></h4>Este espacio está dedicado al envio de correos informativos para los
                        usuarios que aún tienen su vehículo dentro de las instalaciones sobre el cierre del parqueadero.
                </div-->
               
            </div>
            <!--div class="col-md-10 col-md-offset-1">
                <div class="alert alert-primary">
                       <h4><strong>SCRUM:</strong></h4>Roles Scrum que son necesarios para este proceso: <strong>Stakeholder= </strong>{{ $equipoScrum[2]['CE_Nombre_Persona'] }}, <strong>Product Owner= </strong>{{ $equipoScrum[1]['CE_Nombre_Persona'] }} y <strong>Scrum Master= </strong>{{ $equipoScrum[0]['CE_Nombre_Persona'] }}.
                </div>
            </div-->
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([[$idProceso],[$equipoScrum],[$infoProyecto],[$infoProceso]],['id'=>'form_update_proyecto', 'url' => '/forms']) !!}
                    <div class="form-body">
                        <div class="row">
                        <h3>Informacion del proceso</h3><br>
                            <div class="col-md-6">

                                {!! Field:: hidden ('FK_CPP_Id_Proyecto', $infoProyecto[0]['PK_CP_Id_Proyecto'])!!}

                                {!! Field:: hidden ('FK_CPP_Id_Proceso', $idProceso) !!}

                                {!! Field:: text('Numero_acta',$infoProceso->{'Numero_acta'},['label'=>'Numero de acta:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el numero de acta.','icon'=>'fa fa-circle'] ) !!}

                                {!! Field::date('Fecha_Inicio',$infoProyecto[0]['CP_Fecha_Inicio'],['label' => 'Fecha de inicio',  'class'=> '','auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d",'readonly'],['help' => 'Digite la fecha de inicio del proyecto', 'icon' => 'fa fa-calendar']) !!}

                                {!! Field:: text('Tipo_Proyecto',$infoProceso->{'Tipo_Proyecto'},['label'=>'Tipo de proyecto:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el tipo de proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                                {!! Field:: text('Objetivos',$infoProceso->{'Objetivos'},['label'=>'Objetivos:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
                            
                                {!! Field:: text('Compromiso',$infoProceso->{'Compromiso'},['label'=>'Compromiso de obligatorio cumplimiento:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                            </div>
                            <div class="col-md-6">
                            
                                {!! Field:: text('Nombre_Proyecto',$infoProyecto[0]['CP_Nombre_Proyecto'],['label'=>'Nombre de proyecto:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                                {!! Field:: text('Duracion',$infoProceso->{'Duracion'},['label'=>'Duracion en meses:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                                {!! Field:: text('Entidades',$infoProceso->{'Entidades'},['label'=>'Entidades participantes:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                                {!! Field:: text('Interesados',$infoProceso->{'Interesados'},['label'=>'Interesados:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                                {!! Field:: text('Financiacion',$infoProceso->{'Financiacion'},['label'=>'Fuentes de financiacion:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}

                            </div>
                        </div>
                        <div class="row">
                        <h3>Informacion de los roles Scrum</h3><br>
                            <div class="col-md-6">

                                {!! Field:: text('CE_Nombre_1',$equipoScrum[0]['CE_Nombre_Persona'],['label'=>'Scrum Master:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user'] ) !!}

                                {!! Field:: text('CE_Nombre_2',$equipoScrum[1]['CE_Nombre_Persona'],['label'=>'Product Owner:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user'] ) !!}
                                                            
                                {!! Field:: text('CE_Nombre_3',$equipoScrum[2]['CE_Nombre_Persona'],['label'=>'Stakeholder:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user'] ) !!}
                                
                                {!! Field:: text('CE_Nombre_4',$equipoScrum[3]['CE_Nombre_Persona'],['label'=>'Lider del Equipo Scrum:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-users'] ) !!}

                            </div>
                            <div class="col-md-6">
                           
                                {!! Field:: text('CE_Nombre_5',$equipoScrum[4]['CE_Nombre_Persona'],['label'=>'Integrante uno del equipo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}

                                {!! Field:: text('CE_Nombre_6',$equipoScrum[5]['CE_Nombre_Persona'],['label'=>'Integrante dos del equipo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}

                                @if(empty($equipoScrum[6]['CE_Nombre_Persona']))
                                    {!! Field:: text('CE_Nombre_7',null,['label'=>'Integrante tres del equipo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}
                                @else
                                    {!! Field:: text('CE_Nombre_7',$equipoScrum[6]['CE_Nombre_Persona'],['label'=>'Integrante tres del equipo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}
                                @endif
                                @if(empty($equipoScrum[7]))
                                    {!! Field:: text('CE_Nombre_8',null,['label'=>'Integrante cuatro del equipo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}  
                                @else
                                    {!! Field:: text('CE_Nombre_8',$equipoScrum[7]['CE_Nombre_Persona'],['label'=>'Integrante cuatro del equipo:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off','readonly'],
                                                            ['help' => '','icon'=>'fa fa-user-o'] ) !!}                            
                                @endif
                           
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-4">
                                @permission('CALIDADPCS_CREATE_PROJECT')<a href="javascript:;"
                                                            class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>
                                {{ Form::submit('Actualizar', ['class' => 'btn blue']) }}
                                
                                @endpermission
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>

    @endcomponent
</div>

<!-- file script -->
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type = "text/javascript" > </script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

    jQuery(document).ready(function () {

        /*Configuracion de input tipo fecha*/
        $('.datepicker').datepicker({
            //rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            language: 'es',
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
            dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yyyy-mm-dd',
            firstDay: 1,
            showMonthAfterYear: false,
            yearSuffix: ''
        });
        /*FIN Configuracion de input tipo fecha*/
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-z," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[-a-z," ",$,0-9,.,#]+$/i.test(value);
        });
        var editarProyecto = function () {
            return {
                init: function () {
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    //var FileMoto = document.getElementById("CM_UrlFoto");
              
                    //Tabla Proyecto Proceso
                    formData.append('FK_CPP_Id_Proyecto', $('input:hidden[name="FK_CPP_Id_Proyecto"]').val());
                    formData.append('FK_CPP_Id_Proceso', $('input:hidden[name="FK_CPP_Id_Proceso"]').val());

                    formData.append('Numero_acta', $('input:text[name="Numero_acta"]').val());
                    formData.append('Fecha_Inicio', $('#Fecha_Inicio').val());
                    formData.append('Tipo_Proyecto', $('input:text[name="Tipo_Proyecto"]').val());
                    formData.append('Objetivos', $('input:text[name="Objetivos"]').val());
                    formData.append('Compromiso', $('input:text[name="Compromiso"]').val());

                    formData.append('Nombre_Proyecto', $('input:text[name="Nombre_Proyecto"]').val());
                    formData.append('Duracion', $('input:text[name="Duracion"]').val());
                    formData.append('Entidades', $('input:text[name="Entidades"]').val());
                    formData.append('Interesados', $('input:text[name="Interesados"]').val());
                    formData.append('Financiacion', $('input:text[name="Financiacion"]').val());

                    //formData.append('CE_Nombre_5', $('input:text[name="CE_Nombre_5"]').val());
                    //formData.append('CE_Nombre_6', $('input:text[name="CE_Nombre_6"]').val());
                    //formData.append('CE_Nombre_7', $('input:text[name="CE_Nombre_7"]').val());
                    //formData.append('CE_Nombre_8', $('input:text[name="CE_Nombre_8"]').val());
                   
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
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                $('#form_update_proyecto')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
                                location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
                                //$(".content-ajax").load(route);
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
        var form = $('#form_update_proyecto');
        var formRules = {
            //CM_UrlFoto: {required: false, extension: "jpg|png"},
            Numero_acta: {minlength: 2, maxlength: 20, required: true, noSpecialCharacters:true},
            Duracion: {minlength: 1, maxlength: 2, required: true, noSpecialCharacters:true},

            CP_Fecha_Inicio: {required: true, minlength: 3, maxlength: 20},
            CP_Fecha_Final: {required: true, minlength: 3, maxlength: 20},            
            CE_Nombre_2: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_3: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_4: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_5: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_6: {minlength: 3, maxlength: 50, required: true, noSpecialCharacters:true, letters:true},
            CE_Nombre_7: {maxlength: 50, required: false, noSpecialCharacters:true, letters:true},
            CE_Nombre_8: {maxlength: 50, required: false, noSpecialCharacters:true, letters:true},
            // CM_NuSoat: {required: true, minlength: 5, maxlength: 20, noSpecialCharacters:true},
            // CM_FechaSoat: {required: true},
            // CM_UrlPropiedad: {required: false, extension: "jpg|png"},
            // CM_UrlSoat: {required: false, extension: "jpg|png"},
        };
        var formMessage = {
            Numero_acta: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_1: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_1: {letters: 'Los numeros no son válidos'},
            CE_Nombre_2: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_2: {letters: 'Los numeros no son válidos'},
            CE_Nombre_3: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_3: {letters: 'Los numeros no son válidos'},
            CE_Nombre_4: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_4: {letters: 'Los numeros no son válidos'},
            CE_Nombre_5: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_5: {letters: 'Los numeros no son válidos'},
            CE_Nombre_6: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_6: {letters: 'Los numeros no son válidos'},
            CE_Nombre_7: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_7: {letters: 'Los numeros no son válidos'},
            CE_Nombre_8: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            CE_Nombre_8: {letters: 'Los numeros no son válidos'},
            //CP_fecha_inicio: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            //CP_fecha_final: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
            // CM_NuSoat: {noSpecialCharacters: 'Existen caracteres que no son válidos'},
        };
        FormValidationMd.init(form, formRules, formMessage, editarProyecto());

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
            //$(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
            //$(".content-ajax").load(route);
        });
        /*
         $(".create").on('click', function (e) {
            e.preventDefault();
            var codigo=  $('input:text[name="FK_CP_Codigo"]').val();
            var route = '{{ route('parqueadero.motosCarpark.RegistrarMoto2') }}' + '/' + codigo;
            $(".content-ajax").load(route);
        });*/

    });
</script>