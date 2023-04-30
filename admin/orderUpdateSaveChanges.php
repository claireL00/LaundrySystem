<?php
// core configuration
include_once "../config/core.php";
 
// check if logged in as admin
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../classes/orders.php';
include_once '../classes/user.php';
include_once '../classes/laundryCategories.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$order_obj = new Orders($db);
$category_obj = new Categories($db);
$user_obj = new User($db);


//if form was submitted
if($_POST){
    $order_obj->orderId=$_POST['orderId'];
    $order_obj->categoryId=$_POST['categoryId'];
    $order_obj->kilo=$_POST['kilo'];
    $order_obj->laundry_status=$_POST['laundry_status'];

    $result=$order_obj->update();
    if($result === TRUE){
        echo '<script>swal("Success!", "Changes saved.", "success");</script>';
    }
    else
        echo '<script>swal("Failed!", "Changes not saved.", "danger");</script>';

}
           // read all users from the database
    $stmt = $order_obj->readAll($from_record_num, $records_per_page);
 
    // count retrieved users
    $num = $stmt->rowCount();
 
    include_once "read_orders_template.php";

    
?>