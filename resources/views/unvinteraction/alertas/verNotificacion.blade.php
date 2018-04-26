<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'ALERTA DEL CONVENIO'])
            <div class="row">
                <div class="col-md-7">
                    <div class="container-fluid">
                             <h1>
                                {{$notificacion->NTFC_Titulo}}
                            </h1>  
                        </div>
                       <div class="col-lg-12">
                          <h4>
                                {{$notificacion->NTFC_Mensaje}}
                          </h4>  
                       </div>
                    <div class="col-md-7"> 
                        <br>
                        <br>
                        <br>
                        {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                    </div>
            </div>

        @endcomponent
    </div>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {    
    $('.atras').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('alertaAjax.alertaAjax') }}';
            $(".content-ajax").load(route);
        });
  });   
</script>
