{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Crear Organización'])
        @slot('actions', [

                    'link_upload' => [
                        'link' => '',
                        'icon' => 'icon-cloud-upload',
                    ],
                    'link_wrench' => [
                        'link' => '',
                        'icon' => 'icon-wrench',
                    ],
                    'link_trash' => [
                        'link' => '',
                        'icon' => 'icon-trash',
                    ],

                ])
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light " id="form_wizard_1">
                    <div class="portlet-body form">
                        {!! Form::open(['id' => 'submit_form', 'class' => 'form-horizontal', 'url' => '/forms']) !!}
                            <div class="form-wizard">
                                <div class="form-body">
                                    <ul class="nav nav-pills nav-justified steps">
                                        <li>
                                            <a href="#tab1" data-toggle="tab" class="step">
                                                <span class="number"> 1 </span>
                                                <span class="desc">
                                                                <i class="fa fa-check"></i> Account Setup </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab2" data-toggle="tab" class="step">
                                                <span class="number"> 2 </span>
                                                <span class="desc">
                                                                <i class="fa fa-check"></i> Profile Setup </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab3" data-toggle="tab" class="step active">
                                                <span class="number"> 3 </span>
                                                <span class="desc">
                                                                <i class="fa fa-check"></i> Billing Setup </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tab4" data-toggle="tab" class="step">
                                                <span class="number"> 4 </span>
                                                <span class="desc">
                                                                <i class="fa fa-check"></i> Confirm </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div id="bar" class="progress progress-striped" role="progressbar">
                                        <div class="progress-bar progress-bar-success"> </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="alert alert-danger display-none">
                                            <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                        <div class="alert alert-success display-none">
                                            <button class="close" data-dismiss="alert"></button> Your form validation is successful! </div>
                                        <div class="tab-pane active" id="tab1">
                                            <h3 class="block">Datos Personales</h3>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-1">
                                                    {!! Field::text(
                                                            'name_create',
                                                            ['label' => 'Nombre', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                            ['help' => 'Ingrese el Nombre']) !!}
                                                    {!! Field::date(
                                                            'date',
                                                            ['label' => 'Fecha de Nacimiento', 'required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                            ['help' => 'Digita tu fecha de nacimiento', 'icon' => 'fa fa-calendar']) !!}
                                                    {!! Field::select(
                                                            'sizes',
                                                            ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'],null,
                                                            [ 'label' => 'Tipo de Identificación']) !!}
                                                    {!! Field::date(
                                                            'date',
                                                            ['label' => 'Fecha de Expedición', 'required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                            ['help' => 'Digita tu fecha de expedición', 'icon' => 'fa fa-calendar']) !!}
                                                    {!! Field::text(
                                                            'name_create',
                                                            ['label' => 'Numero Telefonico', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                            ['help' => 'Numero Telefonico']) !!}
                                                    {!! Field::email(
                                                            'name_create',
                                                            ['label' => 'Correo Electronico', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                            ['help' => 'Correo Electronico']) !!}
                                                </div>
                                                <div class="col-md-4 col-md-offset-1">
                                                    {!! Field::text(
                                                        'lastname_create',
                                                        ['label' => 'Apellido', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                        ['help' => 'Ingrese el Apellido']) !!}
                                                    {!! Field::select(
                                                        'sizes',
                                                        ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'],null,
                                                        [ 'label' => 'Sexo']) !!}
                                                    {!! Field::text(
                                                            'name_create',
                                                            ['label' => 'Numero de Identificación', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                            ['help' => 'Numero de Identificación']) !!}
                                                    {!! Field::text(
                                                            'name_create',
                                                            ['label' => 'Lugar de expedición', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                            ['help' => 'Lugar de expedición']) !!}
                                                    {!! Field::select(
                                                            'sizes',
                                                            ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'],null,
                                                            [ 'label' => 'Estado']) !!}
                                                    {!! Field::password('password',
                                                            ['required', 'label' => 'Contraseña'],
                                                            ['help' => 'Digita la contreaseña.']) !!}
                                                </div>
                                            </div>
                                            <h3 class="block">Datos de Ubicación</h3>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-1">
                                                    {!! Field::text(
                                                            'name_create',
                                                            ['label' => 'Dirección Procedencia', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                            ['help' => 'Dirección Procedencia']) !!}
                                                    {!! Field::select(
                                                            'Departamento', null,
                                                            ['name' => 'regions_create']) !!}
                                                </div>
                                                <div class="col-md-4 col-md-offset-1">
                                                    {!! Field::select(
                                                            'Pais', null,
                                                            ['name' => 'countries_create']) !!}
                                                    {!! Field::select(
                                                            'Ciudad', null,
                                                            ['name' => 'cities_create']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <h3 class="block">Proporcione los detalles deL perfil</h3>


                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <h3 class="block">Proporcione el roll</h3>

                                        </div>
                                        <div class="tab-pane" id="tab4">
                                            <h3 class="block">Confirm your account</h3>
                                            <h4 class="form-section">Account</h4>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Username:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="username"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="email"> </p>
                                                </div>
                                            </div>
                                            <h4 class="form-section">Profile</h4>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Fullname:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="fullname"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Gender:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="gender"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Phone:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="phone"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Address:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="address"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">City/Town:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="city"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Country:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="country"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Remarks:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="remarks"> </p>
                                                </div>
                                            </div>
                                            <h4 class="form-section">Billing</h4>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Card Holder Name:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="card_name"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Card Number:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="card_number"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">CVC:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="card_cvc"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Expiration:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="card_expiry_date"> </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Payment Options:</label>
                                                <div class="col-md-4">
                                                    <p class="form-control-static" data-display="payment[]"> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <a href="javascript:;" class="btn default button-previous">
                                                <i class="fa fa-angle-left"></i> Back </a>
                                            <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                            {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
</div>
{{-- END HTML SAMPLE --}}
<script src="{{ asset('assets/main/scripts/form-wizard.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {


        var $widget_select_countries_create = $('select[name="countries_create"]'),
            $widget_select_regions_create = $('select[name="regions_create"]'),
            $widget_select_cities_create = $('select[name="cities_create"]');

        /*Carga todos los paises*/
        var route_country = '{{ route('location.countries') }}';
        $.get(route_country, function(response, status){
            $( response.data ).each(function( key,value ) {
                $widget_select_countries_create.append(new Option(value.name, value.id));
            });
        });

        /*Carga todos los Departamentos*/
        var region_id;
        $widget_select_countries_create.on('change', function () {
            region_id = $(this).val();
            var route_region = '{{ route('location.regions.find') }}' +'/' + region_id;
            $widget_select_regions_create.empty().append('whatever');
            $widget_select_cities_create.empty().append('whatever');
            $.ajax({
                url: route_region,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        $( response.data ).each(function( key,value ) {
                            $widget_select_regions_create.append(new Option(value.name, value.id));
                        });
                    }
                }
            });
        });


        /*Carga todas las Ciudades*/
        $widget_select_regions_create.on('change', function () {
            var route_city = '{{ route('location.cities.find') }}' +'/' + region_id +'/' + $(this).val() ;
            $widget_select_cities_create.empty().append('whatever');
            $.ajax({
                url: route_city,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        $(response.data).each(function (key, value) {
                            $widget_select_cities_create.append(new Option(value.name, value.id));
                        });
                    }
                }
            });
        });

        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            orientation: "left",
            autoclose: true,
            regional: 'es',
            closeText: 'Cerrar',
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
            firstDay: 1,
            showMonthAfterYear: false,
            yearSuffix: ''
        });

        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            width: null,
            placeholder: "Selecccionar",
        });


        var form = $('#submit_form');
        var rules = {
            //account
            username: {
                minlength: 5,
                required: true
            },
            password: {
                minlength: 5,
                required: true
            },
            rpassword: {
                minlength: 5,
                required: true,
                equalTo: "#submit_form_password"
            },
            //profile
            fullname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            gender: {
                required: true
            },
            address: {
                required: true
            },
            city: {
                required: true
            },
            country: {
                required: true
            },
            //payment
            card_name: {
                required: true
            },
            card_number: {
                minlength: 16,
                maxlength: 16,
                required: true
            },
            card_cvc: {
                digits: true,
                required: true,
                minlength: 3,
                maxlength: 4
            },
            card_expiry_date: {
                required: true
            },
            'payment[]': {
                required: true,
                minlength: 1
            }
        };
        var messages = { // custom messages for radio buttons and checkboxes
            'payment[]': {
                required: "Please select at least one option",
                minlength: jQuery.validator.format("Please select at least one option")
            }
        };

        var wizard =  $('#form_wizard_1');

        $("#country_list").select2({
            placeholder: "Select",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });

        //Aplicar la validación en select2 cambio de valor desplegable, esto sólo es necesario para la integración de lista desplegable elegido.
        $('#country_list', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });



        FormWizard.init(wizard, form, rules, messages, false);

    });
</script>