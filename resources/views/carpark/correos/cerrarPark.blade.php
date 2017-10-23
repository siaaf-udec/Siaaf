@extends('material.layouts.dashboard')

@push('styles')
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('title', '| Cierre de Parqueadero')

@section('page-title', 'Parqueadero Universidad De Cundinamarca Extensión Facatativá:')

@section('content')
    @permission('FUNC_CARPARK')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Enviar correos informativos de cierre de parqueadero:'])
            <br>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-warning">
                        <strong>¡Advertencia!</strong> Este espacio está dedicado al envio de correos informativos para
                        los
                        usuarios que aún tienen su vehículo dentro de las instalaciones sobre el cierre del parqueadero.
                    </div>
                </div>
                <div class="col-md-12 col-md-offset-5">
                    <div class="actions">
                        @permission('CLOSE_CARPARK')<a href="javascript:;" class="btn btn-danger btn-icon enviarCorreos"
                                                       title="Registar nueva dependencia"><i
                                    class="fa fa-paper-plane"></i>Enviar Correos</a>@endpermission
                    </div>
                </div>
            </div>
            <br>
        @endcomponent
    </div>
    @endpermission
@endsection

@push('plugins')
<!-- Datatables Scripts -->

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
        type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>

@endpush
@push('functions')
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {

        $(".enviarCorreos").on('click', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var route = '{{ route('parqueaderos.correosCarpark.enviarMail') }}';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro que desea enviar las advertencias?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: 'POST',
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {

                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se enviaron las advertencias.", "error");
                    }
                });
        });

    });
</script>
@endpush