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
    $user_obj->id=$_POST['userId_js'];
    $user_obj->readOne();

    echo '
    <form method="POST" id="updateUserForm">
    <div class="modal-body">
          <input type="text" name="id" class="form-control" value='. $user_obj->id.'>
          <label>Firstname</label>
          <input type="text" name="firstname" class="form-control" value="'.$user_obj->firstname .'"><br>

          <label>Lastname</label>
          <input type="text" name="lastname" class="form-control" value="'.$user_obj->lastname .'"><br>

          <label>Contact Number</label>
          <input type="number" name="contact_number" class="form-control" value='.$user_obj->contact_number .'><br>

          <label>Address</label>
          <input type="text" name="address" class="form-control"value="'.$user_obj->address .'"><br>
     
        </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Update</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
    </form>';
}
?>
<script src="../scripts/user.js"></script>


