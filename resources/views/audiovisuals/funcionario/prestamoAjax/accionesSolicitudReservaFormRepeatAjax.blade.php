<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Acciones Solicitud Reserva'])
        <div class="row" id="contentFormularioPrestamos">
            @foreach($prestamos as $articulos)
                @if($articulos['PRT_FK_Estado']!=5)
                    @php ++$contador @endphp
                    <div class="col-md-12 fila_articulo" data-id_articulo={{$articulos['id']}}>
                        @if($articulos['consultaArticulos'] == null)
                            <div class="col-md-3">
                                {!! Field::text("textObser".$articulos['id'],$articulos['consultaKitArticulo']['KIT_Nombre'],
                                     ['disabled','label' => 'Nombre Kit', 'required', 'auto' => 'off', 'max' => '255'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-qrcode '])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Field::text("codigoKit".$articulos['id'],$articulos['consultaKitArticulo']['KIT_Codigo'],
                                     ['disabled','label' => 'Codigo Kit', 'required', 'auto' => 'off', 'max' => '255'],
                                     ['help' => 'Codigo del Kit.', 'icon' => 'fa fa-key'])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Field::text('tiempoArticulo'.$articulos['id'],$articulos['tiemporestante'],
                                     ['label' => 'Tiempo Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-hourglass-half '])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Field::text('PRT_Observacion_Entrega'.$articulos['id'],$articulos['PRT_Observacion_Entrega'],
                                     ['disabled','label' => 'Observacion Entrega', 'required', 'auto' => 'off', 'max' => '255'],
                                     ['help' => 'Escribe una descripción del Articulo.', 'icon' => 'fa fa-pencil'])
                                !!}
                            </div>
                        @else
                            <div class="col-md-3">
                                {!! Field::text("textObser".$articulos['id'],$articulos['consultaArticulos']['consultaTipoArticulo']['TPART_Nombre'],
                                     ['disabled','label' => 'Nombre Articulo', 'required', 'auto' => 'off', 'max' => '255', 'disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-desktop '])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Field::text("codigoArticulo".$articulos['id'],$articulos['consultaArticulos']['ART_Codigo'],
                                     ['disabled','label' => 'Codigo Articulo', 'required', 'auto' => 'off', 'max' => '255', 'disabled'],
                                     ['help' => 'Codigo del Articulo.', 'icon' => 'fa fa-key'])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Field::text('tiempoArticulo'.$articulos['id'],$articulos['tiemporestante'],
                                     ['disabled','label' => 'Tiempo Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-hourglass-half'])
                                !!}
                            </div>
                            <div class="col-md-3">
                                {!! Field::text('PRT_Observacion_Entrega'.$articulos['id'],$articulos['PRT_Observacion_Entrega'],
                                     ['label' => 'Observacion Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                     ['help' => 'Escribe una descripción del Articulo.', 'icon' => 'fa fa-pencil'])
                                !!}
                            </div>
                        @endif
                    </div>
                    <br>
                @endif
            @endforeach
            <br>
            <div>
                <div class="col-md-12 col-md-offset-4">
                    {!! Form::button('REGRESAR LISTAR SOLICITUDES RESERVAS', ['class' => 'btn btn-success  getAll','id'=>'regresarBtn']) !!}
                </div>
            </div>
        </div>
    @endcomponent
</div>
<script type="text/javascript">
    var routeUpdate,idArticulo,idVal,observation,idArticuloTiempo,
        idPrestamoSolicitud;
    var co = JSON.stringify({{$contador}});
    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function() {
            $("input[maxlength], textarea[maxlength]").maxlength({
                alwaysShow: true,
                appendToParent: true
            });
        }
        return {
            init: function () {
                handleBootstrapMaxlength();
            }
        };
    }();
    jQuery(document).ready(function () {
        App.unblockUI('.portlet-form');
        ComponentsSelect2.init();
        ComponentsBootstrapMaxlength.init();
        $('#regresarBtn').on('click', function(){
            var route = '{{ route('audiovisuales.gestionReservas.gestionReservasAjax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>
