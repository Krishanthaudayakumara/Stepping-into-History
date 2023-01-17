<?php
include "../include/header.inc.php";
include "../config/db.php";
?>

<h1>Customers</h1>

<div class="table">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Customer ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>

      <th scope="col">Email</th>
      <th scope="col">Address</th>
      <th scope="col">Phone number</th>
      <th scope="col">Birth Day</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td><input type="text" placeholder="First Name" id="Fname" required/></td>
      <td><input type="text" placeholder="Last Name" id="Lname" required/></td>

      <td><input type="text" placeholder="Email" id="email" required/></td>
      <td><input type="text" placeholder="Address" id="address" required/></td>
      <td><input type="text" placeholder="Phone Number" id="phone" required/></td>
      <td><input type="date" placeholder="Birth Day" id="dob" required/></td>

      
      <td><button onclick="add()" class="btn btn-success">Add</button></td>


    </tr>

    <?php

    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn, $sql);

    while ($rows = mysqli_fetch_assoc($result)) {

      if($rows["Fname"] == "" && $rows["Lname"] == "" && $rows["Email"] == "")
        continue;
    

    ?>



      <tr id=<?php echo $rows['C_id']; ?>>
        <th scope="row">
        <?php echo $rows['C_id']; ?>
         </th>
          <td>  <?php echo $rows['Fname']; ?> </td>
          <td>  <?php echo $rows['Lname']; ?> </td>

        <td><?php echo $rows['Email']; ?></td>
        <td><?php echo $rows['Address']; ?></td>
        <td><?php echo $rows['Phone_number']; ?></td>
        <td><?php echo $rows['Bday']; ?></td>

        <td><button onclick="editCell(<?php echo $rows['C_id']; ?>)" class="btn btn-primary">Edit</button></td>
        <td><button onclick="deleteCell(<?php echo $rows['C_id']; ?>)" class="btn btn-danger">Delete</button></td>

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
      url: "update/customer.php", //your page
      data: {
        C_id : data[0],
        Fname : data[1],
        Lname : data[2],
        Email : data[3],
        Address : data[4],
        Phone_number : data[5],
        Bday : data[6]
        
      
      }, // passing the values
      success: function(res) {
        //do what you want here...
        console.log("Response :",res);
      }
    });


  }

  function add() {
    var Fname = document.getElementById("Fname").value;
    var Lname = document.getElementById("Lname").value;
    var email = document.getElementById("email").value;
    var address = document.getElementById("address").value;
    var phone = document.getElementById("phone").value;
    var dob = document.getElementById("dob").value;


    if(Fname == "" || Lname == "" || email == "" || address == "" || !phone || !dob){
      alert("Please fill all the fields");
      return;
    }
    $.ajax({
      type: "POST", //type of method
      url: "add/customer.php", //your page
      data: {
        Fname: Fname,
        Lname : Lname,
        Email : email,
        Bday : dob,
        Address : address,
        Phone_number : phone
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
      url: "delete/customer.php", //your page
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