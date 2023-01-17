<?php
include "../include/header.inc.php";
include "../config/db.php";
?>

<h1>Historical Documents and Books Location
                  Services </h1>

<div class="table">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Service ID</th>
      <th scope="col">Name</th>
      <th scope="col">Type</th>
      <th scope="col">Document Location</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td><input type="text" placeholder="Name" id="name" required/></td>
      <td><input type="text" placeholder="Type" id="type" required/></td>
      <td><input type="text" placeholder="Document Location" id="doc_location" required/></td>
      <td><input type="text" placeholder="Service Location" id="location" required/></td>
      <td><button onclick="add()" class="btn btn-success">Add</button></td>


    </tr>

    <?php

    $sql = "SELECT * FROM hd_and_bl";
    $result = mysqli_query($conn, $sql);

    while ($rows = mysqli_fetch_assoc($result)) {

      if($rows['Name'] == null || $rows['Type'] == null || $rows['Doc_Location'] == null)
        continue;
    

    ?>



      <tr id=<?php echo $rows['D_id']; ?>>
        <th scope="row">
          <?php echo $rows['D_id']; ?></th>
        <td><?php echo $rows['Name']; ?></td>
        <td><?php echo $rows['Type']; ?></td>
        <td><?php echo $rows['Doc_Location']; ?></td>
        <td><button onclick="editCell(<?php echo $rows['D_id']; ?>)" class="btn btn-primary">Edit</button></td>
        <td><button onclick="deleteCell(<?php echo $rows['D_id']; ?>)" class="btn btn-danger">Delete</button></td>

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
    for (i = 0; i < cell.length - 2; i++) {
      data.push(cell[i].getElementsByTagName("input")[0].value);
      cell[i].innerHTML = cell[i].getElementsByTagName("input")[0].value;

    }
    console.log(data);

    cell[i].innerHTML = "<button onclick = 'editCell(" + num + ")'> Edit </button>";

    $.ajax({
      type: "POST", //type of method
      url: "update/hdbl.php", //your page
      data: {
        D_id: data[0],
        Name: data[1],
        Type: data[2],
        Doc_Location: data[3]
      }, // passing the values
      success: function(res) {
        //do what you want here...
        console.log(res);
      }
    });


  }

  function add() {
    var name = document.getElementById("name").value;
    var type = document.getElementById("type").value;
    var doc_location = document.getElementById("doc_location").value;
    var location = document.getElementById("location").value;
    if(name == "" || type == "" || doc_location == "" || location == ""){
      alert("Please fill all the fields");
      return;
    }
    $.ajax({
      type: "POST", //type of method
      url: "add/hdbl.php", //your page
      data: {
        Name: name,
        Type: type,
        Doc_Location: doc_location,
        Location: location
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
      url: "delete/hdbl.php", //your page
      data: {
        D_id: id
      }, // passing the values
      success: function(res) {
        //do what you want here...
        console.log(res);
        //window.location.reload();

      }
    });
    } else {
      //don't proceed
    }
  }
</script>




<?php include "../include/footer.inc.php"; ?>