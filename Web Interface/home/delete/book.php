

<?php

include "../../config/db.php";

if ($_POST) {
    $D_id = $_POST["D_id"];
    
    $sql = "DELETE FROM book WHERE Book_id = '$D_id';";
    

   
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sql = "  DELETE FROM product WHERE Product_id = '$D_id';";
        $result = mysqli_query($conn, $sql);
        echo "data deleted";
  }else {
     echo "data not deleted";
  }


} 
?>