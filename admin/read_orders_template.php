<?php
// display the table if the number of users retrieved was greater than zero
if($num>0){
 
    echo "<div id='orderTable'><table class='table table-hover table-responsive table-bordered'>";
 
    // table headers
    echo "<tr>";
        echo "<th>Order Id</th>";
        echo "<th>Customer's Name</th>";
        echo "<th>Laundry Category</th>";
        echo "<th>Kilo</th>";
        echo "<th>Cost per Kilo</th>";
        echo "<th>Total Cost</th>";
        echo "<th>Status</th>";
        echo "<th>Action</th>";
    echo "</tr>";
 
    // loop through the user records
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        // display user details
        echo "<tr>";
            echo "<td>{$orderId}</td>";
            echo "<td>{$firstname} {$lastname}</td>";
            echo "<td>{$categoryName}</td>";
            echo "<td>{$kilo}</td>";
            echo "<td>{$costperKilo}</td>";
            echo "<td>{$totalCost}</td>";
            echo "<td>{$laundry_status}</td>";
            echo "<td>";
            if(($laundry_status=="Cancelled")||($laundry_status=="Completed")){
              echo "  <button type='button' class='glyphicon glyphicon-trash delete-object' aria-hidden='true' orderIdDelete='{$orderId}'></button>";  
            } else{
                echo "   <button  type='button' class='glyphicon glyphicon-pencil updateButton' aria-hidden='true' orderIdUpdate='{$orderId}'></button>
                <button type='button' class='glyphicon glyphicon-trash delete-object' aria-hidden='true' orderIdDelete='{$orderId}'></button>";
            }
            echo "</td>";
        echo "</tr>";
        }

        echo "</table></div>";
 
    
    $total_rows = $order_obj->countAll();


    
}
 
// tell the user there are no selfies
else{
    echo "<div class='alert alert-danger'>
        <strong>No orders found.</strong>
    </div>";
}
?>