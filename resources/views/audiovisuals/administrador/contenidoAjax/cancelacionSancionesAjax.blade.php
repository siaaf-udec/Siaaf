<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Cancelacion Monetaria Sancion'])
        <div class="row">
            <div id="contentFormularioPrestamos">
            {!! Form::open(['id' => 'from_sancion', 'class' => '', 'url' => '/forms']) !!}
            @foreach($sanciones as $tipoSancion)
                <div class="container-fluid fila_articulo" data-id_sancion={{$tipoSancion['sancion']['id']}}>
                    <div class="row">
                        <div class="col-md-3">
                            <br>
                            <br><br>
                            {!! Field::text('nombre',$tipoSancion['relacion'][0]['consultaTipoArticulo']['TPART_Nombre'],
                                 ['label' => 'Articulo', 'required', 'auto' => 'off', 'max' => '255','disabled'],
                                 ['icon' => 'fa fa-hourglass-half'])
                            !!}
                        </div>
                        <div class="col-md-3">
                            <br><br><br>
                            {!! Field::text('codigo',$tipoSancion['relacion'][0]['ART_Codigo'],
                                ['disabled','label' => 'Codigo', 'required', 'auto' => 'off', 'max' => '255'],
                                ['help' => 'codigo del articulo', 'icon' => 'fa fa-quote-right'])
                            !!}
                        </div>
                        <div class="col-md-4">
                            {!! Field::textarea('observacion',$tipoSancion['sancion']['SNS_Descripcion'],
                                ['disabled','label' => 'Observacion', 'required', 'auto' => 'off', 'max' => '255', "rows" => '4'],
                                ['help' => 'Elementos Del Kit.', 'icon' => 'fa fa-quote-right'])
                            !!}
                        </div>
                        <div class="col-md-2">
                            <br><br><br>
                            {!! Field::text('costo',$tipoSancion['sancion']['SNS_Costo'],
                                 ['disabled','label' => 'Costo', 'required', 'auto' => 'off', 'max' => '6'],
                                 ['icon' => 'fa fa-hourglass-half'])
                            !!}
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-2">
                            {!! Form::button('Aplicar Sancion', ['class' => 'btn btn-success aplicar_sancion','data-id_sancion'=>$tipoSancion['sancion']['id']]) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::button('Anular Sancion', ['class' => 'btn btn-warning anular_sancion','data-id_sancion'=>$tipoSancion['sancion']['id']]) !!}
                        </div>
                    </div>
                </div>
                @php $contador++ @endphp
            @endforeach
            </div>
        </div>
        <div class="row" >
            <div class = "col-md-12" align="center">
                {!! Form::button('Regresar Lista De Sanciones', ['class' => 'btn blue regresar']) !!}
            </div>
        </div>
</div>
@endcomponent
<script type="text/javascript">
    var contador = JSON.stringify({{$contador}});
    var idTblSancion;
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
    var handleiCheck = function() {
        if (!$().iCheck) {
            return;
        }
        $('.icheck').each(function() {
            var checkboxClass = $(this).attr('data-checkbox') ? $(this).attr('data-checkbox') : 'icheckbox_minimal-grey';
            var radioClass = $(this).attr('data-radio') ? $(this).attr('data-radio') : 'iradio_minimal-grey';

            if (checkboxClass.indexOf('_line') > -1 || radioClass.indexOf('_line') > -1) {
                $(this).iCheck({
                    checkboxClass: checkboxClass,
                    radioClass: radioClass,
                    insert: '<div class="icheck_line-icon"></div>' + $(this).attr("data-label")
                });
            } else {
                $(this).iCheck({
                    checkboxClass: checkboxClass,
                    radioClass: radioClass
                });
            }
        });
    };
    jQuery(document).ready(function () {
        handleiCheck();
        App.unblockUI('.portlet-form');
        $('#contentFormularioPrestamos').on('click', '.anular_sancion', function(){
            idTblSancion = $(this).data('id_sancion');
            swal(
                {
                    title: "Desea anular la sancion",
                    text: "La sancion será eliminada",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "si",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                },
                function(isConfirm){
                    if (isConfirm) {
                        contador--;
                        var route = '{{ route('audiovisuales.anular.sancion') }}';
                        var formDatas = new FormData();
                        var typeAjax = 'POST';
                        var async = async || false;
                        formDatas.append('id_Sancion',idTblSancion);
                        console.log(formDatas);
                        if(contador != 0){
                            formDatas.append('accion','anulacionIndividual');
                            $.ajax({
                                url: route,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                cache: false,
                                type: typeAjax,
                                contentType: false,
                                data: formDatas,
                                processData: false,
                                async: async,
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    UIToastr.init(xhr, response.title, response.message);
                                    $(".fila_articulo[data-id_sancion='"+idTblSancion+"']").html('');
                                    App.unblockUI('.portlet-form');

                                },
                                error: function (response, xhr, request) {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            });
                        }else{
                            formDatas.append('accion','anulacionFinal');
                            $.ajax({
                                url: route,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                cache: false,
                                type: typeAjax,
                                contentType: false,
                                data: formDatas,
                                processData: false,
                                async: async,
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    UIToastr.init(xhr, response.title, response.message);
                                    var route = '{{ route('audiovisuales.gestionPrestamos.sanciones.ajax') }}';
                                    $(".content-ajax").load(route);
                                    App.unblockUI('.portlet-form');

                                },
                                error: function (response, xhr, request) {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            });
                        }
                    }
                }
            );
        });
        $('.regresar').on('click', function(){
            var route = '{{ route('audiovisuales.gestionPrestamos.sanciones.ajax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>
