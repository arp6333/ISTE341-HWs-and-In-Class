var express = require("express");
var cookieParser = require("cookie-parser");
var app = express();
app.use(express.static('public'));
app.use(cookieParser());

var bodyParser = require("body-parser");
var urlencodedParser = bodyParser.urlencoded({extended: false});

var fs = require("fs");
var multer = require("multer");
app.use(multer({dest: "./uploads/"}).single("file"));

app.get("/index.html", function(req, res){
    res.sendFile(__dirname + "/index.html");
});

app.post("/file_upload", function(req, res){
    console.log(req.file.originalname);
    console.log(req.file.path);
    console.log(req.file.mimetype);

    var file = __dirname + "/" + req.file.originalname;
    fs.readFile(req.file.path, function(err, data){
        fs.writeFile(file, data, function(err){
            if(err){
                console.log(err);
                response = {
                    error: 'File not uploaded',
                    filename: req.file.originalname
                };
            }
            else{
                response = {
                    message: 'File uploaded successfully',
                    filename: req.file.originalname
                };
            }
            console.log(response);
            res.end(JSON.stringify(response));
        });
    });
});

app.get("/process_get", function(req, res){
    var response = {
        first_name:req.query.first_name,
        last_name:req.query.last_name
    };
    console.log(response);
    res.end(JSON.stringify(response));
});

app.post("/process_post", urlencodedParser, function(req, res){
    var response = {
        first_name:req.body.first_name,
        last_name:req.body.last_name
    };
    console.log(response);
    res.end(JSON.stringify(response));
});

app.get("/", function(req, res){
    console.log("Cookies: ", req.cookies);
    res.send(JSON.stringify(req.cookies))
});
app.post("/", function(req, res){
    res.send("Hello POST /");
});
app.delete("/del_user", function(req, res){
    res.send("Hello DELETE /del_user");
});
app.get("/lst_user", function(req, res){
    res.send("Hello GET /lst_user");
});

// can match any url with ab at start and cd at end
app.get("/ab*cd", function(req, res){
    res.send("Hello pattern match");
});

var server = app.listen(8081, function(){
    var host = server.address().address;
    var port = server.address().port;
    console.log("Listening on http://%s:%s", host, port);
});