import PNGlib from 'identicon.js/pnglib';
import Identicon from 'identicon.js/identicon';

export const mixinProfilePic = {
    name: 'mixin-profile-picture',
    methods: {
        getSrc: function ( image = null ) {
            let src;
            if ( !image ) {
                src = 'data:image/png;base64,' + new Identicon( '6a7b9cd6787dde56a43ef' , 45).toString();
            }
            if ( image.length > 0 && image.length < 20) {
                src = 'data:image/png;base64,' + new Identicon( image , 45).toString();
            }
            if ( image.length > 20) {
                src = image;
            }
            return src;
        }
    }
};