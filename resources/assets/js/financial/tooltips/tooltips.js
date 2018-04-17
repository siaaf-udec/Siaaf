var handleTooltips = function () {
    return {
        init: function () {
            var t = $('body');

            t.find('.tooltips').tooltip({
                trigger: "hover",
                container: "body",
                placement: "top"
            });

            t.find(".sorting_1").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.more'),
                placement: "top"
            });
            t.find(".prev").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.previous'),
                placement: "top"
            });
            t.find("td.active.day").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('financial.extension.table.realization_date'),
                placement: "top"
            });
            t.find(".call-to").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.call'),
                placement: "top"
            });
            t.find(".mail-to").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.send_mail'),
                placement: "top"
            });
            t.find(".next").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.next'),
                placement: "top"
            });
            t.find(".dt-buttons > .t-add").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.add'),
                placement: "top"
            });
            t.find(".dt-buttons > .t-print").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.print'),
                placement: "top"
            });
            t.find(".dt-buttons > .t-copy").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.copy'),
                placement: "top"
            });
            t.find(".dt-buttons > .t-pdf").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.pdf'),
                placement: "top"
            });
            t.find(".dt-buttons > .t-excel").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.excel'),
                placement: "top"
            });
            t.find(".dt-buttons > .t-csv").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.csv'),
                placement: "top"
            });
            t.find(".dt-buttons > .t-colvis").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.show'),
                placement: "top"
            });
            t.find(".dt-buttons > .t-refresh").tooltip("destroy").tooltip({
                trigger: "hover",
                container: "body",
                title: Lang.get('javascript.tooltip.reload'),
                placement: "top"
            });
        }
    }
}();

$(document).ready(function() {
    handleTooltips.init();
});