
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestión Mantenimiento Artículos'])
    @slot('actions', [
      'link_cancel' => [
      'link' => '',
      'icon' => 'fa fa-arrow-left',
     ],
    ])

    <div class="clearfix"></div>
    <br>
    <br>
    <br>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'tipoArt-table-ajax'])
            @slot('columns', [
                '#' => ['style' => 'width:20px;'],
                'Nombre',
                'Codigo',
                'Hora Ultimo Mantenimiento',
                'Horas Total Uso',
                'Cantidad Mantenimientos',
                'Acciones' => ['style' => 'width:100px;']
            ])
        @endcomponent
    </div>
    <div class="clearfix"></div>
@endcomponent
<script>
    var table, url, columns;

    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function () {
            $("input[maxlength], textarea[maxlength]").maxlength({
                alwaysShow: true,
                appendToParent: true
            });
        }
        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };
    }();
    $(document).ready(function () {

        var idTipoArticulo;
        ComponentsBootstrapMaxlength.init();

        table = $('#tipoArt-table-ajax');
        url ="{{ route('listarTipoArticulos.data') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'TPART_Nombre' , name: 'Tipo'},
            {data: 'consultar_articulos_count' , name: 'Cantidad Artículos'},
            {data: 'Tiempo' , name: 'Tiempo'},
            {data: 'TPART_HorasMantenimiento' , name: 'Horas Mantenimiento'},
            {data: 'TPART_HorasMantenimiento' , name: 'Horas Mantenimiento'},
            {
                defaultContent: '@permission("AUDI_END_MAINTENANCE")<a title="Finalizar Mantenimiento" href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>@endpermission',

                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-right',
                render: null,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        $('.createTipoArticulo').on('click',function(e){
            e.preventDefault();
            swal({
                    title :"INFORMACION",
                    text: "Al crear un nuevo tipo de artículo , tiene la" +
                    " opción de seleccionar un tiempo(item )",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Continuar",
                    cancelButtonText: "Consultar",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('#modal-create-tipo').modal('toggle');

                    } else {
                        var route = '{{ route('audiovisuales.gestionArticulos.ValidacionesAjax') }}';
                        $(".content-ajax").load(route);
                    }
                });

        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            console.log(dataTable);
            $('#TPART_Nombre_Edit').val(dataTable.TPART_Nombre);
            $('select[name="TPART_Tiempo_Edit"]').val(dataTable.TPART_Tiempo);
            $('#TPART_HorasMantenimiento_Edit').val(dataTable.TPART_HorasMantenimiento);
            if(dataTable.consultar_articulos_count!=0){
                $("#TPART_Nombre_Edit").prop("disabled", true);
            }else{
                $("#TPART_Nombre_Edit").removeAttr('disabled');
            }
            idTipoArticulo = parseInt(dataTable.id);
            $('#modal-edit-tipo').modal('toggle');
        });
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            if(parseInt((dataTable.consultar_articulos_count))==0){
                swal({
                        title: "Esta Seguro De eliminar?",
                        text: "Este Tipo De Artículo será eliminado!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "si",
                        cancelButtonText: "No",
                        closeOnConfirm: true
                    },
                    function(isConfirm){
                        if(isConfirm){
                            var route = '{{ route('tipoArticuloEliminarA') }}'+'/'+dataTable.id;
                            var type = 'POST';
                            var async = async || false;
                            $.ajax({
                                url: route,
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                cache: false,
                                type: type,
                                contentType: false,
                                processData: false,
                                async: async,
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        table.ajax.reload();
                                        UIToastr.init(xhr , response.title , response.message  );
                                        App.unblockUI('.portlet-form');
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 &&  xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                    }
                                }
                            });
                        }
                    });

            }else{
                swal(
                    'Oops...',
                    'Lo sentimos este tipo de articulo tiene relacion con una cierta cantidad de articulos crados!',
                    'error'
                )
            }
        });

    });

</script>