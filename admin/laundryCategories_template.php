<?php
// display the table if the number of users retrieved was greater than zero
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
    // table headers
    echo "<tr>";
        echo "<th>Category Id</th>";
        echo "<th>Category Name</th>";
        echo "<th>Cost Per Kilo</th>";
    echo "</tr>";
 
    // loop through the user records
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        // display user details
        echo "<tr>";
            echo "<td>{$categoryId}</td>";
            echo "<td>{$categoryName}</td>";
            echo "<td>{$costperKilo}</td>";
        echo "</tr>";
        }
 
    echo "</table>";
 
    $page_url="laundryCategories.php?";
    $total_rows = $category->countAll();
 echo "<div class='center'>";
 include_once 'paging.php';
 echo "</div>";
    // actual paging buttons
    
}
 
// tell the user there are no selfies
else{
    echo "<div class='alert alert-danger'>
        <strong>No laundry categories found.</strong>
    </div>";
}
?>