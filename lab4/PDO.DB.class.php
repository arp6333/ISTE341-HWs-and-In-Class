<?php
    class DB{
        // Ellie Parobek PDO.DB.class.php
        private $dbh;

        function __construct(){
            include "Person.class.php";
            include "PhoneNumbers.class.php";
            try{
                $this->dbh = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
            }
            catch(PDOException $e){
                die("Oops");
            }
        }

        function getPeopleParameterized($id){
            try{
                $data = [];
                $stmt = $this->dbh->prepare("select * from people where PersonID = :id");
                // Bind and execute in one statement
                $stmt->execute(['id'=>$id]);
                while($row = $stmt->fetch()){
                    $data[] = $row;
                }
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        function getPhoneNumbersParameterized($id){
            try{
                $data = [];
                $stmt = $this->dbh->prepare("select * from phonenumbers where PersonID = :id");
                // Bind and execute in one statement
                $stmt->execute(['id'=>$id]);
                while($row = $stmt->fetch()){
                    $data[] = $row;
                }
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        function getPeopleParameterizedAlt($id){
            try{
                $data = [];
                $stmt = $this->dbh->prepare("select * from people where PersonID = :id");
                // Bind then execute
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                while($row = $stmt->fetch()){
                    $data[] = $row;
                }
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        function getPeopleParameterizedAlt2($id){
            try{
                $data = [];
                $stmt = $this->dbh->prepare("select * from people where PersonID = :id");
                // Bind then execute
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll();
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        function insert($last, $first, $nick){
            try{
                $stmt = $this->dbh->prepare("insert into people (LastName, FirstName, NickName) values(:lastName, :firstName, :nickName)");
                $stmt->execute([
                    "lastName"=>$last,
                    "firstName"=>$first,
                    "nickName"=>$nick
                ]);
                return $this->dbh->lastInsertId();
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        function getAllObjects(){
            try{
                $data = [];
                $stmt = $this->dbh->prepare("select * from people");
                $stmt->execute();
                $stmt->setfetchMode(PDO::FETCH_CLASS, "Person");
                while($person = $stmt->fetch()){
                    $data[] = $person;
                }
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        function getAllPhoneNumbers($id){
            try{
                $data = [];
                $stmt = $this->dbh->prepare("select * from phonenumbers where PersonID = :id");
                $stmt->execute(['id'=>$id]);
                $stmt->setfetchMode(PDO::FETCH_CLASS, "PhoneNumbers");
                while($phonenumbers = $stmt->fetch()){
                    $data[] = $phonenumbers;
                }
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }

        function getAllPeopleAsTable(){
            $data = $this->getAllObjects();
            if(count($data) > 0){
                $bigString = "<table border = '1'>\n
                                <tr>
                                    <th>ID</th><th>First</th><th>Last</th><th>Nick</th>
                                </tr>
                             ";
                foreach($data as $row){
                    $bigString .= "<tr>
                                        <td><a href = 'Lab4_4.php?id={$row->getID()}'>{$row->getID()}</a></td>
                                        <td>{$row->getFName()}</td>
                                        <td>{$row->getLName()}</td>
                                        <td>{$row->getNick()}</td>
                                  </tr>";
                    
                }

                $bigString .= "</table>\n";
            }
            else{
                $bigString = "<h2>No people exist.</h2>";
            }
            return $bigString;
        }

        function getPhoneNumbersAsTable($id){
            $data = $this->getAllPhoneNumbers($id);
            $numRows = count($data);
            $bigString = "<h2>{$numRows} records found!</h2>";

            if($numRows > 0){
                $bigString .= "<table border = '1'>\n
                                <tr>
                                    <th>ID</th><th>Phone Type</th><th>Phone Number</th><th>Area Code</th>
                                </tr>
                                ";
                foreach($data as $row){
                    $bigString .= "<tr>
                                        <td>{$row->getID()}</td>
                                        <td>{$row->getPhoneType()}</td>
                                        <td>{$row->getPhoneNum()}</td>
                                        <td>{$row->getAreaCode()}</td>
                                </tr>";
                    
                }
                $bigString .= "</table>\n";
            }
            else{
                $bigString = "<h2>No phone numbers exist for this ID.</h2>";
            }
            return $bigString;
        }
    }
?>