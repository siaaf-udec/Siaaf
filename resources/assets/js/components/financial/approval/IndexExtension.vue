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
                                        <a href="javascript:;">
                                            <span class="badge" :class="badge.class" v-text="badge.count"></span>
                                            {{ badge.text.wordWrap(18, '\n', true) }}
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
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default tooltips" data-placement="top" data-original-title="¿Qué puedo hacer?" data-toggle="modal" href="#modal-faq">
                                    <i class="fa fa-question"></i>
                                </a>
                                <a class="btn btn-circle btn-icon-only btn-default tooltips" data-placement="top" data-original-title="Generar Reportes" data-toggle="modal" href="#modal-report">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                            </div>
                        </div>
                        <!-- end PROJECT HEAD -->
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-5 col-sm-4">
                                    <div class="todo-tasklist" id="task-list">
                                        <div class="todo-tasklist-item todo-tasklist-item-border-green" v-for="task in taskList" :id="task.id" @click="viewData( task )">
                                            <img class="todo-userpic pull-left hash-avatar"  :src="setIcon( task.student_picture )" width="27px" height="27px">
                                            <div class="todo-tasklist-item-title" v-text="task.student_name"></div>
                                            <div class="todo-tasklist-item-text"> <small v-text="task.subject_name.wordWrap(40, '\n', true)"></small> </div>
                                            <div class="todo-tasklist-item-text"> <small v-text="task.program_name.wordWrap(40, '\n', true)"></small> </div>
                                            <div class="todo-tasklist-controls pull-left">
                                                <span class="todo-tasklist-date">
                                                    <small> <i class="fa fa-calendar"></i> {{ task.created_at }} </small>
                                                </span>
                                                <span class="todo-tasklist-date">
                                                    <small> <i class="fa fa-comments"></i> {{ task.comments_count }} </small>
                                                </span>
                                                <span class="todo-tasklist-badge badge badge-roundless" v-text="task.status_name.wordWrap(40, '\n', true)"></span>
                                            </div>
                                        </div>

                                    </div>
                                    <pagination :data="sources"
                                                :limit="5"
                                                @pagination-change-page="getSource">
                                    </pagination>
                                </div>
                                <div class="todo-tasklist-devider"> </div>
                                <div class="col-md-7 col-sm-8" v-if="view">
                                    <div class="form-horizontal">
                                        <!-- TASK HEAD -->
                                        <div class="form">
                                            <div class="form-group">
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="todo-taskbody-user">
                                                        <img class="todo-userpic pull-left hash-avatar" :src="setIcon( view.student_picture )" width="50px" height="50px">
                                                        <span class="todo-username pull-left" v-text="view.student_name"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="todo-taskbody-date pull-right">
                                                        <button type="button" class="todo-username-btn btn btn-circle btn-default btn-sm" @click="closeData">X</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END TASK HEAD -->
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <table id="table-bt" data-toggle="table" class="table table-hover table-condensed table-striped" data-height="299" data-card-view="true">
                                                        <tbody>
                                                            <tr>
                                                                <th colspan="2" class="text-center uppercase" v-text="divider.student"></th>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.phone"></th>
                                                                <td v-text="view.student_phone"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.email"></th>
                                                                <td v-text="view.student_email"></td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="2" class="text-center uppercase" v-text="divider.request"></th>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.created_at"></th>
                                                                <td v-text="view.created_at"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.subject_code"></th>
                                                                <td v-text="view.subject_code"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.subject_name"></th>
                                                                <td v-text="view.subject_name.wordWrap(25, '\n', true)"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.subject_credits"></th>
                                                                <td v-text="view.subject_credits"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.program_name"></th>
                                                                <td v-text="view.program_name.wordWrap(25, '\n', true)"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.realization_date"></th>
                                                                <td v-text="view.realization_date"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.status"></th>
                                                                <td v-text="view.status_name"></td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="2" class="text-center uppercase" v-text="divider.teacher"></th>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.teacher_name"></th>
                                                                <td v-text="view.teacher_name"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.phone"></th>
                                                                <td v-text="view.teacher_phone"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.email"></th>
                                                                <td v-text="view.teacher_email"></td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="2" class="text-center uppercase" v-text="divider.secretary"></th>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.secretary_name"></th>
                                                                <td v-text="view.secretary_name"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.phone"></th>
                                                                <td v-text="view.secretary_phone"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.email"></th>
                                                                <td v-text="view.secretary_email"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.approval_date"></th>
                                                                <td v-text="view.approval_date"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.cost"></th>
                                                                <td v-text="view.cost"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.total_cost"></th>
                                                                <td v-text="view.total_cost"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <form @submit.prevent="sendStatus" id="approval-form" :action="view.patch" method="post" class="form-horizontal">
                                                <!-- TASK DUE DATE -->
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <div class="input-icon">
                                                            <i class="fa fa-calendar"></i>
                                                            <input type="text" :required="required" readonly="readonly"
                                                                   minlength="10"
                                                                   maxlength="10"
                                                                   name="date"
                                                                   pattern="\d{4}-\d{2}-\d{2}"
                                                                   id="date"
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
                                                        <select name="status" id="status" required="required" class="form-control todo-taskbody-tags" v-model.number="status.value">
                                                            <option value="" v-text="status.option"></option>
                                                            <option v-for="opt in status.options" :value="opt.id" v-text="opt.text"></option>
                                                        </select>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <!-- TASK TAGS -->
                                                <div class="form-actions right todo-form-actions">
                                                    <input type="submit" class="btn btn-circle btn-sm green" :value="captions.save" />
                                                    <a href="javascript:;" class="btn btn-circle btn-sm btn-default" @click="closeData" v-text="captions.cancel"></a>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="tabbable-line">
                                            <ul class="nav nav-tabs ">
                                                <li class="active">
                                                    <a href="#tab_1" data-toggle="tab"> Comentarios </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">
                                                    <!-- TASK COMMENTS -->
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <!-- Comments -->
                                                            <vue-todo-comments :id="view.id"
                                                                               get="financial.api.extension.comments.index"
                                                                               send="financial.api.extension.comments.store">
                                                            </vue-todo-comments>
                                                        </div>
                                                    </div>
                                                    <!-- END TASK COMMENTS -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END TODO CONTENT -->
            </div>
        </div>
        <vue-modal id="modal-report" title="Reporte">
            <template slot="body">
                <form @submit.prevent="generateReport" method="post" :action="route('financial.admin.approval.extension.report')" class="" id="form-report" accept-charset="UTF-8">
                    <div class="form-body">
                        <input type="hidden" name="_token" :value="token.content">
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="report.select.program.label"
                                             v-model.number="program"
                                             :value="program"
                                             :options="programs"
                                             :attributes="report.select.program.attributes"
                                             name="program">
                                </vue-select2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="report.select.subject.label"
                                             v-model.number="subject"
                                             :value="subject"
                                             :options="subjects"
                                             :attributes="report.select.subject.attributes"
                                             name="subject">
                                </vue-select2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-select2 :label="report.status.label"
                                             v-model="report.status.value"
                                             :value="report.status.value"
                                             :attributes="report.status.attributes"
                                             :options="report.status.options"
                                             name="status">
                                </vue-select2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="start_date"
                                           icon="fa fa-calendar"
                                           v-model.trim="report.available_from.value"
                                           :value="report.available_from.value"
                                           :help="report.available_from.help"
                                           :hasError="report.available_from.hasError"
                                           :errors="report.available_from.errors"
                                           :attributes="report.available_from.attributes"
                                           :label="report.available_from.label">
                                </vue-input>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <vue-input name="end_date"
                                           icon="fa fa-calendar"
                                           v-model.trim="report.available_until.value"
                                           :value="report.available_until.value"
                                           :help="report.available_until.help"
                                           :hasError="report.available_until.hasError"
                                           :errors="report.available_until.errors"
                                           :attributes="report.available_until.attributes"
                                           :label="report.available_until.label">
                                </vue-input>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions  margin-top-30">
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn green" type="submit" :value="buttons.send">
                                <button class="btn red" data-dismiss="modal" type="reset" v-text="buttons.cancel"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
        </vue-modal>
        <vue-modal id="modal-faq" modal-class="container" title="¿Qué puedo hacer?">
            <template slot="body">
                <div class="col-md-12 text-center">
                    <youtube video-id="lsRincTarm4" ></youtube>
                    <p class="text-center">Video de Ayuda</p>
                </div>
            </template>
        </vue-modal>
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
    import pagination from "laravel-vue-pagination"
    export default {
        name: "approval-index-extension",
        mixins: [mixinHttpStatus, mixinLoading, mixinMomentLocale, mixinProfilePic, mixinDate, mixinSelect2, mixinValidator],
        components: {
            pagination: pagination,
        },
        data: () => {
            return {
                token: document.head.querySelector('meta[name="csrf-token"]'),
                report: {
                    status: {
                        value: null,
                        option: Lang.get('javascript.select'),
                        label: Lang.get('validation.attributes.status').capitalize(),
                        options: [],
                        attributes: {
                            required: false,
                            disabled: false,
                        }
                    },
                    select: {
                        program: {
                            label: Lang.get('validation.attributes.program').capitalize(),
                            attributes: {
                                disabled: false,
                                required: false,
                                class: null,
                            }
                        },
                        subject: {
                            label: Lang.get('validation.attributes.subject_matter').capitalize(),
                            attributes: {
                                disabled: true,
                                required: false,
                                class: null,
                            }
                        }
                    },
                    available_from: {
                        value: null,
                        help: Lang.get('financial.help-text.valid_until'),
                        label: Lang.get('validation.attributes.start_date').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            class: '',
                            readonly: true,
                            maxlength: 10,
                            minlength: 10,
                            pattern: '\\d{4}-\\d{2}-\\d{2}',
                        }
                    },
                    available_until: {
                        value: null,
                        help: Lang.get('financial.help-text.valid_from'),
                        label: Lang.get('validation.attributes.end_date').capitalize(),
                        hasError: null,
                        errors: [],
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            class: '',
                            readonly: true,
                            maxlength: 10,
                            minlength: 10,
                            pattern: '\\d{4}-\\d{2}-\\d{2}',
                        }
                    },
                },
                buttons: {
                    send: Lang.get('financial.buttons.send'),
                    cancel: Lang.get('financial.buttons.cancel'),
                },
                programs: [],
                subjects: [],
                program: null,
                subject: null,
                captions: {
                    helper: Lang.get('financial.generic.requests'),
                    subject: Lang.get('validation.attributes.extension'),
                    save: Lang.get('financial.buttons.save'),
                    cancel: Lang.get('financial.buttons.cancel'),
                },
                badges: [],
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
                table: {
                    approval_date: Lang.get('financial.extension.table.approval_date'),
                    realization_date: Lang.get('financial.extension.table.realization_date'),
                    created_at: Lang.get('financial.extension.table.created_at'),
                    subject_code: Lang.get('financial.extension.table.subject_code'),
                    subject_name: Lang.get('financial.extension.table.subject_name'),
                    subject_credits: Lang.get('financial.extension.table.subject_credits'),
                    program_name: Lang.get('financial.extension.table.subject_program'),
                    status: Lang.get('financial.extension.table.status'),
                    teacher_name: Lang.get('financial.extension.table.teacher'),
                    phone: Lang.get('financial.extension.table.phone'),
                    email: Lang.get('financial.extension.table.email'),
                    secretary_name: Lang.get('financial.extension.table.approved_by'),
                    student_name: Lang.get('financial.extension.table.student'),
                    cost: Lang.get('financial.extension.table.cost'),
                    total_cost: Lang.get('financial.extension.table.total_cost'),
                },
                divider: {
                    teacher: Lang.get('financial.generic.teacher_data'),
                    student: Lang.get('financial.generic.atudent_data'),
                    secretary: Lang.get('financial.generic.secretary_data'),
                    request: Lang.get('financial.generic.requests_data'),
                },
                realization_date: null,
                status: {
                    value: null,
                    option: Lang.get('javascript.select'),
                    label: Lang.get('validation.attributes.status').capitalize(),
                    options: []
                },
                filter_query: null,
                patch: '',
                required: false,
            }
        },
        mounted: function () {
            this.getBadges();
            this.getPrograms();
            this.getSource();
            this.getOptions();
            this.handleProjectListMenu();
            this.handleDatePicker();
        },
        methods: {
            getPrograms: function () {
                axios.get( route('financial.api.options.programs') )
                    .then( (response) => {
                        this.programs = response.data;
                    })
                    .catch( (error) => {
                        this.triggerSwal(error);
                    })
            },
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
                $('#form-report').validate();
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
            handleDatePicker: function() {
                let that = this;
                if (jQuery().datepicker) {

                    let start = $('#start_date');
                    let end = $('#end_date');
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
                        startDate: null,
                    });
                    start.datepicker({
                        format: 'yyyy-mm-dd',
                    }).on('changeDate', function () {
                        end.datepicker("setStartDate", moment( this.value ).add( 1, 'days').format('YYYY-MM-DD') );
                        that.report.available_from.value = this.value;
                    });
                    end.datepicker({
                        format: 'yyyy-mm-dd',
                    }).on('changeDate', function () {
                        start.datepicker("setEndDate", moment( this.value ).subtract( 1, 'days').format('YYYY-MM-DD') );
                        that.report.available_until.value = this.value;
                    });
                    $('#status')
                        .select2({placeholder: that.report.status.option})
                        .on('change', function () {
                            that.report.status.value = this.value;
                        });
                }
            },
            handleProjectListMenu: function() {
                if (App.getViewPort().width <= 992) {
                    $('.todo-project-list-content').addClass("collapse");
                } else {
                    $('.todo-project-list-content').removeClass("collapse").css("height", "auto");
                }
            },
            getBadges: function () {
                axios.get( route('financial.api.approval.sidebar.extension') )
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

                axios.get( route('financial.api.approval.extensions', query ) )
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
                axios.get( route('financial.api.tree.status-request', {type: 'extension'}) )
                    .then( (response) => {
                        this.report.status.options = response.data.children;
                        this.status.options = response.data.children;
                    })
                    .catch( (error) => {
                        this.triggerSwal(error);
                    });
            },
            viewData: function ( data ) {
                this.view = data;
                this.realization_date = null;
                this.status.value = null;
                this.patch = route('financial.admin.approval.extension.update', { id: this.view.id });
            },
            closeData: function () {
                this.view = null;
                this.realization_date = null;
                this.status.value = null;
                $('.date-picker').datepicker('destroy');
            },
            setIcon: function ( image ) {
                return this.getSrc( image );
            },
            sendStatus: function () {
                let that = this;
                if ( $('#approval-form').valid() ) {

                    if ( !that.required )  {
                        that.realization_date = moment().format('YYYY-MM-DD');
                    }

                    swal({
                        title: Lang.get('javascript.warning'),
                        html: Lang.get('javascript.ask_if_update'),
                        type: "question",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger ladda-button",
                        confirmButtonText: Lang.get('financial.buttons.yes'),
                        cancelButtonText: Lang.get('financial.buttons.cancel'),
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function () {
                            return new Promise(function (resolve) {
                                axios.patch( that.patch , {date: that.realization_date, status: that.status.value} )
                                    .then(function() {
                                        resolve();
                                    })
                                    .catch(function (error) {
                                        that.triggerSwal( error );
                                    });
                            });
                        },
                    }).then( (result) => {
                        if ( result.value ) {
                            swal(Lang.get('javascript.success'), Lang.get('javascript.updated_done'), "success");
                        }
                    }).then( () => {
                        this.getBadges();
                        this.getSource();
                        this.realization_date = null;
                        this.status.value = null;
                    });
                }
            },
            generateReport: function () {
                if ( $('#form-report').valid() ) {
                    $('#form-report').submit();
                }
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
            statusSelected: function ( status ) {
                let data = $('#status').select2('data');
                data = ( data ) ? data[0].text : null;
                this.required = ( data === 'APROBADO' );
                $('.todo-taskbody-tags').select2().val(status).trigger('change')
            },
            program: function (program) {
                if (program) {
                    axios.get( route( 'financial.api.options.programs.subjects', { id: program } ) )
                        .then( (response) => {
                            this.report.select.subject.attributes = {
                                disabled: false,
                                required: false,
                                class: null,
                            };
                            this.subjects = response.data;
                        })
                        .catch( (error) => {
                            this.triggerSwal(error);
                        });
                } else {
                    this.report.select.subject.attributes = {
                        disabled: true,
                        required: false,
                        class: null,
                    };
                    this.subjects = [];
                    this.subject = null;
                }
            },
        },
        computed: {
            taskList: function() {
                return this.sources.data.map( (source) => {
                    return {
                        id: source.id,
                        approval_date: (source.approval_date) ? moment( source.approval_date ).format('ll') : null,
                        original_approval_date: source.approval_date,
                        realization_date: (source.realization_date) ? moment( source.realization_date ).format('ll') : null,
                        original_realization_date: source.realization_date,
                        created_at: (source.created_at) ? moment( source.created_at ).format('ll') : null,
                        original_created_at: source.created_at,
                        subject_code: source.subject_code,
                        subject_name: source.subject_name,
                        subject_credits: source.subject_credits,
                        program_name: source.program_name,
                        status_name: source.status_name,
                        teacher_name: source.teacher_name,
                        teacher_picture: source.teacher_picture,
                        teacher_phone: source.teacher_phone,
                        teacher_email: source.teacher_email,
                        secretary_name: source.secretary_name,
                        secretary_picture: source.secretary_picture,
                        secretary_phone: source.secretary_phone,
                        secretary_email: source.secretary_email,
                        student_name: source.student_name,
                        student_picture: source.student_picture,
                        student_phone: source.student_phone,
                        student_email: source.student_email,
                        cost: source.cost,
                        total_cost: source.total_cost,
                        comments_count: source.comments_count
                    }
                })
            },
            statusSelected: function() {
                return this.status.value;
            }
        }
    }
</script>

<style scoped>

</style>