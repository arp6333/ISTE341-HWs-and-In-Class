<?php
    // Ellie Parobek Lab 2: admin.php
    session_name("session");
    session_start();
?>
<html>
    <head>
        <title>Admin</title>
    </head>
    <body>
        <?php
            if(isset($_COOKIE['loggedIn'])){
                echo "You logged in ".$_COOKIE['loggedIn'];

                session_unset();
                if(isset($_COOKIE[session_name()])){
                    setcookie(session_name(), "", 1);
                    setcookie("loggedIn", "", 1);
                }
                session_destroy();
            }
            else{
                $_SESSION['failed'] = "failed login";
                header("Location: login.php");
                exit;
            }
        ?>
    </body>
</html>