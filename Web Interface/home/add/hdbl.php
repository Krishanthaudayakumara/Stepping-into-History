

<?php

include "../../config/db.php";

if ($_POST) {

    $Name = $_POST["Name"];
    $Type = $_POST["Type"];
    $Doc_Location = $_POST["Doc_Location"];
    $Location = $_POST["Location"];

    $sql = "INSERT into Service(service_name, location) value('HD and BL', '$Location');";

   
    $result =  $conn->query($sql);

    $sql = "Select MAX(id) From Service;";
    $result =  $conn->query($sql);
   // print_r($result);
    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $id = $rows['MAX(id)'];
        print_r($id);

        $sql = "INSERT into hd_and_bl(D_id, Name, Type, Doc_Location) value('$id', '$Name', '$Type', '$Doc_Location');";
        $result =  $conn->query($sql);
        if ($result)
            echo "data inserted";

        else 
            echo "data not inserted";
  }else {
     echo "data not inserted";
  }


} 
?>