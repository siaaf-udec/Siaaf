
@extends('material.layouts.dashboard')

@push('styles')
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title', 'Formatos Academicos')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Formatos Academicos'])

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
            <div class="clearfix"> </div><br><br><br>
            <div class="row">
                <div class="col-md-7 col-md-offset-2">

                    {!! Field::text(
                    'date_range',
                    ['required', 'readonly', 'auto' => 'off', 'class' => 'range-date-time-picker'],
                    ['help' => 'Selecciona un rango de fechas.', 'icon' => 'fa fa-calendar'])       !!}

                    {!! Field:: text('txt_nombre',null,['label'=>'Nombre Archivo:', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                                         ['help' => 'Digita el archivo','icon'=>'fa fa-desktop'] ) !!}


                    {!! Field:: text('txt_descripcion',null,['label'=>'Descripcion','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                                                     ['help' => 'Digita la descripcion.','icon'=>'fa fa-user']) !!}

                    {!! Field:: text('txt_correo',null,['label'=>'Correo destinatario','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],
                    ['help' => 'Ingrese el correo.','icon'=>'fa fa-user']) !!}


                </div>

                <div class="col-md-7 col-md-offset-5">
                    <br>
                    {!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                </div>
            </div>
        @endcomponent
    </div>
@endsection

@push('plugins')
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/dropzone.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function() {
        /*Crear Solicitud Formato*/
        var createSolicitud = function () {
            return{
                init: function () {
                    var route = '{{ route('espacios.academicos.formacad.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('titulo', $('input:text[name="txt_nombre"]').val());
                    formData.append('descripcion', $('input:text[name="txt_descripcion"]').val());

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
                                table.ajax.reload();
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'danger') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var route = '{{route('espacios.academicos.formacad.store')}}';
        var formatfile = 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.pdf';
        var numfile = 2;
        FormDropzone.init(route, formatfile, numfile, createSolicitud());
    });

</script>
@endpush