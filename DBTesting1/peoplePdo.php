<?php
    require_once "PDO.DB.class.php";

    $db = new DB();

    $data = $db->getPeopleParameterized(1);
    foreach($data as $row){
        print_r($row);
    }
    echo "<hr />";

    $data = $db->getPeopleParameterizedAlt(1);
    foreach($data as $row){
        print_r($row);
    }
    echo "<hr />";

    $data = $db->getPeopleParameterizedAlt2(1);
    foreach($data as $row){
        print_r($row);
    }
    echo "<hr />";

    $lastId = $db->insert("Green","Dean", "Mean Dean");
    echo "<h2>PersonID: $lastId</h2>";

    $data = $db->getAllObjects();
    foreach($data as $person){
        echo "<h2>{$person->whoAmI()}</h2>";
    }
?>