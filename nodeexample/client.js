var http = require("http");

var options = {host: "localhost",
               port: "8081",
               path: "/index.html"
}
// callback to deal with response
var callback = function(response){
    // continuously update stream with data
    var body = "";
    response.on("data", function(data){
        body += data;
    });

    response.on("end", function(){
        console.log(body);
    });
}

var req = http.request(options, callback);
req.end();