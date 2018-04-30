<template>
    <div class="form-group form-md-line-input" :class="hasError">
        <div class="input-icon">
            <input class="form-control"
                   :required="attributes.required"
                   :maxlength="attributes.maxlength"
                   :minlength="attributes.minlength"
                   :autocomplete="attributes.autocomplete"
                   :readonly="attributes.readonly"
                   :disabled="attributes.disabled"
                   :class="attributes.class"
                   :min="attributes.min"
                   :max="attributes.max"
                   :placeholder="label"
                   :value="value"
                   :name="name"
                   :id="name"
                   :type="type" @input="handleValue( $event.target.value )">
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
            attributes: {
                type: [Array, Object],
                default: () => {
                    return {
                        required: true,
                        autocomplete: 'off',
                        maxlength: 60,
                        minlength: 2,
                        disabled: false,
                        readonly: false,
                        class: null,
                        min: 1,
                        max: 99,
                    }
                }
            },
            type: {
                type: String,
                default: 'text',
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
            value: {
                default: null,
            }
        },
        methods: {
            handleValue: function ( value ) {
                this.$emit('input', value);
            }
        }
    }
</script>

<style scoped>

</style>