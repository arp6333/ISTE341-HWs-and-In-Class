<?php
    require_once('lab3_1.php');
    class BritishPerson extends Person{
        function calculateBMI(){
            $BMI = (705 * ($this->getWeight()*2.205) / (($this->getHeight()/2.54) * ($this->getHeight()/2.54)));
            return $BMI;
        }
    }
?>