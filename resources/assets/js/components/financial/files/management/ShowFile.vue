<template>
    <div class="row">
        <div class="col-md-12">
            <portlet icon="fa fa-file-o" :title="portlet.title">
                <template slot="actions">
                    <div class="btn-group">
                        <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> {{ buttons.actions }}
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li v-for="state in fileStatus">
                                <a href="javascript:;" @click.prevent="updateStatus( state )"> {{ state.value }} </a>
                            </li>
                        </ul>
                    </div>
                    <a class="btn blue btn-outline btn-circle btn-sm" href="#modal-log" data-toggle="modal">
                        Log de Cambios
                    </a>
                </template>
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th v-text="portlet.table.name"></th>
                                    <th v-text="portlet.table.status"></th>
                                    <th>Usuario</th>
                                    <th v-text="portlet.table.request_type"></th>
                                    <th v-text="portlet.table.semester"></th>
                                    <th v-text="portlet.table.created_at"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td v-text="file.id"></td>
                                    <td v-text="file.name"></td>
                                    <td v-text="file.status"></td>
                                    <td v-text="file.user"></td>
                                    <td v-text="file.type"></td>
                                    <td v-text="file.semester"></td>
                                    <td v-text="file.created"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
                        <div class="col-md-12">
                            <laravel-audits :metadata="file.audits"></laravel-audits>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-12"><empty-sortable-portlet></empty-sortable-portlet></div>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import moment from 'moment-with-locales-es6';
    import VuePDFViewer from 'vue-instant-pdf-viewer';
    import {mixinHttpStatus} from "../../../../mixins";

    export default {
        name: "file-upload-show-admin",
        mixins: [mixinHttpStatus],
        components: {
            'vue-pdf-viewer': VuePDFViewer
        },
        data: () => {
            return {
                portlet: {
                    title: Lang.get('financial.files.show.title'),
                    table: {
                        id: '#',
                        name: Lang.get('financial.files.show.table.name'),
                        created_at: Lang.get('financial.files.show.table.created_at'),
                        semester: Lang.get('financial.files.show.table.semester'),
                        status: Lang.get('financial.files.show.table.status'),
                        request_type: Lang.get('financial.files.show.table.request_type'),
                    }
                },
                file: {
                    id: null,
                    name: null,
                    route: null,
                    status: null,
                    type: null,
                    type_id: null,
                    created: null,
                    semester: null,
                    audits: [],
                    user: null
                },
                id: null,
                src: '',
                status: [],
                buttons: {
                    approve: Lang.get('financial.buttons.approve'),
                    reject: Lang.get('financial.buttons.reject'),
                    actions: Lang.get('financial.buttons.actions'),
                    close: Lang.get('financial.buttons.close'),
                },
            }
        },
        mounted: function () {
            moment.locale( Lang.get('javascript.locale') );
            this.getData();
            this.getStatus();
        },
        methods: {
            getData: function () {
                axios.get( route('financial.api.files.show.auth', { id: $('#app').data('id') }) )
                    .then( ( response ) => {
                        if ( typeof response.data !== 'undefined' || response.data !== '') {
                            let data = response.data;
                            this.src = ( data.pdf_url ) ? data.pdf_url : '';
                            this.id = ( data.pk_id ) ? data.pk_id : null;
                            this.file = {
                                id: data.pk_id,
                                name: data.file_name,
                                semester: data.semester,
                                type_id: data.file_type_fk,
                                route: data.pdf_url,
                                created: (data.created_at) ? moment( data.created_at ).format('ll') : Lang.get('financial.generic.empty'),
                                status: (data.status) ? data.status.status_name : Lang.get('financial.generic.empty'),
                                type: (data.status) ? data.file_type.file_types : Lang.get('financial.generic.empty'),
                                audits: data.is_dirty.data || [],
                                user: data.user.full_name || Lang.get('financial.generic.empty'),
                            }
                        }
                    })
                    .catch( ( error ) => {
                        this.triggerSwal( error );
                    });
            },
            getStatus: function () {
                axios.get( route('financial.api.options.file.status.options') )
                    .then( (response) => {
                        this.status = response.data;
                    })
                    .catch((error) => {
                        this.triggerSwal( error );
                    });
            },
            updateStatus: function (status) {
                let that = this, ask = 'ask_if_approve';
                if ( status.value  === 'APROBADO' ){
                    ask = 'ask_if_approve';
                }
                if ( status.value  === 'RECHAZADO' ){
                    ask = 'ask_if_reject';
                }
                if ( status.value  === 'EN REVISIÓN' ){
                    ask = 'in_review';
                }
                swal({
                    title: Lang.get('javascript.' + ask),
                    allowOutsideClick: () => !swal.isLoading(),
                    preConfirm: () => {
                        return new Promise((resolve) => {
                            axios.patch( route('financial.files.request.update', { id: that.id }), qs.stringify( { status: status.id } ) )
                                .then(function(response) {
                                    resolve();
                                })
                                .catch(function (error) {
                                    that.triggerSwal( error );
                                });
                        })
                    },
                    showLoaderOnConfirm: true,
                }).then( (result) => {
                    if ( result.value ) {
                        that.getData();
                        swal(Lang.get('javascript.success'), Lang.get('javascript.updated_done'), "success");
                    }
                }).catch(swal.noop);
            }
        },
        computed: {
            fileStatus: function () {
                return this.status.map( (value) => {
                    return {
                        id: value.pk_id,
                        value: value.status_name,
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>