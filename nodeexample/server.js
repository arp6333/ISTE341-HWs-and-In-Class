var http = require("http");
var fs = require("fs");
var url = require("url");

http.createServer(function(request, response){
    // parse the request for filename
    var pathname = url.parse(request.url).pathname;
    console.log("Request for " + pathname + " recieved");

    // read file
    fs.readFile(pathname.substring(1), function(err, data){
        if(err){
            response.writeHead(404, {"Content-Type":"text/html"});
            response.write("<html><body>File not found</body></html>");
        }
        else{
            response.writeHead(200, {"Content-Type":"text/html"});
            response.write(data.toString());
        }
        response.end();
    });
}).listen(8081);
console.log("Server listening on 8081");


/*




var events = require("events");
var eventEmitter = new events.EventEmitter();

var listener1 = function listener1(){
    console.log("listener1 executed");
}
var listener2 = function listener2(){
    console.log("listener2 executed");
}

 // bind the connection event to listener1
 eventEmitter.addListener("connection", listener1);
 // bind the connection event to listener2
 eventEmitter.addListener("connection", listener2);

var eventListeners = require("events").EventEmitter.listenerCount(eventEmitter, "connection");
console.log(eventListeners + " Listener(s) listening to connection event");

// fire conection event
eventEmitter.emit("connection");

// remove the binding for listener1
eventEmitter.removeListener("connection", listener1);
console.log("Listener1 won't listen now");

// fire conection event again
eventEmitter.emit("connection");
eventListeners = require("events").EventEmitter.listenerCount(eventEmitter, "connection");
console.log(eventListeners + " Listener(s) listening to connection event");
console.log("program ended");






var connectHandler = function connected(){
    console.log("connection was successful");
    // fire data_recieved event
    eventEmitter.emit("data_recieved");
};

// bind the event to the handler
eventEmitter.on("connection", connectHandler);
eventEmitter.on("data_recieved", function(){
    console.log("data recieved successfully");
});

// fire connection event
eventEmitter.emit("connection");
console.log("program ended");




var fs = require("fs");
// var data = fs.readFileSync("input.txt");
fs.readFile("input.txt", function(err, data){
    if(err){
        return console.error(err);
    }
    console.log(data.toString());
});

// console.log(data.toString());
console.log("Program ended");



var http = require("http");

http.createServer(function (request, response){
    // send http header
    response.writeHead(200, {'Content-Type':'text/plain'});
    // send the response body
    response.end("Hello world\n");
}).listen(8081);

console.log("server running at 127.0.0.1:8081");*/