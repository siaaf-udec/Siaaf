/**
 * Created by danielprado on 20/07/17.
 */

var InputSelect2 = function () {
    var handleComponents = function () {
        $.fn.select2.defaults.set('language', Lang.get("javascript.locale") );
        $.fn.select2.defaults.set('placeholder', Lang.get("javascript.select") );
        $.fn.select2.defaults.set('allowClear', true);
        $.fn.select2.defaults.set('width', null);
        $(".pmd-select2").select2().on('change', function () {
            $(this).valid();
        });
    };

    return {
        init: function () {
            handleComponents();
        }
    };

}();

$(document).ready(function() {
    InputSelect2.init();
});