<template>
    <div class="row">
        <div class="col-md-12">
            <portlet icon="fa fa-file-o" :title="portlet.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12 margin-bottom-40">
                            <a class="btn btn-success" href="javascript:;" id="create-button" v-text="btnText"></a>
                        </div>
                        <div class="col-md-12">
                            <vue-data-table
                                    :id="id"
                                    :columns="columns">
                            </vue-data-table>
                        </div>
                    </div>
                </template>
            </portlet>
            <empty-sortable-portlet></empty-sortable-portlet>
        </div>
    </div>
</template>

<script>
    import swal from "sweetalert2";
    import {mixinHttpStatus} from "../../../../mixins";
    import {mixinTootilps} from "../../../../mixins/tooltip";

    export default {
        name: "management-file-type",
        mixins: [mixinHttpStatus, mixinTootilps],
        data: function () {
            return {
                portlet: {
                    title: Lang.get('financial.management.file_type.index.title')
                },
                id: 'datatable-file-type',
                columns: [
                    {name: '#', class: ''},
                    {name: Lang.get('validation.attributes.file_type').capitalize(), class: ''},
                    {name: Lang.get('validation.attributes.actions').capitalize(), class: ''},
                ],
                url: route('financial.api.datatables.file-type', {}, false),
                source: [
                    { data: 'id',           name: 'id' },
                    { data: 'file_types',   name: 'file_types' },
                    { data: 'actions',      name: 'actions', searchable: false, orderable: false },
                ],
                btnText: Lang.get('financial.buttons.add'),
                name: Lang.get('validation.attributes.program'),
            }
        },
        mounted: function () {
            this.initTable();
        },
        methods: {
            initTable: function() {
                let self = this;
                let table = $( `#${self.id}` ).DataTable({
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

                this.createTable( table );
                this.updateTable( table );
                this.deleteTable( table );

            },
            createTable: function ( table ) {
                let that = this;
                $('#create-button').on('click', function () {
                    (async function createFileType() {
                        const {value: file_type} = await swal({
                            title: Lang.get('javascript.create_some', { attribute: Lang.get('validation.attributes.file_type') }),
                            text: Lang.get('javascript.ask_if_create'),
                            input: 'text',
                            inputAttributes: {
                                autocompete: 'off',
                                minlength: 2,
                                maxlength: 191,
                                required: 'required',
                            },
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                    if (!value) {
                                        resolve( Lang.get('validation.filled', { attribute: Lang.get('validation.attributes.file_type') } ) )
                                    } else if ( value.length < 3 || value.length > 191 ) {
                                        resolve( Lang.get('validation.between.numeric', {min: 2, max: 191, attribute: Lang.get('validation.attributes.file_type') } ) )
                                    } else {
                                        resolve()
                                    }
                                })
                            },
                            inputPlaceholder: Lang.get('validation.attributes.file_type').capitalize(),
                            inputValue: '',
                            showCancelButton: true,
                            confirmButtonText: Lang.get('financial.buttons.send'),
                            cancelButtonText: Lang.get('financial.buttons.cancel'),
                            allowOutsideClick: () => !swal.isLoading()
                        });

                        if (file_type) {
                            swal({
                                title: Lang.get('javascript.create_some', { attribute: Lang.get('validation.attributes.file_type') }),
                                text: file_type,
                                allowOutsideClick: () => !swal.isLoading(),
                                preConfirm: () => {
                                    return new Promise((resolve) => {
                                        axios.post( route('financial.management.file.type.store'), qs.stringify( { file_type: file_type } ) )
                                            .then(function(response) {
                                                resolve();
                                            })
                                            .catch(function (error) {
                                                table.ajax.reload(that.handleTooltips(), false);
                                                that.triggerSwal( error );
                                            });
                                    })
                                },
                                showLoaderOnConfirm: true,
                            }).then( (result) => {
                                if ( result.value ) {
                                    table.ajax.reload(that.handleTooltips(), false);
                                    swal(Lang.get('javascript.success'), Lang.get('javascript.updated_done'), "success");
                                }
                            }).catch(swal.noop);
                        }
                    })()
                });
            },
            updateTable: function ( table ) {
                let self = this;
                table.on('click', '.edit', function (e) {
                    e.preventDefault();
                    let $url = route( 'financial.management.file.type.update' , { id: $(this).data('id') } );
                    let data = table.row( $(this).parents('tr') ).data();
                    let text = null;
                    if (data.hasOwnProperty('file_types')) {
                        text = data.file_types;
                    }
                    (async function updateFileType() {
                        const {value: file_type} = await swal({
                            title: Lang.get('javascript.warning'),
                            text: Lang.get('javascript.ask_if_update'),
                            input: 'text',
                            inputAttributes: {
                                autocompete: 'off',
                                minlength: 2,
                                maxlength: 191,
                                required: 'required',
                            },
                            inputValidator: (value) => {
                                return new Promise((resolve) => {
                                    if (!value) {
                                        resolve( Lang.get('validation.filled', { attribute: Lang.get('validation.attributes.file_type') } ) )
                                    } else if ( value.length < 3 || value.length > 191 ) {
                                        resolve( Lang.get('validation.between.numeric', {min: 2, max: 191, attribute: Lang.get('validation.attributes.file_type') } ) )
                                    } else {
                                        resolve()
                                    }
                                })
                            },
                            inputPlaceholder: Lang.get('validation.attributes.file_type').capitalize(),
                            inputValue: text,
                            showCancelButton: true,
                            confirmButtonText: Lang.get('financial.buttons.send'),
                            cancelButtonText: Lang.get('financial.buttons.cancel'),
                            allowOutsideClick: () => !swal.isLoading()
                        });

                        if (file_type) {
                            swal({
                                title: Lang.get('javascript.update_some', { attribute: Lang.get('validation.attributes.file_type') }),
                                text: file_type,
                                allowOutsideClick: () => !swal.isLoading(),
                                preConfirm: () => {
                                    return new Promise((resolve) => {
                                        axios.put( $url, { file_type: file_type } )
                                            .then(function(response) {
                                                resolve();
                                            })
                                            .catch(function (error) {
                                                table.ajax.reload(self.handleTooltips(), false);
                                                self.triggerSwal( error );
                                            });
                                    })
                                },
                                showLoaderOnConfirm: true,
                            }).then( (result) => {
                                if ( result.value ) {
                                    self.handleTooltips();
                                    table.ajax.reload(self.handleTooltips(), false);
                                    swal(Lang.get('javascript.success'), Lang.get('javascript.updated_done'), "success");
                                }
                            }).catch(swal.noop);
                        }
                    })()
                });
            },
            deleteTable: function ( table ) {
                let self = this;
                table.on('click', '.trash', function (e) {
                    e.preventDefault();
                    let $tr = $(this).closest('tr');
                    let $url = route( 'financial.management.file.type.destroy' , { id: $(this).data('id') } );
                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    let text = '';

                    if (data.hasOwnProperty('file_types')) {
                        text = data.file_types;
                    }

                    swal({
                        title: Lang.get('javascript.remove'),
                        html: Lang.get('javascript.ask_if_delete') + '<br>' + text,
                        type: "question",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger ladda-button",
                        confirmButtonText: Lang.get('financial.buttons.yes'),
                        cancelButtonText: Lang.get('financial.buttons.cancel'),
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function () {
                            return new Promise(function (resolve, reject) {
                                axios.delete( $url, {} )
                                    .then(function(response) {
                                        resolve();
                                    })
                                    .catch(function (error) {
                                        self.triggerSwal( error );
                                    });
                            });
                        },
                    }).then( (result) => {
                        if ( result.value ) {
                            $tr.remove();
                            self.handleTooltips();
                            swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
                        }
                    }).catch(swal.noop);
                });
            },
        },
    }
</script>

<style scoped>

</style>