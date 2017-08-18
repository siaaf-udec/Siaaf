//N1
//var io = require('socket.io')(6001);
//io.on('connection', function (socket) {

    //console.log('New connection!', socket.id);

    // Server message
    //socket.send('Message from server');

    // Fire evemt
    //socket.emit('server-info', {version : .1});

    //socket.broadcast.send('New user');

    //socket.on('message', function (data) {
    //    socket.broadcast.send(data);
    //});

    // Join to room
    //socket.join('vip', function (error){
    //    console.log(socket.rooms);
    //});
//});


//N2
var Redis = require('ioredis'),
    redis = new Redis({ showFriendlyErrorStack: true }); //Optimizará la pila de errores para usted

//redis.psubscribe('*', function (error, count) {
    //
//});
//redis.on('pmessage', function (pattern, channel, message) {
   //console.log(channel, message);
//});

/*redis.on("error", function(err){
    console.log(err);
});*/

//php artisan serve --host=127.0.0.1 --port=6379

//N3
//redis.psubscribe('*', function (error, count) {
    //
//});
//redis.on('pmessage', function (pattern, channel, message) {
   //"use strict";
   //message = JSON.parse(message);
   //console.log(channel);

   //io.emit(channel + ':' + message.event, message.data.message );
   // channel: message.event
//});

//N4
//Ingresamos en la consola de socket.io
//(new io('http://localhost:6001')).on('connect', function(){ console.log('Connected to Siaaf') });
var request = require('request');

//var io = require('socket.io')(6001, {origins : 'localhost:*'});
var io = require('socket.io')(6001);

/*io.use(function (socket, next) {
    "use strict";
    request.get({
        url : 'http://localhost/Siaaf/public/socket/check-auth',
        headers :  {cookie : socket.request.headers.cookie},
        json : true
    }, function (error, response, json) {
        //console.log(json);
        return json.auth ? next() : next(new Error('Auth error'));
    });
});*/

io.on('connection', function (socket) {
    "use strict";
    socket.on('sub', function (channel) {
        //console.log('I want to subscribe on: ', channel);

        request.get({
            url : 'http://localhost/Siaaf/public/socket/check-sub/' + channel,
            headers :  {cookie : socket.request.headers.cookie},
            json : true
        }, function (error, response, json) {
            if(json.can){
                socket.join(channel, function (error) {
                    //Envía un message evento.
                    socket.send('Join to ' + channel);
                });
                return;
            }
        });
    });
});

redis.psubscribe('*', function (error, count) {
    //
});
redis.on('pmessage', function (pattern, channel, message) {
  "use strict";
  message = JSON.parse(message);
  io.emit(channel + ':' + message.event, message.data.message );
  //channel: message.event
});

/*
 * Inicializar Servidor
 * node resources/assets/developer/js/socket/server.js
 */