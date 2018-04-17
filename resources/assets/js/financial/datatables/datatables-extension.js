var DatatableExtension = function () {
    var handleDataTable = function () {
        var lang = Lang.get("javascript.locale");
        var url = route('financial.api.datatables.extensions', {}, false);
        url = url.domain + url.url;

        var languages = {
          es: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
          en: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
        };

        var language = ( lang === 'en' ) ? languages.en : languages.es;
        var table = $('#datatable-extension');
        table.DataTable({
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, Lang.get('javascript.all')]
            ],
            "order": [
                [0, 'asc']
            ],
            responsive: true,
            colReorder: true,
            processing: true,
            serverSide: false,
            ajax: {
                url: url,
                error: function (data) {
                    handleLaravelErrors.init( data, $('#error-ajax') );
                },
                fail: function (data) {
                    handleLaravelErrors.init( data, $('#error-ajax') );
                }
            },
            initComplete: function() {
                handleTooltips.init();
            },
            language: { url: language },
            columns: [
                { data: 'pk_id',        name: 'pk_id' },
                { data: 'subject.subject_code', name: 'subject.subject_code' },
                { data: 'subject.subject_name', name: 'subject.subject_name' },
                { data: 'subject.subject_credits', name: 'subject.subject_credits' },
                { data: 'cost.cost', name: 'cost.cost' },
                { data: 'total_cost', name: 'total_cost' },
                { data: 'created_at', name: 'created_at' },
                { data: 'subject.teachers[0].full_name', name: 'subject.teachers[0].full_name' },
                { data: 'status.status_name', name: 'status.status_name' },
                { data: 'actions', name: 'actions' },
            ],
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


        table.on('click', '.trash', function (e) {
            e.preventDefault();
            var $tr = $(this).closest('tr');
            var $url = route('financial.requests.student.extension.destroy', {supletorio: $(this).data('id')});

            swal({
                title: Lang.get('javascript.warning'),
                text: Lang.get('javascript.ask_if_delete'),
                type: "question",
                showCancelButton: true,
                confirmButtonClass: "btn-danger ladda-button",
                confirmButtonText: Lang.get('financial.buttons.yes'),
                cancelButtonText: Lang.get('financial.buttons.cancel'),
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve, reject) {
                        $.ajax({
                            url: $url,
                            method: "DELETE",
                            data: {
                                __method: 'DELETE',
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        }).done(function () {
                            resolve();
                        }).fail(function(data) {
                            if ( typeof data.responseJSON.message !== 'undefined') {
                                reject(data.responseJSON.message);
                            } else {
                                handleLaravelErrors.init( data, $('#error-ajax') );
                                reject( Lang.get('javascript.deleted_fail') );
                            }
                        });
                    })
                },
                allowOutsideClick: false
            }).then(function () {
                $tr.remove();
                swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
            }).catch(swal.noop);

        });
    };


    return {
        init: function () {
            handleDataTable();
        }
    };
}();


$(document).ready(function() {
    DatatableExtension.init();
});