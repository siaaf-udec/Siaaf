<template>
    <div class="row">
        <div class="col-md-12">
            <div class="blog-page blog-content-2">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-single-content bordered blog-container">
                            <div class="blog-single-head">
                                <h1 class="blog-single-head-title" v-text="source.subject_name"></h1>
                                <div class="blog-single-head-date">
                                    <i class="fa fa-cog font-blue"></i>
                                    <a href="javascript:;" v-text="source.status_name"></a>
                                </div>
                            </div>
                            <div class="blog-single-desc">

                                <div class="row number-stats margin-bottom-30">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-left">
                                            <div class="stat-chart">
                                                <input class="knob" id="stat-subs" readonly="readonly" data-angleoffset=-125 data-anglearc=250 data-fgcolor="#66EE66" :value="source.subscribed_count">
                                            </div>
                                            <div class="stat-number">
                                                <div class="title" v-text="stats.subs"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="stat-right">
                                            <div class="stat-chart">
                                                <input class="knob" id="stat-paid" readonly="readonly" data-angleoffset=-125 data-anglearc=250 data-fgcolor="#66EE66" :value="source.subscribed_paid_count">
                                            </div>
                                            <div class="stat-number">
                                                <div class="title" v-text="stats.paid"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light dt-responsive" width="100%" id="table-show">
                                        <thead>
                                            <tr>
                                                <th  v-for="column in table.columns" :class="column.class" v-text="column.name"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td v-text="source.intersemestral_id"></td>
                                                <td v-text="source.subject_code"></td>
                                                <td v-text="source.subject_name"></td>
                                                <td v-text="source.subject_credits"></td>
                                                <td v-text="source.program_name"></td>
                                                <td v-text="source.total_cost"></td>
                                                <td v-html="source.status_label"></td>
                                                <td v-text="source.cost"></td>
                                                <td v-text="source.teacher_name"></td>
                                                <td>
                                                    <a :href="`tel:${source.teacher_phone}`">
                                                        <span class="label label-sm label-success">
                                                            <i class="fa fa-phone"></i> {{ source.teacher_phone }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a :href="`mailto:${source.teacher_email}`">
                                                        <span class="label label-sm label-success">
                                                            <i class="fa fa-envelope-o"></i> {{ source.teacher_email }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td v-text="source.approval_date"></td>
                                                <td v-text="source.secretary_name"></td>
                                                <td>
                                                    <a :href="`tel:${source.secretary_phone}`">
                                                        <span class="label label-sm label-success">
                                                            <i class="fa fa-phone"></i> {{ source.secretary_phone }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a :href="`mailto:${source.secretary_email}`">
                                                        <span class="label label-sm label-success">
                                                            <i class="fa fa-envelope-o"></i> {{ source.secretary_email }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td v-text="source.realization_date"></td>

                                                <td v-text="source.created_at"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light" width="100%">
                                        <thead>
                                            <tr class="uppercase">
                                                <th colspan="2" v-text="list.columns[0].name"></th>
                                                <th v-text="list.columns[1].name"></th>
                                                <th v-text="list.columns[2].name"></th>
                                                <th v-text="list.columns[3].name"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="student in source.subscribed">
                                                <td class="fit">
                                                    <img class="user-pic rounded" :alt="student.student_name" :src="getSrc( student.student_picture )">
                                                </td>
                                                <td v-text="student.student_name"></td>
                                                <td>
                                                    <a :href="`tel:${student.student_phone}`">
                                                            <span class="label label-sm label-success">
                                                                <i class="fa fa-phone"></i> {{ student.student_phone }}
                                                            </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a :href="`mailto:${student.student_email}`">
                                                            <span class="label label-sm label-success">
                                                                <i class="fa fa-envelope-o"></i> {{ student.student_email }}
                                                            </span>
                                                    </a>
                                                </td>
                                                <td v-html="student.paid_label"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Edit and destroy form -->
                            <div class="blog-single-foot">
                                <ul class="blog-post-tags">
                                    <li class="uppercase">
                                        <a href="javascript:;"
                                           class="tooltips red-thunderbird"
                                           @click.prevent="subscribeIntersemestral"
                                           :data-original-title="subscribe" v-text="subscribe"></a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Comments -->
                            <vue-blog-comments :id="comment"
                                               get="financial.api.intersemestral.comments.index"
                                               send="financial.api.intersemestral.comments.store">
                            </vue-blog-comments>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-single-sidebar bordered blog-container">
                            <div class="blog-single-sidebar-search">
                                <h4 class="font-blue" v-text="date.text"></h4>
                                <div class="date-picker" data-date-format="mm/dd/yyyy"
                                     :data-date="source.realization_date"
                                     :data-date-start-date="source.realization_date"
                                     :data-date-end-date="source.realization_date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import PNGlib from 'identicon.js/pnglib';
    import Identicon from 'identicon.js/identicon';
    import {mixinProfilePic} from "../../../../../mixins/picture";
    import {mixinHttpStatus} from "../../../../../mixins";
    import {mixinDataTableNoAjax} from "../../../../../mixins/datatable";
    import {mixinTootilps} from "../../../../../mixins/tooltip";
    import moment from 'moment-with-locales-es6';
    import {mixinMomentLocale} from "../../../../../mixins/moment";

    export default {
        name: "student-intersemestral-request-show",
        mixins: [mixinHttpStatus, mixinDataTableNoAjax, mixinTootilps, mixinMomentLocale, mixinProfilePic],
        data: () => {
            return {
                subscribe: Lang.get('financial.buttons.subscribe'),
                stats: {
                    subs: Lang.get('financial.generic.table.subscribed'),
                    paid: Lang.get('financial.generic.table.paid_bar'),
                },
                title: Lang.get('financial.intersemestral.show.title'),
                date: {
                    text: Lang.get('financial.generic.table.realization_date'),
                },
                comment: 0,
                table: {
                    columns: [
                        { name: Lang.get('financial.generic.table.id'), class: '' },
                        { name: Lang.get('financial.generic.table.subject_code'), class: '' },
                        { name: Lang.get('financial.generic.table.subject_name'), class: '' },
                        { name: Lang.get('financial.generic.table.subject_credits'), class: '' },
                        { name: Lang.get('financial.generic.table.program_name'), class: '' },
                        { name: Lang.get('financial.generic.table.total_cost'), class: '' },
                        { name: Lang.get('financial.generic.table.status_name'), class: '' },
                        { name: Lang.get('financial.generic.table.cost'), class: 'none' },
                        { name: Lang.get('financial.generic.table.teacher_name'), class: 'none' },
                        { name: Lang.get('financial.generic.table.phone'), class: 'none' },
                        { name: Lang.get('financial.generic.table.email'), class: 'none' },
                        { name: Lang.get('financial.generic.table.approval_date'), class: '' },
                        { name: Lang.get('financial.generic.table.secretary_name'), class: '' },
                        { name: Lang.get('financial.generic.table.phone'), class: 'none' },
                        { name: Lang.get('financial.generic.table.email'), class: 'none' },
                        { name: Lang.get('financial.generic.table.realization_date'), class: '' },
                        { name: Lang.get('financial.generic.table.created_at'), class: 'none' },
                    ],
                },
                list: {
                    columns: [
                        { name: Lang.get('financial.generic.table.student_name'), class: '' },
                        { name: Lang.get('financial.generic.table.phone'), class: '' },
                        { name: Lang.get('financial.generic.table.email'), class: '' },
                        { name: Lang.get('financial.generic.table.paid'), class: '' },
                    ],
                },
                source: {}
            }
        },
        mounted: function () {
            this.comment = $('#app').data('source');
            this.getSources();
        },
        methods: {
            getSources: function () {
                axios.get( route('financial.api.intersemestral.admin', { id: $('#app').data('source') }) )
                    .then( (response) => {
                        this.source = response.data;
                    })
                    .then( () => {
                        this.initTable();
                    })
                    .then( () => {
                        this.initDatePicker();
                    })
                    .then( () => {
                        this.initStats();
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    })
            },
            initTable: function () {
                $('#table-show').DataTable();
            },
            initDatePicker: function () {
                let that = this;
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    language: Lang.get("javascript.locale"),
                    daysOfWeekDisabled: [0],
                    defaultTime: !0,
                    todayBtn: !0,
                    todayHighlight: !0,
                    enableOnReadonly: !0,
                    setDate: ( that.source.realization_date ) ? moment( that.source.realization_date ).format('MM/DD/YYYY') : moment().format('MM/DD/YYYY'),
                });
            },
            initStats: function () {
                let that = this;
                let color = {
                    danger: '#E43A45',
                    warning: '#F3C200',
                    success: '#26C281',
                };
                let subscriber = (this.source.subscribed_count * 100 ) / this.source.min_subscribed;
                let paid = (this.source.subscribed_paid_count * 100 ) / this.source.min_paid;
                let fgSub = color.danger;
                let fgPaid = color.danger;

                if ( subscriber >= 70 && subscriber < 80 ) { fgSub = color.warning; }
                if ( subscriber > 80 ) { fgSub = color.success; }
                if ( paid > 70 && subscriber < 80 ) { fgPaid = color.warning; }
                if ( paid > 80 ) { fgPaid = color.success; }

                $("#stat-subs").knob({
                    'dynamicDraw': true,
                    'thickness': 0.2,
                    'tickColorizeValues': true,
                    'skin': 'tron',
                    width: '100px',
                    height: '100px',
                    'min': 0,
                    'max': that.source.min_subscribed,
                    readOnly: true,
                    fgColor: fgSub
                });

                $("#stat-paid").knob({
                    'dynamicDraw': true,
                    'thickness': 0.2,
                    'tickColorizeValues': true,
                    'skin': 'tron',
                    width: '100px',
                    height: '100px',
                    'min': 0,
                    'max': that.source.min_paid,
                    readOnly: true,
                    fgColor: fgPaid
                });
            },
            subscribeIntersemestral: function() {
                let that = this;
                swal({
                    title: Lang.get('javascript.warning'),
                    text: Lang.get('javascript.ask_if_subscribe'),
                    type: "question",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger ladda-button",
                    confirmButtonText: Lang.get('financial.buttons.yes'),
                    cancelButtonText: Lang.get('financial.buttons.cancel'),
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return new Promise(( resolve ) => {
                            axios.put( route('financial.requests.student.intersemestral.update', {id: $('#app').data('source') }) )
                                .then( (response) => {
                                    resolve();
                                })
                                .catch( (error) => {
                                    that.triggerSwal( error );
                                })
                        });
                    },
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.value) {
                        swal({
                            title: Lang.get('javascript.success'),
                            text: Lang.get('javascript.subscribe_done'),
                            type: "success",
                            showCancelButton: false,
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = route('financial.requests.student.intersemestral.index');
                            }
                        });
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>