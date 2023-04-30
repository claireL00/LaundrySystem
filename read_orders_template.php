<?php

 
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
            if($laundry_status=="For dropping")
            echo "<button  type='button' class='btn btn-danger cancelOrder' orderIdCancel='{$orderId}'>Cancel</button>";
            echo" </td>";
        echo "</tr>";
        }

        echo "</table></div>";
 
 

?>