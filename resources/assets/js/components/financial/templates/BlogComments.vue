<template>
    <div class="blog-comments" id="loading-comments">
        <h3 class="sbold blog-comments-title" id="comment-title" v-text="title"></h3>
        <div class="c-comment-list"><div class="media"><div class="media-left"></div><div class="media-body"></div></div></div>
        <div class="c-comment-list" v-for="text in formatComment">
            <div class="media">
                <div class="media-left">
                    <a href="javascrit:;">
                        <img class="media-object" :alt="text.name" :src="text.picture"> </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a href="javascript:;" v-text="text.name"></a>
                        <span class="c-date" v-text="text.date"></span>
                    </h4>
                    {{ text.comment }}
                </div>
            </div>
        </div>
        <h3 class="sbold blog-comments-title" v-text="leave_a_comment"></h3>
        <form action="" method="POST" id="blog-comments-form">
            <div class="form-group">
                <input type="text" rows="2" pattern='[a-záéíóúüA-ZÁÉÍÓÚÜ0-9.,\/#!$%\^&\*;:{}=\-_`~()""…]{2,2500}' maxlength="2500" v-model.trim="comment" required="required" name="comment" id="comment" :placeholder="placeholder" class="form-control c-square" />
            </div>
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
            <div class="form-group">
                <button type="button" @keyup.enter="sendComment" @click="sendComment" class="btn blue mt-ladda-btn ladda-button uppercase btn-md sbold btn-block" id="send_comment" data-style="zoom-out">
                    <span class="ladda-label" v-text="sendBtn"></span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    import moment from 'moment-with-locales-es6';
    import PNGlib from 'identicon.js/pnglib';
    import Identicon from 'identicon.js/identicon';
    import {mixinLoading} from "../../../mixins/loadingswal";
    import {mixinHttpStatus} from "../../../mixins";
    import {mixinValidator} from "../../../mixins/validation";

    export default {
        name: "vue-blog-comments",
        mixins: [mixinLoading, mixinHttpStatus, mixinValidator],
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
        methods: {
            initFormValidation: function () {
                $('#blog-comments-form').validate();
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
                        date: ( comment.created_at  ) ? moment( comment.created_at ).fromNow() : null,
                        chat: comment.comment_class
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>