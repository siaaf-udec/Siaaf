<template>
    <div class="row">
        <div class="col-md-12">
            <!-- TASK COMMENTS -->
            <div class="form-group">
                <div class="col-md-12">
                    <ul class="media-list">
                        <li class="media"  v-for="text in formatComment">
                            <a class="pull-left" href="javascript:;">
                                <img class="todo-userpic" :alt="text.name" :src="text.picture" width="27px" height="27px"> </a>
                            <div class="media-body todo-comment">
                                <p class="todo-comment-head">
                                    <span class="todo-comment-username" v-text="text.name"></span> &nbsp;
                                    <span class="todo-comment-date" v-text="text.date"></span>
                                </p>
                                <p class="todo-text-color" v-text="text.comment"></p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END TASK COMMENTS -->
            <!-- TASK COMMENT FORM -->
            <div class="form-group">
                <div class="col-md-12">
                    <form :action="send" method="post" class="form-horizontal" id="todo-comment-form">
                        <ul class="media-list">
                            <li class="media">
                                <a class="pull-left" href="javascript:;">
                                    <img class="todo-userpic auth-user-profile-pic" src="" width="27px" height="27px"> </a>
                                <div class="media-body">
                                    <textarea class="form-control todo-taskbody-taskdesc" rows="2" maxlength="2500" v-model.trim="comment" required="required" name="comment" id="comment" :placeholder="placeholder" ></textarea>
                                </div>
                            </li>
                        </ul>
                        <button type="button" @keyup.enter="sendComment" @click="sendComment" class="pull-right btn btn-sm btn-circle green" id="send_comment" v-text="sendBtn"></button>
                    </form>
                </div>
            </div>
            <!-- END TASK COMMENT FORM -->
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
    </div>
</template>

<script>
    import moment from 'moment-with-locales-es6';
    import PNGlib from 'identicon.js/pnglib';
    import Identicon from 'identicon.js/identicon';
    import {mixinLoading} from "../../../mixins/loadingswal";
    import {mixinHttpStatus} from "../../../mixins";
    import {mixinValidator} from "../../../mixins/validation";
    import {mixinAuthUser} from "../../../mixins";

    export default {
        name: "vue-todo-comments",
        mixins: [mixinLoading, mixinHttpStatus, mixinValidator, mixinAuthUser],
        props: {
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
                title: Lang.choice('financial.generic.comments', 0),
                leave_a_comment: Lang.get('financial.generic.leave_a_comment'),
                sendBtn: Lang.get('financial.buttons.send'),
                errors: null
            }
        },
        mounted: function() {
            this.initFormValidation();
            this.getComments();
        },
        methods: {
            initFormValidation: function () {
                $('#todo-comments-form').validate();
            },
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
                        this.title = Lang.choice('financial.generic.comments', this.comments.length, {num: this.comments.length});
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
                        comment: (comment.comment) ? comment.comment.replace(/(<([^>]+)>)/ig,"") : '',
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