<?php
    class PhoneNumbers{
        // Ellie Parobek PhoneNumbers.class.php
        private $PersonID;
        private $PhoneType;
        private $PhoneNum;
        private $AreaCode;

        public function getID(){
            return $this->PersonID;
        }

        public function getPhoneType(){
            return $this->PhoneType;
        }

        public function getPhoneNum(){
            return $this->PhoneNum;
        }

        public function getAreaCode(){
            return $this->AreaCode;
        }
    }
?>