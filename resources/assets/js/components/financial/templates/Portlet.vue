<template>
    <div class="portlet portlet-sortable light bordered portlet-form">
        <div class="portlet-title">
            <div class="caption font-green">
                <i class="font-green" :class="icon"></i>
                <span class="caption-subject bold uppercase" v-text="title"></span>
            </div>
            <div class="actions">
                <slot name="actions"></slot>
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
            </div>
        </div>
        <div class="portlet-body">
            <slot name="body"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "portlet",
        props: {
            icon: {
                type: String,
                default: 'icon-layers',
            },
            title: {
                type: String,
                required: true,
            }
        },
        mounted: () => {
            PortletDraggable.init();
        }
    }
</script>
