export const mixinValidator = {
    name: 'mixin-validator',
    data: function () {
        return {
            settings: {
                lang: Lang.get('javascript.locale'),
                errorElement: 'span',
                errorClass: 'help-block help-block-error',
                focusInvalid: false,
                invalidHandler: function(event, validator) {
                    console.log(event, validator);
                },
                errorPlacement: function(error, element) {
                    if (element.is(':checkbox')) {
                        error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                    } else if (element.is(':radio')) {
                        error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                    } else if (element.hasClass('select2-hidden-accessible')) {
                        error.insertAfter( element.parent().find('.help-block') );
                    } else {
                        error.insertAfter(element);
                    }
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
            }
        };
    },
    created: function () {
        this.handleDefaultValidationForm();
        this.handleBootstrapMaxlength();
    },
    methods: {
        handleDefaultValidationForm: function () {
            let self = this;

            jQuery.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Haz coincidir el formato solicitado."
            );

            jQuery.validator.setDefaults( self.settings );
        },
        handleBootstrapMaxlength: function () {
            $('input[maxlength], textarea[maxlength]').maxlength({
                limitReachedClass: "label label-danger",
                alwaysShow: true,
                warningClass: "label label-warning",
                validate: true
            });
            $('textarea[maxlength]').on('autosize:resized', function() {
                $(this).trigger('maxlength.reposition');
            });
        },
    },
};