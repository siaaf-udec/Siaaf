<template>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div id="tabs" class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="fa fa-file-o font-green"></i>
                        <span class="caption-subject font-green bold uppercase" v-text="portlet.title"></span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#portlet_tab1" ref="li_tab_1" data-toggle="tab" v-text="portlet.title"></a>
                        </li>
                        <li>
                            <a href="#portlet_tab2" ref="li_tab_2" data-toggle="tab" v-text="modal.title"></a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab1">
                            <div class="row">
                                <transition name="fade" mode="out-in" appear @before-appear="transitionComplete">
                                    <div v-if="alert.show" class="col-md-12">
                                        <div class="panel panel-warning">
                                            <div class="panel-heading">
                                                <h3 class="panel-title" v-text="alert.title"></h3>
                                            </div>
                                            <div class="panel-body">
                                                <p v-text="alert.file"></p>
                                                <p v-text="alert.type"></p>
                                                <p v-text="alert.status"></p>
                                                <form @submit.prevent="uploadFileUpdate" ref="updateFileForm" id="financial-form-files-update">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <vue-select2 :label="files.label"
                                                                             v-model.number="files.value"
                                                                             :value="files.value"
                                                                             :options="options"
                                                                             name="file_type">
                                                                </vue-select2>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <vue-dropzone ref="myVueDropzoneUpdate"
                                                                              @vdropzone-file-added="addedFileUpdate"
                                                                              @vdropzone-max-files-exceeded="maxFilesExceeded"
                                                                              @vdropzone-sending="addParametersUpdate"
                                                                              @vdropzone-removed-file="addedFile"
                                                                              @vdropzone-canceled="canceledUpload"
                                                                              @vdropzone-success="successUpload"
                                                                              @vdropzone-error="errorUpload"
                                                                              id="dropzone-update"
                                                                              :options="dropzoneOptions2">
                                                                </vue-dropzone>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-12 margin-top-20">
                                                                <input class="btn green" type="submit" :value="buttons.send">
                                                                <input class="btn red" type="button" @click.prevent="setNullForm" :value="buttons.cancel">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </transition>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-condensed flip-content">
                                            <thead class="flip-content">
                                            <tr>
                                                <th v-for="col in table.cols" :class="col.rowClass" v-text="col.text"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="upload in formatData">
                                                <td v-text="upload.id"></td>
                                                <td>
                                            <span class="label label-sm label-info">
                                                <i class="fa fa-file-pdf-o"></i> -
                                                <a data-target="#view-pdf"
                                                   data-toggle="modal"
                                                   class="font-white"
                                                   @click="src = upload.route; id = upload.id;"
                                                   v-text="upload.name"></a>
                                            </span>
                                                </td>
                                                <td v-text="upload.type"></td>
                                                <td v-text="upload.status"></td>
                                                <td v-text="upload.created"></td>
                                                <td>
                                                    <span class="label label-sm label-warning">
                                                        <a class="font-white tooltips"
                                                           :data-original-title="buttons.edit"
                                                           @click="editFile( upload )"> <i class="fa fa-pencil"></i> </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="label label-sm label-success">
                                                        <a data-target="#view-pdf"
                                                           data-toggle="modal"
                                                           @click="src = upload.route; id = upload.id;"
                                                           class="font-white tooltips"
                                                           :data-original-title="buttons.comment"> <i class="fa fa-comments"></i> {{ upload.comments }} </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="portlet_tab2">
                            <div class="row">
                                <div class="col-md-6">
                                    <form @submit.prevent="uploadFile" id="financial-form-files">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <vue-select2 :label="files.label"
                                                                 v-model.number="files.value"
                                                                 :value="files.value"
                                                                 :options="options"
                                                                 name="file_type">
                                                    </vue-select2>
                                                </div>
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
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 margin-top-20">
                                                    <input class="btn green" type="submit" :value="buttons.send">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="m-heading-1 border-green m-bordered">
                                        <h3 v-text="portlet.heading"></h3>
                                        <p v-text="portlet.text">
                                        </p>
                                        <a href="https://www.ucundinamarca.edu.co/index.php/academia/apoyo-financiero" target="_blank" v-text="portlet.here"></a>.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6"><empty-sortable-portlet></empty-sortable-portlet></div>

        <!--Modal PDF Viewer -->
        <vue-modal id="view-pdf"
                   title="PDF Viewer"
                   modalClass="container">
            <template slot="body">
                <div class="row">
                    <div class="col-md-8">
                        <vue-pdf-viewer height="500px"
                                        :url="src">
                        </vue-pdf-viewer>
                    </div>
                    <div class="col-md-4">
                        <vue-comments :id="id"
                                      send="financial.api.file.comment.store"
                                      get="financial.api.file.comment.index">
                        </vue-comments>
                    </div>
                </div>
            </template>
        </vue-modal>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import moment from 'moment-with-locales-es6';
    import vue2Dropzone from 'vue2-dropzone';
    import VuePDFViewer from 'vue-instant-pdf-viewer'
    import 'vue2-dropzone/dist/vue2Dropzone.css';
    import {mixinHttpStatus} from "../../../../mixins";
    import {mixinSelect2} from "../../../../mixins/select2";
    import {mixinValidator} from "../../../../mixins/validation";

    export default {
        name: "file-upload",
        mixins: [mixinSelect2, mixinValidator, mixinHttpStatus],
        components: {
            vueDropzone: vue2Dropzone,
            'vue-pdf-viewer': VuePDFViewer
        },
        data: function() {
            return {
                modal: {
                    title: Lang.get('financial.files.upload.index.title'),
                },
                table:  {
                    cols: [
                        {text: '#',  rowClass: ''},
                        {text: Lang.get('validation.attributes.file').capitalize(),  rowClass: ''},
                        {text: Lang.get('validation.attributes.request_type').capitalize(),  rowClass: ''},
                        {text: Lang.get('validation.attributes.status').capitalize(),  rowClass: ''},
                        {text: Lang.get('validation.attributes.created_at').capitalize(),  rowClass: ''},
                        {text: Lang.get('financial.buttons.edit').capitalize(),  rowClass: ''},
                        {text: Lang.get('javascript.tooltip.comments').capitalize(),  rowClass: ''},
                    ]
                },
                fileCount: 0,
                uploadedFiles: [],
                id: null,
                src: '',
                portlet: {
                    title: Lang.get('validation.attributes.file').capitalize(),
                    heading: Lang.get('javascript.info'),
                    text: Lang.get('financial.files.upload.index.files.description'),
                    here: Lang.get('financial.buttons.here'),
                },
                buttons: {
                    send: Lang.get('financial.buttons.send'),
                    add: Lang.get('financial.buttons.add'),
                    edit: Lang.get('financial.buttons.edit'),
                    cancel: Lang.get('financial.buttons.cancel'),
                    comment: Lang.get('javascript.tooltip.comments'),
                },
                options: [],
                files: {
                    label: Lang.get('validation.attributes.file_type').capitalize(),
                    value: null,
                    attributes: {
                        disabled: true,
                        required: true,
                        class: null,
                    }
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
                dropzoneOptions2: {
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
                },
                comment: null,
                alert: {
                    title: Lang.get('javascript.warning'),
                    file: null,
                    type: null,
                    status: null,
                    show: false,
                },
                selectedFile: null,
                who: 0,
            }
        },
        mounted: function () {
            moment.locale( Lang.get('javascript.locale') );
            this.getOptionsSelect();
            this.formValidation();
            this.getFiles();
        },
        methods: {
            formValidation: function () {
                $('#financial-form-files').validate();
            },
            getOptionsSelect: function () {
                axios.get( route('financial.api.options.file-type.options') )
                    .then( (response) => {
                       this.options = response.data;
                       this.files.attributes.disabled = false;
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
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
            uploadFile: function () {
                if ( $('#financial-form-files').valid() && this.fileCount === 1) {
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
            uploadFileUpdate: function () {
                if ( $( this.$refs.updateFileForm ).valid() && this.fileCount === 1) {
                    this.who = 2;
                    this.$refs.myVueDropzoneUpdate.processQueue();
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
                this.setNullForm( file );
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
                    this.getFiles();
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
                formData.append('file_type', this.files.value);
            },
            addParametersUpdate: function (file, xhr, formData) {
                formData.append('file_type', this.files.value);
                formData.append('_method', 'PUT');
            },
            setNullForm: function (file) {
                if ( file.type === "application/pdf" ) {
                    if ( this.who === 1 ) {
                        this.$refs.myVueDropzone.removeFile(file);
                    }
                    if ( this.who === 2 ) {
                        this.$refs.myVueDropzoneUpdate.removeFile(file);
                    }
                }
                this.who = 0;
                this.files.value = null;
                this.alert.show = false;
                this.alert.text = null;
                this.alert.status = null;
                this.alert.errors = null;
                this.selectedFile = null;
            },
            getFiles: function () {
                axios.get( route('financial.api.files.own.files') )
                    .then( (response) => {
                        this.uploadedFiles = response.data;
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    });
            },
            transitionComplete: function () {
                $(this.$refs.updateFileForm).validate();
            },
            editFile: function ( file ) {
                if ( file.status !== 'APROBADO' ) {
                    this.selectedFile = file;
                    this.dropzoneOptions2.url = route('financial.files.update', {id: file.id});
                    this.alert.show = true;
                    this.alert.file = Lang.get('javascript.dropzone.replace', {filename: file.name});
                    this.alert.type = Lang.get('javascript.dropzone.file_type', {request: file.type});
                    this.alert.status = Lang.get('javascript.dropzone.status', {status: file.status})
                    this.files.value = file.type_id;
                } else {
                    swal(
                        Lang.get('javascript.warning'),
                        Lang.get('javascript.messages.can_not_edit'),
                        'warning'
                    );
                }
            },
        },
        computed: {
            formatData: function () {
                return this.uploadedFiles.map( ( file ) => {
                    return {
                        id: file.pk_id || 0,
                        name: file.file_name || Lang.get('financial.generic.empty'),
                        route: file.pdf_url || 'javascrip:;',
                        status: ( file.status ) ? file.status.status_name : Lang.get('financial.generic.empty'),
                        type:   ( file.file_type ) ? file.file_type.file_types : Lang.get('financial.generic.empty'),
                        type_id:   ( file.file_type ) ? file.file_type.pk_id : 0,
                        created: ( file.created_at ) ? moment( file.created_at ).format('ll') : Lang.get('financial.generic.empty'),
                        comments: file.comments_count || 0
                    }
                });
            },
        }
    }
</script>
