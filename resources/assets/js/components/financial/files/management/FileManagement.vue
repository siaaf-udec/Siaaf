<template>
    <div class="row">
        <div class="col-md-6">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-line-chart font-green"></i>
                        <span class="caption-subject font-green bold uppercase" v-text="title"></span>
                        <span class="caption-helper" v-text="subtitle"></span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                        <a href="" @click.prevent="reloadChart" class="reload"> </a>
                    </div>
                </div>
                <div class="portlet-body" style="display: block;">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="highchart_1" style="height:380px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="load-files" class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="icon-bubbles font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase" v-text="comments.title"></span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#portlet_comments_1" @click="getPendingFiles" data-toggle="tab" v-text="comments.pending"></a>
                        </li>
                        <li>
                            <a href="#portlet_comments_2" @click="getApprovedFiles" data-toggle="tab" v-text="comments.approved"></a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_comments_1">
                            <!-- BEGIN: Comments -->
                            <div class="mt-comments">
                                <div class="mt-comment" v-for="file in filesPendingFormat">
                                    <div class="mt-comment-img">
                                        <img :src="file.profile_picture" :alt="file.user" />
                                    </div>
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <span class="mt-comment-author" v-text="file.user"></span>
                                            <span class="mt-comment-date" v-text="file.date"></span>
                                        </div>
                                        <div class="mt-comment-text">
                                            <p v-text="file.file_type"></p>
                                            <p> <i class="fa fa-hashtag"></i> {{ file.id }}</p>
                                        </div>
                                        <div class="mt-comment-details">
                                            <span class="mt-comment-status" :class="file.status_name" v-text="file.status"></span>
                                            <ul class="mt-comment-actions">
                                                <li>
                                                    <a href="javascript:;" @click="viewFile( file )" ><i class="fa fa-comments"></i> {{ file.comments_count }} </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" @click="viewFile( file )" > <i class="fa fa-file-o"></i> {{ view }} </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <pagination :data="filesPending"
                                        :limit="5"
                                        @pagination-change-page="getPendingFiles">
                            </pagination>
                            <!-- END: Comments -->
                        </div>
                        <div class="tab-pane" id="portlet_comments_2">
                            <!-- BEGIN: Comments -->
                            <div class="mt-comments">
                                <div class="mt-comment" v-for="approved in filesApprovedFormat">
                                    <div class="mt-comment-img">
                                        <img :src="approved.profile_picture" :alt="approved.user" />
                                    </div>
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <span class="mt-comment-author" v-text="approved.user"></span>
                                            <span class="mt-comment-date" v-text="approved.date"></span>
                                        </div>
                                        <div class="mt-comment-text">
                                            <p v-text="approved.file_type"></p>
                                            <p> <i class="fa fa-hashtag"></i> {{ approved.id }}</p>
                                        </div>
                                        <div class="mt-comment-details">
                                            <span class="mt-comment-status mt-comment-status-approved" v-text="approved.status"></span>
                                            <ul class="mt-comment-actions">
                                                <li>
                                                    <a href="javascript:;" @click="viewFile( approved )" ><i class="fa fa-comments"></i> {{ approved.comments_count }} </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" @click="viewFile( approved )" > <i class="fa fa-file-o"></i> {{ view }} </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <pagination :data="filesApproved"
                                        :limit="5"
                                        @pagination-change-page="getApprovedFiles">
                            </pagination>
                            <!-- END: Comments -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-show="fileViewer" class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-o font-green"></i>
                        <span class="caption-subject font-green bold uppercase" v-text="title"></span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> {{ buttons.actions }}
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li v-for="state in fileStatus">
                                    <a href="javascript:;" @click.prevent="updateStatus( state )"> {{ state.value }} </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="javascript:;" class="fullscreen"> Fullscreen </a>
                                </li>
                                <li>
                                    <a href="javascript:;" @click="closeView" v-text="buttons.close"> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body" style="display: block;">
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
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import moment from 'moment-with-locales-es6';
    import {mixinHttpStatus} from "../../../../mixins";
    import pagination from 'laravel-vue-pagination';
    import VuePDFViewer from 'vue-instant-pdf-viewer';
    import PNGlib from 'identicon.js/pnglib';
    import Identicon from 'identicon.js/identicon';
    import {mixinLoading} from "../../../../mixins/loadingswal";

    export default {
        name: "file-management",
        mixins: [mixinHttpStatus, mixinLoading],
        components: {
            'vue-pdf-viewer': VuePDFViewer,
            pagination: pagination,
        },
        data: () => {
            return {
                stats: [],
                chart: {
                    categories: [ moment().year() ]
                },
                title: Lang.get('financial.files.management.chart.title'),
                subtitle: Lang.get('financial.files.management.chart.description'),
                comments: {
                    title: Lang.get('javascript.tooltip.comments'),
                    pending: Lang.get('javascript.pending'),
                    approved: Lang.get('javascript.approved'),
                },
                id: null,
                fileViewer: false,
                src: '',
                filesApproved: {
                    current_page: 1,
                    data: [],
                    from: 1,
                    last_page: 1,
                    next_page_url: null,
                    per_page: 10,
                    prev_page_url: null,
                    to: 1,
                    total: 0,
                },
                filesPending: {
                    current_page: 1,
                    data: [],
                    from: 1,
                    last_page: 1,
                    next_page_url: null,
                    per_page: 10,
                    prev_page_url: null,
                    to: 1,
                    total: 0,
                },
                view: Lang.get('financial.buttons.view'),
                buttons: {
                    approve: Lang.get('financial.buttons.approve'),
                    reject: Lang.get('financial.buttons.reject'),
                    actions: Lang.get('financial.buttons.actions'),
                    close: Lang.get('financial.buttons.close'),
                },
                status: [],
            }
        },
        mounted: function () {
            moment.locale( Lang.get('javascript.locale') );
            this.getApprovedFiles();
            this.getPendingFiles();
            this.getStats();
            this.getStatus();
        },
        methods: {
            getStats: function () {
                axios.get( route('financial.api.stats.financial.supply') )
                    .then( (response) => {
                        let that = this;
                        let fill = function () { that.stats = response.data; };
                        (async function createChart () {
                            await fill();
                            await that.initChart();
                        })();
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    })
            },
            initChart: function () {
                let that = this;
                $('#highchart_1').highcharts({
                    chart : {
                        type: 'column',
                        style: {
                            fontFamily: 'Open Sans'
                        }
                    },
                    title: {
                        text: that.title,
                        x: -20 //center
                    },
                    subtitle: {
                        text: that.subtitle,
                        x: -20
                    },
                    xAxis: {
                        categories: that.chart.categories
                    },
                    yAxis: {
                        title: {
                            text: Lang.get('financial.files.management.chart.yaxis'),
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    legend: {
                        layout: 'horizontal',
                        align: 'right',
                        verticalAlign: 'bottom',
                        borderWidth: 0
                    },
                    series: that.statsFormat,

                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    align: 'center',
                                    verticalAlign: 'bottom',
                                    layout: 'horizontal'
                                },
                                yAxis: {
                                    labels: {
                                        align: 'left',
                                        x: 0,
                                        y: -5
                                    },
                                    title: {
                                        text: null
                                    }
                                },
                                subtitle: {
                                    text: null
                                },
                                credits: {
                                    enabled: false
                                }
                            }
                        }]
                    }
                });
            },
            reloadChart: function() {
                this.getStats();
            },
            getApprovedFiles: function ( page ) {
                this.vueLoading( false, '#load-files', 'toggle');
                if (typeof page === 'undefined') {
                    page = 1;
                }
                axios.get( route('financial.api.files.approved.files', { page: page }) )
                    .then( (response) => {
                        let that = this;
                        let fill = function () { that.filesApproved = response.data; };
                        let $stop = function () { that.vueLoading( false, '#load-files', 'toggle'); };
                        (async function createChart () {
                            await fill();
                            await $stop();
                        })();
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    });
            },
            getPendingFiles: function ( page ) {
                this.vueLoading( false, '#load-files', 'toggle');
                if (typeof page === 'undefined') {
                    page = 1;
                }
                axios.get( route('financial.api.files.pending.files', { page: page }) )
                    .then( (response) => {
                        let that = this;
                        let fill = function () { that.filesPending = response.data; };
                        let $stop = function () { that.vueLoading( false, '#load-files', 'toggle'); };
                        (async function createChart () {
                            await fill();
                            await $stop();
                        })();
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    });
            },
            viewFile: function ( file ) {
                this.id = file.id;
                this.src = file.file_route;
                this.fileViewer = true;
            },
            closeView: function () {
                this.id = null;
                this.src = '';
                this.fileViewer = false;
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
                        that.getStats();
                        that.getApprovedFiles();
                        that.getPendingFiles();
                        swal(Lang.get('javascript.success'), Lang.get('javascript.updated_done'), "success");
                    }
                }).catch(swal.noop);
            }
        },
        computed: {
            statsFormat: function () {
                return this.stats.map( (stat) => {
                    return {
                        name: stat.file_types || Lang.get('financial.generic.empty'),
                        data: [ stat.files_count ],
                    }
                });
            },
            filesApprovedFormat: function () {
                return this.filesApproved.data.map( (file) => {
                    return {
                        id: file.pk_id || 0,
                        comments_count: Lang.choice('javascript.comments', file.comments_count, {num: file.comments_count}),
                        file_name: Lang.get('javascript.file', {file: file.file_name}) || Lang.get('financial.generic.empty'),
                        file_route: file.pdf_url || 'javascript:;',
                        date: moment( file.created_at ).format('DD MMM YYYY, h:mm A') ,
                        semester: file.semester || Lang.get('financial.generic.empty'),
                        status: ( file.status ) ? file.status.status_name : Lang.get('financial.generic.empty'),
                        file_type: ( file.file_type ) ? file.file_type.file_types : Lang.get('financial.generic.empty'),
                        user: ( file.user ) ? file.user.full_name : Lang.get('financial.generic.empty'),
                        profile_picture: ( file.user ) ? ( file.user.profile_picture.length === 16 ) ? `data:image/png;base64,${new Identicon( file.user.profile_picture , 45).toString()}` : file.user.profile_picture : `data:image/png;base64,${new Identicon( 'c157a79031e1c40f85931829bc5fc552' , 45).toString()}`,
                    }
                });
            },
            filesPendingFormat: function () {
                return this.filesPending.data.map( (file) => {
                    return {
                        id: file.pk_id || 0,
                        comments_count: Lang.choice('javascript.comments', file.comments_count, {num: file.comments_count}),
                        file_name: Lang.get('javascript.file', {file: file.file_name}) || Lang.get('financial.generic.empty'),
                        file_route: file.pdf_url || 'javascript:;',
                        date: moment( file.created_at ).format('DD MMM YYYY, h:mm A') ,
                        semester: file.semester || Lang.get('financial.generic.empty'),
                        status: ( file.status ) ? file.status.status_name : Lang.get('javascript.pending'),
                        status_name:  ( file.status ) ? (file.status.status_name === 'RECHAZADO') ? 'mt-comment-status-rejected' : 'mt-comment-status-pending' : 'mt-comment-status-pending',
                        file_type: ( file.file_type ) ? file.file_type.file_types : Lang.get('financial.generic.empty'),
                        user: ( file.user ) ? file.user.full_name : Lang.get('financial.generic.empty'),
                        profile_picture: ( file.user ) ? ( file.user.profile_picture.length === 16 ) ? `data:image/png;base64,${new Identicon( file.user.profile_picture , 45).toString()}` : file.user.profile_picture : `data:image/png;base64,${new Identicon( 'c157a79031e1c40f85931829bc5fc552' , 45).toString()}`,
                    }
                });
            },
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