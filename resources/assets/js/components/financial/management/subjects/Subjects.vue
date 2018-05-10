<template>
    <div id="tabs" class="tabbable-line">
        <ul class="nav nav-tabs ">
            <li ref="li_tab_1" class="active">
                <a href="#tab_1" data-toggle="tab" v-text="sections[0].title"></a>
            </li>
            <li ref="li_tab_2">
                <a href="#tab_2" id="tab-table-subject" data-toggle="tab" v-text="sections[1].title"></a>
            </li>
            <li ref="li_tab_3">
                <a href="#tab_3" data-toggle="tab" v-text="sections[2].title"></a>
            </li>
            <li ref="li_tab_4">
                <a href="#tab_4" id="tab-table-subject-program-teacher" data-toggle="tab" v-text="sections[3].title"></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <p v-text="sections[0].description"></p>
                        <form @submit.prevent="sendFormCreate" ref="formsubject" id="form-subject" accept-charset="UTF-8">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <vue-input name="code"
                                                   v-model.trim="formCreate.code.value"
                                                   :value="formCreate.code.value"
                                                   :attributes="formCreate.code.attributes"
                                                   :help="formCreate.code.help"
                                                   :hasError="formCreate.code.hasError"
                                                   :errors="formCreate.code.errors"
                                                   :label="formCreate.code.label">
                                        </vue-input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <vue-input-empty icon="fa fa-keyboard-o"
                                                         :label="formCreate.credits.label"
                                                         :help="formCreate.credits.help"
                                                         :hasError="formCreate.credits.hasError"
                                                         :errors="formCreate.credits.errors"
                                                         name="credits">
                                            <input type="number"
                                                   name="credits"
                                                   required="required"
                                                   ref="credits"
                                                   pattern="[1-5]{1}"
                                                   :placeholder="formCreate.credits.label"
                                                   min="1"
                                                   max="5"
                                                   @input="checkLength( $event.target.value )"
                                                   class="form-control"
                                                   id="credits"
                                                   v-model.number.trim="formCreate.credits.value" />
                                        </vue-input-empty>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <vue-input name="subject"
                                                   v-model.trim="formCreate.subject.value"
                                                   :value="formCreate.subject.value"
                                                   :attributes="formCreate.subject.attributes"
                                                   :help="input.help"
                                                   :hasError="formCreate.subject.hasError"
                                                   :errors="formCreate.subject.errors"
                                                   :label="input.label">
                                        </vue-input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="btn green" type="submit" :value="buttons.send">
                                        <button class="btn red" @click="changeTitle" type="reset" v-text="buttons.cancel"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_2">
                <p v-text="sections[1].description"></p>
                <div class="row">
                    <div class="col-md-12">
                        <vue-data-table
                                 id="datatable-subjects"
                                :columns="tableSubjects.columns">
                        </vue-data-table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_3">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <p v-text="sections[2].description"></p>
                        <form @submit.prevent="sendFormAssign" ref="formassign" id="form-assign-subject" accept-charset="UTF-8">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <vue-select2 name="program"
                                                     v-model.number.trim="formAssign.program.value"
                                                     :options="programs"
                                                     :value="formAssign.program.value"
                                                     :label="formAssign.select.program">
                                        </vue-select2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <vue-select2 name="teacher"
                                                     v-model.number.trim="formAssign.teacher.value"
                                                     :options="teachers"
                                                     :value="formAssign.teacher.value"
                                                     :label="formAssign.select.teacher">
                                        </vue-select2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <vue-select2 name="subject"
                                                     v-model.number.trim="formAssign.subject.value"
                                                     :options="subjects"
                                                     :value="formAssign.subject.value"
                                                     :label="input.label">
                                        </vue-select2>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="btn green" type="submit" :value="buttons.send">
                                        <button class="btn red" @click="changeTitle" type="reset" v-text="buttons.cancel"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_4">
                <p v-text="sections[3].description"></p>
                <div class="row">
                    <div class="col-md-12">
                        <vue-data-table
                                id="datatable-subjects-teachers-programs"
                                :columns="tableAssigned.columns">
                        </vue-data-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from "sweetalert2";
    import {mixinValidator} from "../../../../mixins/validation";
    import {mixinSelect2} from "../../../../mixins/select2";
    import {mixinHttpStatus} from "../../../../mixins";
    import {mixinDataTable} from "../../../../mixins/datatable";
    import {mixinTootilps} from "../../../../mixins/tooltip";
    import {mixinLoading} from "../../../../mixins/loadingswal";

    export default {
        name: "management-subjects",
        mixins: [mixinSelect2, mixinValidator, mixinHttpStatus, mixinDataTable, mixinTootilps, mixinLoading],
        data: function () {
            return {
                method: 'POST',
                url: '',
                params: {},
                oldParams: {},
                formAssign: {
                    select: {
                        program: Lang.get('validation.attributes.program').capitalize(),
                        teacher: Lang.get('validation.attributes.teacher').capitalize(),
                    },
                    program: {
                        value: null,
                    },
                    teacher: {
                        value: null,
                    },
                    subject: {
                        value: null,
                    }
                },
                formCreate: {
                    code: {
                        value: null,
                        label: Lang.get('validation.attributes.code').capitalize(),
                        help: Lang.get('financial.help-text.code'),
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            maxlength: 20,
                            minlength: 3,
                            class: null,
                            min: null,
                            max: null,
                            pattern: '[0-9a-zA-Z ]{3,20}',
                        },
                        hasError: null,
                        errors: []
                    },
                    credits: {
                        value: null,
                        label: Lang.get('validation.attributes.credits').capitalize(),
                        help: Lang.get('financial.help-text.credits'),
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            maxlength: 1,
                            minlength: 1,
                            class: null,
                            min: 1,
                            max: 5,
                            pattern: '[1-5]{1}',
                        },
                        hasError: null,
                        errors: []
                    },
                    subject: {
                        value: null,
                        attributes: {
                            required: true,
                            autocomplete: 'off',
                            maxlength: 50,
                            minlength: 2,
                            class: null,
                            min: null,
                            max: null,
                            pattern: '[0-9a-záéíóúüñA-ZÁÉÍÓÚÜÑ ]{2,50}',
                        },
                        hasError: null,
                        errors: []
                    },
                },
                tableSubjects: {
                    columns: [
                        {name: '#', class: ''},
                        {name: Lang.get('financial.management.subjects.table.subject_code'), class: ''},
                        {name: Lang.get('financial.management.subjects.table.subject_name'), class: ''},
                        {name: Lang.get('financial.management.subjects.table.subject_credits'), class: ''},
                        {name: Lang.get('financial.management.subjects.table.actions'), class: ''},
                    ],
                    url: route('financial.api.datatables.subjects', {}, false),
                    source: [
                        { data: 'id',           name: 'id' },
                        { data: 'subject_code', name: 'subject_code' },
                        { data: 'subject_name', name: 'subject_name' },
                        { data: 'subject_credits', name: 'subject_credits' },
                        { data: 'actions', name: 'actions', searchable: false, orderable: false },
                    ],
                },
                tableAssigned: {
                    columns: [
                        {name: Lang.get('financial.management.subjects.table_assigned.subject_code'), class: ''},
                        {name: Lang.get('financial.management.subjects.table_assigned.subject_name'), class: ''},
                        {name: Lang.get('financial.management.subjects.table_assigned.subject_credits'), class: 'none'},
                        {name: Lang.get('financial.management.subjects.table_assigned.program_name'), class: 'none'},
                        {name: Lang.get('financial.management.subjects.table_assigned.teacher'), class: 'none'},
                        {name: Lang.get('financial.management.subjects.table_assigned.actions'), class: ''},
                    ],
                    url: route('financial.management.subjects.programs.teachers.index', {}, false),
                    source: [
                        { data: 'subject_code',     name: 'subject_code' },
                        { data: 'subject_name',     name: 'subject_name' },
                        { data: 'subject_credits',  name: 'subject_credits' },
                        { data: 'program_name',     name: 'program_name' },
                        { data: 'teacher_name',     name: 'teacher_name' },
                        { data: 'actions', name: 'actions', searchable: false, orderable: false },
                    ],
                },
                buttons: {
                    send: Lang.get('financial.buttons.send'),
                    cancel: Lang.get('financial.buttons.cancel'),
                },
                input: {
                    label: Lang.get('validation.attributes.subject_matter').capitalize(),
                    help: Lang.get('financial.help-text.subject')
                },
                programs: [],
                teachers: [],
                subjects: [],
                sections: [
                    { title: Lang.get('financial.management.subjects.create.title'), description: Lang.get('financial.management.subjects.create.description').capitalize() } ,
                    { title: Lang.get('financial.management.subjects.index.title'), description: Lang.get('financial.management.subjects.index.description').capitalize() } ,
                    { title: Lang.get('financial.management.subjects.assign.title'), description: Lang.get('financial.management.subjects.assign.description').capitalize() } ,
                    { title: Lang.get('financial.management.subjects.assigned.title'), description: Lang.get('financial.management.subjects.assigned.description').capitalize() } ,
                ]
            }
        },
        mounted: function () {
            this.getPrograms();
            this.getTeachers();
            this.getSubjects();
            this.initValidation();
            this.initTableSubjects();
            this.initTableAssigned();
        },
        methods: {
            initValidation: function () {
                $('#form-subject').validate();
                $('#form-assign-subject').validate();
            },
            checkLength: function( value ) {
                this.formCreate.credits.value = value = value.slice(0, 1);
                this.$emit('input', value);
            },
            initTableSubjects: function() {
                let self = this;
                let table = $( '#datatable-subjects' ).DataTable({
                    columns: self.tableSubjects.source,
                    ajax: {
                        url: self.tableSubjects.url,
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
                    self.changeTitle()
                });
                this.updateTableSubjects( table );
                this.deleteTableSubjects( table );
            },
            updateTableSubjects( table ){
                let that = this;
                table.on( 'click', '.edit', function () {
                    $("#tabs").tabs().tabs({
                        active: 0,
                    });
                    $( that.$refs.li_tab_1 ).addClass('active');
                    $( that.$refs.li_tab_2 ).removeClass('active');

                    that.sections[0].title = Lang.get('financial.management.subjects.edit.title');
                    that.sections[0].description = Lang.get('financial.management.subjects.edit.description').capitalize();

                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    that.method = 'PUT';
                    if (data.hasOwnProperty('id')) {
                        that.url = route('financial.management.subjects.update', {id: data.id});
                    }
                    if (data.hasOwnProperty('subject_code')) {
                        that.formCreate.code.value = data.subject_code;
                    }
                    if (data.hasOwnProperty('subject_credits')) {
                        that.formCreate.credits.value  = data.subject_credits;
                    }
                    if (data.hasOwnProperty('subject_name')) {
                        that.formCreate.subject.value  = data.subject_name;
                    }
                });
            },
            deleteTableSubjects( table ){
                let that = this;
                table.on('click', '.trash', function (e) {
                    e.preventDefault();
                    let $tr = $(this).closest('tr');
                    let $url = route( 'financial.management.subjects.destroy' , { id: $(this).data('id') } );
                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    let text = '';

                    if (data.hasOwnProperty('subject_name')) {
                        text = data.subject_name;
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
                            return new Promise(function (resolve) {
                                axios.delete( $url )
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
                            table.ajax.reload(that.handleTooltips(), false);
                            swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
                        }
                    }).catch(swal.noop);


                });
            },
            sendFormCreate: function () {
                if ( $('#form-subject').valid() ) {
                    if (this.method === 'POST') {
                        this.url = route('financial.management.subjects.store');
                    }
                    this.vueLoading();
                    this.params = {
                        code: this.formCreate.code.value,
                        credits: this.formCreate.credits.value,
                        subject_matter: this.formCreate.subject.value,
                    };
                    axios({
                        method: this.method,
                        url: this.url,
                        data: this.params
                    })
                        .then( (response) =>  {
                            swal.close();
                            this.getSubjects();
                            this.setFormCreateNulls();
                            this.triggerSwal( response );
                            this.sections[0].title = Lang.get('financial.management.subjects.create.title');
                            this.sections[0].description = Lang.get('financial.management.subjects.create.description').capitalize();
                        })
                        .catch( (error) => {
                            swal.close();
                            this.setFormCreateNulls();
                            this.handleErrors( error );
                        })
                }
            },
            setFormCreateNulls: function () {
                this.$refs.formsubject.reset();
                this.params = null;
                this.url = null;
                this.method = 'POST';
                this.formCreate.code.value      =  null;
                this.formCreate.credits.value   =  null;
                this.formCreate.subject.value   =  null;
            },

            initTableAssigned: function() {
                let self = this;
                let table = $( '#datatable-subjects-teachers-programs' ).DataTable({
                    columns: self.tableAssigned.source,
                    ajax: {
                        url: self.tableAssigned.url,
                        error: function (data) {
                            self.triggerSwal(data);
                        },
                        fail: function (data) {
                            self.triggerSwal(data);
                        }
                    },
                });
                $(document).on('click', '#tab-table-subject-program-teacher', function () {
                    table.ajax.reload(self.handleTooltips(), false);
                    self.changeTitle()
                });
                this.updateTableAssigned( table );
                this.deleteTableAssigned( table );
            },
            updateTableAssigned: function ( table ) {
                let that = this;
                table.on( 'click', '.edit', function () {
                    that.method = 'PUT';
                    that.url = route('financial.management.subjects.programs.teachers.update');
                    that.vueLoading();
                    that.sections[2].title = Lang.get('financial.management.subjects.edit_assign.title');
                    that.sections[2].description = Lang.get('financial.management.subjects.edit_assign.description').capitalize();
                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    axios.get( route('financial.api.options.subjects.show', {id: data.subject_fk}) )
                        .then( (response) => {
                            function setUpdateValues( values ) {
                                that.subjects = values;
                            };
                            function setNewValues() {
                                that.formAssign.program.value = data.program_fk;
                                that.formAssign.teacher.value = data.teacher_fk;
                                that.formAssign.subject.value = data.subject_fk;
                                that.oldParams = {
                                    old_program: data.program_fk,
                                    old_teacher: data.teacher_fk,
                                    old_subject: data.subject_fk,
                                };
                                $("#tabs").tabs().tabs({
                                    active: 2,
                                });
                                $( that.$refs.li_tab_3 ).addClass('active');
                                $( that.$refs.li_tab_4 ).removeClass('active');
                                swal.close();
                            };
                            (async function getAssignedSubject() {
                                await setUpdateValues(response.data);
                                await setNewValues();
                            })();

                        })
                        .catch( (error) => {
                            that.triggerSwal(error);
                        });
                });
            },
            deleteTableAssigned( table ){
                let that = this;
                table.on('click', '.trash', function (e) {
                    e.preventDefault();
                    let $tr = $(this).closest('tr');
                    let $url = route( 'financial.management.subjects.programs.teachers.destroy');

                    let row = $(this).parents('tr');
                    if ( row.hasClass('child') ) {
                        row = row.prev();
                    }
                    let data = table.row( row ).data();
                    let params = {
                        program: data.program_fk,
                        teacher: data.teacher_fk,
                        subject: data.subject_fk,
                    };

                    swal({
                        title: Lang.get('javascript.remove'),
                        html: Lang.get('javascript.ask_if_delete'),
                        type: "question",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger ladda-button",
                        confirmButtonText: Lang.get('financial.buttons.yes'),
                        cancelButtonText: Lang.get('financial.buttons.cancel'),
                        showLoaderOnConfirm: true,
                        allowOutsideClick: false,
                        preConfirm: function () {
                            return new Promise(function (resolve) {
                                axios({
                                    method: 'DELETE',
                                    url: $url,
                                    data: params
                                })
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
                            that.getSubjects();
                            table.ajax.reload(that.handleTooltips(), false);
                            swal(Lang.get('javascript.success'), Lang.get('javascript.deleted_done'), "success");
                        }
                    }).catch(swal.noop);


                });
            },
            sendFormAssign: function () {
               if ( $('#form-assign-subject').valid() ) {
                   if (this.method === 'POST') {
                       this.url = route('financial.management.subjects.programs.teachers.store');
                   }
                   this.params = {
                       program: this.formAssign.program.value,
                       teacher: this.formAssign.teacher.value,
                       subject: this.formAssign.subject.value,
                   };
                   if (this.method === 'PUT') {
                       this.params = Object.assign( this.params, this.oldParams );
                   }
                   this.vueLoading();
                   axios({
                       method: this.method,
                       url: this.url,
                       data: this.params
                   })
                   .then( (response) =>  {
                       swal.close();
                       this.setFormAssignNulls();
                       this.triggerSwal( response );
                       this.sections[2].title = Lang.get('financial.management.subjects.assign.title');
                       this.sections[2].description = Lang.get('financial.management.subjects.assign.description').capitalize();
                   })
                   .catch( (error) => {
                       swal.close();
                       this.setFormAssignNulls();
                       this.handleErrors( error );
                   })
               }
            },
            setFormAssignNulls: function () {
                this.subjects = [];
                this.getSubjects();
                this.$refs.formassign.reset();
                this.params = {};
                this.oldParams = {};
                this.url = null;
                this.method = 'POST';
                this.formAssign.program.value  =  null;
                this.formAssign.teacher.value  =  null;
                this.formAssign.subject.value  =  null;
            },

            changeTitle: function(){
                this.setFormAssignNulls();
                this.setFormCreateNulls();
                this.sections[0].title = Lang.get('financial.management.subjects.create.title');
                this.sections[0].description = Lang.get('financial.management.subjects.create.description').capitalize();
                this.sections[2].title = Lang.get('financial.management.subjects.assign.title');
                this.sections[2].description = Lang.get('financial.management.subjects.assign.description').capitalize();
            },

            getPrograms: function () {
                axios.get( route('financial.api.options.programs') )
                    .then( (response) => {
                        this.programs = response.data;
                    })
                    .catch( (error) => {
                        this.triggerSwal(error);
                    });
            },
            getTeachers: function () {
                axios.get( route('financial.api.options.teachers') )
                    .then( (response) => {
                        this.teachers = response.data;
                    })
                    .catch( (error) => {
                        this.triggerSwal(error);
                    });
            },
            getSubjects: function () {
                axios.get( route('financial.api.options.subjects') )
                    .then( (response) => {
                        this.subjects = response.data;
                    })
                    .catch( (error) => {
                        this.triggerSwal(error);
                    });
            },
            handleErrors: function ( error ) {
                if ( typeof error !== 'undefined' ) {
                    if ( error.hasOwnProperty('response') ) {
                        if ( error.response.hasOwnProperty('data') ) {
                            if ( error.response.data.hasOwnProperty('errors') ) {
                                if ( error.response.data.errors.hasOwnProperty('code') ) {
                                    this.formCreate.code.errors = error.response.data.errors.code;
                                    this.formCreate.code.hasError = 'has-error';
                                }
                                if ( error.response.data.errors.hasOwnProperty('credits') ) {
                                    this.formCreate.credits.errors = error.response.data.errors.credits;
                                    this.formCreate.credits.hasError = 'has-error';
                                }
                                if ( error.response.data.errors.hasOwnProperty('subject_matter') ) {
                                    this.formCreate.subject.errors = error.response.data.errors.subject_matter;
                                    this.formCreate.subject.hasError = 'has-error';
                                }
                            } else {
                                this.triggerSwal( error );
                            }
                        } else {
                            this.triggerSwal( error );
                        }
                    } else {
                        this.triggerSwal( error );
                    }
                }
            }
        },
    }
</script>

<style scoped>

</style>