

<?php

include "../../config/db.php";

if ($_POST) {

    $Fname = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $Email = $_POST["Email"];
    $Bday = $_POST["Bday"];
    $Address = $_POST["Address"];
    $Phone_number = $_POST["Phone_number"];

    $sql = "INSERT INTO customer (Fname, Lname, Email, Bday, Address, Phone_number) VALUES ('$Fname', '$Lname', '$Email', '$Bday', '$Address', '$Phone_number')";


    $result =  $conn->query($sql);


    if ($result)
        echo "data inserted";

    else
        echo "data not inserted";
}
?>