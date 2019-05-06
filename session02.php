<?php
    session_name("session"); // must be same name as session01
    session_start();
?>
<html>
    <head>
        <title>Session Example Page 2</title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['name'])){
                // greet by name
                echo "Hi, {$_SESSION['name']} from {$_SESSION['school']}.
                        See I remembered your name!<br/>";

                // unset($_SESSION['name']); unsets a single variable
                session_unset(); // unsets all variables

                if(isset($_COOKIE[session_name()])){ // check if cookies, session_name() returns value of the session
                    setcookie(session_name(), "", 1); // session name, empty string, '1' for a time in the past
                }

                session_destroy(); // terminate session

                echo "<a href = 'session01.php'>Page 1</a>";
            }
            else{
                echo "Sorry, I don't know you.<br/>";
                echo "<a href = 'session01.php'>Login</a>";
            }
        ?>
    </body>
</html>