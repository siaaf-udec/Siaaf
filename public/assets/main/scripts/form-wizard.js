/**
 * Created by migue on 10/07/2017.
 */
var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function (wizard, form, rules, messages, method) {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='../../assets/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }


            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: true, // do not focus the last invalid input
                rules: rules,
                messages: messages,

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.is(':checkbox')) {
                        error.insertAfter(element.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline"));
                    } else if (element.is(':radio')) {
                        error.insertAfter(element.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline"));
                    } else if (element.hasClass('select2-hidden-accessible')) {
                        error.insertAfter(element.parent().find(".help-block"));
                    } else {
                    
                            error.insertAfter(element);    
                        }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    if ($(element).hasClass('select2-hidden-accessible')) {
                        $(element).next('span span .selection').closest('select2-selection--single').css('border-bottom','1px solid #e73d4a;');
                        console.log($(element).next('span').find('selecction').find('select2-selection--single'));
                        console.log($(element).next('span').closest('select2-selection--single'));
                    } 
                
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                    
                    
                    
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {

                    label
                        .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group

                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                }

            });

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if (input.is(":checkbox")) {
                        var payment = [];
                        $('[name="'+$(this).attr("data-display")+'"]:checked', form).each(function(){
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', wizard).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', wizard).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    wizard.find('.button-previous').hide();
                } else {
                    wizard.find('.button-previous').show();
                }

                if (current >= total) {
                    wizard.find('.button-next').hide();
                    wizard.find('.button-submit').show();
                    displayConfirm();
                } else {
                    wizard.find('.button-next').show();
                    wizard.find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            wizard.bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;

                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    wizard.find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            wizard.find('.button-previous').hide();

            form.on('click', '.button-submit', function(e){
                e.preventDefault();
                if ( typeof method !== 'undefined' && typeof method === 'object' ) {
                    method.init();
                }
                if (typeof method === 'undefined' || method === false) {
                    form.submit();
                }
            });

            $('.button-submit').hide();


        }

    };

}();