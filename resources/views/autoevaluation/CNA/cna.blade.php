@permission('AUTOEVALUACION') @extends('material.layouts.dashboard') @push('styles') {{--Select2--}}
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"
/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
<!-- MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"
/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"
/>
<!-- DATATABLE  -->
<link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet"
    type="text/css" /> {{--toast--}}
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" /> {{--JQuery datatable and row details--}} @endpush @section('content') {{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-info', 'title' => 'Consejo nacinal de acreditacion'])
    <div class="clearfix">
    </div>
    <div class="clearfix">
    </div>
    <br>
    <div class="col-md-12">

        <!-- BEGIN TAB PORTLET-->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-anchor font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">CNA</span>
                </div>
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown"
                            data-close-others="true"> Actions
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;"> Option 1</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;">Option 2</a>
                            </li>
                            <li>
                                <a href="javascript:;">Option 3</a>
                            </li>
                            <li>
                                <a href="javascript:;">Option 4</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <p> El proceso de acreditación comienza con el proceso de autoevaluación que realiza la misma institución, prosigue
                    con la evaluación externa que cumplen los pares designados por el Consejo, continúa con la recomendación
                    final que efectúa el Consejo y termina con la expedición del acto administrativo que emite el Ministerio
                    de Educación Nacional.</p>
                <div class="tabbable tabbable-tabdrop">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">Factor</a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">Caracteristica</a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab">Aspecto</a>
                        </li>
                        <li>
                            <a href="#tab4" data-toggle="tab">Indicadores</a>
                        </li>
                        <li>
                            <a href="#tab5" data-toggle="tab">Grupo de Interes</a>
                        </li>
                        <li>
                            <a href="#tab5" data-toggle="tab">Proceso</a>
                        </li>
                        <li>
                            <a href="#tab5" data-toggle="tab">Proceso usuario</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <p> Ahora puedes agregar factores. </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="icon-settings font-dark"></i>
                                                <span class="caption-subject bold uppercase">Factor actuales</span>
                                            </div>

                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-toolbar">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <br>
                                                        <br>
                                                    </div>

                                                </div>
                                            </div>
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                                <span></span>
                                                            </label>
                                                        </th>
                                                        <th> Nombre </th>
                                                        <th> Ponderacion </th>
                                                        <th> Estado </th>
                                                        <th> Fecha de creacion </th>
                                                        <th> Opciones </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="checkboxes" value="1" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td> Calidad de educacion </td>
                                                        <td>
                                                            <a href="mailto:shuxer@gmail.com"> 2.5 </a>
                                                        </td>
                                                        <td>
                                                            <span class="label label-sm label-success"> ACTIVO </span>
                                                        </td>
                                                        <td class="center"> 12 Jan 2012 </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu pull-left" role="menu">
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-docs"></i> Modificar </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-tag"></i> Inhabilitar </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-user"></i> habilitar </a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="checkboxes" value="1" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td> Nivel de satisfaccion </td>
                                                        <td>
                                                            <a href="mailto:looper90@gmail.com"> 3.5 </a>
                                                        </td>
                                                        <td>
                                                            <span class="label label-sm label-warning"> SUSPENDIDO </span>
                                                        </td>
                                                        <td class="center"> 12.12.2011 </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu pull-left" role="menu">
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-docs"></i> Modificar </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-tag"></i> Inhabilitar </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-user"></i> habilitar </a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                <input type="checkbox" class="checkboxes" value="1" />
                                                                <span></span>
                                                            </label>
                                                        </td>
                                                        <td> Nivel de conocimiento </td>
                                                        <td>
                                                            <a href="mailto:userwow@yahoo.com"> 2.0 </a>
                                                        </td>
                                                        <td>
                                                            <span class="label label-sm label-success"> ACTIVO </span>
                                                        </td>
                                                        <td class="center"> 12.12.2011 </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu pull-left" role="menu">
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-docs"></i> Modificar </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-tag"></i> Inhabilitar </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:;">
                                                                            <i class="icon-user"></i> habilitar </a>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END EXAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                            <div class="tabbable tabbable-tabdrop">
                                <ul class="nav nav-pills">
                                    <li class="active">
                                        <a href="#tab11" data-toggle="tab" class="fac">Agregar Factor</a>
                                    </li>
                                    
                                    <li>
                                        <a href="#tab13" data-toggle="tab" class="file">Subir archivo Factor</a>
                                    </li>
                                    

                                </ul>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <p> Ahora puedes agregar caracteristicas. </p>
                            <div class="tabbable tabbable-tabdrop">
                                <ul class="nav nav-pills">
                                    <li class="active">
                                        <a href="#tab11" data-toggle="tab" class="creat">Agregar Caracteristica</a>
                                    </li>
                                    <li>
                                        <a href="#tab12" data-toggle="tab">Modificar Caracteristica</a>
                                    </li>
                                    <li>
                                        <a href="#tab13" data-toggle="tab">Ambito de la caracteristica</a>
                                    </li>
                                    <li>
                                        <a href="#tab14" data-toggle="tab">Inhabilitar o habilitar Caracteristica</a>
                                    </li>

                                </ul>

                            </div>

                        </div>
                        <div class="tab-pane" id="tab3">
                            <p> Ahora puedes agregar aspectos. </p>
                            <div class="tabbable tabbable-tabdrop">
                                <ul class="nav nav-pills">
                                    <li class="active">
                                        <a href="#tab11" data-toggle="tab" class="creat">Agregar aspecto</a>
                                    </li>
                                    <li>
                                        <a href="#tab12" data-toggle="tab">Modificar aspecto</a>
                                    </li>
                                    <li>
                                        <a href="#tab14" data-toggle="tab">Inhabilitar o habilitar aspecto</a>
                                    </li>

                                </ul>

                            </div>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <p> Howdy, in Section 4. </p>
                        </div>
                        <div class="tab-pane" id="tab5">
                            <p> Howdy, in Section 5. </p>
                        </div>
                        <div class="tab-pane" id="tab6">
                            <p> Howdy, in Section 6. </p>
                        </div>
                        <div class="tab-pane" id="tab7">
                            <p> Howdy, in Section 7. </p>
                        </div>
                        <div class="tab-pane" id="tab8">
                            <p> Howdy, in Section 8. </p>
                        </div>
                        <div class="tab-pane" id="tab9">
                            <p> Howdy, Im in Section 9. </p>
                        </div>
                    </div>
                </div>
                <p> &nbsp; </p>
                <p> &nbsp; </p>

            </div>
        </div>

    </div>
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
            <div class="modal fade" data-width="760" id="modal-create-cate" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h4 class="modal-title">
                        <i class="glyphicon glyphicon-tv">
                        </i>
                        Registrar Caracteristica
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-4">Caracteristica</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-4">Factores</label>
                            <div class="col-md-8">
                                <select class="form-control select2-multiple" multiple>
                                    <optgroup label="Alaskan">
                                        <option value="AK">Alaska</option>
                                        <option value="HI" disabled="disabled">Hawaii</option>
                                    </optgroup>
                                    <optgroup label="Pacific Time Zone">
                                        <option value="CA">California</option>
                                        <option value="NV">Nevada</option>
                                        <option value="OR">Oregon</option>
                                        <option value="WA">Washington</option>
                                    </optgroup>
                                    <optgroup label="Mountain Time Zone">
                                        <option value="AZ">Arizona</option>
                                        <option value="CO">Colorado</option>
                                        <option value="ID">Idaho</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="UT">Utah</option>
                                        <option value="WY">Wyoming</option>
                                    </optgroup>
                                    <optgroup label="Central Time Zone">
                                        <option value="AL">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TX">Texas</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="WI">Wisconsin</option>
                                    </optgroup>
                                    <optgroup label="Eastern Time Zone">
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="IN">Indiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="OH">Ohio</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WV">West Virginia</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss'
                    => 'modal' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
            {{-- END HTML MODAL CREATE--}}
        </div>
        {{-- END HTML MODAL CREATE--}}
    </div>
    <div class="row">
        <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
            <div class="modal fade" data-width="760" id="modal-create-fac" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h4 class="modal-title">
                        <i class="glyphicon glyphicon-tv">
                        </i>
                        Registrar Factor
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-4">Factor</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss'
                    => 'modal' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
            {{-- END HTML MODAL CREATE--}}
        </div>
        {{-- END HTML MODAL CREATE--}}
    </div>
    <div class="row">
        <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
            <div class="modal fade" data-width="760" id="modal-create-articulo" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h2 class="modal-title">
                        <i class="glyphicon glyphicon-tv">
                        </i>
                        Cargar Archivo.
                    </h2>
                </div>
                <div class="modal-body">
                    <div class="portlet light " id="form_wizard_1">
                        <div class="portlet-body form">
                            {!! Form::open(['id' => 'form_archivo', 'class' => '', 'url'=>'/forms']) !!}
                            <div class="form-wizard">
                                <div class="col-md-12">
                                    {!! Field:: text('codigo',['required', 'label' => 'Nombre archivo', 'max' => '30', 'min' => '3', 'auto' => 'off', 'rows'
                                    => '1'], ['help' => 'Escriba el codigo o serial asociado al articulo que pretende registrar','icon'=>'fa
                                    fa-barcode'] ) !!} {!! Field:: textarea('descripcion',['required', 'label' => 'descripcion',
                                    'max' => '450', 'min' => '15', 'auto' => 'off', 'rows' => '3'], ['help' => 'Digite la
                                    descripción del articulo','icon'=>'fa fa-desktop'] ) !!}
                                    <div>
                                        <h3 class="block">Subir archivo</h3>
                                        <h6>10 archivos maximos</h6>
                                    </div>
                                    <div class="form-group">
                                        <div class="dropzone dropzone-file-area data-dz-size" id="my_dropzone">
                                            <h3 class="sbold">Arrastra o da click aquí para cargar el archivo</h3>
                                            <p> Solo se admiten formatos .CSV </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="modal-footer">
                                    @permission('AUTOEVALUACION') {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!} @endpermission {!! Form::button('Cancelar',
                                    ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="modal-footer">
                </div>
                {{-- END HTML MODAL CREATE--}} {{-- END HTML MODAL CREATE--}}
            </div>

        </div>
        {{-- END HTML MODAL CREATE--}}
    </div>
    @endcomponent
</div>
{{-- END HTML SAMPLE --}} @endsection @push('plugins') {{--Selects--}}
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- SCRIPT DATATABLE -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/table-datatables-responsive.min.js') }}" type="text/javascript"></script>
<!-- SCRIPT MODAL -->
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<!-- SCRIPT Validacion Maxlength -->
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Personalizadas -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<!-- SCRIPT MENSAJES TOAST-->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
@endpush @push('functions')
<!--HANDLEBAR-->
<script src="{{ asset('assets/main/acadspace/js/handlebars.js') }}"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<!-- Estandar Mensajes -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<!-- Estandar Datatable -->
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
{{--ROW DETAILS DESPLEGABLE--}}
<script id="details-template" type="text/x-handlebars-template"></script>
<script>
    $(document).ready(function () {
        //inicializar select
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            placeholder: "Seleccionar",
            allowClear: true,
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });
        /*ABRIR MODAL*/
        $(".creat").on('click', function (e) {
            e.preventDefault();
            $('#modal-create-cate').modal('toggle');
        });
        $(".file").on('click', function (e) {
            e.preventDefault();
            $('#modal-create-articulo').modal('toggle');
        });
        $(".fac").on('click', function (e) {
            e.preventDefault();
            $('#modal-create-fac').modal('toggle');
        });

    });
</script>
@endpush @endpermission