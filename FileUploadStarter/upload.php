<?php
    var_dump($_FILES);

    if(!empty($_FILES['uploaded_file']) && 
       $_FILES['uploaded_file']['error'] == 0
       ){
        
        // check size and type of file
        $filename = basename($_FILES['uploaded_file']['name']);
        $ext = substr($filename, strrpos($filename, '.') + 1);

        if($ext == "xls" && 
           ($_FILES['uploaded_file']['type'] == 'application/vnd.ms-excel' ||
            $_FILES['uploaded_file']['type'] == 'application/xsl' ||
            $_FILES['uploaded_file']['type'] == 'application/octet-stream') 
            && $_FILES['uploaded_file']['size'] < 350000
           ){

            // where to move the file to, for security you should rename file but we aren't
            $newname = "./files/$filename";
            // attempt to move file
            if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $newname)){
                // important!!
                chmod($newname, 0644);
                 $msg = "File has been saved.";
                $json = array();
                $json['msg'] = $msg;
                $json['error'] = "";
                echo json_encode($json);
            }
            else{
                $msg = "Problem saving file";
                $json = array();
                $json['msg'] = $msg;
                $json['error'] = "Error try again";
                echo json_encode($json);
            }
        }
        else{
            $msg = "Only .xls Excel files < 350000 bytes are allowed.";
            $json = array();
            $json['msg'] = $msg;
            $json['error'] = "Error try again";
            echo json_encode($json);
        }
    }
    else{
        $msg = "Erorr: no file uploaded.";
        $json = array();
        $json['msg'] = $msg;
        $json['error'] = "Bad upload";
        echo json_encode($json);
    }
?>