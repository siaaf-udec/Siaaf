<template>
    <div class="row">
        <div class="col-md-12">
            <div class="scroller" id="feeds-list" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
                <table class="table table-hover table-light">
                    <tbody>
                        <tr v-for="feed in sources.data">
                            <td class="fit">
                                <img class="user-pic rounded" :alt="feed.teacher_name" :src="getSrc( feed.teacher_picture )">
                            </td>
                            <td v-text="feed.teacher_name"></td>
                            <td class="fit">
                                <div class="label label-sm label-success">
                                    <i class="fa fa-comments"></i> {{ feed.comments_count }}
                                </div>
                            </td>
                            <td class="fit">
                                <div class="label label-sm label-success">
                                    <i class="fa fa-user"></i> {{ feed.subscribed_count }}
                                </div>
                            </td>
                            <td class="fit">
                                <div class="label label-sm label-success">
                                    <i class="fa fa-money"></i> {{ feed.subscribed_paid_count }}
                                </div>
                            </td>
                            <td>
                                <a :href="feed.link" class="primary-link">{{ feed.subject_code + ' - ' + feed.subject_name }}</a>
                            </td>
                            <td>
                                <span class="bold theme-font" v-text="feed.program_name"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <pagination :data="sources"
                        :limit="5"
                        @pagination-change-page="getSource">
            </pagination>
        </div>
    </div>
</template>

<script>
    import swal from'sweetalert2';
    import {mixinHttpStatus} from "../../../mixins";
    import {mixinLoading} from "../../../mixins/loadingswal";
    import PNGlib from 'identicon.js/pnglib';
    import Identicon from 'identicon.js/identicon';
    import {mixinProfilePic} from "../../../mixins/picture";
    import pagination from "laravel-vue-pagination";

    export default {
        name: "vue-feeds",
        mixins: [mixinHttpStatus, mixinLoading, mixinProfilePic],
        props: {
            get: {
                type: String,
                required: true
            }
        },
        components: {
            pagination: pagination,
        },
        data: () => {
            return {
                sources: {
                    current_page: 0,
                    data: [],
                    from: 0,
                    last_page: 0,
                    next_page_url: null,
                    per_page: 0,
                    prev_page_url: null,
                    to: 0,
                    total: 0,
                },
            }
        },
        mounted: function () {
            this.getSource();
        },
        methods: {
            getSource: function ( page ) {
                this.vueLoading( false, '#feeds-list', 'toggle');
                if (typeof page === 'undefined') {
                    page = 1;
                }
                axios.get( route( this.get , {page: page} ) )
                    .then( (response) => {
                        this.sources = response.data;
                        this.vueLoading( false, '#feeds-list', 'toggle');
                    })
                    .catch( (error) => {
                        this.triggerSwal( error );
                    })
            },
        }
    }
</script>

<style scoped>

</style>