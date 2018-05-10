<template>
    <div :id="id" class="modal fade" :class="modalClass" tabindex="-1" data-backdrop="static" data-keyboard="false" data-focus-on="input:first">
        <div class="modal-header">
            <button type="button" v-show="showDismiss" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" v-text="title"></h4>
        </div>
        <div class="modal-body">
            <slot name="body"></slot>
        </div>
        <div class="modal-footer">
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "vue-modal",
        props: {
            title: {
                type: String,
                required: true,
            },
            id: {
                type: String,
                required: true,
            },
            modalClass: {
                type: String,
                default: null,
            },
            showDismiss: {
                type: Boolean,
                default: true,
            }
        },
    }
</script>

<style scoped>

</style>