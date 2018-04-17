var ComponentsBootstrapMaxlength = function () {

    var handleBootstrapMaxlength = function() {
        $('input[maxlength], textarea[maxlength]').maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow: true,
        });
    };

    return {
        init: function () {
            handleBootstrapMaxlength();
        }
    };

}();

$(document).ready(function() {
    ComponentsBootstrapMaxlength.init();
});