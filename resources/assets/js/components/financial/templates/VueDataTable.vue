<template>
    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" :id="id">
        <thead>
        <tr>
            <th v-for="column in columns" :class="column.class" v-text="column.name"></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th v-for="column in columns" :class="column.class" v-text="column.name"></th>
        </tr>
        </tfoot>
    </table>
</template>

<script>
    import {mixinHttpStatus} from "../../../mixins";
    import {mixinDataTable} from "../../../mixins/datatable";

    export default {
        name: "vue-data-table",
        mixins: [mixinHttpStatus, mixinDataTable],
        props: {
            id: {
                type: String,
                default: 'vue-data-table'
            },
            columns: {
                type: [ Array, Object ],
                required: true,
            },
        },
    }
</script>

<style scoped>

</style>