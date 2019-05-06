<?php
    class DB{
        // Ellie Parobek DB.class.php
        private $dbh;

        function __construct(){
            $this->dbh = new mysqli($_SERVER['DB_SERVER'], $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD'], $_SERVER['DB']);
            if($this->dbh->connect_error){
                echo "Problem getting database: ".mysqli_connect_error();
                die();
            }
        }
        
        function getAllPeople(){
            $data = array();
            if($stmt = $this->dbh->prepare("select * from people")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($id, $last, $first, $nick);

                if($stmt->num_rows > 0){
                    while($stmt->fetch()){
                        $data[] = array('id'=>$id,
                                        'first'=>$first,
                                        'last'=>$last,
                                        'nick'=>$nick
                                    );
                    }
                }
            }
            return $data;
        }

        function getAllPeopleAsTable(){
            $data = $this->getAllPeople();
            if(count($data) > 0){
                $bigString = "<table border = '1'>\n
                                <tr>
                                    <th>ID</th><th>First</th><th>Last</th><th>Nick</th>
                                </tr>
                             ";
                foreach($data as $row){
                    $bigString .= "<tr>
                                        <td><a href = 'Lab4_2.php?id={$row['id']}'>{$row['id']}</a></td>
                                        <td>{$row['first']}</td>
                                        <td>{$row['last']}</td>
                                        <td>{$row['nick']}</td>
                                  </tr>";
                    
                }

                $bigString .= "</table>\n";
            }
            else{
                $bigString = "<h2>No people exist.</h2>";
            }
            return $bigString;
        }

        function insert($last, $first, $nick){
            $query = "insert into people (LastName, FirstName, NickName) values (?, ?, ?)";
            $insertId = -1;

            if($stmt = $this->dbh->prepare($query)){
                $stmt->bind_param("sss", $last, $first, $nick);
                $stmt->execute();
                $stmt->store_result();
                $insertId = $stmt->insert_id;
            }
            return $insertId;
        }

        function update($fields){
            $query = "update people set ";
            $updateId = 0;
            $numRows = 0;
            $items = [];
            $types = "";

            foreach($fields as $k->$v){
                switch($k){
                    case "nick":
                        $query .= "NickName = ?,";
                        $items[] = &$fields[k];
                        $types .= "s";
                        break;
                    case "first":
                        $query .= "FirstName = ?,";
                        $items[] = &$fields[k];
                        $types .= "s";
                        break;
                    case "last":
                        $query .= "LastName = ?,";
                        $items[] = &$fields[k];
                        $types .= "s";
                        break;
                    case "id":
                        $updateId = intval($fields[$k]);
                        break;
                }
            }
            $query = trim($query, ","); // remove the comma at the end
            $query .= " where PersonID = ?";
            $types .= "i"; // i for integer
            $items[] = &$updateId;

            if($stmt = $this->dbh->prepare($query)){
                $refArr = array_merge(array($types), $items); // create array with types and items

                $ref = new ReflectionClass('mysqli_stmt');
                $method = $ref->getMethod('bind_param');
                $method->invokeArgs($stmt, $refArr);

                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->affected_rows;
            }
            return $numRows;
        }

        function delete($id){
            $query = "delete from people where PersonId = ?";
            $numRows = 0;
            if($stmt = $this->dbh->prepare($query)){
                $stmt->bind_param("i", intval($id));
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->affected_rows;
            }
            return $numRows;
        }

        function getPhoneNumbersAsTable($id){
            $query = "select * from phonenumbers where PersonId = ?";
            if($stmt = $this->dbh->prepare($query)){
                $stmt->bind_param("i", intval($id));
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->num_rows;
                $stmt->bind_result($id, $type, $num, $areaCode);
            }
            $bigString = "<h2>{$numRows} records found!</h2>";

            if($numRows > 0){
                while($stmt->fetch()){
                    $data[] = array('id'=>$id,
                                    'type'=>$type,
                                    'num'=>$num,
                                    'areaCode'=>$areaCode
                                );
                }
                $bigString .= "<table border = '1'>\n
                                <tr>
                                    <th>ID</th><th>Phone Type</th><th>Phone Number</th><th>Area Code</th>
                                </tr>
                                ";
                foreach($data as $row){
                    $bigString .= "<tr>
                                        <td>{$row['id']}</td>
                                        <td>{$row['type']}</td>
                                        <td>{$row['num']}</td>
                                        <td>{$row['areaCode']}</td>
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