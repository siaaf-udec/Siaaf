<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-users', 'title' => 'Asignar'])
        @permission('SEE_ALL_PROJECT_GESAP')
        @slot('actions', [
        'link_back' => [
        'link' => '',
        'icon' => 'fa fa-arrow-left',
        ],
        ])
        @endpermission
        <div class="row">
            @foreach ($anteproyectos as $anteproyecto)
                {!! Form::open(['route' => 'anteproyecto.guardardocente', 'method' => 'post', 'novalidate','class'=>'form-horizontal','id'=>'submit_form']) !!}
                {!! Field::hidden('PK_anteproyecto', $anteproyecto->PK_NPRY_IdMinr008) !!}
                <div class="form-wizard">
                    <div class="form-body">
                        <ul class="nav nav-pills nav-justified steps">
                            <li>
                                <a href="#tab1" data-toggle="tab" class="step">
                                    <span class="number"> 1 </span>
                                    <span class="desc"><i class="fa fa-check"></i> Escoger Director </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab" class="step">
                                    <span class="number"> 2 </span>
                                    <span class="desc"><i class="fa fa-check"></i> Escoger Jurados </span>
                                </a>
                            </li>
                            <li>
                                <a href="#tab3" data-toggle="tab" class="step">
                                    <span class="number"> 3 </span>
                                    <span class="desc"><i class="fa fa-check"></i> Confirmar </span>
                                </a>
                            </li>
                        </ul>
                        <div id="bar" class="progress progress-striped" role="progressbar">
                            <div class="progress-bar progress-bar-success"></div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <h3 class="block">Escoger Director</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-6 col-md-offset-3">
                                        @if(isset($encargados[0]->encargados[0]))
                                            @foreach ($encargados[0]->encargados as $direc)
                                                @if( strnatcasecmp($direc->NCRD_Cargo,"Director")==0)
                                                    {!! Field::hidden('PK_director', $direc->PK_NCRD_IdCargo) !!}
                                                    {!! Field::select('director',$docentes,$direc->FK_Developer_User_Id)!!}
                                                @endif
                                            @endforeach
                                        @else
                                            {!! Field::select('director',$docentes,null) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                <h3 class="block">Escoger Jurados</h3>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-lg-6 col-md-offset-3">
                                        @if(isset($encargados[0]->encargados[1]))
                                            @foreach ($encargados[0]->encargados as $jur1)
                                                @if( strnatcasecmp($jur1->NCRD_Cargo,"Jurado 1")==0)
                                                    {!! Field::hidden('PK_jurado1', $jur1->PK_NCRD_IdCargo) !!}
                                                    {!! Field::select('jurado1',$docentes,$jur1->FK_Developer_User_Id)!!}
                                                @endif
                                            @endforeach
                                        @else
                                            {!! Field::select('jurado1',$docentes,null) !!}
                                        @endif
                                        <hr>
                                        @if(isset($encargados[0]->encargados[2]))
                                            @foreach ($encargados[0]->encargados as $jur2)
                                                @if( strnatcasecmp($jur2->NCRD_Cargo,"Jurado 2")==0)
                                                    {!! Field::hidden('PK_jurado2', $jur2->PK_NCRD_IdCargo) !!}
                                                    {!! Field::select('jurado2',$docentes,$jur2->FK_Developer_User_Id)!!}
                                                @endif
                                            @endforeach
                                        @else
                                            {!! Field::select('jurado2',$docentes,null) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab3">
                                <h3 class="block">Datos</h3>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Anteproyecto:</label>
                                    <div class="col-md-4">
                                        <p class="form-control-static"
                                           data-display="username"> {{$anteproyecto->NPRY_Titulo}} </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Director:</label>
                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="director"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Jurado 1:</label>
                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="jurado1"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Jurado 2:</label>
                                    <div class="col-md-4">
                                        <p class="form-control-static" data-display="jurado2"></p>
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
                                {{Form::button('Guardar<i class="fa fa-check"></i>', array('type' => 'submit', 'class' => 'btn green button-submit'))}}
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            @endforeach
        </div>
    @endcomponent
</div>

@push('functions')
    <!--Local Scripts-->
    <script src="{{ asset('assets/main/gesap/js/form-wizard-3.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        jQuery(document).ready(function () {
            $('.caption-subject').append("<span class='step-title'> Paso 1 de 3 </span>");
            $('.portlet-sortable').attr("id", "form_wizard_1");

            var form = $('#submit_form');

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

            jQuery.validator.addMethod("notEqualToGroup", function (value, element, options) {
                var elems = $(element).parents('form').find(options[0]);
                var valueToCompare = value;
                var matchesFound = 0;
                jQuery.each(elems, function () {
                    thisVal = $(this).val();
                    if (thisVal == valueToCompare) {
                        matchesFound++;
                    }
                });
                if (this.optional(element) || matchesFound <= 1) {
                    return true;
                } else {
                }
            });

            var rules = {
                director: {required: true, notEqualToGroup: ['.select2-hidden-accessible']},
                jurado1: {required: true, notEqualToGroup: ['.select2-hidden-accessible']},
                jurado2: {required: true, notEqualToGroup: ['.select2-hidden-accessible']}
            };

            var wizard = $('#form_wizard_1');

            var assing = function () {
                return {
                    init: function () {
                        var route = '{{ route('anteproyecto.guardardocente') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('PK_anteproyecto', $('input:hidden[name="PK_anteproyecto"]').val());

                        if ($('input:hidden[name="PK_director"]').length > 0)
                            formData.append('PK_director', $('input:hidden[name="PK_director"]').val());
                        else
                            formData.append('PK_director', "");
                        formData.append('director', $('select[name="director"]').val());
                        if ($('input:hidden[name="PK_jurado1"]').length > 0)
                            formData.append('PK_jurado1', $('input:hidden[name="PK_jurado1"]').val());
                        else
                            formData.append('PK_jurado1', "");
                        formData.append('jurado1', $('select[name="jurado1"]').val());
                        if ($('input:hidden[name="PK_jurado2"]').length > 0)
                            formData.append('PK_jurado2', $('input:hidden[name="PK_jurado2"]').val());
                        else
                            formData.append('PK_jurado2', "");
                        formData.append('jurado2', $('select[name="jurado2"]').val());
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
                                if (request.status === 200 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('min.index.ajax') }}';
                                    $(".content-ajax").load(route);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            }
                        });
                    }
                }
            };
            var messages = {
                director: {notEqualToGroup: 'Ya selecciono este docente en otro campo'},
                jurado1: {notEqualToGroup: 'Ya selecciono este docente en otro campo'},
                jurado2: {notEqualToGroup: 'Ya selecciono este docente en otro campo'}
            };
            FormWizard.init(wizard, form, rules, messages, assing());

            $('#link_back').on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('min.index.ajax') }}';
                $(".content-ajax").load(route);
            });
        });
    </script>