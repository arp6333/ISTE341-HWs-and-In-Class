<?php
    // decode JSON string into a PHP object
    $decoded = json_decode($_POST['json']);
    // var_dump($decoded);

    $hobbies = "";
    foreach($decoded->hobby as $v){
        if($v->isHobby){
            $hobbies .= $v->hobbyName.", ";
        }
    }
    $hobbies = trim($hobbies, ",");

    // create response
    $json = array();
    $json['sent'] = array("name"=>$decoded->firstname, 
                          "email"=>$decoded->email,
                          "hobbies"=>$hobbies);
    $json['errorsNum'] = 2;
    $json['error'] = array();
    $json['error'][] = "Wrong email";
    $json['error'][] = "Wrong hobby";

    $encoded = json_encode($json);
    die($encoded); // or just use echo

?>