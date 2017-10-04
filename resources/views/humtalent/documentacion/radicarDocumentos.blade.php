<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de documentos solicitados'])
        <div class="col-md-6">
            <div class="btn-group">
                <a href="javascript:;" class="btn btn-simple btn-success btn-icon back">
                    <i class="fa fa-arrow-circle-left"></i>Volver
                </a>
            </div>
        </div>
        <div class="form-wizard">
            <div class="form-body">
                <ul class="nav nav-pills nav-justified steps">
                    <li>
                        <a href="#tab1" data-toggle="tab" class="step">
                            <span class="number"> 1 </span>
                            <span class="desc">
                        <i class="fa fa-check-square"></i> Documentación sin entregar </span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab" class="step">
                            <span class="number"> 2 </span>
                            <span class="desc">
                        <i class="fa fa-check-square"></i> Documentación pendiente </span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab" class="step">
                            <span class="number"> 3 </span>
                            <span class="desc">
                        <i class="fa fa-check-square"></i> Documentación completa </span>
                        </a>
                    </li>
                    <li>
                        <a href="#tab4" data-toggle="tab" class="step">
                            <span class="number"> 4 </span>
                            <span class="desc">
                        <i class="fa fa-check-square"></i> Empleado afiliado </span>
                        </a>
                    </li>

                </ul>
                <div id="bar" class="progress progress-striped" role="progressbar">
                    <div class="progress-bar progress-bar-success"> </div>
                </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            <br><br>
                            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example-table-ajax">
                                <thead>
                                <th>Número de Cedula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Rol</th>
                                <th>Área o Programa</th>
                                </thead>
                                @foreach($empleados as $empleado)
                                    <tbody>
                                    <td>{{$empleado->PK_PRSN_Cedula}}</td>
                                    <td>{{$empleado->PRSN_Nombres}}</td>
                                    <td>{{$empleado->PRSN_Apellidos}}</td>
                                    <td>{{$empleado->PRSN_Rol}}</td>
                                    <td>{{$empleado->PRSN_Area}}</td>
                                    </tbody>
                                @endforeach
                            </table>
                            <br>
                            <div class="form-group">
                                    <div class="col-md-offset-1 col-md-9">
                                    {!! Form::open (['id'=>'form-listar', 'url'=> ['/forms'], 'role'=>"form"]) !!}
                                        {!! Field::hidden('PK_PRSN_Cedula',$empleado->PK_PRSN_Cedula) !!}
                                        {!! Field::select('tipoRadicacion',
                                                ['EPS' => 'EPS', 'Caja de compensación' => 'Caja de compensación'],
                                                $tipoRad,
                                                ['label' => 'Seleccionar el tipo de radicación']) !!}
                                        {!! Form::submit('Cambiar',['class'=>'btn blue','btn-icon remove']) !!}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="form-group">
                                {!! Form::open (['id'=>'form-radicar', 'url'=> ['/forms']]) !!}
                                <div class="col-md-offset-1 col-md-9">
                                    {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula) !!}
                                    {!! Field::hidden('tipoRadicacion',$tipoRad) !!}

                                    {!!  Field::checkboxes('FK_Personal_Documento',$docs,$seleccion,['list', 'label'=>'Seleccione si fue entregado el Documento: ']) !!}

                                    {!! Field::date('EDCMT_Fecha',
                                       ['label'=>'Fecha en la que se recibió la documentación','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                       ['help' => 'Seleccione la fecha de radicación.', 'icon' => 'fa fa-calendar']) !!}
                                    {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane active" id="tab1">
                    </div>
                    <div class="tab-pane active" id="tab2">
                    </div>
                     <div class="tab-pane active" id="tab3">
                        @if($cantidadDocumentos == $cantidadRadicados && $estado != 'Afiliado '.$tipoRad)
                            <div class="col-md-offset-1 col-md-10">
                            <hr>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    {!! Form::open (['id'=>'form-afiliar', 'url'=> ['/forms']]) !!}
                                        <div class="col-md-offset-1 col-md-9">
                                             {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula) !!}
                                             {!! Field::hidden('EDCMT_Proceso_Documentacion','Afiliado '.$tipoRad, ['id'=>'proceso']) !!}
                                             {!! Field::hidden('tipoRadicacion',$tipoRad) !!}

                                             {!! Field::date('EDCMT_Fecha',
                                               ['label'=>'Fecha de afiliación del empleado','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                               ['help' => 'Seleccione la fecha de radicación.', 'icon' => 'fa fa-calendar']) !!}
                                        </div>
                                    {!! Form::submit('Empleado Afiliado',['class'=>'btn blue','btn-icon remove']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <hr class="visible-xs" />
                        @endif
                     </div>
                    <div class="tab-pane active" id="tab4">
                        @if($estado == 'Afiliado '.$tipoRad)
                            <div class="col-md-offset-1 col-md-10">
                                <hr>
                                <hr class="visible-xs" />
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    {!! Form::open (['id'=>'form-reiniciar', 'url'=> ['/forms']]) !!}
                                        <div class="col-md-offset-1 col-md-9">
                                            {!! Field::hidden('FK_TBL_Persona_Cedula',$empleado->PK_PRSN_Cedula) !!}
                                            {!! Field::hidden('EDCMT_Proceso_Documentacion','Afiliado '.$tipoRad, ['id'=>'proceso']) !!}
                                            {!! Field::hidden('tipoRadicacion',$tipoRad) !!}
                                        </div>
                                        {!! Form::submit('Reiniciar Proceso',['class'=>'btn blue','btn-icon remove']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
            {!! Field::hidden('cantDocumentos',$cantidadDocumentos,['id'=>'cantDocs']) !!}
            {!! Field::hidden('cantRadicados',$cantidadRadicados,['id'=>'cantRad']) !!}
            {!! Field::hidden('estado',$estado,['id'=>'estado']) !!}
            {!! Field::hidden('tipoRadicacion',$tipoRad,['id'=>'tipoRadicacion']) !!}
    @endcomponent
</div>


<script type="text/javascript">

    var FormWizard = function () {
        return {
            //main function to initiate the module
            init: function () {
                if (!jQuery().bootstrapWizard) {
                    return;
                }

                function format(state) {
                    if (!state.id) return state.text; // optgroup
                    return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
                }

                var displayConfirm = function() {
                    $('#tab3 .form-control-static', form).each(function(){
                        var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                        if (input.is(":radio")) {
                            input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                        }
                        if (input.is(":text") || input.is("textarea")) {
                            $(this).html(input.val());
                        } else if (input.is("select")) {
                            $(this).html(input.find('option:selected').text());
                        } else if (input.is(":radio") && input.is(":checked")) {
                            $(this).html(input.attr("data-title"));
                        } else if ($(this).attr("data-display") == 'payment[]') {
                            var payment = [];
                            $('[name="payment[]"]:checked', form).each(function(){
                                payment.push($(this).attr('data-title'));
                            });
                            $(this).html(payment.join("<br>"));
                        }
                    });
                };

                var handleTitle = function(tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    // set wizard title
                    $('.step-title', $('#form_wizard_1')).text('Paso ' + (index + 1) + ' de ' + total);
                    // set done steps
                    jQuery('li', $('#form_wizard_1')).removeClass("done");
                    var li_list = navigation.find('li');
                    for (var i = 0; i < index; i++) {
                        jQuery(li_list[i]).addClass("done");
                    }

                    if (current == 1) {
                        $('#form_wizard_1').find('.button-previous').hide();
                    } else {
                        $('#form_wizard_1').find('.button-previous').show();
                    }

                    if (current >= total) {
                        $('#form_wizard_1').find('.button-next').hide();
                        $('#form_wizard_1').find('.button-submit').show();
                        displayConfirm();
                    } else {
                        $('#form_wizard_1').find('.button-next').show();
                        $('#form_wizard_1').find('.button-submit').hide();
                    }
                    App.scrollTo($('.page-title'));
                }

                // default form wizard
                $('#form_wizard_1').bootstrapWizard({
                    'nextSelector': '.button-next',
                    'previousSelector': '.button-previous',
                    onTabClick: function (tab, navigation, index, clickedIndex) {
                        return false;

                    },
                    onNext: function (tab, navigation, index) {
                        return false;

                    },
                    onPrevious: function (tab, navigation, index) {
                        return false;

                    },
                    onTabShow: function (tab, navigation, index) {
                        var radicados=$('input[id="cantRad"]').val();
                        var documentos= $('input[id="cantDocs"]').val();
                        var estado = $('input[id="estado"]').val();
                        var tipo = $('input[id="tipoRadicacion"]').val();
                        if(radicados > 0){
                            index=1;
                        }
                        if(radicados == documentos){
                            index = 2;
                        }
                        if(estado == 'Afiliado '+tipo){
                            index = 3;
                        }

                        var li_list = navigation.find('li');
                        for (var i = 0; i <= index; i++) {
                            jQuery(li_list[i]).addClass("done");
                        }
                        var total = navigation.find('li').length;
                        var current = index + 1;
                        var $percent = (current / total) * 100;
                        $('#form_wizard_1').find('.progress-bar').css({
                            width: $percent + '%'
                        });
                    }
                });

                $('#form_wizard_1').find('.button-previous').hide();
                $('#form_wizard_1 .button-submit').click(function () {
                    swal("Documentación radicada!", "El proceso de documentación del empleado ha finalizado ", "success");
                }).hide();

            }

        };

    }();


    jQuery(document).ready(function() {
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Selecccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        $('.caption-subject').append( "<span class='step-title'>  </span>" );
        $('.portlet-sortable').attr("id","form_wizard_1");
        FormWizard.init();

        var listRad = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.listarDocsRad') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('PK_PRSN_Cedula', $('[name="PK_PRSN_Cedula"]').val());
                    formData.append('tipoRadicacion', $('select[name="tipoRadicacion"]').val());

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
                        },
                        success: function (route) {
                            $(".content-ajax").html(route);
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

        var formList = $('#form-listar');
        var rulesList ={
            PK_PRSN_Cedula: {required: true},
        };

        FormValidationMd.init(formList,rulesList,false,listRad());


        var createRad = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.radicarDocumentos') }}';
                    var type = 'POST';
                    var async = async || false;

                    var selected = "";
                    $('#form-radicar input[type=checkbox]').each(function(){
                        if (this.checked) {
                            selected += $(this).val()+';';
                        }
                    });

                    var formData = new FormData();
                    formData.append('FK_TBL_Persona_Cedula', $('[name="FK_TBL_Persona_Cedula"]').val());
                    formData.append('tipoRadicacion', $('[name="tipoRadicacion"]').val());
                    formData.append('FK_Personal_Documento', selected);
                    formData.append('EDCMT_Fecha', $('[name="EDCMT_Fecha"]').val());

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

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                if ($('[name="tipoRadicacion"]').val() == "Caja de compensación"){
                                    var tipo = "Caja";
                                }
                                else{
                                    var tipo = $('[name="tipoRadicacion"]').val();
                                }
                                var route = '{{ route('talento.humano.document.consultaDocsRadicados') }}'+'/'+ $('[name="FK_TBL_Persona_Cedula"]').val() + '/' + tipo;
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
        var formRadicar = $('#form-radicar');
        var rulesRad ={
            EDCMT_Fecha : {required: true}
        };

        FormValidationMd.init(formRadicar,rulesRad,false,createRad());

        var afiliar = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.afiliarEmpleado') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('FK_TBL_Persona_Cedula', $('[name="FK_TBL_Persona_Cedula"]').val());
                    formData.append('tipoRadicacion', $('[name="tipoRadicacion"]').val());
                    formData.append('EDCMT_Proceso_Documentacion', $('#proceso').val());
                    formData.append('EDCMT_Fecha', $('[name="EDCMT_Fecha"]').val());

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

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                if ($('[name="tipoRadicacion"]').val() == "Caja de compensación"){
                                    var tipo = "Caja";
                                }
                                else{
                                    var tipo = $('[name="tipoRadicacion"]').val();
                                }
                                var route = '{{ route('talento.humano.document.consultaDocsRadicados') }}'+'/'+ $('[name="FK_TBL_Persona_Cedula"]').val() + '/' + tipo;
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
        var formAfiliar = $('#form-afiliar');
        var rulesAfiliar ={
            EDCMT_Fecha : {required: true}
        };

        FormValidationMd.init(formAfiliar,rulesAfiliar,false,afiliar());

        var reiniciar = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.reiniciarRadicacion') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('tipoRadicacion', $('[name="tipoRadicacion"]').val());
                    formData.append('EDCMT_Proceso_Documentacion', $('#proceso').val());
                    formData.append('FK_TBL_Persona_Cedula', $('[name="FK_TBL_Persona_Cedula"]').val());

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

                        },
                        success: function (response, xhr, request) {
                            console.log(response);
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                if ($('[name="tipoRadicacion"]').val() == "Caja de compensación"){
                                    var tipo = "Caja";
                                }
                                else{
                                    var tipo = $('[name="tipoRadicacion"]').val();
                                }
                                var route = '{{ route('talento.humano.document.consultaDocsRadicados') }}'+'/'+ $('[name="FK_TBL_Persona_Cedula"]').val() + '/' + tipo;
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
        var formReinicio = $('#form-reiniciar');
        var rulesReinicio ={
            FK_TBL_Persona_Cedula : {required: true}
        };

        FormValidationMd.init(formReinicio,rulesReinicio,false,reiniciar());

        $( ".back" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.buscarRadicar.ajax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>