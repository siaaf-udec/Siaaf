<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION  DEL CONVENIO'])
            <div class="row">
                <div class="col-md-7">
                    <div class="container-fluid">
                             <h1>
                                {{$Notificacion->Titulo}}
                            </h1>  
                        </div>
                       <div class="col-lg-12">
                          <h4>
                                {{$Notificacion->Mensaje}}
                          </h4>  
                       </div>
                    <div class="col-md-7"> 
                        
                    {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                    </div>
            </div>

        @endcomponent
    </div>

<script>
jQuery(document).ready(function () {    
    $('.atras').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('Alerta_Ajax.Alerta_Ajax') }}';
            $(".content-ajax").load(route);
        });
  });   
</script>
