<?php
    // initiate session
    session_name("session"); // session_name is different than $_SESSION['name']
    session_start();

    if(!empty($_SESSION['name'])){ // check if we've been here before
        // add more information
        $_SESSION['school'] = "RIT";
        $_SESSION['count']++;
        header("Location: session02.php");
        exit;
    }
?>
<html>
    <head>
        <title>Session Example Page 1</title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['count'])){ // check if we've been here before
                echo "<h1>Hi, you've been here {$_SESSION['count']} times.</h1>";
                $_SESSION['count']++;
            }
            else{
                echo "<h1>Hi, you haven't been here before!</h1>";
                $_SESSION['count'] = 0;
            }
            $_SESSION['name'] = 'Nice';
            echo "<h2><a href = 'session01.php'>Come back!</a></h2>"
        ?>
    </body>
</html>