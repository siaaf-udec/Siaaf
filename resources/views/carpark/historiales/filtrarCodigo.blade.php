<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de filtrado de un reporte por código.'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                {!! Form::open (['id'=>'form_filtrar_codigo','method'=>'POST','target'=>'_blank','route'=> ['parqueadero.reportesCarpark.filtradoCodigo']]) !!}

                <div class="form-body">                    

                    {!! Field:: text('CodigoUsuario',null,['label'=>'Código del usuario:','required','minlength'=>'9','class'=> 'form-control', 'autofocus', 'maxlength'=>'9','autocomplete'=>'off'],['help' => 'Digite el código del usuario.','icon'=>'fa fa-user']) !!}
                                    
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">                                
                                <a href="javascript:;" class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>
                                {{ Form::submit('Generar Reporte', ['class' => 'btn blue']) }}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endcomponent
</div>

<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"><scripts>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
        
    jQuery(document).ready(function () {
                

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('parqueadero.historialesCarpark.index.ajax') }}';
            $(".content-ajax").load(route);
        });

    });

</script>