

<?php

include "../../config/db.php";

if ($_POST) {

    $title = $_POST["title"];
    $lecturer = $_POST["lecturer"];
    $location = $_POST["location"];

    $sql = "INSERT into Service(service_name, location) value('workshop', '$location');";

   
    $result =  $conn->query($sql);

    $sql = "Select MAX(id) From Service;";
    $result =  $conn->query($sql);
   // print_r($result);
    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $id = $rows['MAX(id)'];
        print_r($id);

        $sql = "INSERT into workshop(W_id, Name) value('$id', '$title');";
        $result =  $conn->query($sql);
        if ($result)
            {
                $sql = "UPDATE lecturer SET W_id = '$id' WHERE L_id = '$lecturer' ;";
                $result =  $conn->query($sql);
                if ($result)
                    echo "data inserted";
                else 
                    echo "data not inserted";
            }

        else 
            echo "data not inserted";
  }else {
     echo "data not inserted";
  }


} 
?>