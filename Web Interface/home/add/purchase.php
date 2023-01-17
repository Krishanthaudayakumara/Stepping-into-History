

<?php

include "../../config/db.php";

if ($_POST) {

    $P_id = $_POST["P_id"];
    $C_id = $_POST["C_id"];
    $Date = $_POST["Date"];
    $sql = "INSERT into purchase (Product_id, Customer_id, date) VALUES ('$P_id', '$C_id', '$Date')";


    $result =  $conn->query($sql);


    // print_r($result);
    if ($result) {

        echo "data inserted";
    } else {
        echo "data not inserted";
    }
}
?>