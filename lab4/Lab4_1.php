<?php
    // Ellie Parobek Lab 4_1
    require_once("DB.class.php");
    $db = new DB();

    $count = count($db->getAllPeople());

    echo "<h2>Records Found: {$count}</h2>";
    echo $db->getAllPeopleAsTable();
?>