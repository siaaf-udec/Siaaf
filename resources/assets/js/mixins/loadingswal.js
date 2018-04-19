import swal from "sweetalert2";

export const mixinLoading = {
    name: 'mixin-loading',
    methods: {
        vueLoading: ( isSwal = true, target = null, options = null, isModal = false ) => {
            if ( isSwal ) {
                return swal({
                    title: Lang.get('javascript.wait'),
                    onOpen: () => {
                        swal.showLoading();
                    },
                    allowOutsideClick: () => !swal.isLoading()
                });
            } else if ( !isSwal && isModal ) {
                $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
                    '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                    '<div class="progress progress-striped active">' +
                    '<div class="progress-bar" style="width: 100%;"></div>' +
                    '</div>' +
                    '</div>';
                $( target ).modalmanager('loading');
            } else {
                $.Loading.setDefaults({
                    message: Lang.get('javascript.wait'),
                });
                return $( target ).loading( options );
            }
        },
    }
};