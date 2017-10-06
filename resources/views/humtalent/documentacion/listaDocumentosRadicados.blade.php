
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Documentación'])
            @slot('actions', [
                       'link_cancel' => [
                       'link' => '',
                       'icon' => 'fa fa-arrow-left',
                      ],
               ])
            <div class="form-group">
            <div class="col-md-offset-1 col-md-10">

                <br><br>
                <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" >
                    <thead>
                    <th>Número de Cedula</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    </thead>
                        <tbody>
                        <td>{{$empleado->PK_PRSN_Cedula}}</td>
                        <td>{{$empleado->PRSN_Nombres}}</td>
                        <td>{{$empleado->PRSN_Apellidos}}</td>
                        <td>{{$empleado->PRSN_Telefono}}</td>
                        <td>{{$empleado->PRSN_Correo}}</td>
                        </tbody>
                </table>
                 <br>
                <br>
                <br>
                @if($procesoEPS == 'Afiliado EPS')
                    <h5>Fecha de afiliación EPS: {{$fechaEPS}}</h5>
                    <br>
                    <br>
                @endif

                @if($procesoCaja == 'Afiliado Caja de compensación')
                    <h5>Fecha de afiliación Caja de compensación : {{$fechaCaja}}</h5>
                    <br>
                    <br>
                @endif

            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'])
                        @slot('columns', [
                            '#',
                            'Documento',
                            'Tipo',
                            'Fecha',
                        ])
                    @endcomponent
                </div>
            </div>
            {!! Field::hidden('cedula',$id,['id'=>'cedula']) !!}
        @endcomponent
    </div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    jQuery(document).ready(function () {
        var cedula = $('input[id="cedula"]').val();
        var table, url, columns;
        table = $('#lista-empleados');
        url = '{{ route('talento.humano.document.historialDocumentos.documentosRadicados')}}' + '/' + cedula;
        columns = [
            {data: 'DT_Row_Index'},
            {data: "documentacion_personas.DCMTP_Nombre_Documento", name: 'Documento'},
            {data: "documentacion_personas.DCMTP_Tipo_Documento", name: 'Tipo'},
            {data: 'EDCMT_Fecha', name: 'Fecha'},

        ];
        dataTableServer.init(table, url, columns);

        $( ".back" ).on('click', function (e) {
            //e.preventDefault();
            var route = '{{ route('talento.humano.historialDocumentos.empleados.ajax') }}';
            $(".content-ajax").load(route);
        });
        $( "#link_cancel" ).on('click', function (e) {
            //e.preventDefault();
            var route = '{{ route('talento.humano.historialDocumentos.empleados.ajax') }}';
            $(".content-ajax").load(route);
        });

    });
</script>