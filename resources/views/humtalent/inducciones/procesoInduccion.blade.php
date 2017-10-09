<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers font-blue', 'title' => 'Proceso de inducción'])
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
                            <a href="#tab0" data-toggle="tab" class="step">
                                <span class="number"> # </span>
                                <span class="desc">
                                        <i class="fa fa-check"></i>  Proceso de inducción </span>
                            </a>
                        </li>
                        <li>
                             <a href="#tab1" data-toggle="tab" class="step">
                                <span class="number"> 1 </span>
                                <span class="desc">
                                        <i class="fa fa-check"></i>  Ejecución de inducción </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab" class="step">
                                <span class="number"> 2 </span>
                                <span class="desc">
                                        <i class="fa fa-check"></i> Controles participantes de inducción o reinducción </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab" class="step">
                                <span class="number"> 3 </span>
                                <span class="desc">
                                        <i class="fa fa-check"></i> Evaluación de inducción </span>
                            </a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab" class="step">
                                <span class="number"> 4 </span>
                                <span class="desc">
                                        <i class="fa fa-check"></i> Resultados de la evaluación </span>
                            </a>
                        </li>
                    </ul>
                    <div id="bar" class="progress progress-striped" role="progressbar">
                        <div class="progress-bar progress-bar-success"> </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab0">
                            <h3 class="block"> Presione en el proceso de inducción a realizar</h3>
                            <div class="form-group">
                                <div class="col-md-offset-1 col-md-9">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="tab1">
                            <h3 class="block">Seleccione si el proceso finalizo exitosamente:</h3>
                            <div class="form-group">
                                {!! Form::open (['id'=>'form-induccion1', 'url'=> ['/forms'], 'role'=>"form"]) !!}
                                <div class="col-md-offset-1 col-md-9">
                                        {!! Field::hidden('FK_TBL_Persona_Cedula',$id ) !!}
                                    @if ($proceso === 'Ejecución de inducción' )
                                        {!! Field::checkbox('INDC_ProcesoInduccion1','Ejecución de inducción',true,
                                               ['label' => 'Se finalizo exitosamente']) !!}
                                    @else
                                        {!! Field::checkbox('INDC_ProcesoInduccion1','Ejecución de inducción',
                                               ['label' => 'Se finalizo exitosamente']) !!}
                                    @endif
                                        {!! Field::hidden('numCheck1', 'INDC_ProcesoInduccion1') !!}
                                </div>
                                    {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="tab-pane active" id="tab2">
                            <h3 class="block">Seleccione si el proceso finalizo exitosamente:</h3>
                            <div class="form-group">
                                {!! Form::open (['id'=>'form-induccion2', 'url'=> ['/forms'], 'role'=>"form"]) !!}
                                <div class="col-md-offset-1 col-md-9">
                                         {!! Field::hidden('FK_TBL_Persona_Cedula',$id ) !!}
                                    @if ($proceso === 'Control de participación' )
                                         {!! Field::checkbox('INDC_ProcesoInduccion2','Control de participación',true,
                                           ['label' => 'Se finalizo exitosamente']) !!}
                                    @else
                                        {!! Field::checkbox('INDC_ProcesoInduccion2','Control de participación',
                                           ['label' => 'Se finalizo exitosamente']) !!}
                                    @endif
                                         {!! Field::hidden('numCheck2','INDC_ProcesoInduccion2') !!}

                                </div>
                                {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="tab-pane active" id="tab3">
                            <h3 class="block">Seleccione si el proceso finalizo exitosamente:</h3>
                            <div class="form-group">
                                {!! Form::open (['id'=>'form-induccion3', 'url'=> ['/forms'], 'role'=>"form"]) !!}
                                <div class="col-md-offset-1 col-md-9">
                                        {!! Field::hidden('FK_TBL_Persona_Cedula',$id ) !!}
                                    @if ($proceso === 'Evaluación de inducción' )
                                        {!! Field::checkbox('INDC_ProcesoInduccion3','Evaluación de inducción',true,
                                           ['label' => 'Se finalizo exitosamente']) !!}
                                    @else
                                        {!! Field::checkbox('INDC_ProcesoInduccion3','Evaluación de inducción',
                                           ['label' => 'Se finalizo exitosamente']) !!}
                                    @endif
                                        {!! Field::hidden('numCheck3','INDC_ProcesoInduccion3') !!}
                                </div>
                                    {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="tab-pane active" id="tab4">
                            <div class="row">
                                <h3 class="block">Seleccione si el proceso finalizo exitosamente:</h3>
                                <h5 class="block">&nbsp;&nbsp;Al finalizar este proceso se cambiara el estado del empleado de nuevo a antiguo.</h5>

                                <div class="form-group">
                                    {!! Form::open (['id'=>'form-induccion4', 'url'=> ['/forms'], 'role'=>"form"]) !!}
                                    <div class="col-md-offset-1 col-md-9">
                                             {!! Field::hidden('FK_TBL_Persona_Cedula',$id ) !!}

                                        @if ($proceso === 'Resultados de evaluación' )
                                             {!! Field::checkbox('INDC_ProcesoInduccion4','Resultados de evaluación',true,
                                               ['label' => 'Se finalizo exitosamente']) !!}
                                        @else
                                            {!! Field::checkbox('INDC_ProcesoInduccion4','Resultados de evaluación',
                                               ['label' => 'Se finalizo exitosamente']) !!}
                                        @endif
                                             {!! Field::hidden('numCheck4','INDC_ProcesoInduccion4') !!}
                                    </div>
                                        {!! Form::submit('Guardar',['class'=>'btn blue','btn-icon remove']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Field::hidden('proceso',$proceso,['id'=>'tipoProceso']) !!}
            </div>

    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
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
                        $('#tab2 .form-control-static', form).each(function(){
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
                        $('.step-title', $('#form_wizard_1')).text('Paso ' + (index) + ' de ' + (total-1));
                        // set done steps
                        jQuery('li', $('#form_wizard_1')).removeClass("done");
                        var li_list = navigation.find('li');
                        for (var i = 0; i < index; i++) {
                            jQuery(li_list[i]).addClass("done");
                        }

                        if (index == 1) {
                            $('#form_wizard_1').find('.button-previous').hide();
                        } else {
                            $('#form_wizard_1').find('.button-previous').show();
                        }

                        if (index >= total) {
                            $('#form_wizard_1').find('.button-next').hide();
                            $('#form_wizard_1').find('.button-submit').show();
                            displayConfirm();
                        } else {
                            $('#form_wizard_1').find('.button-next').show();
                            $('#form_wizard_1').find('.button-submit').hide();
                        }
                        App.scrollTo($('.page-title'));
                    };

                    // default form wizard
                    $('#form_wizard_1').bootstrapWizard({
                        'nextSelector': '.button-next',
                        'previousSelector': '.button-previous',
                        onTabClick: function (tab, navigation, index, clickedIndex) {

                            var proceso= $('input[id="tipoProceso"]').val();
                            switch(proceso){
                                case "Inicio":
                                    index=1;
                                    break;
                                case "Ejecución de inducción":
                                    index=2;
                                    break;
                                case "Control de participación":
                                    index=3;
                                    break;
                                case "Evaluación de inducción":
                                    index=4;
                                    break;
                            }

                            handleTitle(tab, navigation, clickedIndex);
                        },
                        onNext: function (tab, navigation, index) {
                            return false;

                        },
                        onPrevious: function (tab, navigation, index) {
                            return false;

                        },
                        onTabShow: function (tab, navigation, index) {
                            var proceso= $('input[id="tipoProceso"]').val();
                            switch(proceso){
                                case "Inicio":
                                    index=0;
                                    break;
                                case "Ejecución de inducción":
                                    index=1;
                                    break;
                                case "Control de participación":
                                    index=2;
                                    break;
                                case "Evaluación de inducción":
                                    index=3;
                                    break;
                                case "Resultados de evaluación":
                                    index=4;
                                    break;
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
                    $('#form_wizard_1 .fin').click(function () {
                        swal("Inducción finalizada!", "Se ha cambiado el estado del docente", "success");
                    }).hide();

                }

            };

        }();


    jQuery(document).ready(function() {

        $('.caption-subject').append( "<span class='step-title'>  </span>" );
        $('.portlet-sortable').attr("id","form_wizard_1");
        FormWizard.init();

        var induction1 = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.induccion.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('INDC_ProcesoInduccion1', $('[name="INDC_ProcesoInduccion1"]').val());
                    formData.append('numCheck', $('[name="numCheck1"]').val());
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
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('talento.humano.procesoInduccion') }}'+'/'+ $('[name="FK_TBL_Persona_Cedula"]').val();
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form1 = $('#form-induccion1');
        var rulesForm1 ={
            INDC_ProcesoInduccion1: {required: true},

        };

        FormValidationMd.init(form1,rulesForm1,false,induction1());

        var induction2 = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.induccion.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('INDC_ProcesoInduccion2', $('input[name="INDC_ProcesoInduccion2"]').val());
                    formData.append('numCheck', $('[name="numCheck2"]').val());
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
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('talento.humano.procesoInduccion') }}'+'/'+ $('[name="FK_TBL_Persona_Cedula"]').val();
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form2 = $('#form-induccion2');
        var rulesForm2 ={
            INDC_ProcesoInduccion2: {required: true}
        };

        FormValidationMd.init(form2,rulesForm2,false,induction2());


        var induction3 = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.induccion.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('INDC_ProcesoInduccion3', $('input[name="INDC_ProcesoInduccion3"]').val());
                    formData.append('numCheck', $('[name="numCheck3"]').val());
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
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('talento.humano.procesoInduccion') }}'+'/'+ $('[name="FK_TBL_Persona_Cedula"]').val();
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form3 = $('#form-induccion3');
        var rulesForm3 ={
            INDC_ProcesoInduccion3: {required: true}
        };

        FormValidationMd.init(form3,rulesForm3,false,induction3());


        var induction4 = function () {
            return{
                init: function () {
                    var route = '{{ route('talento.humano.induccion.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('INDC_ProcesoInduccion4', $('input[name="INDC_ProcesoInduccion4"]').val());
                    formData.append('numCheck', $('[name="numCheck4"]').val());
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
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr , response.title , response.message  );
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('talento.humano.procesoInduccion') }}'+'/'+ $('[name="FK_TBL_Persona_Cedula"]').val();
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var form4 = $('#form-induccion4');
        var rulesForm4 ={
            INDC_ProcesoInduccion4: {required: true}
        };

        FormValidationMd.init(form4,rulesForm4,false,induction4());

        $( ".back" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('talento.humano.Tinduccion.ajax') }}';
            $(".content-ajax").load(route);
        });
    });


</script>
