<?php
// include database and object files
include_once 'config/database.php';
include_once 'classes/orders.php';
include_once 'classes/laundryCategories.php';
include_once 'classes/user.php'; 
// instantiate database and objects
$database_obj = new Database();
$db = $database_obj->getConnection();
  

if($_POST){
    $order_obj = new Orders($db);
    $category_obj = new Categories($db);
    $user_obj = new User($db);
 
    $order_obj->customerId=$_POST['customerId_js'];
 
    echo '
    <form method="POST" id="addForm">
      <div class="modal-body">
            <label>Customer Id</label>
            <input type="text" name="customerId" class="form-control" value="'.$order_obj->customerId.'"><br>
            <label>Laundry Category</label>';
              
                  // read the event categories from the database
                  $stmt = $category_obj->read();
                    
                  // put them in a select drop-down
                      echo "<select class='form-control' name='categoryId'>";
                    
    
                      echo "<option>Please select...</option>";
                      while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                          $categoryId=$row_category['categoryId'];
                          $categoryName = $row_category['categoryName'];
                          $costperKilo = $row_category['costperKilo'];

                          // current category of the order must be selected
                          if($order_obj->categoryId==$categoryId){
                              echo "<option value='$categoryId' selected>";
                          }else{
                              echo "<option value='$categoryId'>";
                          }
                    
                          echo "$categoryName"." - "."$costperKilo</option>";
                      }
                    
                  echo '</select>
                <br>
            
            <label>Weight</label>
            <input type="number" name="kilo" class="form-control" placeholder="Optional (to be verified)" /><br>
      </div>
      <div class="modal-footer">
      
        <button type="submit" class="btn btn-primary">Add</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </form>';
}
?>

<script src="scripts/order.js"></script>

