var confirmationMessage = function () {
    var success = function () {
        swal(
            Lang.get('javascript.success'),
            Lang.get('javascript.processed'),
            'success'
        );
    };
    return {
        init: function () {
            success();
        }
    }
}();

$(document).ready(function() {
    confirmationMessage.init();
});