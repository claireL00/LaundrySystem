<?php
// core configuration
include_once "config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";

// include database and object files
include_once 'config/database.php';
include_once 'classes/orders.php';;
include_once 'classes/laundryCategories.php';
include_once 'classes/user.php';

// instantiate database and objects
$database_obj = new Database();
$db = $database_obj->getConnection();
$order_obj = new Orders($db);
$category_obj = new Categories($db);
$user_obj = new User($db);

if($_POST){
    $order_obj->customerId=$_POST['customerId'];
    $order_obj->categoryId=$_POST['categoryId'];
    $order_obj->kilo=$_POST['kilo'];
    $order_obj->laundry_status="For dropping";


    $result=$order_obj->create();
    if($result==true){
      echo '<script>swal("Success!", "Laundry added to queue!", "success");</script>';  
    }
    else{
      echo '<script>swal("Failed!", "Laundry not added to queue!", "danger");</script>';   
    }

    $stmt = $order_obj->readOrder();
     
     
    include_once "read_orders_template.php";
}
?>
<script src="scripts/order.js"></script>