var http = require("http");
var WebSocketServer = require("websocket").server;

var server = http.createServer(function(request, response){
    
});
server.listen(1234, function(){
    console.log((new Date()) + " Server listenng on 1234");
});

var wsServer = new WebSocketServer({
    httpServer: server
});

var count = 0;
var clients = {};

wsServer.on('request', function(request){
    var connection = request.accept(null, request.origin);

    var id = count++;
    // store the connection
    clients[id] = connection;
    console.log((new Date()) + " Connection accepted [" + id + "]");

    // user sent a message
    connection.on("message", function(message){
        // we should check to make sure it's only text
        // something like if(message.type == 'utf-8') ...
        var msgString = message.utf8Data;

        // loop through all the clients
        for(var i in clients){
            clients[i].sendUTF(msgString); // send the message, should add meta data, filter and sanitize
        }
    });

    connection.on("close", function(reasonCode, description){
        console.log((new Date()) + " User: " + connection.remoteAddress + " disconnected");
        delete clients[id];
    });
});