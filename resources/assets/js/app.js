/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require("./bootstrap");

window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const eventBus = new Vue();

let financial = {
    templates: "./components/financial/templates/",
    studentExtension: "./components/financial/requests/student/extension/",
    studentAddSub: "./components/financial/requests/student/addsub/",
    studentValidation: "./components/financial/requests/student/validation/",
    studentIntersemestral: "./components/financial/requests/student/intersemestral/",
    fileUpload: "./components/financial/files/upload/",
    fileManagement: "./components/financial/files/management/",
    managementPrograms: "./components/financial/management/programs/",
    managementSubjects: "./components/financial/management/subjects/",
    managementStatus: "./components/financial/management/status/",
    managementCosts: "./components/financial/management/costs/",
    managementFileType: "./components/financial/management/file_type/",
    managementAvailableModules: "./components/financial/management/available_modules/",
    approval: "./components/financial/approval/"
};
/**
 * Templates
 */
Vue.component("example", require("./components/Example.vue"));
Vue.component("portlet", require( financial.templates + "Portlet.vue"));
Vue.component("vue-modal", require( financial.templates + "Modal.vue"));
Vue.component("vue-alert", require( financial.templates + "Alert.vue"));
Vue.component("vue-select2", require( financial.templates + "Select2.vue"));
Vue.component("vue-input", require( financial.templates + "Input.vue"));
Vue.component("vue-ribbon", require( financial.templates + "Ribbon.vue"));
Vue.component("portlet-actions", require( financial.templates + "PortletActions.vue"));
Vue.component("empty-sortable-portlet", require( financial.templates + "EmptySortablePortlet.vue"));
Vue.component("vue-data-table", require( financial.templates + "VueDataTable.vue"));
Vue.component("vue-comments", require( financial.templates + "Comment.vue"));
Vue.component("vue-blog-comments", require( financial.templates + "BlogComments.vue"));
Vue.component("vue-todo-comments", require( financial.templates + "TodoComments.vue"));
Vue.component("vue-feeds", require( financial.templates + "Feeds.vue"));
/**
 * Management Sources
 */
Vue.component("management-programs", require( financial.managementPrograms + "Programs.vue" ));
Vue.component("management-subjects", require( financial.managementSubjects + "Subjects.vue" ));
Vue.component("management-status", require( financial.managementStatus + "Status.vue" ));
Vue.component("management-costs", require( financial.managementCosts + "Costs.vue" ));
Vue.component("management-file-type", require( financial.managementFileType + "FileType.vue" ));
Vue.component("management-available-modules", require( financial.managementAvailableModules + "Available.vue" ));

/**
 * File Upload
 */
Vue.component("file-upload", require( financial.fileUpload + "Upload.vue" ) );
Vue.component("file-upload-show", require( financial.fileUpload + "ShowFile.vue" ) );
Vue.component("file-management", require( financial.fileManagement + "FileManagement.vue" ) );

/**
 * Student Requests
 */
Vue.component("student-extension-request-index", require( financial.studentExtension + "Index.vue"));
Vue.component("student-extension-request-create", require( financial.studentExtension + "Create.vue"));
Vue.component("student-extension-request-show", require( financial.studentExtension + "Show.vue"));
Vue.component("student-extension-request-edit", require( financial.studentExtension + "Edit.vue"));

Vue.component("student-add-sub-request-index", require( financial.studentAddSub + "Index.vue"));
Vue.component("student-add-sub-request-create", require( financial.studentAddSub + "Create.vue"));
Vue.component("student-add-sub-request-show", require( financial.studentAddSub + "Show.vue"));
Vue.component("student-add-sub-request-edit", require( financial.studentAddSub + "Edit.vue"));

Vue.component("student-validation-request-index", require( financial.studentValidation + "Index.vue"));
Vue.component("student-validation-request-create", require( financial.studentValidation + "Create.vue"));
Vue.component("student-validation-request-show", require( financial.studentValidation + "Show.vue"));
Vue.component("student-validation-request-edit", require( financial.studentValidation + "Edit.vue"));

Vue.component("student-intersemestral-request-index", require( financial.studentIntersemestral + "Index.vue"));
Vue.component("student-intersemestral-request-create", require( financial.studentIntersemestral + "Create.vue"));
Vue.component("student-intersemestral-request-show", require( financial.studentIntersemestral + "Show.vue"));
Vue.component("student-intersemestral-request-edit", require( financial.studentIntersemestral + "Edit.vue"));

/**
 * Requests Approval
 */
Vue.component("approval-index-extension", require( financial.approval + "IndexExtension.vue" ) );
Vue.component("approval-index-validation", require( financial.approval + "IndexValidation.vue" ) );
Vue.component("approval-index-add-sub", require( financial.approval + "IndexAddSub.vue" ) );
Vue.component("approval-index-intersemestral", require( financial.approval + "IndexIntersemestral.vue" ) );

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

import {mixinAuthUser} from "./mixins";

const app = new Vue({
    el: "#app",
    mixins: [mixinAuthUser]
});
