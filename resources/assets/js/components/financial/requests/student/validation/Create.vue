<template>
    <div class="row">
        <div class="col-md-12">
            <portlet icon="icon-layers" :title="portlet.title">
                <template slot="body">
                    <div class="row">
                        <div class="col-md-12">
                            <form @submit.prevent="createRequest" id="financial-form-request" role="form" :action="portlet.route" method="post">
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
        name: "student-validation-request-create",
        mixins: [mixinHttpStatus, mixinSelect2, mixinTootilps, mixinValidator, mixinLoading],
        data: () => {
            return {
                portlet: {
                    title: Lang.get('financial.validation.index.title'),
                    route: route('financial.requests.student.validation.store'),
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
            getPrograms: function () {
                axios.get( route('financial.api.options.programs') )
                    .then( (response) => {
                        this.programs = response.data;
                    })
                    .catch( (error) => {
                        this.triggerSwal(error);
                    })
            },
            createRequest: function () {
                if ($('#financial-form-request').valid()) {
                    this.vueLoading();
                    axios.post( this.portlet.route, qs.stringify( {
                        subject_matter: this.subject,
                        program: this.program,
                        teacher: this.teacher,
                        action:  this.action,
                    } ) )
                        .then( (response) => {
                            this.setNull();
                            this.triggerSwal( response );
                        })
                        .catch( (error) => {
                            this.triggerSwal( error );
                        })
                }
            },
            setNull: function () {
                this.subject = null;
                this.program = null;
                this.teacher = null;
                this.action = null;
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
                }
            },
        }
    }
</script>

<style scoped>

</style>