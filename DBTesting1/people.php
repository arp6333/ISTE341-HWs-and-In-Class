<?php
    require_once("DB.class.php");
    $db = new DB();

    echo $db->getAllPeopleAsTable();

    $id = $db->insert("Green", "Joe", "Mean Joe");

    if($id > 0){
        echo "<p>You inserted 1 row whose id is $id.</p>";
    }
    else{
        echo "<p>Failed to insert row.</p>";
    }
    echo $db->getAllPeopleAsTable();

    $num = $db->update(array("id"=>3, "nick"=>"Idiot"));
    echo "<p>You updated $num rows.</p>";
    echo $db->getAllPeopleAsTable();

    $num = $db->delete(5);
    echo "<p>You deleted $num rows.</p>";
    echo $db->getAllPeopleAsTable();
?>