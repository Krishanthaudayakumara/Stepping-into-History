<?php
include "../include/header.inc.php";
include "../config/db.php";
?>

<h1>Workshops</h1>

<div class="table">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Service ID</th>
                <th scope="col">Title</th>
                <th scope="col">Lecturer</th>
                <th scope="col">Location</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"></th>
                <td><input type="text" placeholder="Title" id="title" required /></td>
                <td>
                    <select name="lecturer" id="lecturer">
                        <option value="none" selected>Select Lecturer</option>

                        <?php $sql = "SELECT L_id as id, CONCAT(FName, ' ', LName) AS name FROM lecturer";
                        $result = mysqli_query($conn, $sql);
                        while ($rows = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['name']; ?></option>
                        <?php } ?>

                    </select>

                </td>

                <td><input type="text" placeholder="Workshop Location" id="location" required /></td>
                <td><button onclick="add()" class="btn btn-success">Add</button></td>


            </tr>

            <?php

            $sql = "SELECT service.id, workshop.Name as name,lecturer.L_id, CONCAT(lecturer.FName,' ',lecturer.LName) AS lecturer, service.location
            FROM
            service
            INNER JOIN Lecturer ON Lecturer.W_id = service.id
            INNER JOIN workshop ON workshop.W_id = service.id;";

            $result = mysqli_query($conn, $sql);

            while ($rows = mysqli_fetch_assoc($result)) {

                if ($rows['name'] == null && $rows['lecturer'] == null && $rows['location'] == null)
                    continue;


            ?>



                <tr id=<?php echo $rows['id']; ?>>
                    <th scope="row">
                        <?php echo $rows['id']; ?></th>
                    <td><?php echo $rows['name']; ?></td>
                    <td><?php echo $rows['lecturer']; ?></td>
                    <td><?php echo $rows['location']; ?></td>
                    
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>


<script>
   

    function add() {
        var title = document.getElementById("title").value;
        var lecturer = document.getElementById("lecturer").value;
    
        var location = document.getElementById("location").value;
        if (name == "" && lecturer == "" && location == "") {
            alert("Please fill all the fields");
            return;
        }
        $.ajax({
            type: "POST", //type of method
            url: "add/workshop.php", //your page
            data: {
                title: title,
                lecturer: lecturer,
                location: location
            }, // passing the values
            success: function(res) {
                //do what you want here...
                console.log(res);
                //window.location.reload();

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