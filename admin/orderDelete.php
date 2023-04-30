<?php
// include database and object files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../classes/orders.php';
include_once '../classes/laundryCategories.php';
include_once '../classes/user.php'; 


if($_POST){
    // instantiate database and objects
    $database_obj = new Database();
    $db = $database_obj->getConnection();
    $order_obj = new Orders($db);
    $category_obj = new Categories($db);
    $user_obj = new User($db);
    $order_obj->orderId=$_POST['orderId_js'];



        $result=$order_obj->deleteOrder();
        
        // query events
        $stmt = $order_obj->readAll($from_record_num, $records_per_page);
        $num =$stmt->rowCount();
        $total_rows = $order_obj->countAll();
        include_once 'read_orders_template.php';

        
}
