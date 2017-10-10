@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('title', '| Información del parqueadero')

@section('page-title', 'Listado motocicletas en el parqueadero:')

@section('content')
@permission('FUNC_CARPARK')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de confirmación de acción'])
          @slot('actions', [
           'link_cancel' => [
               'link' => '',
               'icon' => 'fa fa-arrow-left',
                            ],
            ])
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                {!! Form::open (['id'=>'form_filtrar_codigo','method'=>'POST','route'=> ['parqueadero.ingresosCarpark.registroTarjeta']]) !!}

                    <div class="form-body">

                        <div class="row">

                            <div class="col-md-6">
                                <img src="{{ asset(Storage::url($infoUsuario['CU_UrlFoto'])) }}" class="img-circle" height="250" width="250">
                            </div>

                            <div class="col-md-6">
                                <img src="{{ asset(Storage::url($infoMoto['CM_UrlFoto'])) }}" class="" height="250" width="250">
                            </div>

                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-6">

                                {!! Field:: text('CI_CodigoUser',$infoUsuario['PK_CU_Codigo'],['label'=>'Código del usuario:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}
                                                             
                                {!! Field:: text('CI_NombresUser',$infoUsuario['CU_Nombre1'].' '.$infoUsuario['CU_Apellido1'],['label'=>'Nombre del usuario:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                                 ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                
                            </div>                            
                            <div class="col-md-6">

                                {!! Field:: text('CI_Placa',$infoMoto['CM_Placa'],['label'=>'Placa del vehículo:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}

                                {!! Field:: text('CI_CodigoMoto',$infoMoto['PK_CM_IdMoto'],['label'=>'Código del vehículo:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite interno de la universidad del usuario.','icon'=>'fa fa-credit-card'] ) !!}
                                
                            </div>

                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-5">                                    
                                    @permission('FUNC_CARPARK')<a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                        Volver
                                    </a>@endpermission
                                    @permission('FUNC_CARPARK'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
        @endcomponent
    </div>
@endpermission
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.quicksearch.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

jQuery(document).ready(function () {        

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

   

       $( "#link_cancel" ).on('click', function (e) {
       var route = '{{ route('parqueadero.ingresosCarpark.index.ajax') }}';
       $(".content-ajax").load(route);
       }); 
        
        
    });
</script>
@endpush