<template>
    <div class="row">
        <div class="col-md-12">
            <div class="blog-page blog-content-2">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-single-content bordered blog-container">
                            <div class="blog-single-head">
                                <h1 class="blog-single-head-title" v-text="title"></h1>
                                <div class="blog-single-head-date">
                                    <i class="fa fa-cog font-blue"></i>
                                    <a href="javascript:;" v-text="status"></a>
                                </div>
                            </div>
                            <div class="blog-single-desc">
                                <vue-data-table
                                        id="datatable-request"
                                        :columns="table.columns">
                                </vue-data-table>
                            </div>
                            <!-- Edit and destroy form -->
                            <div class="blog-single-foot" v-if="status === 'PENDIENTE' || status === 'ENVIADO'">
                                <ul class="blog-post-tags">
                                    <li class="uppercase">
                                        <a href="javascript:;"
                                           class="tooltips"
                                           @click.prevent="goTo"
                                           :data-original-title="edit.tooltip" v-text="edit.text"></a>
                                    </li>
                                    <li class="uppercase">
                                        <a href="javascript:;"
                                           class="tooltips"
                                           @click.prevent="destroy"
                                           :data-original-title="trash.tooltip"
                                           id="trash_button"> <span v-text="trash.text"></span></a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Comments -->
                            <vue-blog-comments :id="comment"
                                               get="financial.api.extension.comments.index"
                                               send="financial.api.extension.comments.store">
                            </vue-blog-comments>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-single-sidebar bordered blog-container">
                            <div class="blog-single-sidebar-search">
                                <h4 class="font-blue" v-text="date.text"></h4>
                                <div class="date-picker" data-date-format="yyyy-mm-dd"
                                     :data-date="picker"
                                     :data-date-start-date="picker"
                                     :data-date-end-date="picker">
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
    import {mixinHttpStatus} from "../../../../../mixins";
    import {mixinDataTable} from "../../../../../mixins/datatable";
    import {mixinTootilps} from "../../../../../mixins/tooltip";
    import moment from 'moment-with-locales-es6';
    import {mixinMomentLocale} from "../../../../../mixins/moment";

    export default {
        name: "student-extension-request-show",
        mixins: [mixinHttpStatus, mixinDataTable, mixinTootilps, mixinMomentLocale],
        data: () => {
            return {
                title: Lang.get('financial.extension.show.title'),
                table: {
                    id: 'datatable-extension',
                    columns: [
                        { name: '#', class: '' },
                        { name: Lang.get('financial.extension.table.subject_code'), class: '' },
                        { name: Lang.get('financial.extension.table.subject_name'), class: '' },
                        { name: Lang.get('financial.extension.table.subject_credits'), class: '' },
                        { name: Lang.get('financial.extension.table.subject_program'), class: '' },
                        { name: Lang.get('financial.extension.table.total_cost'), class: '' },
                        { name: Lang.get('financial.extension.table.status'), class: '' },
                        { name: Lang.get('financial.extension.table.cost'), class: 'none' },
                        { name: Lang.get('financial.extension.table.teacher'), class: 'none' },
                        { name: Lang.get('financial.extension.table.phone'), class: 'none' },
                        { name: Lang.get('financial.extension.table.email'), class: 'none' },
                        { name: Lang.get('financial.extension.table.approval_date'), class: '' },
                        { name: Lang.get('financial.extension.table.approved_by'), class: '' },
                        { name: Lang.get('financial.extension.table.realization_date'), class: '' },
                        { name: Lang.get('financial.extension.table.student'), class: 'none' },
                        { name: Lang.get('financial.extension.table.phone'), class: 'none' },
                        { name: Lang.get('financial.extension.table.email'), class: 'none' },
                        { name: Lang.get('financial.extension.table.created_at'), class: 'none' },
                    ],
                    sources: [
                        { data: 'id',        name: 'id' },
                        { data: 'subject_code', name: 'subject_code' },
                        { data: 'subject_name', name: 'subject_name' },
                        { data: 'subject_credits', name: 'subject_credits' },
                        { data: 'subject_program', name: 'subject_program' },
                        { data: 'total_cost', name: 'total_cost' },
                        { data: 'status', name: 'status' },
                        { data: 'unit_cost', name: 'unit_cost' },
                        { data: 'teacher', name: 'teacher' },
                        { data: 'phone', name: 'phone',
                            render: function (data, type, row) {
                                return '<a href="tel:'+data+'">'+data+'</a>';
                            }
                        },
                        { data: 'email', name: 'email',
                            render: function (data, type, row) {
                                return '<a href="mailto:'+data+'">'+data+'</a>';
                            }
                        },
                        { data: 'approve_date', name: 'approve_date',
                            render: function ( data, type, row ) {
                                return data ? moment(data).format('ll') : Lang.get('financial.generic.empty');
                            }
                        },
                        { data: 'approve_by', name: 'approve_by' },
                        { data: 'extension_date', name: 'extension_date',
                            render: function ( data, type, row ) {
                                return data ? moment(data).format('ll') : Lang.get('financial.generic.empty');
                            }
                        },
                        { data: 'student', name: 'student' },
                        { data: 'student_phone', name: 'student_phone',
                            render: function (data, type, row) {
                                return '<a href="tel:'+data+'">'+data+'</a>';
                            }
                        },
                        { data: 'student_email', name: 'student_email',
                            render: function (data, type, row) {
                                return '<a href="mailto:'+data+'">'+data+'</a>';
                            }
                        },
                        { data: 'created_at', name: 'created_at',
                            render: function ( data, type, row ) {
                                return data ? moment(data).format('ll') : Lang.get('financial.generic.empty');
                            }
                        },
                    ],
                },
                edit: {
                    tooltip: Lang.get('javascript.tooltip.edit'),
                    text: Lang.get('financial.buttons.edit'),
                },
                trash: {
                    tooltip: Lang.get('javascript.tooltip.delete'),
                    text: Lang.get('financial.buttons.delete')
                },
                date: {
                    text: Lang.get('financial.extension.table.realization_date'),
                },
                comment: 0,
                status: null,
                picker: null,
            }
        },
        mounted: function () {
            let that = this;
            this.comment = $('#app').data('source');
            (async function f() {
                await that.initDatatable();
                await that.initDatePicker();
            })();
        },
        methods: {
            initDatatable: function () {
                let self = this;
                $( '#datatable-request' ).DataTable({
                    "searching": false,
                    "paging": false,
                    columns: self.table.sources,
                    ajax: {
                        url: route('financial.api.extension.show', { id: $('#app').data('source') } ),
                        error: function (data) {
                            self.triggerSwal(data);
                        },
                        fail: function (data) {
                            self.triggerSwal(data);
                        },
                    },
                    createdRow: function ( row, data, index ) {
                        self.status = data.status;
                        self.picker = ( data.extension_date ) ? moment( data.extension_date ).format('YYYY-MM-DD') : moment().format('YYYY-MM-DD')
                    }
                });
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
                    setDate: that.picker,
                });
            },
            goTo: function () {
                window.location.href = route('financial.requests.student.extension.edit', { id: $('#app').data('source') } );
            },
            destroy: function () {
                let that = this;
                swal({
                    title: Lang.get('javascript.warning'),
                    text: Lang.get('javascript.ask_if_delete'),
                    type: "question",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger ladda-button",
                    confirmButtonText: Lang.get('financial.buttons.yes'),
                    cancelButtonText: Lang.get('financial.buttons.cancel'),
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return new Promise(( resolve ) => {
                            axios.delete( route('financial.requests.student.extension.destroy', {id: $('#app').data('source') }) )
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
                            text: Lang.get('javascript.deleted_done'),
                            type: "success",
                            showCancelButton: false,
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = route('financial.requests.student.extension.index');
                            }
                        });
                    }
                })
            }
        },
    }
</script>

<style scoped>

</style>