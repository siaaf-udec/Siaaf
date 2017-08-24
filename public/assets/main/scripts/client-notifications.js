jQuery(document).ready(function() {

    //Socket
    var socket = io(':6001'),
        channel = 'private-notification',
        user_id = 0;

    //Se establece después de connectque se desencadene el evento
    socket.on('connect', function (error) {
        //Emite un evento al socket identificado
        socket.emit('notification', channel);
    });

    socket.on('message', function (message) {
        user_id = message;
    });

    socket.on('error', function (error) {
        console.warn('Error', error);
    });

    socket.on(channel, function (data) {
        appendMessage(data);
    });

    var appendMessage = function (data) {
        $('.notifications-users').append(
            $('<li>').append(
                $('<a>').attr('href', data.url).attr('target', '_blank').append(
                    $('<span>').attr('class', 'photo').append(
                        $('<img>').attr('src', window.location.origin +'/Siaaf/public/'+ data.image).attr('class', 'img-circle')
                    ),
                    $('<span>').attr('class', 'subject').append(
                        $('<span>').attr('class', 'time').text(data.created_at)
                    ),
                    $('<span>').attr('class', 'message').append(
                        $('<span>').attr('class', 'time')
                    ).text(data.description)
                )
            )
        );
    };

});
//$('<a>').text(data.url),
//$('<p>').text(data.description)