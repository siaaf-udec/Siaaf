<template>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <portlet icon="fa fa-money" :title="portlet.title">
                    <template slot="body">
                        <div class="row">
                            <div class="col-md-12">
                                <form @submit.prevent="setAvailable" ref="form_modules" class="" id="form-modules" accept-charset="UTF-8">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <vue-select2 :label="formAvailable.module_name.label"
                                                             v-model.trim="formAvailable.module_name.value"
                                                             :value="formAvailable.module_name.value"
                                                             :attributes="formAvailable.module_name.attributes"
                                                             :options="formAvailable.module_name.options"
                                                             name="module_name">
                                                </vue-select2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <vue-input name="available_from"
                                                           icon="fa fa-calendar"
                                                           v-model.trim="formAvailable.available_from.value"
                                                           :value="formAvailable.available_from.value"
                                                           :help="formAvailable.available_from.help"
                                                           :hasError="formAvailable.available_from.hasError"
                                                           :errors="formAvailable.available_from.errors"
                                                           :attributes="formAvailable.available_from.attributes"
                                                           :label="formAvailable.available_from.label">
                                                </vue-input>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <vue-input name="available_until"
                                                           icon="fa fa-calendar"
                                                           v-model.trim="formAvailable.available_until.value"
                                                           :value="formAvailable.available_until.value"
                                                           :help="formAvailable.available_until.help"
                                                           :hasError="formAvailable.available_until.hasError"
                                                           :errors="formAvailable.available_until.errors"
                                                           :attributes="formAvailable.available_until.attributes"
                                                           :label="formAvailable.available_until.label">
                                                </vue-input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input class="btn green" type="submit" :value="portlet.buttons.send">
                                                <button class="btn red" type="reset" v-text="portlet.buttons.cancel"></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </template>
                </portlet>
            </div>
            <div class="col-md-8">
                <portlet icon="fa fa-money" :title="portlet.title">
                    <template slot="body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="table-editable" class="table table-bordered table-striped">
                                    <tbody v-for="source in sources">
                                    <tr>
                                        <td colspan="2" class="text-center"><strong v-text="source.module_name_text"></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong v-text="formAvailable.available_from.label"></strong></td>
                                        <td v-text="formatDate(source.available_from)"></td>
                                    </tr>
                                    <tr>
                                        <td><strong v-text="formAvailable.available_until.label"></strong></td>
                                        <td v-text="formatDate(source.available_until)"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </template>
                </portlet>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import moment from 'moment-with-locales-es6';
    import {mixinHttpStatus} from "../../../../mixins";
    import {mixinMomentLocale} from "../../../../mixins/moment";
    import {mixinLoading} from "../../../../mixins/loadingswal";
    import {mixinSelect2} from "../../../../mixins/select2";
    import {mixinValidator} from "../../../../mixins/validation";

    export default {
        name: "management-available-modules",
        mixins: [mixinHttpStatus, mixinMomentLocale, mixinLoading, mixinSelect2, mixinValidator],
        data: () => {
            return {
                portlet: {
                    title: Lang.get('financial.management.modules.index.title'),
                    buttons: {
                        send: Lang.get('financial.buttons.send'),
                        cancel: Lang.get('financial.buttons.cancel'),
                    },
                },
                formAvailable: {
                    module_name: {
                        value: null,
                        label: Lang.get('validation.attributes.service_name').capitalize(),
                        options: [
                            { id: Lang.get('financial.status_type.file'), text: Lang.get('validation.attributes.file').capitalize() },
                            { id: Lang.get('financial.status_type.extension'), text: Lang.get('validation.attributes.extension').capitalize() },
                            { id: Lang.get('financial.status_type.validation'), text: Lang.get('validation.attributes.validation').capitalize() },
                            { id: Lang.get('financial.status_type.intersemester'), text: Lang.get('validation.attributes.intersemester').capitalize() },
                            { id: Lang.get('financial.status_type.addition_subtraction'), text: Lang.get('validation.attributes.add_remove_subjects').capitalize() }
                        ],
                        attributes: {
                            required: true,
                            disabled: false,
                        }
                    },
                    available_from: {
                        value: null,
                        help: Lang.get('financial.help-text.valid_until'),
                        label: Lang.get('validation.attributes.available_from').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            class: 'date date-picker',
                            readonly: true,
                            maxlength: 10,
                            minlength: 10,
                        }
                    },
                    available_until: {
                        value: null,
                        help: Lang.get('financial.help-text.valid_from'),
                        label: Lang.get('validation.attributes.available_until').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            class: 'date date-picker',
                            readonly: true,
                            maxlength: 10,
                            minlength: 10,
                        }
                    },
                },
                sources: [],
            }
        },
        mounted: function () {
            this.handleFormValidation();
            this.handleDatePicker();
            this.getSources();
        },
        methods: {
            handleFormValidation: function () {
                jQuery.validator.addMethod("greaterThan",
                    function(value, element, params) {
                        if (!/Invalid|NaN/.test(new Date(value))) {
                            return new Date(value) > new Date($(params).val());
                        }
                        return isNaN(value) && isNaN($(params).val())
                            || (Number(value) > Number($(params).val()));
                    }, Lang.get( 'validation.after', { attribute: Lang.get('validation.attributes.available_until'), date:  Lang.get('validation.attributes.available_from') } ) );

                $( this.$refs.form_modules ).validate({
                    rules: {
                        available_from: {
                            required: true,
                            date: true
                        },
                        available_until: {
                            required: true,
                            date: true,
                            greaterThan: '#available_from',
                        },
                        module_name: {
                            required: true,
                        }
                    }
                });
            },
            handleDatePicker: function() {
                let that = this;
                if (jQuery().datepicker) {

                    $.extend($.fn.datepicker.defaults, {
                        rtl: App.isRTL(),
                        language: Lang.get('javascript.locale'),
                        orientation: "left",
                        autoclose: true,
                        firstDay: 1,
                        showMonthAfterYear: false,
                        todayBtn: true,
                        todayHighlight: true,
                        calendarWeeks: true,
                        daysOfWeekDisabled: [0],
                        clearBtn: true,
                    });

                    $('#available_from').datepicker({
                        format: 'yyyy-mm-dd',
                    }).on('changeDate', function () {
                        $("#available_until").datepicker("setStartDate", moment( this.value ).add( 1, 'days').format('YYYY-MM-DD') );
                        that.formAvailable.available_from.value = this.value;
                    });
                    $('#available_until').datepicker({
                        format: 'yyyy-mm-dd',
                    }).on('changeDate', function () {
                        $("#available_from").datepicker("setEndDate", moment( this.value ).subtract( 1, 'days').format('YYYY-MM-DD') );
                        that.formAvailable.available_until.value = this.value;
                    });
                }
            },
            setAvailable: function () {
                if ($( this.$refs.form_modules ).valid()) {
                    let data = {
                        module_name:    this.formAvailable.module_name.value,
                        available_from: this.formAvailable.available_from.value,
                        available_until:    this.formAvailable.available_until.value,
                    };
                    this.vueLoading();
                    axios.post( route('financial.management.available.modules.store'), qs.stringify( data ) )
                        .then((response) => {
                            swal.close();
                            this.setNull();
                            this.triggerSwal( response );
                        })
                        .then(() => {
                            this.getSources();
                        })
                        .catch((error) => {
                            swal.close();
                            this.triggerSwal( error );
                        })
                }
            },
            getSources: function () {
                axios.get( route('financial.api.available.modules') )
                    .then((response) => {
                        this.sources = response.data.data;
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    });
            },
            formatDate: (date) => {
                return  (date) ? moment( date ).format('ll') : null;
            },
            setNull: function () {
                this.formAvailable.module_name.value        = null;
                this.formAvailable.available_from.value     = null;
                this.formAvailable.available_until.value    = null;
            }
        }
    }
</script>

<style scoped>

</style>