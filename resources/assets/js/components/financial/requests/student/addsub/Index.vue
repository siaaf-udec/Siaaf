<template>
    <div class="row">
        <div class="col-md-12">
            <portlet icon="icon-layers" :title="portlet.title">
                <template slot="actions">
                    <a class="btn btn-circle btn-icon-only btn-default tooltips" data-placement="top" data-original-title="¿Qué puedo hacer?" data-toggle="modal" href="#modal-faq">
                        <i class="fa fa-question"></i>
                    </a>
                    <portlet-actions
                            :link="portlet.action.link"
                            icon="fa fa-plus"
                            id="add_actions"
                            :tooltip="portlet.action.tooltip">
                    </portlet-actions>
                </template>
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12"><div id="error-ajax"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a :href="portlet.button.link" class="btn green tooltips" :data-original-title="portlet.button.tooltip" v-text="portlet.button.text"></a>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <vue-data-table
                                    :id="id"
                                    :columns="columns"
                                    :url="url"
                                    :source="source">
                            </vue-data-table>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <empty-sortable-portlet/>
        <vue-modal id="modal-faq" modal-class="container" title="¿Qué puedo hacer?">
            <template slot="body">
                <div class="col-md-12 text-center">
                    <youtube video-id="8eY0we3t49g" ></youtube>
                    <p class="text-center">Video de Ayuda</p>
                </div>
            </template>
        </vue-modal>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import moment from 'moment-with-locales-es6';
    import {mixinMomentLocale} from "../../../../../mixins/moment";
    import {mixinHttpStatus} from "../../../../../mixins";
    import {mixinTootilps} from "../../../../../mixins/tooltip";
    import {mixinDataTable} from "../../../../../mixins/datatable";
    import {mixinValidator} from "../../../../../mixins/validation";

    export default {
        name: "student-add-sub-request-index",
        mixins: [mixinHttpStatus, mixinDataTable, mixinTootilps, mixinValidator, mixinMomentLocale],
        data: function() {
            return {
                portlet: {
                    title: Lang.get('financial.add-sub.index.title'),
                    action: {
                        tooltip: Lang.get('javascript.tooltip.add'),
                        link: route('financial.requests.student.add-sub.create'),
                    },
                    button: {
                        link: route('financial.requests.student.add-sub.create'),
                        tooltip: Lang.get('javascript.tooltip.add'),
                        text: Lang.get('financial.buttons.add')
                    },
                },
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
                    {name: Lang.get('financial.generic.table.actions'), class: ''},
                ],
                url: route('financial.api.datatables.add-sub', {}, false),
                source: [
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
                            return data ? data.wordWrap(40,  "<br/>", true) : null;
                        }
                    },
                    { data: 'subject_credits',  name: 'subject_credits' },
                    { data: 'program_name',     name: 'program_name' },
                    { data: 'status_label',     name: 'status_label' },
                    { data: 'teacher_name',     name: 'teacher_name' },
                    { data: 'teacher_phone',    name: 'teacher_phone',
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
                    { data: 'actions',          genericname: 'actions' },
                ],
            }
        },
        mounted: function () {
            this.initTable();
        },
        methods: {
            initTable: function() {
                let self = this;
                let table = $( '#datatable-extension' ).DataTable({
                    columns: self.source,
                    ajax: {
                        url: self.url,
                        error: function (data) {
                            self.triggerSwal(data);
                        },
                        fail: function (data) {
                            self.triggerSwal(data);
                        }
                    },
                });
                $(document).on('click', '#tab-table-subject', function () {
                    table.ajax.reload(self.handleTooltips(), false);
                });
                this.destroy( table );
            },
            destroy: function( table ) {
                let that = this;
                table.on('click', '.trash', function (e) {
                    e.preventDefault();
                    let $tr = $(this).closest('tr');
                    let $url = route('financial.requests.student.add-sub.destroy', { id: $(this).data('id')});
                    swal({
                        title: Lang.get('javascript.warning'),
                        text: Lang.get('javascript.ask_if_delete'),
                        type: "question",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger ladda-button",
                        confirmButtonText: Lang.get('financial.buttons.yes'),
                        cancelButtonText: Lang.get('financial.buttons.cancel'),
                        showLoaderOnConfirm: true,
                        preConfirm: function () {
                            return new Promise(function (resolve) {
                                axios.delete( $url )
                                    .then( (response) => {
                                        resolve();
                                    })
                                    .catch( (error) => {
                                        that.triggerSwal( error );
                                    });
                            })
                        },
                        allowOutsideClick: false
                    }).then(( result ) => {
                        if (result.value) {
                            $tr.remove();
                            table.ajax.reload(that.handleTooltips(), false);
                            swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
                        }
                    }).catch(swal.noop);
                });
            },
        }
    }
</script>

<style scoped>

</style>