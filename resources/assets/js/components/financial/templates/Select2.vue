<template>
    <div class="form-group form-md-line-input">
        <div class="input-icon">
            <select class="form-control pmd-select2"
                    :class="attributes.class"
                    :required="attributes.required"
                    :disabled="attributes.disabled"
                    ref="select2Input"
                    :name="name">
                <option value="" selected="selected" v-text="option"></option>
                <slot></slot>
            </select>
            <label :for="name" class="control-label" v-text="label"></label>
            <span class="help-block"></span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "vue-select2",
        props: {
            name: {
                type: String,
                required: true,
            },
            label: {
                type: String,
                required: true,
            },
            options: {
                type: [Array, Object],
                default: []
            },
            value: {
                default: null,
            },
            attributes: {
                type: [Array, Object],
                default: () => {
                    return {
                        disabled: false,
                        required: true,
                        class: null,
                    }
                }
            }
        },
        data: function () {
            return {
                option: Lang.get('javascript.select')
            }
        },
        mounted: function () {
            this.initSelect();
        },
        methods: {
            initSelect: function () {
                let vm = this;
                $(this.$refs.select2Input)
                    .val(this.value)
                    // init select2
                    .select2({ data: this.options})
                    // emit event on change.
                    .on('change', function () {
                        vm.$emit('input', this.value)
                    })
            }
        },
        watch: {
            value: function (value) {
                // update value
                $(this.$refs.select2Input).select2().val(value).trigger('change')
            },
            options: function (options) {
                // update options
                $(this.$refs.select2Input).select2('destroy');
                $(this.$refs.select2Input).empty();
                $(this.$refs.select2Input).select2({ data: options });
                $(this.$refs.select2Input).val(null).trigger("change");
            }
        },
        destroyed: function () {
            $(this.$refs.select2Input).off().select2('destroy')
        }
    }
</script>

<style scoped>

</style>