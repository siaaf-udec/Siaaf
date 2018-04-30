<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="m-heading-1 border-green m-bordered">
                <h3 v-text="headingCard.title"></h3>
                <p v-text="headingCard.text"></p>
            </div>
        </div>
        <div class="col-md-6">
            <portlet icon="fa fa-list-alt" :title="cardExtension.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form @submit.prevent="statusExtension" id="form-extension"
                                  class="form-inline text-center margin-bottom-40" role="form">
                                <vue-input :help="help"
                                           v-model="cardExtension.value"
                                           :value="cardExtension.value"
                                           :attributes="attributes"
                                           name="extension"
                                           :showLabel="false"
                                           :label="cardExtension.title">
                                </vue-input>
                                <button type="submit" class="btn btn-success" v-text="buttons.add"></button>
                            </form>
                            <div ref="tree_extension" class="tree-demo"></div>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-6">
            <portlet icon="fa fa-list-alt" :title="cardValidation.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form @submit.prevent="statusValidation" id="form-validation"
                                  class="form-inline text-center margin-bottom-40" role="form">
                                <vue-input :help="help"
                                           v-model="cardValidation.value"
                                           :value="cardValidation.value"
                                           :attributes="attributes"
                                           name="validation"
                                           :showLabel="false"
                                           :label="cardValidation.title">
                                </vue-input>
                                <button type="submit" class="btn btn-success" v-text="buttons.add"></button>
                            </form>
                            <div ref="tree_validation" class="tree-demo"></div>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-6">
            <portlet icon="fa fa-list-alt" :title="cardIntersemester.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form @submit.prevent="statusIntersemester" id="form-intersemester"
                                  class="form-inline text-center margin-bottom-40" role="form">
                                <vue-input :help="help"
                                           v-model="cardIntersemester.value"
                                           :value="cardIntersemester.value"
                                           :attributes="attributes"
                                           name="intersemester"
                                           :showLabel="false"
                                           :label="cardIntersemester.title">
                                </vue-input>
                                <button type="submit" class="btn btn-success" v-text="buttons.add"></button>
                            </form>
                            <div ref="tree_intersemester" class="tree-demo"></div>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-6">
            <portlet icon="fa fa-list-alt" :title="cardAddRemoveSubjects.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form @submit.prevent="statusAddRemoveSubjects" id="form-add_remove_subjects"
                                  class="form-inline text-center margin-bottom-40" role="form">
                                <vue-input :help="help"
                                           v-model="cardAddRemoveSubjects.value"
                                           :value="cardAddRemoveSubjects.value"
                                           :attributes="attributes"
                                           name="add_remove_subjects"
                                           :showLabel="false"
                                           :label="cardAddRemoveSubjects.title">
                                </vue-input>
                                <button type="submit" class="btn btn-success" v-text="buttons.add"></button>
                            </form>
                            <div ref="tree_add_remove_subjects" class="tree-demo"></div>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-6">
            <portlet icon="fa fa-list-alt" :title="cardFile.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-xs-12">
                            <form @submit.prevent="statusFile" id="form-file"
                                  class="form-inline text-center margin-bottom-40" role="form">
                                <vue-input :help="help"
                                           v-model="cardFile.value"
                                           :value="cardFile.value"
                                           :attributes="attributes"
                                           name="file"
                                           :showLabel="false"
                                           :label="cardFile.title">
                                </vue-input>
                                <button type="submit" class="btn btn-success" v-text="buttons.add"></button>
                            </form>
                            <div ref="tree_file" class="tree-demo"></div>
                        </div>
                    </div>
                </template>
            </portlet>
        </div>
        <div class="col-md-6">
            <empty-sortable-portlet></empty-sortable-portlet>
        </div>
    </div>
</template>

<script>
    import swal from "sweetalert2";
    import {mixinValidator} from "../../../../mixins/validation";
    import {mixinLoading} from "../../../../mixins/loadingswal";
    import {mixinHttpStatus} from "../../../../mixins";

    export default {
        name: "status-request",
        mixins: [mixinValidator, mixinLoading, mixinHttpStatus],
        data: function () {
            return {
                portlet: Lang.get('financial.management.status.index.title'),
                headingCard: {
                    title: Lang.get('javascript.info'),
                    text: Lang.get('financial.help-text.tree')
                },
                cardExtension: {
                    title: Lang.get('validation.attributes.extension').capitalize(),
                    url: this.getTreeUrl('extension'),
                    value: null,
                },
                cardValidation: {
                    title: Lang.get('validation.attributes.validation').capitalize(),
                    url: this.getTreeUrl('validation'),
                    value: null,
                },
                cardIntersemester: {
                    title: Lang.get('validation.attributes.intersemester').capitalize(),
                    url: this.getTreeUrl('intersemester'),
                    value: null,
                },
                cardAddRemoveSubjects: {
                    title: Lang.get('validation.attributes.add_remove_subjects').capitalize(),
                    url: this.getTreeUrl('add_remove_subjects'),
                    value: null,
                },
                cardFile: {
                    title: Lang.get('validation.attributes.file').capitalize(),
                    url: this.getTreeUrl('file'),
                    value: null,
                },
                buttons: {
                    add: Lang.get('financial.buttons.add')
                },
                help: Lang.get('financial.help-text.status'),
                search: {
                    label: Lang.get('validation.attributes.search').capitalize(),
                    help: Lang.get('financial.help-text.search'),
                    value: null,
                },
                attributes: {
                    required: true,
                    autocomplete: 'off',
                    maxlength: 40,
                    minlength: 2,
                },
                types: {
                    extension: 'extension',
                    file: 'file',
                    validation: 'validation',
                    intersemester: 'intersemester',
                    add_remove_subjects: 'add_remove_subjects',
                }
            }
        },
        mounted: function () {
            this.initTree();
            this.initFormValidation();
        },
        methods: {
            getTreeUrl: (type) => route('financial.api.tree.status-request', {type: type}),
            initFormValidation: function () {
                $('#form-extension').validate();
                $('#form-file').validate();
                $('#form-validation').validate();
                $('#form-intersemester').validate();
                $('#form-add_remove_subjects').validate();
            },
            initTree: function () {
                this.createTree(this.$refs.tree_extension, this.cardExtension.url, this.types.extension, this);
                this.createTree(this.$refs.tree_file, this.cardFile.url, this.types.file, this);
                this.createTree(this.$refs.tree_validation, this.cardValidation.url, this.types.validation, this);
                this.createTree(this.$refs.tree_intersemester, this.cardIntersemester.url, this.types.intersemester, this);
                this.createTree(this.$refs.tree_add_remove_subjects, this.cardAddRemoveSubjects.url, this.types.add_remove_subjects, this);
            },
            statusExtension: function () {
                if ($('#form-extension').valid()) {
                    this.createStatus(
                        {status_name: this.cardExtension.value, status_type: this.types.extension},
                        this.$refs.tree_extension
                    )
                }
            },
            statusFile: function () {
                if ($('#form-file').valid()) {
                    this.createStatus(
                        {status_name: this.cardFile.value, status_type: this.types.file},
                        this.$refs.tree_file
                    )
                }
            },
            statusValidation: function () {
                if ($('#form-validation').valid()) {
                    this.createStatus(
                        {status_name: this.cardValidation.value, status_type: this.types.validation},
                        this.$refs.tree_validation
                    )
                }
            },
            statusIntersemester: function () {
                if ($('#form-intersemester').valid()) {
                    this.createStatus(
                        {status_name: this.cardIntersemester.value, status_type: this.types.intersemester},
                        this.$refs.tree_intersemester
                    )
                }
            },
            statusAddRemoveSubjects: function () {
                if ($('#form-add_remove_subjects').valid()) {
                    this.createStatus(
                        {status_name: this.cardAddRemoveSubjects.value, status_type: this.types.add_remove_subjects},
                        this.$refs.tree_add_remove_subjects
                    )
                }
            },
            createTree: function ($ref, $url, $type, that) {
                $($ref).jstree({
                    core: {
                        data: {
                            url: $url
                        },
                        "themes": {
                            "responsive": false
                        }
                    },
                    "check_callback": true,
                    "search": {
                        "case_insensitive": true,
                        "show_only_matches": true,
                        'show_only_matches_children': true,
                    },
                    "contextmenu": {
                        "items": function ($node) {
                            return {
                                "Rename": {
                                    "separator_before": false,
                                    "separator_after": false,
                                    "icon": 'fa fa-pencil',
                                    "label": Lang.get('financial.buttons.rename'),
                                    "action": function (obj) {
                                        if ($node.state.disabled === true) {
                                            return false;
                                        }
                                        that.updateStatus($node.id, $node.text, $type, $ref);
                                    }
                                },
                                "Remove": {
                                    "separator_before": false,
                                    "separator_after": false,
                                    "icon": 'fa fa-trash',
                                    "label": Lang.get('financial.buttons.delete'),
                                    "action": function (obj) {
                                        if ($node.state.disabled === true) {
                                            return false;
                                        }
                                        that.deleteStatus($node.id, $node.text, $ref);
                                    }
                                },
                                "Refresh": {
                                    "separator_before": false,
                                    "separator_after": false,
                                    "icon": 'fa fa-refresh',
                                    "label": Lang.get('financial.buttons.refresh'),
                                    "action": function (obj) {
                                        that.refreshTree($ref);
                                    }
                                }
                            };
                        }
                    },
                    "plugins": ["search", "sort", 'contextmenu']
                });
            },
            createStatus: function ($data, $element) {
                this.vueLoading();
                axios.post(route('financial.management.status.store'), $data)
                    .then((response) => {
                        $($element).jstree().refresh();
                        this.setValuesNull();
                        swal.close();
                        this.triggerSwal(response);
                    })
                    .catch((error) => {
                        $($element).jstree().refresh();
                        this.setValuesNull();
                        swal.close();
                        this.triggerSwal(error);
                    });
            },
            deleteStatus: function ($id, $text, $element) {
                let self = this;
                swal({
                    title: Lang.get('javascript.remove'),
                    html: Lang.get('javascript.ask_if_delete') + '<br>' + $text,
                    type: "question",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger ladda-button",
                    confirmButtonText: Lang.get('financial.buttons.yes'),
                    cancelButtonText: Lang.get('financial.buttons.cancel'),
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                    preConfirm: function () {
                        return new Promise(function (resolve, reject) {
                            axios.delete(route('financial.management.status.destroy', {id: $id}))
                                .then((response) => {
                                    resolve();
                                })
                                .catch((error) => {
                                    self.refreshTree($element);
                                    self.setValuesNull();
                                    self.triggerSwal(error);
                                });
                        });
                    },
                }).then((result) => {
                    if (result.value) {
                        self.refreshTree($element);
                        self.setValuesNull();
                        swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
                    }
                }).catch(swal.noop);

            },
            updateStatus: function ($id, $data, $type, $element) {
                let that = this;
                (async function updateProgram() {
                    const {value: status_name} = await swal({
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
                                    resolve(Lang.get('validation.filled', {attribute: Lang.get('validation.attributes.status_name')}))
                                } else if (value.length < 3 || value.length > 191) {
                                    resolve(Lang.get('validation.between.numeric', {
                                        min: 2,
                                        max: 191,
                                        attribute: Lang.get('validation.attributes.status_name')
                                    }))
                                } else {
                                    resolve()
                                }
                            })
                        },
                        inputPlaceholder: Lang.get('validation.attributes.status_name').capitalize(),
                        inputValue: $data,
                        showCancelButton: true,
                        confirmButtonText: Lang.get('financial.buttons.send'),
                        cancelButtonText: Lang.get('financial.buttons.cancel'),
                        allowOutsideClick: () => !swal.isLoading()
                    });

                    if (status_name) {
                        swal({
                            title: Lang.get('javascript.update_some', {attribute: Lang.get('validation.attributes.status_name')}),
                            text: status_name,
                            allowOutsideClick: () => !swal.isLoading(),
                            preConfirm: () => {
                                return new Promise((resolve) => {
                                    axios.put(route('financial.management.status.update', {id: $id}), {
                                        status_name: status_name,
                                        status_type: $type
                                    })
                                        .then(function (response) {
                                            resolve();
                                        })
                                        .catch(function (error) {
                                            that.refreshTree($element);
                                            that.triggerSwal(error);
                                        });
                                })
                            },
                            showLoaderOnConfirm: true,
                        }).then((result) => {
                            if (result.value) {
                                that.refreshTree($element);
                                swal(Lang.get('javascript.success'), Lang.get('javascript.updated_done'), "success");
                            }
                        }).catch(swal.noop);
                    }
                })()
            },
            refreshTree: function ($element) {
                $($element).jstree().refresh();
            },
            setValuesNull: function () {
                this.cardExtension.value = null;
                this.cardValidation.value = null;
                this.cardIntersemester.value = null;
                this.cardAddRemoveSubjects.value = null;
                this.cardFile.value = null;
            }
        }
    }
</script>

<style scoped>

</style>