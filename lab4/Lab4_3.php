<?php
    // Ellie Parobek Lab 4_3
    require_once("PDO.DB.class.php");
    $db = new DB();

    $count = count($db->getAllObjects());

    echo "<h2>Records Found: {$count}</h2>";
    echo $db->getAllPeopleAsTable();
?>