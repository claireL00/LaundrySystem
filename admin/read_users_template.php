<?php
// display the table if the number of users retrieved was greater than zero
if($num>0){
 
    echo "<div id='userTable'><table class='table table-hover table-responsive table-bordered'>";
 
    // table headers
    echo "<tr>";
        echo "<th>Firstname</th>";
        echo "<th>Lastname</th>";
        echo "<th>Email</th>";
        echo "<th>Contact Number</th>";
        echo "<th>Access Level</th>";
        echo "<th>Action</th>";
    echo "</tr>";
 
    // loop through the user records
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        // display user details
        echo "<tr>";
            echo "<td>{$firstname}</td>";
            echo "<td>{$lastname}</td>";
            echo "<td>{$email}</td>";
            echo "<td>{$contact_number}</td>";
            echo "<td>{$access_level}</td>";
            echo "<td>
                <button  type='button' class='glyphicon glyphicon-pencil updateButton' aria-hidden='true' userIdUpdate='{$id}'></button>
                <button type='button' class='glyphicon glyphicon-trash delete-object' aria-hidden='true' userIdDelete='{$id}'></button>
            </td>";
        echo "</tr>";
        }
 
    echo "</table></div>";
 
    $total_rows = $user_obj->countAll();

    
}
 
// tell the user there are no selfies
else{
    echo "<div class='alert alert-danger'>
        <strong>No users found.</strong>
    </div>";
}
?>