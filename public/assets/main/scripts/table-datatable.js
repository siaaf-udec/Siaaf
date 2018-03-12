/**
 * Created by migue on 11/07/2017.
 */
var dataTableServer = function () {
    var handleDataTable = function (table, url, columns) {


        table.DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todo"]
            ],
            responsive: true,
            colReorder: true,
            processing: true,
            serverSide: false,
            ajax: url,
            language: {
                "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            columns: columns,
            buttons: [
                { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
                { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
                { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
                { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
                { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
                { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
                {
                    text: '<i class="fa fa-refresh"></i>',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }

            ],
            pageLength: 10,
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });

    };
    var handleTooltips = function () {
        $('.t-add').attr({'data-container':"body", 'data-placement':"top", 'data-original-title':"Añadir nuevo registro"});
        $('.t-print').attr({'data-container':"body", 'data-placement':"top", 'data-original-title':"Imprimir"});
        $('.t-copy').attr({'data-container':"body", 'data-placement':"top", 'data-original-title':"Copiar al portapales"});
        $('.t-pdf').attr({'data-container':"body", 'data-placement':"top", 'data-original-title':"Exportar a PDF"});
        $('.t-excel').attr({'data-container':"body", 'data-placement':"top", 'data-original-title':"Exportar a EXCEL"});
        $('.t-csv').attr({'data-container':"body", 'data-placement':"top", 'data-original-title':"Exportar a CSV"});
        $('.t-colvis').attr({'data-container':"body", 'data-placement':"top", 'data-original-title':"Mostrar/Ocultar Columnas"});
        $('.t-refresh').attr({'data-container':"body", 'data-placement':"top", 'data-original-title':"Recargar"});

        $('.tooltips').tooltip();
    }

    return {
        init: function (table, url, columns, modal) {
            handleDataTable(table, url, columns, modal);
            handleTooltips();
        }
    };
}
();