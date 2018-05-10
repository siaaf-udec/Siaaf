<template>
    <div class="row">
        <div class="col-md-12">
            <div class="todo-ui">
                <div class="todo-sidebar">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
                                <span class="caption-subject font-green-sharp bold uppercase" v-text="captions.helper"></span>
                                <span class="caption-helper visible-sm-inline-block visible-xs-inline-block"></span>
                            </div>
                        </div>
                        <div class="portlet-body todo-project-list-content">
                            <div class="todo-project-list">
                                <ul class="nav nav-stacked">
                                    <li v-for="badge in badges" :id="badge.id" class="badge-sidebar" @click="setActive( badge.id )">
                                        <a href="javascript:">
                                            <span class="badge" :class="badge.class" v-text="badge.count"></span>
                                            {{ badge.text }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="todo-content">
                    <div class="portlet light ">
                        <!-- PROJECT HEAD -->
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bar-chart font-green-sharp hide"></i>
                                <span class="caption-helper" v-text="captions.helper"></span> &nbsp;
                                <span class="caption-subject font-green-sharp bold uppercase" v-text="captions.subject"></span>
                            </div>
                        </div>
                        <!-- end PROJECT HEAD -->
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="todo-tasklist" id="task-list">

                                        <div class="todo-tasklist-item todo-tasklist-item-border-green" data-target="#modal-detail" data-toggle="modal" v-for="task in taskList" :id="task.id" @click="viewData( task )">
                                            <img class="todo-userpic pull-left hash-avatar"  :src="setIcon( task.teacher_picture )" width="27px" height="27px">
                                            <div class="todo-tasklist-item-title" v-text="task.subject_name"></div>
                                            <div class="todo-tasklist-item-text"> <small v-text="task.subject_code"></small> </div>
                                            <div class="todo-tasklist-item-text"> <small v-text="task.teacher_name"></small> </div>
                                            <div class="todo-tasklist-item-text"> <small v-text="task.program_name"></small> </div>
                                            <div class="todo-tasklist-controls pull-left">
                                                <span class="todo-tasklist-date">
                                                    <small> <i class="fa fa-calendar"></i> {{ task.created_at }} </small>
                                                </span>
                                                <span class="todo-tasklist-date">
                                                    <small> <i class="fa fa-comments"></i> {{ task.comments_count }} </small>
                                                </span>
                                                <span class="todo-tasklist-date">
                                                    <small> <i class="fa fa-user"></i> {{ task.subscribed_count }} </small>
                                                </span>
                                                <span class="todo-tasklist-date">
                                                    <small> <i class="fa fa-money"></i> {{ task.subscribed_paid_count }} </small>
                                                </span>
                                                <span class="todo-tasklist-badge badge badge-roundless" v-text="task.status_name"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <pagination :data="sources"
                                                :limit="5"
                                                @pagination-change-page="getSource">
                                    </pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END TODO CONTENT -->
            </div>
        </div>

        <!-- Modal -->
        <div id="modal-detail" class="modal container fade" tabindex="-1">
            <div class="modal-header">
                <button @click="closeData" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" v-text="captions.subject"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-page blog-content-2">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="blog-single-content bordered blog-container">
                                        <div class="blog-single-head">
                                            <h1 class="blog-single-head-title" v-text="modal.source.subject_name"></h1>
                                            <div class="blog-single-head-date">
                                                <i class="fa fa-cog font-blue"></i>
                                                <a href="javascript:" v-text="modal.source.status_name"></a>
                                            </div>
                                        </div>
                                        <div class="blog-single-desc">

                                            <div class="row number-stats margin-bottom-30">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-left">
                                                        <div class="stat-chart">
                                                            <input class="knob" id="stat-subs" readonly="readonly" data-angleoffset=-125 data-anglearc=250 data-fgcolor="#66EE66" :value="modal.source.subscribed_count">
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title" v-text="modal.stats.subs"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            <input class="knob" id="stat-paid" readonly="readonly" data-angleoffset=-125 data-anglearc=250 data-fgcolor="#66EE66" :value="modal.source.subscribed_paid_count">
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title" v-text="modal.stats.paid"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light dt-responsive" width="100%" id="table-show">
                                                    <thead>
                                                    <tr>
                                                        <th  v-for="column in modal.table.columns" :class="column.class" v-text="column.name"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td v-text="modal.source.id"></td>
                                                        <td v-text="modal.source.subject_code"></td>
                                                        <td v-text="modal.source.subject_name"></td>
                                                        <td v-text="modal.source.subject_credits"></td>
                                                        <td v-text="modal.source.program_name"></td>
                                                        <td v-text="modal.source.total_cost"></td>
                                                        <td v-html="modal.source.status_label"></td>
                                                        <td v-text="modal.source.cost"></td>
                                                        <td v-text="modal.source.teacher_name"></td>
                                                        <td>
                                                            <a :href="`tel:${modal.source.teacher_phone}`">
                                                        <span class="label label-sm label-success">
                                                            <i class="fa fa-phone"></i> {{ modal.source.teacher_phone }}
                                                        </span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a :href="`mailto:${modal.source.teacher_email}`">
                                                        <span class="label label-sm label-success">
                                                            <i class="fa fa-envelope-o"></i> {{ modal.source.teacher_email }}
                                                        </span>
                                                            </a>
                                                        </td>
                                                        <td v-text="modal.source.approval_date"></td>
                                                        <td v-text="modal.source.secretary_name"></td>
                                                        <td>
                                                            <a :href="`tel:${modal.source.secretary_phone}`">
                                                        <span class="label label-sm label-success">
                                                            <i class="fa fa-phone"></i> {{ modal.source.secretary_phone }}
                                                        </span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a :href="`mailto:${modal.source.secretary_email}`">
                                                        <span class="label label-sm label-success">
                                                            <i class="fa fa-envelope-o"></i> {{ modal.source.secretary_email }}
                                                        </span>
                                                            </a>
                                                        </td>
                                                        <td v-text="modal.source.realization_date"></td>

                                                        <td v-text="modal.source.created_at"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light" width="100%">
                                                    <thead>
                                                    <tr class="uppercase">
                                                        <th colspan="2" v-text="modal.list.columns[0].name"></th>
                                                        <th v-text="modal.list.columns[1].name"></th>
                                                        <th v-text="modal.list.columns[2].name"></th>
                                                        <th v-text="modal.list.columns[3].name"></th>
                                                        <th v-text="modal.list.columns[4].name"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="student in modal.source.subscribed">
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
                                                        <td >
                                                            <button class="btn btn-warning tooltips"
                                                                    @click.prevent="openStack( student )"
                                                                    data-container="body"
                                                                    data-placement="top" :data-original-title="modal.stack.tooltip">
                                                                <i class="fa fa-money"></i> {{ modal.stack.btnPaid }}
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Comments -->
                                        <vue-blog-comments :id="modal.comment"
                                                           get="financial.api.intersemestral.comments.index"
                                                           send="financial.api.intersemestral.comments.store">
                                        </vue-blog-comments>

                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="blog-single-sidebar bordered blog-container">
                                        <div class="blog-single-sidebar-search">
                                            <h4 class="font-blue" v-text="modal.date.text"></h4>
                                            <div class="date-picker" data-date-format="mm/dd/yyyy"
                                                 :data-date="modal.source.realization_date"
                                                 :data-date-start-date="modal.source.realization_date"
                                                 :data-date-end-date="modal.source.realization_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-single-sidebar bordered blog-container">
                                        <form @submit.prevent="sendStatus" id="approval-form" :action="patch" method="put" class="form-horizontal">
                                            <!-- TASK DUE DATE -->
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="input-icon">
                                                        <i class="fa fa-calendar"></i>
                                                        <input type="text" :required="required" readonly="readonly"
                                                               minlength="10"
                                                               maxlength="10"
                                                               name="date"
                                                               id="date"
                                                               pattern="\d{4}-\d{2}-\d{2}"
                                                               autocomplete="off"
                                                               class="form-control datepicker date date-picker todo-taskbody-due"
                                                               :placeholder="table.realization_date"
                                                               v-model.trim="realization_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- TASK TAGS -->
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <select name="status" required="required" class="form-control todo-taskbody-tags" v-model.number="status.value">
                                                        <option value="" v-text="status.option"></option>
                                                        <option v-for="opt in status.options" :value="opt.id" v-text="opt.text"></option>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <!-- TASK TAGS -->
                                            <div class="form-actions right todo-form-actions">
                                                <input type="submit" class="btn btn-circle btn-sm green" :value="captions.save" />
                                                <a href="javascript:" class="btn btn-circle btn-sm btn-default" @click="closeData" v-text="captions.cancel"></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" @click="closeData" data-dismiss="modal" class="btn btn-outline dark" v-text="modal.stack.btnOk"></button>
            </div>
        </div>
        <!-- Modal Stack -->
        <div id="stack2" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-focus-on="input:first">
            <div class="modal-header">
                <h4 class="modal-title" v-text="modal.loading"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group" v-if="modal.errors">
                    <hr>
                    <vue-alert :type="modal.errors.alertClass"
                               :dismiss="false"
                               :heading="modal.errors.title"
                               :icon="modal.errors.icon"
                               :text="modal.errors.text"
                               :status="modal.errors.status"
                               :errors="modal.errors.errors">
                    </vue-alert>
                </div>
            </div>
            <div class="modal-footer" v-if="modal.errors">
                <button type="button" data-dismiss="modal" @click.prevent="modal.errors = null" class="btn green" v-text="modal.stack.btnOk"></button>
            </div>
        </div>

        <div id="stack3" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" data-focus-on="input:first">
            <div class="modal-header">
                <h4 class="modal-title" v-text="modal.stack.title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p v-text="modal.stack.text"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" @click.prevent="setPaid"  class="btn green" v-text="modal.stack.btnYes"></button>
                <button type="button" @click.prevent="unsetPaid" data-dismiss="modal" class="btn red" v-text="modal.stack.btnCancel"></button>
            </div>
        </div>

    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import moment from 'moment-with-locales-es6'
    import PNGlib from 'identicon.js/pnglib';
    import Identicon from 'identicon.js/identicon';
    import {mixinHttpStatus} from "../../../mixins";
    import {mixinLoading} from "../../../mixins/loadingswal";
    import {mixinMomentLocale} from "../../../mixins/moment";
    import {mixinProfilePic} from "../../../mixins/picture";
    import {mixinDate} from "../../../mixins/datepicker";
    import {mixinSelect2} from "../../../mixins/select2";
    import {mixinValidator} from "../../../mixins/validation";
    import {mixinDataTableNoAjax} from "../../../mixins/datatable";
    import {mixinTootilps} from "../../../mixins/tooltip";

    import pagination from "laravel-vue-pagination"
    export default {
        name: "approval-index-intersemestral",
        mixins: [mixinHttpStatus, mixinDataTableNoAjax, mixinTootilps, mixinLoading, mixinMomentLocale, mixinProfilePic, mixinDate, mixinSelect2, mixinValidator],
        components: {
            pagination: pagination,
        },
        data: () => {
            return {
                modal: {
                    stack: {
                        title: Lang.get('javascript.warning'),
                        text: Lang.get('javascript.ask_if_update'),
                        btnYes: Lang.get('financial.buttons.yes'),
                        btnOk: Lang.get('financial.buttons.ok'),
                        tooltip: Lang.get('javascript.tootltip.paid'),
                        btnCancel: Lang.get('financial.buttons.cancel'),
                        btnPaid: Lang.get('financial.buttons.paid')
                    },
                    loading: Lang.get('validation.attributes.status').capitalize(),
                    errors: null,
                    stats: {
                        subs: Lang.get('financial.generic.table.subscribed'),
                        paid: Lang.get('financial.generic.table.paid_bar'),
                    },
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
                            { name: Lang.get('financial.generic.table.actions'), class: '' },
                        ],
                    },
                    source: {}
                },
                captions: {
                    helper: Lang.get('financial.generic.requests'),
                    subject: Lang.get('validation.attributes.intersemester').capitalize(),
                    save: Lang.get('financial.buttons.save'),
                    cancel: Lang.get('financial.buttons.cancel'),
                },
                badges: [],
                table: {
                    realization_date: Lang.get('financial.extension.table.realization_date'),
                },
                sources: {
                    current_page: 0,
                    data: [],
                    from: 0,
                    last_page: 0,
                    next_page_url: null,
                    per_page: 0,
                    prev_page_url: null,
                    to: 0,
                    total: 0,
                },
                view: null,
                status: {
                    value: null,
                    option: Lang.get('javascript.select'),
                    label: Lang.get('validation.attributes.status').capitalize(),
                    options: []
                },
                filter_query: null,
                patch: '',
                realization_date: null,
                paid: false,
                student: null,
                required: false,
            }
        },
        mounted: function () {
            this.getBadges();
            this.getSource();
            this.getOptions();
            this.handleProjectListMenu();
        },
        methods: {
            initFormValidation: function() {
                $('#approval-form').validate({
                    rules: {
                        date: {
                            date: true
                        },
                        status: {
                            required: true,
                        }
                    }
                });
            },
            initDatePickerAndSelect2: function () {
                let that = this;
                $('.date-picker').datepicker({
                    format: 'yyyy-mm-dd',
                }).on('changeDate', function () {
                    that.realization_date = this.value;
                });
                $('.todo-taskbody-tags')
                    .select2({placeholder: that.status.option})
                    .on('change', function () {
                        that.status.value = this.value;
                    });
            },
            handleProjectListMenu: function() {
                if (App.getViewPort().width <= 992) {
                    $('.todo-project-list-content').addClass("collapse");
                } else {
                    $('.todo-project-list-content').removeClass("collapse").css("height", "auto");
                }
            },
            getBadges: function () {
                axios.get( route('financial.api.approval.sidebar.intersemestral') )
                    .then( (response) => {
                        this.badges = response.data;
                    })
                    .then(() => {
                        $('li.badge-sidebar').first().addClass('active');
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    })
            },
            setActive: function ( element ) {
                this.filter_query = element;
                let li = $('li.badge-sidebar');
                li.removeClass( 'active' );
                if ( element === null ) {
                    li.first().addClass('active');
                } else {
                    $('li#' + element).addClass('active');
                }
            },
            getSource: function ( page ) {
                this.vueLoading( false, '#task-list', 'toggle');
                let query = {};
                if (typeof page === 'undefined') {
                    page = 1;
                }
                query = { page: page };
                if ( this.filter_query !== null ) {
                    query = {
                        status: this.filter_query,
                        page: page,
                    };
                }
                axios.get( route('financial.api.approval.intersemestral', query ) )
                    .then( (response) => {
                        this.sources = response.data;
                    })
                    .then( () => {
                        this.vueLoading( false, '#task-list', 'toggle');
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    })
            },
            getOptions: function () {
                axios.get( route('financial.api.tree.status-request', {type: 'intersemester'}) )
                    .then( (response) => {
                        this.status.options = response.data.children;
                    })
                    .catch( (error) => {
                        this.triggerSwal(error);
                    });
            },
            viewData: function ( data ) {
                this.view = data;
                this.modal.comment = data.id;
                this.patch = route('financial.admin.approval.intersemestral.update', { id: data.id });

                axios.get( route('financial.api.intersemestral.admin', { id: data.id } ) )
                    .then( (response) => {
                        this.modal.source = response.data;
                    })
                    .then( () => {
                        this.initTable();
                    })
                    .then( () => {
                        this.initStats();
                    })
                    .then( () => {
                        this.handleTooltips();
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    });
            },
            initTable: function () {
                $('#table-show').DataTable();
            },
            initStats: function () {
                let that = this;
                let color = {
                    danger: '#E43A45',
                    warning: '#F3C200',
                    success: '#26C281',
                };
                let subscriber = (this.modal.source.subscribed_count * 100 ) / this.modal.source.min_subscribed;
                let paid = (this.modal.source.subscribed_paid_count * 100 ) / this.modal.source.min_paid;
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
                    'max': that.modal.source.min_subscribed,
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
                    'max': that.modal.source.min_paid,
                    readOnly: true,
                    fgColor: fgPaid
                });
            },
            closeData: function () {
                this.view = null;
                this.realization_date = null;
                this.patch = '';
                this.status.value = null;
                $('.date-picker').datepicker('destroy');
            },
            setIcon: function ( image ) {
                return this.getSrc( image );
            },
            sendStatus: function () {
                let that = this;

                if ( !that.required )  {
                    that.realization_date = moment().format('YYYY-MM-DD');
                }

                if ( $('#approval-form').valid() ) {

                    $('#stack2').modal('show');

                    axios.patch( that.patch , {date: that.realization_date, status: that.status.value} )
                        .then(( response ) => {
                            this.modal.errors = this.httpStatus( response );
                        })
                        .then(() => {
                            this.getBadges();
                            this.getSource();
                            this.realization_date = null;
                            this.status.value = null;
                        })
                        .catch(function (error) {
                            this.modal.errors = this.httpStatus( error );
                        });
                }
            },
            openStack: function( student ) {
                this.student = student;
                $('#stack3').modal('toggle');
            },
            unsetPaid: function() {
                this.student = null;
                $('#stack3').modal('hide');
            },
            setPaid: function () {
                let paid = qs.stringify({
                   id:  this.student.id,
                   paid:  ( !this.student.paid ) ? 1 : 0,
                });
                    $('#stack2').modal('show');

                axios.post( route('financial.admin.approval.intersemestral.store'), paid )
                    .then(( response ) => {
                        this.modal.errors = this.httpStatus( response );
                    })
                    .then(() => {
                        $('#stack3').modal('hide');
                        this.viewData( this.view );
                    })
                    .then(() => {
                        this.getBadges();
                        this.getSource();
                        this.realization_date = null;
                        this.status.value = null;
                        this.student = null;
                    })
                    .catch((error) => {
                        this.modal.errors = this.httpStatus( error );
                    });
            }
        },
        updated: function () {
            this.$nextTick(function () {
                this.initDatePickerAndSelect2();
                this.initFormValidation();
            })
        },
        watch: {
            filter_query: function ( status ) {
                this.getSource();
                this.setActive( status );
            },
            status: function ( status ) {
                let data = $('#status').select2('data');
                data = ( data ) ? data[0].text : null;
                this.required = ( data === 'APROBADO' );
                $('.todo-taskbody-tags').select2().val(status).trigger('change')
            }
        },
        computed: {
            taskList: function() {
                return this.sources.data.map( (source) => {
                    return {
                        id: source.id,
                        created_at: (source.created_at) ? moment( source.created_at ).format('ll') : null,
                        subject_code: source.subject_code,
                        subject_name: source.subject_name,
                        program_name: source.program_name,
                        status_name: source.status_name,
                        status_label: source.status_label,
                        teacher_name: source.teacher_name,
                        teacher_picture: source.teacher_picture,
                        subscribed_count: source.subscribed_count,
                        subscribed_paid_count: source.subscribed_paid_count,
                        comments_count: source.comments_count,
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>