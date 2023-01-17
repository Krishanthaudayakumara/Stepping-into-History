

<?php

include "../../config/db.php";

if ($_POST) {
    $D_id = $_POST["D_id"];
    
    $sql = "DELETE FROM course WHERE C_id = '$D_id';";
    

   
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sql = "  DELETE FROM service WHERE id = '$D_id';";
        $result = mysqli_query($conn, $sql);
        echo "data deleted";
  }else {
     echo "data not deleted";
  }


} 
?>