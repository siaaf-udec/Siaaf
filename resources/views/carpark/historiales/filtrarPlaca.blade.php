@permission('REPORT_HISTOPLACA_CARPARK')
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de filtrado de un reporte por código.'])
        @slot('actions', [
               'link_cancel' => [
                   'link' => '',
                   'icon' => 'fa fa-arrow-left',
                                ],
        ])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                {!! Form::open (['id'=>'form_filtrar_placa','method'=>'POST','target'=>'_blank','route'=> ['parqueadero.reportesCarpark.filtradoPlaca']]) !!}

                <div class="form-body">

                    {!! Field:: text('PlacaVehiculo',null,['label'=>'Placa del vehículo:','required','minlength'=>'5','class'=> 'form-control', 'autofocus', 'maxlength'=>'6','autocomplete'=>'off'],['help' => 'Digite la placa del vehículo.','icon'=>'fa fa-user']) !!}

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('REPORT_HISTOPLACA_CARPARK')<a href="javascript:;"
                                                                           class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission
                                @permission('REPORT_HISTOPLACA_CARPARK'){{ Form::submit('Generar Reporte', ['class' => 'btn blue']) }}@endpermission
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

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.historialesCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

        $("#link_cancel").on('click', function (e) {
            var route = '{{ route('parqueadero.historialesCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>
