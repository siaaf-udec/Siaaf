<template>
    <div class="row">
        <div class="col-md-4">
            <portlet icon="fa fa-money" :title="portlet.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12">
                            <form @submit.prevent="create" ref="form_costs" class="" id="form-cost" accept-charset="UTF-8">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <vue-input-empty icon="fa fa-money"
                                                             :label="formCost.cost.label"
                                                             :help="formCost.cost.help"
                                                             :hasError="formCost.validUntil.hasError"
                                                             :errors="formCost.cost.errors"
                                                             name="cost">
                                                <input type="number"
                                                       name="cost"
                                                       required="required"
                                                       ref="cost"
                                                       :placeholder="formCost.cost.label"
                                                       min="0"
                                                       max="9999999"
                                                       @input="checkLength( $event.target.value )"
                                                       class="form-control"
                                                       id="cost"
                                                       v-model.number.trim="formCost.cost.value" />
                                            </vue-input-empty>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <vue-select2 :label="formCost.serviceName.label"
                                                         v-model.trim="formCost.serviceName.value"
                                                         :value="formCost.serviceName.value"
                                                         :attributes="formCost.serviceName.attributes"
                                                         :options="formCost.serviceName.options"
                                                         name="service_name">
                                            </vue-select2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <vue-input name="valid_until"
                                                       icon="fa fa-calendar"
                                                       v-model.trim="formCost.validUntil.value"
                                                       :value="formCost.validUntil.value"
                                                       :help="formCost.validUntil.help"
                                                       :hasError="formCost.validUntil.hasError"
                                                       :errors="formCost.validUntil.errors"
                                                       :attributes="formCost.validUntil.attributes"
                                                       :label="formCost.validUntil.label">
                                            </vue-input>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input class="btn green" type="submit" :value="buttons.send">
                                            <button class="btn red" type="reset" v-text="buttons.cancel"></button>
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
                                <tbody v-for="source in table.sources">
                                    <tr>
                                        <td colspan="2" class="text-center"><strong v-text="source.service"></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong v-text="table.cost"></strong></td>
                                        <td>
                                            <a href="javascript:;"
                                               class="editable editable-click editable-cost"
                                               data-name="cost"
                                               :data-pk="source.id"
                                               :data-title="table.labelCost"
                                               :data-value="source.cost"
                                               :data-url="source.url"
                                               data-type="text"> </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong v-text="table.until"></strong></td>
                                        <td>
                                            <a href="javascript:;"
                                               class="editable editable-click editable-until"
                                               data-name="cost_valid_until"
                                               :data-pk="source.id"
                                               :data-title="table.labelUntil"
                                               :data-value="source.date"
                                               :data-url="source.url"
                                               data-type="combodate"></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-12">
            <portlet icon="fa fa-money" :title="portlet.history">
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12">
                            <vue-data-table :id="history.id" :columns="history.columns">
                            </vue-data-table>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-12">
            <empty-sortable-portlet></empty-sortable-portlet>
        </div>
    </div>
</template>

<script>
    import swal from "sweetalert2"
    import moment from "moment-with-locales-es6";
    import {mixinMomentLocale} from "../../../../mixins/moment";
    import {mixinValidator} from "../../../../mixins/validation";
    import {mixinSelect2} from "../../../../mixins/select2";
    import {mixinLoading} from "../../../../mixins/loadingswal";
    import {mixinDate} from "../../../../mixins/datepicker";
    import {mixinHttpStatus} from "../../../../mixins";
    import {mixinEditable} from "../../../../mixins/x-editable";
    import {mixinFormatter} from "../../../../mixins";
    import {mixinDataTable} from "../../../../mixins/datatable";
    import {mixinTootilps} from "../../../../mixins/tooltip";

    export default {
        name: "management-costs",
        mixins: [mixinTootilps, mixinValidator, mixinSelect2, mixinLoading, mixinDate, mixinHttpStatus, mixinEditable, mixinFormatter, mixinDataTable, mixinMomentLocale],
        data: function () {
            return {
                portlet: {
                    title: Lang.get('financial.management.costs.index.title'),
                    history: Lang.get('validation.attributes.history').capitalize(),
                },
                table: {
                    cost: Lang.get('validation.attributes.cost').capitalize(),
                    labelCost: Lang.get('financial.help-text.cost'),
                    until: Lang.get('validation.attributes.valid_until').capitalize(),
                    labelUntil: Lang.get('financial.help-text.valid_until'),
                    editableAttr: {
                        format: 'yyyy-mm-dd',
                        minYear: moment().year(),
                        maxYear: moment().add(1, 'y').year()
                    },
                    sourceExtension: [],
                    sourceValidation: [],
                    sourceIntersemester: [],
                    sourceSubjects: [],
                    sources: []
                },
                params: {
                    cost: null,
                    service_name: null,
                    valid_until: null,
                },
                formCost: {
                    cost: {
                        value: null,
                        help: Lang.get('financial.help-text.cost'),
                        label: Lang.get('validation.attributes.cost').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            maxlength: 7,
                            minlength: 1,
                            min: 0,
                            max: 9999999,
                        }
                    },
                    serviceName: {
                        value: null,
                        label: Lang.get('validation.attributes.service_name').capitalize(),
                        options: [
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
                    validUntil: {
                        value: null,
                        help: Lang.get('financial.help-text.valid_until'),
                        label: Lang.get('validation.attributes.valid_until').capitalize(),
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
                    }
                },
                buttons: {
                    send: Lang.get('financial.buttons.send'),
                    cancel: Lang.get('financial.buttons.cancel'),
                },
                history: {
                    id: 'datatable-cost',
                    columns: [
                        {name: '#', class: ''},
                        {name: Lang.get('validation.attributes.cost').capitalize(), class: ''},
                        {name: Lang.get('validation.attributes.service_name').capitalize(), class: ''},
                        {name: Lang.get('validation.attributes.valid_until').capitalize(), class: ''},
                    ],
                    url: route('financial.api.datatables.cost', {}, false),
                    source: [
                        { data: 'id',                   name: 'id' },
                        { data: 'cost_to_money',        name: 'cost_to_money' },
                        { data: 'read_service_name',    name: 'read_service_name' },
                        {
                            data: 'cost_valid_until',
                            name: 'cost_valid_until',
                            render: function (data, type, row) {
                                return (data) ? moment( data ).format('ll') : null;
                            }
                        },
                    ],
                }
            }
        },
        mounted: function () {
            this.handleDatePicker();
            this.handleFormValidation();
            this.getData();
            this.initTable();
        },
        methods: {
            checkLength: function( value ) {
                this.formCost.cost.value = value = value.slice(0, 7);
                this.$emit('input', value);
            },
            initTable: function() {
                let self = this;
                $( `#${self.history.id}` ).DataTable({
                    columns: self.history.source,
                    ajax: {
                        url: self.history.url,
                        error: function (data) {
                            self.triggerSwal(data);
                        },
                        fail: function (data) {
                            self.triggerSwal(data);
                        }
                    },
                });
            },
            handleEditable: function () {
                let that = this, $cost = $(document).find('#table-editable .editable-cost'), $until = $(document).find('#table-editable .editable-until');
                $cost.editable({
                    success: function () {
                        that.getData();
                    },
                    display: function ( currency ) {
                        $(this).text( that.toMoney( currency ) );
                    },
                    validate: function(value) {
                        if($.trim(value) === '') {
                            return Lang.get('validation.required', {attribute: Lang.get('validation.attributes.cost')});
                        }
                        if ( value.length > 7 ) {
                            return Lang.get('validation.digits_between', {attribute: Lang.get('validation.attributes.cost'), min: 0, max: 9999999});
                        }
                    },
                    error: function(errors) {
                        return errors.responseJSON.errors.value[0];
                    }
                });
                $until.editable({
                    success: function () {
                        that.getData();
                        that.setMomentLocale();
                    },
                    display: function (value) {
                        that.setMomentLocale();
                        $(this).text( moment( value ).format('ll') );
                    },
                    validate: function(value) {
                        that.setMomentLocale();
                        if($.trim(value) === '') {
                            return Lang.get('validation.required', {attribute: Lang.get('validation.attributes.valid_until')});
                        }
                        if ( moment(value) <= moment() ) {
                            return Lang.get('validation.after_or_equal', { attribute: Lang.get('validation.attributes.valid_until'), date: moment().format('ll') });
                        }
                    },
                    error: function(errors) {
                        return errors.responseJSON.errors.value[0];
                    },
                    combodate: that.table.editableAttr
                });
            },
            handleFormValidation: function () {
                $( this.$refs.form_costs ).validate({
                    rules: {
                        cost: {
                            required: true,
                            number: true,
                            min: 0,
                        },
                        valid_until: {
                            required: true,
                            date: true,
                            maxlength: 10,
                        },
                        service_name: {
                            required: true,
                        }
                    }
                });
            },
            handleDatePicker: function() {
                let that = this;
                if (jQuery().datepicker) {
                    $('.date-picker').datepicker({
                        format: 'yyyy-mm-dd',
                    }).on('changeDate', function () {
                        that.formCost.validUntil.value = this.value;
                    });
                }
            },
            create: function () {
                if ( $( this.$refs.form_costs ).valid() ) {
                    this.params.cost = this.formCost.cost.value;
                    this.params.service_name = this.formCost.serviceName.value;
                    this.params.valid_until = this.formCost.validUntil.value;
                    this.sendFormCost( 'POST', route('financial.management.costs.store'));
                }
            },
            getData: function () {
                axios.get( route('financial.api.editable.cost') )
                    .then( (response) => {

                        this.table.sources = response.data.data.map( (cost) => {
                            return {
                                id: cost.id,
                                url: route('financial.management.costs.update', {id: cost.id}),
                                cost: cost.cost,
                                money: cost.cost_to_money,
                                service: cost.read_service_name,
                                date:  ( cost.cost_valid_until ) ? moment( cost.cost_valid_until ).format('YYYY-MM-DD') : null,
                            }
                        });
                    })
                    .then(() => {
                        this.handleEditable();
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    });
            },
            sendFormCost: function ($method, $url) {
                this.vueLoading();
                axios({
                    method: $method,
                    url: $url,
                    data: this.params
                })
                    .then( ( response ) => {
                        swal.close();
                        this.setNullValues();
                        this.getData();
                        this.triggerSwal( response );
                    })
                    .catch( ( error ) => {
                        console.log( error.response.data );
                        
                        if ( error.response.data.hasOwnProperty('errors') ) {
                            if (error.response.data.errors.hasOwnProperty('cost')) {
                                this.formCost.cost.hasError = 'has-error';
                                this.formCost.cost.errors = error.response.data.errors.cost;
                            }
                            if (error.response.data.errors.hasOwnProperty('service_name')) {
                                this.formCost.serviceName.hasError = 'has-error';
                                this.formCost.serviceName.errors = error.response.data.errors.service_name;
                            }
                            if (error.response.data.errors.hasOwnProperty('valid_until')) {
                                this.formCost.validUntil.hasError = 'has-error';
                                this.formCost.validUntil.errors = error.response.data.errors.valid_until;
                            }
                        } 
                        
                        swal.close();
                        this.setNullValues();
                        this.getData();
                        this.triggerSwal( error );
                    });
            },
            setNullValues: function () {
                this.formCost.cost.value = null;
                this.formCost.serviceName.value = null;
                this.formCost.validUntil.value = null;
                this.params.cost = null;
                this.params.service_name = null;
                this.params.valid_until = null;
            }
        },
    }
</script>

<style scoped>

</style>