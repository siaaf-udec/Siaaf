<template>
    <div id="comment-component">
        <p v-text="leave_a_comment"></p>
        <div class="scroller" v-bind:style="styleObject" data-always-visible="1" data-rail-visible1="1">
            <ul class="chats">
                <li  v-for="item in formatComment" :class="item.chat">
                    <img class="avatar" :alt="item.name" :src="item.picture" />
                    <div class="message">
                        <span class="arrow"> </span>
                        <a href="javascript:;" class="name" v-text="item.name"></a>
                        <span class="datetime" v-text="item.date"></span>
                        <span class="body" v-text="item.comment"></span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="chat-form">
            <div class="input-cont">
                <input class="form-control" v-model.trim="comment" minlength="1" maxlength="2500" type="text" :placeholder="placeholder" />
            </div>
            <div class="btn-cont">
                <span class="arrow"> </span>
                <a href="javascipt:;" @keyup.enter="sendComment" @click="sendComment" class="btn blue icn-only">
                    <i class="fa fa-check icon-white"></i>
                </a>
            </div>
        </div>
        <hr>
        <div class="form-group" v-if="errors">
            <hr>
            <vue-alert :type="errors.alertClass"
                       :dismiss="false"
                       :heading="errors.title"
                       :icon="errors.icon"
                       :text="errors.text"
                       :status="errors.status"
                       :errors="errors.errors">
            </vue-alert>
        </div>
    </div>
</template>

<script>
    import moment from 'moment-with-locales-es6';
    import PNGlib from 'identicon.js/pnglib';
    import Identicon from 'identicon.js/identicon';
    import {mixinLoading} from "../../../mixins/loadingswal";
    import {mixinHttpStatus} from "../../../mixins";

    export default {
        name: "vue-comments",
        mixins: [mixinLoading, mixinHttpStatus],
        props: {
            styleObject: {
                type: [Array, Object],
                default: () => {
                    return { height: '380px' };
                },
            },
            id: {
                type: Number,
                default: 0,
            },
            send: {
                type: String,
                required: true,
            },
            get: {
                type: String,
                required: true,
            }
        },
        data: () => {
            return {
                comments: [],
                comment: null,
                placeholder: Lang.get('financial.placeholder.comment'),
                leave_a_comment: Lang.get('financial.generic.leave_a_comment'),
                errors: null
            }
        },
        methods: {
            sendComment: function () {
                if ( this.comment && this.id ) {
                    this.setLoading();
                    axios.post( route( this.send ), qs.stringify( { id: this.id, comment: this.comment } ) )
                        .then( (response) => {
                            this.comment = null;
                            this.setLoading();
                            this.getComments();
                        })
                        .catch( (error) => {
                            this.comment = null;
                            this.errors = this.httpStatus( error );
                            this.setLoading();
                        })
                }
            },
            getComments: function () {
                this.setLoading();
                this.comments = [];
                axios.get( route( this.get , { id: this.id }) )
                    .then( (response) => {
                        this.setLoading();
                        this.comments = response.data;
                    })
                    .catch( (error) => {
                        this.errors = this.httpStatus( error );
                        this.setLoading();
                    })
            },
            setLoading: function () {
                this.vueLoading( false, '#comment-component', 'toggle');
            }
        },
        watch: {
            id: function (id) {
                if ( id ) {
                    this.getComments();
                }
            }
        },
        computed: {
            formatComment: function () {
                return this.comments.map( (comment) => {
                    return {
                        comment: comment.comment,
                        name:  (comment.user) ? comment.user.full_name : Lang.get('financial.generic.empty'),
                        picture: (comment.user) ? ( comment.user.profile_picture.length === 16 ) ? `data:image/png;base64,${new Identicon( comment.user.profile_picture , 420).toString()}` : comment.user.profile_picture : `data:image/png;base64,${new Identicon( 'c157a79031e1c40f85931829bc5fc552' , 420).toString()}`,
                        date: moment( comment.created_at ).fromNow(),
                        chat: comment.comment_class
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>