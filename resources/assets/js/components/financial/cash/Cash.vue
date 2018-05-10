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
                                <ICountUp
                                        :startVal="counter.startVal"
                                        :endVal="stats.cash"
                                        :decimals="counter.decimals"
                                        :duration="counter.duration"
                                        :options="counter.options"
                                        @ready="onReady"
                                />
                            </div>
                            <div class="desc"> En caja </div>
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
                                <ICountUp
                                        :startVal="counter.startVal"
                                        :endVal="stats.in"
                                        :decimals="counter.decimals"
                                        :duration="counter.duration"
                                        :options="counter.options"
                                        @ready="onReadyIn"
                                />
                            </div>
                            <div class="desc"> Entradas </div>
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
                                <ICountUp
                                        :startVal="counter.startVal"
                                        :endVal="stats.out"
                                        :decimals="counter.decimals"
                                        :duration="counter.duration"
                                        :options="counter.options"
                                        @ready="onReadyOut"
                                />
                            </div>
                            <div class="desc"> Salidas </div>
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
                                <ICountUp
                                        :startVal="counter.startVal"
                                        :endVal="stats.all"
                                        :decimals="counter.decimals"
                                        :duration="counter.duration"
                                        :options="counter.options2"
                                        @ready="onReadyAll"
                                />
                            </div>
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
                            <a class="btn btn-success" data-toggle="modal" @click.prevent="setFormNull" href="#modal-create" id="create-button" v-text="portlet.btnText"></a>
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
        <vue-modal id="modal-create" :showDismiss="false" :title="portlet.title">
            <template slot="body">
                <form @submit.prevent="uploadFile" class="" id="form-cash" accept-charset="UTF-8">
                    <div class="form-body">
                        <div class="row" v-if="errors">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <hr>
                                    <vue-alert :type="errors.alertClass"
                                               :dismiss="false"
                                               :heading="errors.title"
                                               :icon="errors.icon"
                                               :text="errors.text"
                                               :status="errors.status"
                                               :errors="errors.errors">
                                    </vue-alert>
                                </div>
                            </div>
                        </div>
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
                                <vue-input-empty icon="fa fa-money"
                                                 :label="form.cost.label"
                                                 :help="form.cost.help"
                                                 :hasError="form.cost.hasError"
                                                 :errors="form.cost.errors"
                                                 name="cost">
                                    <input type="number"
                                           name="cost"
                                           required="required"
                                           ref="cost"
                                           :placeholder="form.cost.label"
                                           :min="form.cost.attributes.min"
                                           :max="form.cost.attributes.max"
                                           autocomplete="off"
                                           pattern="\d{1,9}"
                                           @input="checkLength( $event.target.value )"
                                           class="form-control"
                                           id="cost"
                                           v-model.number.trim="form.cost.value" />
                                </vue-input-empty>
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
                                              @vdropzone-complete="removeFiles"
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
                                <button class="btn red" data-dismiss="modal" type="reset" @click.prevent="setFormNull" v-text="buttons.cancel"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
        </vue-modal>
        <vue-modal id="modal-update" :showDismiss="false" :title="portlet.title">
            <template slot="body">
                <form @submit.prevent="uploadFileUpdate" class="" id="form-cash-update" accept-charset="UTF-8">
                    <div class="form-body">
                        <div class="row" v-if="errors2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <hr>
                                    <vue-alert :type="errors.alertClass"
                                               :dismiss="false"
                                               :heading="errors.title"
                                               :icon="errors.icon"
                                               :text="errors.text"
                                               :status="errors.status"
                                               :errors="errors.errors">
                                    </vue-alert>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="concept"
                                           type="text"
                                           icon="fa fa-money"
                                           v-model.trim="form2.concept.value"
                                           :value="form2.concept.value"
                                           :help="form2.concept.help"
                                           :hasError="form2.concept.hasError"
                                           :errors="form2.concept.errors"
                                           :attributes="form2.concept.attributes"
                                           :label="form2.concept.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input-empty icon="fa fa-money"
                                                 :label="form2.cost.label"
                                                 :help="form2.cost.help"
                                                 :hasError="form2.cost.hasError"
                                                 :errors="form2.cost.errors"
                                                 name="cost">
                                    <input type="number"
                                           name="cost"
                                           required="required"
                                           ref="cost"
                                           :placeholder="form2.cost.label"
                                           :min="form2.cost.attributes.min"
                                           :max="form2.cost.attributes.max"
                                           autocomplete="off"
                                           pattern="\d{1,9}"
                                           @input="checkLength2( $event.target.value )"
                                           class="form-control"
                                           id="cost_update"
                                           v-model.number.trim="form2.cost.value" />
                                </vue-input-empty>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="form2.status.label"
                                             v-model="form2.status.value"
                                             :value="form2.status.value"
                                             :attributes="form2.status.attributes"
                                             :options="form2.status.options"
                                             name="status">
                                </vue-select2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" v-model="checkbox2" id="add_support_update" name="add_support_update" class="md-check">
                                        <label for="add_support_update">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Añadir soporte </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" v-model="checkbox_update" id="delete_file" name="delete_file" class="md-check">
                                        <label for="delete_file">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Eliminar archivo actual</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"  v-if="checkbox2">
                            <div class="col-md-12">
                                <vue-dropzone ref="myVueDropzoneUpdate"
                                              @vdropzone-file-added="addedFileUpdate"
                                              @vdropzone-max-files-exceeded="maxFilesExceededUpdate"
                                              @vdropzone-sending="addParametersUpload"
                                              @vdropzone-removed-file="addedFileUpdate"
                                              @vdropzone-canceled="canceledUpload"
                                              @vdropzone-success="successUpload"
                                              @vdropzone-error="errorUpload"
                                              @vdropzone-complete="removeFilesUpdate"
                                              id="dropzone_update"
                                              :options="dropzoneOptionsUpdate">
                                </vue-dropzone>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions  margin-top-30">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn green" type="submit" :value="buttons.send">
                                <button class="btn red" data-dismiss="modal" type="reset" @click.prevent="setFormNull" v-text="buttons.cancel"></button>
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
    import './../../../../sass/vue2Dropzone.css'
    import VuePDFViewer from 'vue-instant-pdf-viewer';
    import ICountUp from 'vue-countup-v2';
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
            'vue-pdf-viewer': VuePDFViewer,
            ICountUp: ICountUp,
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
                        {name: Lang.get('financial.generic.table.support'), class: 'none'},
                        {name: Lang.get('financial.generic.table.status_name'), class: ''},
                        {name: Lang.get('financial.generic.table.created_at'), class: 'none'},
                        {name: Lang.get('financial.generic.table.actions'), class: ''},
                    ],
                    url: route('financial.api.datatables.cash', {}, false),
                    source: [
                        { data: 'id',           name: 'id' },
                        { data: 'concept',        name: 'concept' },
                        { data: 'cost_to_money',       name: 'cost_to_money' },
                        { data: 'pdf_url',       name: 'pdf_url',
                            render: function ( data, type, row ) {
                                return data ? `<a href="${data}" target="_blank"><i class="fa fa-file-pdf-o"></i> Ver Archivo</a>` : null;
                            }
                        },
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
                            min: 50,
                        }
                    },
                    status: {
                        value: null,
                        label: Lang.get('validation.attributes.status').capitalize(),
                        options: [
                            { id: 4, text: Lang.get('validation.attributes.in').capitalize() },
                            { id: 3, text: Lang.get('validation.attributes.out').capitalize() },
                        ],
                        attributes: {
                            required: true,
                            disabled: false,
                        }
                    },
                },
                form2: {
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
                            min: 50,
                        }
                    },
                    status: {
                        value: null,
                        label: Lang.get('validation.attributes.status').capitalize(),
                        options: [
                            { id: 4, text: Lang.get('validation.attributes.in').capitalize() },
                            { id: 3, text: Lang.get('validation.attributes.out').capitalize() },
                        ],
                        attributes: {
                            required: true,
                            disabled: false,
                        }
                    },
                },
                checkbox: 1,
                checkbox2: 0,
                checkbox_update: 0,
                buttons: {
                    send: Lang.get('financial.buttons.send'),
                    cancel: Lang.get('financial.buttons.cancel'),
                },
                thumbnail: Lang.get('financial.files.upload.index.files.icon'),
                dropzoneOptions: {
                    url: route('financial.money.cash.store'),
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
                    dictInvalidFileType: 'No se permite este tipo de archivo',
                },
                dropzoneOptionsUpdate: {
                    url: '',
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
                    dictInvalidFileType: 'No se permite este tipo de archivo',
                },
                id: 0,
                fileCount: 0,
                selectedFile: null,
                who: 0,
                errors: null,
                errors2: null,
                stats: {
                    cash: 0,
                    in: 0,
                    out: 0,
                    all: 0,
                },
                counter: {
                    startVal: 0,
                    decimals: 0,
                    duration: 2.5,
                    options: {
                        useEasing: true,
                        useGrouping: true,
                        separator: '.',
                        decimal: ',',
                        prefix: '$',
                        suffix: ''
                    },
                    options2: {
                        useEasing: true,
                        useGrouping: true,
                        separator: '.',
                        decimal: ',',
                        prefix: '',
                        suffix: ''
                    },
                }
            }
        },
        mounted: function() {
            this.getStats();
            this.initDatatable();
            this.initFormValidation();
        },
        methods: {
            onReady: function (instance, CountUp) {
                const that = this;
                instance.update(that.stats.cash);
            },
            onReadyIn: function (instance, CountUp) {
                const that = this;
                instance.update(that.stats.in);
            },
            onReadyOut: function (instance, CountUp) {
                const that = this;
                instance.update(that.stats.out);
            },
            onReadyAll: function (instance, CountUp) {
                const that = this;
                instance.update(that.stats.all);
            },
            checkLength: function( value ) {
                this.form.cost.value = value = value.slice(0, 9);
                this.$emit('input', value);
            },
            checkLength2: function( value ) {
                this.form2.cost.value = value = value.slice(0, 9);
                this.$emit('input', value);
            },
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
            editCheck: function ( table ) {
                this.setFormNull();
                let that = this;
                table.on('click', '.edit', function () {
                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    that.id = data.id;
                    that.dropzoneOptionsUpdate.url = route('financial.money.cash.update', {id: that.id} );
                    that.form2.concept.value = data.concept;
                    that.form2.cost.value = data.cost;
                    that.form2.status.value = data.status;
                    that.checkbox2 = 0;
                    that.checkbox_update = 0;
                    $('#modal-update').modal('show');
                });
            },
            setFormNull: function (file) {
                if ( typeof file !== 'undefined' ) {
                    if ( file.type === "application/pdf" ) {
                        if ( this.who === 1 ) {
                            this.$refs.myVueDropzone.removeFile(file);
                        }
                        if ( this.who === 2 ) {
                            this.$refs.myVueDropzoneUpdate.removeFile(file);
                        }
                    }
                }
                $('.t-refresh').trigger('click');
                this.who = 0;
                this.id = 0;
                this.form.concept.value = null;
                this.form.cost.value = null;
                this.form.status.value = null;
                this.form2.concept.value = null;
                this.form2.cost.value = null;
                this.form2.status.value = null;
                this.fileCount = 0;
                this.checkbox = 1;
                this.checkbox2 = 0;
                this.checkbox_update = 0;
                this.errors = null;
                this.errors2 = null;
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
                            self.getStats();
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
            addedFileUpdate: function ( file ) {
                if ('undefined' !== typeof this.$refs.myVueDropzoneUpdate.dropzone) {
                    this.fileCount = this.$refs.myVueDropzoneUpdate.dropzone.files.length
                } else {
                    this.fileCount = 0;
                }
                file.previewElement.childNodes[1].children[0].setAttribute('src', Lang.get('financial.files.upload.index.files.icon'));
            },
            maxFilesExceeded: function ( file ) {
                this.$refs.myVueDropzone.removeFile(file);
            },
            maxFilesExceededUpdate: function ( file ) {
                this.$refs.myVueDropzoneUpdate.removeFile(file);
            },
            uploadFile: function () {
                if (!this.checkbox && $('#form-cash').valid()) {
                    this.sendWithAxios();
                }
                if ( $('#form-cash').valid() && this.fileCount === 1 && this.checkbox) {
                    this.sendWithDropzone();
                }

                if ( this.fileCount === 0 && this.checkbox ) {
                    this.errors = {
                                alertClass: 'alert-warning',
                                title: Lang.get("javascript.warning"),
                                icon: 'fa fa-exclamation-triangle',
                                text: Lang.get("javascript.dropzone.one_file"),
                                status: '',
                                errors: [],
                            };
                }
            },
            uploadFileUpdate: function () {
                if (!this.checkbox2 && $('#form-cash-update').valid()) {
                    this.updateWithAxios();
                }
                if (  $('#form-cash-update').valid() && this.fileCount === 1 && this.checkbox2) {
                    this.updateWithDropzone();
                }
                if ( this.fileCount === 0 && this.checkbox2 ) {
                    this.errors2 = {
                                alertClass: 'alert-warning',
                                title: Lang.get("javascript.warning"),
                                icon: 'fa fa-exclamation-triangle',
                                text: Lang.get("javascript.dropzone.one_file"),
                                status: '',
                                errors: [],
                            };
                }
            },
            sendWithAxios: function () {
                let element = $('#modal-create');
                let data = {
                    concept: this.form.concept.value,
                    cost: this.form.cost.value,
                    status: this.form.status.value,
                    need_file: (this.checkbox) ? '1' : '0',
                };
                element.modal('hide');
                this.vueLoading();
                axios.post( route('financial.money.cash.store'), qs.stringify( data ) )
                    .then((response) => {
                        swal.close();
                        this.triggerSwal(response);
                    })
                    .then(() => {
                        $('.t-refresh').trigger('click');
                    })
                    .then(() => { this.getStats() })
                    .catch( (error) => {
                        swal.close();
                        this.triggerSwal(error);
                    })
            },
            sendWithDropzone: function () {
                this.who = 1;
                this.$refs.myVueDropzone.processQueue();
            },
            updateWithAxios: function () {
                let element = $('#modal-update');
                let data = {
                    concept: this.form2.concept.value,
                    cost: this.form2.cost.value,
                    status: this.form2.status.value,
                    need_file: (this.checkbox2) ? '1' : '0',
                    delete_file: (this.checkbox_update) ? '1' : '0',
                };
                element.modal('hide');
                this.vueLoading();
                axios.put( route('financial.money.cash.update', {id: this.id}), data )
                    .then((response) => {
                        swal.close();
                        this.triggerSwal(response);
                    })
                    .then(() => {
                        $('.t-refresh').trigger('click');
                    })
                    .then(() => { this.getStats() })
                    .catch( (error) => {
                        swal.close();
                        this.triggerSwal(error);
                    })
            },
            updateWithDropzone: function () {
                this.who = 2;
                this.$refs.myVueDropzoneUpdate.processQueue();
            },
            canceledUpload: function (file) {
                this.setFormNull( file );
            },
            successUpload: function (file, response) {
                $('#modal-update').modal('hide');
                $('#modal-create').modal('hide');
                if (file.status === "success") {
                    swal({
                        title: Lang.get("javascript.dropzone.stored"),
                        text: Lang.get("javascript.dropzone.success", { filename: file.name }),
                        buttonsStyling: false,
                        confirmButtonClass: "btn btn-success",
                        type: "success",
                    }).then(() => { $('.t-refresh').trigger('click') })
                        .then(() => { this.getStats() })
                } else {
                    this.triggerSwal( response );
                }
            },
            errorUpload: function (file, message, xhr) {
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
                formData.append('need_file', (this.checkbox) ? '1': '0');
                formData.append('delete_file', (this.checkbox_update) ? '1' : '0');
            },
            addParametersUpload: function (file, xhr, formData) {
                formData.append('concept', this.form2.concept.value);
                formData.append('cost', this.form2.cost.value);
                formData.append('status', this.form2.status.value);
                formData.append('need_file', (this.checkbox2) ? '1': '0');
                formData.append('delete_file', (this.checkbox_update) ? '1' : '0');
                formData.append('_method', 'PUT');
            },
            removeFilesUpdate: function (file) {
                this.$refs.myVueDropzoneUpdate.removeFile(file);
            },
            removeFiles: function (file) {
                this.$refs.myVueDropzone.removeFile(file);
            },
            getStats: function () {
                axios.get( route('financial.api.stats.financial.petty.cash') )
                    .then((response) => {
                        this.stats = response.data;
                    })
                    .catch((error) => {
                        this.triggerSwal(error);
                    })
            }
        }
    }
</script>

<style scoped>
    html.swal2-container,
    body.swal2-container {
        z-index: 99999999;
    }
    html.swal2-shown,
    body.swal2-shown {
        overflow-y: auto !important;
    }
</style>