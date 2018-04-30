<template>
    <div class="form-group form-md-line-input" :class="hasError">
        <div class="input-icon">
            <slot></slot>
            <label v-show="showLabel" :for="name" class="control-label" v-text="label"></label>
            <span class="help-block" v-text="help"></span>
            <span class="help-block help-block-error" v-for="error in errors">{{ error }}</span>
            <i :class="icon"></i>
        </div>
    </div>
</template>

<script>
    export default {
        name: "vue-input",
        props: {
            showLabel: {
                type: Boolean,
                default: true
            },
            label: {
                type: String,
                required: true,
            },
            help: {
                type: String,
                required: true,
            },
            icon: {
                type: String,
                default: 'fa fa-keyboard-o',
            },
            name: {
                type: String,
                required: true,
            },
            hasError: {
                type: String,
                default: null,
            },
            errors: {
                type: [Array, Object],
                default: () => {
                    return {};
                }
            },
        },
    }
</script>

<style scoped>

</style>