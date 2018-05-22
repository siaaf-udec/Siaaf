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
                                            <div class="todo-tasklist-item-text"> <small v-html="task.subject_action"></small> </div>
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
                                                                <th v-text="table.subject_action"></th>
                                                                <td v-html="view.subject_action"></td>
                                                            </tr>
                                                            <tr>
                                                                <th v-text="table.status"></th>
                                                                <td v-html="view.status_label"></td>
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
                                                                               get="financial.api.add-sub.comments.index"
                                                                               send="financial.api.add-sub.comments.store">
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
        name: "approval-index-add-sub",
        mixins: [mixinHttpStatus, mixinLoading, mixinMomentLocale, mixinProfilePic, mixinDate, mixinSelect2, mixinValidator],
        components: {
            pagination: pagination,
        },
        data: () => {
            return {
                captions: {
                    helper: Lang.get('financial.generic.requests'),
                    subject: Lang.get('validation.attributes.add_remove_subjects'),
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
                    approval_date: Lang.get('financial.generic.table.approval_date'),
                    subject_action: Lang.get('financial.generic.table.subject_action'),
                    created_at: Lang.get('financial.generic.table.created_at'),
                    subject_code: Lang.get('financial.generic.table.subject_code'),
                    subject_name: Lang.get('financial.generic.table.subject_name'),
                    subject_credits: Lang.get('financial.generic.table.subject_credits'),
                    program_name: Lang.get('financial.generic.table.program_name'),
                    status: Lang.get('financial.generic.table.status_name'),
                    teacher_name: Lang.get('financial.generic.table.teacher_name'),
                    phone: Lang.get('financial.generic.table.phone'),
                    email: Lang.get('financial.generic.table.email'),
                    secretary_name: Lang.get('financial.generic.table.secretary_name'),
                    student_name: Lang.get('financial.generic.table.student_name'),
                    cost: Lang.get('financial.generic.table.cost'),
                    total_cost: Lang.get('financial.generic.table.total_cost'),
                },
                divider: {
                    teacher: Lang.get('financial.generic.teacher_data'),
                    student: Lang.get('financial.generic.atudent_data'),
                    secretary: Lang.get('financial.generic.secretary_data'),
                    request: Lang.get('financial.generic.requests_data'),
                },
                status: {
                    value: null,
                    option: Lang.get('javascript.select'),
                    label: Lang.get('validation.attributes.status').capitalize(),
                    options: []
                },
                filter_query: null,
                patch: '',
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
                        status: {
                            required: true,
                        }
                    }
                });
            },
            initDatePickerAndSelect2: function () {
                let that = this;
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
                axios.get( route('financial.api.approval.sidebar.addition.subtraction') )
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

                axios.get( route('financial.api.approval.addition.subtraction', query ) )
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
                axios.get( route('financial.api.tree.status-request', {type: 'add_remove_subjects'}) )
                    .then( (response) => {
                        this.status.options = response.data.children;
                    })
                    .catch( (error) => {
                        this.triggerSwal(error);
                    });
            },
            viewData: function ( data ) {
                this.view = data;
                this.status.value = null;
                this.patch = route('financial.admin.approval.addition.subtraction.update', { id: this.view.id });
            },
            closeData: function () {
                this.view = null;
                this.patch = null;
                this.status.value = null;
                $('.date-picker').datepicker('destroy');
            },
            setIcon: function ( image ) {
                return this.getSrc( image );
            },
            sendStatus: function () {
                let that = this;
                if ( $('#approval-form').valid() ) {
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
                            return new Promise((resolve) => {
                                axios.put( that.patch , {status: that.status.value} )
                                    .then(() => {
                                        resolve();
                                    })
                                    .catch( (error) => {
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
                        this.status.value = null;
                    });
                }
            },
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
                $('.todo-taskbody-tags').select2().val(status.value).trigger('change')
            }
        },
        computed: {
            taskList: function() {
                return this.sources.data.map( (source) => {
                    return {
                        id: source.id,
                        approval_date: (source.approval_date) ? moment( source.approval_date ).format('ll') : null,
                        original_approval_date: source.approval_date,
                        subject_action: (source.subject_action) ? ( source.subject_action === 1 ) ? '<span class="label label-sm label-success"> '+ Lang.get('financial.add-sub.actions.addition') +' </span>' : '<span class="label label-sm label-danger"> '+ Lang.get('financial.add-sub.actions.subtract') +' </span>' : null,
                        original_realization_date: source.realization_date,
                        created_at: (source.created_at) ? moment( source.created_at ).format('ll') : null,
                        original_created_at: source.created_at,
                        subject_code: source.subject_code,
                        subject_name: source.subject_name,
                        subject_credits: source.subject_credits,
                        program_name: source.program_name,
                        status_name: source.status_name,
                        status_label: source.status_label,
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
            }
        }
    }
</script>

<style scoped>

</style>