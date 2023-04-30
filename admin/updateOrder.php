<?php
// include database and object files
include_once '../config/database.php';
include_once '../classes/orders.php';;
include_once '../classes/laundryCategories.php';
include_once '../classes/user.php'; 
// instantiate database and objects
$database_obj = new Database();
$db = $database_obj->getConnection();
  

if($_POST){
    $order_obj = new Orders($db);
    $category_obj = new Categories($db);
    $user_obj = new User($db);
    $order_obj->orderId=$_POST['orderId_js'];
    $order_obj->readOne();

    echo '
    <form method="POST" id="updateOrderForm">
    <div class="modal-body">
          <label>Order Id</label>
          <input type="text" name="orderId" class="form-control" value='.$order_obj->orderId.'>
          <label>Firstname</label>
          <input type="text" name="categoryId" class="form-control" value="'.$order_obj->firstname .' '.$order_obj->lastname.'" readOnly><br>
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
          <label>Weight (kg)</label>
          <input type="number" name="kilo" class="form-control" value='.$order_obj->kilo.'></input><br>
          <label>Status</label>
          <select name="laundry_status" id="type" class="form-control custom-select" >';
          
          if($order_obj->laundry_status=="For dropping"){
            echo '<option selected value="For dropping">For dropping</option>
            <option value="Cancelled">Cancelled</option>
            <option value="For pick-up">For pick-up</option>';
            
          }
           else if($order_obj->laundry_status=="Cancelled"){
            echo '<option selected value="Cancelled">Cancelled</option>';
           }
           else if($order_obj->laundry_status=="For pick-up"){
            echo '<option selected value="For pick-up">For pick-up</option>
            <option value="Completed">Completed</option>';
           }
           else if($order_obj->laundry_status=="Completed"){
            echo '<option selected value="Completed">Completed</option>';
           }
         
           
          echo'
          </select>
         <br>
        </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Update</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
    </form>';
}
?>
<script src="../scripts/order.js"></script>


