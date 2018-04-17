<template>
    <div class="mt-element-ribbon bg-grey-steel">
        <div class="ribbon ribbon-border-hor ribbon-clip uppercase" :class="color">
            <div class="ribbon-sub ribbon-clip"></div> {{ title }}
        </div>
        <div class="ribbon-content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "vue-ribbon",
        props: {
            color: {
                type: String,
                default: 'ribbon-color-info'
            },
            title: {
                type: String,
                required: true,
            }
        },
    }
</script>

<style scoped>

</style>