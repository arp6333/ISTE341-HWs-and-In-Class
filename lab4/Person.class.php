<?php
    class Person{
        // Ellie Parobek Person.class.php
        private $PersonID;
        private $LastName;
        private $FirstName;
        private $NickName;

        public function whoAmI(){
            return "I am {$this->FirstName} {$this->LastName} and my nickname is {$this->NickName}";
        }

        public function getID(){
            return $this->PersonID;
        }

        public function getFName(){
            return $this->FirstName;
        }

        public function getLName(){
            return $this->LastName;
        }

        public function getNick(){
            return $this->NickName;
        }
    }
?>