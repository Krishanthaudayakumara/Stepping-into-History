

<?php

include "../../config/db.php";

if ($_POST) {
  $D_id = $_POST["D_id"];

  $sql = "DELETE FROM customer WHERE C_id = '$D_id';";



  $result = mysqli_query($conn, $sql);
  if ($result) {

    echo "data deleted";
  } else {
    echo "data not deleted";
  }
}
?>