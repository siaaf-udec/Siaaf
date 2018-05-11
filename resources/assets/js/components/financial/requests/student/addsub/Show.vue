<template>
    <div class="row">
        <div class="col-md-12">
            <div class="blog-page blog-content-2">
                <div class="row">
                    <div class="col-lg-12">
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
                                               get="financial.api.add-sub.comments.index"
                                               send="financial.api.add-sub.comments.store">
                            </vue-blog-comments>

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
        name: "student-add-sub-request-show",
        mixins: [mixinHttpStatus, mixinDataTable, mixinTootilps, mixinMomentLocale],
        data: () => {
            return {
                title: Lang.get('financial.add-sub.show.title'),
                table: {
                    id: 'datatable-extension',
                    columns: [
                        {name: Lang.get('financial.generic.table.id'), class: ''},
                        {name: Lang.get('financial.generic.table.subject_action'), class: ''},
                        {name: Lang.get('financial.generic.table.created_at'), class: 'none'},
                        {name: Lang.get('financial.generic.table.subject_code'), class: 'none'},
                        {name: Lang.get('financial.generic.table.subject_name'), class: ''},
                        {name: Lang.get('financial.generic.table.subject_credits'), class: 'none'},
                        {name: Lang.get('financial.generic.table.program_name'), class: 'none'},
                        {name: Lang.get('financial.generic.table.status_name'), class: ''},
                        {name: Lang.get('financial.generic.table.teacher_name'), class: 'none'},
                        {name: Lang.get('financial.generic.table.phone'), class: 'none'},
                        {name: Lang.get('financial.generic.table.email'), class: 'none'},
                        {name: Lang.get('financial.generic.table.secretary_name'), class: 'none'},
                        {name: Lang.get('financial.generic.table.approval_date'), class: 'none'},
                        {name: Lang.get('financial.generic.table.phone'), class: 'none'},
                        {name: Lang.get('financial.generic.table.email'), class: 'none'},
                        {name: Lang.get('financial.generic.table.cost'), class: 'none'},
                        {name: Lang.get('financial.generic.table.total_cost'), class: ''},
                    ],
                    sources: [
                        { data: 'id',               name: 'id' },
                        { data: 'subject_action',   name: 'subject_action',
                            render: function ( data, type, row ) {
                                let addition = '<span class="label label-sm label-success"> '+ Lang.get('financial.add-sub.actions.addition') +' </span>';
                                let subtraction = '<span class="label label-sm label-danger"> '+ Lang.get('financial.add-sub.actions.subtract') +' </span>';
                                if (data)
                                    return data === 1 ?  addition : subtraction;
                                else
                                    return Lang.get('financial.generic.empty');
                            }
                        },
                        { data: 'created_at', name: 'created_at',
                            render: function ( data, type, row ) {
                                return data ? moment(data).format('ll') : null;
                            }
                        },
                        { data: 'subject_code',     name: 'subject_code' },
                        { data: 'subject_name',     name: 'subject_name',
                            render: function ( data, type, row ) {
                                return data ? data.wordWrap(20,  "<br/>", true) : null;
                            }
                        },
                        { data: 'subject_credits',  name: 'subject_credits' },
                        { data: 'program_name',     name: 'program_name',
                            render: function ( data, type, row ) {
                                return data ? data.wordWrap(20,  "<br/>", true) : null;
                            }
                        },
                        { data: 'status_label',     name: 'status_label' },
                        { data: 'teacher_name',     name: 'teacher_name' },
                        { data: 'teacher_phone', name: 'teacher_phone',
                            render: function (data, type, row) {
                                return '<a href="tel:'+data+'">'+data+'</a>';
                            }
                        },
                        { data: 'teacher_email', name: 'teacher_email',
                            render: function (data, type, row) {
                                return '<a href="mailto:'+data+'">'+data+'</a>';
                            }
                        },
                        { data: 'secretary_name',   name: 'secretary_name' },
                        { data: 'approval_date',    name: 'approval_date',
                            render: function ( data, type, row ) {
                                return data ? moment(data).format('ll') : Lang.get('financial.generic.empty');
                            }
                        },
                        { data: 'secretary_phone', name: 'secretary_phone',
                            render: function (data, type, row) {
                                return '<a href="tel:'+data+'">'+data+'</a>';
                            }
                        },
                        { data: 'secretary_email', name: 'secretary_email',
                            render: function (data, type, row) {
                                return '<a href="mailto:'+data+'">'+data+'</a>';
                            }
                        },
                        { data: 'cost',             name: 'cost' },
                        { data: 'total_cost',       name: 'total_cost' },
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
                comment: 0,
                status: null,
            }
        },
        mounted: function () {
            this.comment = $('#app').data('source');
            this.initComponents();
        },
        methods: {
            initComponents: function () {
                let self = this;
                $( '#datatable-request' ).DataTable({
                    "searching": false,
                    "paging": false,
                    columns: self.table.sources,
                    ajax: {
                        url: route('financial.api.add-sub.show', { id: $('#app').data('source') } ),
                        error: function (data) {
                            self.triggerSwal(data);
                        },
                        fail: function (data) {
                            self.triggerSwal(data);
                        },
                    },
                    createdRow: function (  nRow, aData, iDataIndex ) {
                        self.status = aData.status_name;
                    }
                });
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    language: Lang.get("javascript.locale"),
                    daysOfWeekDisabled: [0],
                    defaultTime: !0,
                    todayBtn: !0,
                    todayHighlight: !0,
                    enableOnReadonly: !0,
                });
            },
            goTo: function () {
                window.location.href = route('financial.requests.student.add-sub.edit', { id: $('#app').data('source') } );
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
                            axios.delete( route('financial.requests.student.add-sub.destroy', {id: $('#app').data('source') }) )
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
                                window.location.href = route('financial.requests.student.add-sub.index');
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