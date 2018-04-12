
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-check', 'title' => 'Tabla Validaciones'])
            @slot('actions', [
                      'link_cancel' => [
                      'link' => '',
                      'icon' => 'fa fa-arrow-left',
                     ],
                    ])
            <div class="clearfix">
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table id="validaciones" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" width="5%">#</th>
                            <th class="text-center" width="65%">PREGUNTAS</th>
                            <th class="text-center" width="30%">VALOR</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dato as $datos)
                            <tr>
                                <td class="text-center">{{$datos->id}}</td>
                                <td>{{$datos->VAL_PRE_Nombre}}</td>
                                <td class="text-center">
                                    <a href="#" class="task-editable-name" id="task-editable-name" data-type="text" data-column="value"  data-url="{{route('validaciones.edit', ['id'=>$datos->id])}}" data-pk="{{$datos->id}}" data-title="change" data-name="value">{{$datos->VAL_PRE_Valor}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endcomponent
    </div>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    jQuery(document).ready(function() {
        $.fn.editable.defaults.send = "always";
        $.fn.editable.defaults.mode = 'inline';
        $('.task-editable-name').editable({
            placement: 'bottom',
            rows: 3,
            validate: function(value) {
                if($.trim(value) == '') {
                    return 'el campo es requerido.';
                }
                if ($.isNumeric(value) == '') {
                    return 'solo numeros son permitidos';
                }
                var num=parseInt(value);
                if (num > 9 || num <1) {
                    return 'numero entre 1 y 9';
                }
            },
        });
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionTipoArticuloAjax') }}';
            $(".content-ajax").load(route);
        });
    });
</script>