<?php
    // Ellie Parobek Lab 4_2
    require_once("DB.class.php");
    $db = new DB();

    if(isset($_GET['id'])){
        echo $db->getPhoneNumbersAsTable($_GET['id']); 
        echo "<a href='Lab4_1.php'>Go back to Lab4_1.php</a>";
    }
    else{
        header("Location: Lab4_1.php");
        exit;
    }
?>