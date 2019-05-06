<?php
    $expire = time() + 10; // expire in 10 seconds
    $path = "/~arp6333/";
    $domain = "serenity.ist.rit.edu";
    $secure = false;

    // make sure no output from script until cookie is set
    setcookie("test", "test cookie", $expire, $path, $domain, $secure, true); // true for http only

    $counter = $_COOKIE['counter'];
    $counter++;
    setcookie("counter", $counter, $expire, $path, $domain, $secure, true);

    $getCounter = $_COOKIE['counter'];

    echo "<h2>counter = $getCounter</h2><h2>Cookies:</h2>";
    foreach($_COOKIE as $key => $value){
        echo "$key = $value <br/>";
    }
?>