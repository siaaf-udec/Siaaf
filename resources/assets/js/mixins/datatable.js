import {mixinTootilps} from "./tooltip";
export const mixinDataTable = {
    name: 'mixin-data-table',
    mixins: [mixinTootilps],
    data: function () {
        let that = this;
        return {
            lang: Lang.get("javascript.locale"),
            langSource: {
                es: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                en: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
            },
            settings: {
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, Lang.get('javascript.all')]
                ],
                order: [
                    [0, 'asc']
                ],
                colReorder: true,
                processing: true,
                serverSide: false,
                buttons: [
                    { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
                    { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
                    { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>', orientation: 'landscape', pageSize: 'LEGAL'},
                    { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
                    { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
                    { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
                    {
                        text: '<i class="fa fa-refresh"></i>',
                        className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
                        action: function ( e, dt, node, config ) {
                            dt.ajax.reload( that.handleTooltips(), false );
                        }
                    }
                ],
                pageLength: 10,
                pagingType: 'bootstrap_full_number',
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                initComplete: function() {
                    that.handleTooltips();
                },
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            }
        };
    },
    mounted: function () {
        this.settingsDataTable();
    },
    methods: {
        settingsDataTable: function () {
            let self = this;
            this.settings.language = { url: self.langSource[ self.lang ] };
            $.extend( true, $.fn.dataTable.defaults, self.settings );
        }
    }
};
export const mixinDataTableNoAjax = {
    name: 'mixin-data-table-no-ajax',
    mixins: [mixinTootilps],
    data: function () {
        let that = this;
        return {
            lang: Lang.get("javascript.locale"),
            langSource: {
                es: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
                en: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json",
            },
            settings: {
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, Lang.get('javascript.all')]
                ],
                "order": [
                    [0, 'asc']
                ],
                responsive: true,
                colReorder: true,
                bPaginate: false,
                bFilter: false,
                bInfo: false,
                searching: false,
                ordering:  false,
                buttons: [
                    { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
                    { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
                    { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
                    { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
                    { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
                    { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
                ],
                pageLength: 10,
                initComplete: function() {
                    that.handleTooltips();
                },
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            }
        };
    },
    mounted: function () {
        this.settingsDataTable();
    },
    methods: {
        settingsDataTable: function () {
            let self = this;
            this.settings.language = { url: self.langSource[ self.lang ] };
            $.extend( true, $.fn.dataTable.defaults, self.settings );
        }
    }
};