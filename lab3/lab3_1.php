<?php
    class Person{
        private $fname, $lname, $height, $weight;

        function __construct($fname = "Sam", $lname = "Spade"){
            $this->fname = $fname;
            $this->lname = $lname;
        }

        function getFirstName(){
            return $this->fname;
        }

        function getLastName(){
            return $this->lname;
        }
        
        function getHeight(){
            return $this->height;
        }
        
        function getWeight(){
            return $this->weight;
        }
        
        function setFirstName($fname){
            $this->fname = $fname;     
        }
        
        function setLastName($lname){
            $this->lname = $lname;     
        }
        
        function setHeight($height){
            $this->height = $height;     
        }
        
        function setWeight($weight){
            $this->weight = $weight;     
        }
        
        function calculateBMI(){
            $BMI = (705 * $this->weight / ($this->height * $this->height));
            return $BMI;
        }
    }