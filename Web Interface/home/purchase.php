<?php
include "../include/header.inc.php";
include "../config/db.php";
?>

<h1>Product Purchases</h1>

<div class="table">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Purchase Item</th>
        <th scope="col">Customer Email</th>
        <th scope="col">Date</th>


      </tr>
    </thead>
    <tbody>
      <tr>

        <td> <select id="product">
            <option value="">Select your product</option>
            <?php

            $sql = "SELECT Mag_id AS ID,Title,Price FROM hm_subs
UNION
SELECT Book_id, Book_name, Price FROM book;";
            $result = mysqli_query($conn, $sql);

            while ($rows = mysqli_fetch_assoc($result)) {
            ?>

              <option value="<?php echo $rows['ID'] ?>"><?php echo $rows['ID'] . " : " . $rows['Title'] . " | price - " . $rows['Price'] ?></option>
            <?php } ?>
          </select>
        </td>
        <td> <select id="customer">
            <option value="">Select the email of customer</option>
            <?php
            $sql = "SELECT C_id,Email FROM customer;";
            $result = mysqli_query($conn, $sql);
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>

              <option value="<?php echo $rows['C_id'] ?>"><?php echo $rows['C_id'] . " : " . $rows['Email'] ?></option>
            <?php } ?>
          </select>

        </td>

        <td><input type="date" placeholder="Date" id="date" required /></td>


        <td><button onclick="add()" class="btn btn-success">Add</button></td>


      </tr>

    </tbody>
  </table>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Date</th>
        <th scope="col">Customer</th>

        <th scope="col">Email</th>
        <th scope="col">Product Type</th>


      </tr>
    </thead>
    <tbody>
      

      <?php

      $sql = "SELECT product.Product_id,purchase.date , CONCAT(customer.Fname, ' ' , customer.Lname) AS customer, customer.Email, product.Type
      FROM purchase
      JOIN customer ON customer.C_id = purchase.customer_id
      JOIN product ON product.Product_id = purchase.product_id;";
      $result = mysqli_query($conn, $sql);

      while ($rows = mysqli_fetch_assoc($result)) {

        if($rows["Type"] == "" && $rows["date"] == "" && $rows["customer"] == "")
          continue;


      ?>



        <tr id=<?php echo $rows['Product_id']; ?>>
          <th scope="row">
            <?php echo $rows['Product_id']; ?>
          </th>
          <td> <?php echo $rows['date']; ?> </td>
          <td> <?php echo $rows['customer']; ?> </td>
          <td> <?php echo $rows['Email']; ?> </td>
          <td> <?php echo $rows['Type']; ?> </td>
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
      url: "update/customer.php", //your page
      data: {
        C_id: data[0],
        Fname: data[1],
        Lname: data[2],
        Email: data[3],
        Address: data[4],
        Phone_number: data[5],
        Bday: data[6]


      }, // passing the values
      success: function(res) {
        //do what you want here...
        console.log("Response :", res);
      }
    });


  }

  function add() {
    var product = document.getElementById("product").value;
    var customer = document.getElementById("customer").value;
    var date = document.getElementById("date").value;

    if (product == "" || customer == "" || date == "") {
      alert("Please fill all the fields");
      return;
    }
    $.ajax({
      type: "POST", //type of method
      url: "add/purchase.php", //your page
      data: {
        P_id: product,
        C_id: customer,
        Date: date
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