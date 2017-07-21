/**
 * Created by danielprado on 20/07/17.
 */
var FormValidationFile = function() {

    var handleValidation = function() {
        var form = $('#financial-form-files');

        form.validate({
            errorElement: 'span',
            errorClass: 'help-block help-block-error',
            focusInvalid: false,
            messages: {},
            rules: {
                'request_type': {required:true}
            },

            errorPlacement: function(error, element) {
                error.insertAfter( element.parent().find('.help-block') );
            },

            highlight: function(element) {
                $(element)
                    .closest('.form-group').addClass('has-error');
            },

            unhighlight: function(element) {
                $(element)
                    .closest('.form-group').removeClass('has-error');
            },

            success: function(label) {
                label
                    .closest('.form-group').removeClass('has-error');
            },

            submitHandler: function() {

            }
        });
    };


    return {
        init: function() {
            handleValidation();
        }
    };
}();