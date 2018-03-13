//Redis
let Redis = require('ioredis'),
    redis = new Redis({ showFriendlyErrorStack: true }); //Nueva instancia de redis mostrando errores.

//Socket
let io = require('socket.io')(6001);
//var io = require('socket.io')(6001, {origins : 'localhost:*'});

//Request
//Diseñada para realizar peticiones HTTPS
let request = require('request');

//Suscribe a un canal con una conexión
redis.psubscribe('*', function (error, count) {
    //
});

//Bandera
let flag = false;

// Determina Conexion
io.on('connection', function (socket) {
    "use strict";
    socket.on('notification', function (channel) {
        //Emite una peticion get
        request.get({
            url : 'http://localhost/Siaaf/public/socket/check-auth',
            headers :  {cookie : socket.request.headers.cookie},
            json : true
        }, function (error, response, json) {
            if(json.auth){
                //Agrega al cliente
                socket.join(channel, function (error) {
                    socket.send(json.user_id);
                    flag = true;
                });
                return;
            }
        });
    });
});

//Abre conexiones de cliente de un evento generado
redis.on('pmessage', function (pattern, channel, message) {
    if(flag){
        message = JSON.parse(message);
        io.emit(channel , message.data );
    }
});

/*
 * Inicializar Servidor
 * node resources/assets/developer/js/socket/notifications-server.js
 */