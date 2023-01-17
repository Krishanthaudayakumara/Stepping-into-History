

<?php

include "../../config/db.php";

if ($_POST) {

    $title = $_POST["title"];
    $type = $_POST["type"];
    $location = $_POST["location"];

    $sql = "INSERT into Service(service_name, location) value('course', '$location');";


    $result =  $conn->query($sql);

    $sql = "Select MAX(id) From Service;";
    $result =  $conn->query($sql);
    // print_r($result);
    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $id = $rows['MAX(id)'];
        print_r($id);

        $sql = "INSERT into course(C_id, Name, Type) value('$id', '$title', '$type');";
        $result =  $conn->query($sql);

        if ($result)
            echo "data inserted";


        else
            echo "data not inserted";
    } else {
        echo "data not inserted";
    }
}
?>