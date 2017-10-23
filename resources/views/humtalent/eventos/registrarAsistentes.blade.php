    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Personal registrado:'])
            <div id="response" class="row">
                <div class="col-md-12"><br>
                    <button id="button" class="btn blue">Registrar todos</button>&nbsp&nbsp&nbsp <a href="javascript:;" class="btn btn-simple btn-success btn-icon back">
                            <i class="fa fa-arrow-circle-left"></i>Volver</a> <br><br>
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'])
                        @slot('columns', [
                            '#',
                            'Nombres',
                            'Apellidos',
                            'Cédula',
                            'Teléfono',
                            'Email',
                            'Rol ',
                            'Agregar Asistente'
                        ])
                    @endcomponent
                </div>
            </div>
            {!! Form::open(['route' =>['talento.humano.evento.regAsist.regTotAsist'],'method'=>'POST', 'id'=>'form-create' ])!!}
                {!! Field::hidden('FK_TBL_Eventos_IdEvento',$id,['id'=>'idEvent']) !!}
            {!! Form::close() !!}
        @endcomponent
    </div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">

jQuery(document).ready(function () {

    $('#button').click( function () {
        var data = Array.from(table.rows({page: 'current', search: 'applied'}).data());
        var datos="";
        for (i in data){
            datos=datos+data[i].PK_PRSN_Cedula+';';
        }
        var id = $('input[id="idEvent"]').val();//document.getElementById("idEvent").value;
        var route = '{{ route('talento.humano.evento.regAsist.regTotAsist') }}' + '/' + id + '/' + datos;
        var type = 'POST';
        var async = async || false;

        $.ajax({
            url: route,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            cache: false,
            type: type,
            contentType: false,
            processData: false,
            async: async,
            beforeSend: function () {
            },
            success: function (response, xhr, request) {
                if (request.status === 200 && xhr === 'success') {
                    table.ajax.reload();
                    UIToastr.init(xhr , response.title , response.message  );
                }
            },
            error: function (response, xhr, request) {
                if (request.status === 422 &&  xhr === 'error') {
                    UIToastr.init(xhr, response.title, response.message);
                }
            }

        });
    });
        var  table, url, columns;
        table = $('#lista-empleados');
        url = "{{ route('talento.humano.posAsitentes',$id)}}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PRSN_Nombres', name: 'Nombres'},
            {data: 'PRSN_Apellidos', name: 'Apellidos'},
            {data: 'PK_PRSN_Cedula', name: 'Cédula'},
            {data: 'PRSN_Telefono', name: 'Teléfono'},
            {data: 'PRSN_Correo', name: 'Correo Electronico'},
            {data: 'PRSN_Rol', name: 'Rol'},
        {
            defaultContent: '<a href="javascript:;" class="btn btn-simple btn-success btn-icon edit"><i class="icon-users"></i></a>',
            data: 'action',
            name: 'action',
            title: 'Acciones',
            orderable: false,
            searchable: false,
            exportable: false,
            printable: false,
            className: 'text-center',
            render: null,
            serverSide: false,
            responsivePriority: 2
        }
    ];
    dataTableServer.init(table, url, columns);
    table = table.DataTable();

    table.on('click', '.edit', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = table.row($tr).data();
        var id= document.getElementById("idEvent").value;
        var route = '{{ route('talento.humano.evento.regAsist.saveAsists') }}' + '/' + id + '/' + dataTable.PK_PRSN_Cedula;
        var type = 'GET';
        var async = async || false;
        $.ajax({
            url: route,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            cache: false,
            type: type,
            contentType: false,
            processData: false,
            async: async,
            success: function (response, xhr, request) {
                if (request.status === 200 && xhr === 'success') {
                    table.ajax.reload();
                    UIToastr.init(xhr, response.title, response.message);
                }
            },
            error: function (response, xhr, request) {
                if (request.status === 422 &&  xhr === 'error') {
                    UIToastr.init(xhr, response.title, response.message);
                }
            }

        })
    });

    $( ".back" ).on('click', function (e) {
        e.preventDefault();
        var route = '{{ route('talento.humano.evento.asistentes') }}'+'/'+document.getElementById("idEvent").value;
        $(".content-ajax").load(route);
    });


    });
</script>