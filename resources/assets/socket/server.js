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

var Redis = require('ioredis');
    redis = new Redis();

redis.psubscribe('*', function (error, count) {
    //
});
redis.on('pmessage', function (pattern, channel, message) {
    console.log(channel, message);
});

/*redis.on("error", function(err){
    console.log(err);
});*/

//php artisan serve --host=127.0.0.1 --port=6379
//node resources/assets/socket/server.js

