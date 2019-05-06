<?php
    require_once('lab3_1.php');
    $person = new Person("Person", "One");
    $person->setHeight(70);
    $person->setWeight(120);
    
    echo "<h3>".$person->getFirstName()." ".$person->getLastName()." has a BMI of ".$person->calculateBMI()."</h3>";
?>