var handleLaravelErrors = function () {

    var xhr = function ( response, selector ) {

        if ( typeof response.status !== 'undefined' ) {
            if ( response.status === 422 ) {
                if ( typeof response.responseJSON.errors !== 'undefined' ){
                    $.each( response.responseJSON.errors , function( key, value ) {
                        if ( value.length > 0 ) {
                            $.each( value, function ( key, text ) {
                                selector.append( setErrors( text, 'font-red-mint' ) )
                            });
                        }
                    });
                }else if( typeof response.responseJSON.message !== 'undefined' ) {
                    selector.append( setErrors( response.responseJSON.message, 'font-red-mint' ) );
                } else {
                    selector.append( setErrors( Lang.get( 'javascript.http_status.'+response.status ), 'font-red-mint' ) );
                }
            }
        }

        if ( typeof response.status !== 'undefined') {

            if ( response.status === 0 ) {
                selector.append( setErrors( Lang.get( 'javascript.http_status.disconnected' ), 'font-red-mint' )  );
            }

            if ( typeof response.responseJSON === 'undefined' && response.status !== 0) {
                selector.append( setErrors( Lang.get( 'javascript.http_status.'+response.status ), 'font-red-mint' )  );
            }

            if ( typeof response.responseJSON !== 'undefined' && response.status !== 422 && response.status !== 0) {

                var $title =  Lang.get('javascript.http_status.error', { status: response.status });
                var $html = '<div class="bg-blue-ebonyclay bg-font-blue-ebonyclay text-left" style="width: 100%; height: 200px; overflow-y: scroll;">'
                $html  += setErrors( Lang.get( 'javascript.http_status.'+response.status ), 'font-white' );

                if ( typeof response.responseJSON.message !== 'undefined' ) {
                     $html += setErrors( 'Message: '+response.responseJSON.message, 'font-white' );
                }
                if ( typeof response.responseJSON.exception !== 'undefined' ) {
                    $html +=  setErrors( 'Exception: '+response.responseJSON.exception, 'font-white' );
                }
                if ( typeof response.responseJSON.file !== 'undefined' ) {
                    $html +=  setErrors( 'File: '+response.responseJSON.file, 'font-white' );
                }
                if ( typeof response.responseJSON.line !== 'undefined' ) {
                    $html +=  setErrors( 'Line: '+response.responseJSON.line, 'font-white' );
                }

                $html += '</div>';

                sweetAlert( $title, $html );
            }
        }

    };

    var setErrors = function ($data, $font) {
        var $html  = '<span class="help-block help-block-error '+ $font +' ">';
        $html += '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ';
        $html += $data;
        $html += '</span>';
        return $html;
    };

    var sweetAlert = function ($title, $html) {
        swal({
            title: $title,
            type: 'error',
            html: $html,
            width: 600,
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText: Lang.get('financial.buttons.ok'),
        });
    };

    return {
        init: function ( response, selector ) {
            xhr( response, selector );
        }
    };
}();