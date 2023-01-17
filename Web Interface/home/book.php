<?php
include "../include/header.inc.php";
include "../config/db.php";
?>

<h1>Books</h1>

<div class="table">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Book ID</th>
      <th scope="col">Name</th>
      <th scope="col">Author</th>
      <th scope="col">Price</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td><input type="text" placeholder="Name" id="name" required/></td>
      <td><input type="text" placeholder="Author" id="author" required/></td>
      <td><input type="text" placeholder="Price" id="price" required/></td>
      
      <td><button onclick="add()" class="btn btn-success">Add</button></td>


    </tr>

    <?php

    $sql = "SELECT * FROM book";
    $result = mysqli_query($conn, $sql);

    while ($rows = mysqli_fetch_assoc($result)) {

      if($rows['Book_name'] == null || $rows['Author'] == null || $rows['Price'] == null)
        continue;
    

    ?>



      <tr id=<?php echo $rows['Book_id']; ?>>
        <th scope="row">
          <?php echo $rows['Book_id']; ?></th>
        <td><?php echo $rows['Book_name']; ?></td>
        <td><?php echo $rows['Author']; ?></td>
        <td><?php echo $rows['Price']; ?></td>
        <td><button onclick="editCell(<?php echo $rows['Book_id']; ?>)" class="btn btn-primary">Edit</button></td>
        <td><button onclick="deleteCell(<?php echo $rows['Book_id']; ?>)" class="btn btn-danger">Delete</button></td>

      </tr>
    <?php } ?>

  </tbody>
</table>
</div>


<script>
  function editCell(num) {
    var row = document.getElementById(num);
    var cell = row.getElementsByTagName("td");
    var i;

    for (i = 0; i < cell.length - 2; i++) {
      cell[i].innerHTML = "<input type='text' value='" + cell[i].innerHTML + "'>";
    }
    cell[i].innerHTML = "<button onclick = 'updateCell(" + num + ")'> Update </button>";

  }

  function updateCell(num) {
    var row = document.getElementById(num);
    var cell = row.getElementsByTagName("td");
    var i;
    var data = [num];
    for (i = 0; i < cell.length-2; i++) {
      data.push(cell[i].getElementsByTagName("input")[0].value);
      cell[i].innerHTML = cell[i].getElementsByTagName("input")[0].value;

    }
    console.log(data);
    
    cell[i].innerHTML = "<button onclick = 'editCell(" + num + ")'> Edit </button>";

    $.ajax({
      type: "POST", //type of method
      url: "update/book.php", //your page
      data: {
        Book_id : data[0],
        Book_name: data[1],
        Author: data[2],
        Price: data[3],
      
      }, // passing the values
      success: function(res) {
        //do what you want here...
        console.log("Response :",res);
      }
    });


  }

  function add() {
    var name = document.getElementById("name").value;
    var author = document.getElementById("author").value;
    var price = document.getElementById("price").value;
    if(name == "" || author == "" || price == ""){
      alert("Please fill all the fields");
      return;
    }
    $.ajax({
      type: "POST", //type of method
      url: "add/book.php", //your page
      data: {
        Book_name: name,
        Author : author,
        Price : price
      }, // passing the values
      success: function(res) {
        //do what you want here...
        console.log(res);
        window.location.reload();

      }
    });
  }

  function deleteCell(id) {
    var proceed = confirm("Are you sure you want to delete the record?");
    if (proceed) {
      //proceed
      $.ajax({
      type: "POST", //type of method
      url: "delete/book.php", //your page
      data: {
        D_id: id
      }, // passing the values
      success: function(res) {
        //do what you want here...
        console.log(res);
        window.location.reload();

      }
    });
    } else {
      //don't proceed
    }
  }
</script>




<?php include "../include/footer.inc.php"; ?>