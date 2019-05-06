<?php
    function __autoload($class_name){
        // need to use your filename path structure
        require_once "./classes/$class_name.class.php";
    }

    // static class first
    echo "<h1>Static Function Usage</h1>";
    $number1 = "one";
    $number2 = 1234;
    $number3 = "2";

    $yesNo = (Validator::numeric($number1)) ? "Yes" : "No"; // return yes if true return no if false
    echo "<p>$number1 is a number? $yesNo</p>";

    $yesNo = (Validator::numeric($number2)) ? "Yes" : "No";
    echo "<p>$number2 is a number? $yesNo</p>";

    $yesNo = (Validator::numeric($number3)) ? "Yes" : "No";
    echo "<p>$number3 is a number? $yesNo</p>";

    $validator = new Validator();
    $yesNo = (Validator::numeric($number1)) ? "Yes" : "No";
    echo "<p>$number1 is a number? $yesNo</p>";

    // regular class
    echo "<h2>Regular Class Usage</h2>";
    $person1 = new Person("Smith", "Bob");
    $person2 = new Person();
    $person3 = new Person("Jones");

    echo "<p>Person 1: {$person1->sayHello()}</p>"; // curly brace
    echo "<p>Person 2: ".$person2->sayHello()."</p>"; // concat
    echo "<p>Person 3's last name is: {$person3->getLastName()}</p>";

    var_dump($person3);
?>