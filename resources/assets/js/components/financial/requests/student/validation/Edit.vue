<template>
    <div class="row">
        <div class="col-md-12">
            <portlet icon="icon-layers" :title="portlet.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12">
                            <form @submit.prevent="editRequest" id="financial-form-request" role="form" :action="portlet.route" method="put">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <vue-select2 :label="portlet.select.program"
                                                         v-model.number="program"
                                                         :value="program"
                                                         :options="programs"
                                                         name="program">
                                            </vue-select2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <vue-select2 :label="portlet.select.subject.label"
                                                         v-model.number="subject"
                                                         :value="subject"
                                                         :options="subjects"
                                                         :attributes="portlet.select.subject.attributes"
                                                         name="subject">
                                            </vue-select2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <vue-select2 :label="portlet.select.teacher.label"
                                                         v-model.number="teacher"
                                                         :value="teacher"
                                                         :options="teachers"
                                                         :attributes="portlet.select.teacher.attributes"
                                                         name="teacher">
                                            </vue-select2>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" class="btn green tooltips" :value="portlet.button.text" :data-riginal-title="portlet.button.tooltip">
                                </div>
                            </form>
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
    import {mixinSelect2} from "../../../../../mixins/select2";
    import {mixinTootilps} from "../../../../../mixins/tooltip";
    import {mixinLoading} from "../../../../../mixins/loadingswal";
    import {mixinValidator} from "../../../../../mixins/validation";
    export default {
        name: "student-validation-request-edit",
        mixins: [mixinHttpStatus, mixinSelect2, mixinTootilps, mixinValidator, mixinLoading],
        data: () => {
            return {
                portlet: {
                    title: Lang.get('financial.validation.edit.title'),
                    select: {
                        program: Lang.get('validation.attributes.program').capitalize(),
                        subject: {
                            label: Lang.get('validation.attributes.subject_matter').capitalize(),
                            attributes: {
                                disabled: true,
                                required: true,
                                class: null,
                            }
                        },
                        teacher: {
                            label: Lang.get('validation.attributes.teacher').capitalize(),
                            attributes: {
                                disabled: true,
                                required: true,
                                class: null,
                            }
                        },
                    },
                    button: {
                        text: Lang.get('financial.buttons.apply'),
                        tooltip: Lang.get('javascript.tooltip.add'),
                    },
                },
                program: null,
                subject: null,
                teacher: null,
                programs: [],
                subjects: [],
                teachers: [],
                current: {
                    subject_fk: null,
                    teacher_fk: null,
                    program_fk: null,
                },
            }
        },
        mounted: function () {
            this.initValidation();
            this.getPrograms();
        },
        methods: {
            initValidation: function () {
                $('#financial-form-request').validate();
            },
            getSource: function () {
                axios.get( route('financial.api.validation.edit', {id: $('#app').data('source') }) )
                    .then( (response) => {
                        this.current = response.data;
                    })
                    .then( () => { this.program = this.current.program_fk; })
                    .catch( (error)  => {
                        this.triggerSwal(error);
                    })
            },
            getPrograms: function () {
                axios.get( route('financial.api.options.programs') )
                    .then( (response) => { this.programs = response.data; })
                    .then( () => { this.getSource(); })
                    .catch( (error) => { this.triggerSwal(error); })
            },
            editRequest: function () {
                this.vueLoading();
                axios.put( route('financial.requests.student.validation.update', { id: $('#app').data('source') } ) , {
                    subject_matter: this.subject,
                    program: this.program,
                    teacher: this.teacher,
                    action:  this.action,
                } )
                    .then( (response) => {
                        this.setNull();
                        this.triggerSwal( response );
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    })
            },
            setNull: function () {
                this.subject = null;
                this.program = null;
                this.teacher = null;
                this.action = null;
                this.current = {
                    subject_fk: null,
                    teacher_fk: null,
                    program_fk: null,
                }
            }
        },
        watch: {
            program: function (program) {
                if (program) {
                    axios.get( route( 'financial.api.options.programs.subjects', { id: program } ) )
                        .then( (response) => {
                            this.portlet.select.subject.attributes = {
                                disabled: false,
                                required: true,
                                class: null,
                            };
                            this.subjects = response.data;
                        })
                        .then( () => { this.subject = this.current.subject_fk; })
                        .catch( (error) => {
                            this.triggerSwal(error);
                        });
                } else {
                    this.portlet.select.subject.attributes = {
                        disabled: true,
                        required: true,
                        class: null,
                    };
                    this.portlet.select.teacher.attributes = {
                        disabled: true,
                        required: true,
                        class: null,
                    };
                    this.subjects = [];
                    this.teachers = [];
                    this.subject = null;
                    this.teacher = null;
                    this.current.teacher_fk = null;
                    this.current.subject_fk = null;
                }
            },
            subject: function (subject) {
                if (subject) {
                    axios.get( route( 'financial.api.options.programs.subjects.teachers', { id: subject } ) )
                        .then( (response) => {
                            this.portlet.select.teacher.attributes = {
                                disabled: false,
                                required: true,
                                class: null,
                            };
                            this.teachers = response.data;
                        })
                        .then( () => { this.teacher = this.current.teacher_fk; })
                        .catch( (error) => {
                            this.triggerSwal(error);
                        })
                } else {
                    this.portlet.select.teacher.attributes = {
                        disabled: true,
                        required: true,
                        class: null,
                    };
                    this.teacher = null;
                    this.current.teacher_fk = null;
                }
            },
        }
    }
</script>

<style scoped>

</style>