<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Asignar Prestamo'])
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
                <div class="modal fade" data-width="760" id="modal-recibir-kit" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-tv">
                            </i>
                            Recibir Kit
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'from_kit_recibir', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <p>
                                    {!! Field::textarea('elementosKit',
                                        ['label' => 'Elementos Del Kit', 'required', 'auto' => 'off', 'max' => '255', "rows" => '4'],
                                        ['help' => 'Elementos Del Kit.', 'icon' => 'fa fa-quote-right'])
                                    !!}
                                </p>
                                <p>
                                    {!! Field::text('observacionKit',
                                        ['label' => 'Descripcion Kit:'],
                                        ['help' => 'Descripcion Kit.', 'icon' => 'fa fa-ban'])
                                    !!}
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Recibir', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
                <div class="modal fade" data-width="760" id="modal-tiempo-prestamo" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-user">
                            </i>
                            Recibir Solicitud
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'from_tiempo_sumar', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                {!! Field::text('tipoArticulo',
                                ['disabled','label' => 'tipo Articulo:', 'max' => '40', 'min' => '2', 'auto' => 'off','tabindex'=>'2','disabled'],
                                ['help' => 'Nombre Articulo', 'icon' => 'fa fa-user'])
                                !!}
                            </div>
                            <div class="col-md-6">
                                {!! Field::select('tiempoSelect',
                                     null,
                                ['label' => 'Tiempo Articulo'])
                                !!}
                            </div>

                        </div>

                        <div class="modal-footer">
                            {!! Form::submit('ACEPTAR', ['class' => 'btn blue']) !!}
                            {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
                <div class="modal fade" data-width="520" id="modal-observation-prestamo" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-ok-circle">
                            </i>
                            Recibir Solicitud
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'from_observation', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                {{--<p>
                                    {!! Field::text('observacionGeneral',
                                    ['label' => 'Observacion:', 'max' => '40', 'min' => '2', 'auto' => 'off','tabindex'=>'2'],
                                    ['help' => 'Observacion', 'icon' => 'fa fa-user'])
                                    !!}

                                </p>--}}
                                {!! Field::textarea(
                            'observacionGeneral',
                            ['label' => 'Observación', 'required', 'auto' => 'off', 'max' => '255', "rows" => '3'],
                            ['help' => 'Escribe una observación.', 'icon' => 'fa fa-quote-right']) !!}

                            </div>
                        </div>

                        <div class="modal-footer col-md-6 col-md-offset-3">
                            {!! Form::submit('ACEPTAR', ['class' => 'btn blue']) !!}
                            {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
                <div class="modal fade" data-width="520" id="modal-advertencia-tiempo" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-time">
                            </i>
                            Recibir Solicitud
                        </h2>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::text('tipoArticulo','El articulo no puede ser asignado mas tiempo',
                                ['disabled','label' => 'tipo Articulo:', 'max' => '40', 'min' => '2', 'auto' => 'off','tabindex'=>'2'],
                                ['help' => 'Nombre Articulo', 'icon' => 'fa fa-user'])
                                !!}
                            </div>
                        </div>
                        <div class="modal-footer col-md-2 col-md-offset-5">
                            {!! Form::button('ACEPTAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>

                    </div>
                </div>
                {{-- END HTML MODAL CREATE--}}
            </div>

        </div>
        <div id="contentFormularioPrestamos">
            @foreach($prestamos as $articulos)
                @if($articulos['PRT_FK_Estado']==2)
                    @php ++$contador @endphp
                    <div class="row fila_articulo" data-id_articulo={{$articulos['id']}}>
                        @if($articulos['consultaArticulos'] == null)
                            <div class="col-md-3">
                                {!! Field::text("textObser".$articulos['id'],$articulos['consultaKitArticulo']['KIT_Nombre'],
                                     ['disabled','label' => 'Tipo Articulo', 'required', 'auto' => 'off', 'max' => '255', 'disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right'])
                                !!}
                            </div>
                            @else
                            <div class="col-md-3">
                                {!! Field::text("textObser".$articulos['id'],$articulos['consultaArticulos']['consultaTipoArticulo']['TPART_Nombre'],
                                     ['disabled','label' => 'Tipo Articulo', 'required', 'auto' => 'off', 'max' => '255', 'disabled'],
                                     ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right'])
                                !!}
                            </div>
                        @endif
                        <div class="col-md-3">
                            {!! Field::text('tiempoArticulo'.$articulos['id'],$articulos['tiemporestante'],
                                 ['disabled','label' => 'Horas Restantes Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                 ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right'])
                            !!}
                        </div>
                        <div class="col-md-3">
                            {!! Field::text('PRT_Observacion_Entrega'.$articulos['id'],$articulos['PRT_Observacion_Entrega'],
                                 ['disabled','label' => 'Observacion Entrega', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                 ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right'])
                            !!}
                        </div>
                        <div class="col-md-3">
                            {!! Field::text('PRT_Observacion_Recibe'.$articulos['id'],
                                 ['label' => 'Observacion Recibe', 'required', 'auto' => 'off', 'max' => '255'],
                                 ['help' => 'Escribe una descripción de Articulo.', 'icon' => 'fa fa-quote-right'])
                            !!}
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                            </div>
                            <div class="col-md-4">
                                @if($articulos['consultaArticulos'] == null)
                                    {!! Form::button('Ver Kit', ['class' => 'btn btn-success  recibir_kit','data-id_kit'=>$articulos['id']]) !!}
                                    @else
                                    {!! Form::button('Recibir Articulo', ['class' => 'btn btn-success  recibir_articulo','data-id_articulo'=>$articulos['id']]) !!}
                                @endif
                                {!! Form::button('Aumentar Tiempo', ['class' => 'btn btn-warning aumentar_tiempo','data-id_articulo'=>$articulos['id']]) !!}
                            </div>
                        </div>
                    </div>
                    <br>
                @endif
            @endforeach
            <br>
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    {!! Form::button('Recibir Todo', ['class' => 'btn btn-danger btn-lg getAll','data-id_articulo'=>$articulos['PRT_Num_Orden']]) !!}
                </div>
            </div>
        </div>
    @endcomponent
</div>

<script type="text/javascript">
    var routeUpdate,idArticulo,idVal,observation,idArticuloTiempo,
        idPrestamoSolicitud;
    var co = JSON.stringify({{$contador}});
    console.log('valor inicial items -> '+co);
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
        var kitId;
        ComponentsSelect2.init();
        ComponentsBootstrapMaxlength.init();
        $('#contentFormularioPrestamos').on('click', '.recibir_articulo', function(){
            idArticulo=$(this).data('id_articulo');
            idVal='#PRT_Observacion_Recibe'+idArticulo;
            observation=$(idVal).val();
            $(".fila_articulo[data-id_articulo='"+$(this).data('id_articulo')+"']").html('');
            routeupdate = '{{ route('updatePrestamo') }}'+ '/'+ idArticulo+'/'+observation;
            $.get( routeupdate, function(){});
            co = co-1;
            console.log(co);
            if(co==0){
                var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
                $(".content-ajax").load(route);
            }

        });
        $('#contentFormularioPrestamos').on('click', '.recibir_kit', function(){
            kitId=$(this).data('id_kit');
            console.log('valor items -> '+co);
            var routeArticulos = '{{ route('listarArticulosKitEntregaAdministrador') }}' +'/' + kitId ;
            $('#elementosKit').empty();
            $.ajax({
                url: routeArticulos,
                type: 'GET',
                beforeSend: function () {
                    App.blockUI({target: '.portlet-form', animate: true});
                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        App.unblockUI('.portlet-form');
                        console.log(response.data);
                        $(response.data).each(function (key,value) {
                            $('#elementosKit').append(' - '+value.consulta_tipo_articulo.TPART_Nombre);
                            $('#elementosKit').append('\n');
                        });
                    }
                }
            });
            $('#modal-recibir-kit').modal('toggle');

        });
        $('#contentFormularioPrestamos').on('click', '.aumentar_tiempo', function(){
            idPrestamo=$(this).data('id_articulo');
            var numHoras='#tiempoArticulo'+idPrestamo;
            numHoras=$(numHoras).val();
            console.log('id prestamo => '+idPrestamo);
            console.log('numHoras => '+numHoras);
            routeupdate = '{{ route('aumentarTiempo') }}'+ '/'+ idPrestamo+'/'+numHoras;
            $.get( routeupdate, function(info){
                console.log(info.data);
                idVal='#textObser'+idPrestamo;
                var tipoArticulo = $(idVal).val();
                var horas=5;
                if(info.data<=0){
                    $('#modal-advertencia-tiempo').modal('toggle');
                }else{
                    idPrestamoSolicitud = idPrestamo;
                    $('input[name="tipoArticulo"]').val(tipoArticulo);
                    for(i=1;i<=horas;i++){
                        var nombreTiempo=i+' Hora';
                        $('#tiempoSelect').append(new Option(nombreTiempo,i));
                    }

                    $('#modal-tiempo-prestamo').modal('toggle');
                }
            });

        });
        $('.getAll').on('click',function(){
            idArticulo=$(this).data('id_articulo');
            $('#modal-observation-prestamo').modal('toggle');
        });
        var updateGeneralS = function(){
            return {
                init:function(){
                    var route =  '{{ route('updatesPrestamoGeneral') }}'+'/'+ idArticulo;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('observacion', $('#observacionGeneral').val());
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
                                $('#modal-observation-prestamo').modal('hide');
                                $('#from_observation')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                                var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }

                    });
                }
            }
        };
        var form_updateG = $('#from_observation');
        var rule_createG = {
            observacionGeneral:{required: true}
        };
        FormValidationMd.init(form_updateG,rule_createG,false,updateGeneralS());
        var updateKit = function(){
            return {
                init:function(){
                    var route =  '{{ route('updateKitAdmin') }}'+'/'+ kitId ;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('observacionKit', $('#observacionKit').val());
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
                                co=co-1;
                                console.log(co);
                                $('#from_kit_recibir')[0].reset();
                                $('#modal-recibir-kit').modal('hide');
                                if(co==0){
                                    var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
                                    $(".content-ajax").load(route);
                                }
                                $('#modal-recibir-kit').modal('hide');

                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                            }
                        }

                    });
                }
            }
        };
        var form_updateG = $('#from_kit_recibir');
        var rule_createG = {
            observacionKit:{required: true}
        };
        FormValidationMd.init(form_updateG,rule_createG,false,updateKit());
        var moreTime = function(){
            return {
                init:function(){
                    var route =  '{{ route('moreTimeUpdate') }}'+'/'+ idPrestamoSolicitud;
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('hourAdd', $("#tiempoSelect option:selected").text());
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
                                $('#modal-tiempo-prestamo').modal('hide');
                                $('#from_tiempo_sumar')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                                var route = '{{ route('audiovisuales.ListarPrestamo2.index') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }

                    });
                }
            }
        };
        //FormValidationMd.init(form_updateG,rule_createG,false,moreTime());
        var form_sumar = $('#from_tiempo_sumar');
        var rule_sumar = {
            //observacionGeneral:{required: true}
        };
        FormValidationMd.init(form_sumar,rule_sumar,false,moreTime());


    });
</script>
