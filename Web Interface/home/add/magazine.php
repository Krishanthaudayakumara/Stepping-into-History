

<?php

include "../../config/db.php";

if ($_POST) {

    $Title = $_POST["Title"];
    $Price = $_POST["Price"];
    $issue_date = $_POST["issue_date"];
    $Type = $_POST["Type"];

    $sql = "INSERT into product(Type) value('magazine');";

   
    $result =  $conn->query($sql);

    $sql = "Select MAX(Product_id) From product;";
    $result =  $conn->query($sql);
   // print_r($result);
    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $id = $rows['MAX(Product_id)'];
        print_r($id);

        $sql = "INSERT into hm_subs(Mag_id, Title, Price, issue_date, Type) value('$id', '$Title', '$Price', '$issue_date', '$Type');";
        $result =  $conn->query($sql);
        if ($result)
            echo "data inserted";

        else 
            echo "data not inserted";
  }else {
     echo "data not inserted";
  }


} 
?>