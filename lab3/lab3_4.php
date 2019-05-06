<?php
    require_once('lab3_3.php');
    $person = new BritishPerson("Person", "Two");
    $person->setHeight(166);
    $person->setWeight(60);
    
    echo "<h3>".$person->getFirstName()." ".$person->getLastName()." has a BMI of ".$person->calculateBMI()."</h3>";

?>