<?php
    // Ellie Parobek Lab 2: login.php
    session_name("session");
    session_start();
?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <?php
            if(isset($_COOKIE['loggedIn'])){
                header("Location: admin.php");
                exit;
            }
            else if(isset($_SESSION['failed'])){
                echo "<h1>You need to log in</h1>";
                unset($_SESSION['failed']);
            }
            else{
                if(isset($_GET['user']) || isset($_GET['password'])){
                    if($_GET['user'] == 'admin' && $_GET['password'] == 'password'){
                        date_default_timezone_set('EST');
                        $loggedIn = $_COOKIE['loggedIn'];
                        $loggedIn = date("F j, Y, g:i a");
                        setcookie("loggedIn", $loggedIn, time() + 600, "/~arp6333/", "serenity.ist.rit.edu", false, true);
                        header("Location: admin.php");
                        exit;
                    }
                    else{
                        echo "<h1>Invalid Login</h1>";
                    }
                }
                else{
                    echo "<h1>Hello, please login</h1>";
                }
            }
        ?>
    </body>
</html>