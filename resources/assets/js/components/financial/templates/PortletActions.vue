<template>
    <a class="btn btn-circle btn-icon-only btn-default tooltips" :data-original-title="tooltip" :id="id" :href="link"><i :class="icon"></i></a>
</template>

<script>
    export default {
        name: "portlet-actions",
        props: {
            icon: {
                type: String,
                required: true,
            },
            link: {
                type: String,
                default: 'javascript:;'
            },
            id: {
                type: String,
                required: true,
            },
            tooltip: {
                type: String,
                required: true,
            }
        }
    }
</script>