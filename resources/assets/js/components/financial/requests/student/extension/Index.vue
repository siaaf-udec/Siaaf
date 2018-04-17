<template>
    <div class="row">
        <div class="col-md-12">
            <portlet icon="icon-layers" :title="portlet.title">
                <template slot="actions">
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
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import {mixinHttpStatus} from "../../../../../mixins";
    import {mixinTootilps} from "../../../../../mixins/tooltip";
    import {mixinDataTable} from "../../../../../mixins/datatable";
    import {mixinValidator} from "../../../../../mixins/validation";

    export default {
        name: "student-extension-request-index",
        mixins: [mixinHttpStatus, mixinDataTable, mixinTootilps, mixinValidator],
        data: function() {
            return {
                portlet: {
                    title: Lang.get('financial.extension.index.title'),
                    action: {
                        tooltip: Lang.get('javascript.tooltip.add'),
                        link: route('financial.requests.student.extension.create'),
                    },
                    button: {
                        link: route('financial.requests.student.extension.create'),
                        tooltip: Lang.get('javascript.tooltip.add'),
                        text: Lang.get('financial.buttons.add')
                    },
                },
                id: 'datatable-extension',
                columns: [
                    {name: '#', class: ''},
                    {name: Lang.get('financial.extension.table.subject_code'), class: ''},
                    {name: Lang.get('financial.extension.table.subject_name'), class: ''},
                    {name: Lang.get('financial.extension.table.subject_credits'), class: 'none'},
                    {name: Lang.get('financial.extension.table.cost'), class: 'none'},
                    {name: Lang.get('financial.extension.table.total_cost'), class: ''},
                    {name: Lang.get('financial.extension.table.created_at'), class: ''},
                    {name: Lang.get('financial.extension.table.teacher'), class: 'none'},
                    {name: Lang.get('financial.extension.table.status'), class: ''},
                    {name: Lang.get('financial.extension.table.actions'), class: ''},
                ],
                url: route('financial.api.datatables.extensions', {}, false),
                source: [
                    { data: 'pk_id',                            name: 'pk_id' },
                    { data: 'subject.subject_code',             name: 'subject.subject_code' },
                    { data: 'subject.subject_name',             name: 'subject.subject_name' },
                    { data: 'subject.subject_credits',          name: 'subject.subject_credits' },
                    { data: 'cost.cost',                        name: 'cost.cost' },
                    { data: 'total_cost',                       name: 'total_cost' },
                    { data: 'created_at',                       name: 'created_at' },
                    { data: 'subject.teachers[0].full_name',    name: 'subject.teachers[0].full_name' },
                    { data: 'status.status_name',               name: 'status.status_name' },
                    { data: 'actions',                          name: 'actions' },
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
                    let $url = route('financial.requests.student.extension.destroy', {id: $(this).data('id')});
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
                    }).then((result) => {
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