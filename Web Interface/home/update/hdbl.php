

<?php

include "../../config/db.php";

if ($_POST) {
    $D_id = $_POST["D_id"];
    $Name = $_POST["Name"];
    $Type = $_POST["Type"];
    $Doc_Location = $_POST["Doc_Location"];

    $sql = "UPDATE hd_and_bl
        SET Name = '$Name', Type = '$Type', Doc_Location = '$Doc_Location'
        WHERE D_id = '$D_id'";
    ;

   
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "data inserted";
  }else {
     echo "data not inserted";
  }


} 
?>