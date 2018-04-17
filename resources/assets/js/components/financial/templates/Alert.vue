<template>
    <div class="alert alert-block fade in" :class="type">
        <button v-if="dismiss" type="button" class="close" data-dismiss="alert"></button>
        <h4 class="alert-heading"><i :class="icon"></i> {{ heading }}</h4>
        <p v-text="text"></p>
        <p v-text="status"></p>
        <p><ul><li v-for="error in formattedErrors">{{ error }}</li></ul></p>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "vue-alert",
        props: {
            type: {
                type: String,
                default: 'alert-danger',
            },
            heading: {
                type: String,
                default: Lang.get('javascript.error'),
            },
            icon: {
                type: String,
                default: "fa fa-warning"
            },
            text: {
                type: String,
                required: false
            },
            status: {
                type: String,
                required: false
            },
            errors: {
                type: [Array, Object],
                required: false,
            },
            dismiss: {
                type: Boolean,
                default: true,
            }
        },
        data: function () {
            return {
                formattedErrors: [],
            };
        },
        created: function () {
            this.getErrors();
        },
        methods: {
            getErrors: function () {
                let that = this, arr = [];
                $.each( that.errors , function( key, value ) {
                    if ( value.length > 0 ) {
                        $.each( value, function ( key, text ) {
                            return arr.push( text );
                        });
                    }
                });
                that.formattedErrors = arr;
            }
        }
    }
</script>

<style scoped>

</style>