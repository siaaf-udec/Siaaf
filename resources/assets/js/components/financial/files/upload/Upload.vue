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

<style scoped>
    /*
 * The MIT License
 * Copyright (c) 2012 Matias Meno <m@tias.me>
 */
    @-webkit-keyframes passing-through {
        0% {
            opacity: 0;
            -webkit-transform: translateY(40px);
            -moz-transform: translateY(40px);
            -ms-transform: translateY(40px);
            -o-transform: translateY(40px);
            transform: translateY(40px); }
        30%, 70% {
            opacity: 1;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            -ms-transform: translateY(0px);
            -o-transform: translateY(0px);
            transform: translateY(0px); }
        100% {
            opacity: 0;
            -webkit-transform: translateY(-40px);
            -moz-transform: translateY(-40px);
            -ms-transform: translateY(-40px);
            -o-transform: translateY(-40px);
            transform: translateY(-40px); } }
    @-moz-keyframes passing-through {
        0% {
            opacity: 0;
            -webkit-transform: translateY(40px);
            -moz-transform: translateY(40px);
            -ms-transform: translateY(40px);
            -o-transform: translateY(40px);
            transform: translateY(40px); }
        30%, 70% {
            opacity: 1;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            -ms-transform: translateY(0px);
            -o-transform: translateY(0px);
            transform: translateY(0px); }
        100% {
            opacity: 0;
            -webkit-transform: translateY(-40px);
            -moz-transform: translateY(-40px);
            -ms-transform: translateY(-40px);
            -o-transform: translateY(-40px);
            transform: translateY(-40px); } }
    @keyframes passing-through {
        0% {
            opacity: 0;
            -webkit-transform: translateY(40px);
            -moz-transform: translateY(40px);
            -ms-transform: translateY(40px);
            -o-transform: translateY(40px);
            transform: translateY(40px); }
        30%, 70% {
            opacity: 1;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            -ms-transform: translateY(0px);
            -o-transform: translateY(0px);
            transform: translateY(0px); }
        100% {
            opacity: 0;
            -webkit-transform: translateY(-40px);
            -moz-transform: translateY(-40px);
            -ms-transform: translateY(-40px);
            -o-transform: translateY(-40px);
            transform: translateY(-40px); } }
    @-webkit-keyframes slide-in {
        0% {
            opacity: 0;
            -webkit-transform: translateY(40px);
            -moz-transform: translateY(40px);
            -ms-transform: translateY(40px);
            -o-transform: translateY(40px);
            transform: translateY(40px); }
        30% {
            opacity: 1;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            -ms-transform: translateY(0px);
            -o-transform: translateY(0px);
            transform: translateY(0px); } }
    @-moz-keyframes slide-in {
        0% {
            opacity: 0;
            -webkit-transform: translateY(40px);
            -moz-transform: translateY(40px);
            -ms-transform: translateY(40px);
            -o-transform: translateY(40px);
            transform: translateY(40px); }
        30% {
            opacity: 1;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            -ms-transform: translateY(0px);
            -o-transform: translateY(0px);
            transform: translateY(0px); } }
    @keyframes slide-in {
        0% {
            opacity: 0;
            -webkit-transform: translateY(40px);
            -moz-transform: translateY(40px);
            -ms-transform: translateY(40px);
            -o-transform: translateY(40px);
            transform: translateY(40px); }
        30% {
            opacity: 1;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            -ms-transform: translateY(0px);
            -o-transform: translateY(0px);
            transform: translateY(0px); } }
    @-webkit-keyframes pulse {
        0% {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); }
        10% {
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -o-transform: scale(1.1);
            transform: scale(1.1); }
        20% {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); } }
    @-moz-keyframes pulse {
        0% {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); }
        10% {
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -o-transform: scale(1.1);
            transform: scale(1.1); }
        20% {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); } }
    @keyframes pulse {
        0% {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); }
        10% {
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -o-transform: scale(1.1);
            transform: scale(1.1); }
        20% {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1); } }
    .dropzone, .dropzone * {
        box-sizing: border-box; }

    .dropzone {
        min-height: 150px;
        border: 2px solid rgba(0, 0, 0, 0.3);
        background: white;
        padding: 20px 20px; }
    .dropzone.dz-clickable {
        cursor: pointer; }
    .dropzone.dz-clickable * {
        cursor: default; }
    .dropzone.dz-clickable .dz-message, .dropzone.dz-clickable .dz-message * {
        cursor: pointer; }
    .dropzone.dz-started .dz-message {
        display: none; }
    .dropzone.dz-drag-hover {
        border-style: solid; }
    .dropzone.dz-drag-hover .dz-message {
        opacity: 0.5; }
    .dropzone .dz-default.dz-message {
        position: absolute;
        text-align: center;
        width: 160px;
        height: 160px;
        margin-left: -80px;
        margin-top: -90px;
        top: 50%;
        left: 50%;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
        opacity: 1;
        -moz-opacity: 1;
        -khtml-opacity: 1;
        -ms-filter: none;
        filter: none;
        -webkit-transition: opacity 0.3s ease-in-out;
        -moz-transition: opacity 0.3s ease-in-out;
        -o-transition: opacity 0.3s ease-in-out;
        -ms-transition: opacity 0.3s ease-in-out;
        transition: opacity 0.3s ease-in-out;
    }
    .dropzone .dz-default.dz-message:after {
        font-family: FontAwesome;
        content: "\f0ee";
        font-size: 130px;
        display: block;
        color: #50C8B4;
    }
    .dropzone .dz-default.dz-message span {
        display: none;
    }
    .dropzone .dz-preview {
        position: relative;
        display: inline-block;
        vertical-align: top;
        margin: 16px;
        min-height: 100px; }
    .dropzone .dz-preview:hover {
        z-index: 1000; }
    .dropzone .dz-preview:hover .dz-details {
        opacity: 1; }
    .dropzone .dz-preview.dz-file-preview .dz-image {
        border-radius: 20px;
        background: #999;
        background: linear-gradient(to bottom, #eee, #ddd); }
    .dropzone .dz-preview.dz-file-preview .dz-details {
        opacity: 1; }
    .dropzone .dz-preview.dz-image-preview {
        background: white; }
    .dropzone .dz-preview.dz-image-preview .dz-details {
        -webkit-transition: opacity 0.2s linear;
        -moz-transition: opacity 0.2s linear;
        -ms-transition: opacity 0.2s linear;
        -o-transition: opacity 0.2s linear;
        transition: opacity 0.2s linear; }
    .dropzone .dz-preview .dz-remove {
        font-size: 14px;
        text-align: center;
        display: block;
        cursor: pointer;
        border: none; }
    .dropzone .dz-preview .dz-remove:hover {
        text-decoration: underline; }
    .dropzone .dz-preview:hover .dz-details {
        opacity: 1; }
    .dropzone .dz-preview .dz-details {
        z-index: 20;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        font-size: 13px;
        min-width: 100%;
        max-width: 100%;
        padding: 2em 1em;
        text-align: center;
        color: rgba(0, 0, 0, 0.9);
        line-height: 150%; }
    .dropzone .dz-preview .dz-details .dz-size {
        margin-bottom: 1em;
        font-size: 16px; }
    .dropzone .dz-preview .dz-details .dz-filename {
        display: none;
        white-space: nowrap; }
    .dropzone .dz-preview .dz-details .dz-filename:hover span {
    border: 1px solid rgba(200, 200, 200, 0.8);
    background-color: rgba(255, 255, 255, 0.8); }
    .dropzone .dz-preview .dz-details .dz-filename:not(:hover) {
        overflow: hidden;
        text-overflow: ellipsis; }
    .dropzone .dz-preview .dz-details .dz-filename:not(:hover) span {
        border: 1px solid transparent; }
    .dropzone .dz-preview .dz-details .dz-filename span, .dropzone .dz-preview .dz-details .dz-size span {
        text-align: center;
        background-color: rgba(255, 255, 255, 0.4);
        padding: 0 0.4em;
        border-radius: 3px; }
    .dropzone .dz-preview:hover .dz-image img {
        -webkit-transform: scale(1.05, 1.05);
        -moz-transform: scale(1.05, 1.05);
        -ms-transform: scale(1.05, 1.05);
        -o-transform: scale(1.05, 1.05);
        transform: scale(1.05, 1.05);
        -webkit-filter: blur(8px);
        filter: blur(8px); }
    .dropzone .dz-preview .dz-image {
        border-radius: 20px;
        overflow: hidden;
        width: 120px;
        height: 120px;
        position: relative;
        display: block;
        z-index: 10; }
    .dropzone .dz-preview .dz-image img {
        display: block; }
    .dropzone .dz-preview.dz-success .dz-success-mark {
        -webkit-animation: passing-through 3s cubic-bezier(0.77, 0, 0.175, 1);
        -moz-animation: passing-through 3s cubic-bezier(0.77, 0, 0.175, 1);
        -ms-animation: passing-through 3s cubic-bezier(0.77, 0, 0.175, 1);
        -o-animation: passing-through 3s cubic-bezier(0.77, 0, 0.175, 1);
        animation: passing-through 3s cubic-bezier(0.77, 0, 0.175, 1); }
    .dropzone .dz-preview.dz-error .dz-error-mark {
        opacity: 1;
        -webkit-animation: slide-in 3s cubic-bezier(0.77, 0, 0.175, 1);
        -moz-animation: slide-in 3s cubic-bezier(0.77, 0, 0.175, 1);
        -ms-animation: slide-in 3s cubic-bezier(0.77, 0, 0.175, 1);
        -o-animation: slide-in 3s cubic-bezier(0.77, 0, 0.175, 1);
        animation: slide-in 3s cubic-bezier(0.77, 0, 0.175, 1); }
    .dropzone .dz-preview .dz-success-mark, .dropzone .dz-preview .dz-error-mark {
        pointer-events: none;
        opacity: 0;
        z-index: 500;
        position: absolute;
        display: block;
        top: 50%;
        left: 50%;
        margin-left: -27px;
        margin-top: -27px; }
    .dropzone .dz-preview .dz-success-mark svg, .dropzone .dz-preview .dz-error-mark svg {
        display: block;
        width: 54px;
        height: 54px; }
    .dropzone .dz-preview.dz-processing .dz-progress {
        opacity: 1;
        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -ms-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear; }
    .dropzone .dz-preview.dz-complete .dz-progress {
        opacity: 0;
        -webkit-transition: opacity 0.4s ease-in;
        -moz-transition: opacity 0.4s ease-in;
        -ms-transition: opacity 0.4s ease-in;
        -o-transition: opacity 0.4s ease-in;
        transition: opacity 0.4s ease-in; }
    .dropzone .dz-preview:not(.dz-processing) .dz-progress {
        -webkit-animation: pulse 6s ease infinite;
        -moz-animation: pulse 6s ease infinite;
        -ms-animation: pulse 6s ease infinite;
        -o-animation: pulse 6s ease infinite;
        animation: pulse 6s ease infinite; }
    .dropzone .dz-preview .dz-progress {
        opacity: 1;
        z-index: 1000;
        pointer-events: none;
        position: absolute;
        height: 16px;
        left: 50%;
        top: 50%;
        margin-top: -8px;
        width: 80px;
        margin-left: -40px;
        background: rgba(255, 255, 255, 0.9);
        -webkit-transform: scale(1);
        border-radius: 8px;
        overflow: hidden; }
    .dropzone .dz-preview .dz-progress .dz-upload {
        background: #333;
        background: linear-gradient(to bottom, #666, #444);
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 0;
        -webkit-transition: width 300ms ease-in-out;
        -moz-transition: width 300ms ease-in-out;
        -ms-transition: width 300ms ease-in-out;
        -o-transition: width 300ms ease-in-out;
        transition: width 300ms ease-in-out; }
    .dropzone .dz-preview.dz-error .dz-error-message {
        display: block; }
    .dropzone .dz-preview.dz-error:hover .dz-error-message {
        opacity: 1;
        pointer-events: auto; }
    .dropzone .dz-preview .dz-error-message {
        pointer-events: none;
        z-index: 1000;
        position: absolute;
        display: block;
        display: none;
        opacity: 0;
        -webkit-transition: opacity 0.3s ease;
        -moz-transition: opacity 0.3s ease;
        -ms-transition: opacity 0.3s ease;
        -o-transition: opacity 0.3s ease;
        transition: opacity 0.3s ease;
        border-radius: 8px;
        font-size: 13px;
        top: 130px;
        left: -10px;
        width: 140px;
        background: #be2626;
        background: linear-gradient(to bottom, #be2626, #a92222);
        padding: 0.5em 1.2em;
        color: white; }
    .dropzone .dz-preview .dz-error-message:after {
        content: '';
        position: absolute;
        top: -6px;
        left: 64px;
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #be2626; }

    .vue-dropzone {
        border: 2px solid #E5E5E5;
        font-family: 'Arial', sans-serif;
        letter-spacing: 0.2px;
        color: #777;
        transition: background-color 0.2s linear;
    }
    .vue-dropzone:hover {
        background-color: #F6F6F6;
    }
    .vue-dropzone i {
        color: #CCC;
    }
    .vue-dropzone .dz-preview .dz-image {
        border-radius: 0;
        width: 100%;
        height: 100%;
    }
    .vue-dropzone .dz-preview .dz-image img:not([src]) {
        width: 200px;
        height: 200px;
    }
    .vue-dropzone .dz-preview .dz-image:hover img {
        transform: none;
        -webkit-filter: none;
    }
    .vue-dropzone .dz-preview .dz-details {
        bottom: 0;
        top: 0;
        color: white;
        /*: rgba(33, 150, 243, 0.8);*/
        transition: opacity .2s linear;
        text-align: left;
    }
    .vue-dropzone .dz-preview .dz-details .dz-filename {
        overflow: hidden;
    }
    .vue-dropzone .dz-preview .dz-details .dz-filename span,
    .vue-dropzone .dz-preview .dz-details .dz-size span {
        color: #0c0c0c;
        background-color: transparent;
    }
    .vue-dropzone .dz-preview .dz-details .dz-filename:not(:hover) span {
        border: none;
    }
    .vue-dropzone .dz-preview .dz-details .dz-filename:hover span {
        background-color: transparent;
        border: none;
    }
    .vue-dropzone .dz-preview .dz-progress .dz-upload {
        background: #cccccc;
    }
    .vue-dropzone .dz-preview .dz-remove {
        position: relative;
        z-index: 30;
        color: #faf9f3;
        padding: 10px;
        top: inherit;
        border: 2px white solid;
        text-decoration: none;
        text-transform: uppercase;
        background-color: #32c5d2;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 800;
        letter-spacing: 1.1px;
        opacity: 0;
    }
    .vue-dropzone .dz-preview:hover .dz-remove {
        opacity: 1;
    }
    .vue-dropzone .dz-preview .dz-success-mark,
    .vue-dropzone .dz-preview .dz-error-mark {
        margin-left: auto;
        margin-top: auto;
        width: 100%;
        top: 35%;
        left: 0;
    }
    .vue-dropzone .dz-preview .dz-success-mark svg,
    .vue-dropzone .dz-preview .dz-error-mark svg {
        margin-left: auto;
        margin-right: auto;
    }
    .vue-dropzone .dz-preview .dz-error-message {
        top: calc(15%);
        margin-left: auto;
        margin-right: auto;
        left: 0;
        width: 100%;
    }
    .vue-dropzone .dz-preview .dz-error-message:after {
        bottom: -6px;
        top: initial;
        border-top: 6px solid #a92222;
        border-bottom: none;
    }
</style>