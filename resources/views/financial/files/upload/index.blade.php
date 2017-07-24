@extends('material.layouts.dashboard')

@push('styles')
<!-- SweetAlert Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<!-- Toaster Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Dropzone Styles -->
<link href="{{ mix('assets/pages/scripts/financial/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Spinner Styles -->
<link href="{{asset('assets/global/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Select2 Style -->
<link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', ' | Gestión de Archivos')

@section('page-title', 'Almacenar Archivos')

@section('page-description', 'para validación de archivos Icetex y Apoyo Financiero')

@section('content')
    <div class="col-md-12">
        {{-- BEGIN HTML SAMPLE --}}
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers', 'title' => 'Carga Masiva de Sedes'])
            <div class="row">
                <div class="col-md-12">
                    {{ Form::open(['id' => 'financial-form-files']) }}
                        {!! Field::select('request_type', ['icetex' => 'Solicitud Icetex', 'apoyo' => 'Apoyo Financiero']) !!}
                        <div id="dropzone" class="dropzone"></div>
                        <span class="text text-center">
                            <strong>Arrastra el archivo PDF</strong> aquí o da <strong>click</strong> para seleccionarlo de tu equipo.<br>
                        </span>
                        <hr>
                        <div class="col-md-12 text-center margin-top-15">
                            <button type="submit" class="btn btn-warning mt-ladda-btn ladda-button" id="submit" data-style="zoom-in">
                                <span class="ladda-label">
                                    <i class="fa fa-cloud-upload"></i> Cargar archivo de Excel</span>
                                <span class="ladda-spinner"></span>
                            </button>
                        </div>
                    {{ Form::close() }}
                </div>

            </div>
        @endcomponent
        {{-- END HTML SAMPLE --}}
    </div>
@endsection



@push('plugins')
<!-- Validation Scripts -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/pages/scripts/financial/financial-form-validation.min.js') }}" type="text/javascript"></script>
<!-- SweetAlert Scripts -->
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<!-- Toastr Scripts -->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/pages/scripts/financial/ui-toaster.min.js') }}" type="text/javascript"></script>
<!-- Dropzone Scripts -->
<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/pages/scripts/financial/file-upload-dropzone.min.js') }}" type="text/javascript"></script>
<!-- Spinner Scripts -->
<script src="{{ asset('assets/global/plugins/ladda/spin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/ladda/ladda.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/ui-buttons-spinners.js') }}" type="text/javascript"></script>
<!-- Select2 Scripts -->
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
<script src="{{ mix('assets/pages/scripts/financial/financial-select2.min.js') }}" type="text/javascript"></script>
@endpush


@push('functions')
<script>
    $(document).ready(function() {
        var route = "{{ route('financial.files.store') }}";
        var thumb = "{{ asset('assets/pages/scripts/financial/pdf.png') }}";
        FormValidationFile.init();
        DropZone.init(route, thumb);
    });
</script>
@endpush