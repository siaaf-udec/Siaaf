/**
 * Created by danielprado on 20/07/17.
 */
var UIToastr = function () {

    return {
        init: function (type, title, message) {

            toastr[type](message, title);
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-bottom-full-width",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        }
    };
}();