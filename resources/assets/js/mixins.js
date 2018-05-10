import swal from "sweetalert2";
import {mixinProfilePic} from "./mixins/picture";

export const mixinHttpStatus = {
    name: 'mixin-http-status',
    data: function () {
        return {
            message: {
                code: null,
                swalClass: null,
                alertClass: null,
                icon: null,
                title: null,
                text: null,
                status: null,
                errors: [],
            },
        };
    },
    methods: {
        httpStatus: function ( objectText ) {
            let title, text, errors, status;
            if ( this.isAjax( objectText ) ) {
                status = this.getResponseStatus( objectText );
                this.setComponentClasses( status );
                let o;

                if (objectText.hasOwnProperty('responseJSON')) {
                    o = objectText.responseJSON;
                } else {
                    o = JSON.parse( objectText.responseText );
                }

                if ( o.hasOwnProperty( 'exception' ) ) {
                    title = o.exception;
                    text = o.message;
                    errors = [ o.file, o.line ];
                    this.handleMessage( title, text, errors, this.setStatusText( status ), status );
                } else if ( o.hasOwnProperty( 'title' ) ) {
                    title = o.title;
                    text = o.message;
                    errors = [];
                    this.handleMessage( title, text, errors, this.setStatusText( status ), status );
                }
                return this.message;
            } else if ( this.isResponse( objectText ) ) {
                status = this.getResponseStatus( objectText );
                this.setComponentClasses( status );
                title = Lang.get('javascript.' + this.message.swalClass );
                let obj = objectText;
                if ( !obj.hasOwnProperty('data') ) {
                    obj.data = {
                        message: Lang.get('javascript.processed_fail'),
                        errors: [],
                    };
                } else {
                    if ( obj.data.hasOwnProperty('message') ) {
                        text = objectText.data.message;
                    }

                    if ( obj.data.hasOwnProperty('errors') ) {
                        errors = objectText.data.errors ;
                    }
                }
                this.handleMessage( title, text, errors, this.setStatusText( status ), status);
                return this.message;
            } else if ( this.isErrorResponse( objectText ) ) {
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                status = this.getErrorStatus( objectText );
                this.setComponentClasses( status );
                let obj = objectText;
                if ( obj.hasOwnProperty('response') ) {
                    let response = objectText.response;
                    if (response.hasOwnProperty('data')) {
                        let data = objectText.response.data;
                        if (data.hasOwnProperty('title')) {
                            title = data.title || Lang.get('javascript.' + this.message.swalClass );
                        } else {
                            title = Lang.get('javascript.error');
                        }
                        if (data.hasOwnProperty('message')) {
                            text = data.message || Lang.get('javascript.processed_fail');;
                        } else {
                            text = Lang.get('javascript.processed_fail');
                        }
                        if (data.hasOwnProperty('errors')) {
                            errors = data.errors || [];
                        } else {
                            errors = [];
                        }
                    } else {
                        title = Lang.get('javascript.error');
                        text = Lang.get('javascript.processed_fail');
                        errors = [];
                    }
                } else {
                    title = Lang.get('javascript.error');
                    text = Lang.get('javascript.processed_fail');
                    errors = [];
                }
                this.handleMessage( title, text, errors, this.setStatusText( status ), status );
                return this.message;
            } else if ( this.isErrorRequest( objectText ) ) {
                // The request was made but no response was received
                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                // http.ClientRequest in node.js
                status = this.getErrorStatus( objectText );
                title = Lang.get('javascript.error');
                text = objectText.error.request || Lang.get('javascript.processed_fail');
                errors = [];
                this.setComponentClasses( status );
                this.handleMessage( title, text, errors, this.setStatusText( status ), status );
                return this.message;
            } else if ( this.isErrorMessage( objectText ) ) {
                // Something happened in setting up the request that triggered an Error
                status = this.getErrorStatus( objectText );
                title = Lang.get('javascript.error');
                text = objectText.message || Lang.get('javascript.processed_fail');
                errors = [];
                this.setComponentClasses( status );
                this.handleMessage( title, text, errors, this.setStatusText( status ), status );
            }
        },
        isAjax: function ( response ) {
            return (typeof response.responseJSON !== 'undefined');
        },
        isResponse: function (response) {
            return (typeof response.status !== 'undefined');
        },
        isErrorResponse: function ( error ) {
            return (typeof error.response !== 'undefined');
        },
        isErrorRequest: function ( error ) {
            return (typeof error.request !== 'undefined');
        },
        isErrorMessage: function ( error ) {
            return (typeof error.message !== 'undefined');
        },
        getResponseStatus: function ( response ) {
            return ( typeof response.status !== 'undefined') ? response.status : 0;
        },
        getErrorStatus: function ( error ) {
            if ( error.hasOwnProperty('response') ) {
                if ( typeof error.response === 'undefined') {
                    return 0;
                }
                return ( typeof error.response.status !== 'undefined' ) ? error.response.status : 0;
            } else  {
                return 0;
            }
        },
        setStatusText: function ( status ) {
            return ( status === 0 ) ? 'javascript.http_status.unexpected' : 'javascript.http_status.' + status;
        },
        setComponentClasses: function ( status ) {
            if ( status === 200 ) {
                this.message.swalClass = 'success';
                this.message.alertClass = 'alert-success';
                this.message.icon = 'fa fa-check-circle';
            } else if ( status === 422 || status === 500 ) {
                this.message.swalClass = 'error';
                this.message.alertClass = 'alert-danger';
                this.message.icon = 'fa fa-times-circle';
            } else if ( status >= 400 && status <= 410 || status === 503 ) {
                this.message.swalClass = 'info';
                this.message.alertClass = 'alert-info';
                this.message.icon = 'fa fa-info-circle';
            } else {
                this.message.swalClass = 'warning';
                this.message.alertClass = 'alert-warning';
                this.message.icon = 'fa fa-exclamation-triangle';
            }
        },
        handleMessage: function ( title, text, errors, status, code ) {
            this.message.title  = title;
            this.message.text   = text;
            this.message.errors = errors;
            this.message.code = code;
            this.message.status = Lang.get( status );
        },
        triggerSwal: function ( data ) {
            let objStr = this.httpStatus( data );
            let type, status, title, text;
            type = ( typeof objStr !== 'undefined' && objStr.hasOwnProperty('swalClass') ) ? objStr.swalClass : 'warning';
            title = ( typeof objStr !== 'undefined' && objStr.hasOwnProperty('title') ) ? objStr.title : Lang.get('javascript.http_status.unexpected');
            status = ( typeof objStr !== 'undefined' && objStr.hasOwnProperty('status') ) ? objStr.status : Lang.get('javascript.http_status.disconnected');
            text = ( typeof objStr !== 'undefined' && objStr.hasOwnProperty('text') ) ? objStr.text : '';

            if ( type === 'undefined' ) {
                type = 'warning';
            }
            if ( title === 'undefined' ) {
                title = Lang.get('javascript.warning');
            }
            if ( status === 'undefined' ) {
                status = Lang.get('javascript.unexpected');
            }
            if ( text === 'undefined' ) {
                text = '';
            }

            swal({
                title: Lang.get('javascript.' + type),
                type: type,
                html: title + '<br>' + status + '<br>' + text,
                showCancelButton: true,
                focusConfirm: false,
            }).then((result) => {
                if (result.value) {
                    if ( objStr.code === 404 ) {
                        window.location.href = route('home');
                    }
                } else if (result.dismiss) {
                    if ( objStr.code === 404 ) {
                        window.location.href = route('home');
                    }
                }
            });
        }
    }
};

export const mixinFormatter = {
    name: 'mixin-formatter',
    methods: {
        toMoney: function ( currency ) {
            let formatter = new Intl.NumberFormat('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 2,
            });
            return formatter.format( currency );
        }
    }
};

export const mixinAuthUser = {
    name: 'mixin-auth-user',
    mixins: [mixinProfilePic, mixinHttpStatus],
    data: () => {
        return {
            user: {
                id: 0,
                name: null,
                lastname: null,
                birthday: null,
                identity_type: null,
                identity_no: 0,
                identity_expe_place: null,
                identity_expe_date: null,
                address: null,
                sexo: null,
                phone: null,
                email: null,
                state: null,
                cities_id: 0,
                countries_id: 0,
                regions_id: 0,
                full_name: null,
                profile_picture: "a29ce245b345ea23",
                images: [ ]
            }
        };
    },
    mounted: function () {
        this.getAuthData();
        this.setProfilePicture();
    },
    methods: {
        getAuthData: function () {
            axios.get( route('financial.api.user.auth') )
                .then( (response) => {
                    this.user = response.data;
                })
                .catch( (error) => {
                    this.triggerSwal( error );
                });
        },
        setProfilePicture: function () {
            let src = this.getSrc( this.user.profile_picture ), name = this.user.full_name;
            $('.auth-user-profile-pic').attr({
                alt: name,
                src: src,
            });
        }
    },
    watch: {
        user: function ( user ) {
            let that = this;
            if ( user.profile_picture ) {
                $('.auth-user-profile-pic').attr({
                    alt: user.full_name,
                    src: that.getSrc(user.profile_picture),
                });
            }
        }
    }
};