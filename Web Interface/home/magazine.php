<?php
include "../include/header.inc.php";
include "../config/db.php";
?>

<h1>Magazines</h1>

<div class="table">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Magazine ID</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Issued</th>
      <th scope="col">Type</th>
     

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td><input type="text" placeholder="Title" id="Title" required/></td>
      <td><input type="text" placeholder="Price" id="Price" required/></td>
      <td><input type="date" placeholder="Issued Date" id="issue_date" required/></td>
      <td><input type="text" placeholder="Type" id="Type" required/></td>
      
      <td><button onclick="add()" class="btn btn-success">Add</button></td>


    </tr>

    <?php

    $sql = "SELECT * FROM hm_subs";
    $result = mysqli_query($conn, $sql);

    while ($rows = mysqli_fetch_assoc($result)) {

      if($rows['Title'] == null || $rows['Price'] == null || $rows['issue_date'] == null)
        continue;
    

    ?>



      <tr id=<?php echo $rows['Mag_id']; ?>>
        <th scope="row">
          <?php echo $rows['Mag_id']; ?></th>
        <td><?php echo $rows['Title']; ?></td>
        <td><?php echo $rows['Price']; ?></td>
        <td><?php echo $rows['issue_date']; ?></td>
        <td><?php echo $rows['Type']; ?></td>
        <td><button onclick="editCell(<?php echo $rows['Mag_id']; ?>)" class="btn btn-primary">Edit</button></td>
        <td><button onclick="deleteCell(<?php echo $rows['Mag_id']; ?>)" class="btn btn-danger">Delete</button></td>

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
      url: "update/magazine.php", //your page
      data: {
        Mag_id: data[0],
        Title: data[1],
        Price: data[2],
        issue_date: data[3],
        Type: data[4]
      
      }, // passing the values
      success: function(res) {
        //do what you want here...
        console.log("Response :",res);
      }
    });


  }

  function add() {
    var Title = document.getElementById("Title").value;
    var Price = document.getElementById("Price").value;
    var issue_date = document.getElementById("issue_date").value;
    var Type = document.getElementById("Type").value;

    if(Title == "" || Price == "" || issue_date == "" || Type == ""){
      alert("Please fill all the fields");
      return;
    }
    $.ajax({
      type: "POST", //type of method
      url: "add/magazine.php", //your page
      data: {
        Title: Title,
        Price: Price,
        issue_date: issue_date,
        Type: Type
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
      url: "delete/magazine.php", //your page
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