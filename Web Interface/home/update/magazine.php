

<?php

include "../../config/db.php";

if ($_POST) {
    $Mag_id = $_POST["Mag_id"];
    $Title = $_POST["Title"];
    $Price = $_POST["Price"];
    $issue_date = $_POST["issue_date"];
    $Type = $_POST["Type"];

    print_r($_POST);
    $sql = "UPDATE hm_subs
        SET Title = '$Title', Price = '$Price', issue_date = '$issue_date', Type = '$Type'
        WHERE Mag_id = '$Mag_id'";
       
    ;

   
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "data inserted";
  }else {
     echo "data not inserted";
  }


} 
?>