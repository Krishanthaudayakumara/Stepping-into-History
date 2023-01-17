

<?php

include "../../config/db.php";

if ($_POST) {

    $Book_name = $_POST["Book_name"];
    $Author = $_POST["Author"];
    $Price = $_POST["Price"];

    $sql = "INSERT into product(Type) value('book');";

   
    $result =  $conn->query($sql);

    $sql = "Select MAX(Product_id) From product;";
    $result =  $conn->query($sql);
   // print_r($result);
    if ($result) {
        $rows = mysqli_fetch_assoc($result);
        $id = $rows['MAX(Product_id)'];
        print_r($id);

        $sql = "INSERT into book(Book_id, Book_name, Author, Price) value('$id', '$Book_name', '$Author', '$Price');";
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