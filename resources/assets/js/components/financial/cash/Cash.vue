<template>
    <div class="row">

        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>$ </span><span data-counter="counterup" data-value="2000000">0</span>
                            </div>
                            <div class="desc"> En caja </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                        <div class="visual">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>$ </span><span data-counter="counterup" data-value="1298300">0</span> </div>
                            <div class="desc"> Salidas </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                        <div class="visual">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>$ </span><span data-counter="counterup" data-value="549">0</span>
                            </div>
                            <div class="desc"> Entradas </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                        <div class="visual">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span data-counter="counterup" data-value="89"></span> </div>
                            <div class="desc"> Transacciones </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <portlet icon="fa fa-money" :title="portlet.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12 margin-bottom-40">
                            <a class="btn btn-success" data-toggle="modal" href="#modal-create" id="create-button" v-text="portlet.btnText"></a>
                        </div>
                        <div class="col-md-12">
                            <vue-data-table
                                    :id="table.id"
                                    :columns="table.columns">
                            </vue-data-table>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-12">
            <empty-sortable-portlet></empty-sortable-portlet>
        </div>
        <vue-modal id="modal-create" :title="portlet.title">
            <template slot="body">
                <form @submit.prevent="createCheck" class="" id="form-cash" accept-charset="UTF-8">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="concept"
                                           type="text"
                                           icon="fa fa-money"
                                           v-model.trim="form.concept.value"
                                           :value="form.concept.value"
                                           :help="form.concept.help"
                                           :hasError="form.concept.hasError"
                                           :errors="form.concept.errors"
                                           :attributes="form.concept.attributes"
                                           :label="form.concept.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="cost"
                                           type="number"
                                           icon="fa fa-user"
                                           v-model.number.trim="form.cost.value"
                                           :value="form.cost.value"
                                           :help="form.cost.help"
                                           :hasError="form.cost.hasError"
                                           :errors="form.cost.errors"
                                           :attributes="form.cost.attributes"
                                           :label="form.cost.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="form.status.label"
                                             v-model="form.status.value"
                                             :value="form.status.value"
                                             :attributes="form.status.attributes"
                                             :options="form.status.options"
                                             name="status">
                                </vue-select2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" v-model="checkbox" id="add_support" name="add_support" class="md-check">
                                        <label for="add_support">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Añadir soporte </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"  v-show="checkbox">
                            <div class="col-md-12">
                                <vue-dropzone ref="myVueDropzone"
                                              @vdropzone-file-added="addedFile"
                                              @vdropzone-max-files-exceeded="maxFilesExceeded"
                                              @vdropzone-sending="addParameters"
                                              @vdropzone-removed-file="addedFile"
                                              @vdropzone-canceled="canceledUpload"
                                              @vdropzone-success="successUpload"
                                              @vdropzone-error="errorUpload"
                                              id="dropzone"
                                              :options="dropzoneOptions">
                                </vue-dropzone>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions margin-top-30">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn green" type="submit" :value="buttons.send">
                                <button class="btn red" type="reset" v-text="buttons.cancel"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
        </vue-modal>
        <vue-modal id="modal-update" :title="portlet.title">
            <template slot="body">
                <form @submit.prevent="edit" class="" id="form-cash-update" accept-charset="UTF-8">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="check"
                                           type="text"
                                           icon="fa fa-money"
                                           v-model.trim="form.concept.value"
                                           :value="form.concept.value"
                                           :help="form.concept.help"
                                           :hasError="form.concept.hasError"
                                           :errors="form.concept.errors"
                                           :attributes="form.concept.attributes"
                                           :label="form.concept.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="pay_to"
                                           icon="fa fa-user"
                                           v-model.trim="form.cost.value"
                                           :value="form.cost.value"
                                           :help="form.cost.help"
                                           :hasError="form.cost.hasError"
                                           :errors="form.cost.errors"
                                           :attributes="form.cost.attributes"
                                           :label="form.cost.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="form.status.label"
                                             v-model="form.status.value"
                                             :value="form.status.value"
                                             :attributes="form.status.attributes"
                                             :options="form.status.options"
                                             name="status">
                                </vue-select2>
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
            </template>
        </vue-modal>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import moment from 'moment-with-locales-es6';
    import vue2Dropzone from 'vue2-dropzone';
    import VuePDFViewer from 'vue-instant-pdf-viewer';
    import 'vue2-dropzone/dist/vue2Dropzone.css';
    import {mixinMomentLocale} from "../../../mixins/moment";
    import {mixinHttpStatus} from "../../../mixins";
    import {mixinDataTable} from "../../../mixins/datatable";
    import {mixinTootilps} from "../../../mixins/tooltip";
    import {mixinValidator} from "../../../mixins/validation";
    import {mixinSelect2} from "../../../mixins/select2";
    import {mixinLoading} from "../../../mixins/loadingswal";

    export default {
        name: "cash",
        mixins: [mixinMomentLocale, mixinHttpStatus, mixinDataTable, mixinTootilps, mixinValidator, mixinSelect2, mixinLoading],
        components: {
            vueDropzone: vue2Dropzone,
            'vue-pdf-viewer': VuePDFViewer
        },
        data: () => {
            return {
                portlet: {
                    title: Lang.get('financial.cash.index.title'),
                    btnText: Lang.get('financial.buttons.add'),
                },
                table: {
                    id: 'datatable-cash',
                    columns: [
                        {name: Lang.get('financial.generic.table.id'), class: ''},
                        {name: Lang.get('financial.generic.table.concept'), class: ''},
                        {name: Lang.get('financial.generic.table.cost'), class: ''},
                        {name: Lang.get('financial.generic.table.support'), class: ''},
                        {name: Lang.get('financial.generic.table.status_name'), class: ''},
                        {name: Lang.get('financial.generic.table.created_at'), class: ''},
                        {name: Lang.get('financial.generic.table.actions'), class: ''},
                    ],
                    url: route('financial.api.datatables.cash', {}, false),
                    source: [
                        { data: 'id',           name: 'id' },
                        { data: 'concept',        name: 'concept' },
                        { data: 'cost_to_money',       name: 'cost_to_money' },
                        { data: 'pdf_url',       name: 'pdf_url' },
                        { data: 'status_label', name: 'status_label' },
                        { data: 'created_at',   name: 'created_at',
                            render: function ( data, type, row ) {
                                return data ? moment(data).format('ll') : null;
                            }
                        },
                        { data: 'actions',      name: 'actions', searchable: false, orderable: false },
                    ],
                },
                form: {
                    concept: {
                        value: null,
                        help: Lang.get('financial.help-text.concept'),
                        label: Lang.get('validation.attributes.concept').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            maxlength: 2000,
                            minlength: 10,
                        }
                    },
                    cost: {
                        value: null,
                        help: Lang.get('financial.help-text.cost'),
                        label: Lang.get('validation.attributes.cost').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            max: 999999999,
                            min: 2,
                        }
                    },
                    status: {
                        value: null,
                        label: Lang.get('validation.attributes.status').capitalize(),
                        options: [
                            { id: 1, text: Lang.get('validation.attributes.in').capitalize() },
                            { id: 2, text: Lang.get('validation.attributes.out').capitalize() },
                        ],
                        attributes: {
                            required: true,
                            disabled: false,
                        }
                    },
                },
                checkbox: 1,
                buttons: {
                    send: Lang.get('financial.buttons.send'),
                    cancel: Lang.get('financial.buttons.cancel'),
                },
                thumbnail: Lang.get('financial.files.upload.index.files.icon'),
                dropzoneOptions: {
                    url: route('financial.files.store'),
                    addRemoveLinks: true,
                    parallelUploads: 1,
                    maxFiles: 1,
                    autoProcessQueue: false,
                    dictRemoveFile: Lang.get("javascript.dropzone.remove"),
                    maxFileSize: 1000,
                    dictResponseError: Lang.get("javascript.dropzone.server_error"),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    acceptedFiles: '.pdf',
                },
                id: 0,
                fileCount: 0,
            }
        },
        mounted: function() {
            this.initDatatable();
            this.initFormValidation();
        },
        methods: {
            initDatatable: function () {
                let self = this;
                let table = $( '#datatable-cash' ).DataTable({
                    columns: self.table.source,
                    ajax: {
                        url: self.table.url,
                        error: function (data) {
                            self.triggerSwal(data);
                        },
                        fail: function (data) {
                            self.triggerSwal(data);
                        }
                    },
                });

                this.editCheck( table );
                this.deleteCheck( table );
            },
            initFormValidation: function() {
                $('#form-cash').validate();
                $('#form-cash-update').validate();
            },
            createCheck: function () {
                if (!this.checkbox) {
                    let data = {
                        concept: this.form.concept.value,
                        cost: this.form.cost.value,
                        status: this.form.status.value,
                        need_file: (this.checkbox) ? '1' : '0',
                    };
                    $('#modal-create').modal('hide');
                    this.vueLoading();
                    axios.post( route('financial.money.cash.store'), qs.stringify( data ) )
                        .then((response) => {
                            this.setFormNull();
                            swal.close();
                            this.triggerSwal( response );
                        })
                        .catch( (error) => {
                            swal.close();
                            this.triggerSwal(error);
                        })
                }
            },
            editCheck: function ( table ) {
                let that = this;
                table.on('click', '.edit', function () {
                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    that.id = data.id;
                    that.form.concept.value = data.concept;
                    that.form.cost.value = data.cost;
                    that.form.status.value = data.status;
                });
            },
            edit: function () {

            },
            setFormNull: function () {
                this.form.concept.value = null;
                this.form.cost.value = null;
                this.form.status.value = null;
            },
            deleteCheck: function ( table ) {
                let self = this;
                table.on('click', '.trash', function (e) {
                    e.preventDefault();
                    let $url = route( 'financial.money.cash.destroy' , { id: $(this).data('id') } );

                    swal({
                        title: Lang.get('javascript.remove'),
                        html: Lang.get('javascript.ask_if_delete'),
                        type: "question",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger ladda-button",
                        confirmButtonText: Lang.get('financial.buttons.yes'),
                        cancelButtonText: Lang.get('financial.buttons.cancel'),
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function () {
                            return new Promise(function (resolve, reject) {
                                axios.delete( $url, {} )
                                    .then(function(response) {
                                        resolve();
                                    })
                                    .catch(function (error) {
                                        self.triggerSwal( error );
                                    });
                            });
                        },
                    }).then( (result) => {
                        if ( result.value ) {
                            table.ajax.reload( self.handleTooltips(), false );
                            swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
                        }
                    }).catch(swal.noop);
                });
            },
            addedFile: function ( file ) {
                if ('undefined' !== typeof this.$refs.myVueDropzone.dropzone) {
                    this.fileCount = this.$refs.myVueDropzone.dropzone.files.length
                } else {
                    this.fileCount = 0;
                }
                file.previewElement.childNodes[1].children[0].setAttribute('src', Lang.get('financial.files.upload.index.files.icon'));
            },
            maxFilesExceeded: function ( file ) {
                this.$refs.myVueDropzone.removeFile(file);
            },
            uploadFile: function () {
                if ( $('#form-cash').valid() && this.fileCount === 1) {
                    this.who = 1;
                    this.$refs.myVueDropzone.processQueue();
                } else {
                    swal({
                        title: Lang.get("javascript.warning"),
                        text: Lang.get("javascript.dropzone.one_file"),
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-success",
                        type: "warning",
                    });
                }
            },
            canceledUpload: function (file) {
                this.setFormNull( file );
            },
            successUpload: function (file, response) {
                this.setNullForm(file);
                if (file.status === "success") {
                    swal({
                        title: Lang.get("javascript.dropzone.stored"),
                        text: Lang.get("javascript.dropzone.success", { filename: file.name }),
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-success",
                        type: "success",
                    });

                } else {
                    this.triggerSwal( response );
                }
            },
            errorUpload: function (file, message, xhr) {
                this.setNullForm(file);
                if ( message.hasOwnProperty('message') && message.hasOwnProperty('title') ) {
                    swal(
                        message.title,
                        message.message,
                        'warning'
                    );
                } else {
                    swal({
                        title: Lang.get("javascript.error"),
                        text:  Lang.get("javascript.dropzone.failed") + ' ' +file.name ,
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-danger",
                        type: "error",
                    }).then((result) => {
                        if (result.value) {
                            this.triggerSwal(xhr);
                        }
                    })
                }
            },
            addParameters: function (file, xhr, formData) {
                formData.append('concept', this.form.concept.value);
                formData.append('cost', this.form.cost.value);
                formData.append('status', this.form.status.value);
            },
        }
    }
</script>

<style scoped>

</style>