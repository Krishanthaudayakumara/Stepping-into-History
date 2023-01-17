

<?php

include "../../config/db.php";

if ($_POST) {
    $D_id = $_POST["Book_id"];
    $Name = $_POST["Book_name"];
    $Author = $_POST["Author"];
    $Price = $_POST["Price"];


    print_r($_POST);
    $sql = "UPDATE book
        SET Book_name = '$Name', Author = '$Author', Price = '$Price'
        WHERE Book_id = '$D_id'";
    ;

   
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "data inserted";
  }else {
     echo "data not inserted";
  }


} 
?>