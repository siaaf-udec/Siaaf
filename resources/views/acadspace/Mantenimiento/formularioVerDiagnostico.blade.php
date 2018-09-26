<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Cerrar mantenimiento'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="form-body">
                    {!! Form::open(['id'=>'form-cate','url' => '/forms']) !!}
                    <div class="form-wizard">
                        {!! Field:: textarea('MANT_Solucion',$findDescri[0]->MANT_Descripcion_Errores,['name'=>'MANT_Solucion','label'=>'Errores encontrados en el equipo y la solucion', 
                        'class'=> 'form-control', 'autofocus','disabled'],['icon'=>'fa fa-barcode'] ) !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12 col-md-offset-0">
                           {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                        </div>
                          {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
</div>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        $('.atras').on('click', function (e) {
            e.preventDefault();
            location.reload();
        });
    });
</script>