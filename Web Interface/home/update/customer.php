

<?php

include "../../config/db.php";

if ($_POST) {
   $C_id = $_POST["C_id"];
    $Fname = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $Email = $_POST["Email"];
    $Bday = $_POST["Bday"];
    $Address = $_POST["Address"];
    $Phone_number = $_POST["Phone_number"];


    print_r($_POST);
    $sql = "UPDATE Customer SET Fname = '$Fname', Lname = '$Lname', Email = '$Email', Bday = '$Bday', Address = '$Address', Phone_number = '$Phone_number' WHERE C_id = '$C_id'";
    ;

   
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "data inserted";
  }else {
     echo "data not inserted";
  }


} 
?>