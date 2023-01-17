<?php
include "../include/header.inc.php";
include "../config/db.php";
?>

<h1>Courses</h1>

<div class="table">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Title</th>
                <th scope="col">Type</th>
                <th scope="col">Location</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"></th>
                <td><input type="text" placeholder="Title" id="title" required /></td>
                <td>
                    <select name="type" id="type">
                        <option value="virtual">Virtual</option>
                        <option value="on premises">On Premises</option>
                    </select>

                </td>

                <td><input type="text" placeholder="Course Location" id="location" required /></td>
                <td><button onclick="add()" class="btn btn-success">Add</button></td>
                


            </tr>

            <?php

            $sql = "SELECT service.id, course.Course_name as name, course.Type, service.location
            FROM
            service
			JOIN course ON course.C_id = service.id;";

            $result = mysqli_query($conn, $sql);

            while ($rows = mysqli_fetch_assoc($result)) {

                if ($rows['name'] == null && $rows['Type'] == null && $rows['location'] == null)
                    continue;


            ?>



                <tr id=<?php echo $rows['id']; ?>>
                    <th scope="row">
                        <?php echo $rows['id']; ?></th>
                    <td><?php echo $rows['name']; ?></td>
                    <td><?php echo $rows['Type']; ?></td>
                    <td><?php echo $rows['location']; ?></td>
                    <td><button onclick="deleteCell(<?php echo $rows['id']; ?>)" class="btn btn-danger">Delete</button></td>

                    
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>


<script>
   

    function add() {
        var title = document.getElementById("title").value;
        var type = document.getElementById("type").value;    
        var location = document.getElementById("location").value;
        if (name == "" && type == "" && location == "") {
            alert("Please fill all the fields");
            return;
        }
        $.ajax({
            type: "POST", //type of method
            url: "add/course.php", //your page
            data: {
                title: title,
                type: type,
                location: location
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
                url: "delete/course.php", //your page
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