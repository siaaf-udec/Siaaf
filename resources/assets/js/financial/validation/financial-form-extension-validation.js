/**
 * Created by danielprado on 20/07/17.
 */
var FormValidationExtension = function() {

    var handleValidation = function() {
        var form = $('#financial-form-extension');

        form.validate({
            errorElement: 'span',
            errorClass: 'help-block help-block-error',
            focusInvalid: false,
            messages: {},
            rules: {
                'subject': { required:true },
                'program': { required:true },
                'teacher': { required:true },
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

            submitHandler: function(form) {
                form.submit();
            }
        });
    };


    return {
        init: function() {
            handleValidation();
        }
    };
}();