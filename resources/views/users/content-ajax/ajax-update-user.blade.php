{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Editar Usuario'])
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
                        {!! Form::open(['id' => 'from_users_create', 'class' => 'form-horizontal', 'url' => '/forms']) !!}
                        <div class="form-wizard">
                            <div class="form-body">
                                <ul class="nav nav-pills nav-justified steps">
                                    <li>
                                        <a href="#tab1" data-toggle="tab" class="step">
                                            <span class="number"> 1 </span>
                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Configuracion de Cuenta </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab2" data-toggle="tab" class="step">
                                            <span class="number"> 2 </span>
                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Configuración del Perfil </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab3" data-toggle="tab" class="step active">
                                            <span class="number"> 3 </span>
                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Configuración de Permisos </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#tab4" data-toggle="tab" class="step">
                                            <span class="number"> 4 </span>
                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Confirmación </span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="bar" class="progress progress-striped" role="progressbar">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="alert alert-danger display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        Usted tiene algunos errores de forma. Por favor, compruebe a continuación.
                                    </div>
                                    <div class="alert alert-success display-none">
                                        <button class="close" data-dismiss="alert"></button>
                                        ¡La validación de su formulario es exitosa!
                                    </div>
                                    <div class="tab-pane active" id="tab1">
                                        <h3 class="block">Datos Personales</h3>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-1">
                                                {!! Field::hidden('id_edit', $user->id) !!}
                                                {!! Field::text(
                                                        'name_create', $user->name,
                                                        ['label' => 'Nombre', 'auto' => 'off'],
                                                        ['help' => 'Digite su Nombre']) !!}
                                                {!! Field::date(
                                                        'date_birthday', $user->birthday,
                                                        ['label' => 'Fecha de Nacimiento', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                        ['help' => 'Digite su fecha de nacimiento', 'icon' => 'fa fa-calendar']) !!}
                                                {!! Field::select(
                                                        'identity_type_create',
                                                        ['T.I' => 'T.I', 'C.C' => 'C.C'],$user->identity_type,
                                                        [ 'label' => 'Tipo de identificación']) !!}
                                                {!! Field::date(
                                                        'identity_expe_create', $user->birthday,
                                                        ['label' => 'Fecha de Expedición', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date' => "+0d"],
                                                        ['help' => 'Digite su fecha de expedición', 'icon' => 'fa fa-calendar']) !!}
                                                {!! Field::text(
                                                        'phone_create', $user->phone,
                                                        ['label' => 'Numero Telefonico', 'auto' => 'off'],
                                                        ['help' => 'Digite su numero telefonico']) !!}
                                                {!! Field::email(
                                                        'email_create', $user->email,
                                                        ['label' => 'Correo Electronico', 'auto' => 'off'],
                                                        ['help' => 'Digite su correo electronico']) !!}
                                                {!! Field::password(
                                                        'password_create',
                                                        ['label' => 'Nueva Contraseña', 'disabled'],
                                                        ['help' => 'Digite su contreaseña.']) !!}
                                            </div>
                                            <div class="col-md-4 col-md-offset-1">
                                                {!! Field::text(
                                                        'lastname_create', $user->lastname,
                                                        ['label' => 'Apellido', 'auto' => 'off'],
                                                        ['help' => 'Digite su Apellido']) !!}
                                                {!! Field::select(
                                                        'sexo_create',
                                                        ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'], $user->sexo,
                                                        [ 'label' => 'Sexo']) !!}
                                                {!! Field::text(
                                                        'identity_no_create', $user->identity_no,
                                                        ['label' => 'Numero de Identificación', 'auto' => 'off'],
                                                        ['help' => 'Numero de Identificación']) !!}
                                                {!! Field::text(
                                                        'identity_expe_place_create', $user->identity_expe_place,
                                                        ['label' => 'Lugar de expedición', 'auto' => 'off'],
                                                        ['help' => 'Lugar de expedición']) !!}
                                                {!! Field::select(
                                                        'state_create',
                                                        ['Aprobado' => 'Aprobado', 'Pendiente' => 'Pendiente', 'Denegado' => 'Denegado'], $user->state,
                                                        [ 'label' => 'Estado']) !!}
                                                {!! Field::password(
                                                        'password_update',
                                                        ['label' => 'Contraseña'],
                                                        ['help' => 'Digite su nueva contreaseña.']) !!}
                                                {!! Field::password(
                                                        'password_create_verify',
                                                        ['label' => 'Nueva Contraseña' , 'disabled'],
                                                        ['help' => 'Digite su nueva contreaseña.']) !!}
                                            </div>
                                        </div>
                                        <h3 class="block">Datos de Ubicación</h3>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-1">
                                                {!! Field::text(
                                                        'address_create', $user->address,
                                                        ['label' => 'Dirección Procedencia', 'auto' => 'off'],
                                                        ['help' => 'Digite su dirección de procedencia']) !!}
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
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-1">
                                                {!!  Field::file('image_profile_create') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <h3 class="block">Proporcione el roll</h3>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-1">
                                                <select multiple="multiple" class="multi-select"
                                                        id="multi_select_roles_create"
                                                        name="multi_select_roles_create[]">
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <h3 class="block">Confirme su cuenta</h3>
                                        <h4 class="form-section">Datos Personales</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nombre:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="name_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Apellido:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="lastname_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Fecha de Nacimiento:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="date_birthday"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Sexo:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="sexo_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tipo de identificación:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="identity_type_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Numero de Identificación:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="identity_no_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Fecha de Expedición:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="identity_expe_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Lugar de expedición:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static"
                                                   data-display="identity_expe_place_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Numero Telefonico:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="phone_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Estado:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="state_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Correo Electronico:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="email_create"></p>
                                            </div>
                                        </div>
                                        <h4 class="form-section">Datos de Ubicación</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Dirección Procedencia:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="address_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Pais:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="countries_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Departamento:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="regions_create"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Ciudad:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static" data-display="cities_create"></p>
                                            </div>
                                        </div>
                                        <h4 class="form-section">Datos de Permisos</h4>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Roles:</label>
                                            <div class="col-md-4">
                                                <p class="form-control-static"
                                                   data-display="multi_select_roles_create[]"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="javascript:;" class="btn btn-outline red button-cancel"><i
                                                    class="fa fa-angle-left"></i>
                                            Cancelar
                                        </a>
                                        <a href="javascript:;" class="btn default button-previous">
                                            <i class="fa fa-angle-left"></i> Atras </a>
                                        <a href="javascript:;" class="btn btn-outline green button-next"> Continuar
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
    jQuery(document).ready(function () {


        var $widget_select_countries_create = $('select[name="countries_create"]'),
            $widget_select_regions_create = $('select[name="regions_create"]'),
            $widget_select_cities_create = $('select[name="cities_create"]'),
            $widget_select = $("#multi_select_roles_create");

        /*Asignacion de roles*/
        $widget_select.multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' '>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' '>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            selectableOptgroup: true
        });

        /*Carga todos los paises*/
        var route_country = '{{ route('location.countries') }}';
        $.get(route_country, function (response, status) {
            $(response.data).each(function (key, value) {
                $widget_select_countries_create.append(new Option(value.name, value.id));
            });
        });

        /*Carga todos los Departamentos*/
        var region_id;
        $widget_select_countries_create.on('change', function () {
            region_id = $(this).val();
            var route_region = '{{ route('location.regions.find') }}' + '/' + region_id;
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
                        $(response.data).each(function (key, value) {
                            $widget_select_regions_create.append(new Option(value.name, value.id));
                        });
                    }
                }
            });
        });


        /*Carga todas las Ciudades*/
        $widget_select_regions_create.on('change', function () {
            var route_city = '{{ route('location.cities.find') }}' + '/' + region_id + '/' + $(this).val();
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

        /*Carga la foto*/
        $('#file_image').attr("src", "{{$img}}");

        /*Configuracion de input tipo fecha*/
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

        //Aplicar la validación en select2 cambio de valor desplegable, esto sólo es necesario para la integración de lista desplegable elegido.
        $('.pmd-select2', form).change(function () {
            form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
        });

        var form = $('#from_users_create');
        var rules = {
            name_create: {minlength: 5, required: true},
            lastname_create: {minlength: 5, required: true},
            email_create: {
                required: true, email: true, remote: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route('users.check.email') }}',
                    type: 'POST'
                }
            },
            password_update: {
                minlength: 4, remote: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route('users.check.password') }}',
                    type: 'POST',
                    success: function (response, xhr, request) {
                        if (request.status === 200 && xhr === 'success') {
                            let password_new = $('input[name="password_create"]'),
                                password_new_verify = $('input[name="password_create_verify"]');
                            if (response === true) {
                                password_new.prop("disabled", false);
                                password_new_verify.prop("disabled", false);
                            } else {
                                password_new.prop("disabled", true);
                                password_new_verify.prop("disabled", true);
                            }
                        }
                    },
                }
            },
            password_create: {minlength: 5, required: true},
            password_create_verify: {minlength: 5, equalTo: "#password_create", required: true},
            state_create: {required: true},
            phone_create: {minlength: 5},
            sexo_create: {required: true},
            identity_expe_place_create: {minlength: 5},
            identity_no_create: {minlength: 5, number: true},
            address_create: {minlength: 5},
            image_profile_create: {extension: "jpg|png"},
            'multi_select_roles_create[]': {minlength: 1}
        };
        var messages = {};
        var wizard = $('#form_wizard_1');

        /*Crear Usuarios*/
        var createUsers = function () {
            return {
                init: function () {
                    let $user = $('input[name="id_edit"]').val(),
                        route = '{{ route('users.update') }}' + '/' + $user,
                        type = 'POST';

                    var async = async || false;

                    let formData = new FormData();
                    formData.append('id', $user);
                    formData.append('name', $('input:text[name="name_create"]').val());
                    formData.append('lastname', $('input:text[name="lastname_create"]').val());
                    formData.append('birthday', $('#date_birthday').val());
                    formData.append('sexo', $('select[name="sexo_create"]').val());
                    formData.append('identity_type', $('select[name="identity_type_create"]').val());
                    formData.append('identity_no', $('input:text[name="identity_no_create"]').val());
                    formData.append('identity_expe_date', $('#identity_expe_create').val());
                    formData.append('identity_expe_place', $('input:text[name="identity_expe_place_create"]').val());
                    formData.append('phone', $('input:text[name="phone_create"]').val());
                    formData.append('state', $('select[name="state_create"]').val());
                    formData.append('email', $('input[name="email_create"]').val());
                    formData.append('password', $('input[name="password_update"]').val());
                    formData.append('password_new', $('input[name="password_create"]').val());
                    formData.append('address_create', $('input:text[name="address_create"]').val());
                    formData.append('countries_id', $('select[name="countries_create"]').val());
                    formData.append('regions_id', $('select[name="regions_create"]').val());
                    formData.append('cities_id', $('select[name="cities_create"]').val());

                    /*Roles*/
                    var roles_create = $('#multi_select_roles_create');
                    formData.append('multi_select_roles_create',
                        (roles_create.val() === null) ? [] : roles_create.val()
                    );

                    /*Imagen*/
                    var FileImage = document.getElementById("image_profile_create");
                    formData.append('image_profile_create', FileImage.files[0]);

                    var hash = "c157a79031e1c40f85931829bc5fc552";  // 15+ hex chars
                    var options = {
                        foreground: [0, 0, 0, 255],               // rgba black
                        background: [255, 255, 255, 255],         // rgba white
                        margin: 0.2,                              // 20% margin
                        size: 420,                                // 420px square
                        format: 'svg'                             // use SVG instead of PNG
                    };
                    var data = new Identicon(hash, options).toString();
                    data = 'data:image/svg+xml;base64,' + data;
                    formData.append('identicon', data);

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
                                $('#from_users_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                                var route = '{{ route('users.index.ajax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };


        FormWizard.init(wizard, form, rules, messages, createUsers());

        let loadData = function () {
            $('select[name="countries_create"]').val('{{ $user->country->id }}');
        }();

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            let route = '{{ route('users.index.ajax') }}';
            $(".content-ajax").load(route);
        });


    });
</script>
